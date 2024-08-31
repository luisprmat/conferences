<?php

use App\Enums\Talk;
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
        Schema::create('talks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('abstract');
            $table->string('length')->default(Talk\Length::Normal);
            $table->string('status')->default(Talk\Status::Submitted);
            $table->boolean('new_talk')->default(true);
            $table->foreignId('speaker_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talks');
    }
};
