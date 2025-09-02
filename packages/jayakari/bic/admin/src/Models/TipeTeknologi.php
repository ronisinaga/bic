<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/22/2018
 * Time: 10:02 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class TipeTeknologi extends Model
{

    protected $table = 'bic_mst_tipe_teknologi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['tipe_teknologi','kode','keterangan','inserted_by','updated_by'];

    public function kataKunciTeknologi()
    {
        return $this->hasMany('jayakari\bic\admin\Models\KataKunciTeknologi','id','type');
    }

}