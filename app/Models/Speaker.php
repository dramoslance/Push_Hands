<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speaker extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'speakers';

    public function languages(){
        return $this->belongsToMany(Language::class, 'speakers_languages', 'speaker_id', 'language_id');
    }

    public function event() {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function instructor() {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }
}
