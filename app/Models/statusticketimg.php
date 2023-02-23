<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class statusticketimg
 * @package App\Models
 * @version July 28, 2018, 3:33 am UTC
 *
 * @property \App\Models\statusticket statusticket
 * @property integer statusticket_id
 * @property string filename
 * @property string link
 * @property string observations
 */
class statusticketimg extends Model
{
    use SoftDeletes;

    public $table = 'statusticketimgs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'statusticket_id',
        'filename',
        'link',
        'observations'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'statusticket_id' => 'integer',
        'filename' => 'string',
        'link' => 'string',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'filename' => 'required|max:20|min:3',
        'link' => 'required|max:150|min:3',
        'observations' => 'required|max:150|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function statusticket()
    {
        return $this->belongsTo(\App\Models\statusticket::class, 'statusticket_id', 'id');
    }
}
