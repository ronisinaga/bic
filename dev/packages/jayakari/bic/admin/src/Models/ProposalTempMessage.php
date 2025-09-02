<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 5/14/2018
 * Time: 10:50 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalTempMessage extends Model
{
    protected $table = 'bic_temp_proposal_message';
    protected $primaryKey = 't_titlen_autoid';
    public $incrementing = true;
    public $timestamps = false;
    //const CREATED_AT = 'inserted_date';
    //const UPDATED_AT = 'updated_date';
    protected $fillable = ['t_titlen_ts','t_titlen_userid','t_titlen_uid','t_titlen_status','t_titlen_desc'];

}