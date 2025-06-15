<?php

namespace Bhry98\Bhry98LaravelReady\Traits;

use Bhry98\Bhry98LaravelReady\Models\localizations\LocalizationsModel;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

trait HasLocalization
{

    /**
     * @return HasMany
     */
    public function localizations(): HasMany
    {
        return $this->hasMany(LocalizationsModel::class, 'reference_id')
            ->where('relation', static::class);
    }

    /**
     * Scope a query to only include popular users.
     * @param Builder $query
     * @return void
     */
    #[Scope]
    protected function locales(Builder $query): void
    {
        $query->with('localizations');
    }

    /**
     * Get a localized value for a given column without a database query.
     * @param $column
     * @param null $locale
     * @return string|null
     */
    public function getLocalized($column, $locale = null): ?string
    {
        $locale = $locale ?? App::getLocale();
        return collect($this->localizations ?? [])
            ->where('column_name', $column)
            ->where('locale', $locale)
            ->first()?->value
            ?? $this->attributes[$column]
            ?? null;
    }

    /**
     * Set a localized value for a given column.
     * @param $column
     * @param $value
     * @param null $locale
     * @return void
     */
    public function setLocalized($column, $value, $locale = null): void
    {
        $locale = $locale ?? App::getLocale();
        LocalizationsModel::query()->updateOrCreate(
            [
                'relation' => static::class,
                'column_name' => $column,
                'reference_id' => $this->id,
                'locale' => $locale,
            ],
            ['value' => $value]
        );
    }

    /**
     * @param $column
     * @param $locale
     * @return void
     */
    public function deleteLocalized($column, $locale = null): void
    {
        $locale = $locale ?? App::getLocale();
        LocalizationsModel::query()
            ->where('relation', static::class)
            ->where('column_name', $column)
            ->where('reference_id', $this->id)
            ->where('locale', $locale)
            ->first()
            ?->delete();
    }

    /**
     * @param $column
     * @param $locale
     * @return void
     */
    public function forceDeleteLocalized($column, $locale = null): void
    {
        $locale = $locale ?? App::getLocale();
        LocalizationsModel::query()
            ->where('relation', static::class)
            ->where('column_name', $column)
            ->where('reference_id', $this->id)
            ->where('locale', $locale)
            ->first()
            ?->forceDelete();
    }

    /**
     * @param $key
     * @return mixed|string|null
     */
    public function getAttribute($key): mixed
    {
        if (in_array($key, $this->localizable ?? [])) {
            return $this->getLocalized($key);
        }

        return parent::getAttribute($key);
    }

    /**
     * @return array
     */
    public function getLocalizable(): array
    {
        return $this->localizable ?? [];
    }

    protected function scopeFilterLocalized(Builder $query, string $column, ?string $value, $locale = null): Builder
    {

        $locale = $locale ?? app()->getLocale();
//        dd($locale);
        if (is_null($value)) {
            return $query; // Skip filter if value is null
        }
        return $query->whereHas('localizations', function ($q) use ($column, $value, $locale) {
            $q->where('value', "like", "%$value%")
                ->where('column_name', $column)
                ->where('locale', $locale);
        });
//        $query->withWhereRelation('localizations', $column, "like", "%$value%");
//        $locale = $locale ?? App::getLocale();
//        return collect($this->localizations ?? [])
//            ->where('column_name', $column)
//            ->where('locale', $locale)
//            ->where('value', $value)
//            ->first()?->value
//            ?? $this->attributes[$column]
//            ?? null;
    }


}
