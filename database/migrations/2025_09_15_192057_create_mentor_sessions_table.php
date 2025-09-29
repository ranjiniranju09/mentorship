<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('mentor_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mentor_id');
            $table->unsignedBigInteger('mentee_id')->nullable();
            $table->unsignedBigInteger('module_id')->nullable();
            $table->string('calendar_link')->nullable();
            $table->longText('descriptions')->nullable();
            $table->dateTime('slot_time');
            $table->enum('status', ['available', 'booked', 'cancelled'])->default('available');
            $table->unsignedBigInteger('reschedule_request_id')->nullable()->after('status');
            $table->timestamps();

            $table->foreign('mentor_id')->references('id')->on('mentors')->onDelete('cascade');
            $table->foreign('mentee_id')->references('id')->on('mentees')->onDelete('set null');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mentor_sessions');
    }
}
