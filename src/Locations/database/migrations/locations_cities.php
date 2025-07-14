<?php

use Bhry98\Locations\Models\LocationsCitiesModel;
use Bhry98\Locations\Models\LocationsCountriesModel;
use Bhry98\Locations\Models\LocationsGovernoratesModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new LocationsCitiesModel)->getTable(),
            function (Blueprint $table) {
                $table->id();
                $table->string('code', 50)->unique()->index();
                $table->string('default_name')->nullable();
                $table->foreignId('country_id')->references('id')->on((new LocationsCountriesModel)->getTable())->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('governorate_id')->nullable()->references('id')->on((new LocationsGovernoratesModel)->getTable())->cascadeOnUpdate()->cascadeOnDelete();
                bhry98_common_database_columns(table: $table, softDeletes: true, userLog: true, active: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new LocationsCitiesModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
