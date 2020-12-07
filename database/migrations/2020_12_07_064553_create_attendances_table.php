<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->dateTime('time_in', 0);
            $table->dateTime('time_out', 0)->nullable();
            $table->datetime('break1_start', 0)->nullable();
            $table->datetime('break1_end', 0)->nullable();
            $table->datetime('break2_start', 0)->nullable();
            $table->datetime('break2_end', 0)->nullable();
            $table->datetime('break3_start', 0)->nullable();
            $table->datetime('break3_end', 0)->nullable();
            $table->datetime('break4_start', 0)->nullable();
            $table->datetime('break4_end', 0)->nullable();
            $table->smallInteger('status')->nullable();
            $table->string('time_in_image')->nullable();
            $table->string('time_out_image')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
