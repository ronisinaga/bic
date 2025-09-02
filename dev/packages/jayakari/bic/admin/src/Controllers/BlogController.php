<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 8/22/2020
 * Time: 9:53 AM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use jayakari\bic\admin\Models\Blog;
use jayakari\bic\admin\Models\BlogImage;
use jayakari\bic\admin\Models\User;

class BlogController extends Controller
{

    private $kategorilabel = 'manajemen blog';

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function index(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $blog = Blog::orderBy('tanggal','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.blog.index', [
                    "blog" => $blog,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.blog.index', [
                    "blog" => $blog,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function add(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.blog.add', [
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.blog.add', [
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function store(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $gambar = $request->file('gambar');
            if ($gambar->isValid()){
                $pathGambar = $gambar->store('blog','bic');
                $nonFile = $request->get('data_non_file');
                $json = json_decode($nonFile);
                $blog = new Blog();
                $blog->judul = $json->judul;
                $blog->isi = $json->isi;
                $date = new \DateTime($json->tanggal);
                $blog->tanggal = $date->format('Y-m-d H:i:s');
                $blog->inserted_by = $user->get()[0]->id;
                $blog->updated_by = $user->get()[0]->id;
                $blog->views = 0;
                $blog->is_active = 1;
                $blog->id_penulis = $user->get()[0]->id;
                $blog->save();
                $clientName = explode('.',$gambar->getClientOriginalName());
                $rename = str_replace(" ","_",$clientName[0]);
                $rename = str_replace(",","_",$rename);
                $rename = str_replace("-","_",$rename);
                $rename = str_replace(":","_",$rename);
                $img = new ImageManager(array('driver' => 'gd'));
                $img->make(public_path('storage/' . $pathGambar))->resize(300,300)->save(public_path('storage/blog/'.$rename.'300x300.'.$clientName[count($clientName)-1]));
                //insert non file data
                $blogImage = new BlogImage([
                    'path'=>$pathGambar,
                    'file'=>$gambar->getClientOriginalName(),
                    'file300x300'=>$rename.'300x300.'.$clientName[count($clientName)-1],
                    'keterangan'=> $json->keterangan,
                    'inserted_by'=>Cookie::get('userid'),
                    'updated_by'=>Cookie::get('userid')
                ]);
                $blog->image()->save($blogImage);
                $result = array(
                    "sender" => "BIC",
                    "status" => 'success',
                );
                return response()->json($result);
            }else{
                $result = array(
                    "sender" => "BIC",
                    "status" => 'failed'
                );
                return response()->json($result);
            }
        }
    }

    public function edit($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $blog= Blog::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.blog.edit', [
                    'blog' => $blog,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.blog.edit', [
                    'blog' => $blog,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function update(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $gambar = $request->file('gambar');
            $nonFile = $request->get('data_non_file');
            $json = json_decode($nonFile);
            $blog = Blog::where('id',$json->id);
            if ($gambar <> null){
                $date = new \DateTime($json->tanggal);
                $blog->update(['judul'=>$json->judul,
                    'tanggal'=>$date->format('Y-m-d'),
                    'isi'=>$json->isi,
                    //'keterangan'=>$json->keterangan,
                    'updated_by'=>$user->get()[0]->id
                ]);
                if (count($blog->get()[0]->image) > 0){
                    $blogImage = $blog->get()[0]->image[0];
                    Storage::disk('bic')->delete($blogImage->path);
                    Storage::disk('bic')->delete('blog/'.$blogImage->file300x300);
                    $pathGambar = $gambar->store('blog','bic');
                    $clientName = explode('.',$gambar->getClientOriginalName());
                    $rename = str_replace(" ","_",$clientName[0]);
                    $rename = str_replace(",","_",$rename);
                    $rename = str_replace("-","_",$rename);
                    $rename = str_replace(":","_",$rename);
                    $img = new ImageManager(array('driver' => 'gd'));
                    $img->make(public_path('storage/' . $pathGambar))->resize(300,300)->save(public_path('storage/blog/'.$rename.'300x300.'.$clientName[count($clientName)-1]));
                    //insert non file data
                    BlogImage::where('id',$blogImage->id)
                        ->update(['id_blog'=>$json->id,
                            'path'=>$pathGambar,
                            'file'=>$gambar->getClientOriginalName(),
                            'file300x300'=>$rename.'300x300.'.$clientName[count($clientName)-1],
                            'keterangan'=>$json->keterangan,
                            'updated_by'=>Cookie::get('userid')]);
                }
                $result = array(
                    "sender" => "BIC",
                    "status" => 'success',
                );
                return response()->json($result);
            }else{
                $nonFile = $request->get('data_non_file');
                $json = json_decode($nonFile);
                $date = new \DateTime($json->tanggal);
                $blog->update(['judul'=>$json->judul,
                    'tanggal'=>$date->format('Y-m-d'),
                    'isi'=>$json->isi,
                    'updated_by'=>$user->get()[0]->id
                ]);
                if (count($blogImage = $blog->get()[0]->image) > 0){
                    $blogImage = $blog->get()[0]->image[0];
                    BlogImage::where('id',$blogImage->id)
                        ->update(['id_blog'=>$json->id,
                            'keterangan'=>$json->keterangan,
                            'updated_by'=>Cookie::get('userid')]);
                }
                $result = array(
                    "sender" => "BIC",
                    "status" => 'success',
                );
                return response()->json($result);
            }
        }
    }

    public function gambar($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $blog= Blog::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.blog.gambar', [
                    'blog' => $blog,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.blog.gambar', [
                    'blog' => $blog,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function saveGambar(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $gambar = $request->file('gambar');
            if ($gambar->isValid()){
                $pathGambar = $gambar->store('blog','bic');
                $nonFile = $request->get('data_non_file');
                $json = json_decode($nonFile);
                $clientName = explode('.',$gambar->getClientOriginalName());
                $max = count($clientName);
                $rename = '';
                for($i=0;$i<$max-1;$i++){
                    $rename .=  $clientName[$i];
                }
                $rename = str_replace(" ","_",$rename);
                $rename = str_replace(",","_",$rename);
                $rename = str_replace("-","_",$rename);
                $rename = str_replace(":","_",$rename);
                $img = new ImageManager(array('driver' => 'gd'));
                $img->make(public_path('storage/' . $pathGambar))->resize(300,300)->save(public_path('storage/blog/'.$rename.'300x300.'.$clientName[count($clientName)-1]));
                //insert non file data
                $blog = Blog::where('id',$json->id)->get()[0];
                $blogImage = new BlogImage([
                    'path'=>$pathGambar,
                    'file'=>$gambar->getClientOriginalName(),
                    'file300x300'=>$rename.'300x300.'.$clientName[count($clientName)-1],
                    'keterangan'=>$json->keterangan,
                    'inserted_by'=>Cookie::get('userid'),
                    'updated_by'=>Cookie::get('userid')
                ]);
                $blog->image()->save($blogImage);
                $result = array(
                    "sender" => "navigator",
                    "status" => 'success',
                );
                return response()->json($result);
            }else{
                $result = array(
                    "sender" => "navigator",
                    "status" => 'failed'
                );
                return response()->json($result);
            }
        }
    }

    public function removeFile(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $blogImage = BlogImage::where('id',$json->id)->get()[0];
            Storage::disk('bic')->delete($blogImage->path);
            Storage::disk('bic')->delete('blog/'.$blogImage->file300x300);
            //BlogImage::Destroy($json->id);
            $blogImage->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function delete(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $blog = Blog::where('id',$json->id)->get()[0];
            $blogimage = BlogImage::where('id_blog',$blog->id)->get();
            foreach ($blogimage as $item){
                Storage::disk('bic')->delete($item->path);
                Storage::disk('bic')->delete('blog/'.$item->file300x300);
            }
            BlogImage::where('id_blog',$blog->id)->delete();
            Blog::where('id',$json->id)->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                "message"=>'Blog berhasil dihapus'
            );
            return response()->json($result);
        }
    }

    public function detail($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $blog= Blog::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.blog.detail', [
                    'blog' => $blog,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.blog.detail', [
                    'blog' => $blog,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }
}