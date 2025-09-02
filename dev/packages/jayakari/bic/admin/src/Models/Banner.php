<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 6/28/2018
 * Time: 7:06 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'bic_banner';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['path','file','keterangan','is_active','inserted_by','updated_by'];

}