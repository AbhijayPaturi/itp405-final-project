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
        Schema::create('tutorial_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('user_id');
            $table->unsignedBiginteger('tutorial_id');
            $table->timestamps();


            $table->foreign('user_id')->references('id')
                 ->on('users')->onDelete('cascade');
            $table->foreign('tutorial_id')->references('id')
                ->on('tutorials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorial_user');
    }
};
