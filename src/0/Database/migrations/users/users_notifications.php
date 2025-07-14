<?php


use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreModel;
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
                $table->uuid('id')->primary();
                $table->foreignId('from_user_id')->nullable()->references('id')->on(UsersCoreModel::TABLE_NAME)->cascadeOnUpdate()->nullOnDelete();
                $table->text('data');
//                $table->string('title_key');
//                $table->string('message_key');
//                $table->json('title_replaced')->nullable();
//                $table->string('message_replaced')->nullable();
                $table->string( 'icon')->nullable();
                $table->string( 'color')->nullable();
                $table->string( 'relation')->nullable();
                $table->string( 'relation_id')->nullable();
                ///////////
                $table->string('type');
                $table->morphs('notifiable');
                $table->timestamp('read_at')->nullable();
                ////
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
