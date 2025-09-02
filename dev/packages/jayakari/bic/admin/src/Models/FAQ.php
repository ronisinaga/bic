<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 5/8/2020
 * Time: 6:34 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{

    protected $table = 'bic_faq';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['faq_type','question','answer','inserted_by','updated_by'];

}