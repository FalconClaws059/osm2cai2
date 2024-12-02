<?php

namespace App\Nova\Metrics;

use App\Models\HikingRoute;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;

class IssueLastUpdatePerMonth extends Trend
{
    /**
     * Get the displayable name of the metric
     *
     * @return string
     */
    public function name()
    {
        return 'Hiking Routes Issue Update per month';
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->countByMonths($request, HikingRoute::select(DB::raw('DATE(issues_last_update) as date'))->groupBy(DB::raw('DATE(issues_last_update)')))
            ->format('0,0');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            1 => __('1 Month'),
            3 => __('3 Months'),
            6 => __('6 Months'),
            9 => __('9 Months'),
            12 => __('12 Months'),
            24 => __('24 Months'),
            36 => __('36 Months'),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'issue-last-update-per-month';
    }
}
