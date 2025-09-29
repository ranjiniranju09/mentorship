<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RescheduleRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_session_id',
        'mentor_id',
        'mentee_id',
        'reason',
        'status',
        'new_session_id',
    ];

    // Relationships
    public function session()
    {
        return $this->belongsTo(MentorSession::class, 'mentor_session_id');
    }

    // Relationship to the mentee directly (optional)
    public function mentee()
    {
        return $this->belongsTo(Mentee::class, 'mentee_id');
    }

    public function newSession()
    {
        return $this->belongsTo(MentorSession::class, 'new_session_id');
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

}
