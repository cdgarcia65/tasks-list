<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get tasks completed today.
     */
    public function scopeToday()
    {
        return $this->whereBetween('deleted_at', [
            date("Y-m-d H:i:s", mktime(0, 0, 0)),
            date("Y-m-d H:i:s", mktime(23, 59, 59))
        ]);
    }

}
