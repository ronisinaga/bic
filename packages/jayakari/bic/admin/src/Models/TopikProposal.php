<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/21/2018
 * Time: 6:18 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class TopikProposal extends Model
{

    protected $table = 'bic_topik_proposal';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_topik','id_proposal','inserted_by','updated_by'];

    public function topik(){
        return $this->belongsTo('jayakari\bic\admin\Models\Topik','id_topik','id');
    }

    public function proposal(){
        return $this->belongsTo('jayakari\bic\admin\Models\Proposal','id_proposal','id');
    }

}