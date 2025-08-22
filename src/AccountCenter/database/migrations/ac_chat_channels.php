<?php


use Bhry98\AccountCenter\Enums\AcChatChannelsTypes;
use Bhry98\AccountCenter\Models\AcChatChannelsModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new AcChatChannelsModel)->getTable(),
            function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('type', '20')->default(AcChatChannelsTypes::OneToOne->name);
                bhry98_common_database_columns($table);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new AcChatChannelsModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
