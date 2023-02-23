<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PersonaDocument
 * @package App\Models
 * @version April 21, 2018, 12:57 am UTC
 *
 * @property \App\Models\persona persona
 * @property \App\Models\doc_type docType
 * @property integer persona_id
 * @property integer doctype_id
 * @property string path
 * @property string filename
 * @property string link
 * @property integer activ
 */
class PersonaDocument extends Model
{
    use SoftDeletes;

    public $table = 'persona_documents';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'persona_id',
        'doctype_id',
        'path',
        'filename',
        'link',
        'activ'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'persona_id' => 'integer',
        'doctype_id' => 'integer',
        'path' => 'string',
        'filename' => 'string',
        'link' => 'string',
        'activ' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'path' => 'required|max:250|min:3',
        'filename' => 'required|max:100|min:3',
        'link' => 'required|max:250|min:3',
        'activ' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function persona()
    {
        return $this->belongsTo(\App\Models\persona::class, 'persona_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function docType()
    {
        return $this->belongsTo(\App\Models\DocType::class, 'doctype_id', 'id');
    }
}
