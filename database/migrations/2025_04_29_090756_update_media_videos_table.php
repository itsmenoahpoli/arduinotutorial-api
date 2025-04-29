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
        Schema::table('media_videos', function (Blueprint $table) {
            $table->dropColumn([
                'question1',
                'answer1',
                'question2',
                'answer2',
                'question3',
                'answer3',
                'question4',
                'answer4',
                'question5',
                'answer5'
            ]);

            $table->text('questions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media_videos', function (Blueprint $table) {
            $table->dropColumn('questions');

        });
    }
};
