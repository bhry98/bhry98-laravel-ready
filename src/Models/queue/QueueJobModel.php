<?php

namespace Bhry98\Bhry98LaravelReady\Models\queue;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class QueueJobModel extends BaseModel
{
    // start env
    const TABLE_NAME = "queue_job";
    // start table
    protected $table = self::TABLE_NAME;
    protected $fillable = [
    ];
}
