<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 6/29/2018
 * Time: 4:50 AM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use jayakari\bic\admin\Models\Testimonial;
use jayakari\bic\admin\Models\User;

class TestimonialController extends Controller
{

    private $kategorilabel = 'manajemen testimonial';

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
            $testimonial = Testimonial::orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.testimonial.index', [
                    "testimonial" => $testimonial,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.testimonial.index', [
                    "testimonial" => $testimonial,
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
                return view('jayakari.bic.admin::pages.testimonial.create', [
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.testimonial.create', [
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
            $testimonial= Testimonial::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.testimonial.edit', [
                    'testimonial' => $testimonial,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.testimonial.edit', [
                    'testimonial' => $testimonial,
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
                $pathGambar = $gambar->store('testimonial','bic');
                $nonFile = $request->get('data_non_file');
                $json = json_decode($nonFile);
                $clientName = explode('.',$gambar->getClientOriginalName());
                $rename = str_replace(" ","_",$clientName[0]);
                $rename = str_replace(",","_",$rename);
                $rename = str_replace("-","_",$rename);
                $rename = str_replace(":","_",$rename);
                //$img = new ImageManager(array('driver' => 'gd'));
                //$img->make(public_path('storage/' . $pathGambar))->resize(300,300)->save(public_path('storage/testimonial/'.$rename.'300x300.'.$clientName[count($clientName)-1]));
                //insert non file data
                $dates = new \DateTime();
                $testimonial = new Testimonial([
                    'path'=>$pathGambar,
                    'file'=>$gambar->getClientOriginalName(),
                    'name'=>$json->name,
                    'pekerjaan'=>$json->pekerjaan,
                    "testimonial"=>$json->testimonial,
                    "dates"=>$dates->format('Y-m-d H:i:s'),
                    'is_active'=>1,
                    'inserted_by'=>Cookie::get('userid'),
                    'updated_by'=>Cookie::get('userid')
                ]);
                $testimonial->save();
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
            $dates = new \DateTime();
            if ($gambar <> null){
                $pathGambar = $gambar->store('testimonial','bic');
                $testimonial = Testimonial::where('id',$json->id);
                Storage::disk('bic')->delete($testimonial->get()[0]->path);
                $testimonial->update([
                    'path'=>$pathGambar,
                    'file'=>$gambar->getClientOriginalName(),
                    'name'=>$json->name,
                    'pekerjaan'=>$json->pekerjaan,
                    "testimonial"=>$json->testimonial,
                    "dates"=>$dates->format('Y-m-d H:i:s'),
                    'is_active'=>$json->is_active,
                    'updated_by'=>Cookie::get('userid')
                ]);
                $result = array(
                    "sender" => "navigator",
                    "status" => 'success',
                );
                return response()->json($result);
            }else{
                Testimonial::where('id',$json->id)
                ->update([
                    'name'=>$json->name,
                    'pekerjaan'=>$json->pekerjaan,
                    "testimonial"=>$json->testimonial,
                    "dates"=>$dates->format('Y-m-d H:i:s'),
                    'is_active'=>$json->is_active,
                    'updated_by'=>Cookie::get('userid')
                ]);
                $result = array(
                    "sender" => "navigator",
                    "status" => 'success',
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
            $testimonial = Banner::where('id',$json->id)->get()[0];
            Storage::disk('bic')->delete($testimonial->path);
            //NewsImage::Destroy($json->id);
            $testimonial->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

}