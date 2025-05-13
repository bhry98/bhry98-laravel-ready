<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Bhry98\Bhry98LaravelReady\Models\cache\{
    CacheLocksModel,
};

return new class extends Migration {

    public function up(): void
    {
        Schema::create(
            table: CacheLocksModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->string(column: 'key')->primary();
                $table->string(column: 'owner');
                $table->integer(column: 'expiration');
            });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: CacheLocksModel::TABLE_NAME);
    }
};
