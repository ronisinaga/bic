<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 3/4/2019
 * Time: 9:14 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalPemenangFile extends Model
{

    protected $table = 'bic_proposal_pemenang_file';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_proposal','types','path','name','description','inserted_by','updated_by'];

    public function proposal(){
        return $this->belongsTo(Proposal::class,'id_proposal');
    }

}