<?php

declare(strict_types=1);

namespace ArielMejiaDev\LarapexCharts;

use ArielMejiaDev\LarapexCharts\Contracts\MustAddComplexData;
use ArielMejiaDev\LarapexCharts\Traits\ComplexChartDataAggregator;

class BarChart extends LarapexChart implements MustAddComplexData
{
    use ComplexChartDataAggregator;

    public function __construct()
    {
        parent::__construct();
        $this->type = 'bar';
    }
}
