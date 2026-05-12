<?php

namespace ArielMejiaDev\LarapexCharts\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \ArielMejiaDev\LarapexCharts\PieChart pieChart()
 * @method static \ArielMejiaDev\LarapexCharts\DonutChart donutChart()
 * @method static \ArielMejiaDev\LarapexCharts\RadialChart radialChart()
 * @method static \ArielMejiaDev\LarapexCharts\PolarAreaChart polarAreaChart()
 * @method static \ArielMejiaDev\LarapexCharts\LineChart lineChart()
 * @method static \ArielMejiaDev\LarapexCharts\AreaChart areaChart()
 * @method static \ArielMejiaDev\LarapexCharts\BarChart barChart()
 * @method static \ArielMejiaDev\LarapexCharts\HorizontalBar horizontalBarChart()
 * @method static \ArielMejiaDev\LarapexCharts\HeatMapChart heatMapChart()
 * @method static \ArielMejiaDev\LarapexCharts\RadarChart radarChart()
 */
class LarapexChart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'larapex-chart';
    }
}
