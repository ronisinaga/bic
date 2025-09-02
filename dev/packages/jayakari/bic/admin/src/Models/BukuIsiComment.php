<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 6/7/2019
 * Time: 9:22 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class BukuIsiComment extends Model
{

    protected $table = 'bic_buku_isi_comment';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_isi_buku','name','email','comment','inserted_by','updated_by'];

    public function isiBuku()
    {
        return $this->belongsTo(BukuIsi::class, 'id_isi_buku', 'id');
    }

}