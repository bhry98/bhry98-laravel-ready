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
                // laravel default notification table
                $table->uuid('id')->primary();
                $table->string('type');
                $table->morphs('notifiable');
                $table->text('data');
                $table->timestamp('read_at')->nullable();
                $table->timestamps();
                // packages notification table
//                $table->foreignId(column: 'to_user_id')->nullable()->references(column: 'id')->on(table: UsersCoreUsersModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
//                $table->foreignId(column: 'from_user_id')->nullable()->references(column: 'id')->on(table: UsersCoreUsersModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
//                $table->string(column: 'relation')->nullable();
//                $table->string(column: 'reference_id')->nullable();
//                $table->string(column: 'url')->nullable();
//                $table->string(column: 'icon')->nullable();
//                $table->string(column: 'color')->nullable();
//                bhry98_common_database_columns(table: $table, softDeletes: true, userLog: true);
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
