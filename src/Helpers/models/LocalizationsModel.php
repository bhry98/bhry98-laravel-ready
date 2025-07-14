<?php

namespace Bhry98\Helpers\models;

use Bhry98\Helpers\extends\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocalizationsModel extends BaseModel
{
    use SoftDeletes;

    const RELATIONS = [];
    protected $table = "localizations";
    protected $fillable = [
        'id',
        'relation',
        'column_name',
        'locale',
        'value',
        'reference_id',
    ];

    public function record(): BelongsTo
    {
        return $this->belongsTo($this->getAttribute('relation'), $this->getAttribute('column_name'), 'id');
    }
}
