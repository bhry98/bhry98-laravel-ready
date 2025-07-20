<?php

namespace Bhry98\Users\Models;

use Bhry98\Helpers\extends\BaseModel;

class UsersAuthenticationLogModel extends BaseModel
{
    protected $table = "users_authentication_log";
    /**
     * authenticatable_type
     * authenticatable_id
     * ip_address
     * user_agent
     * login_at
     * login_successful
     * logout_at
     * cleared_by_user
     * location
     */
}
