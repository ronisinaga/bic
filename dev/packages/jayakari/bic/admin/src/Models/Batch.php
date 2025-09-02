<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/20/2018
 * Time: 5:20 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{

    protected $table = 'bic_batch';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['batch','short','tahun','keterangan','is_editable','is_finished','inserted_by','updated_by'];

    public function topik()
    {
        return $this->hasMany(Topik::class,'id_batch');
    }
}