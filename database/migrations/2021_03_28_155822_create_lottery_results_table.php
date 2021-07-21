<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteryResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lottery_results', function (Blueprint $table) {
            $table->integer('week', false);
            $table->string('week_date');
            $table->integer('w1');
            $table->integer('w2');
            $table->integer('w3');
            $table->integer('w4');
            $table->integer('w5');
            $table->integer('m1');
            $table->integer('m2');
            $table->integer('m3');
            $table->integer('m4');
            $table->integer('m5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lottery_results');
    }
}
