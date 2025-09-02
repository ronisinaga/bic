<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 8/22/2020
 * Time: 11:12 PM
 */

namespace jayakari\bic\general\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use jayakari\bic\admin\Models\Blog;
use jayakari\bic\admin\Models\BlogComment;
use jayakari\bic\admin\Models\Buku;
use jayakari\bic\admin\Models\UserMenuCategory;

class BlogController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function show(Request $request){
        $blog = Blog::where([
            'is_active'=>1
        ])->get();
        //$views = $blog->views+1;
        //Blog::where('id',$blog->id)->update(['views'=>$views]);
        $latestBlog = Blog::where([
            'is_active'=>1
        ])->orderBy('tanggal','desc')->take(5)->get();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.blog.index',[
            "latestBlog"=>$latestBlog,
            "blog"=>$blog,
            "buku"=>$buku,
            "kategoriMenu"=>$kategoriMenu
        ]);
    }

    public function index($title=''){
        if ($title == ''){
            $blog = Blog::where('is_active',1)->orderBy('tanggal','desc')->get();
            $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
            $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
            return view('jayakari.bic.general::pages.blog.index',[
                "blog"=>$blog,
                "buku"=>$buku,
                "kategoriMenu"=>$kategoriMenu
            ]);
        }else{
            $decode = urldecode($title);
            $decode = str_replace("_","+",$decode);
            $blog = Blog::where([
                'judul'=>$decode,
                'is_active'=>1
            ])->get()[0];
            $views = $blog->views+1;
            Blog::where('id',$blog->id)->update(['views'=>$views]);
            $latestBlog = Blog::where([
                'is_active'=>1
            ])->orderBy('tanggal','desc')->take(5)->get();
            $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
            $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
            return view('jayakari.bic.general::pages.blog.show',[
                "latestBlog"=>$latestBlog,
                "blog"=>$blog,
                "buku"=>$buku,
                "kategoriMenu"=>$kategoriMenu
            ]);
        }
    }

    public function saveComment(Request $request){
        $data = $request->input('data');
        $json = json_decode($data);
        $date = new \DateTime();
        BlogComment::create(['name' => $json->name,
            'id_blog'=>$json->id,
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

}