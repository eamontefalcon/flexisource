<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer  extends Model
{
    protected $guarded = [];
    protected $appends = ['full_name'];
    protected $hidden = ['first_name', 'last_name', 'password'];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * Set the users password data to md5 format
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = md5($value);
    }


}
