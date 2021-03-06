<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $casts = [
        'full_day' => 'boolean',
    ];

    protected $fillable = [
        'title', 'start','end', 'color', 'url', 'full_day'
    ];

    public function getAppointments()
    {
        return $this->whereDate('start', '>=', date('Y-m-d'))->count();
    }
}