<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/22/2018
 * Time: 4:44 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{

    protected $table = 'bic_proposal';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = [
        'id_inovator',
        'judul',
        'abstrak',
        'deskripsi',
        'keunggulan_teknologi',
        'potensi_aplikasi',
        'tgl_pembuatan',
        'id_development',
        'id_arn',
        'catatan',
        'status',
        'is_always_active',
        'inserted_by',
        'updated_by'
    ];


    public function statusProposal()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\StatusProposal','status','id');
    }

    public function development()
    {
        return $this->belongsTo('jayakari\bic\admin\Models\Development','id_development','id');
    }

    public function arn()
    {
        return $this->belongsTo(ARN::class,'id_arn');
    }

   public function kataKunciTeknologi(){
        return $this->belongsToMany('jayakari\bic\admin\Models\KataKunciTeknologi','bic_proposal_kata_kunci_teknologi','id_proposal','id_kata_kunci')
                                    ->withPivot(['id_level_1','id_level_2']);
    }

    public function kunciTeknologi(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalKataKunciTeknologi','id_proposal','id');
    }

    public function kataKunciAplikasi(){
        return $this->belongsToMany('jayakari\bic\admin\Models\KataKunciTeknologi','bic_proposal_kata_kunci_aplikasi','id_proposal','id_kata_kunci')
                                    ->withPivot(['id_level_1','id_level_2']);
    }

    public function kunciAplikasi(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalKataKunciAplikasi','id_proposal','id');
    }

    public function kataKunciKolaborasi(){
        return $this->belongsToMany('jayakari\bic\admin\Models\KataKunciTeknologi','bic_proposal_kata_kunci_kolaborasi','id_proposal','id_kata_kunci')
                                    ->withPivot(['id_level_1']);
    }

    public function kunciKolaborasi(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalKataKunciKolaborasi','id_proposal','id');
    }

    public function proposalKataKunciKolaborasi(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalKataKunciKolaborasi','id_proposal','id');
    }

    public function instansi(){
        return $this->hasOne(ProposalInstansi::class,'id_proposal');
    }

    public function isiBuku(){
        return $this->hasOne('jayakari\bic\admin\Models\BukuIsi','id_proposal');
    }

    public function user(){
        return $this->belongsTo('jayakari\bic\admin\Models\User','id_inovator','id');
    }

    public function file(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalFile','id_proposal','id');
    }

    public function url(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalURL','id_proposal','id');
    }

    public function inovasiMember(){
        return $this->belongsToMany('jayakari\bic\admin\Models\InovatorMember','bic_proposal_inovator_member','id_proposal','id_inovator_member')
            ->withPivot(['id_rsc','name','email','institusi','telp','alamat','inserted_by','updated_by']);
    }

    public function inovatorMember(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalInovatorMember','id_proposal');
    }

    /*public function juri(){
        return $this->belongsToMany('jayakari\bic\admin\Models\User','bic_proposal_juri','id_proposal','id_juri')
            ->withPivot(['nilai_1','id_kata_kunci_teknologi','nilai_2','nilai_3','nilai_4','nilai_5','nilai_6','nilai_7','nilai_8','nilai_9','average','is_complete']);
    }*/

    public function ipr(){
        return $this->belongsToMany('jayakari\bic\admin\Models\IPR','bic_proposal_ipr','id_proposal','id_ipr')
                                    ->withPivot(['no_patent']);
    }

    public function proposalIPR(){
        return $this->hasMany(ProposalIPR::class,'id_proposal');
    }

    public function message(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalMessage','id_proposal','id');
    }

    public function review(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalReview','id_proposal','id');
    }

    public function nilaiJuri(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalJuri','id_proposal','id');
    }

    public function masukanTeknis(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalMasukanTeknis','id_proposal','id');
    }

    public function filePemenang(){
        return $this->hasMany(ProposalPemenangFile::class,'id_proposal','id');
    }

    public function advancedPemenang(){
        return $this->hasMany(ProposalPemenangAdvanced::class,'id_proposal','id');
    }

    public function videoPemenang(){
        return $this->hasMany(ProposalPemenangVideo::class,'id_proposal','id');
    }

    public function videoInReview(){
        return $this->hasMany(BukuIsiVideo::class,'id_proposal','id');
    }

    public function fileInReview(){
        return $this->hasMany(BukuIsiFile::class,'id_proposal','id');
    }

    public function member(){
        return $this->hasMany(ProposalInovatorMember::class ,'id_proposal');
    }

}