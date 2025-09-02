<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/20/2018
 * Time: 4:34 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalMasukanTeknis extends Model
{

    protected $table = 'bic_proposal_masukan_teknis';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_proposal','id_juri','masukan','inserted_by','updated_by'];

    public function proposal(){
        return $this->belongsTo('jayakari\bic\admin\Models\Proposal','id_proposal','id');
    }

    public function juri(){
        return $this->belongsTo('jayakari\bic\admin\Models\User','id_juri','id');
    }

}