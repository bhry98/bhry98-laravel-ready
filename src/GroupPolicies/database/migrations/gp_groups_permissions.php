<?php

use Bhry98\GP\Models\GPGroupsModel;
use Bhry98\GP\Models\GPGroupsPermissionsModel;
use Bhry98\GP\Models\GPPermissionsModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new GPGroupsPermissionsModel)->getTable(),
            callback: function (Blueprint $table) {
                $table->id();
                $table->foreignId('group_id')->nullable()->references('id')->on((new GPGroupsModel)->getTable())->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('permission_id')->nullable()->references('id')->on((new GPPermissionsModel)->getTable())->cascadeOnUpdate()->cascadeOnDelete();
                bhry98_common_database_columns(table: $table, userLog: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new GPGroupsPermissionsModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
