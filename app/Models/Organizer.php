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
        'language_id',
        'created_user_id',
        'modified_user_id'
    ];

    protected $hidden = [
        'created_user_id',
        'modified_user_id',
    ];

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'organizers_languages')
            ->withPivot('organizer_id', 'name', 'description')
            ->withTimestamps();
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id', 'id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'organizer_id', 'id');
    }

    public function scopeLanguage($query, $id)
    {
        return $query->join('organizers_languages as ol', 'organizers.id', 'ol.organizer_id')
            ->join('languages as lang', 'lang.id', 'ol.language_id')
            // ->select('ol.name')
            ->where('organizers.id', $id)
            ->where('lang.iso_code', request('lang_code'))
            ->first();
    }

    public function scopeMultiLanguages($query, $id = null)
    {
        return $query->join('organizers_languages as ol', 'organizers.id', 'ol.organizer_id')
            ->join('languages as lang', 'lang.id', 'ol.language_id')
            ->select('ol.organizer_id','organizers.portrait','organizers.portrait',
            'organizers.email','organizers.phone','organizers.website','ol.language_id','lang.iso_code','ol.name','ol.description')
            ->when(request('lang_code') !== null, function ($q) {
                return $q->where('lang.iso_code', request('lang_code'));
            })
            ->when($id !== null, function ($q) use ($id) {
                return $q->where('organizers.id', $id);
            })
            ->get();
    }
}