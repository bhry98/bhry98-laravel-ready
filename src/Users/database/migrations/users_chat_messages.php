<?php


use Bhry98\Users\Enums\UsersChatMessagesTypes;
use Bhry98\Users\Models\UsersChatChannelsModel;
use Bhry98\Users\Models\UsersChatMessagesModel;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new UsersChatMessagesModel)->getTable(),
            callback: function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->foreignId('channel_id')->references('id')->on((new UsersChatChannelsModel)->getTable())->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('sender_id')->nullable()->references('id')->on((new UsersCoreModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
                $table->text('body');
                $table->string('type', 50)->default(UsersChatMessagesTypes::Text->name);
                $table->timestamp('read_at')->nullable();
                bhry98_common_database_columns($table, softDeletes: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new UsersChatMessagesModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
