<?php

use Bhry98\Bhry98LaravelReady\Models\logs\LogsUsersLogonsModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: LogsUsersLogonsModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->references('id')->on(UsersCoreUsersModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->ipAddress();
                $table->string( 'city',50);
                $table->string( 'region',50);
                $table->string( 'country',50);
                $table->string( 'loc',50);
                $table->string( 'org',50);
                $table->string( 'timezone',50);
                bhry98_common_database_columns(table: $table);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists( LogsUsersLogonsModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
