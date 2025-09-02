<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/22/2018
 * Time: 10:00 PM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use jayakari\bic\admin\Models\TipeTeknologi;
use jayakari\bic\admin\Models\User;

class TipeTeknologiController extends Controller
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
            $tipeteknologi = TipeTeknologi::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.tipeteknologi.index', [
                    "tipeteknologi" => $tipeteknologi,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.tipeteknologi.index', [
                    "tipeteknologi" => $tipeteknologi,
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
                return view('jayakari.bic.admin::pages.tipeteknologi.create', [
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.tipeteknologi.create', [
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
            $tipeteknologi= TipeTeknologi::where('id', $id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.tipeteknologi.edit', [
                    'tipeteknologi' => $tipeteknologi,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.tipeteknologi.edit', [
                    'tipeteknologi' => $tipeteknologi,
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
            $tipeteknologi = TipeTeknologi::where('id',$id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.tipeteknologi.delete',[
                    'tipeteknologi'=>$tipeteknologi,
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.tipeteknologi.delete',[
                    'tipeteknologi'=>$tipeteknologi,
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
            TipeTeknologi::create(['tipe_teknologi' => $json->tipeteknologi, 'kode' => $json->kode, 'keterangan' => $json->keterangan, 'inserted_by' =>$user->get()[0]->id, 'updated_by' =>$user->get()[0]->id]);

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
            TipeTeknologi::where('id', $json->id)
                ->update(['tipe_teknologi' => $json->tipeteknologi, 'kode' => $json->kode, 'keterangan' => $json->keterangan, 'updated_by' => $user->get()[0]->id]);

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
            $tipeteknologi = TipeTeknologi::find($json->id);
            $tipeteknologi->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function findStatus(){
        return view('jayakari.bic.admin::pages.tipeteknologi.finduser');
    }

}