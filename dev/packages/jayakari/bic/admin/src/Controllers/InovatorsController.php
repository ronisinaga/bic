<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 12/24/2017
 * Time: 1:30 PM
 */

namespace jayakari\bic\admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use jayakari\bic\admin\Models\Development;
use jayakari\bic\admin\Models\DictionaryKategori;
use jayakari\bic\admin\Models\IPR;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\ProposalExplanation;
use jayakari\bic\admin\Models\ProposalIPR;
use jayakari\bic\admin\Models\ProposalPemenangAdvanced;
use jayakari\bic\admin\Models\ProposalPemenangFile;
use jayakari\bic\admin\Models\ProposalPemenangVideo;
use jayakari\bic\admin\Models\User;
use jayakari\bic\admin\Models\UserCategory;


class InovatorsController extends Controller
{
    private $kategorilabel = 'inovator';

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function index(){
        return view('jayakari.bic.admin::pages.inovators.download');
    }

    public function proses(){
        return view('jayakari.bic.admin::pages.inovators.proses');
    }

    public function reviewer(){
        return view('jayakari.bic.admin::pages.inovators.reviewer');
    }

    public function aktivasi(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        //$users = User::all();
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $userCategory = UserCategory::where('id',4)->get();
            $users = [];
            $index = 0;
            $num = count($userCategory[0]->user);
            for($i=0;$i<$num;$i++){
                if ($userCategory[0]->user[$i]->is_active == 0){
                    $users[$index] = $userCategory[0]->user[$i];
                    $index++;
                }
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.aktivasi',['user'=>$users,'numuser'=>$num,'datauser'=>$user->get(),'activeCategory'=>Cookie::get('active_category')]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.aktivasi',['user'=>$users,'numuser'=>$num,'datauser'=>$user->get()]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function saveAktivasi(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $user = User::find($json->id_inovator);
            $user->is_active = 1;
            $user->save();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            $email = new EmailController();
            $email->sendAktivasi($user);
            return response()->json($result);
        }
    }

    public function deaktivasi(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {

            $userCategory = UserCategory::where('id',4)->get();
            $users = [];
            $index = 0;
            $num = count($userCategory[0]->user);
            for($i=0;$i<$num;$i++){
                if ($userCategory[0]->user[$i]->is_active == 1){
                    $users[$index] = $userCategory[0]->user[$i];
                    $index++;
                }
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.deaktivasi',['user'=>$users,'numuser'=>$num,'datauser'=>$user->get(),'activeCategory'=>Cookie::get('active_category')]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.deaktivasi',['user'=>$users,'numuser'=>$num,'datauser'=>$user->get()]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }

        }
    }

    public function saveDeaktivasi(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $user = User::find($json->id_inovator);
            $user->is_active = 0;
            $user->save();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            $email = new EmailController();
            $email->sendDeaktivasi($user);
            return response()->json($result);
        }
    }

    public function pemenang(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id_inovator'=>$user->get()[0]->id,'status'=>8])->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.pemenang',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.pemenang',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function pemenangEdit($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id'=>$id])->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.pemenangEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.pemenangEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function pemenangUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::find($json->id);
            $proposal->abstrak = $json->abstrak;
            $proposal->deskripsi = $json->deskripsi;
            $proposal->keunggulan_teknologi = $json->keunggulan_teknologi;
            $proposal->potensi_aplikasi = $json->potensi_aplikasi;
            $proposal->save();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function file(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id_inovator'=>$user->get()[0]->id,'status'=>8])->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.file',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.file',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function fileEdit($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id'=>$id])->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.fileEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.fileEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function fileUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $file = $request->file('file');
            if ($file->isValid()){
                $pathFile = $file->store('pemenang','bic');
                $nonFile = $request->get('data_non_file');
                $json = json_decode($nonFile);
                $pemenangFile = new ProposalPemenangFile();
                $pemenangFile->id_proposal = $json->id;
                $pemenangFile->description = $json->deskripsi;
                $pemenangFile->path = $pathFile;
                $pemenangFile->name = $file->getClientOriginalName();
                $pemenangFile->inserted_by = $userid;
                $pemenangFile->updated_by = $userid;
                $pemenangFile->save();
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

    public function fileRemove(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $pemenangFile = ProposalPemenangFile::where('id',$json->id)->get()[0];
            Storage::disk('bic')->delete($pemenangFile->path);
            //NewsImage::Destroy($json->id);
            $pemenangFile->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function fileDownload($id){
        $file = ProposalPemenangFile::where('id',$id)->get()[0];
        return response()->download(public_path('storage/'.$file->path),$file->name);
    }

    public function advanced(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id_inovator'=>$user->get()[0]->id,'status'=>8])->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.advanced',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.advanced',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function advancedEdit($id_proposal,$id=0){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id'=>$id_proposal])->get()[0];
            $advanced = null;
            if ($id <> 0){
                $advanced = ProposalPemenangAdvanced::where('id',$id)->get()[0];
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.advancedEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'advanced'=>$advanced,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.advancedEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'advanced'=>$advanced,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function advancedUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            if ($json->id <> 0){
                $advanced = ProposalPemenangAdvanced::find($json->id);
                $advanced->id_proposal = $json->id_proposal;
                $advanced->description = $json->deskripsi;
                $advanced->updated_by = $userid;
                $advanced->save();
            }else{
                $advanced = new ProposalPemenangAdvanced();
                $advanced->id_proposal = $json->id_proposal;
                $advanced->description = $json->deskripsi;
                $advanced->inserted_by = $userid;
                $advanced->updated_by = $userid;
                $advanced->save();
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function advancedRemove(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $pemenangAdvanced = ProposalPemenangAdvanced::where('id',$json->id)->get()[0];
            $pemenangAdvanced->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function pemenangAdministrasi(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['status'=>8])->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.pemenangAdministrasi',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.pemenangAdministrasi',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function pemenangAdministrasiEdit($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id'=>$id])->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.pemenangAdministrasiEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.pemenangAdministrasiEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function pemenangAdministrasiUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::find($json->id);
            $proposal->abstrak = $json->abstrak;
            $proposal->deskripsi = $json->deskripsi;
            $proposal->keunggulan_teknologi = $json->keunggulan_teknologi;
            $proposal->potensi_aplikasi = $json->potensi_aplikasi;
            $proposal->save();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function fileAdministrasi(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['status'=>8])->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.fileAdministrasi',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.fileAdministrasi',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function fileAdministrasiEdit($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id'=>$id])->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.fileAdministrasiEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.fileAdministrasiEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function fileAdministrasiUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $file = $request->file('file');
            if ($file->isValid()){
                $pathFile = $file->store('pemenang','bic');
                $nonFile = $request->get('data_non_file');
                $json = json_decode($nonFile);
                $pemenangFile = new ProposalPemenangFile();
                $pemenangFile->id_proposal = $json->id;
                $pemenangFile->description = $json->deskripsi;
                $pemenangFile->path = $pathFile;
                $pemenangFile->name = $file->getClientOriginalName();
                $pemenangFile->inserted_by = $userid;
                $pemenangFile->updated_by = $userid;
                $pemenangFile->save();
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

    public function fileAdministrasiRemove(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $pemenangFile = ProposalPemenangFile::where('id',$json->id)->get()[0];
            Storage::disk('bic')->delete($pemenangFile->path);
            //NewsImage::Destroy($json->id);
            $pemenangFile->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function fileAdministrasiDownload($id){
        $file = ProposalPemenangFile::where('id',$id)->get()[0];
        return response()->download(public_path('storage/'.$file->path),$file->name);
    }

    public function advancedAdministrasi(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['status'=>8])->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.advancedAdministrasi',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.advancedAdministrasi',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function advancedAdministrasiEdit($id_proposal,$id=0){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id'=>$id_proposal])->get()[0];
            $proposalipr = ProposalIPR::where('id_proposal',$proposal->id)->get()[0];
            $ipr = IPR::all();
            $alldevelopment = Development::all();
            $development =array();
            for ($i=0;$i<10;$i++){
                $development[] = $alldevelopment[$i];
            }
            $advanced = null;
            if ($id <> 0){
                $advanced = ProposalPemenangAdvanced::where('id',$id)->get()[0];
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.advancedAdministrasiEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'proposalipr'=>$proposalipr,
                    'ipr'=>$ipr,
                    'development'=>$development,
                    'advanced'=>$advanced,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.advancedAdministrasiEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'proposalipr'=>$proposalipr,
                    'ipr'=>$ipr,
                    'development'=>$development,
                    'advanced'=>$advanced,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function advancedAdministrasiUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $haki = null;
            $development = null;
            if ($json->haki <> 0){
                $haki = $json->haki;
            }
            if ($json->development <> 0){
                $development = $json->development;
            }
            if ($json->id <> 0){
                $advanced = ProposalPemenangAdvanced::find($json->id);
                $advanced->id_proposal = $json->id_proposal;
                $advanced->id_ipr = $haki;
                $advanced->ipr_no_patent = $json->patent;
                $advanced->id_development = $development;
                $advanced->description = $json->deskripsi;
                $advanced->updated_by = $userid;
                $advanced->save();
            }else{
                $advanced = new ProposalPemenangAdvanced();
                $advanced->id_proposal = $json->id_proposal;
                $advanced->id_ipr = $haki;
                $advanced->ipr_no_patent = $json->patent;
                $advanced->id_development = $development;
                $advanced->description = $json->deskripsi;
                $advanced->inserted_by = $userid;
                $advanced->updated_by = $userid;
                $advanced->save();
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function advancedAdministrasiRemove(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $pemenangAdvanced = ProposalPemenangAdvanced::where('id',$json->id)->get()[0];
            $pemenangAdvanced->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function videoAdministrasi(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['status'=>8])->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.videoAdministrasi',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.videoAdministrasi',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function videoAdministrasiEdit($id_proposal,$id=0){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id'=>$id_proposal])->get()[0];
            $video = null;
            if ($id <> 0){
                $video = ProposalPemenangVideo::where('id',$id)->get()[0];
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.videoAdministrasiEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'video'=>$video,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.videoAdministrasiEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'video'=>$video,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function videoAdministrasiUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            if ($json->id <> 0){
                $advanced = ProposalPemenangVideo::find($json->id);
                $advanced->id_proposal = $json->id_proposal;
                $advanced->description = $json->deskripsi;
                $advanced->updated_by = $userid;
                $advanced->save();
            }else{
                $advanced = new ProposalPemenangVideo();
                $advanced->id_proposal = $json->id_proposal;
                $advanced->video_id = $json->video;
                $advanced->description = $json->deskripsi;
                $advanced->inserted_by = $userid;
                $advanced->updated_by = $userid;
                $advanced->save();
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function videoAdministrasiRemove(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $pemenangVideo = ProposalPemenangVideo::where('id',$json->id)->get()[0];
            $pemenangVideo->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function fileAdministrasiInreview(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['status'=>5])->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.fileAdministrasiInreview',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.fileAdministrasiInreview',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function fileAdministrasiEditInreview($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id'=>$id])->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.fileAdministrasiInreviewEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.fileAdministrasiInreviewEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function fileAdministrasiInreviewUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $file = $request->file('file');
            if ($file->isValid()){
                $pathFile = $file->store('pemenang','bic');
                $nonFile = $request->get('data_non_file');
                $json = json_decode($nonFile);
                $pemenangFile = new ProposalPemenangFile();
                $pemenangFile->id_proposal = $json->id;
                $pemenangFile->description = $json->deskripsi;
                $pemenangFile->path = $pathFile;
                $pemenangFile->name = $file->getClientOriginalName();
                $pemenangFile->inserted_by = $userid;
                $pemenangFile->updated_by = $userid;
                $pemenangFile->save();
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

    public function fileAdministrasiInreviewRemove(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $pemenangFile = ProposalPemenangFile::where('id',$json->id)->get()[0];
            Storage::disk('bic')->delete($pemenangFile->path);
            //NewsImage::Destroy($json->id);
            $pemenangFile->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function fileAdministrasiInreviewDownload($id){
        $file = ProposalPemenangFile::where('id',$id)->get()[0];
        return response()->download(public_path('storage/'.$file->path),$file->name);
    }

    public function advancedAdministrasiInreview(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['status'=>8])->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.advancedAdministrasi',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.advancedAdministrasi',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function advancedAdministrasiInreviewEdit($id_proposal,$id=0){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id'=>$id_proposal])->get()[0];
            $proposalipr = ProposalIPR::where('id_proposal',$proposal->id)->get()[0];
            $ipr = IPR::all();
            $alldevelopment = Development::all();
            $development =array();
            for ($i=0;$i<10;$i++){
                $development[] = $alldevelopment[$i];
            }
            $advanced = null;
            if ($id <> 0){
                $advanced = ProposalPemenangAdvanced::where('id',$id)->get()[0];
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.advancedAdministrasiEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'proposalipr'=>$proposalipr,
                    'ipr'=>$ipr,
                    'development'=>$development,
                    'advanced'=>$advanced,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.advancedAdministrasiEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'proposalipr'=>$proposalipr,
                    'ipr'=>$ipr,
                    'development'=>$development,
                    'advanced'=>$advanced,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function advancedAdministrasiInreviewUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $haki = null;
            $development = null;
            if ($json->haki <> 0){
                $haki = $json->haki;
            }
            if ($json->development <> 0){
                $development = $json->development;
            }
            if ($json->id <> 0){
                $advanced = ProposalPemenangAdvanced::find($json->id);
                $advanced->id_proposal = $json->id_proposal;
                $advanced->id_ipr = $haki;
                $advanced->ipr_no_patent = $json->patent;
                $advanced->id_development = $development;
                $advanced->description = $json->deskripsi;
                $advanced->updated_by = $userid;
                $advanced->save();
            }else{
                $advanced = new ProposalPemenangAdvanced();
                $advanced->id_proposal = $json->id_proposal;
                $advanced->id_ipr = $haki;
                $advanced->ipr_no_patent = $json->patent;
                $advanced->id_development = $development;
                $advanced->description = $json->deskripsi;
                $advanced->inserted_by = $userid;
                $advanced->updated_by = $userid;
                $advanced->save();
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function advancedAdministrasiInreviewRemove(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $pemenangAdvanced = ProposalPemenangAdvanced::where('id',$json->id)->get()[0];
            $pemenangAdvanced->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function videoAdministrasiInreview(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['status'=>8])->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.videoAdministrasi',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.videoAdministrasi',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function videoAdministrasiInreviewEdit($id_proposal,$id=0){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'proposal pemenang';
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            $proposal = Proposal::where(['id'=>$id_proposal])->get()[0];
            $video = null;
            if ($id <> 0){
                $video = ProposalPemenangVideo::where('id',$id)->get()[0];
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.videoAdministrasiEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'proposal'=>$proposal,
                    'video'=>$video,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.videoAdministrasiEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'proposal'=>$proposal,
                    'video'=>$video,
                    'labels'=>$labels,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function videoAdministrasiInreviewUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            if ($json->id <> 0){
                $advanced = ProposalPemenangVideo::find($json->id);
                $advanced->id_proposal = $json->id_proposal;
                $advanced->description = $json->deskripsi;
                $advanced->updated_by = $userid;
                $advanced->save();
            }else{
                $advanced = new ProposalPemenangVideo();
                $advanced->id_proposal = $json->id_proposal;
                $advanced->video_id = $json->video;
                $advanced->description = $json->deskripsi;
                $advanced->inserted_by = $userid;
                $advanced->updated_by = $userid;
                $advanced->save();
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function videoAdministrasiInreviewRemove(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $pemenangVideo = ProposalPemenangVideo::where('id',$json->id)->get()[0];
            $pemenangVideo->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function explanation(){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'Penjelasan Proposal';
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.explanation',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.explanation',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$kategorilabel
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function type($name){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'Tipe Proposal';
            $explanation = ProposalExplanation::where('proposal_type',$name)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.type',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$kategorilabel,
                    'explanation'=>$explanation,
                    'name'=>$name
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.type',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$kategorilabel,
                    'explanation'=>$explanation,
                    'name'=>$name
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function manage(){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'Manajemen Penjelasan Proposal';
            $explanation = ProposalExplanation::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.manage',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$kategorilabel,
                    'explanation'=>$explanation
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.manage',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$kategorilabel,
                    'explanation'=>$explanation
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function manageAdd(){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'Tambah Penjelasan Proposal';
            $explanation = ProposalExplanation::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.manageAdd',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$kategorilabel,
                    'explanation'=>$explanation
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.manageAdd',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$kategorilabel,
                    'explanation'=>$explanation
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function manageSave(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $user = $user->get()[0];
            $data = $request->input('data');
            $json = json_decode($data);
            $explanation = ProposalExplanation::where('proposal_type',$json->proposal_type)->get();
            if (count($explanation) > 0){
                ProposalExplanation::where('proposal_type',$json->proposal_type)->update([
                    'judul'=>$json->title,
                    'highlight'=>$json->highlight,
                    'abstrak'=>$json->abstrak,
                    'deskripsi'=>$json->deskripsi,
                    'keunggulan_teknologi'=>$json->keunggulan_teknologi,
                    'potensi_aplikasi'=>$json->potensi_aplikasi,
                    'updated_by'=>$user->id
                ]);
            }else{
                ProposalExplanation::Create([
                    'judul'=>$json->title,
                    'proposal_type'=>$json->proposal_type,
                    'highlight'=>$json->highlight,
                    'abstrak'=>$json->abstrak,
                    'deskripsi'=>$json->deskripsi,
                    'keunggulan_teknologi'=>$json->keunggulan_teknologi,
                    'potensi_aplikasi'=>$json->potensi_aplikasi,
                    'inserted_by'=>$user->id,
                    'updated_by'=>$user->id
                ]);
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                'message'=>'Penjelasan proposal berhasil disimpan'
            );
            return response()->json($result);
        }
    }

    public function manageEdit($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $kategorilabel = 'Tambah Penjelasan Proposal';
            $explanation = ProposalExplanation::where('id',$id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovators.manageEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$kategorilabel,
                    'explanation'=>$explanation
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovators.manageEdit',[
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$kategorilabel,
                    'explanation'=>$explanation
                ]);
                //return view('jayakari.bic.admin::pages.users.editUserGroup', ['kategori' => $kategori, 'kategoriMenu' => $kategoriMenu, 'datauser' => $user->get()]);
            }
        }
    }

    public function manageUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('/home/general/login');
        }else {
            $user = $user->get()[0];
            $data = $request->input('data');
            $json = json_decode($data);
            ProposalExplanation::where('id',$json->id)->update([
                'judul'=>$json->title,
                'proposal_type'=>$json->proposal_type,
                'highlight'=>$json->highlight,
                'abstrak'=>$json->abstrak,
                'deskripsi'=>$json->deskripsi,
                'keunggulan_teknologi'=>$json->keunggulan_teknologi,
                'potensi_aplikasi'=>$json->potensi_aplikasi,
                'updated_by'=>$user->id
            ]);
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                'message'=>'Update Penjelasan proposal berhasil dilakukan'
            );
            return response()->json($result);
        }
    }
}