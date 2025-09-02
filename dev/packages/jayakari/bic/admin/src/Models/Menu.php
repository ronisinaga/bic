<?php

namespace jayakari\bic\admin\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //tablename
    protected $table = 'bic_menus';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['menu','icon','id_menu_kategori','url','keterangan','inserted_by','updated_by'];

    public function kategoriMenu(){
        return $this->belongsTo('jayakari\bic\admin\Models\KategoriMenu','id_menu_kategori');
    }
}
