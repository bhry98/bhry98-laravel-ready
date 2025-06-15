<?php

namespace Bhry98\Bhry98LaravelReady\Models\localizations;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Models\enums\EnumsCoreModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocalizationsModel extends BaseModel
{
    use SoftDeletes;
    const TABLE_NAME = 'localizations';
    const RELATIONS = [];

    protected $table = self::TABLE_NAME;
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
        return $this->belongsTo(
            related: $this->relation,
            foreignKey: $this->column_name,
            ownerKey: 'id',
        );
    }
}
