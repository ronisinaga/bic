<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 4/14/2018
 * Time: 5:36 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalTempKataKunciTeknologi extends Model
{

    protected $table = 'bic_temp_proposal_kata_kunci_teknologi';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    //const CREATED_AT = 'inserted_date';
    //const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_proposal','id_kata_kunci'];

}