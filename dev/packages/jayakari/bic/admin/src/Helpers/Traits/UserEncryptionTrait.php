<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/14/2018
 * Time: 9:57 PM
 */

namespace jayakari\bic\admin\Helpers\Traits;


/*
 * This trait will be used in model and will override method from base class Model, especially getAttribute and
 * setAttribute methods
 */
use Illuminate\Support\Facades\Crypt;

trait UserEncryptionTrait
{
    public function getAttribute($key){
        $value = parent::getAttribute($key);
        if (in_array($key,$this->encryptionTrait)){
            $value = Crypt::decrypt($value);
        }
        return $value;
    }

    public function setAttribute($key,$value){
        if(in_array($key,$this->encryptionTrait)){
            $value = Crypt::encrypt($value);
        }
        return parent::setAttribute($key,$value);
    }
}