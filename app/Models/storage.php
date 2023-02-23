<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class storage
 * @package App\Models
 * @version July 28, 2018, 3:48 am UTC
 *
 * @property \App\Models\inmueble inmueble
 * @property \App\Models\propertyarea propertyarea
 * @property integer inmueble_id
 * @property integer propertyarea_id
 * @property string shortname
 * @property string name
 * @property string observations
 */
class storage extends Model
{
    use SoftDeletes;

    public $table = 'storages';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inmueble_id',
        'propertyarea_id',
        'shortname',
        'name',
        'observations'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inmueble_id' => 'integer',
        'propertyarea_id' => 'integer',
        'shortname' => 'string',
        'name' => 'string',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'shortname' => 'required|max:8|min:3',
        'name' => 'required|max:15|min:3',
        'observations' => 'required|max:150|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inmueble()
    {
        return $this->belongsTo(\App\Models\inmueble::class, 'inmueble_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function propertyarea()
    {
        return $this->belongsTo(\App\Models\propertyarea::class, 'propertyarea_id', 'id');
    }
}
