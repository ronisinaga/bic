<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 7/6/2018
 * Time: 4:45 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class InovasiUnggulanIsi extends Model
{

    protected $table = 'bic_inovasi_unggulan_isi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_inovasi_unggulan','id_isi_buku','tanggal','inserted_by','updated_by'];

    public function inovasiUnggulan(){
        return $this->belongsTo('jayakari\bic\admin\Models\InovasiUnggulan','id_inovasi_unggulan','id');
    }

    public function isiBuku(){
        return $this->belongsTo('jayakari\bic\admin\Models\BukuIsi','id_isi_buku','id');
    }

}