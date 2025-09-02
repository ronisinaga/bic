<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 4/16/2018
 * Time: 7:31 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    //tablename
    protected $table = 'bic_videos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_isi_buku','url_youtube','keterangan','views','is_active','updated_by','inserted_by'];

    public function isiBuku(){
        return $this->belongsTo('jayakari\bic\admin\Models\BukuIsi','id_isi_buku','id');
    }

}