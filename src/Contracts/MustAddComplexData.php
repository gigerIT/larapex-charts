<?php


namespace ArielMejiaDev\LarapexCharts\Contracts;


interface MustAddComplexData
{
    /**
     * @param array<int, mixed> $data
     */
    public function addData(array $data, ?string $name = '') :self;
}
