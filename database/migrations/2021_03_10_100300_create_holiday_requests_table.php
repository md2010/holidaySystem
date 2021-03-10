<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidayRequestsTable extends Migration
{
    
    public function up()
    {
        Schema::create('holiday_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('fromDate');
            $table->date('toDate');
            $table->string('status')->default('sent');
            $table->string('teamLeaderApproval')->default('-');
            $table->string('projectManagerApproval')->default('-');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('holiday_requests');
    }
}
