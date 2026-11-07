# Keep the chart-type and make:chart stub structure

An architecture review in November 2026 proposed four restructurings around chart types and `make:chart` stubs, and we rejected all four. Each one either breaks something apps depend on without a matching gain, or moves complexity around instead of removing it. These areas stay on non-breaking 10.x releases. The review's narrower fixes did land: setters return `static`, `ChartMakeCommand` owns its stub lookup, and `--vue` with `--json` is rejected.

## Considered Options

- **One chart-type list, such as a `ChartType` enum, read by `make:chart` and the tests.** Rejected. Each remaining place that names a chart type holds a different fact: the subclass, the factory method, the facade `@method`, the command choice, the stubs, and the test lists. The test lists are an independent spec on purpose, and deriving them from the same list would make the tests circular.
- **One stub per chart type, with placeholders for the Default, Json and Vue variants.** Rejected. Apps publish `stubs/charts/{Default|Json|Vue}/{Name}.stub`, and their copies take precedence. That layout is a consumer interface documented in the Boost skill. Keeping old copies working would add placeholder rendering and a second lookup layout to `ChartMakeCommand`, which moves the duplication out of rarely edited stubs and into code.
- **Deleting the `MustAddSimpleData` and `MustAddComplexData` contracts.** Rejected. Nothing in the package calls them, but they are public. Deleting them gains callers nothing and needs a major release.
- **Separating the factory from the chart.** Rejected. `LarapexChart` both builds charts and is a chart, and the facade binding and dependency-injected `LarapexChart` instances rely on calling factory methods on a chart object.

## Consequences

Reopen this if new chart types start arriving regularly, or when a major release is planned for other reasons.
