<?php
if (!function_exists('bhry98_base_path')) {
    function bhry98_base_path($path = ''): string
    {
        $ds = DIRECTORY_SEPARATOR;
        return __DIR__ . "$ds..$ds..$ds$path";
    }
}
if (!function_exists('bhry98_config_path')) {
    function bhry98_config_path($path = ''): string
    {
        $ds = DIRECTORY_SEPARATOR;
        return bhry98_base_path("config$ds$path");
    }
}
if (!function_exists('bhry98_database_path')) {
    function bhry98_database_path($path = ''): string
    {
        $ds = DIRECTORY_SEPARATOR;
        return bhry98_base_path("database$ds$path");
    }
}
if (!function_exists('bhry98_config_path')) {
    function bhry98_config_path($path = ''): string
    {
        $ds = DIRECTORY_SEPARATOR;
        return bhry98_base_path("config$ds$path");
    }
}
if (!function_exists('bhry98_locations_path')) {
    function bhry98_locations_path($path = ''): string
    {
        $ds = DIRECTORY_SEPARATOR;
        return bhry98_base_path("Locations$ds$path");
    }
}
if (!function_exists('bhry98_users_path')) {
    function bhry98_users_path($path = ''): string
    {
        $ds = DIRECTORY_SEPARATOR;
        return bhry98_base_path("Users$ds$path");
    }
}
if (!function_exists('bhry98_settings_path')) {
    function bhry98_settings_path($path = ''): string
    {
        $ds = DIRECTORY_SEPARATOR;
        return bhry98_base_path("Settings$ds$path");
    }
}
if (!function_exists('bhry98_gp_path')) {
    function bhry98_gp_path($path = ''): string
    {
        $ds = DIRECTORY_SEPARATOR;
        return bhry98_base_path("GroupPolicies$ds$path");
    }
}
if (!function_exists('bhry98_ac_path')) {
    function bhry98_ac_path($path = ''): string
    {
        $ds = DIRECTORY_SEPARATOR;
        return bhry98_base_path("AccountCenter$ds$path");
    }
}

