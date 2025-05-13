<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Bhry98\Bhry98LaravelReady\Models\cache\{
    CacheCoreModel,
};

return new class extends Migration {


    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: CacheCoreModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->string(column: 'key')->primary();
                $table->mediumText(column: 'value');
                $table->integer(column: 'expiration');
            });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(table: CacheCoreModel::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
};
