<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 3/5/2019
 * Time: 10:51 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalPemenangVideo extends Model
{

    protected $table = 'bic_proposal_pemenang_video';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_proposal','video_id','description','inserted_by','updated_by'];

    public function proposal(){
        return $this->belongsTo(Proposal::class,'id_proposal');
    }

}