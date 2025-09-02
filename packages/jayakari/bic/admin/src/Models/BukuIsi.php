<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 7/2/2018
 * Time: 12:05 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class BukuIsi extends Model
{

    protected $table = 'bic_buku_isi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = [
        'id_buku',
        'id_proposal',
        "id_arn",
        "id_teknologi",
        "id_aplikasi",
        'judul_singkat',
        'short_title',
        'judul_lengkap',
        'deskripsi_singkat',
        'short_description',
        'perspektif',
        'keunggulan_inovasi',
        'potensi_aplikasi',
        'inovator',
        'institusi',
        'alamat',
        'id_paten',
        'id_kesiapan_inovasi',
        'id_kerjasama_bisnis',
        'id_peringkat_inovasi',
        'orders',
        'page',
        'inserted_by',
        'updated_by'
    ];

    public function buku(){
        return $this->belongsTo('jayakari\bic\admin\Models\Buku','id_buku','id');
    }

    public function proposal(){
        return $this->belongsTo(Proposal::class,'id_proposal');
    }

    public function file(){
        return $this->hasMany('jayakari\bic\admin\Models\BukuIsiFile','id_isi_buku','id');
    }

    public function video(){
        return $this->hasMany('jayakari\bic\admin\Models\BukuIsiVideo','id_isi_buku','id');
    }

}