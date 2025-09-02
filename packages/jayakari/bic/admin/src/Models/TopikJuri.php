<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/21/2018
 * Time: 5:44 PM
 */

namespace jayakari\bic\admin\Models;


use Illuminate\Database\Eloquent\Model;

class TopikJuri extends Model
{

    protected $table = 'bic_topik_juri';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_topik','id_juri','inserted_by','updated_by'];

    public function topik(){
        return $this->belongsTo('jayakari\bic\admin\Models\Topik','id_topik','id');
    }

    public function juri(){
        return $this->belongsTo('jayakari\bic\admin\Models\User','id_juri','id');
    }

}