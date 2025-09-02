<?php

namespace jayakari\bic\admin\Models;

use Illuminate\Database\Eloquent\Model;

class VideoInnovator extends Model
{

    protected $table = 'bic_video_innovators';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['id_innovator','title','url_youtube','keterangan','views','is_active','updated_by','inserted_by'];

    public function innovator(){
        return $this->belongsTo('jayakari\bic\admin\Models\User','id_innovator','id');
    }

}