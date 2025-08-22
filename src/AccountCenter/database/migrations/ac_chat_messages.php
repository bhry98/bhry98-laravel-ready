<?php


use Bhry98\AccountCenter\Enums\AcChatMessagesTypes;
use Bhry98\AccountCenter\Models\AcChatChannelsModel;
use Bhry98\AccountCenter\Models\AcChatMessagesModel;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new AcChatMessagesModel)->getTable(),
            callback: function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->foreignId('channel_id')->references('id')->on((new AcChatChannelsModel)->getTable())->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('sender_id')->nullable()->references('id')->on((new UsersCoreModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
                $table->longText('body');
                $table->string('type', 50)->default(AcChatMessagesTypes::Text->name);
                $table->nullableMorphs('notifiable');
                $table->timestamp('read_at')->nullable();
                bhry98_common_database_columns($table, note: false);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new AcChatMessagesModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
