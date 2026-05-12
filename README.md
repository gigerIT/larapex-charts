# Larapex Charts

<p align="center">

[![Latest Stable Version](https://poser.pugx.org/gigerit/larapex-charts/v/stable)](https://packagist.org/packages/gigerit/larapex-charts)

[![Total Downloads](https://poser.pugx.org/gigerit/larapex-charts/downloads)](https://packagist.org/packages/gigerit/larapex-charts)

![GitHub Actions](https://github.com/gigerit/larapex-charts/actions/workflows/ci.yml/badge.svg)

[![License](https://poser.pugx.org/gigerit/larapex-charts/license)](https://packagist.org/packages/gigerit/larapex-charts)
  
</p>

Larapex Charts is a Laravel wrapper for the ApexCharts JavaScript charting
library.

This package is the gigerIT-maintained fork of
`arielmejiadev/larapex-charts`. It continues the original package with ongoing
maintenance, compatibility updates, code cleanups, optimizations, and support
for current Laravel versions, including Laravel 13.

It is a drop-in replacement for the original package. Existing applications do
not need code changes, namespace changes, config changes, or view changes. The
public API, service provider, facade, publishable assets, and generated chart
stubs remain compatible with the original package.

Check the upstream documentation on:
[Larapex Chart Docs](https://larapex-charts.netlify.app/).

## About this fork

This fork keeps Larapex Charts usable in modern Laravel applications while
preserving the original developer experience. The goal is to provide a reliable
maintenance path for projects that already depend on Larapex Charts and for new
projects that want the same simple chart-building API.

Maintained improvements include:

- Laravel 13 compatibility, alongside the currently supported Laravel versions.
- Composer metadata updates so the package can be installed as
  `gigerit/larapex-charts` from Packagist.
- Package cleanups to remove generated files, IDE metadata, logs, test reports,
  and other local artifacts from distributed releases.
- Repository and release hygiene improvements for cleaner installs and more
  predictable package archives.
- Ongoing maintenance, fixes, and optimizations while keeping the package
  compatible with existing usage.

## Drop-in replacement

Use this fork when you want a maintained version of Larapex Charts without
rewriting existing application code.

If your application currently uses `arielmejiadev/larapex-charts`, replace the
Composer dependency with this fork:

```bash
composer remove arielmejiadev/larapex-charts
composer require gigerit/larapex-charts
```

No PHP imports need to change. Continue using the existing namespace:

```php
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
```

The package also declares a Composer replacement for the original package name,
so downstream packages that require `arielmejiadev/larapex-charts` can be
satisfied by this fork.

## Installation

Install the maintained fork with Composer:

```bash
composer require gigerit/larapex-charts
```

## Usage

### Basic example

In your controller add:

```php
$chart = (new LarapexChart)->setTitle('Posts')
                   ->setDataset([150, 120])
                   ->setLabels(['Published', 'No Published']);

```

Remember to import the Facade to your controller with:

```php
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
```

Or importing the LarapexChart class:

```php
use ArielMejiaDev\LarapexCharts\LarapexChart;
```

Then in your view (Blade file) add:

```php
 <!doctype html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport"
           content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Chart Sample</title>
 </head>
 <body>
 
     {!! $chart->container() !!}
 
     <script src="{{ $chart->cdn() }}"></script>
 
     {{ $chart->script() }}
 </body>
 </html>
```

### More complex example

```php
$chart = (new LarapexChart)->setType('area')
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
        ]);
```

You can create a variety of charts including: Line, Area, Bar, Horizontal Bar, Heatmap, pie, donut and Radialbar.

## More examples

Check the documentation on: [Larapex Chart Docs](https://larapex-charts.netlify.app/)

## Contributing

This fork is maintained by gigerIT. Contributions that improve compatibility,
reliability, tests, documentation, or package hygiene are welcome.

The package was originally created by Ariel Mejia Dev. This fork preserves the
original package API and credits while continuing maintenance for modern Laravel
projects.

## License
[MIT](./LICENSE.md)

## Roadmap for future versions

- [ ] Add blade directive `@apexchartscdn`
- [ ] Add blade directive `@script($chart)`
- [ ] Add a chain options setter for charts
- [ ] Update Github Actions to run tests
- [ ] Update the package in general for more efficient & modern practices (spatie skeleton package)
- [ ] Add ReactJS + Inertia Support
- [ ] Add More complex charts
- [ ] Add More complex boilerplate code using Laravel/Prompts
- [ ] Add more complex boilerplate code examples using Laravel Trends Package
