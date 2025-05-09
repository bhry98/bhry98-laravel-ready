<?php

namespace Bhry98\Bhry98LaravelReady\Enums\identities;

enum IdentitiesCoreTypes: string
{
    case CoreUsers = 'core_users';
    case AzureUsers = 'azure_users';
    case ADManagerUsers = 'ad_manager_users';
    case Employee = 'employee';
    case Customer = 'customer';
    case Country = 'country';
    case Governorate = 'governorate';
    case City = 'city';
    case ItAssets = 'it_assets';
}
