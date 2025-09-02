<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 7/9/2018
 * Time: 11:33 AM
 */

namespace jayakari\bic\general\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use jayakari\bic\admin\Models\Buku;
use jayakari\bic\admin\Models\BukuIsi;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\User;
use jayakari\bic\admin\Models\UserMenuCategory;

class InovatorController extends Controller
{

    public function index($nick){
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = array();
        $user = User::where('nickname',$nick)->get();
        if (count($user) > 0){
            $user = $user[0];
            $fullname = $user->fullname;
            $proposal = Proposal::where(['status'=>8,'id_inovator'=>$user->id])->get();
            foreach ($proposal as $item){
                $inner = BukuIsi::where('id_proposal',$item->id)->get()[0];
                $buku[] = $inner;
            }
        }else{
            $fullname = "";
        }
        return view('jayakari.bic.general::pages.inovator.index',[
            "buku"=>$buku,
            "user"=>$fullname,
            "kategoriMenu"=>$kategoriMenu
        ]);
    }

}