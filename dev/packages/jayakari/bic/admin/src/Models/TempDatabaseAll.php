<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 7/20/2018
 * Time: 5:31 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class TempDatabaseAll extends Model
{
    protected $table = 'bic_temp_database_all';
    protected $primaryKey = 'id_table_inovasi';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id_inovasi','id_proposal','field_buku_inovasi_indonesia','field_agenda_riset_nasional','field_kategori_teknologi',
    'field_kategori_aplikasi','field_judul_singkat','field_short_title','field_judul_teknis_proposal_lengkap','field_deskripsi_singkat',
    'field_short_description','field_nama_inovator','field_keunggulan_inovasi','field_potensi_aplikasi','field_perspektif','field_institusi',
    'field_alamat_','field_status_paten','field_kesiapan_inovasi','field_kerjasama_bisnis','field_peringkat_inovasi','field_gambar1','field_gambar2'];
}