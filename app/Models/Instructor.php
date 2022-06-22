<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table = 'instructors'

    public function locations () {
        return $this->belongsToMany(Location::class, 'staff','instructor_id','location_id')
    }
    
    public function events () {
        return $this->belongsToMany(Event::class, 'speakers','instructor_id','event_id')
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
