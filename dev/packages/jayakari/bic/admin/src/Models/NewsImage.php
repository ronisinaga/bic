<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 6/28/2018
 * Time: 4:29 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{

    protected $table = 'bic_news_image';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_news','path','file','file300x300','keterangan','inserted_by','updated_by'];

    public function news(){
        return $this->belongsTo('jayakari\bic\admin\Models\News','id_news');
    }

}