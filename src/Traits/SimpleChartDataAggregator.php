<?php

namespace ArielMejiaDev\LarapexCharts\Traits;

trait SimpleChartDataAggregator
{
    /**
     * @param  array<int, mixed>  $data
     */
    public function addData(array $data): static
    {
        $this->dataset = $data;

        return $this;
    }
}
