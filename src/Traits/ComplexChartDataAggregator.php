<?php

namespace ArielMejiaDev\LarapexCharts\Traits;

trait ComplexChartDataAggregator
{
    /**
     * @param  array<int, mixed>  $data
     */
    public function addData(array $data, ?string $name = ''): static
    {
        $this->dataset[] = [
            'name' => $name,
            'data' => $data,
        ];

        return $this;
    }
}
