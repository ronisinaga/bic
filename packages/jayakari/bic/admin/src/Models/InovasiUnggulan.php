<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 7/6/2018
 * Time: 10:10 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class InovasiUnggulan extends Model
{
    protected $table = 'bic_inovasi_unggulan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['tanggal','tema','keterangan','is_active','inserted_by','updated_by'];

    public function isi(){
        return $this->hasMany('jayakari\bic\admin\Models\InovasiUnggulanIsi','id_inovasi_unggulan','id');
    }

}