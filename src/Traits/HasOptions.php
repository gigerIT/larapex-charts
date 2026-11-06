<?php

namespace ArielMejiaDev\LarapexCharts\Traits;

trait HasOptions
{
    /** @var array<string, mixed>|null */
    protected ?array $options = null;

    /**
     * Get the ApexCharts options toJson() sends, including setOptions() overrides.
     *
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return $this->apexOptions($this->jsonChartOptions(), true);
    }

    /**
     * Merge raw ApexCharts options over the generated options of every output.
     * Nested option objects merge key by key; lists and scalars replace.
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
            $current = $defaults[$key] ?? null;

            // Generated options hold decoded JSON objects; merge into them as arrays.
            if ($current instanceof \stdClass) {
                $current = get_object_vars($current);
            }

            if ($this->isAssociativeArray($value) && $this->isAssociativeArray($current)) {
                $defaults[$key] = $this->replaceOptions($current, $value);

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
}
