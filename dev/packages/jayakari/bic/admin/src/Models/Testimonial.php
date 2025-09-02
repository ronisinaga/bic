<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 6/29/2018
 * Time: 4:57 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{

    protected $table = 'bic_testimonial';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['name','pekerjaan','testimonial','dates','is_active','path','file','inserted_by','updated_by'];

}