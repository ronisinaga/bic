<?php

namespace jayakari\bic\admin\Models;

use Illuminate\Database\Eloquent\Model;

class UserCategoryUser extends Model
{
    //
    protected $table = 'bic_user_kategori_user';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id_user','id_user_kategori'];

    public function user()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\User','id_user','id');
    }

    public function userCategory()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\UserCategory','id_user_kategori','id');
    }
}
