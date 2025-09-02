<?php

namespace jayakari\bic\admin\Models;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    //
    protected $table = 'bic_user_kategori';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['kategori','keterangan','inserted_by'];

    public function kategoriMenu(){
        return $this->belongsToMany('jayakari\bic\admin\Models\KategoriMenu','bic_user_menu_kategori','id_user_kategori','id_menu_kategori');
    }

    public function user(){
        return $this->belongsToMany('jayakari\bic\admin\Models\User','bic_user_kategori_user','id_user_kategori','id_user');
    }
}
