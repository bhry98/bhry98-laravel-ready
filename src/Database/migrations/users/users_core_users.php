<?php

use Bhry98\Bhry98LaravelReady\Models\locations\{
    LocationsCitiesModel,
    LocationsCountriesModel,
    LocationsGovernoratesModel
};
use  Bhry98\Bhry98LaravelReady\Models\users\{
    UsersCoreUsersModel
};
use Bhry98\Bhry98LaravelReady\Models\enums\{
    EnumsCoreModel
};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: UsersCoreUsersModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->string(column: 'code', length: 50)->unique()->index();
                $table->string(column: 'display_name', length: 100);
                $table->string(column: 'first_name', length: 50);
                $table->string(column: 'last_name', length: 50);
                $table->string(column: 'phone_number', length: 20)->nullable()->index()->unique();
                $table->timestamp(column: 'phone_number_verified_at')->nullable();
                $table->string(column: 'national_id', length: 20)->nullable()->index()->unique();
                $table->string(column: 'birthdate', length: 50)->nullable();
                $table->string(column: 'username', length: 50)->unique();
                $table->string(column: 'email', length: 100)->nullable()->unique();
                $table->timestamp(column: 'email_verified_at')->nullable();
                $table->boolean(column: 'must_change_password')->default(value: false);
                $table->string(column: 'password')->nullable();
                $table->foreignId(column: 'type_id')->references(column: 'id')->on(table: EnumsCoreModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId(column: 'gender_id')->nullable()->references(column: 'id')->on(table: EnumsCoreModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId(column: 'timezone_id')->nullable()->references(column: 'id')->on(table: EnumsCoreModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId(column: 'country_id')->nullable()->references(column: 'id')->on(table: LocationsCountriesModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId(column: 'governorate_id')->nullable()->references(column: 'id')->on(table: LocationsGovernoratesModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId(column: 'city_id')->nullable()->references(column: 'id')->on(table: LocationsCitiesModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->rememberToken();
                bhry98_common_database_columns(table: $table, softDeletes: true, userLog: true, active: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: UsersCoreUsersModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
