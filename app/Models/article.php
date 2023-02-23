<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class article
 * @package App\Models
 * @version July 28, 2018, 4:09 am UTC
 *
 * @property \App\Models\articlescategorie articlescategorie
 * @property integer articlescategorie_id
 * @property string cve
 * @property string shortname
 * @property string name
 * @property string description
 * @property string measurement
 * @property string barcode
 * @property string observations
 */
class article extends Model
{
    use SoftDeletes;

    public $table = 'articles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'articlescategorie_id',
        'cve',
        'shortname',
        'name',
        'description',
        'measurement',
        'barcode',
        'observations'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'articlescategorie_id' => 'integer',
        'cve' => 'string',
        'shortname' => 'string',
        'name' => 'string',
        'description' => 'string',
        'measurement' => 'string',
        'barcode' => 'string',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cve' => 'required|max:8|min:3',
        'shortname' => 'required|max:8|min:3',
        'name' => 'required|max:20|min:3',
        'description' => 'required|max:35|min:3',
        'measurement' => 'required|max:5|min:3',
        'barcode' => 'required|max:50|min:3',
        'observations' => 'required|max:150|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function articlescategorie()
    {
        return $this->belongsTo(\App\Models\articlescategorie::class, 'articlescategorie_id', 'id');
    }
}
