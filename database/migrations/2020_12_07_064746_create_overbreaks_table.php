<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverbreaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overbreaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->date('overbreak_date')->nullable();
            $table->time('break1', 0)->nullable();
            $table->time('break2', 0)->nullable();
            $table->time('break3', 0)->nullable();
            $table->time('break4', 0)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('overbreaks');
    }
}
