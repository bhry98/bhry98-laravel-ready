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
            table: RBACGroupsModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->string(column: 'code')->index()->unique();
                $table->string(column: 'default_name');
                $table->string(column: 'description')->nullable();
                $table->boolean(column: 'can_delete')->default(value: true);
                $table->boolean(column: 'is_default')->default(value: false);
                $table->boolean(column: 'is_active')->default(value: true);
                $table->softDeletes();
                $table->timestamps();
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: RBACGroupsModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
