<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Todo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'completed', 'user_id'
    ];

    protected $casts = [
        'complete' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
