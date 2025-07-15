<?php

use Bhry98\Helpers\enums\SystemActionEnums;
use Bhry98\Helpers\models\LogsSystemModel;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create((new LogsSystemModel)->getTable(),
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->references('id')->on((new UsersCoreModel)->getTable())->cascadeOnUpdate()->nullOnUpdate();
                $table->string('action')->default(SystemActionEnums::Other->name);
                $table->string('log_level');
                $table->string('app_profile');
                $table->longText('message');
                $table->json('context')->nullable();
                bhry98_common_database_columns($table);
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists((new LogsSystemModel)->getTable());
        Schema::enableForeignKeyConstraints();
    }
};
