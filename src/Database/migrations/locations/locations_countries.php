<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Bhry98\Bhry98LaravelReady\Models\locations\{
    LocationsCitiesModel,
    LocationsCountriesModel,
    LocationsGovernoratesModel
};

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: LocationsCountriesModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->string(column: 'code',length: 50)->unique()->index();
                $table->string(column: 'default_name')->nullable();
                $table->string(column: 'country_code', length: 20)->index()->unique();
                $table->string(column: 'flag', length: 10);
                $table->string(column: 'lang_key', length: 10);
                $table->boolean(column: 'system_lang')->default(value: false);
                bhry98_common_database_columns(table: $table, softDeletes: true, userLog: true, active: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: LocationsCountriesModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
