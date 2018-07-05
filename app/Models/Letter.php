<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Letter
 * @package App\Models
 * @version July 5, 2018, 3:59 pm CST
 *
 * @property \App\User user
 * @property integer user_id
 * @property string type
 * @property dateTime read_at
 * @property string title
 * @property string details
 */
class Letter extends Model
{
    use SoftDeletes;

    public $table = 'letters';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'type',
        'read_at',
        'title',
        'details'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'type' => 'string',
        'read_at' => 'datetime',
        'title' => 'string',
        'details' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'title' => 'required',
        'details' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }
}
