<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/18/2018
 * Time: 9:19 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class RSC extends Model
{

    protected $table = 'bic_mst_rsc';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['rsc','kode','keterangan','inserted_by','updated_by'];

    public function proposalInovatorMember(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalInovatorMember','id_rsc','id');
    }

}