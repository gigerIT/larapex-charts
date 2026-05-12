<?php

namespace ArielMejiaDev\LarapexCharts\Traits;

trait SimpleChartDataAggregator
{
    /**
     * @param  array<int, mixed>  $data
     */
    public function addData(array $data): self
    {
        $this->dataset = $this->encode($data);

        return $this;
    }
}
