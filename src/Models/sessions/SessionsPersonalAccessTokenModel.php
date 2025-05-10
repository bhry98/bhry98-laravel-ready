<?php

namespace Bhry98\Bhry98LaravelReady\Models\sessions;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken;

class SessionsPersonalAccessTokenModel extends PersonalAccessToken
{
    const TABLE_NAME = "sessions_personal_access_tokens";
    protected $table = self::TABLE_NAME;
}
