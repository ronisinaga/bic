<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 4/25/2018
 * Time: 4:43 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalTempInstansi extends Model
{

    protected $table = 'bic_temp_proposal_instansi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_proposal','nama_instansi','bidang_usaha','id_employee','inserted_by','updated_by'];

    public function proposal()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\Proposal','id_proposal');
    }

}