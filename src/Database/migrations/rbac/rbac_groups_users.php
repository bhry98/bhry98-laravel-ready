<?php

use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Bhry98\Bhry98LaravelReady\Models\rbac\{
    RBACPermissionsModel,
    RBACGroupsModel,
    RBACGroupsPermissionsModel,
    RBACGroupsUsersModel
};

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: RBACGroupsUsersModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->foreignId(column: 'group_id')->nullable()->references(column: 'id')->on(table: RBACGroupsModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId(column: 'user_id')->nullable()->references(column: 'id')->on(table: UsersCoreUsersModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
                bhry98_common_database_columns(table: $table, userLog: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: RBACGroupsUsersModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
