<?php

use Bhry98\Bhry98LaravelReady\Enums\system\SystemActionEnums;
use Bhry98\Bhry98LaravelReady\Models\logs\LogsSystemModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: LogsSystemModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->foreignId(column: 'user_id')
                    ->nullable()
                    ->references(column: 'id')
                    ->on(table: UsersCoreUsersModel::TABLE_NAME)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->string(column: 'action')->default(SystemActionEnums::Other->name);
                $table->string(column: 'log_level');
                $table->string(column: 'app_profile');
                $table->longText(column: 'message');
                $table->json(column: 'context')->nullable();
                bhry98_common_database_columns(table: $table);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: LogsSystemModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
