<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/4/2018
 * Time: 10:02 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class DictionaryKategori extends Model
{

    protected $table = 'bic_mst_dictionary_kategori';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['kategori','kode','tipe_input','keterangan','inserted_by','updated_by'];

    public function dictionary(){
        return $this->hasMany('jayakari\bic\admin\Models\Dictionary','id_dictionary_kategori','id');
    }

}