<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/18/2018
 * Time: 9:18 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class IPR extends Model
{

    protected $table = 'bic_mst_ipr';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['ipr','kode','keterangan','inserted_by','updated_by'];

    public function proposal(){
        return $this->belongsToMany('jayakari\bic\admin\Models\Proposal','bic_proposal_ipr','id_ipr','id_proposal')
                                    ->withPivot(['no_patent']);
    }

}