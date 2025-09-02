<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/19/2018
 * Time: 6:47 AM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use jayakari\bic\admin\Models\KataKunciTeknologi;
use jayakari\bic\admin\Models\TipeTeknologi;
use jayakari\bic\admin\Models\User;

class KataKunciTeknologiController extends Controller
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
            $katakunciteknologi = KataKunciTeknologi::all();
            $katakunci = KataKunciTeknologi::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.katakunciteknologi.index', [
                    "katakunciteknologi" => $katakunciteknologi,
                    "katakunci" => $katakunci,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.katakunciteknologi.index', [
                    "katakunciteknologi" => $katakunciteknologi,
                    "katakunci" => $katakunci,
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
            $katakunci = KataKunciTeknologi::all();
            $tipeteknologi = TipeTeknologi::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.katakunciteknologi.create', [
                    'katakunci'=>$katakunci,
                    'tipeteknologi'=>$tipeteknologi,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.katakunciteknologi.create', [
                    'katakunci'=>$katakunci,
                    'tipeteknologi'=>$tipeteknologi,
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
            $katakunciteknologi= KataKunciTeknologi::where('id', $id)->get();
            $katakunci = KataKunciTeknologi::all();
            $tipeteknologi = TipeTeknologi::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.katakunciteknologi.edit', [
                    'tipeteknologi'=>$tipeteknologi,
                    'katakunciteknologi' => $katakunciteknologi,
                    'katakunci' => $katakunci,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.katakunciteknologi.edit', [
                    'tipeteknologi'=>$tipeteknologi,
                    'katakunciteknologi' => $katakunciteknologi,
                    'katakunci' => $katakunci,
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
            $katakunciteknologi = KataKunciTeknologi::where('id',$id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.katakunciteknologi.delete',[
                    'katakunciteknologi'=>$katakunciteknologi,
                    'datauser'=>$user->get(),
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.katakunciteknologi.delete',[
                    'katakunciteknologi'=>$katakunciteknologi,
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
            KataKunciTeknologi::create(['type' => $json->type,'level' => $json->level,'level1' => $json->level1,'level2' => $json->level2,'level3' => $json->level3,'kata_kunci' => $json->katakunci,'parent' => $json->parent, 'keterangan' => $json->keterangan, 'inserted_by' => $user->get()[0]->id, 'updated_by' => $user->get()[0]->id]);

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
            KataKunciTeknologi::where('id', $json->id)
                ->update(['type' => $json->type,'level' => $json->level,'level1' => $json->level1,'level2' => $json->level2,'level3' => $json->level3,'kata_kunci' => $json->katakunci,'parent' => $json->parent, 'keterangan' => $json->keterangan, 'updated_by' => $user->get()[0]->id]);

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
            $katakunciteknologi = KataKunciTeknologi::find($json->id);
            $katakunciteknologi->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function findKataKunci(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $katakunciteknologi = KataKunciTeknologi::where('parent',$json->id)->get();
            return response()->json($katakunciteknologi);
        }
    }

}