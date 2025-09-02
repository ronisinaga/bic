<?php

namespace jayakari\bic\admin\Models;

use Illuminate\Database\Eloquent\Model;

class UserMenuCategory extends Model
{
    //
    protected $table = 'bic_user_menu_kategori';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_menu_kategori','id_user_kategori'];

    public function userCategory()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\UserCategory','id_user_kategori','id');
    }

    public function menuCategory()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\KategoriMenu','id_menu_kategori','id');
    }
}
