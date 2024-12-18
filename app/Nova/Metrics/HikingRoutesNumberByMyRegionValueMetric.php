<?php

namespace App\Nova\Metrics;

use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class HikingRoutesNumberByMyRegionValueMetric extends Value
{
    public $name = '#percorsi (status 1+2+3+4)';

    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->result(count(Auth::user()->region->hikingRoutes->whereIn('osm2cai_status', [1, 2, 3, 4])))
            ->format('0');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
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
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'hiking-routes-number-by-my-region-value-metric';
    }
}