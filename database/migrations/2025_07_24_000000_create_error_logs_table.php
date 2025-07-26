<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErrorLogsTable extends Migration
{
    public function up()
    {
        Schema::create('error_logs', function (Blueprint $table) {
            $table->id();
            $table->string('error_message');
            $table->text('stack_trace')->nullable();
            $table->string('file')->nullable();
            $table->integer('line')->nullable();
            $table->string('error_code')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('error_logs');
    }
}
