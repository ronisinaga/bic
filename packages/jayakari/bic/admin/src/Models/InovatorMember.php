<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/25/2018
 * Time: 1:44 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class InovatorMember extends Model
{

    protected $table = 'bic_mst_inovator_member';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_inovator','name','email','institusi','alamat','telp','inserted_by','updated_by'];

    public function inovator(){
        return $this->belongsTo('jayakari\bic\admin\Models\User','id_inovator','id');
    }

    public function proposal(){
        return $this->belongsToMany('jayakari\bic\admin\Models\ProposalInovatorMember','bic_proposal_inovator_member','id_proposal','id_inovator_member')
            ->withPivot(['id_rsc','name','email','institusi','telp','alamat','inserted_by','updated_by']);
    }

}