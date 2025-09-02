<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 7/3/2018
 * Time: 7:55 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class BukuIsiFile extends Model
{

    protected $table = 'bic_buku_isi_file';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_isi_buku','path','file','keterangan','inserted_by','updated_by'];

    public function isiBuku()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\BukuIsi', 'id_isi_buku', 'id');
    }

}