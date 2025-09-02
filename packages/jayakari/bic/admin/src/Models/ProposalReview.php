<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/5/2018
 * Time: 4:38 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalReview extends Model
{

    protected $table = 'bic_proposal_review';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_proposal','judul','review','status','inserted_by','updated_by'];

    public function proposal(){
        return $this->belongsTo('jayakari\bic\admin\Models\Proposal','id_proposal','id');
    }

}