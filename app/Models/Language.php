<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'languages';

    public function organizers(){
        return $this->belongsToMany(Organizer::class, 'organizers_languages', 'language_id', 'organizer_id');
    }

    public function locations(){
        return $this->belongsToMany(Location::class, 'locations_languages', 'language_id', 'location_id');
    }

    public function activities(){
        return $this->belongsToMany(Activity::class, 'activities_languages', 'language_id', 'activity_id');
    }

    public function clusters(){
        return $this->belongsToMany(Cluster::class, 'clusters_languages', 'language_id', 'cluster_id');
    }

    public function speakers(){
        return $this->belongsToMany(Speaker::class, 'speakers_languages', 'language_id', 'speaker_id');
    }

    public function events(){
        return $this->belongsToMany(Event::class, 'events_languages', 'language_id', 'event_id');
    }
}
