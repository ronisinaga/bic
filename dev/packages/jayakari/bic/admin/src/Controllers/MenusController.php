<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 12/24/2017
 * Time: 1:27 PM
 */

namespace jayakari\bic\admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use jayakari\bic\admin\Models\KategoriMenu;
use jayakari\bic\admin\Models\Menu;
use Illuminate\Http\Request;
use jayakari\bic\admin\Models\User;


class MenusController extends Controller
{
    private $kategorilabel = "manajemen menu";

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function menugroup(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $kategori = KategoriMenu::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.menus.menugroup', [
                    'kategori' => $kategori,
                    'activeCategory'=>Cookie::get('active_category'),
                    'datauser' => $user->get(),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.menus.menugroup', [
                    'kategori' => $kategori,
                    'datauser' => $user->get(),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }

        }
    }

    public function currentMenuGroup($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $kategori = KategoriMenu::where('id',$id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.menus.menugroup',[
                    'kategori'=>$kategori,
                    'activeCategory'=>Cookie::get('active_category'),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.menus.menugroup',[
                    'kategori'=>$kategori,
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }
        }
    }

    public function addMenuGroup(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.menus.addmenugroup', [
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.menus.addmenugroup', [
                    'datauser' => $user->get(),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }

        }
    }

    public function storeMenuGroup(Request $request){
        //save data
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            KategoriMenu::create(['kategori' => $json->kategori, 'icon' => $json->icon, 'url' => $json->url, 'keterangan' => $json->keterangan, 'inserted_by' => 1]);

            $result = array(
                "sender" => "school",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function updateMenuGroup(Request $request){
        //save data
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            KategoriMenu::where('id', $json->id)
                ->update(['kategori' => $json->kategori, 'url' => $json->url, 'icon' => $json->icon, 'keterangan' => $json->keterangan, 'inserted_by' => 1]);

            $result = array(
                "sender" => "school",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function deleteDataMenuGroup(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $kategori = KategoriMenu::find($json->id);
            $kategori->delete();
            Menu::where('id_menu_kategori', $json->id)
                ->update(['id_menu_kategori' => 0]);  //update id_menu_kategori pada tabel menu menjadi 0, artinya menu tersebut tidak memiliki kategori menu sehingga harus di set ulang kategori menu dari menu tersebut
            $kategori->userCategory()->detach();    //hapus seluruh user_kategori id yang ada pada tabel user_menu_kategori
            $result = array(
                "sender" => "school",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function editMenuGroup($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $kategori = KategoriMenu::where('id', $id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.menus.editMenuGroup', [
                    'kategori' => $kategori,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.menus.editMenuGroup', [
                    'kategori' => $kategori,
                    'datauser' => $user->get(),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }
        }
    }

    public function deleteMenuGroup($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $kategori = KategoriMenu::where('id', $id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.menus.deleteMenuGroup', [
                    'kategori' => $kategori,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.menus.deleteMenuGroup', [
                    'kategori' => $kategori,
                    'datauser' => $user->get(),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }
        }
    }

    public function listmenus(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else{
            $menu = Menu::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.menus.listmenus',[
                    'menu'=>$menu,
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.menus.listmenus',[
                    'menu'=>$menu,
                    'datauser'=>$user->get(),
                    "kategorilabel"=>$this->kategorilabel
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
            $kategori = KategoriMenu::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.menus.addmenu', [
                    'kategori' => $kategori,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.menus.addmenu', [
                    'kategori' => $kategori,
                    'datauser' => $user->get(),
                    "kategorilabel"=>$this->kategorilabel
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
            $menu = Menu::where('id', $id)->get();
            $kategori = KategoriMenu::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.menus.editMenu', [
                    'kategori' => $kategori,
                    'menu' => $menu,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.menus.editMenu', [
                    'kategori' => $kategori,
                    'menu' => $menu,
                    'datauser' => $user->get(),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }
        }
    }

    public function delete($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $menu = Menu::where('id', $id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.menus.deleteMenu', [
                    'menu' => $menu,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.menus.deleteMenu', [
                    'menu' => $menu,
                    'datauser' => $user->get(),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }

        }
    }

    public function store(Request $request){
        //save data
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            Menu::create(['id_menu_kategori' => $json->idKategori, 'menu' => $json->menu, 'icon' => $json->icon, 'url' => $json->url, 'keterangan' => $json->keterangan, 'inserted_by' => 1]);

            $result = array(
                "sender" => "school",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function update(Request $request){
        //save data
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            Menu::where('id', $json->id)
                ->update(['id_menu_kategori' => $json->idKategori, 'menu' => $json->menu, 'icon' => $json->icon, 'url' => $json->url, 'keterangan' => $json->keterangan, 'inserted_by' => 1]);

            $result = array(
                "sender" => "school",
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
            $menu = Menu::destroy($json->id);
            $result = array(
                "sender" => "school",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }
}