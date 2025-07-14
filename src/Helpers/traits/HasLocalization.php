<?php

namespace Bhry98\Helpers\traits;

use Bhry98\Helpers\models\LocalizationsModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

trait HasLocalization
{
    /**
     * Define the relationship to localization records.
     */
    public function localizations(): HasMany
    {
        return $this->hasMany(LocalizationsModel::class, 'reference_id')
            ->where('relation', static::class);
    }

    /**
     * Eager load localization data.
     */
    protected function scopeLocales(Builder $query): void
    {
        $query->with('localizations');
    }

    /**
     * Get localized value for a specific column and locale.
     */
    public function getLocalized($column, $locale = null): ?string
    {
        $locale = $locale ?? App::getLocale();

        $localizationValue = collect($this->localizations ?? [])
            ->where('column_name', $column)
            ->where('locale', $locale)
            ->first()?->value;

        $defaultKey = "default_$column";
        $defaultValue = array_key_exists($defaultKey, $this->attributes)
            ? $this->attributes[$defaultKey]
            : "---";

        return $localizationValue ?? $defaultValue;
    }

    /**
     * Set a localized value for a specific column and locale.
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

        if ($locale === 'en') {
            $this->update(["default_{$column}" => $value]);
        }
    }

    /**
     * Soft delete a localized value.
     */
    public function deleteLocalized($column, $locale = null): void
    {
        $locale = $locale ?? App::getLocale();

        LocalizationsModel::query()
            ->where('relation', static::class)
            ->where('column_name', $column)
            ->where('reference_id', $this->id)
            ->where('locale', $locale)
            ->first()?->delete();
    }

    /**
     * Force delete a localized value.
     */
    public function forceDeleteLocalized($column, $locale = null): void
    {
        $locale = $locale ?? App::getLocale();

        LocalizationsModel::query()
            ->where('relation', static::class)
            ->where('column_name', $column)
            ->where('reference_id', $this->id)
            ->where('locale', $locale)
            ->first()?->forceDelete();
    }

    /**
     * Override attribute access to return localized values.
     */
    public function getAttribute($key): mixed
    {
        if (in_array($key, $this->getLocalizable())) {
            return $this->getLocalized($key);
        }

        return parent::getAttribute($key);
    }

    /**
     * List of localizable columns.
     */
    public function getLocalizable(): array
    {
        if (property_exists($this, 'localizable') && is_array($this->localizable)) {
            return $this->localizable;
        }

        throw new \LogicException(
            "Model " . static::class . " must define a protected array property `\$localizable = [...]` to use HasLocalization."
        );
    }

    /**
     * Get all localized values as array.
     */
    public function getLocalizedArray(): array
    {
        return $this->localizations()?->pluck('value', 'locale')?->toArray() ?? [];
    }

    /**
     * Query scope to filter models by localized column.
     *
     * @param Builder $query
     * @param string $column
     * @param string|null $value
     * @param string|null $locale
     * @return Builder
     */
    public function scopeFilterLocalized(Builder $query, string $column, ?string $value, string $locale = null): Builder
    {
        $locale = $locale ?? App::getLocale();
        if (is_null($value)) {
            return $query;
        }
//        dd($column,$value,$locale);

        return $query->whereHas('localizations', function ($q) use ($column, $value, $locale) {
            $q->where('column_name', $column)
                ->where('locale', $locale)
                ->where('value', 'LIKE', '%' . $value . '%');
        });
    }
}
