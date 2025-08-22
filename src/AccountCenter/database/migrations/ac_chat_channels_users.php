<?php


use Bhry98\AccountCenter\Models\AcChatChannelsModel;
use Bhry98\AccountCenter\Models\AcChatChannelsUsersModel;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new AcChatChannelsUsersModel)->getTable(),
            callback: function (Blueprint $table) {
                $table->id();
                $table->foreignId('channel_id')->references('id')->on((new AcChatChannelsModel)->getTable())->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('user_id')->nullable()->references('id')->on((new UsersCoreModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
                $table->timestamp('last_read_at')->nullable();
                bhry98_common_database_columns($table);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new AcChatChannelsUsersModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
