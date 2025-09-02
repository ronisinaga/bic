<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/30/2018
 * Time: 4:44 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalFile extends Model
{

    protected $table = 'bic_proposal_file';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_proposal','file','path','public_path','inserted_by','updated_by'];

    public function proposal(){
        return $this->belongsTo('jayakari\bic\admin\Models\Proposal','id_proposal','id');
    }

}