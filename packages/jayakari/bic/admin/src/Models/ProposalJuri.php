<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/20/2018
 * Time: 8:47 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalJuri extends Model
{
    protected $table = 'bic_proposal_juri';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['id_topik','id_proposal','id_juri','nilai_1','nilai_2','nilai_3','nilai_4','nilai_5','nilai_6','nilai_7','nilai_8','nilai_9','average','alasan','is_complete','inserted_date'];

    public function topik(){
        return $this->belongsTo('jayakari\bic\admin\Models\Topik','id_topik','id');
    }

    public function proposal(){
        return $this->belongsTo('jayakari\bic\admin\Models\Proposal','id_proposal','id');
    }

    public function juri(){
        return $this->belongsTo('jayakari\bic\admin\Models\User','id_juri','id');
    }

}