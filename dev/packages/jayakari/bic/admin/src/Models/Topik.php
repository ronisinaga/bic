<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/20/2018
 * Time: 6:17 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{

    protected $table = 'bic_topik';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_batch','topik','keterangan','inserted_by','updated_by'];

    public function batch(){
        return $this->belongsTo('jayakari\bic\admin\Models\Batch','id_batch','id');
    }

    public function proposalJuri(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalJuri','id_topik','id');
    }

    public function topikProposal(){
        return $this->hasMany('jayakari\bic\admin\Models\TopikProposal','id_topik','id');
    }

}