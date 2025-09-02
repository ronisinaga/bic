<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/19/2018
 * Time: 6:47 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class KataKunciTeknologi extends Model
{
    protected $table = 'bic_mst_kata_kunci_teknologi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['type','level','level1','level2','level3','kata_kunci','parent','keterangan','inserted_by','updated_by'];

    public function tipeTeknologi()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\TipeTeknologi','type','id');
    }

    public function proposal(){
        return $this->belongsToMany('jayakari\bic\admin\Models\Proposal','bic_proposal_kata_kunci_teknologi','id_kata_kunci','id_proposal')
                                    ->withPivot(['id_level_1','id_level_2']);
    }

    public function proposalAplikasi(){
        return $this->belongsToMany('jayakari\bic\admin\Models\Proposal','bic_proposal_kata_kunci_aplikasi','id_kata_kunci','id_proposal')
                                ->withPivot(['id_level_1','id_level_2']);
    }

    public function proposalKolaborasi(){
        return $this->belongsToMany('jayakari\bic\admin\Models\Proposal','bic_proposal_kata_kunci_kolaborasi','id_kata_kunci','id_proposal')
            ->withPivot(['id_level_1']);
    }

    public function user(){
        return $this->belongsToMany('jayakari\bic\admin\Models\User','bic_user_kata_kunci_teknologi','id_kata_kunci_teknologi','id_user');
    }

}