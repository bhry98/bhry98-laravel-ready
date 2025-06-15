<?php


use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersNotificationsModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: UsersNotificationsModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->foreignId(column: 'notifiable_id')
                    ->nullable()
                    ->references(column: 'id')
                    ->on(table: UsersCoreUsersModel::TABLE_NAME)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->foreignId(column: 'notifiable_type')
                    ->nullable();
                $table->foreignId(column: 'from_user_id')
                    ->nullable()
                    ->references(column: 'id')
                    ->on(table: UsersCoreUsersModel::TABLE_NAME)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->string(column: 'relation')->nullable();
                $table->string(column: 'relation_id')->nullable();
                $table->string(column: 'type');
                $table->string(column: 'title_key');
                $table->string(column: 'message_key');
                $table->string(column: 'note_key')->nullable();
                $table->string(column: 'icon')->nullable();
                $table->string(column: 'color')->nullable();
                $table->string(column: 'is_read')->default(value: false);
                $table->string(column: 'url')->nullable();
                $table->timestamp(column: 'read_at')->nullable();
                bhry98_common_database_columns($table);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: UsersNotificationsModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
