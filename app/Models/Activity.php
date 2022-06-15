<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'activities';

    public function event(){
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

}
