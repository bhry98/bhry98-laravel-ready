<?php

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
            table: RBACGroupsPermissionsModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->foreignId(column: 'group_id')
                    ->nullable()
                    ->references(column: 'id')
                    ->on(table: RBACGroupsModel::TABLE_NAME)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->foreignId(column: 'permission_id')
                    ->nullable()
                    ->references(column: 'id')
                    ->on(table: RBACPermissionsModel::TABLE_NAME)
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->timestamps();
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: RBACGroupsPermissionsModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
