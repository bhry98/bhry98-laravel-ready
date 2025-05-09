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
                $table->foreignId(column: 'to_user_id')
                    ->references(column: 'id')
                    ->on(table: UsersCoreUsersModel::TABLE_NAME)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->foreignId(column: 'from_user_id')
                    ->nullable()
                    ->references(column: 'id')
                    ->on(table: UsersCoreUsersModel::TABLE_NAME)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->string(column: 'module');
                $table->string(column: 'type');
                $table->string(column: 'title');
                $table->string(column: 'message');
                $table->string(column: 'url');
                $table->string(column: 'icon')->nullable();
                $table->string(column: 'color')->nullable();
                $table->string(column: 'is_read')->default(value: false);
                $table->timestamp(column: 'read_at')->nullable();
                $table->timestamp(column: 'created_at')->useCurrent();
                $table->timestamp(column: 'updated_at')->useCurrentOnUpdate();
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
