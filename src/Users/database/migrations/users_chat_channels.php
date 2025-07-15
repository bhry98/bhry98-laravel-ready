<?php


use Bhry98\Users\Enums\UsersChatChannelsTypes;
use Bhry98\Users\Models\UsersChatChannelsModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new UsersChatChannelsModel)->getTable(),
            function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('type', '20')->default(UsersChatChannelsTypes::OneToOne->name);
                bhry98_common_database_columns($table);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new UsersChatChannelsModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
