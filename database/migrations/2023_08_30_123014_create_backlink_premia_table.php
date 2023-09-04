<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('backlink_premia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('backlink_id');
            $table->foreignId('member_id');
            $table->text('content')->nullable();
            $table->string('title')->nullable();
            $table->string('keywords');
            $table->string('website');
            $table->string('website_backlink')->nullable();
            $table->enum('staus', ['WAITING', 'PROCESS', 'SUCCESS'])->default('WAITING');
            $table->tinyInteger('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backlink_premia');
    }
};
