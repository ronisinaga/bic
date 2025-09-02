<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/4/2018
 * Time: 10:17 AM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use jayakari\bic\admin\Models\DictionaryKategori;
use jayakari\bic\admin\Models\User;

class KategoriDictionaryController extends Controller
{
    private $kategorilabel = 'master data';

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
            $kategoridictionary = DictionaryKategori::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.kategoridictionary.index', [
                    "kategoridictionary" => $kategoridictionary,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.kategoridictionary.index', [
                    "kategoridictionary" => $kategoridictionary,
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
        $kategoridictionary = DictionaryKategori::all();
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.kategoridictionary.create', [
                    'kategoridictionary'=>$kategoridictionary,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.kategoridictionary.create', [
                    'kategoridictionary'=>$kategoridictionary,
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
            $kategoridictionary= DictionaryKategori::where('id', $id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.kategoridictionary.edit', [
                    'kategoridictionary' => $kategoridictionary,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.kategoridictionary.edit', [
                    'kategoridictionary' => $kategoridictionary,
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
            $kategoridictionary = DictionaryKategori::where('id',$id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.kategoridictionary.delete',[
                    'kategoridictionary'=>$kategoridictionary,
                    'datauser'=>$user->get(),
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.kategoridictionary.delete',[
                    'kategoridictionary'=>$kategoridictionary,
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
            DictionaryKategori::create(['kategori' => $json->kategoridictionary,'kode' => $json->kode,'tipe_input' => $json->tipe, 'keterangan' => $json->keterangan, 'inserted_by' =>$user->get()[0]->id, 'updated_by' =>$user->get()[0]->id]);

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
            DictionaryKategori::where('id', $json->id)
                ->update(['kategori' => $json->kategoridictionary,'kode' => $json->kode,'tipe_input' => $json->tipe, 'keterangan' => $json->keterangan, 'updated_by' => $user->get()[0]->id]);

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
            $kategoridictionary = DictionaryKategori::find($json->id);
            $kategoridictionary->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

}