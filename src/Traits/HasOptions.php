<?php

namespace ArielMejiaDev\LarapexCharts\Traits;

trait HasOptions
{
    /** @var array<string, mixed>|null */
    protected ?array $options = null;

    /**
     * Get the value of options
     *
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return $this->options ? $this->replaceOptions($this->getDefaultOption(), $this->options) : $this->getDefaultOption();
    }

    /**
     * Set the value of options
     *
     * @param  array<string, mixed>  $options
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @param  array<string, mixed>  $defaults
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function replaceOptions(array $defaults, array $overrides): array
    {
        foreach ($overrides as $key => $value) {
            if (
                $this->isAssociativeArray($value)
                && isset($defaults[$key])
                && $this->isAssociativeArray($defaults[$key])
            ) {
                $defaults[$key] = $this->replaceOptions($defaults[$key], $value);

                continue;
            }

            $defaults[$key] = $value;
        }

        return $defaults;
    }

    /**
     * @phpstan-assert-if-true array<string, mixed> $value
     */
    private function isAssociativeArray(mixed $value): bool
    {
        return is_array($value) && ! array_is_list($value);
    }

    /**
     * @return array<string, mixed>
     */
    private function getDefaultOption(): array
    {
        return [
            'chart' => [
                'type' => $this->type(),
                'height' => $this->height(),
                'width' => $this->width(),
                'toolbar' => $this->decode($this->toolbar()),
                'zoom' => $this->decode($this->zoom()),
                'fontFamily' => $this->decode($this->fontFamily()),
                'foreColor' => $this->foreColor(),
            ],
            'plotOptions' => [
                'bar' => $this->decode($this->horizontal()),
            ],
            'colors' => $this->decode($this->colors()),
            'series' => $this->decode($this->dataset()),
            'dataLabels' => $this->decode($this->dataLabels()),
            'title' => [
                'text' => $this->title(),
            ],
            'subtitle' => [
                'text' => $this->subtitle() ?: '',
                'align' => $this->subtitlePosition() ?: '',
            ],
            'xaxis' => [
                'categories' => $this->decode($this->xAxis()),
            ],
            'grid' => $this->decode($this->grid()),
            'markers' => $this->decode($this->markers()),
        ];
    }
}
