<?php

use Bhry98\Locations\Models\LocationsCitiesModel;
use Bhry98\Locations\Models\LocationsCountriesModel;
use Bhry98\Locations\Models\LocationsGovernoratesModel;
use Bhry98\Settings\Models\SettingsEnumsModel;
use Bhry98\Users\Enums\UsersAccountTypes;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new UsersCoreModel)->getTable(),
            function (Blueprint $table) {
                $table->id();
                $table->string('code', 50)->unique()->index();
                $table->string('display_name', 100);
                $table->string('first_name', 50);
                $table->string('middle_name', 50)->nullable();
                $table->string('last_name', 50);
                $table->string('title', 50)->nullable();
                $table->string('job_position', 50)->nullable();
                $table->string('work_email')->nullable();
                $table->string('phone_number', 40)->nullable()->index()->unique();
                $table->boolean('must_verify_phone')->default(false);
                $table->timestamp('phone_number_verified_at')->nullable();
                $table->text('bio')->nullable();
                $table->string('national_id', 50)->nullable()->index()->unique();
                $table->string('birthdate', 50)->nullable();
                $table->string('language', 5)->default("en");
                $table->string('theme', 50)->default("dark");
                $table->string('username', 50)->unique();
                $table->string('email', 100)->nullable()->unique();
                $table->boolean('must_verify_email')->default(false);
                $table->timestamp('email_verified_at')->nullable();
                $table->boolean('must_change_password')->default(false);
                $table->string('password')->nullable();
                $table->string('timezone', 50)->nullable()->default(config("app.timezone", "Africa/Cairo"));
                $table->foreignId('type_id')->nullable()->references('id')->on((new SettingsEnumsModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
                $table->foreignId('gender_id')->nullable()->references('id')->on((new SettingsEnumsModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
                $table->foreignId('nationality_id')->nullable()->references('id')->on((new LocationsCountriesModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
                $table->foreignId('country_id')->nullable()->references('id')->on((new LocationsCountriesModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
                $table->foreignId('governorate_id')->nullable()->references('id')->on((new LocationsGovernoratesModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
                $table->foreignId('city_id')->nullable()->references('id')->on((new LocationsCitiesModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
                $table->string('account_type')->nullable()->default(UsersAccountTypes::User->name);
                $table->rememberToken();
                bhry98_common_database_columns(table: $table, softDeletes: true, userLog: true, active: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new UsersCoreModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
