<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/23/2018
 * Time: 7:56 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalKataKunciTeknologi extends Model
{

    protected $table = 'bic_proposal_kata_kunci_teknologi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id_proposal','id_kata_kunci','id_level_2','id_level_1'];

    public function proposal(){
        return $this->belongsTo('jayakari\bic\admin\Models\Proposal','id_proposal','id');
    }

    public function kataKunciTeknologi(){
        return $this->belongsTo('jayakari\bic\admin\Models\KataKunciTeknologi','id_kata_kunci','id');
    }

    public function level2(){
        return $this->belongsTo('jayakari\bic\admin\Models\KataKunciTeknologi','id_level_2','id');
    }

    public function level1(){
        return $this->belongsTo('jayakari\bic\admin\Models\KataKunciTeknologi','id_level_1','id');
    }

}