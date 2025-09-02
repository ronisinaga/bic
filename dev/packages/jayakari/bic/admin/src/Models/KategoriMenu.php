<?php

namespace jayakari\bic\admin\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriMenu extends Model
{
    //tablename
    protected $table = 'bic_menu_kategori';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['kategori','icon','url','keterangan','inserted_by','updated_by'];

    public function menu(){
        return $this->hasMany('jayakari\bic\admin\Models\Menu','id_menu_kategori');
    }

    public function userCategory(){
        return $this->belongsToMany('jayakari\bic\admin\Models\UserCategory','bic_user_menu_kategori','id_user_kategori','id_menu_kategori');
    }
}
