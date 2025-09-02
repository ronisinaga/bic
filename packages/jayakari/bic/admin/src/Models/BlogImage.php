<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 8/22/2020
 * Time: 4:28 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{

    protected $table = 'bic_blog_images';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_blog','path','file','file300x300','keterangan','inserted_by','updated_by'];

    public function blog(){
        return $this->belongsTo('jayakari\bic\admin\Models\Blog','id_blog');
    }

}