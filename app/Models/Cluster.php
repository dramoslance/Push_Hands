<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cluster extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'clusters';

    public function languages(){
        return $this->belongsToMany(Language::class, 'clusters_languages', 'cluster_id', 'language_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'cluster_id', 'id');
    }
    
}
