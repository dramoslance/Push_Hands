<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * 
 *  @author Dayans R. <dramoslance@gmail.com>
 * 
 * 
 * Event model
 * 
 */

class Event extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'events';


    public function users()
    {
        return $this->belongsToMany(User::class, 'speakers', 'event_id', 'user_id');
    }

    public function location() {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function cluster() {
        return $this->belongsTo(Cluster::class, 'cluster_id', 'id');
    }

    public function organizer() {
        return $this->belongsTo(Organizer::class, 'organizer_id', 'id');
    }

    public function activities(){
        return $this->hasMany(Activity::class, 'event_id', 'id');
    }

    /**
     * 
     * Build the recurrent event to get the childs events
     * 
     */
    public function childs() {
        return $this->hasMany(Event::class, 'event_id', 'id');
    }


    /**
     * 
     * Build the recurrent event to get the parent event
     * 
     */
    public function parent() {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

}
