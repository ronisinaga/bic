<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/25/2018
 * Time: 6:21 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalInovatorMember extends Model
{

    protected $table = 'bic_proposal_inovator_member';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = [
        'id_proposal',
        'id_rsc',
        'id_inovator_member',
        'name',
        'email',
        'institusi',
        'alamat',
        'telp',
        'note',
        'note_updated_by',
        'note_updated_date',
        'inserted_by',
        'updated_by'
    ];

    public function rsc(){
        return $this->belongsTo('jayakari\bic\admin\Models\RSC','id_rsc','id');
    }

    public function proposal(){
        return $this->belongsTo('jayakari\bic\admin\Models\Proposal','id_proposal','id');
    }

    public function noteUpdatedBy(){
        return $this->belongsTo(User::class,'note_updated_by');
    }

}