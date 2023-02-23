<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class stockmovement
 * @package App\Models
 * @version July 28, 2018, 4:23 am UTC
 *
 * @property \App\Models\storage storage
 * @property \App\Models\article article
 * @property \App\Models\user user
 * @property integer storage_id
 * @property integer article_id
 * @property integer user_id
 * @property string reference
 * @property dateTime date
 * @property integer quantity
 * @property string mov_type
 * @property string observations
 */
class stockmovement extends Model
{
    use SoftDeletes;

    public $table = 'stockmovements';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'storage_id',
        'article_id',
        'user_id',
        'reference',
        'date',
        'quantity',
        'mov_type',
        'observations'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'storage_id' => 'integer',
        'article_id' => 'integer',
        'user_id' => 'integer',
        'reference' => 'string',
        'date' => 'datetime',
        'quantity' => 'integer',
        'mov_type' => 'string',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'reference' => 'required|max:45|min:3',
        'date' => 'required',
        'quantity' => 'required|max:999999|min:1',
        'mov_type' => 'required|max:3|min:3',
        'observations' => 'required|max:150|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function storage()
    {
        return $this->belongsTo(\App\Models\storage::class, 'storage_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function article()
    {
        return $this->belongsTo(\App\Models\article::class, 'article_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\user::class, 'user_id', 'id');
    }
}
