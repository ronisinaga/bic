<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 3/8/2018
 * Time: 7:21 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalKataKunciKolaborasi extends Model
{

    protected $table = 'bic_proposal_kata_kunci_kolaborasi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id_proposal','id_kata_kunci','id_level_1'];

    public function kataKunciKolaborasi()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\KataKunciTeknologi','id_kata_kunci','id');
    }

    public function level1()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\KataKunciTeknologi','id_level_1','id');
    }

    public function proposal()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\Proposal','id_proposal','id');
    }

}