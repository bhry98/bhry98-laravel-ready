<?php

use Bhry98\Locations\Models\LocationsCountriesModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new LocationsCountriesModel)->getTable(),
            function (Blueprint $table) {
                $table->id();
                $table->string('code', 50)->unique()->index();
                $table->string('default_name')->nullable();
                $table->string('country_code', 20)->index()->unique();
                $table->string('flag', 10);
                $table->string('lang_key', 10);
                $table->string('dial_code', 10)->nullable();
                $table->string('currency', 10)->nullable();
                $table->boolean('system_lang')->default(false);
                bhry98_common_database_columns(table: $table, softDeletes: true, userLog: true, active: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new LocationsCountriesModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
