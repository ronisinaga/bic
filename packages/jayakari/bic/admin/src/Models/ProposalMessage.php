<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/1/2018
 * Time: 9:56 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalMessage extends Model
{

    protected $table = 'bic_proposal_message';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_proposal','id_sender','sender','receiver','id_receiver','judul','isi','status','inserted_by','updated_by'];

    public function proposal(){
        return $this->belongsTo('jayakari\bic\admin\Models\Proposal','id_proposal','id');
    }

    public function user(){
        return $this->belongsTo('jayakari\bic\admin\Models\User','id_sender','id');
    }

    public function receiver(){
        return $this->belongsTo(User::class,'id_receiver');
    }

}