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
            table: LocationsGovernoratesModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->uuid(column: 'identity_code')->unique();
                $table->string(column: 'default_name')->nullable();
                $table->foreignId(column: 'country_id')->references(column: 'id')->on(table: LocationsCountriesModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                bhry98_common_database_columns(table: $table, softDeletes: true, userLog: true, active: true);

            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: LocationsGovernoratesModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
