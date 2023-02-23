<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DocType
 * @package App\Models
 * @version April 20, 2018, 10:23 pm UTC
 *
 * @property \App\Models\file_type fileType
 * @property \Illuminate\Database\Eloquent\Collection persona_document
 * @property \Illuminate\Database\Eloquent\Collection pers_inmu_reltipo_req_doc
 * @property integer filetype_id
 * @property string nombre
 * @property integer sizemin
 * @property integer sizemax
 */
class DocType extends Model
{
    use SoftDeletes;

    public $table = 'doc_types';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'filetype_id',
        'nombre',
        'sizemin',
        'sizemax'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'filetype_id' => 'integer',
        'nombre' => 'string',
        'sizemin' => 'integer',
        'sizemax' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|max:100|min:3',
        'sizemin' => 'required',
        'sizemax' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function fileType()
    {
        return $this->belongsTo(\App\Models\FileType::class, 'filetype_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function personaDocuments()
    {
        return $this->hasMany(\App\Models\PersonaDocument::class, 'doctype_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function persInmuReltipoReqDocs()
    {
        return $this->hasMany(\App\Models\PersInmuReltipoReqDoc::class, 'doctype_id', 'id');
    }
}
