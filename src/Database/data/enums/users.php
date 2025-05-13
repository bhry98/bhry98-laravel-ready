<?php

use Bhry98\Bhry98LaravelReady\Enums\Modules;
use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsCoreTypes;

return [
    "types" => [
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::UsersType,
            'api_access' => false,
            'can_delete' => false,
            'parent_id' => null,
            "default_color" => "orange",
            'locales' => [
                'ar' => "مستخدم مسؤول",
                "en" => "Administrator",
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::UsersType,
            'api_access' => true,
            'can_delete' => true,
            "default_color" => "azure",
            'parent_id' => null,
            'locales' => [
                'ar' => "مستخدم عادي",
                "en" => "Normal User",
            ]
        ],
    ],
    "genders" => [
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::UsersGender,
            'api_access' => true,
            'can_delete' => false,
            'parent_id' => null,
            "default_color" => "blue",
            'locales' => [
                'ar' => "ذكر",
                "en" => "Male",
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::UsersGender,
            'api_access' => true,
            'can_delete' => false,
            'parent_id' => null,
            "default_color" => "pink",
            'locales' => [
                'ar' => "أنثى",
                "en" => "Female",
            ]
        ],
    ],
    "timezones" => [
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Abidjan'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Accra'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Addis_Ababa'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Algiers'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Asmara'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Asmera'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Bamako'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Bangui'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Banjul'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Bissau'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Blantyre'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Brazzaville'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Bujumbura'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Cairo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Casablanca'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Ceuta'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Conakry'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Dakar'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Dar_es_Salaam'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Djibouti'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Douala'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/El_Aaiun'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Freetown'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Gaborone'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Harare'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Johannesburg'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Juba'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Kampala'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Khartoum'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Kigali'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Kinshasa'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Lagos'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Libreville'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Lome'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Luanda'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Lubumbashi'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Lusaka'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Malabo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Maputo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Maseru'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Mbabane'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Mogadishu'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Monrovia'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Nairobi'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Ndjamena'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Niamey'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Nouakchott'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Ouagadougou'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Porto-Novo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Sao_Tome'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Timbuktu'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Tripoli'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Tunis'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Africa/Windhoek'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Adak'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Anchorage'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Anguilla'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Antigua'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Araguaina'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/Buenos_Aires'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/Catamarca'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/ComodRivadavia'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/Cordoba'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/Jujuy'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/La_Rioja'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/Mendoza'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/Rio_Gallegos'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/Salta'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/San_Juan'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/San_Luis'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/Tucuman'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Argentina/Ushuaia'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Aruba'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Asuncion'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Atikokan'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Atka'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Bahia'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Bahia_Banderas'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Barbados'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Belem'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Belize'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Blanc-Sablon'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Boa_Vista'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Bogota'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Boise'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Buenos_Aires'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Cambridge_Bay'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Campo_Grande'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Cancun'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Caracas'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Catamarca'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Cayenne'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Cayman'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Chicago'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Chihuahua'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Ciudad_Juarez'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Coral_Harbour'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Cordoba'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Costa_Rica'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Creston'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Cuiaba'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Curacao'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Danmarkshavn'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Dawson'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Dawson_Creek'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Denver'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Detroit'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Dominica'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Edmonton'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Eirunepe'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/El_Salvador'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Ensenada'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Fort_Nelson'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Fort_Wayne'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Fortaleza'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Glace_Bay'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Godthab'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Goose_Bay'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Grand_Turk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Grenada'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Guadeloupe'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Guatemala'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Guayaquil'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Guyana'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Halifax'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Havana'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Hermosillo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Indiana/Indianapolis'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Indiana/Knox'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Indiana/Marengo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Indiana/Petersburg'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Indiana/Tell_City'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Indiana/Vevay'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Indiana/Vincennes'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Indiana/Winamac'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Indianapolis'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Inuvik'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Iqaluit'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Jamaica'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Jujuy'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Juneau'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Kentucky/Louisville'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Kentucky/Monticello'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Knox_IN'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Kralendijk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/La_Paz'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Lima'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Los_Angeles'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Louisville'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Lower_Princes'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Maceio'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Managua'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Manaus'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Marigot'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Martinique'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Matamoros'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Mazatlan'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Mendoza'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Menominee'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Merida'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Metlakatla'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Mexico_City'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Miquelon'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Moncton'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Monterrey'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Montevideo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Montreal'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Montserrat'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Nassau'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/New_York'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Nipigon'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Nome'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Noronha'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/North_Dakota/Beulah'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/North_Dakota/Center'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/North_Dakota/New_Salem'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Nuuk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Ojinaga'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Panama'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Pangnirtung'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Paramaribo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Phoenix'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Port-au-Prince'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Port_of_Spain'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Porto_Acre'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Porto_Velho'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Puerto_Rico'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Punta_Arenas'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Rainy_River'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Rankin_Inlet'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Recife'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Regina'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Resolute'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Rio_Branco'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Rosario'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Santa_Isabel'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Santarem'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Santiago'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Santo_Domingo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Sao_Paulo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Scoresbysund'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Shiprock'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Sitka'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/St_Barthelemy'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/St_Johns'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/St_Kitts'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/St_Lucia'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/St_Thomas'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/St_Vincent'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Swift_Current'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Tegucigalpa'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Thule'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Thunder_Bay'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Tijuana'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Toronto'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Tortola'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Vancouver'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Virgin'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Whitehorse'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Winnipeg'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Yakutat'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'America/Yellowknife'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Antarctica/Casey'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Antarctica/Davis'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Antarctica/DumontDUrville'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Antarctica/Macquarie'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Antarctica/Mawson'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Antarctica/McMurdo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Antarctica/Palmer'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Antarctica/Rothera'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Antarctica/South_Pole'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Antarctica/Syowa'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Antarctica/Troll'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Antarctica/Vostok'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Arctic/Longyearbyen'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Aden'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Almaty'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Amman'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Anadyr'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Aqtau'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Aqtobe'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Ashgabat'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Ashkhabad'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Atyrau'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Baghdad'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Bahrain'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Baku'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Bangkok'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Barnaul'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Beirut'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Bishkek'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Brunei'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Calcutta'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Chita'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Choibalsan'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Chongqing'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Chungking'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Colombo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Dacca'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Damascus'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Dhaka'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Dili'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Dubai'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Dushanbe'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Famagusta'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Gaza'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Harbin'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Hebron'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Ho_Chi_Minh'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Hong_Kong'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Hovd'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Irkutsk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Istanbul'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Jakarta'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Jayapura'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Jerusalem'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Kabul'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Kamchatka'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Karachi'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Kashgar'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Kathmandu'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Katmandu'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Khandyga'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Kolkata'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Krasnoyarsk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Kuala_Lumpur'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Kuching'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Kuwait'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Macao'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Macau'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Magadan'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Makassar'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Manila'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Muscat'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Nicosia'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Novokuznetsk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Novosibirsk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Omsk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Oral'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Phnom_Penh'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Pontianak'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Pyongyang'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Qatar'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Qostanay'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Qyzylorda'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Rangoon'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Riyadh'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Saigon'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Sakhalin'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Samarkand'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Seoul'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Shanghai'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Singapore'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Srednekolymsk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Taipei'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Tashkent'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Tbilisi'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Tehran'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Tel_Aviv'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Thimbu'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Thimphu'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Tokyo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Tomsk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Ujung_Pandang'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Ulaanbaatar'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Ulan_Bator'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Urumqi'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Ust-Nera'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Vientiane'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Vladivostok'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Yakutsk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Yangon'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Yekaterinburg'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Asia/Yerevan'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Atlantic/Azores'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Atlantic/Bermuda'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Atlantic/Canary'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Atlantic/Cape_Verde'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Atlantic/Faeroe'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Atlantic/Faroe'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Atlantic/Jan_Mayen'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Atlantic/Madeira'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Atlantic/Reykjavik'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Atlantic/South_Georgia'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Atlantic/St_Helena'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Atlantic/Stanley'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/ACT'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Adelaide'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Brisbane'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Broken_Hill'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Canberra'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Currie'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Darwin'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Eucla'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Hobart'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/LHI'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Lindeman'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Lord_Howe'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Melbourne'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/NSW'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/North'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Perth'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Queensland'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/South'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Sydney'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Tasmania'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Victoria'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/West'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Australia/Yancowinna'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Brazil/Acre'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Brazil/DeNoronha'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Brazil/East'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Brazil/West'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'CET'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'CST6CDT'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Canada/Atlantic'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Canada/Central'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Canada/Eastern'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Canada/Mountain'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Canada/Newfoundland'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Canada/Pacific'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Canada/Saskatchewan'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Canada/Yukon'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Chile/Continental'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Chile/EasterIsland'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Cuba'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'EET'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'EST'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'EST5EDT'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Egypt'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Eire'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+0'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+1'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+10'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+11'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+12'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+2'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+3'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+4'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+5'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+6'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+7'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+8'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT+9'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-0'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-1'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-10'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-11'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-12'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-13'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-14'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-2'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-3'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-4'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-5'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-6'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-7'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-8'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT-9'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/GMT0'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/Greenwich'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/UCT'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/UTC'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/Universal'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Etc/Zulu'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Amsterdam'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Andorra'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Astrakhan'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Athens'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Belfast'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Belgrade'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Berlin'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Bratislava'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Brussels'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Bucharest'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Budapest'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Busingen'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Chisinau'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Copenhagen'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Dublin'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Gibraltar'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Guernsey'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Helsinki'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Isle_of_Man'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Istanbul'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Jersey'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Kaliningrad'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Kiev'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Kirov'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Kyiv'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Lisbon'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Ljubljana'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/London'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Luxembourg'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Madrid'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Malta'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Mariehamn'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Minsk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Monaco'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Moscow'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Nicosia'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Oslo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Paris'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Podgorica'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Prague'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Riga'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Rome'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Samara'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/San_Marino'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Sarajevo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Saratov'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Simferopol'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Skopje'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Sofia'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Stockholm'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Tallinn'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Tirane'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Tiraspol'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Ulyanovsk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Uzhgorod'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Vaduz'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Vatican'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Vienna'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Vilnius'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Volgograd'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Warsaw'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Zagreb'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Zaporozhye'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Europe/Zurich'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'GB'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'GB-Eire'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'GMT'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'GMT+0'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'GMT-0'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'GMT0'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Greenwich'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'HST'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Hongkong'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Iceland'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Indian/Antananarivo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Indian/Chagos'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Indian/Christmas'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Indian/Cocos'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Indian/Comoro'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Indian/Kerguelen'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Indian/Mahe'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Indian/Maldives'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Indian/Mauritius'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Indian/Mayotte'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Indian/Reunion'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Iran'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Israel'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Jamaica'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Japan'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Kwajalein'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Libya'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'MET'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'MST'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'MST7MDT'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Mexico/BajaNorte'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Mexico/BajaSur'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Mexico/General'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'NZ'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'NZ-CHAT'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Navajo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'PRC'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'PST8PDT'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Apia'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Auckland'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Bougainville'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Chatham'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Chuuk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Easter'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Efate'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Enderbury'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Fakaofo'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Fiji'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Funafuti'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Galapagos'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Gambier'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Guadalcanal'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Guam'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Honolulu'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Johnston'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Kanton'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Kiritimati'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Kosrae'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Kwajalein'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Majuro'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Marquesas'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Midway'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Nauru'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Niue'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Norfolk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Noumea'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Pago_Pago'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Palau'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Pitcairn'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Pohnpei'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Ponape'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Port_Moresby'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Rarotonga'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Saipan'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Samoa'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Tahiti'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Tarawa'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Tongatapu'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Truk'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Wake'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Wallis'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Pacific/Yap'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Poland'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Portugal'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'ROC'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'ROK'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Singapore'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Turkey'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'UCT'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'US/Alaska'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'US/Aleutian'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'US/Arizona'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'US/Central'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'US/East-Indiana'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'US/Eastern'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'US/Hawaii'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'US/Indiana-Starke'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'US/Michigan'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'US/Mountain'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'US/Pacific'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'US/Samoa'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'UTC'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Universal'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'W-SU'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'WET'
            ]
        ],
        [
            'module' => Modules::Core,
            'type' => EnumsCoreTypes::Timezone,
            'api_access' => true,
            'can_delete' => true,
            'parent_id' => null,
            'locales' => [
                'en' => 'Zulu'
            ]
        ]
    ],
];
