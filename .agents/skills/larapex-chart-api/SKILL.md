---
name: larapex-chart-api
description: Use when adding or changing a LarapexChart setter, ApexCharts option, output builder (container/script/toJson/toVue), chart type, or make:chart stub in this package's source.
---

# Larapex Chart API

How chart state becomes ApexCharts options in `src/LarapexChart.php`, and every place a change must land. The consumer-facing usage guide is the distributed Boost skill at `resources/boost/skills/larapex-charts-development/SKILL.md`; it is a documentation outlet to keep in sync, not a guide for editing the package.

## State model

- Object-valued options live in `protected string` properties holding JSON produced by `encode()`. Getters return that encoded string; builders call `decode()`, which yields `stdClass`, so assert with `(object) [...]` in `toVue()` tests and plain arrays after `toJson()->getData(true)`.
- Scalar options (`$theme`, `$stacked`, `$height`, the `show*` flags) are stored raw.
- Defaults are set in the constructor, which reads `larapex-charts.*` config, as do `setMarkers()` and `setStroke()` when no colors are passed. A test that changes config must build its chart afterwards.
- Setters mutate and return the instance. The `set*` methods return `LarapexChart` or `self`; match the neighbours.

## Output pipeline

`apexOptions()` is the only options builder. It builds the full ApexCharts options, `chart` block and `series` included, then merges `setOptions()` overrides through `replaceOptions()`. Every output projects that one array:

| Output | Entry point | Projection |
| --- | --- | --- |
| Blade | `script()` → `stubs/resources/views/chart/script.blade.php` → `toScriptOptions()` | the options whole |
| JSON | `toJson()`; `getOptions()` returns the same options | `{id, options}` |
| Vue | `toVue()` | `height`, `width`, `type`, and `series` lifted from the merged options as props, which take precedence in `vue3-apexcharts`; `options` without `series` |

ApexCharts reads options by truthiness, so outputs must carry real booleans and objects: the string `'false'` or an encoded JSON string silently enables or ignores an option. `it_tests_configured_chart_builds_every_apex_option` and `it_tests_default_chart_builds_default_apex_options` in `tests/Feature/ChartsTest.php` pin the full options as JSON delivers them; one short test per output pins its projection. A change to public output updates the golden assertion in the same commit, and the commit message describes it.

## Adding or changing an option

Done means every step below is satisfied:

1. Property with a constructor default; setter returning the instance, with PHPStan array shapes on array params.
2. Wire it into `apexOptions()`; every output picks it up.
3. Set it in `chartWithConfiguredOutputOptions()` and assert it in both golden tests.
4. Document it in `README.md` and in the Boost skill's setter list.

## Adding a chart type

1. Thin subclass in `src/` (type set in the constructor), implementing `MustAddSimpleData` with `SimpleChartDataAggregator` or `MustAddComplexData` with `ComplexChartDataAggregator`.
2. Factory method on `LarapexChart` and a matching `@method static` line on `src/Facades/LarapexChart.php`.
3. Entry in `ChartMakeCommand::$chartTypes`, then `Default`, `Json`, and `Vue` stubs in `src/stubs/charts/`.
4. Tests: a render test in `tests/Feature/ChartsTest.php`. In `tests/Unit/ChartsTest.php`, add the choice to `MAKE_CHART_CHOICES`, which generates and runs the new stubs, and the stub name to `it_tests_larapex_charts_install_add_chart_stubs`.
5. Add the factory to the README and to the Boost skill's factory list.

## Stubs

`src/stubs/charts/` is the only stub source. `vendor:publish --tag=larapex-charts-stubs` copies it to an app's `stubs/charts/`, and `WithModelStub::resolveStubPath()` prefers that app copy before falling back to the package file. `it_tests_make_chart_generates_runnable_chart_classes` generates every stub through `make:chart` on both paths and runs its `build()`.
