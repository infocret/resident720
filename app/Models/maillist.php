<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class maillist
 * @package App\Models
 * @version October 27, 2018, 12:02 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property integer inmueble_id
 * @property string listtype
 * @property string email
 */
class maillist extends Model
{
    use SoftDeletes;

    public $table = 'maillists';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'listtype',
        'email'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmueble_id' => 'integer',
        'listtype' => 'string',
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'listtype' => 'required|max:8|min:1',
        'email' => 'required|max:60|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmueble()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmueble_id', 'id');
    }
}
