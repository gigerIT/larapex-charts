<?php


namespace ArielMejiaDev\LarapexCharts\Traits;


use ArielMejiaDev\LarapexCharts\LarapexChart;

trait SimpleChartDataAggregator
{
    /**
     * @param array<int, mixed> $data
     */
    public function addData(array $data) :self
    {
        $this->dataset = json_encode($data);

        return $this;
    }
}
