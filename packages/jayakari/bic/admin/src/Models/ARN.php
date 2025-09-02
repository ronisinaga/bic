<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/18/2018
 * Time: 9:15 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ARN extends Model
{
    protected $table = 'bic_mst_arn';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['arn','kode','keterangan','inserted_by','updated_by'];

    public function proposal(){
        return $this->hasMany('jayakari\bic\admin\Models\Proposal','id_arn','id');
    }

}