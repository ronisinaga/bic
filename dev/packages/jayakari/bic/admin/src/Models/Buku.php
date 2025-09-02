<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 7/1/2018
 * Time: 11:19 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{

    protected $table = 'bic_buku';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = [
        'id_batch',
        'judul',
        'folder_inreview',
        'folder_final',
        'cover_inreview',
        'cover_final',
        'book_final',
        'tgl_pembuatan',
        'is_active',
        'inserted_by',
        'updated_by'
    ];

    public function batch(){
        return $this->belongsTo('jayakari\bic\admin\Models\Batch','id_batch','id');
    }

}