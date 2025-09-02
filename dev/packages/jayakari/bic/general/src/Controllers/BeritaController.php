<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 12/22/2017
 * Time: 9:58 AM
 */

namespace jayakari\bic\general\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use jayakari\bic\admin\Models\Buku;
use jayakari\bic\admin\Models\News;
use jayakari\bic\admin\Models\NewsComment;
use jayakari\bic\admin\Models\NewsFile;
use jayakari\bic\admin\Models\UserMenuCategory;


class BeritaController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function showBerita($kategori='utama',$title,$id=0){
        $decode = urldecode($title);
        $decode = str_replace("_","+",$decode);
        if ($id == 0){
            $news = News::where([
                'judul'=>$decode,
                'is_active'=>1
            ])->get()[0];
        }else{
            $news = News::where([
                'id'=>$id,
                'is_active'=>1
            ])->get()[0];
        }
        $views = $news->views+1;
        News::where('id',$news->id)->update(['views'=>$views]);
        $latestNews = News::where([
            'is_active'=>1
        ])->orderBy('tanggal','desc')->take(5)->get();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.berita.showBerita',[
            "latestNews"=>$latestNews,
            "news"=>$news,
            "buku"=>$buku,
            "kategoriMenu"=>$kategoriMenu
        ]);
    }

    public function all(Request $request){
        $news = News::where('is_active',1)->orderBy('tanggal','desc')->get();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.berita.all',[
            "news"=>$news,
            "buku"=>$buku,
            "kategoriMenu"=>$kategoriMenu
        ]);
    }

    public function saveComment(Request $request){
        $data = $request->input('data');
        $json = json_decode($data);
        $date = new \DateTime();
        NewsComment::create(['name' => $json->name,
            'id_news'=>$json->id,
            'dates'=>$date->format('Y-m-d H:i:s'),
            'email' => $json->email,
            'comments' => $json->comment,
            'inserted_by' =>0,
            'updated_by' =>0
        ]);

        $result = array(
            "sender" => "bic",
            "status" => 'success'
        );
        return response()->json($result);
    }

    public function download($id){
        //echo 'id:'.$id;
        $file = NewsFile::where('id',$id)->get()[0];
        return response()->download(public_path().'/storage/'.$file->path,$file->file);
    }
}