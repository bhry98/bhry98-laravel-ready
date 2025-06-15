<?php

namespace Bhry98\Bhry98LaravelReady\Models\sessions;

use Laravel\Sanctum\PersonalAccessToken;

class SessionsPersonalAccessTokenModel extends PersonalAccessToken
{
    const TABLE_NAME = "sessions_personal_access_tokens";
    protected $table = self::TABLE_NAME;
}
