<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('ID from users table');
            $table->decimal('working_days')->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('gross_salary')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->on('users')->references('id')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_salaries');
    }
}
