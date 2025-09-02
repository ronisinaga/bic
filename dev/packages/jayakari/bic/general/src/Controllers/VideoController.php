<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 8/21/2018
 * Time: 10:53 AM
 */

namespace jayakari\bic\general\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use jayakari\bic\admin\Models\Buku;
use jayakari\bic\admin\Models\UserMenuCategory;
use jayakari\bic\admin\Models\Videos;

class VideoController extends Controller
{

    public function all(Request $request){
        $videos = Videos::orderBy('id','desc')->get();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.video.all',[
            "videos"=>$videos,
            "buku"=>$buku,
            "kategoriMenu"=>$kategoriMenu
        ]);
    }

}