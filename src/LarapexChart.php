<?php

namespace ArielMejiaDev\LarapexCharts;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\View;

/**
 * @method LarapexChart addData(array<int, mixed> $array, ?string $name = null)
 */
class LarapexChart
{
    const COLOR_OCEAN_BLUE = '#008FFB';

    const COLOR_MINT_GREEN = '#00E396';

    const COLOR_AMBER_ORANGE = '#feb019';

    const COLOR_CORAL_RED = '#ff455f';

    const COLOR_AMETHYST_PURPLE = '#775dd0';

    const COLOR_CYAN_SKY = '#80effe';

    const COLOR_NAVY_BLUE = '#0077B5';

    const COLOR_ROSE_PINK = '#ff6384';

    const COLOR_SILVER_GRAY = '#c9cbcf';

    const COLOR_ROYAL_BLUE = '#0057ff';

    const COLOR_AZURE_BLUE = '#00a9f4';

    const COLOR_TEAL_TURQUOISE = '#2ccdc9';

    const COLOR_PERIWINKLE_BLUE = '#5e72e4';

    const STATE_DARKEN = 'darken';

    const STATE_LIGHTEN = 'lighten';

    const STATE_NONE = 'none';

    /*
    |--------------------------------------------------------------------------
    | Chart
    |--------------------------------------------------------------------------
    |
    | This class build the chart by passing setters to the object, it will
    | use the method container and scripts to generate a JSON
    | in blade views, it works also with Vue JS components
    |
    */

    public string $id;

    protected string $title = '';

    protected string $subtitle = '';

    protected string $subtitlePosition = 'left';

    protected string $type = 'donut';

    /** @var array<int, mixed> */
    protected array $labels = [];

    protected string $fontFamily;

    protected ?string $foreColor;

    /** @var array<int|string, mixed>|null */
    protected ?array $dataset = null;

    protected int $height = 500;

    protected string $width = '100%';

    /** @var array<int|string, mixed> */
    protected array $colors;

    /** @var array{horizontal: bool} */
    protected array $horizontal = ['horizontal' => false];

    /** @var array{type: string, categories: array<int, string|int|float>, labels: array{show: bool}} */
    protected array $xAxis;

    /** @var array{min: int|float, max: int|float, tickAmount: int|float, show: bool}|null */
    protected ?array $yAxis = null;

    /** @var array<string, mixed> */
    protected array $grid = ['show' => false];

    /** @var array<string, mixed> */
    protected array $markers = ['show' => false];

    protected bool $stacked = false;

    protected bool $showLegend = true;

    protected bool $showXAxisLabels = true;

    protected bool $showYAxisLabels = true;

    /** @var array{show: bool, width: int, colors: mixed, curve: string}|null */
    protected ?array $stroke = null;

    /** @var array{show: bool} */
    protected array $toolbar = ['show' => false];

    /** @var array{enabled: bool} */
    protected array $zoom = ['enabled' => true];

    /** @var array{enabled: bool} */
    protected array $dataLabels = ['enabled' => false];

    protected ?string $theme = 'light';

    /** @var array{enabled: bool} */
    protected array $sparkline = ['enabled' => false];

    private string $chartLetters = 'abcdefghijklmnopqrstuvwxyz';

    /** @var array{hover?: array{filter: array{type: string}}, active?: array{allowMultipleDataPointsSelection: bool, filter: array{type: string}}} */
    private array $states = [];

    /** @var array<string, mixed>|null */
    protected ?array $options = null;

    /*
    |--------------------------------------------------------------------------
    | Constructors
    |--------------------------------------------------------------------------
    */

    public function __construct()
    {
        $repeatCount = (int) ceil(25 / strlen($this->chartLetters));
        $this->id = substr(str_shuffle(str_repeat($this->chartLetters, $repeatCount)), 1, 25);
        $this->colors = config('larapex-charts.colors');
        $this->setXAxis([]);
        $this->fontFamily = config('larapex-charts.font_family');
        $this->foreColor = config('larapex-charts.font_color');
    }

    public function pieChart(): PieChart
    {
        return new PieChart;
    }

    public function donutChart(): DonutChart
    {
        return new DonutChart;
    }

    public function radialChart(): RadialChart
    {
        return new RadialChart;
    }

    public function polarAreaChart(): PolarAreaChart
    {
        return new PolarAreaChart;
    }

    public function lineChart(): LineChart
    {
        return new LineChart;
    }

    public function areaChart(): AreaChart
    {
        return new AreaChart;
    }

    public function barChart(): BarChart
    {
        return new BarChart;
    }

    public function horizontalBarChart(): HorizontalBar
    {
        return new HorizontalBar;
    }

    public function heatMapChart(): HeatMapChart
    {
        return new HeatMapChart;
    }

    public function radarChart(): RadarChart
    {
        return new RadarChart;
    }

    /*
    |--------------------------------------------------------------------------
    | Setters
    |--------------------------------------------------------------------------
    */
    public function setFontFamily(string $fontFamily): LarapexChart
    {
        $this->fontFamily = $fontFamily;

        return $this;
    }

    /**
     * Pass null to leave chart.foreColor unset so ApexCharts or the frontend theme decides.
     */
    public function setFontColor(?string $fontColor): LarapexChart
    {
        $this->foreColor = $fontColor;

        return $this;
    }

    /**
     * @param  array<int|string, mixed>  $dataset
     */
    public function setDataset(array $dataset): LarapexChart
    {
        $this->dataset = $dataset;

        return $this;
    }

    public function setHeight(int $height): LarapexChart
    {
        $this->height = $height;

        return $this;
    }

    public function setWidth(int|string $width): LarapexChart
    {
        $this->width = (string) $width;

        return $this;
    }

    /**
     * @param  array<int, string>  $colors
     */
    public function setColors(array $colors): LarapexChart
    {
        $this->colors = $colors;

        return $this;
    }

    public function setMonochromeColor(string $color): LarapexChart
    {
        $this->colors = [$color];

        return $this;
    }

    public function setHorizontal(bool $horizontal): LarapexChart
    {
        $this->horizontal = ['horizontal' => $horizontal];

        return $this;
    }

    public function setTitle(string $title): LarapexChart
    {
        $this->title = $title;

        return $this;
    }

    public function setSubtitle(string $subtitle, string $position = 'left'): LarapexChart
    {
        $this->subtitle = $subtitle;
        $this->subtitlePosition = $position;

        return $this;
    }

    /**
     * @param  array<int, mixed>  $labels
     */
    public function setLabels(array $labels): LarapexChart
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * @param  array<int, string|int|float>  $categories
     */
    public function setXAxis(array $categories, string $type = 'category'): LarapexChart
    {
        $this->xAxis = [
            'type' => $type,
            'categories' => $categories,
            'labels' => [
                'show' => $this->showXAxisLabels(),
            ],
        ];

        return $this;
    }

    /**
     * @param  string|bool  $color
     * @param  int|float  $opacity
     */
    public function setGrid($color = '#e5e5e5', $opacity = 0.1, int $strokeDashArray = 5): LarapexChart
    {
        $this->grid = [
            'show' => true,
            'strokeDashArray' => $strokeDashArray,
            'row' => [
                'colors' => [$color, 'transparent'],
                'opacity' => $opacity,
            ],
        ];

        return $this;
    }

    /**
     * @param  int|float  $min
     * @param  int|float  $max
     * @param  bool  $show
     */
    public function setYAxis($min, $max, ?int $tickAmount = null, $show = true): LarapexChart
    {
        $this->yAxis = [
            'min' => $min,
            'max' => $max,
            'tickAmount' => $tickAmount ?? $max,
            'show' => $show,
        ];

        return $this;
    }

    /**
     * @param  array<int, string>  $colors
     * @param  int|float  $width
     * @param  int|float  $hoverSize
     */
    public function setMarkers($colors = [], $width = 4, $hoverSize = 7): LarapexChart
    {
        if (empty($colors)) {
            $colors = config('larapex-charts.colors');
        }

        $this->markers = [
            'size' => $width,
            'colors' => $colors,
            'strokeColors' => '#fff',
            'strokeWidth' => $width / 2,
            'hover' => [
                'size' => $hoverSize,
            ],
        ];

        return $this;
    }

    /**
     * @param  array<int, string>  $colors
     */
    public function setStroke(int $width, array $colors = [], string $curve = 'straight'): LarapexChart
    {
        if ($colors === []) {
            $colors = config('larapex-charts.colors');
        }

        $this->stroke = [
            'show' => true,
            'width' => $width,
            'colors' => $colors,
            'curve' => $curve,
        ];

        return $this;
    }

    public function setToolbar(bool $show, bool $zoom = true): LarapexChart
    {
        $this->toolbar = ['show' => $show];
        $this->zoom = ['enabled' => $zoom];

        return $this;
    }

    public function setDataLabels(bool $enabled = true): LarapexChart
    {
        $this->dataLabels = ['enabled' => $enabled];

        return $this;
    }

    /**
     * Pass null to leave theme.mode unset so the frontend can choose light or dark.
     */
    public function setTheme(?string $theme): LarapexChart
    {
        $this->theme = $theme;

        return $this;
    }

    public function setSparkline(bool $enabled = true): LarapexChart
    {
        $this->sparkline = ['enabled' => $enabled];

        return $this;
    }

    public function setStacked(bool $stacked = true): LarapexChart
    {
        $this->stacked = $stacked;

        return $this;
    }

    public function setShowLegend(bool $showLegend = true): self
    {
        $this->showLegend = $showLegend;

        return $this;
    }

    public function setShowXAxisLabels(bool $showXAxisLabels = true): self
    {
        $this->showXAxisLabels = $showXAxisLabels;

        return $this;
    }

    public function setShowYAxisLabels(bool $showYAxisLabels = true): self
    {
        $this->showYAxisLabels = $showYAxisLabels;

        return $this;
    }

    public function setStatesHover(string $type = 'lighten'): self
    {
        $this->states['hover'] = [
            'filter' => [
                'type' => $type,
            ],
        ];

        return $this;
    }

    public function setStatesActive(string $type = 'darken', bool $allowMultipleDataPointsSelection = false): self
    {
        $this->states['active'] = [
            'allowMultipleDataPointsSelection' => $allowMultipleDataPointsSelection,
            'filter' => [
                'type' => $type,
            ],
        ];

        return $this;
    }

    /**
     * Merge raw ApexCharts options over the generated options of every output.
     * Nested option objects merge key by key; lists and scalars replace.
     *
     * @param  array<string, mixed>  $options
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    |
    | Getters of object-valued options return encoded JSON, which views
    | published from releases before the options builder print as-is.
    |
    */

    /**
     * @param  array<int, scalar|null>  $array
     */
    public function transformLabels(array $array): bool|string
    {
        $stringArray = array_filter($array, fn (bool|float|int|string|null $string): bool => (bool) $string);

        return json_encode(['"'.implode('","', $stringArray).'"']);
    }

    public function container(): ViewContract
    {
        return View::make('larapex-charts::chart.container', ['id' => $this->id()]);
    }

    public function script(): ViewContract
    {
        return View::make('larapex-charts::chart.script', ['chart' => $this]);
    }

    /**
     * Pinned to the ApexCharts major of the bundled stubs/public/apexcharts.js;
     * upgrade both together.
     */
    public static function cdn(): string
    {
        return 'https://cdn.jsdelivr.net/npm/apexcharts@8';
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function subtitle(): string
    {
        return $this->subtitle;
    }

    public function subtitlePosition(): string
    {
        return $this->subtitlePosition;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function fontFamily(): string
    {
        return $this->fontFamily;
    }

    public function foreColor(): ?string
    {
        return $this->foreColor;
    }

    /**
     * @return array<int, mixed>
     */
    public function labels(): array
    {
        return $this->labels;
    }

    public function dataset(): string
    {
        return $this->dataset === null ? '' : $this->encode($this->dataset);
    }

    public function height(): int
    {
        return $this->height;
    }

    public function width(): string
    {
        return $this->width;
    }

    public function colors(): string
    {
        return $this->encode($this->colors);
    }

    public function horizontal(): string
    {
        return $this->encode($this->horizontal);
    }

    public function xAxis(): string
    {
        return $this->encode($this->xAxis);
    }

    public function yAxis(): string
    {
        return $this->yAxis === null ? '' : $this->encode($this->yAxis);
    }

    public function grid(): string
    {
        return $this->encode($this->grid);
    }

    public function markers(): string
    {
        return $this->encode($this->markers);
    }

    public function stroke(): string
    {
        return $this->stroke === null ? '' : $this->encode($this->stroke);
    }

    public function toolbar(): string
    {
        return $this->encode($this->toolbar);
    }

    public function zoom(): string
    {
        return $this->encode($this->zoom);
    }

    public function dataLabels(): string
    {
        return $this->encode($this->dataLabels);
    }

    public function sparkline(): string
    {
        return $this->encode($this->sparkline);
    }

    public function stacked(): bool
    {
        return $this->stacked;
    }

    public function showLegend(): string
    {
        return $this->showLegend ? 'true' : 'false';
    }

    public function shouldShowLegend(): bool
    {
        return $this->showLegend;
    }

    public function showXAxisLabels(): bool
    {
        return $this->showXAxisLabels;
    }

    public function showYAxisLabels(): bool
    {
        return $this->showYAxisLabels;
    }

    /**
     * @return array{states: array{hover: array{filter: array{type: string}}, active: array{allowMultipleDataPointsSelection: bool, filter: array{type: string}}}}
     */
    public function states(): array
    {
        return [
            'states' => [
                'hover' => $this->states['hover'] ?? [
                    'filter' => [
                        'type' => 'lighten',
                    ],
                ],
                'active' => $this->states['active'] ?? [
                    'allowMultipleDataPointsSelection' => false,
                    'filter' => [
                        'type' => 'darken',
                    ],
                ],
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Outputs
    |--------------------------------------------------------------------------
    |
    | Every output is built from apexOptions(): Blade and JSON emit the
    | options whole, and toVue() lifts the component props out of them.
    |
    */

    /**
     * @return array<string, mixed>
     */
    public function toScriptOptions(): array
    {
        return $this->apexOptions();
    }

    /**
     * Get the ApexCharts options of every output, including setOptions() overrides.
     *
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return $this->apexOptions();
    }

    public function toJson(): JsonResponse
    {
        return response()->json([
            'id' => $this->id(),
            'options' => $this->apexOptions(),
        ]);
    }

    /**
     * The Vue component's height, width, type, and series props take precedence
     * over the same keys in options, so they are lifted from the merged options
     * and carry any setOptions() overrides. Series is not sent twice.
     *
     * @return array{height: int|string, width: int|string, type: string, options: array<string, mixed>, series: mixed}
     */
    public function toVue(): array
    {
        $options = $this->apexOptions();
        $series = $options['series'] ?? null;
        unset($options['series']);
        $chart = is_array($options['chart'] ?? null) ? $options['chart'] : [];

        return [
            'height' => $chart['height'] ?? $this->height(),
            'width' => $chart['width'] ?? $this->width(),
            'type' => $chart['type'] ?? $this->type(),
            'options' => $options,
            'series' => $series,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | ApexCharts Options Builder
    |--------------------------------------------------------------------------
    */

    /**
     * @return array<string, mixed>
     */
    private function apexOptions(): array
    {
        $chart = [
            'id' => $this->id(),
            'type' => $this->type(),
            'height' => $this->height(),
            'width' => $this->width(),
            'toolbar' => $this->toolbar,
            'zoom' => $this->zoom,
            'fontFamily' => $this->fontFamily(),
            'sparkline' => $this->sparkline,
            'stacked' => $this->stacked(),
        ];

        if ($this->foreColor !== null) {
            $chart['foreColor'] = $this->foreColor;
        }

        $options = [
            'chart' => $chart,
            'plotOptions' => [
                'bar' => $this->horizontal,
            ],
            'colors' => $this->colors,
            'series' => $this->dataset,
            'dataLabels' => $this->dataLabels,
        ];

        if ($this->theme !== null) {
            $options['theme'] = [
                'mode' => $this->theme,
            ];
        }

        $options['title'] = [
            'text' => $this->title(),
        ];
        $options['subtitle'] = [
            'text' => $this->subtitle(),
            'align' => $this->subtitlePosition(),
        ];
        $options['xaxis'] = $this->xAxis;
        $options['yaxis'] = [
            'labels' => [
                'show' => $this->showYAxisLabels(),
            ],
        ];
        $options['grid'] = $this->grid;
        $options['markers'] = $this->markers;
        $options['legend'] = [
            'show' => $this->shouldShowLegend(),
        ];
        $options['states'] = $this->states()['states'];

        if ($this->labels()) {
            $options['labels'] = $this->labels();
        }

        if ($this->stroke !== null) {
            $options['stroke'] = $this->stroke;
        }

        if ($this->yAxis !== null) {
            $options['yaxis'] = $this->yAxis;
        }

        return $this->options === null ? $options : $this->replaceOptions($options, $this->options);
    }

    /**
     * @param  array<string, mixed>  $defaults
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function replaceOptions(array $defaults, array $overrides): array
    {
        foreach ($overrides as $key => $value) {
            $current = $defaults[$key] ?? null;

            if ($this->isAssociativeArray($value) && $this->isAssociativeArray($current)) {
                $defaults[$key] = $this->replaceOptions($current, $value);

                continue;
            }

            $defaults[$key] = $value;
        }

        return $defaults;
    }

    /**
     * @phpstan-assert-if-true array<string, mixed> $value
     */
    private function isAssociativeArray(mixed $value): bool
    {
        return is_array($value) && ! array_is_list($value);
    }

    protected function encode(mixed $value): string
    {
        return json_encode($value, JSON_THROW_ON_ERROR);
    }
}
