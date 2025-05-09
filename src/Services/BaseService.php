<?php

namespace Bhry98\Bhry98LaravelReady\Services;

class BaseService
{
    function applyFilters($data, array $filters, $class): void
    {
        foreach ($filters as $filterKEY => $filterValue) {
            if (in_array($filterKEY, $class::FILTER_COLUMNS ?? [])) {
                if (method_exists($class, 'getLocalizable') && in_array($filterKEY, $class::getLocalizable() ?? [])) {
                    $data->whereTranslationLike($filterKEY, $filterValue);
                } else {
                    $data->where($filterKEY, "like", "%$filterValue%");
                }
            }
        }
    }
}