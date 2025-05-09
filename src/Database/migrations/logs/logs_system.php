<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Bhry98\Bhry98LaravelReady\Models\logs\LogsSystemModel;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table:LogsSystemModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->foreignId(column: 'user_id')
                    ->nullable()
                    ->references(column: 'id')
                    ->on(table: \Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel::TABLE_NAME)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->string('log_level');
                $table->string('app_profile');
                $table->longText('message');
                $table->json('context')->nullable();
                $table->timestamps();

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
