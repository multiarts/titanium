<?php

namespace App\EloquentFilters\Chamados;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class DateFilter extends Filter
{
    /**
     * Apply the condition to the query.
     *
     * @param Builder $builder
     * @param mixed $date
     *
     * @return Builder
     */
    public function apply(Builder $builder, $date): Builder
    {
        list('from_date' => $fromDate, 'to_date' => $toDate) = $date;
        return $builder->whereBetween('start', [$fromDate, $toDate]);
    }
}