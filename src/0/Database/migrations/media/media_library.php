<?php

use Bhry98\Bhry98LaravelReady\Models\media\MediaLibraryModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(table: MediaLibraryModel::TABLE_NAME,
            callback: function (Blueprint $table) {
                $table->id();
                $table->morphs(name: 'model');
                $table->uuid()->nullable()->unique();
                $table->string(column: 'collection_name');
                $table->string(column: 'name');
                $table->string(column: 'file_name');
                $table->string(column: 'mime_type')->nullable();
                $table->string(column: 'disk');
                $table->string(column: 'conversions_disk')->nullable();
                $table->unsignedBigInteger(column: 'size');
                $table->json(column: 'manipulations');
                $table->json(column: 'custom_properties');
                $table->json(column: 'generated_conversions');
                $table->json(column: 'responsive_images');
                $table->unsignedInteger(column: 'order_column')->nullable()->index();
                $table->nullableTimestamps();
            });
    }
    public function down(): void
    {
        Schema::dropIfExists(table: MediaLibraryModel::TABLE_NAME);
    }
};
