<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 12/24/2017
 * Time: 9:57 AM
 */

namespace jayakari\bic\admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use jayakari\bic\admin\Helpers\Traits\UserEncryptionTrait;
use jayakari\bic\admin\Models\DictionaryKategori;
use jayakari\bic\admin\Models\KataKunciTeknologi;
use jayakari\bic\admin\Models\KategoriMenu;
use jayakari\bic\admin\Models\User;
use jayakari\bic\admin\Models\UserCategory;
use jayakari\bic\admin\Models\UserCategoryUser;


class UsersController extends Controller
{
    use UserEncryptionTrait;
    private $kategorilabel = 'manajemen pengguna';

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function usergroup(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else{
            $kategori = UserCategory::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.usergroup',[
                    'kategori'=>$kategori,
                    'activeCategory'=>Cookie::get('active_category'),'datauser'=>$user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.usergroup',[
                    'kategori'=>$kategori,
                    'datauser'=>$user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function addUserGroup(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $kategori = KategoriMenu::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.addusergroup', [
                    'kategori' => $kategori,
                    'activeCategory'=>Cookie::get('active_category'),
                    'datauser' => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.addusergroup', [
                    'kategori' => $kategori,
                    'datauser' => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function storeUserGroup(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $kategori = new UserCategory();
            $kategori->kategori = $json->kategori;
            $kategori->keterangan = $json->keterangan;
            $kategori->inserted_by = 1;
            $kategori->save();
            $kategori->kategoriMenu()->attach($json->hak_akses);

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function editUserGroup($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $kategori = UserCategory::where('id', $id)->get();
            $kategoriMenu = KategoriMenu::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.editUserGroup', [
                    'kategori' => $kategori,
                    'kategoriMenu' => $kategoriMenu,
                    'activeCategory'=>Cookie::get('active_category'),
                    'datauser' => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.editUserGroup', [
                    'kategori' => $kategori,
                    'kategoriMenu' => $kategoriMenu,
                    'datauser' => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function updateUserGroup(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $kategori = UserCategory::find($json->id);
            $kategori->kategori = $json->kategori;
            $kategori->keterangan = $json->keterangan;
            $kategori->inserted_by = 1;
            $kategori->save();
            $kategori->kategoriMenu()->detach();
            $kategori->kategoriMenu()->attach($json->hak_akses);

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function deleteUserGroup($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            if (count($user->get()) == 0) {
                return redirect('general/login');
            } else {
                $kategori = UserCategory::where('id', $id)->get();
                if (Cookie::has('active_category')){
                    return view('jayakari.bic.admin::pages.users.deleteUserGroup', [
                        'kategori' => $kategori,
                        'activeCategory'=>Cookie::get('active_category'),
                        'datauser' => $user->get(),
                        'kategorilabel'=>$this->kategorilabel
                    ]);
                }else{
                    return view('jayakari.bic.admin::pages.users.deleteUserGroup', [
                        'kategori' => $kategori,
                        'datauser' => $user->get(),
                        'kategorilabel'=>$this->kategorilabel
                    ]);
                }

            }
        }
    }

    public function deleteDataUserGroup(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $kategori = UserCategory::find($json->id);
            $kategori->delete();
            $kategori->kategoriMenu()->detach();    //hapus seluruh menu_kategori id yang ada pada tabel user_menu_kategori
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function listusers(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $users = User::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.listusers', [
                    "users" => $users,
                    'activeCategory'=>Cookie::get('active_category'),
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.listusers', [
                    "users" => $users,
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function add(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        $kategori = UserCategory::all();
        if (Cookie::has('active_category')){
            return view('jayakari.bic.admin::pages.users.adduser',[
                "kategori"=>$kategori,
                'activeCategory'=>Cookie::get('active_category'),
                'datauser'=>$user->get(),
                'kategorilabel'=>$this->kategorilabel
            ]);
        }else{
            return view('jayakari.bic.admin::pages.users.adduser',[
                "kategori"=>$kategori,
                'datauser'=>$user->get(),
                'kategorilabel'=>$this->kategorilabel
            ]);
        }

    }

    public function edit($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $users = User::where('id', $id)->get();
            $kategori = UserCategory::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.editUser', [
                    'user' => $users,
                    'kategori' => $kategori,
                    'activeCategory'=>Cookie::get('active_category'),
                    'datauser' => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.editUser', [
                    'user' => $users,
                    'kategori' => $kategori,
                    'datauser' => $user->get(),
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
            $users = User::where('id',$id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.deleteUser',[
                    'user'=>$users,
                    'activeCategory'=>Cookie::get('active_category'),
                    'datauser'=>$user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.deleteUser',[
                    'user'=>$users,
                    'datauser'=>$user->get()
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
            $exist = User::where('email', $json->email)->get();
            if (count($exist) > 0) {
                $result = array(
                    "sender" => "bic",
                    "status" => 'exist'
                );
                return response()->json($result);
            } else {
                $user = new User();
                $user->email = $json->email;
                $user->password = md5('12345678');
                $user->fullname = $json->fullname;
                $user->jk = $json->jk;
                $user->alamat = $json->alamat;
                $user->alasan = $json->alasan;
                $user->is_active = 1;
                $user->file = "default.png";
                $user->small_file = "small_default.png";
                $user->path = "user";
                $user->public_path = "/user";
                $user->hp = $json->hp;
                $user->inserted_by = 1;
                $user->save();
                if ($user->kategori <> "0") {
                    $userCategory = [$json->kategori];
                    $user->userCategory()->attach($userCategory);
                }

                $result = array(
                    "sender" => "bic",
                    "status" => 'success'
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
            $data = $request->input('data');
            $json = json_decode($data);
            if ($json->email == '') {
                $user = User::find($json->id);
                $user->fullname = $json->fullname;
                $user->jk = $json->jk;
                $user->alamat = $json->alamat;
                $user->alasan = $json->alasan;
                $user->is_active = 1;
                $user->hp = $json->hp;
                $user->inserted_by = 1;
                $user->save();
                if ($user->kategori <> "0") {
                    $userCategory = [$json->kategori];
                    $user->userCategory()->detach();
                    $user->userCategory()->attach($userCategory);
                }

                $result = array(
                    "sender" => "bic",
                    "status" => 'success'
                );
                return response()->json($result);
            } else {
                $exist = User::where('email', $json->email)->get();
                if (count($exist) > 0) {
                    $result = array(
                        "sender" => "bic",
                        "status" => 'exist'
                    );
                    return response()->json($result);
                } else {
                    $user = User::find($json->id);
                    $user->email = $json->email;
                    $user->fullname = $json->fullname;
                    $user->jk = $json->jk;
                    $user->alamat = $json->alamat;
                    $user->hp = $json->hp;
                    $user->inserted_by = 1;
                    $user->save();
                    if ($user->kategori <> "0") {
                        $userCategory = [$json->kategori];
                        $user->userCategory()->detach();
                        $user->userCategory()->attach($userCategory);
                    }

                    $result = array(
                        "sender" => "bic",
                        "status" => 'success'
                    );
                    return response()->json($result);
                }
            }
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
            $user = User::find($json->id);
            $user->delete();
            $user->userCategory()->detach();    //hapus seluruh user_kategori id yang ada pada tabel sch_user_kategori_user
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function listuserassign(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $users = User::where('is_active',1)->get();
            $alluser = [];
            $index = 0;
            foreach ($users as $item){
                if (count($item->userCategory) > 0){
                    if ($item->userCategory[0]->id <> 4){
                        $alluser[$index] = $item;
                        $index++;
                    }
                }
                /*if ($item->userCategory[0]->id <> 4){
                    $alluser[$index] = $item;
                    $index++;
                }*/
                /*$alluser[$index] = $item;
                $index++;*/
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.listuserassign', [
                    "users" => $alluser,
                    'activeCategory'=>Cookie::get('active_category'),
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.listuserassign', [
                    "users" => $alluser,
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function assignCategory($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $users = User::where('id',$id);
            $kategori = UserCategory::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.assignCategory', [
                    'user' => $users->get(),
                    'kategori' => $kategori,
                    'activeCategory'=>Cookie::get('active_category'),
                    'datauser' => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.assignCategory', [
                    'user' => $users->get(),
                    'kategori' => $kategori,
                    'datauser' => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function saveAssignCategory(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $user = User::find($json->id_user);
            $userCategory = $json->kategori;
            $user->userCategory()->detach();
            $user->userCategory()->attach($userCategory);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function finduser(){
        return view('jayakari.bic.admin::pages.users.finduser');
    }

    public function validateUser(Request $request)
    {
        $data = $request->input('data');
        $json = json_decode($data);
        //$email = preg_replace("/[^\w-.@\s]/", '', trim($json->email));
		$email = trim($json->email);
        $exist = User::where('email',$email)->get();
        if (count($exist) > 0){
            if ($exist[0]->is_active == 0){
                $result = array(
                    "sender"=>"bic",
                    "status"=>'inactive'
                );
            }else{
                if (md5($json->password) == $exist[0]->password){
                    $result = array(
                        "sender"=>"bic",
                        "status"=>'success',
                        "category"=>$exist[0]->userCategory[0]->id
                    );

                    return response()->json($result)->withCookie(cookie('userid',$exist[0]->id))->withCookie(cookie('active_category',$exist[0]->userCategory[0]->id));
                }else{
                    $result = array(
                        "sender"=>"bic",
                        "status"=>'failed'
                    );
                }
            }
            return response()->json($result);
        }else{
            $result = array(
                "sender"=>"bic",
                "status"=>'failed',
                "email"=>$email,
            );
            return response()->json($result);
        }
    }

    public function registrasi(Request $request)
    {
        $data = $request->input('data');
        $json = json_decode($data);
        $exist = User::where('email',$json->email)->get();
        if (count($exist) > 0){
            $result = array(
                "sender"=>"bic",
                "status"=>'exist'
            );
            return response()->json($result);
        }else{
            date_default_timezone_set("Asia/Bangkok");
            $user = new User();
            $user->email = $json->email;
            $user->password = md5($json->password);
            $user->fullname = $json->fullname;
            $user->jk = $json->jk;
            $user->alamat = $json->alamat;
            $user->hp = $json->hp;
            $user->alasan = $json->alasan;
            $user->is_active = 1;
            $user->inserted_by = 1;
            $user->ts_date = date('Y-m-d H:i:s');
            $user->register_date = date('Y-m-d H:i:s');
            $user->last_visit_date = date('Y-m-d H:i:s');
            $user->file = "default.png";
            $user->small_file = "small_default.png";
            $user->path = "user";
            $user->public_path = "/user";
            $user->save();
            $userCategory = [4];
            $user->userCategory()->attach($userCategory);

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            //sent email to innovator
            $email = new EmailController();
            $user->password = $json->password;
            $email->sendAktivasi($user);

            return response()->json($result);
        }
    }

    public function changeCategory($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            switch ($id){
                case 1:
                    return redirect('admin/home')->withCookie(cookie('active_category',$id));
                    break;
                case 2:
                    return redirect('admin/home/proposal')->withCookie(cookie('active_category',$id));
                    break;
                case 3:
                    return redirect('admin/home/reviewer')->withCookie(cookie('active_category',$id));
                    break;
                case 4:
                    return redirect('admin/home/inovator')->withCookie(cookie('active_category',$id));
                    break;
                case 5:
                    return redirect('admin/home/juri')->withCookie(cookie('active_category',$id));
                    break;
                case 6:
                    return redirect('admin/home/technical')->withCookie(cookie('active_category',$id));
                    break;
                case 7:
                    return redirect('admin/home/administrasi')->withCookie(cookie('active_category',$id));
                    break;
                case 9:
                    return redirect('admin/home/designer')->withCookie(cookie('active_category',$id));
                    break;
            }
        }

    }

    public function profile(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $TAR = DictionaryKategori::where('kode','TAR')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "TAR"=>$TAR
            );
            $this->kategorilabel = 'inovator';
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.profile', [
                    'labels'=>$labels,
                    'activeCategory'=>Cookie::get('active_category'),
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.profile', ['labels'=>$labels,"datauser" => $user->get()]);
            }
        }
    }

    public function updateProfile(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            if ($json->nickname <> null){
                $test = User::where('nickname',$json->nickname)->get();
                if (count($test) > 0){
                    if ($json->nickname == $json->nickname_origin){
                        $user->update([
                            'email'=>$json->email,
                            'nickname'=>$json->nickname,
                            'fullname'=>$json->fullname,
                            'alamat'=>$json->alamat,
                            'alasan'=>$json->alasan,
                            'jk'=>$json->jk,
                            'hp'=>$json->hp
                        ]);
                        $result = array(
                            "sender" => "bic",
                            "status" => 'success'
                        );
                    }else{
                        $result = array(
                            "sender" => "bic",
                            "status" => 'failed',
                            "message"=> 'Nickname sudah ada'
                        );
                    }
                }else{
                    $user->update([
                        'email'=>$json->email,
                        'nickname'=>$json->nickname,
                        'fullname'=>$json->fullname,
                        'alamat'=>$json->alamat,
                        'alasan'=>$json->alasan,
                        'jk'=>$json->jk,
                        'hp'=>$json->hp
                    ]);
                    $result = array(
                        "sender" => "bic",
                        "status" => 'success'
                    );
                }
            }else{
                $user->update([
                    'email'=>$json->email,
                    'fullname'=>$json->fullname,
                    'alamat'=>$json->alamat,
                    'alasan'=>$json->alasan,
                    'jk'=>$json->jk,
                    'hp'=>$json->hp
                ]);
                $result = array(
                    "sender" => "bic",
                    "status" => 'success'
                );
            }
            return response()->json($result);
        }
    }

    public function profileReviewer(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $TAR = DictionaryKategori::where('kode','TAR')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "TAR"=>$TAR
            );
            $this->kategorilabel = 'reviewer';
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.profileReviewer', [
                    'labels'=>$labels,
                    'activeCategory'=>Cookie::get('active_category'),
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.profileReviewer', [
                    'labels'=>$labels,
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function profileAdminProses(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $TAR = DictionaryKategori::where('kode','TAR')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "TAR"=>$TAR
            );
            $this->kategorilabel = 'admin proses';
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.profileAdminProses', [
                    'labels'=>$labels,
                    'activeCategory'=>Cookie::get('active_category'),
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.profileAdminProses', [
                    'labels'=>$labels,
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function profileJuri(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $TAR = DictionaryKategori::where('kode','TAR')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "TAR"=>$TAR
            );
            $this->kategorilabel = 'juri';
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.profileJuri', [
                    'labels'=>$labels,
                    'activeCategory'=>Cookie::get('active_category'),
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.profileJuri', [
                    'labels'=>$labels,
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function profileTechnicalReviewer(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $TAR = DictionaryKategori::where('kode','TAR')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "TAR"=>$TAR
            );
            $this->kategorilabel = 'technical reviewer';
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.profileTechnicalReviewer', [
                    'labels'=>$labels,
                    'activeCategory'=>Cookie::get('active_category'),
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.profileTechnicalReviewer', [
                    'labels'=>$labels,
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function ubahPassword(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $users = User::find($userid);
            $users->password = md5($json->password);
            $users->save();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function ubahPasswordJuri(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $users = User::find($json->id);
            $users->password = md5($json->password);
            $users->save();
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
                $path = $file->store('user', 'bic');
                $publicPath = Storage::url($path);
                if ($file->isValid()) {
                    //create small file
                    $clientName = explode('.',$file->getClientOriginalName());
                    $str = public_path('storage/' . $path);
                    $img = new ImageManager(array('driver' => 'gd'));
                    $img->make(public_path('storage/' . $path))->resize(315,315)->save(public_path('storage/user/'.$user->get()[0]->fullname.'.'.$clientName[1]));
                    $img->make(public_path('storage/' . $path))->resize(29,29)->save(public_path('storage/user/small_'.$user->get()[0]->fullname.'.'.$clientName[1]));
                    Storage::disk('bic')->delete($path);
                    $user->update(
                        [
                            'file' => $user->get()[0]->fullname.'.'.$clientName[1],
                            'small_file'=>'small_'.$user->get()[0]->fullname.'.'.$clientName[1],
                            'path'=>'user',
                            'public_path'=> '/user'
                        ]
                    );
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
            } else {
                $result = array(
                    "sender" => "bic",
                    "status" => 'failed'
                );
                return response()->json($result);
            }
        }
    }

    public function juri(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $users = User::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.juri', [
                    "users"=>$users,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.juri', [
                    "users"=>$users,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function kataKunci($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $users = User::where('id',$id)->get();
            $kataKunci = KataKunciTeknologi::where('parent',0)
                                        ->where('type',1)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.kataKunci', [
                    "user"=>$users,
                    "kataKunci" => $kataKunci,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.kataKunci', [
                    "user"=>$users,
                    "kataKunci" => $kataKunci,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function saveKataKunci(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $user = User::find($json->id);
            $user->kataKunci()->detach();
            $user->kataKunci()->attach($json->kategori);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function resetPassword(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $juri = UserCategoryUser::where('id_user_kategori',5)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.users.reset', [
                    'juri' => $juri,
                    'activeCategory'=>Cookie::get('active_category'),
                    'datauser' => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.users.reset', [
                    'juri' => $juri,
                    'datauser' => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }
}