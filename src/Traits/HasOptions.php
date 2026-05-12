<?php
namespace ArielMejiaDev\LarapexCharts\Traits;
trait HasOptions{
    /** @var array<string, mixed>|null */
    protected ?array $options = null;

        /**
     * Get the value of options
     *
     * @return array<string, mixed>
     */ 
    public function getOptions(): array
    {
        return $this->options ? array_merge_recursive($this->getDefaultOption() ,$this->options) : $this->getDefaultOption();
    }

    /**
     * Set the value of options
     *
     * @param array<string, mixed> $options
     * @return  self
     */ 
    public function setOptions(array $options): self
    {
        $this->options = $options;

        return $this;
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
                'text' => $this->title()
            ],
            'subtitle' => [
                'text' => $this->subtitle() ? $this->subtitle() : '',
                'align' => $this->subtitlePosition() ? $this->subtitlePosition() : '',
            ],            
            'xaxis' => [
                'categories' => $this->decode($this->xAxis()),
            ],
            'grid' => $this->decode($this->grid()),
            'markers' => $this->decode($this->markers()),
        ];
    }
}
