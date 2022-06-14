<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'locations';


    public function organizer() {
        return $this->belongsTo(Organizer::class, 'organizer_id', 'id');
    }

    public function events() {
        return $this->hasMany(Event::class, 'location_id', 'id');
    }

}
