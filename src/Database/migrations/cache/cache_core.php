<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Bhry98\Bhry98LaravelReady\Models\cache\{
    CacheCoreModel,
};

return new class extends Migration {

//    protected $connection = 'core';

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create(
            table: CacheCoreModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->string('key')->primary();
                $table->mediumText('value');
                $table->integer('expiration');
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
