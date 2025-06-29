<?php

use Bhry98\Bhry98LaravelReady\Models\rbac\{
    RBACPermissionsModel,
    RBACGroupsModel,
    RBACGroupsPermissionsModel,
    RBACGroupsUsersModel
};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: RBACPermissionsModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->string('code')->index()->unique()->comment(comment: "example => [ModuleName].[OperationName].[ActionName] => Core.CoreUsers.Create || Core.AzureUsers.Update");
                $table->string('default_name')->nullable();
                $table->string('default_description')->nullable();
                $table->boolean('is_default')->default(false);
                bhry98_common_database_columns(table: $table);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: RBACPermissionsModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
