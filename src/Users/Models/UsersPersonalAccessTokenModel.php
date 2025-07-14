<?php

namespace Bhry98\Users\Models;

use Laravel\Sanctum\PersonalAccessToken;

class UsersPersonalAccessTokenModel extends PersonalAccessToken
{
    public function getTable(): ?string
    {
        return strtolower(config('bhry98.db_prefix') . "users_personal_access_tokens");
    }
}
