<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/4/2018
 * Time: 10:59 AM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use jayakari\bic\admin\Models\Dictionary;
use jayakari\bic\admin\Models\DictionaryKategori;
use jayakari\bic\admin\Models\User;

class DictionaryController extends Controller
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
            $dictionary = Dictionary::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.dictionary.index', [
                    "dictionary" => $dictionary,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.dictionary.index', [
                    "dictionary" => $dictionary,
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
            $dictionary = Dictionary::all();
            $kategoriDictionary = DictionaryKategori::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.dictionary.create', [
                    'dictionary'=>$dictionary,
                    'kategoridictionary'=>$kategoriDictionary,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.dictionary.create', [
                    'dictionary'=>$dictionary,
                    'kategoridictionary'=>$kategoriDictionary,
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
            $dictionary= Dictionary::where('id', $id)->get();
            $dictionary[0]->isi = str_replace(array("\r\n","\r","\n"),'\n',$dictionary[0]->isi);
            $kategoriDictionary = DictionaryKategori::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.dictionary.edit', [
                    'dictionary' => $dictionary,
                    'datauser' => $user->get(),
                    'kategoridictionary'=>$kategoriDictionary,
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.dictionary.edit', [
                    'dictionary' => $dictionary,
                    'datauser' => $user->get(),
                    'kategoridictionary'=>$kategoriDictionary,
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
            $dictionary = Dictionary::where('id',$id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.dictionary.delete',[
                    'dictionary'=>$dictionary,
                    'datauser'=>$user->get(),
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.dictionary.delete',[
                    'dictionary'=>$dictionary,
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
            Dictionary::create(['id_dictionary_kategori' => $json->id_kategori_dictionary,'public_path'=>$json->public_path,'isi'=>$json->value, 'keterangan' => $json->keterangan, 'inserted_by' =>$user->get()[0]->id, 'updated_by' =>$user->get()[0]->id]);

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
            Dictionary::where('id', $json->id)
                ->update(['id_dictionary_kategori' => $json->id_kategori_dictionary,'public_path'=>$json->public_path,'isi'=>$json->value, 'keterangan' => $json->keterangan, 'updated_by' => $user->get()[0]->id]);

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
            $dictionary = Dictionary::find($json->id);
            $dict = Dictionary::where('id',$json->id)->get();
            if ($dict[0]->kategoriDictionary->tipe_input == "IMAGE"){
                Storage::disk('bic')->delete($dict[0]->public_path.$dict[0]->isi);
            }
            $dictionary->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function uploadFile(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $all = $request->all();
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                if ($request->action == "update"){
                    if ($file->isValid()) {
                        $dictionary = Dictionary::where('id',$request->id);
                        Storage::disk('bic')->delete($dictionary->get()[0]->public_path.$dictionary->get()[0]->isi);
                        $path = $file->store('email', 'bic');
                        $img = new ImageManager(array('driver' => 'gd'));
                        if (!($dictionary->get()[0]->kategoriDictionary->kode == 'BHV')){
                            $img->make(public_path('storage/' . $path))->resize(315, 315)->save(public_path('storage/email/' . $file->getClientOriginalName()));
                            Storage::disk('bic')->delete($path);
                        }else{
                            $img->make(public_path('storage/' . $path))->save(public_path('storage/email/' . $file->getClientOriginalName()));
                            Storage::disk('bic')->delete($path);
                        }
                        $dictionary->update(["keterangan"=>$request->keterangan,"id_dictionary_kategori"=>$request->id_kategori_dictionary,"isi"=>$file->getClientOriginalName()]);
                    }else {
                        $result = array(
                            "sender" => "bic",
                            "status" => 'failed'
                        );
                        return response()->json($result);
                    }
                }else{
                    if ($file->isValid()) {
                        //create small file
                        $path = $file->store('email', 'bic');
                        $img = new ImageManager(array('driver' => 'gd'));
                        $img->make(public_path('storage/' . $path))->resize(315, 315)->save(public_path('storage/email/' . $file->getClientOriginalName()));
                        Storage::disk('bic')->delete($path);
                        $dictionary = new Dictionary();
                        $dictionary->id_dictionary_kategori = $request->id_kategori_dictionary;
                        $dictionary->keterangan = $request->keterangan;
                        $dictionary->public_path = 'email/';
                        $dictionary->isi = $file->getClientOriginalName();
                        $dictionary->inserted_by = $user->get()[0]->id;
                        $dictionary->updated_by = $user->get()[0]->id;
                        $dictionary->save();
                    }else {
                        $result = array(
                            "sender" => "bic",
                            "status" => 'failed'
                        );
                        return response()->json($result);
                    }
                }
                $result = array(
                    "sender" => "bic",
                    "status" => 'success'
                );
                return response()->json($result);
            } else {
                $result = array(
                    "sender" => "bic",
                    "status" => 'failed'
                );
                return response()->json($result);
            }
        }
    }

    function download($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $dictionary = Dictionary::where('id',$id)->get();
            return response()->download(public_path('storage/'.$dictionary[0]->public_path.$dictionary[0]->isi));
        }
    }

}