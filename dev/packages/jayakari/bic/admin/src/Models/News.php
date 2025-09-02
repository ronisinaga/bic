<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 6/26/2018
 * Time: 7:32 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $table = 'bic_news';
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
        return $this->hasMany('jayakari\bic\admin\Models\NewsImage','id_news','id');
    }

    public function file(){
        return $this->hasMany('jayakari\bic\admin\Models\NewsFile','id_news','id');
    }

    public function comment(){
        return $this->hasMany('jayakari\bic\admin\Models\NewsComment','id_news','id');
    }

}