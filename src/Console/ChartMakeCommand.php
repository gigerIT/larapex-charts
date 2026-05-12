<?php

namespace ArielMejiaDev\LarapexCharts\Console;

use ArielMejiaDev\LarapexCharts\Traits\WithModelStub;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ChartMakeCommand extends GeneratorCommand
{
    use WithModelStub;

    /** @var array<string, string> */
    protected array $chartTypes = [
        'Pie Chart' => 'PieChart',
        'Donut Chart' => 'DonutChart',
        'Radial Bar Chart' => 'RadialBarChart',
        'Polar Area Chart' => 'PolarAreaChart',
        'Line Chart' => 'LineChart',
        'Area Chart' => 'AreaChart',
        'Bar Chart' => 'BarChart',
        'Horizontal Bar Chart' => 'HorizontalBarChart',
        'Heatmap Chart' => 'HeatMapChart',
        'Radar Chart' => 'RadarChart',
    ];

    protected string $selectedChart;

    protected function askChartType(): void
    {
        $option = $this->choice(
            'Select a chart type',
            array_keys($this->chartTypes),
        );

        if (! is_string($option) || ! array_key_exists($option, $this->chartTypes)) {
            throw new \UnexpectedValueException('Invalid chart type selected.');
        }

        $this->selectedChart = $this->chartTypes[$option];
    }

    #[\Override]
    public function handle(): ?bool
    {
        $this->askChartType();
        return parent::handle();
    }

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:chart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a chart class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Chart class';

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        $directory = 'Default';

        if ($this->option('vue')) {
            $directory = 'Vue';
        }

        if ($this->option('json')) {
            $directory = 'Json';
        }

        $stub = sprintf('%s/%s.stub', $directory, $this->selectedChart);

        return $this->resolveStubPath($stub);
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     */
    #[\Override]
    protected function replaceClass($stub, $name): string
    {
        $stub = parent::replaceClass($stub, $name);

        $className = class_basename(str_replace('\\', '/', $name));

        return str_replace('{{ name }}', $className, $stub);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    #[\Override]
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Charts';
    }

    /**
     * Get the console command arguments.
     *
     * @return list<array{string, int, string}>
     */
    #[\Override]
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the chart class.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return list<array{string, string, int, string}>
     */
    #[\Override]
    protected function getOptions(): array
    {
        return [
            ['vue', 'vue', InputOption::VALUE_NONE, 'Creates a chart class for a vue component.'],
            ['json', 'json', InputOption::VALUE_NONE, 'Creates a chart class for a json API response.'],
        ];
    }
}
