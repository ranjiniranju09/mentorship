<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MentorSession extends Model
{
    protected $table = 'mentor_sessions';

  protected $fillable = ['mentor_id', 'mentee_id', 'module_id','descriptions', 'calendar_link', 'slot_time', 'status'];


    // A session belongs to a mentor
    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

    // A session belongs to a mentee
    public function mentee()
    {
        return $this->belongsTo(Mentee::class, 'mentee_id');
    }

    // A session belongs to a module
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
    public function rescheduleRequests()
    {
        return $this->hasMany(RescheduleRequest::class, 'mentor_session_id');
    }

    
}
