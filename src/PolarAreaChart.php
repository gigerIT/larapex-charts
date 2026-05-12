<?php

declare(strict_types=1);

namespace ArielMejiaDev\LarapexCharts;

use ArielMejiaDev\LarapexCharts\Contracts\MustAddSimpleData;
use ArielMejiaDev\LarapexCharts\Traits\SimpleChartDataAggregator;

class PolarAreaChart extends LarapexChart implements MustAddSimpleData
{
    use SimpleChartDataAggregator;

    public function __construct()
    {
        parent::__construct();
        $this->type = 'polarArea';
    }
}
