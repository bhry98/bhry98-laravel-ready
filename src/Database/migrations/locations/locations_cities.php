<?php

use Bhry98\Bhry98LaravelReady\Models\locations\{
    LocationsCitiesModel,
    LocationsCountriesModel,
    LocationsGovernoratesModel
};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: LocationsCitiesModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->string(column: 'code',length: 50)->unique()->index();
                $table->string(column: 'default_name')->nullable();
                $table->foreignId(column: 'country_id')->references(column: 'id')->on(table: LocationsCountriesModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId(column: 'governorate_id')->nullable()->references(column: 'id')->on(table: LocationsGovernoratesModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                bhry98_common_database_columns(table: $table, softDeletes: true, userLog: true, active: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: LocationsCitiesModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
