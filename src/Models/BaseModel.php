<?php

namespace Bhry98\Bhry98LaravelReady\Models;

use Bhry98\Bhry98LaravelReady\Models\localizations\LocalizationsModel;

abstract class BaseModel extends \Illuminate\Database\Eloquent\Model
{
    protected $connection = "core";
}