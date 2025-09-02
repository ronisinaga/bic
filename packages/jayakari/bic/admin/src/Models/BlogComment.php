<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 8/22/2020
 * Time: 6:29 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{

    protected $table = 'bic_blog_comments';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_blog','name','email','comments','dates','inserted_by','updated_by'];

    public function blog(){
        return $this->belongsTo('jayakari\bic\admin\Models\Blog','id_nblog');
    }

}