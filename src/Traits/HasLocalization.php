<?php

namespace Bhry98\Bhry98LaravelReady\Traits;

use Bhry98\Bhry98LaravelReady\Models\localizations\LocalizationsModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

trait HasLocalization
{


    public function scopeWhereTranslationLike(Builder $query, string $column, ?string $value, ?string $locale = null): Builder
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
    }

    public function localizations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LocalizationsModel::class, 'reference_id')
            ->where('relation', static::class);
    }

    public static function getLocalizable(): array
    {
        // Use ReflectionClass to access protected property
        $reflection = new \ReflectionClass(static::class);
        $property = $reflection->getProperty('localizable');
        return $property->getValue(new static()) ?? [];
    }


    /**
     * Get a localized value for a given column.
     */
    public function getLocalized($column, $locale = null)
    {
        $locale = $locale ?? App::getLocale();

        return LocalizationsModel::query()
            ->where('relation', static::class)
            ->where('column_name', $column)
            ->where('reference_id', $this->id)
            ->where('locale', $locale)
            ->value('value') ?? $this->attributes[$column] ?? null;
    }

    /**
     * Set a localized value for a given column.
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
     * Override getAttribute to return localized values automatically.
     */
    public function getAttribute($key)
    {
        if (in_array($key, $this->localizable ?? [])) {
            return $this->getLocalized($key);
        }

        return parent::getAttribute($key);
    }

    /**
     * Override setAttribute to save localized values automatically.
     */
    public function setAttribute($key, $value): void
    {
        if (in_array($key, $this->localizable ?? [])) {
            $this->setLocalized($key, $value);
        } else {
            parent::setAttribute($key, $value);
        }
    }

    public function deleteLocalized($column, $locale = null): void
    {
        $locale = $locale ?? App::getLocale();

        LocalizationsModel::query()
            ->where('relation', static::class)
            ->where('column_name', $column)
            ->where('reference_id', $this->id)
            ->where('locale', $locale)
            ->delete();
    }

    public function forceDeleteLocalized($column, $locale = null): void
    {
        $locale = $locale ?? App::getLocale();
        LocalizationsModel::query()
            ->where('relation', static::class)
            ->where('column_name', $column)
            ->where('reference_id', $this->id)
            ->where('locale', $locale)
            ->forceDelete();
    }
}
