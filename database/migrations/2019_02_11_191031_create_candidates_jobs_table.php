<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates_jobs', function (Blueprint $table) {
            $table->integer('candidates_id')->unsigned();
            $table->integer('jobs_id')->unsigned();
            $table->foreign('candidates_id')
                ->references('id')->on('candidates')
                ->onDelete('cascade');
            $table->foreign('jobs_id')
                ->references('id')->on('jobs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates_jobs');
    }
}
