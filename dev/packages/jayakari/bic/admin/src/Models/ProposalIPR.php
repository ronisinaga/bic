<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/31/2018
 * Time: 4:02 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalIPR extends Model
{

    protected $table = 'bic_proposal_ipr';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id_proposal','id_ipr','no_patent'];

    public function proposal(){
        return $this->belongsTo(Proposal::class,'id_proposal');
    }

    public function ipr(){
        return $this->belongsTo(IPR::class,'id_ipr');
    }

}