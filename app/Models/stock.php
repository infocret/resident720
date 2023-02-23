<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class stock
 * @package App\Models
 * @version July 28, 2018, 4:14 am UTC
 *
 * @property \App\Models\storage storage
 * @property \App\Models\article article
 * @property integer storage_id
 * @property integer article_id
 * @property integer stock
 * @property string location
 * @property integer stock_max
 * @property integer stock_min
 * @property string observations
 */
class stock extends Model
{
    use SoftDeletes;

    public $table = 'stocks';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'storage_id',
        'article_id',
        'stock',
        'location',
        'stock_max',
        'stock_min',
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
        'stock' => 'integer',
        'location' => 'string',
        'stock_max' => 'integer',
        'stock_min' => 'integer',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'stock' => 'required|max:9999999|min:1',
        'location' => 'required|max:35|min:3',
        'stock_max' => 'required|max:9999999|min:1',
        'stock_min' => 'required|max:9999999|min:1',
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
}
