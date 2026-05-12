<?php

declare(strict_types=1);

namespace ArielMejiaDev\LarapexCharts\Tests\Unit;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use ArielMejiaDev\LarapexCharts\Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Testing\PendingCommand;
use PHPUnit\Framework\Attributes\Test;

final class ChartsTest extends TestCase
{
    #[Test]
    public function it_tests_larapex_charts_install_add_chart_stubs(): void
    {
        Artisan::call('vendor:publish', ['--all' => true, '--force' => true]);

        $chartTypes = collect([
            'PieChart',
            'DonutChart',
            'RadialBarChart',
            'PolarAreaChart',
            'LineChart',
            'AreaChart',
            'BarChart',
            'HorizontalBarChart',
            'HeatMapChart',
            'RadarChart',
        ]);

        $chartTypes->each(function ($chart): void {
            $this->assertFileExists(
                base_path(sprintf('stubs/charts/Default/%s.stub', $chart))
            );

            $this->assertFileExists(
                base_path(sprintf('stubs/charts/Vue/%s.stub', $chart))
            );

            $this->assertFileExists(
                base_path(sprintf('stubs/charts/Json/%s.stub', $chart))
            );
        });
    }

    #[Test]
    public function it_tests_larapex_charts_can_load_script_correctly(): void
    {
        $chart = (new LarapexChart)
            ->setTitle('Posts')
            ->setXAxis(['Jan', 'Feb', 'Mar'])
            ->setDataset([150, 120])
            ->setLabels([__('Published'), __('No Published')]);

        $this->assertEquals($chart->dataset(), $chart->script()->getData()['chart']->dataset());
    }

    #[Test]
    public function it_tests_larapex_charts_can_change_default_config_colors(): void
    {
        $chart = (new LarapexChart)->setTitle('Posts')->setXAxis(['Jan', 'Feb', 'Mar'])->setDataset([150, 120]);
        $oldColors = $chart->colors();
        $chart->setColors(['#fe9700', '#607c8a']);
        $this->assertNotSame($oldColors, $chart->colors());
    }

    #[Test]
    public function it_tests_larapex_chart_cdn_returns_a_correct_url(): void
    {
        $this->assertSame('https://cdn.jsdelivr.net/npm/apexcharts', (new LarapexChart)->cdn());
    }

    #[Test]
    public function it_tests_make_chart_generates_json_chart_from_package_fallback_stub(): void
    {
        $path = app_path('Charts/SalesChart.php');
        File::delete($path);
        File::deleteDirectory(base_path('stubs/charts'));

        $command = $this->artisan('make:chart', ['name' => 'SalesChart', '--json' => true]);
        $this->assertInstanceOf(PendingCommand::class, $command);

        $command
            ->expectsChoice('Select a chart type', 'Line Chart', [
                'Pie Chart',
                'Donut Chart',
                'Radial Bar Chart',
                'Polar Area Chart',
                'Line Chart',
                'Area Chart',
                'Bar Chart',
                'Horizontal Bar Chart',
                'Heatmap Chart',
                'Radar Chart',
            ])
            ->assertExitCode(0);
        $command->run();

        $this->assertFileExists($path);
        $this->assertStringContainsString('class SalesChart', File::get($path));
        $this->assertStringContainsString('->lineChart()', File::get($path));
        $this->assertStringContainsString("->addData([40, 93, 35, 42, 18, 82], 'Physical sales')", File::get($path));
        $this->assertStringContainsString('->toJson()', File::get($path));
    }

    #[Test]
    public function it_tests_larapex_chart_default_state(): void
    {
        $chart = new LarapexChart;

        $this->assertSame('donut', $chart->type());
        $this->assertSame('', $chart->title());
        $this->assertSame('', $chart->subtitle());
        $this->assertSame('left', $chart->subtitlePosition());
        $this->assertSame([], $chart->labels());
        $this->assertSame('', $chart->dataset());
        $this->assertSame(500, $chart->height());
        $this->assertSame('100%', $chart->width());
        $this->assertSame(config('larapex-charts.font_family'), $chart->fontFamily());
        $this->assertSame(config('larapex-charts.font_color'), $chart->foreColor());
        $this->assertSame(config('larapex-charts.colors'), json_decode($chart->colors(), true));
        $this->assertSame(['horizontal' => false], json_decode($chart->horizontal(), true));
        $this->assertSame([
            'type' => 'category',
            'categories' => [],
            'labels' => ['show' => true],
        ], json_decode($chart->xAxis(), true));
        $this->assertSame(['show' => false], json_decode($chart->grid(), true));
        $this->assertSame(['show' => false], json_decode($chart->markers(), true));
        $this->assertSame(['show' => false], json_decode($chart->toolbar(), true));
        $this->assertSame(['enabled' => true], json_decode($chart->zoom(), true));
        $this->assertSame(['enabled' => false], json_decode($chart->dataLabels(), true));
        $this->assertSame(['enabled' => false], json_decode($chart->sparkline(), true));
        $this->assertFalse($chart->stacked());
        $this->assertSame('true', $chart->showLegend());
        $this->assertTrue($chart->showXAxisLabels());
        $this->assertTrue($chart->showYAxisLabels());
        $this->assertSame([
            'states' => [
                'hover' => [
                    'filter' => [
                        'type' => LarapexChart::STATE_LIGHTEN,
                    ],
                ],
                'active' => [
                    'allowMultipleDataPointsSelection' => false,
                    'filter' => [
                        'type' => LarapexChart::STATE_DARKEN,
                    ],
                ],
            ],
        ], $chart->states());
    }

    #[Test]
    public function it_tests_larapex_chart_fluent_setters_update_readable_state(): void
    {
        $chart = (new LarapexChart)
            ->setFontFamily('Inter, sans-serif')
            ->setFontColor('#101010')
            ->setTitle('Revenue')
            ->setSubtitle('Quarterly', 'right')
            ->setHeight(360)
            ->setWidth('75%')
            ->setMonochromeColor('#abcdef')
            ->setHorizontal(true)
            ->setXAxis(['2024-01-01', '2024-02-01'], 'datetime')
            ->setYAxis(10, 20)
            ->setGrid('#111111', 0.5, 3)
            ->setMarkers([], 6, 9)
            ->setStroke(4)
            ->setToolbar(true, false)
            ->setDataLabels(true)
            ->setSparkline(true)
            ->setStacked(true)
            ->setShowLegend(false)
            ->setShowXAxisLabels(false)
            ->setShowYAxisLabels(false)
            ->setStatesHover(LarapexChart::STATE_NONE)
            ->setStatesActive(LarapexChart::STATE_LIGHTEN, true);

        $this->assertSame('Inter, sans-serif', $chart->fontFamily());
        $this->assertSame('#101010', $chart->foreColor());
        $this->assertSame('Revenue', $chart->title());
        $this->assertSame('Quarterly', $chart->subtitle());
        $this->assertSame('right', $chart->subtitlePosition());
        $this->assertSame(360, $chart->height());
        $this->assertSame('75%', $chart->width());
        $this->assertSame(['#abcdef'], json_decode($chart->colors(), true));
        $this->assertSame(['horizontal' => true], json_decode($chart->horizontal(), true));
        $this->assertSame([
            'type' => 'datetime',
            'categories' => ['2024-01-01', '2024-02-01'],
            'labels' => ['show' => true],
        ], json_decode($chart->xAxis(), true));
        $this->assertSame(['min' => 10, 'max' => 20, 'tickAmount' => 20, 'show' => true], json_decode($chart->yAxis(), true));
        $this->assertSame([
            'show' => true,
            'strokeDashArray' => 3,
            'row' => [
                'colors' => ['#111111', 'transparent'],
                'opacity' => 0.5,
            ],
        ], json_decode($chart->grid(), true));
        $this->assertSame([
            'size' => 6,
            'colors' => config('larapex-charts.colors'),
            'strokeColors' => '#fff',
            'strokeWidth' => 3,
            'hover' => ['size' => 9],
        ], json_decode($chart->markers(), true));
        $this->assertSame([
            'show' => true,
            'width' => 4,
            'colors' => config('larapex-charts.colors'),
            'curve' => 'straight',
        ], json_decode($chart->stroke(), true));
        $this->assertSame(['show' => true], json_decode($chart->toolbar(), true));
        $this->assertSame(['enabled' => false], json_decode($chart->zoom(), true));
        $this->assertSame(['enabled' => true], json_decode($chart->dataLabels(), true));
        $this->assertSame(['enabled' => true], json_decode($chart->sparkline(), true));
        $this->assertTrue($chart->stacked());
        $this->assertSame('false', $chart->showLegend());
        $this->assertFalse($chart->showXAxisLabels());
        $this->assertFalse($chart->showYAxisLabels());
        $this->assertSame([
            'states' => [
                'hover' => [
                    'filter' => [
                        'type' => LarapexChart::STATE_NONE,
                    ],
                ],
                'active' => [
                    'allowMultipleDataPointsSelection' => true,
                    'filter' => [
                        'type' => LarapexChart::STATE_LIGHTEN,
                    ],
                ],
            ],
        ], $chart->states());
    }

    #[Test]
    public function it_tests_simple_chart_add_data_replaces_dataset_with_flat_series(): void
    {
        $chart = (new LarapexChart)->pieChart()
            ->setDataset([1, 2, 3])
            ->addData([10, 20, 30]);

        $this->assertSame([10, 20, 30], json_decode($chart->dataset(), true));
    }

    #[Test]
    public function it_tests_complex_chart_add_data_appends_named_series(): void
    {
        $chart = (new LarapexChart)->lineChart()
            ->addData([10, 20], 'Users')
            ->addData([30, 40]);

        $this->assertSame([
            [
                'name' => 'Users',
                'data' => [10, 20],
            ],
            [
                'name' => '',
                'data' => [30, 40],
            ],
        ], json_decode($chart->dataset(), true));
    }

    #[Test]
    public function it_tests_horizontal_bar_factory_sets_bar_type_and_horizontal_option(): void
    {
        $chart = (new LarapexChart)->horizontalBarChart();

        $this->assertSame('bar', $chart->type());
        $this->assertSame(['horizontal' => true], json_decode($chart->horizontal(), true));
    }

    #[Test]
    public function it_tests_transform_labels_filters_empty_string_values(): void
    {
        $chart = new LarapexChart;

        $this->assertSame('["\"Jan\",\"Mar\""]', $chart->transformLabels(['Jan', '', null, 'Mar', 0, false]));
    }

    #[Test]
    public function it_tests_set_options_replaces_nested_default_values(): void
    {
        $chart = (new LarapexChart)->setOptions([
            'chart' => [
                'height' => 240,
            ],
            'title' => [
                'text' => 'Overridden',
            ],
            'colors' => ['#abc'],
        ]);

        $options = $chart->getOptions();

        $this->assertSame(240, $options['chart']['height']);
        $this->assertSame('donut', $options['chart']['type']);
        $this->assertSame('Overridden', $options['title']['text']);
        $this->assertSame(['#abc'], $options['colors']);
    }
}
