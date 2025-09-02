<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 7/3/2018
 * Time: 8:02 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class BukuIsiAplikasi extends Model
{

    protected $table = 'bic_buku_isi_aplikasi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id_isi_buku','id_aplikasi'];

    public function isiBuku()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\BukuIsi', 'id_isi_buku', 'id');
    }

    public function kataKunciAplikasi()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\KataKunciTeknologi', 'id_aplikasi', 'id');
    }

}