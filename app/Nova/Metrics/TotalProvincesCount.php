<?php

namespace App\Nova\Metrics;

use App\Models\Province;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class TotalProvincesCount extends Value
{
    /**
     * Set card's label
     * @return string
     */
    public function name()
    {
        return 'Numero Province'; // TODO: Change the autogenerated stub
    }

    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->result(Province::all('id')->count());
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        return now()->addMinutes(60 * 24);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'total-provinces-number';
    }
}
