<?php

declare(strict_types=1);

namespace ArielMejiaDev\LarapexCharts\Facades;

use ArielMejiaDev\LarapexCharts\AreaChart;
use ArielMejiaDev\LarapexCharts\BarChart;
use ArielMejiaDev\LarapexCharts\DonutChart;
use ArielMejiaDev\LarapexCharts\HeatMapChart;
use ArielMejiaDev\LarapexCharts\HorizontalBar;
use ArielMejiaDev\LarapexCharts\LineChart;
use ArielMejiaDev\LarapexCharts\PieChart;
use ArielMejiaDev\LarapexCharts\PolarAreaChart;
use ArielMejiaDev\LarapexCharts\RadarChart;
use ArielMejiaDev\LarapexCharts\RadialChart;
use Illuminate\Support\Facades\Facade;

/**
 * @method static PieChart pieChart()
 * @method static DonutChart donutChart()
 * @method static RadialChart radialChart()
 * @method static PolarAreaChart polarAreaChart()
 * @method static LineChart lineChart()
 * @method static AreaChart areaChart()
 * @method static BarChart barChart()
 * @method static HorizontalBar horizontalBarChart()
 * @method static HeatMapChart heatMapChart()
 * @method static RadarChart radarChart()
 */
class LarapexChart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'larapex-chart';
    }
}
