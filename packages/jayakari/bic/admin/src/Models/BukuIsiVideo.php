<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 4/10/2019
 * Time: 6:19 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class BukuIsiVideo extends Model
{

    protected $table = 'bic_buku_isi_video';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_isi_buku','youtube_url','keterangan','inserted_by','updated_by'];

    public function isiBuku()
    {
        return $this->belongsTo(BukuIsi::class, 'id_isi_buku', 'id');
    }

}