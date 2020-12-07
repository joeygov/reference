<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id');
            $table->smallInteger('user_role')->default(1);
            $table->string('email')->nullable();
            $table->string('password');
            $table->smallInteger('user_status')->default(1);
            $table->boolean('is_wfh')->default(false);
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->date('birthdate')->nullable();
            $table->smallInteger('civil_status')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('contact_num', 13)->nullable();
            $table->integer('account_id')->nullable();
            $table->smallInteger('emp_status')->nullable();
            $table->boolean('is_flex')->default(false);
            $table->time('shift_starts', 0)->nullable();
            $table->time('shift_ends', 0)->nullable();
            $table->string('hdmf_num', 12)->nullable();
            $table->string('emp_image')->nullable();
            $table->binary('fingerprint')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
