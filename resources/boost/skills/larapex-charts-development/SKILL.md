---
name: larapex-charts-development
description: Use when working with Larapex Charts in Laravel apps, including chart builders, Blade rendering, JSON or Vue chart output, make:chart stubs, published assets, or config for gigerit/larapex-charts.
---

# Larapex Charts Development

## Core Rules

Larapex Charts is a Laravel wrapper around ApexCharts. The maintained package is installed as `gigerit/larapex-charts`, but its public PHP namespace remains `ArielMejiaDev\LarapexCharts` for drop-in compatibility with the original package.

- Do not rename imports to `Gigerit\...`; use `ArielMejiaDev\LarapexCharts\...`.
- Prefer the facade or factory methods over hard-coding chart types manually.
- Keep chart setup in controllers, view models, Livewire components, or generated chart classes, and render the returned chart in Blade or return JSON/Vue output as needed.
- Include ApexCharts once on pages that render Blade charts, either from `$chart->cdn()` or the published local asset.

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

## Configuration and Publishing

Publish only what the application needs:

```bash
php artisan vendor:publish --tag=larapex-charts-config
php artisan vendor:publish --tag=larapex-charts-views
php artisan vendor:publish --tag=larapex-charts-apexcharts-script
php artisan vendor:publish --tag=larapex-charts-stubs
```

The config file controls default `font_family`, `font_color`, and chart colors. Prefer config defaults for app-wide styling and per-chart setters such as `setColors()`, `setFontFamily()`, and `setFontColor()` for chart-specific overrides.

## Generated Chart Classes

Use the package command when the app should keep chart construction in `app/Charts`:

```bash
php artisan make:chart MonthlyUsersChart
php artisan make:chart MonthlyUsersChart --vue
php artisan make:chart MonthlyUsersChart --json
```

The command asks for a chart type and resolves custom app stubs from `stubs/charts/...` before falling back to the package stubs. If published stubs are customized, keep the selected output type consistent with the route or frontend surface that consumes it.
