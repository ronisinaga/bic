<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 6/28/2018
 * Time: 11:54 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class NewsComment extends Model
{

    protected $table = 'bic_news_comment';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_news','name','email','comments','dates','inserted_by','updated_by'];

    public function news(){
        return $this->belongsTo('jayakari\bic\admin\Models\News','id_news');
    }

}