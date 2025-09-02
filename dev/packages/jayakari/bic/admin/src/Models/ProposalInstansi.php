<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/24/2018
 * Time: 2:43 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalInstansi extends Model
{

    protected $table = 'bic_proposal_instansi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_proposal','nama_instansi','bidang_usaha','id_employee','inserted_by','updated_by'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class,'id_proposal');
    }

    public function instansi(){
        return $this->belongsTo(Instansi::class ,'bidang_usaha');
    }

}