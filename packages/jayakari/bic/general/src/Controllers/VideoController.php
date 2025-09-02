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
use jayakari\bic\admin\Models\Blog;
use jayakari\bic\admin\Models\Buku;
use jayakari\bic\admin\Models\UserMenuCategory;
use jayakari\bic\admin\Models\VideoInnovator;
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

    public function video(Request $request){
        $videos = VideoInnovator::orderBy('inserted_date','asc')->get();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.video.inovator',[
            "videos"=>$videos,
            "buku"=>$buku,
            "kategoriMenu"=>$kategoriMenu
        ]);
    }

    public function videoDetail($title){
        $decode = urldecode($title);
        $decode = str_replace("_","+",$decode);
        $videos = VideoInnovator::where('title',$decode)->get()[0];
        $views = $videos->views+1;
        VideoInnovator::where('id',$videos->id)->update(['views'=>$views]);
        /*$latestBlog = Blog::where([
            'is_active'=>1
        ])->orderBy('tanggal','desc')->take(5)->get();*/
        $latestVideo = VideoInnovator::where([
            'is_active'=>1
        ])->orderBy('inserted_date','desc')->take(5)->get();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.video.inovator_detail',[
            "videos"=>$videos,
            "latestVideo"=>$latestVideo,
            "buku"=>$buku,
            "kategoriMenu"=>$kategoriMenu
        ]);
    }

}