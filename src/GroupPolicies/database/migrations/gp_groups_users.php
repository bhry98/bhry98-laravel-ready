<?php

use Bhry98\GP\Models\GPGroupsModel;
use Bhry98\GP\Models\GPGroupsUsersModel;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new GPGroupsUsersModel)->getTable(),
            callback: function (Blueprint $table) {
                $table->id();
                $table->foreignId('group_id')->nullable()->references('id')->on((new GPGroupsModel)->getTable())->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('user_id')->nullable()->references('id')->on((new UsersCoreModel)->getTable())->cascadeOnUpdate()->cascadeOnDelete();
                bhry98_common_database_columns(table: $table, userLog: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new GPGroupsUsersModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
