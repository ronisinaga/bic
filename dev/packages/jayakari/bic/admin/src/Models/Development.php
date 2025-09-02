<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/22/2018
 * Time: 8:28 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class Development extends Model
{

    protected $table = 'bic_mst_development';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['development','kode','keterangan','inserted_by','updated_by'];

    public function proposal(){
        return $this->hasMany('jayakari\bic\admin\Models\Proposal','id_development','id');
    }

}