<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 4/16/2018
 * Time: 7:25 AM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use jayakari\bic\admin\Models\AyatInspirasi;
use jayakari\bic\admin\Models\BacaanAlkitab;
use jayakari\bic\admin\Models\Bahasa;
use jayakari\bic\admin\Models\Buku;
use jayakari\bic\admin\Models\KategoriMenu;
use jayakari\bic\admin\Models\News;
use jayakari\bic\admin\Models\NewsCategory;
use jayakari\bic\admin\Models\PokokDoa;
use jayakari\bic\admin\Models\User;
use jayakari\bic\admin\Models\Videos;

class VideosController extends Controller
{

    private $kategorilabel = 'manajemen video';

    public function __construct(){
        date_default_timezone_set('Asia/Bangkok');
    }

    public function index(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $videos = Videos::orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.videos.index', [
                    "videos" => $videos,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.videos.index', [
                    "videos" => $videos,
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
            $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.videos.create', [
                    "buku"=>$buku,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.videos.create', [
                    "buku"=>$buku,
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
            $videos= Videos::where('id', $id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.videos.edit', [
                    'videos' => $videos,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.videos.edit', [
                    'videos' => $videos,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function delete($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else{
            $videos = Videos::where('id',$id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.videos.delete',[
                    'videos'=>$videos,
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.videos.delete',[
                    'videos'=>$videos,
                    'datauser'=>$user->get(),
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
            $data = $request->input('data');
            $json = json_decode($data);
            Videos::create([
                'url_youtube' => $json->url_youtube,
                'keterangan' => $json->keterangan,
                'inserted_by' =>$user->get()[0]->id, 'updated_by' =>$user->get()[0]->id
            ]);

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function update(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            Videos::where('id', $json->id)
                ->update([
                    'url_youtube' => $json->url_youtube,
                    'keterangan' => $json->keterangan,
                    'is_active'=>$json->is_active,
                    'updated_by' => $user->get()[0]->id
                ]);

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
            $videos = Videos::find($json->id);
            $videos->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function view(Request $request)
    {
        //$labels = LabelsHelpe::getAllLabels(1);
        return view('jayakari.bic.admin::pages.videos.view',[
            'videoid'=>$request->get('videoid'),
            'kategorilabel'=>$this->kategorilabel
        ]);
    }

    public function all()
    {
        if (Cookie::has("language")){
            $selectedLanguage = Cookie::get('language');
            $language = Bahasa::where('id',Cookie::get('language'))->get()[0];
            switch (strtolower($language->code)){
                case 'bahasa':
                    $menuAtasKiri = KategoriMenu::where(['position'=>'3','language'=>1,'is_active'=>1])->get();
                    $menuAtasKanan = KategoriMenu::where(['position'=>'6','language'=>1,'is_active'=>1])->get();
                    $menuUtama = KategoriMenu::where(['position'=>'2','language'=>1,'is_active'=>1])->get();
                    cookie()->forever('language',1);
                    break;
                case 'english':
                    $menuAtasKiri = KategoriMenu::where(['position'=>'3','language'=>3,'is_active'=>1])->get();
                    $menuAtasKanan = KategoriMenu::where(['position'=>'6','language'=>3,'is_active'=>1])->get();
                    $menuUtama = KategoriMenu::where(['position'=>'2','language'=>3,'is_active'=>1])->get();
                    cookie()->forever('language',3);
                    break;
            }
        }else{
            $selectedLanguage = 1;
            $menuAtasKiri = KategoriMenu::where(['position'=>'3','language'=>1,'is_active'=>1])->get();
            $menuAtasKanan = KategoriMenu::where(['position'=>'6','language'=>1,'is_active'=>1])->get();
            $menuUtama = KategoriMenu::where(['position'=>'2','language'=>1,'is_active'=>1])->get();
            cookie()->forever('language',1);
        }
        $atasKiri = array();
        foreach($menuAtasKiri as $item){
            if (count($item->userCategory) > 0) {
                if($item->userCategory[0]->id == 9){
                    $atasKiri[] = $item;
                }else{
                    //$utama = $item;
                }
            }
        }
        $atasKanan = array();
        foreach($menuAtasKanan as $item){
            if (count($item->userCategory) > 0) {
                if($item->userCategory[0]->id == 9){
                    $atasKanan[] = $item;
                }else{
                    //$utama = $item;
                }
            }
        }
        $utama = array();
        foreach($menuUtama as $item){
            if (count($item->userCategory) > 0) {
                if($item->userCategory[0]->id == 9){
                    $utama[] = $item;
                }else{
                    //$utama = $item;
                }
            }
        }
        $languages = Bahasa::all();
        //$labels = $this->getAllLabels($selectedLanguage);
        $labels = LabelsHelper::getAllLabels($selectedLanguage);
        $latestNews = News::where(['is_active'=>1,'id_language'=>$selectedLanguage])->orderBy('id','desc')->take(5)->get();
        $popularNews = News::where(['is_active'=>1,'id_language'=>$selectedLanguage])->orderBy('views','desc')->take(3)->get();
        $popularVideo = Videos::where(['is_active'=>1,'id_language'=>$selectedLanguage])->orderBy('views','desc')->take(3)->get();
        $allvideos = Videos::where(['is_active'=>1,'id_language'=>$selectedLanguage])->orderBy('views','desc')->get();
        $date = new \DateTime();
        $bacaan = BacaanAlkitab::where('tanggal',$date->format('Y-m-d'))->get();
        //ayat inspirasi
        $ayatInspirasi = AyatInspirasi::where('is_active',1)->get();
        $pokokdoa = PokokDoa::where('is_active',1)->get();
        return view('jayakari.bic.admin::pages.videos.all',[
            "bacaan"=>$bacaan,
            "videos"=>$allvideos,
            'latestNews'=>$latestNews,
            'popularNews'=>$popularNews,
            "menuAtasKiri"=>$atasKiri,
            "menuAtasKanan"=>$atasKanan,
            'menuUtama'=>$utama,
            "selectedLanguage"=>$selectedLanguage,
            "bahasa"=>$languages,
            "labels"=>$labels,
            'popularVideos'=>$popularVideo,
            "ayatInspirasi"=>$ayatInspirasi,
            "pokokdoa"=>$pokokdoa,
            'kategorilabel'=>$this->kategorilabel
        ])->withCookie(Cookie::forever('language',$selectedLanguage));
    }

    public function findStatus(){
        return view('jayakari.bic.admin::pages.videos.finduser');
    }

}