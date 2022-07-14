<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizer extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'organizers';

    protected $fillable = [
        'portrait',
        'name',
        'description',
        'email',
        'phone',
        'website',
        'user_id',
        'language_id',
        'created_user_id',
        'modified_user_id'
    ];

    public function languages(){
        return $this->belongsToMany(Language::class, 'organizers_languages', 'organizer_id', 'language_id')->withTimestamps();
    }

    public function users() {
        return $this->belongsToMany(User::class, 'members','organizer_id', 'user_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id', 'id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'organizer_id', 'id');
    }

}
