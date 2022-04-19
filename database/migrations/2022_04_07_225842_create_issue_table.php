<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigIncrements('u_id')->unsigned();
            $table->foreign('u_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigIncrements('b_id')->unsigned();
            $table->foreign('b_id')->references('book_id')->on('books')->onDelete('cascade');
            $table->string('issue_date');
            $table->string('return_date')->nullable();
            $table->string('issue_status')->nullable();
            $table->timestamp('return_day')->nullable();
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
        Schema::dropIfExists('issue');
    }
}
