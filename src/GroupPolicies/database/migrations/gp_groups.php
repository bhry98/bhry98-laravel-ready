<?php

use Bhry98\GP\Models\GPGroupsModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new GPGroupsModel)->getTable(),
            callback: function (Blueprint $table) {
                $table->id();
                $table->string('code')->index()->unique();
                $table->string('default_name');
                $table->string('default_description')->nullable();
                $table->boolean('can_delete')->default(true);
                $table->boolean('is_default')->default(false);
                bhry98_common_database_columns(table: $table, softDeletes: true, userLog: true, active: true, note: true);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new GPGroupsModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
