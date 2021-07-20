<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // modifying fields value before inserting
    public function setFeaturedAttribute($value)
    {
        $this->attributes['featured'] = (Str::lower($value) === 'yes') ? 1 : 0;
    }

    public function setAvailableAttribute($value)
    {
        $this->attributes['available'] = (Str::lower($value) === 'yes') ? 1 : 0;
    }

    public function setActiveFlagAttribute($value)
    {
        $this->attributes['active_flag'] = (Str::lower($value) === 'yes') ? 1 : 0;
    }

    // modifying fields value before accessing
    public function getFeaturedAttribute($value)
    {
        return ($value) ? 'Yes' : 'No';
    }

    public function getAvailableAttribute($value)
    {
        return ($value) ? 'Yes' : 'No';
    }

    public function getActiveFlagAttribute($value)
    {
        return ($value) ? 'Yes' : 'No';
    }

    public function getCreatedAtAttribute($value)
    {
        return dateFormat($value);
    }

}
