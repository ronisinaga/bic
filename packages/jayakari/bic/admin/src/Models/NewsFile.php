<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 7/25/2018
 * Time: 9:43 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class NewsFile extends Model
{

    protected $table = 'bic_news_file';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_news','path','file','inserted_by','updated_by'];

    public function news(){
        return $this->belongsTo('jayakari\bic\admin\Models\News','id_news');
    }

}