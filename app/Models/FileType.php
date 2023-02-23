<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FileType
 * @package App\Models
 * @version April 20, 2018, 9:49 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection doc_types
 * @property string ident
 * @property string nombre
 * @property string ext
 * @property string mimetype
 */
class FileType extends Model
{
    use SoftDeletes;

    public $table = 'file_types';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'ident',
        'nombre',
        'ext',
        'mimetype'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ident' => 'string',
        'nombre' => 'string',
        'ext' => 'string',
        'mimetype' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ident' => 'required|max:8|min:4',
        'nombre' => 'required|max:25|min:5',
        'ext' => 'required|max:15|min:5',
        'mimetype' => 'required|max:50|min:3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function docTypes()
    {
        return $this->hasMany(\App\Models\DocTypes::class, 'filetype_id', 'id');
    }
}
