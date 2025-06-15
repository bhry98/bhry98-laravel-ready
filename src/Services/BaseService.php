<?php

namespace Bhry98\Bhry98LaravelReady\Services;

class BaseService
{
    function applyFilters($data, array $filters, $class): void
    {
        foreach ($filters as $filterColumn => $filterValue) {
            if (in_array($filterColumn, $class::FILTER_COLUMNS ?? [])) {
                if (method_exists($class, 'getLocalizable') && in_array($filterColumn, (new $class)->getLocalizable() ?? [])) {
                    $data->filterLocalized(column: $filterColumn, value: $filterValue);
                } else {
                    $data->where($filterColumn, "like", "%$filterValue%");
                }
            }
        }
    }
}