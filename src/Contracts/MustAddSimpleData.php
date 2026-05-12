<?php

declare(strict_types=1);

namespace ArielMejiaDev\LarapexCharts\Contracts;


interface MustAddSimpleData
{
    /**
     * @param array<int, mixed> $data
     */
    public function addData(array $data) :self;
}
