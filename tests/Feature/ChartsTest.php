<?php namespace ArielMejiaDev\LarapexCharts\Tests\Feature;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use ArielMejiaDev\LarapexCharts\Tests\TestCase;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart as LarapexChartFacade;
use PHPUnit\Framework\Attributes\Test;

class ChartsTest extends TestCase
{
    #[Test]
    public function it_tests_larapex_charts_can_render_pie_charts_by_default(): void
    {
        $chart = (new LarapexChart)->setTitle('Users Test Chart');
        $this->assertEquals('donut', $chart->type());
        $anotherChart = (new LarapexChart)->areaChart();
        $this->assertEquals('area', $anotherChart->type());
    }

    #[Test]
    public function it_tests_larapex_charts_can_render_pie_chart(): void
    {
        $chart = (new LarapexChart)->pieChart()
            ->setTitle('Posts')
            ->setSubtitle('From January To March')
            ->setLabels(['Product One', 'Product Two', 'Product Three'])
            ->setXAxis(['Jan', 'Feb', 'Mar'])
            ->setDataset([150, 120]);

        $this->assertEquals($chart, $chart->script()['chart']);
        $this->assertEquals('pie', $chart->type());
    }

    #[Test]
    public function it_tests_larapex_charts_can_render_donut_chart(): void
    {
        $chart = (new LarapexChart)->donutChart()
            ->setTitle('Posts')
            ->setXAxis(['Jan', 'Feb', 'Mar'])
            ->setDataset([150, 120]);

        $this->assertEquals($chart, $chart->script()['chart']);
        $this->assertEquals('donut', $chart->type());
    }

    #[Test]
    public function it_tests_larapex_can_render_radial_bar_charts(): void
    {
        $chart = (new LarapexChart)->radialChart()
            ->setTitle('Products with more profit')
            ->setXAxis(['Jan', 'Feb', 'Mar'])
            ->setDataset([60, 40, 79]);

        $this->assertEquals($chart, $chart->script()['chart']);
        $this->assertEquals('radialBar', $chart->type());
    }

    #[Test]
    public function it_tests_larapex_charts_can_render_polar_chart(): void
    {
        $chart = (new LarapexChart)->polarAreaChart()
            ->setTitle('Products with more profit')
            ->setXAxis(['Jan', 'Feb', 'Mar'])
            ->setDataset([60, 40, 79]);

        $this->assertEquals($chart, $chart->script()['chart']);
        $this->assertEquals('polarArea', $chart->type());
    }

    #[Test]
    public function larapex_can_render_line_charts(): void
    {
        $chart = (new LarapexChart)->lineChart()
            ->setTitle('Total Users Monthly')
            ->setSubtitle('From January to March')
            ->setXAxis([
                'Jan', 'Feb', 'Mar'
            ])
            ->setDataset([
                [
                    'name'  =>  'Active Users',
                    'data'  =>  [250, 700, 1200]
                ]
            ])
            ->setHeight(250)
            ->setGrid(true)
            ->setStroke(1);

        $this->assertEquals($chart->id(), $chart->container()['id']);
        $this->assertEquals($chart, $chart->script()['chart']);
        $this->assertEquals('line', $chart->type());
    }

    #[Test]
    public function it_tests_larapex_charts_can_create_an_area_chart(): void
    {
        $chart = (new LarapexChart)->areaChart()
            ->setTitle('Total Users Monthly')
            ->setSubtitle('From January to March')
            ->setXAxis([
                'Jan', 'Feb', 'Mar'
            ])
            ->setDataset([
                [
                    'name'  =>  'Active Users',
                    'data'  =>  [250, 700, 1200]
                ],
                [
                    'name'  =>  'New Users',
                    'data'  =>  [1000, 1124, 2000]
                ]
            ]);

        $this->assertEquals($chart->id(), $chart->container()['id']);
        $this->assertEquals($chart, $chart->script()['chart']);
        $this->assertEquals('area', $chart->type());
    }

    #[Test]
    public function it_tests_larapex_charts_can_render_bar_charts(): void
    {
        $chart = (new LarapexChart)->barChart()
            ->setTitle('Net Profit')
            ->setXAxis(['Jan', 'Feb', 'Mar'])
            ->setDataset([
                [
                    'name'  => 'Company A',
                    'data'  =>  [500, 1000, 1900]
                ],
                [
                    'name'  => 'Company B',
                    'data'  => [300, 900, 1400]
                ],
                [
                    'name'  => 'Company C',
                    'data'  => [430, 245, 500]
                ],
                [
                    'name'  => 'Company D',
                    'data'  => [200, 245, 700]
                ],
                [
                    'name'  => 'Company E',
                    'data'  => [120, 45, 610]
                ],
                [
                    'name'  => 'Company F',
                    'data'  => [420, 280, 400]
                ]
            ]);

        $this->assertEquals($chart->id(), $chart->container()['id']);
        $this->assertEquals($chart, $chart->script()['chart']);
        $this->assertEquals('bar', $chart->type());
    }

    #[Test]
    public function it_tests_larapex_charts_can_render_stacked_bar_chart(): void
    {
        $chart = (new LarapexChart)->barChart()
            ->setTitle('Net Profit')
            ->setStacked(true)
            ->setXAxis(['Jan', 'Feb', 'Mar'])
            ->setDataset([
                [
                    'name' => 'Company A',
                    'data' => [500, 1000, 1900]
                ],
                [
                    'name' => 'Company B',
                    'data' => [300, 800, 1400]
                ],
                [
                    'name' => 'Company C',
                    'data' => [304, 231, 500]
                ]
            ]);

        $this->assertEquals($chart->id(), $chart->container()['id']);
        $this->assertEquals($chart, $chart->script()['chart']);
        $this->assertEquals('bar', $chart->type());
        $this->assertTrue($chart->stacked());
    }

    #[Test]
    public function it_tests_larapex_charts_can_render_horizontal_bar_chart(): void
    {
        $chart = (new LarapexChart)->barChart()
            ->setTitle('Net Profit')
            ->setHorizontal(true)
            ->setXAxis(['Jan', 'Feb', 'Mar'])
            ->setDataset([
                [
                    'name'  => 'Company A',
                    'data'  =>  [500, 1000, 1900]
                ],
                [
                    'name'  => 'Company B',
                    'data'  => [300, 900, 1400]
                ],
                [
                    'name'  => 'Company C',
                    'data'  => [430, 245, 500]
                ]
            ]);

        $this->assertEquals($chart->id(), $chart->container()['id']);
        $this->assertEquals($chart, $chart->script()['chart']);
        $this->assertEquals('bar', $chart->type());
        $chartHorizontalOrientation = json_decode($chart->horizontal(), 1)['horizontal'];
        $this->assertTrue($chartHorizontalOrientation);
    }

    #[Test]
    public function it_tests_larapex_charts_can_render_heatmap_chart(): void
    {
        $chart = (new LarapexChart)->heatMapChart()
            ->setTitle('Total Users')
            ->setXAxis([
                'Jan', 'Feb', 'Mar'
            ])
            ->setDataset([
                [
                    'name'  =>  'Users of Basic Plan',
                    'data'  =>  [250, 700, 1200]
                ],
                [
                    'name'  =>  'Users of Premium Plan',
                    'data'  =>  [1000, 1124, 2000]
                ]
            ]);

        $this->assertEquals($chart->id(), $chart->container()['id']);
        $this->assertEquals($chart, $chart->script()['chart']);
        $this->assertEquals('heatmap', $chart->type());
    }
    
    #[Test]
    public function it_tests_larapex_charts_can_render_radar_chart(): void
    {
        $chart = (new LarapexChart)->radarChart()
            ->setTitle('Total Users')
            ->setXAxis([
                'Jan', 'Feb', 'Mar'
            ])
            ->setDataset([
                [
                    'name'  =>  'Users of Basic Plan',
                    'data'  =>  [250, 700, 1200]
                ],
                [
                    'name'  =>  'Users of Premium Plan',
                    'data'  =>  [1000, 1124, 2000]
                ]
            ]);

        $this->assertEquals($chart->id(), $chart->container()['id']);
        $this->assertEquals($chart, $chart->script()['chart']);
        $this->assertEquals('radar', $chart->type());
    }

    #[Test]
    public function it_tests_multiple_charts_have_unique_ids_and_independent_data(): void
    {
        $chart1 = (new LarapexChart)->pieChart()
            ->setTitle('Chart One')
            ->setLabels(['A', 'B'])
            ->addData([10, 20]);

        $chart2 = (new LarapexChart)->barChart()
            ->setTitle('Chart Two')
            ->setXAxis(['Jan', 'Feb'])
            ->addData([30, 40], 'Series');

        $this->assertNotEquals($chart1->id(), $chart2->id());
        $this->assertNotEquals($chart1->type(), $chart2->type());
        $this->assertNotEquals($chart1->title(), $chart2->title());
        $this->assertNotEquals($chart1->dataset(), $chart2->dataset());

        $container1 = $chart1->container()->render();
        $container2 = $chart2->container()->render();
        $this->assertStringContainsString($chart1->id(), $container1);
        $this->assertStringContainsString($chart2->id(), $container2);
        $this->assertNotEquals($container1, $container2);

        $script1 = $chart1->script()->render();
        $script2 = $chart2->script()->render();
        $this->assertStringContainsString($chart1->id(), $script1);
        $this->assertStringContainsString($chart2->id(), $script2);
        $this->assertStringContainsString('Chart One', $script1);
        $this->assertStringContainsString('Chart Two', $script2);
        $this->assertStringNotContainsString('Chart Two', $script1);
        $this->assertStringNotContainsString('Chart One', $script2);
    }

    #[Test]
    public function it_tests_multiple_charts_via_facade_have_independent_instances(): void
    {
        $chart1 = LarapexChartFacade::pieChart()
            ->setTitle('Facade Chart One')
            ->addData([10, 20]);

        $chart2 = LarapexChartFacade::barChart()
            ->setTitle('Facade Chart Two')
            ->addData([30, 40], 'Series');

        $this->assertNotEquals($chart1->id(), $chart2->id());
        $this->assertEquals('pie', $chart1->type());
        $this->assertEquals('bar', $chart2->type());
        $this->assertEquals('Facade Chart One', $chart1->title());
        $this->assertEquals('Facade Chart Two', $chart2->title());
    }

    #[Test]
    public function it_tests_multiple_charts_toVue_returns_independent_data(): void
    {
        $chart1 = (new LarapexChart)->areaChart()
            ->setTitle('Vue Chart One')
            ->setXAxis(['Jan', 'Feb'])
            ->addData([10, 20], 'Series A');

        $chart2 = (new LarapexChart)->lineChart()
            ->setTitle('Vue Chart Two')
            ->setXAxis(['Mar', 'Apr'])
            ->addData([30, 40], 'Series B');

        $vue1 = $chart1->toVue();
        $vue2 = $chart2->toVue();

        $this->assertEquals('area', $vue1['type']);
        $this->assertEquals('line', $vue2['type']);
        $this->assertNotEquals($vue1['options']['chart']['id'], $vue2['options']['chart']['id']);
        $this->assertEquals('Vue Chart One', $vue1['options']['title']['text']);
        $this->assertEquals('Vue Chart Two', $vue2['options']['title']['text']);
    }

    #[Test]
    public function it_tests_to_json_preserves_configured_option_shape(): void
    {
        $chart = $this->chartWithConfiguredOutputOptions();

        $payload = $chart->toJson()->getData(true);
        $options = $payload['options'];

        $this->assertEquals($chart->id(), $payload['id']);
        $this->assertEquals([
            'id' => $chart->id(),
            'type' => 'bar',
            'height' => 320,
            'width' => 640,
            'toolbar' => ['show' => true],
            'zoom' => ['enabled' => false],
            'fontFamily' => null,
            'foreColor' => config('larapex-charts.font_color'),
            'sparkline' => '{"enabled":true}',
            'stacked' => true,
        ], $options['chart']);
        $this->assertEquals(['bar' => ['horizontal' => true]], $options['plotOptions']);
        $this->assertEquals(['#111111', '#222222'], $options['colors']);
        $this->assertEquals([['name' => 'Revenue', 'data' => [10, 20]]], $options['series']);
        $this->assertEquals(['enabled' => true], $options['dataLabels']);
        $this->assertEquals(['mode' => 'dark'], $options['theme']);
        $this->assertEquals(['text' => 'Revenue'], $options['title']);
        $this->assertEquals(['text' => 'Quarterly', 'align' => 'right'], $options['subtitle']);
        $this->assertEquals([
            'type' => 'category',
            'categories' => ['Jan', 'Feb'],
            'labels' => ['show' => true],
        ], $options['xaxis']);
        $this->assertEquals(['min' => 0, 'max' => 100, 'tickAmount' => 5, 'show' => false], $options['yaxis']);
        $this->assertEquals(['show' => false], $options['grid']);
        $this->assertEquals(['show' => false], $options['markers']);
        $this->assertEquals(['show' => 'false'], $options['legend']);
        $this->assertEquals([
            'hover' => ['filter' => ['type' => LarapexChart::STATE_NONE]],
            'active' => [
                'allowMultipleDataPointsSelection' => true,
                'filter' => ['type' => LarapexChart::STATE_LIGHTEN],
            ],
        ], $options['states']);
        $this->assertEquals(['North', 'South'], $options['labels']);
        $this->assertEquals([
            'show' => true,
            'width' => 2,
            'colors' => ['#333333'],
            'curve' => 'smooth',
        ], $options['stroke']);
    }

    #[Test]
    public function it_tests_to_vue_preserves_configured_option_shape(): void
    {
        $chart = $this->chartWithConfiguredOutputOptions();

        $vue = $chart->toVue();
        $options = $vue['options'];

        $this->assertEquals(320, $vue['height']);
        $this->assertEquals(640, $vue['width']);
        $this->assertEquals('bar', $vue['type']);
        $this->assertEquals([(object) ['name' => 'Revenue', 'data' => [10, 20]]], $vue['series']);
        $this->assertArrayNotHasKey('type', $options['chart']);
        $this->assertArrayNotHasKey('width', $options['chart']);
        $this->assertEquals($chart->id(), $options['chart']['id']);
        $this->assertEquals(320, $options['chart']['height']);
        $this->assertEquals((object) ['show' => true], $options['chart']['toolbar']);
        $this->assertEquals((object) ['enabled' => false], $options['chart']['zoom']);
        $this->assertNull($options['chart']['fontFamily']);
        $this->assertEquals(config('larapex-charts.font_color'), $options['chart']['foreColor']);
        $this->assertEquals((object) ['enabled' => true], $options['chart']['sparkline']);
        $this->assertTrue($options['chart']['stacked']);
        $this->assertEquals((object) ['horizontal' => true], $options['plotOptions']['bar']);
        $this->assertEquals(['#111111', '#222222'], $options['colors']);
        $this->assertEquals((object) ['enabled' => true], $options['dataLabels']);
        $this->assertEquals(['mode' => 'dark'], $options['theme']);
        $this->assertEquals(['text' => 'Revenue'], $options['title']);
        $this->assertEquals(['text' => 'Quarterly', 'align' => 'right'], $options['subtitle']);
        $this->assertEquals((object) [
            'type' => 'category',
            'categories' => ['Jan', 'Feb'],
            'labels' => (object) ['show' => true],
        ], $options['xaxis']);
        $this->assertEquals((object) ['min' => 0, 'max' => 100, 'tickAmount' => 5, 'show' => false], $options['yaxis']);
        $this->assertEquals((object) ['show' => false], $options['grid']);
        $this->assertEquals((object) ['show' => false], $options['markers']);
        $this->assertEquals(['show' => 'false'], $options['legend']);
        $this->assertEquals([
            'hover' => ['filter' => ['type' => LarapexChart::STATE_NONE]],
            'active' => [
                'allowMultipleDataPointsSelection' => true,
                'filter' => ['type' => LarapexChart::STATE_LIGHTEN],
            ],
        ], $options['states']);
        $this->assertEquals(['North', 'South'], $options['labels']);
        $this->assertEquals((object) [
            'show' => true,
            'width' => 2,
            'colors' => ['#333333'],
            'curve' => 'smooth',
        ], $options['stroke']);
    }

    #[Test]
    public function it_tests_script_render_preserves_configured_options_without_duplicate_yaxis(): void
    {
        $chart = $this->chartWithConfiguredOutputOptions();

        $script = $chart->script()->render();

        $this->assertSame(1, substr_count($script, 'yaxis:'));
        $this->assertStringContainsString("id: '{$chart->id()}'", $script);
        $this->assertStringContainsString("type: 'bar'", $script);
        $this->assertStringContainsString('height: 320', $script);
        $this->assertStringContainsString("width: '640'", $script);
        $this->assertStringContainsString('toolbar: {"show":true}', $script);
        $this->assertStringContainsString('zoom: {"enabled":false}', $script);
        $this->assertStringContainsString('sparkline: {"enabled":true}', $script);
        $this->assertStringContainsString('stacked: 1', $script);
        $this->assertStringContainsString('colors: ["#111111","#222222"]', $script);
        $this->assertStringContainsString('series: [{"name":"Revenue","data":[10,20]}]', $script);
        $this->assertStringContainsString('dataLabels: {"enabled":true}', $script);
        $this->assertStringContainsString('labels: ["North","South"]', $script);
        $this->assertStringContainsString('xaxis: {"type":"category","categories":["Jan","Feb"],"labels":{"show":true}}', $script);
        $this->assertStringContainsString('yaxis: {"min":0,"max":100,"tickAmount":5,"show":false}', $script);
        $this->assertStringContainsString('grid: {"show":false}', $script);
        $this->assertStringContainsString('markers: {"show":false}', $script);
        $this->assertStringContainsString('stroke: {"show":true,"width":2,"colors":["#333333"],"curve":"smooth"}', $script);
        $this->assertStringContainsString('show: false', $script);
        $this->assertStringContainsString('"hover":{"filter":{"type":"none"}}', $script);
        $this->assertStringContainsString('"active":{"allowMultipleDataPointsSelection":true,"filter":{"type":"lighten"}}', $script);
    }

    private function chartWithConfiguredOutputOptions(): LarapexChart
    {
        return (new LarapexChart)->barChart()
            ->setTitle('Revenue')
            ->setSubtitle('Quarterly', 'right')
            ->setHeight(320)
            ->setWidth(640)
            ->setHorizontal(true)
            ->setStacked(true)
            ->setColors(['#111111', '#222222'])
            ->setXAxis(['Jan', 'Feb'])
            ->setYAxis(0, 100, 5, false)
            ->setLabels(['North', 'South'])
            ->setStroke(2, ['#333333'], 'smooth')
            ->setToolbar(true, false)
            ->setDataLabels(true)
            ->setTheme('dark')
            ->setSparkline(true)
            ->setShowLegend(false)
            ->setStatesHover(LarapexChart::STATE_NONE)
            ->setStatesActive(LarapexChart::STATE_LIGHTEN, true)
            ->addData([10, 20], 'Revenue');
    }

    #[Test]
    public function it_tests_di_injected_instance_produces_independent_charts(): void
    {
        // Simulates: public function __construct(LarapexChart $chart) { $this->chart = $chart; }
        $shared = $this->app->make(LarapexChart::class);

        // Two charts created from the same DI-injected instance
        $vue1 = $shared->donutChart()
            ->setTitle('Unsubscribed Users')
            ->addData([60, 14, 55])
            ->setLabels(['Jan', 'Feb', 'Mar'])
            ->toVue();

        $vue2 = $shared->areaChart()
            ->setTitle('Monthly Revenue')
            ->setXAxis(['Jan', 'Feb', 'Mar'])
            ->addData([1000, 2000, 3000], 'Revenue')
            ->toVue();

        // Must be completely independent
        $this->assertNotEquals($vue1['options']['chart']['id'], $vue2['options']['chart']['id']);
        $this->assertEquals('donut', $vue1['type']);
        $this->assertEquals('area', $vue2['type']);
        $this->assertEquals('Unsubscribed Users', $vue1['options']['title']['text']);
        $this->assertEquals('Monthly Revenue', $vue2['options']['title']['text']);
    }
}
