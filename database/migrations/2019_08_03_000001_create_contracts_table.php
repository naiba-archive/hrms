<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('house_id')->comment('绑定房间');
            $table->dateTime('establishment')->comment('合同建立');
            $table->dateTime('deadline')->comment('合同截止');
            $table->dateTime('last_pay')->comment('最后一次缴费时间');
            $table->dateTime('pay_duration')->comment('缴费间隔');
            $table->tinyInteger('type')->comment("合同类型，1 房东，2 租客");
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
        Schema::dropIfExists('contracts');
    }
}
