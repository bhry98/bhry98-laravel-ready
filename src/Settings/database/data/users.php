<?php

use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsTypes;
use Bhry98\Bhry98LaravelReady\Enums\users\UsersAccountTypes;
use Bhry98\Bhry98LaravelReady\Enums\users\UsersGenderTypes;

return [
    "genders" => [
        [
            'type' => EnumsTypes::UsersGender,
            'names' => [
                'ar' => "ذكر",
                'en' => "Male",
            ],
            'description' => [
                'ar' => "الجنس ذكر",
                'en' => "Gender is male",
            ],
            'color' => "#3B82F6", // Tailwind's blue-500
            'ordering' => 1,
            'parent_id' => null,
            'active' => true,
            'note' => null,
        ],
        [
            'type' => EnumsTypes::UsersGender,
            'names' => [
                'ar' => "أنثى",
                'en' => "Female",
            ],
            'description' => [
                'ar' => "الجنس أنثى",
                'en' => "Gender is female",
            ],
            'color' => "#EC4899", // Tailwind's pink-500
            'ordering' => 2,
            'parent_id' => null,
            'active' => true,
            'note' => null,
        ],
    ],
//    "timezones" => [
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Abidjan'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Accra'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Addis_Ababa'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Algiers'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Asmara'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Asmera'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Bamako'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Bangui'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Banjul'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Bissau'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Blantyre'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Brazzaville'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Bujumbura'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Cairo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Casablanca'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Ceuta'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Conakry'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Dakar'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Dar_es_Salaam'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Djibouti'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Douala'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/El_Aaiun'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Freetown'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Gaborone'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Harare'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Johannesburg'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Juba'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Kampala'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Khartoum'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Kigali'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Kinshasa'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Lagos'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Libreville'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Lome'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Luanda'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Lubumbashi'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Lusaka'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Malabo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Maputo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Maseru'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Mbabane'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Mogadishu'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Monrovia'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Nairobi'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Ndjamena'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Niamey'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Nouakchott'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Ouagadougou'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Porto-Novo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Sao_Tome'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Timbuktu'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Tripoli'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Tunis'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Africa/Windhoek'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Adak'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Anchorage'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Anguilla'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Antigua'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Araguaina'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/Buenos_Aires'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/Catamarca'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/ComodRivadavia'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/Cordoba'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/Jujuy'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/La_Rioja'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/Mendoza'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/Rio_Gallegos'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/Salta'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/San_Juan'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/San_Luis'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/Tucuman'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Argentina/Ushuaia'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Aruba'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Asuncion'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Atikokan'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Atka'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Bahia'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Bahia_Banderas'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Barbados'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Belem'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Belize'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Blanc-Sablon'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Boa_Vista'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Bogota'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Boise'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Buenos_Aires'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Cambridge_Bay'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Campo_Grande'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Cancun'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Caracas'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Catamarca'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Cayenne'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Cayman'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Chicago'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Chihuahua'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Ciudad_Juarez'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Coral_Harbour'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Cordoba'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Costa_Rica'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Creston'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Cuiaba'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Curacao'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Danmarkshavn'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Dawson'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Dawson_Creek'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Denver'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Detroit'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Dominica'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Edmonton'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Eirunepe'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/El_Salvador'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Ensenada'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Fort_Nelson'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Fort_Wayne'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Fortaleza'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Glace_Bay'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Godthab'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Goose_Bay'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Grand_Turk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Grenada'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Guadeloupe'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Guatemala'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Guayaquil'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Guyana'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Halifax'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Havana'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Hermosillo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Indiana/Indianapolis'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Indiana/Knox'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Indiana/Marengo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Indiana/Petersburg'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Indiana/Tell_City'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Indiana/Vevay'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Indiana/Vincennes'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Indiana/Winamac'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Indianapolis'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Inuvik'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Iqaluit'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Jamaica'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Jujuy'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Juneau'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Kentucky/Louisville'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Kentucky/Monticello'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Knox_IN'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Kralendijk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/La_Paz'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Lima'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Los_Angeles'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Louisville'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Lower_Princes'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Maceio'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Managua'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Manaus'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Marigot'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Martinique'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Matamoros'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Mazatlan'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Mendoza'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Menominee'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Merida'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Metlakatla'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Mexico_City'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Miquelon'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Moncton'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Monterrey'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Montevideo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Montreal'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Montserrat'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Nassau'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/New_York'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Nipigon'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Nome'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Noronha'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/North_Dakota/Beulah'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/North_Dakota/Center'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/North_Dakota/New_Salem'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Nuuk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Ojinaga'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Panama'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Pangnirtung'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Paramaribo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Phoenix'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Port-au-Prince'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Port_of_Spain'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Porto_Acre'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Porto_Velho'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Puerto_Rico'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Punta_Arenas'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Rainy_River'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Rankin_Inlet'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Recife'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Regina'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Resolute'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Rio_Branco'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Rosario'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Santa_Isabel'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Santarem'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Santiago'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Santo_Domingo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Sao_Paulo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Scoresbysund'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Shiprock'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Sitka'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/St_Barthelemy'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/St_Johns'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/St_Kitts'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/St_Lucia'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/St_Thomas'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/St_Vincent'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Swift_Current'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Tegucigalpa'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Thule'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Thunder_Bay'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Tijuana'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Toronto'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Tortola'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Vancouver'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Virgin'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Whitehorse'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Winnipeg'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Yakutat'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'America/Yellowknife'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Antarctica/Casey'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Antarctica/Davis'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Antarctica/DumontDUrville'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Antarctica/Macquarie'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Antarctica/Mawson'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Antarctica/McMurdo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Antarctica/Palmer'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Antarctica/Rothera'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Antarctica/South_Pole'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Antarctica/Syowa'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Antarctica/Troll'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Antarctica/Vostok'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Arctic/Longyearbyen'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Aden'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Almaty'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Amman'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Anadyr'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Aqtau'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Aqtobe'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Ashgabat'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Ashkhabad'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Atyrau'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Baghdad'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Bahrain'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Baku'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Bangkok'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Barnaul'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Beirut'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Bishkek'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Brunei'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Calcutta'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Chita'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Choibalsan'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Chongqing'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Chungking'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Colombo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Dacca'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Damascus'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Dhaka'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Dili'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Dubai'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Dushanbe'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Famagusta'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Gaza'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Harbin'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Hebron'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Ho_Chi_Minh'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Hong_Kong'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Hovd'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Irkutsk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Istanbul'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Jakarta'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Jayapura'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Jerusalem'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Kabul'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Kamchatka'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Karachi'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Kashgar'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Kathmandu'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Katmandu'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Khandyga'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Kolkata'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Krasnoyarsk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Kuala_Lumpur'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Kuching'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Kuwait'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Macao'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Macau'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Magadan'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Makassar'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Manila'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Muscat'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Nicosia'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Novokuznetsk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Novosibirsk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Omsk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Oral'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Phnom_Penh'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Pontianak'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Pyongyang'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Qatar'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Qostanay'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Qyzylorda'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Rangoon'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Riyadh'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Saigon'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Sakhalin'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Samarkand'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Seoul'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Shanghai'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Singapore'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Srednekolymsk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Taipei'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Tashkent'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Tbilisi'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Tehran'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Tel_Aviv'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Thimbu'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Thimphu'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Tokyo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Tomsk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Ujung_Pandang'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Ulaanbaatar'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Ulan_Bator'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Urumqi'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Ust-Nera'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Vientiane'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Vladivostok'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Yakutsk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Yangon'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Yekaterinburg'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Asia/Yerevan'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Atlantic/Azores'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Atlantic/Bermuda'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Atlantic/Canary'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Atlantic/Cape_Verde'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Atlantic/Faeroe'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Atlantic/Faroe'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Atlantic/Jan_Mayen'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Atlantic/Madeira'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Atlantic/Reykjavik'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Atlantic/South_Georgia'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Atlantic/St_Helena'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Atlantic/Stanley'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/ACT'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Adelaide'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Brisbane'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Broken_Hill'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Canberra'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Currie'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Darwin'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Eucla'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Hobart'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/LHI'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Lindeman'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Lord_Howe'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Melbourne'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/NSW'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/North'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Perth'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Queensland'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/South'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Sydney'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Tasmania'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Victoria'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/West'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Australia/Yancowinna'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Brazil/Acre'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Brazil/DeNoronha'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Brazil/East'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Brazil/West'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'CET'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'CST6CDT'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Canada/Atlantic'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Canada/Central'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Canada/Eastern'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Canada/Mountain'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Canada/Newfoundland'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Canada/Pacific'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Canada/Saskatchewan'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Canada/Yukon'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Chile/Continental'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Chile/EasterIsland'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Cuba'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'EET'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'EST'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'EST5EDT'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Egypt'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Eire'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+0'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+1'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+10'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+11'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+12'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+2'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+3'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+4'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+5'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+6'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+7'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+8'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT+9'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-0'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-1'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-10'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-11'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-12'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-13'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-14'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-2'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-3'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-4'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-5'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-6'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-7'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-8'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT-9'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/GMT0'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/Greenwich'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/UCT'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/UTC'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/Universal'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Etc/Zulu'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Amsterdam'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Andorra'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Astrakhan'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Athens'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Belfast'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Belgrade'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Berlin'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Bratislava'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Brussels'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Bucharest'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Budapest'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Busingen'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Chisinau'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Copenhagen'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Dublin'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Gibraltar'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Guernsey'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Helsinki'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Isle_of_Man'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Istanbul'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Jersey'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Kaliningrad'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Kiev'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Kirov'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Kyiv'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Lisbon'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Ljubljana'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/London'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Luxembourg'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Madrid'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Malta'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Mariehamn'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Minsk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Monaco'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Moscow'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Nicosia'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Oslo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Paris'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Podgorica'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Prague'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Riga'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Rome'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Samara'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/San_Marino'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Sarajevo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Saratov'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Simferopol'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Skopje'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Sofia'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Stockholm'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Tallinn'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Tirane'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Tiraspol'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Ulyanovsk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Uzhgorod'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Vaduz'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Vatican'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Vienna'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Vilnius'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Volgograd'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Warsaw'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Zagreb'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Zaporozhye'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Europe/Zurich'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'GB'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'GB-Eire'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'GMT'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'GMT+0'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'GMT-0'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'GMT0'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Greenwich'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'HST'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Hongkong'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Iceland'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Indian/Antananarivo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Indian/Chagos'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Indian/Christmas'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Indian/Cocos'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Indian/Comoro'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Indian/Kerguelen'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Indian/Mahe'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Indian/Maldives'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Indian/Mauritius'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Indian/Mayotte'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Indian/Reunion'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Iran'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Israel'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Jamaica'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Japan'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Kwajalein'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Libya'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'MET'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'MST'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'MST7MDT'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Mexico/BajaNorte'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Mexico/BajaSur'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Mexico/General'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'NZ'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'NZ-CHAT'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Navajo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'PRC'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'PST8PDT'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Apia'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Auckland'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Bougainville'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Chatham'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Chuuk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Easter'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Efate'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Enderbury'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Fakaofo'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Fiji'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Funafuti'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Galapagos'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Gambier'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Guadalcanal'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Guam'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Honolulu'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Johnston'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Kanton'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Kiritimati'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Kosrae'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Kwajalein'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Majuro'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Marquesas'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Midway'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Nauru'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Niue'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Norfolk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Noumea'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Pago_Pago'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Palau'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Pitcairn'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Pohnpei'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Ponape'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Port_Moresby'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Rarotonga'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Saipan'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Samoa'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Tahiti'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Tarawa'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Tongatapu'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Truk'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Wake'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Wallis'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Pacific/Yap'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Poland'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Portugal'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'ROC'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'ROK'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Singapore'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Turkey'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'UCT'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'US/Alaska'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'US/Aleutian'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'US/Arizona'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'US/Central'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'US/East-Indiana'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'US/Eastern'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'US/Hawaii'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'US/Indiana-Starke'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'US/Michigan'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'US/Mountain'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'US/Pacific'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'US/Samoa'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'UTC'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Universal'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'W-SU'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'WET'
//            ]
//        ],
//        [
//
//            'type' => EnumsCoreTypes::Timezone,
//            'api_access' => true,
//            'can_delete' => true,
//            'parent_id' => null,
//            'locales' => [
//                'en' => 'Zulu'
//            ]
//        ]
//    ],
];
