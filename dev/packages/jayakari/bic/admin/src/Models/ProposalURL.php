<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/29/2020
 * Time: 11:48 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalURL extends Model
{

    protected $table = 'bic_proposal_url';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_proposal','url','inserted_by','updated_by'];

    public function proposal(){
        return $this->belongsTo(Proposal::class,'id_proposal');
    }

}