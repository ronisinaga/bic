<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/4/2018
 * Time: 10:02 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{

    protected $table = 'bic_mst_dictionary';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_dictionary_kategori','public_path','file','isi','keterangan','inserted_by','updated_by'];

    public function kategoriDictionary(){
        return $this->belongsTo('jayakari\bic\admin\Models\DictionaryKategori','id_dictionary_kategori','id');
    }

}