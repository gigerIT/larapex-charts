<?php

namespace ArielMejiaDev\LarapexCharts\Traits;

trait ComplexChartDataAggregator
{
    /**
     * @param array<int, mixed> $data
     */
    public function addData(array $data, ?string $name = '') :self
    {
        $dataset = json_decode($this->dataset);

        $dataset[] = [
            'name' => $name,
            'data' => $data
        ];

        $this->dataset = $this->encode($dataset);

        return $this;
    }
}
