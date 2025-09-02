<?php

namespace jayakari\bic\admin\Models;

use Illuminate\Database\Eloquent\Model;
use jayakari\bic\admin\Helpers\Traits\UserEncryptionTrait;

class User extends Model
{
    //use UserEncryptionTrait;
    //
    protected $table = 'bic_user';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    const CREATED_AT = 'inserted_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = [
        'id_kategori_user',
        'ts_date',
        'register_date',
        'last_visit_date',
        'fullname',
        'nickname',
        'email',
        'password',
        'hp',
        'alamat',
        'jk',
        'alasan',
        'is_active',
        'file',
        'path',
        'note',
        'note_updated_by',
        'note_updated_date',
        'public_path',
        'inserted_by',
        'updated_by'
    ];
    //protected $encryptionTrait = ['password'];

    public function userCategory(){
        return $this->belongsToMany('jayakari\bic\admin\Models\UserCategory','bic_user_kategori_user','id_user','id_user_kategori');
    }

    public function inovatorMember(){
        return $this->hasMany('jayakari\bic\admin\Models\InovatorMember','id_inovator','id');
    }

    public function message(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalMessage','id_sender','id');
    }

    public function proposal()
    {
        return $this->hasMany('jayakari\bic\admin\Models\Proposal','id_inovator','id');
    }

    public function kataKunci(){
        return $this->belongsToMany('jayakari\bic\admin\Models\KataKunciTeknologi','bic_user_kata_kunci_teknologi','id_user','id_kata_kunci_teknologi');
    }

    public function proposalJuri(){
        return $this->hasMany('jayakari\bic\admin\Models\ProposalJuri','id_juri','id');
    }

    public function noteUpdatedBy(){
        return $this->belongsTo(User::class,'note_updated_by');
    }
}
