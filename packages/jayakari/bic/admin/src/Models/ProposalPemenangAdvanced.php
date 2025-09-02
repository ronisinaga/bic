<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 3/5/2019
 * Time: 6:31 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalPemenangAdvanced extends Model
{

    protected $table = 'bic_proposal_pemenang_advanced';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_proposal','id_ipr','ipr_no_patent','id_development','description','inserted_by','updated_by'];

    public function proposal(){
        return $this->belongsTo(Proposal::class,'id_proposal');
    }

    public function ipr(){
        return $this->belongsTo(IPR::class,'id_ipr');
    }

    public function development(){
        return $this->belongsTo(Development::class,'id_development');
    }

}