<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class checkbookprint
 * @package App\Models
 * @version March 27, 2020, 2:11 am UTC
 *
 * @property \App\Models\checkbooks checkbooks
 * @property integer checkbook_id
 * @property string desc
 * @property string imgsample
 * @property string cssfile
 */
class checkbookprint extends Model
{
    use SoftDeletes;

    public $table = 'checkbookprints';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'checkbook_id',
        'desc',
        'imgsample',
        'cssfile'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'checkbook_id' => 'integer',
        'desc' => 'string',
        'imgsample' => 'string',
        'cssfile' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'desc' => 'required|max:25|min:1',
        'imgsample' => 'required|max:150|min:1',
        'cssfile' => 'required|max:150|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function checkbooks()
    {
        return $this->belongsTo(\App\Models\checkbooks::class, 'checkbook_id', 'id');
    }
}
