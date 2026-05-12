---
name: larapex-charts-development
description: Use when working with Larapex Charts in Laravel apps, including chart builders, Blade rendering, JSON or Vue chart output, make:chart stubs, published assets, or config for gigerit/larapex-charts.
---

# Larapex Charts Development

## Core Rules

Larapex Charts is a Laravel wrapper around ApexCharts. The maintained package is installed as `gigerit/larapex-charts`, but its public PHP namespace remains `ArielMejiaDev\LarapexCharts` for drop-in compatibility with the original package.

- Do not rename imports to `Gigerit\...`; use `ArielMejiaDev\LarapexCharts\...`.
- Treat older docs that mention `arielmejiadev/larapex-charts`, `config/larapex-chart.php`, `stubs/API`, or `larapex-charts-apexcharts-stubs` as legacy wording. In this repo use `gigerit/larapex-charts`, `config/larapex-charts.php`, `stubs/charts/Json`, and `larapex-charts-stubs`.
- Prefer the facade or factory methods over hard-coding chart types manually.
- Keep chart setup in controllers, view models, Livewire components, or generated chart classes, and render the returned chart in Blade or return JSON/Vue output as needed.
- Include ApexCharts once on pages that render Blade charts, either from `$chart->cdn()` or the published local asset.
- Prefer current builder methods in this repo over stale docs snippets. Use `addData($data, $name)` for complex charts; do not introduce undocumented `addLine()` or `addArea()` helpers unless they exist in the installed version.

## Creating Charts

Use the facade or a `LarapexChart` instance and start with a chart-specific factory method:

```php
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

$chart = LarapexChart::lineChart()
    ->setTitle('Monthly Signups')
    ->setSubtitle('Current year')
    ->setXAxis(['Jan', 'Feb', 'Mar'])
    ->addData([42, 58, 75], 'Users');
```

Simple charts use a flat dataset plus labels:

```php
$chart = LarapexChart::donutChart()
    ->setTitle('Posts')
    ->setLabels(['Published', 'Draft'])
    ->addData([150, 40]);
```

Complex charts use one or more named series:

```php
$chart = LarapexChart::barChart()
    ->setTitle('Revenue')
    ->setXAxis(['Q1', 'Q2', 'Q3'])
    ->addData([12000, 18000, 21000], 'Subscriptions')
    ->addData([3000, 5000, 6500], 'Services');
```

Available factories are `pieChart()`, `donutChart()`, `radialChart()`, `polarAreaChart()`, `lineChart()`, `areaChart()`, `barChart()`, `horizontalBarChart()`, `heatMapChart()`, and `radarChart()`.

Use simple charts for proportions and category totals: `pieChart()`, `donutChart()`, `radialChart()`, and `polarAreaChart()` take one flat `addData([...])` call plus `setLabels([...])`. Use complex charts for time series or comparable groups: `lineChart()`, `areaChart()`, `barChart()`, `horizontalBarChart()`, `heatMapChart()`, and `radarChart()` take one or more `addData([...], 'Series name')` calls and usually `setXAxis([...])`.

## Rendering

For Blade output, pass the chart to the view and render the container, ApexCharts script, and chart script:

```blade
{!! $chart->container() !!}

<script src="{{ $chart->cdn() }}"></script>
{!! $chart->script() !!}
```

Use `toJson()` when an endpoint should return ApexCharts options:

```php
return $chart->toJson();
```

Use `toVue()` when passing chart props to a Vue/ApexCharts component:

```php
$usersChart = $chart->toVue();
```

`toVue()` returns `height`, `width`, `type`, `options`, and `series`. A Vue component should pass those values to `vue3-apexcharts`/`apexchart` as props, for example `:type="chart.type"`, `:options="chart.options"`, and `:series="chart.series"`.

`toJson()` returns an `Illuminate\Http\JsonResponse` with `id` and `options`; `options` includes ApexCharts options and `series`, so it is the right output for Inertia-adjacent endpoints, React, Angular, or plain JavaScript consumers.

## Configuration and Publishing

Publish only what the application needs:

```bash
php artisan vendor:publish --tag=larapex-charts-config
php artisan vendor:publish --tag=larapex-charts-views
php artisan vendor:publish --tag=larapex-charts-apexcharts-script
php artisan vendor:publish --tag=larapex-charts-stubs
```

The config file controls default `font_family`, `font_color`, and chart colors. Prefer config defaults for app-wide styling and per-chart setters such as `setColors()`, `setFontFamily()`, and `setFontColor()` for chart-specific overrides.

Use `LarapexChart::COLOR_*` constants or hex strings for palettes. Available constants include `COLOR_OCEAN_BLUE`, `COLOR_MINT_GREEN`, `COLOR_AMBER_ORANGE`, `COLOR_CORAL_RED`, `COLOR_AMETHYST_PURPLE`, `COLOR_CYAN_SKY`, `COLOR_NAVY_BLUE`, `COLOR_ROSE_PINK`, `COLOR_SILVER_GRAY`, `COLOR_ROYAL_BLUE`, `COLOR_AZURE_BLUE`, `COLOR_TEAL_TURQUOISE`, and `COLOR_PERIWINKLE_BLUE`.

To host ApexCharts locally instead of using the CDN, publish `larapex-charts-apexcharts-script` and reference `public/vendor/larapex-charts/apexcharts.js` from Blade:

```blade
<script src="{{ asset('vendor/larapex-charts/apexcharts.js') }}"></script>
```

## Customization

Common chart-level setters:

- `setTitle($title)` and `setSubtitle($subtitle, $position = 'left')`.
- `setHeight($height)` and `setWidth($width)`; width is stored as a string.
- `setColors([...])` for explicit palettes and `setMonochromeColor(LarapexChart::COLOR_*)` for one-color intensity charts such as heatmaps.
- `setGrid($color = '#e5e5e5', $opacity = 0.1, $strokeDashArray = 5)` for line, area, and bar-style charts.
- `setMarkers($colors = [], $width = 4, $hoverSize = 7)` and `setDataLabels(true)` for point styling and visible values.
- `setYAxis($min, $max, $tickAmount = null, $show = true)` and `setXAxis($categories, $type = 'category')`; supported X-axis types are `category`, `numeric`, and `datetime`.
- `setSparkline(true)` for compact charts, `setShowLegend(false)`, `setShowXAxisLabels(false)`, and `setShowYAxisLabels(false)` to reduce visual chrome.
- `setStacked(true)` for line, area, bar, and horizontal bar charts.
- `setStatesHover(LarapexChart::STATE_*)` and `setStatesActive(LarapexChart::STATE_*, $allowMultipleSelections)` for hover/active filters. State constants are `STATE_DARKEN`, `STATE_LIGHTEN`, and `STATE_NONE`.
- `setStroke($width, $colors = [], $curve = 'straight')`, `setToolbar($show, $zoom = true)`, and `setTheme($theme)` when the target ApexCharts option is supported by the package.

## Generated Chart Classes

Use the package command when the app should keep chart construction in `app/Charts`:

```bash
php artisan make:chart MonthlyUsersChart
php artisan make:chart MonthlyUsersChart --vue
php artisan make:chart MonthlyUsersChart --json
```

The command asks for a chart type and resolves custom app stubs from `stubs/charts/...` before falling back to the package stubs. The selectable types are Pie, Donut, Radial Bar, Polar Area, Line, Area, Bar, Horizontal Bar, Heatmap, and Radar.

Generated chart classes live under `app/Charts` and can be injected into controllers:

```php
public function index(MonthlyUsersChart $chart)
{
    return view('users.index', ['chart' => $chart->build()]);
}
```

If published stubs are customized, keep the selected output type consistent with the route or frontend surface that consumes it. Blade stubs belong in `stubs/charts/Default`, Vue stubs in `stubs/charts/Vue`, and JSON/API stubs in `stubs/charts/Json`; deleting an app-level custom stub lets the command fall back to the package stub.

## Inertia and JavaScript Frontends

For Inertia with Vue 3, install `apexcharts` and `vue3-apexcharts`, register the plugin in the app bootstrap, generate charts with `php artisan make:chart MonthlyUsersChart --vue`, and return the built chart from the controller through `Inertia::render()`.

For non-Vue frontends, generate with `--json` or call `toJson()` from a route/controller. The client receives ApexCharts-compatible options and can instantiate ApexCharts directly.
