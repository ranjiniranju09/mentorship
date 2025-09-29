<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reschedule_requests', function (Blueprint $table) {
            $table->id();

            // Link to mentor_sessions table
            $table->foreignId('mentor_session_id')->constrained('mentor_sessions')->onDelete('cascade');

            // Mentor & Mentee reference (for quick access)
            $table->foreignId('mentor_id')->constrained('mentors')->onDelete('cascade');
            $table->foreignId('mentee_id')->constrained('mentees')->onDelete('cascade');

            // Reason for reschedule (mentee will provide)
            $table->text('reason');

            // Status of request: pending, accepted, rejected
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');

            // If accepted, link to new slot (created by mentor)
            $table->foreignId('new_session_id')->nullable()->constrained('mentor_sessions')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reschedule_requests');
    }
};
