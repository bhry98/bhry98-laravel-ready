<?php

namespace Bhry98\Helpers\extends;

use Illuminate\Support\Str;

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



    public function notifyFilament(bool $success, string $type): void
    {
        if ($success) {
            bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.$type-success"));
        } else {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.$type-field"));
        }
    }
}