<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 8/22/2020
 * Time: 10:02 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $table = 'bic_blogs';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_penulis','tanggal','judul','isi','views','is_active','inserted_by','updated_by'];

    public function penulis(){
        return $this->belongsTo('jayakari\bic\admin\Models\User','id_penulis','id');
    }

    public function image(){
        return $this->hasMany('jayakari\bic\admin\Models\BlogImage','id_blog','id');
    }

    public function comment(){
        return $this->hasMany('jayakari\bic\admin\Models\BlogComment','id_blog','id');
    }

}