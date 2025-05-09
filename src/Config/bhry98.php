<?php
return [
    "app_settings" => [
        "db_host" => env(key: "DB_HOST"),
        "db_port" => env(key: "DB_PORT", default: "3306"),
        "db_name" => env(key: "DB_DATABASE"),
        "db_username" => env(key: "DB_USERNAME"),
        "db_password" => env(key: "DB_PASSWORD"),
    ],
    "core_settings" => [
        // database settings
        "db_host" => "10.5.0.103",
        "db_port" => "3306",
        "db_name" => "erp_laravel_core",
        "db_username" => "erp_laravel_core",
        "db_password" => "erp_laravel_core",
        // ldap settings
        "ldap_hosts" => ["10.6.0.20"],
        "ldap_port" => 389,
        "ldap_username" => "cn=Administrator,CN=Users,DC=vs,DC=local",
        "ldap_password" => "V$2006@ad20",
        "ldap_base_dn" => "DC=vs,DC=local",
        "ldap_use_ssl" => false,
        "ldap_use_tls" => false,
        "ldap_use_sasl" => false,
        // ad manager settings
        "adm_host" => "10.6.0.20",
        "adm_port" => 9000,
        "adm_domain" => "vs.local",
        "adm_auth_token" => "e160086d-eb0f-4430-802c-2224313c7874",
        "adm_use_ssl" => false,
        "adm_base_dn" => "DC=vs,DC=local",
    ],
];