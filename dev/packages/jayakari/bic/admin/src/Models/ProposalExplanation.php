<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/28/2020
 * Time: 9:50 AM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class ProposalExplanation extends Model
{

    protected $table = 'bic_proposal_explanation';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = [
        'judul',
        'proposal_type',
        'highlight',
        'abstrak',
        'deskripsi',
        'keunggulan_teknologi',
        'potensi_aplikasi',
        'inserted_by',
        'updated_by'
    ];

}