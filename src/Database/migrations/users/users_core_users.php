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
                $table->string('code', 50)->unique()->index();
                $table->string('display_name', 100);
                $table->string('first_name', 50);
                $table->string('last_name', 50);
                $table->foreignId('phone_number_key_id')->nullable()->references('id')->on(LocationsCountriesModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->string('phone_number', 40)->nullable()->index()->unique();
                $table->timestamp('phone_number_verified_at')->nullable();
                $table->string('national_id', 50)->nullable()->index()->unique();
                $table->string('birthdate', 50)->nullable();
                $table->string('username', 50)->unique();
                $table->string('email', 100)->nullable()->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->boolean('must_change_password')->default(false);
                $table->string('password')->nullable();
                $table->foreignId('type_id')->references('id')->on(EnumsCoreModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('timezone_id')->nullable()->references('id')->on(EnumsCoreModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('gender_id')->nullable()->references('id')->on(EnumsCoreModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('nationality_id')->nullable()->references('id')->on(LocationsCountriesModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('language_id')->nullable()->references('id')->on(LocationsCountriesModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('country_id')->nullable()->references('id')->on(LocationsCountriesModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('governorate_id')->nullable()->references('id')->on(LocationsGovernoratesModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('city_id')->nullable()->references('id')->on(LocationsCitiesModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->rememberToken();
                bhry98_common_database_columns(table: $table, softDeletes: true, userLog: true, active: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(UsersCoreUsersModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
