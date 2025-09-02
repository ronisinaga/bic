<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/20/2018
 * Time: 5:21 PM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use jayakari\bic\admin\Models\News;
use jayakari\bic\admin\Models\NewsComment;
use jayakari\bic\admin\Models\NewsFile;
use jayakari\bic\admin\Models\NewsImage;
use jayakari\bic\admin\Models\User;

class NewsController extends Controller
{
    private $kategorilabel = 'manajemen berita';

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
            $news = News::orderBy('tanggal','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.news.index', [
                    "news" => $news,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.news.index', [
                    "news" => $news,
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
                return view('jayakari.bic.admin::pages.news.add', [
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.news.add', [
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function edit($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $news= News::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.news.edit', [
                    'news' => $news,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.news.edit', [
                    'news' => $news,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function gambar($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $news= News::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.news.gambar', [
                    'news' => $news,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.news.gambar', [
                    'news' => $news,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function file($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $news= News::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.news.file', [
                    'news' => $news,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.news.file', [
                    'news' => $news,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function delete(Request $request){
        $data = $request->input('data');
        $json = json_decode($data);
        $id = $json->id;
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else{
            //$news = News::where('id',$id)->get()[0];
            $files = NewsFile::where('id_news',$id)->get();
            foreach ($files as $item){
                Storage::disk('bic')->delete($item->path.'/'.$item->file);
            }
            NewsFile::where('id_news',$id)->delete();
            $images = NewsImage::where('id_news',$id)->get();
            foreach ($images as $item){
                Storage::disk('bic')->delete($item->path.'/'.$item->file);
                Storage::disk('bic')->delete($item->path.'/'.$item->file300x300);
            }
            NewsImage::where('id_news',$id)->delete();
            NewsComment::where('id_news',$id)->delete();
            News::where('id',$id)->delete();

            $result = array(
                "sender" => "BIC",
                "status" => 'success',
                "message" => 'Berita berhasil dihapus dari sistem',
            );
            return response()->json($result);
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
                $pathGambar = $gambar->store('news','bic');
                $nonFile = $request->get('data_non_file');
                $json = json_decode($nonFile);
                $news = new News();
                $news->judul = $json->judul;
                $news->isi = $json->isi;
                $date = new \DateTime($json->tanggal);
                $news->tanggal = $date->format('Y-m-d H:i:s');
                $news->inserted_by = $user->get()[0]->id;
                $news->updated_by = $user->get()[0]->id;
                $news->views = 0;
                $news->is_active = 1;
                $news->id_penulis = $user->get()[0]->id;
                $news->save();
                $clientName = explode('.',$gambar->getClientOriginalName());
                $rename = str_replace(" ","_",$clientName[0]);
                $rename = str_replace(",","_",$rename);
                $rename = str_replace("-","_",$rename);
                $rename = str_replace(":","_",$rename);
                $img = new ImageManager(array('driver' => 'gd'));
                $img->make(public_path('storage/' . $pathGambar))->resize(300,300)->save(public_path('storage/news/'.$rename.'300x300.'.$clientName[count($clientName)-1]));
                //insert non file data
                $newsImage = new NewsImage([
                    'path'=>$pathGambar,
                    'file'=>$gambar->getClientOriginalName(),
                    'file300x300'=>$rename.'300x300.'.$clientName[count($clientName)-1],
                    'keterangan'=> $json->keterangan,
                    'inserted_by'=>Cookie::get('userid'),
                    'updated_by'=>Cookie::get('userid')
                ]);
                $news->image()->save($newsImage);
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

    public function update(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $gambar = $request->file('gambar');
            $nonFile = $request->get('data_non_file');
            $json = json_decode($nonFile);
            $news = News::where('id',$json->id);
            if ($gambar <> null){
                $date = new \DateTime($json->tanggal);
                $news->update(['judul'=>$json->judul,
                        'tanggal'=>$date->format('Y-m-d'),
                        'isi'=>$json->isi,
                        //'keterangan'=>$json->keterangan,
                        'updated_by'=>$user->get()[0]->id
                    ]);
                if (count($news->get()[0]->image) > 0){
                    $newsImage = $news->get()[0]->image[0];
                    Storage::disk('bic')->delete($newsImage->path);
                    Storage::disk('bic')->delete('news/'.$newsImage->file300x300);
                    $pathGambar = $gambar->store('news','bic');
                    $clientName = explode('.',$gambar->getClientOriginalName());
                    $rename = str_replace(" ","_",$clientName[0]);
                    $rename = str_replace(",","_",$rename);
                    $rename = str_replace("-","_",$rename);
                    $rename = str_replace(":","_",$rename);
                    $img = new ImageManager(array('driver' => 'gd'));
                    $img->make(public_path('storage/' . $pathGambar))->resize(300,300)->save(public_path('storage/news/'.$rename.'300x300.'.$clientName[count($clientName)-1]));
                    //insert non file data
                    NewsImage::where('id',$newsImage->id)
                        ->update(['id_news'=>$json->id,
                            'path'=>$pathGambar,
                            'file'=>$gambar->getClientOriginalName(),
                            'file300x300'=>$rename.'300x300.'.$clientName[count($clientName)-1],
                            'keterangan'=>$json->keterangan,
                            'updated_by'=>Cookie::get('userid')]);
                }
                $result = array(
                    "sender" => "navigator",
                    "status" => 'success',
                );
                return response()->json($result);
            }else{
                $nonFile = $request->get('data_non_file');
                $json = json_decode($nonFile);
                $date = new \DateTime($json->tanggal);
                $news->update(['judul'=>$json->judul,
                                'tanggal'=>$date->format('Y-m-d'),
                                'isi'=>$json->isi,
                                'updated_by'=>$user->get()[0]->id
                            ]);
                if (count($newsImage = $news->get()[0]->image) > 0){
                    $newsImage = $news->get()[0]->image[0];
                    NewsImage::where('id',$newsImage->id)
                        ->update(['id_news'=>$json->id,
                            'keterangan'=>$json->keterangan,
                            'updated_by'=>Cookie::get('userid')]);
                }
                $result = array(
                    "sender" => "navigator",
                    "status" => 'success',
                );
                return response()->json($result);
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
                $pathGambar = $gambar->store('news','bic');
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
                $img->make(public_path('storage/' . $pathGambar))->resize(300,300)->save(public_path('storage/news/'.$rename.'300x300.'.$clientName[count($clientName)-1]));
                //insert non file data
                $news = News::where('id',$json->id)->get()[0];
                $newsImage = new NewsImage([
                    'path'=>$pathGambar,
                    'file'=>$gambar->getClientOriginalName(),
                    'file300x300'=>$rename.'300x300.'.$clientName[count($clientName)-1],
                    'keterangan'=>$json->keterangan,
                    'inserted_by'=>Cookie::get('userid'),
                    'updated_by'=>Cookie::get('userid')
                ]);
                $news->image()->save($newsImage);
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

    public function saveFile(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $file = $request->file('file');
            if ($file->isValid()){
                $pathFile = $file->store('news','bic');
                $nonFile = $request->get('data_non_file');
                $json = json_decode($nonFile);
                $news = News::where('id',$json->id)->get()[0];
                $newsFile = new NewsFile([
                    'path'=>$pathFile,
                    'file'=>$file->getClientOriginalName(),
                    'inserted_by'=>Cookie::get('userid'),
                    'updated_by'=>Cookie::get('userid')
                ]);
                $news->file()->save($newsFile);
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
            $newsImage = NewsImage::where('id',$json->id)->get()[0];
            Storage::disk('bic')->delete($newsImage->path);
            Storage::disk('bic')->delete('news/'.$newsImage->file300x300);
            //NewsImage::Destroy($json->id);
            $newsImage->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function removeAttachment(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $newsFile = NewsFile::where('id',$json->id)->get()[0];
            Storage::disk('bic')->delete($newsFile->path);
            //NewsImage::Destroy($json->id);
            $newsFile->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function deleteData(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $news = Batch::Destroy($json->id);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function findStatus(){
        return view('jayakari.bic.admin::pages.news.finduser');
    }

    public function status(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $news = Batch::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.news.status', [
                    "news" => $news,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.news.status', [
                    "news" => $news,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function editStatus($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $news = Batch::where('id',$id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.news.editStatus', [
                    "news" => $news,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.news.editStatus', [
                    "news" => $news,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function updateStatus(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            Batch::where('id', $json->id)
                ->update([
                    'is_finished' => $json->status,
                    'updated_by' => $user->get()[0]->id
                ]);

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function download($id){
        $file = NewsFile::where('id',$id)->get()[0];
        return response()->download(public_path().'/storage/'.$file->path,$file->file);
    }

    public function deaktivasi(Request $request){
        $data = $request->input('data');
        $json = json_decode($data);
        $user = News::findOrFail($json->id);
        $user->update(['is_active'=>$json->active]);

        $result = array(
            "sender" => "BIC",
            "status" => 'success',
            "message"=> 'Status aktivasi/deaktivasi berhasil diupdate'
        );
        return response()->json($result);
    }

}