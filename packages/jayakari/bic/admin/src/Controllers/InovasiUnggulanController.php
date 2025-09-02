<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 7/6/2018
 * Time: 9:39 AM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use jayakari\bic\admin\Models\ARN;
use jayakari\bic\admin\Models\BukuIsi;
use jayakari\bic\admin\Models\InovasiUnggulan;
use jayakari\bic\admin\Models\InovasiUnggulanIsi;
use jayakari\bic\admin\Models\KataKunciTeknologi;
use jayakari\bic\admin\Models\User;

class InovasiUnggulanController extends Controller
{

    private $kategorilabel = "inovasi";

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
            $inovasiunggulan = InovasiUnggulan::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovasiunggulan.index', [
                    "inovasiunggulan" => $inovasiunggulan,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovasiunggulan.index', [
                    "inovasiunggulan" => $inovasiunggulan,
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
                return view('jayakari.bic.admin::pages.inovasiunggulan.create', [
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovasiunggulan.create', [
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
            $inovasiunggulan= InovasiUnggulan::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovasiunggulan.edit', [
                    'inovasiunggulan' => $inovasiunggulan,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovasiunggulan.edit', [
                    'inovasiunggulan' => $inovasiunggulan,
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
            $inovasiunggulan = ARN::where('id',$id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovasiunggulan.delete',[
                    'inovasiunggulan'=>$inovasiunggulan,
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovasiunggulan.delete',[
                    'inovasiunggulan'=>$inovasiunggulan,
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
            $tanggal = new \DateTime();
            InovasiUnggulan::create([
                'tema' => $json->tema,
                'tanggal'=>$tanggal->format('Y-m-d H:i:s'),
                'keterangan' => $json->keterangan,
                'inserted_by' =>$user->get()[0]->id,
                'updated_by' =>$user->get()[0]->id
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
            InovasiUnggulan::where('id', $json->id)
                ->update([
                    'tema' => $json->tema,
                    'keterangan' => $json->keterangan,
                    'is_active'=>$json->is_active,
                    'updated_by' =>$user->get()[0]->id
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
            $inovasiunggulan = ARN::find($json->id);
            $inovasiunggulan->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function isi($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else{
            $inovasiunggulan = InovasiUnggulan::where('id',$id)->get()[0];
            $arn = ARN::orderBy('id','asc')->get();
            $irc = KataKunciTeknologi::where(['parent'=>0,'type'=>1])->get();
            $aplikasi = KataKunciTeknologi::where(['parent'=>0,'type'=>3])->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.inovasiunggulan.isi',[
                    'inovasiunggulan'=>$inovasiunggulan,
                    "arn"=>$arn,
                    "irc"=>$irc,
                    "aplikasi"=>$aplikasi,
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.inovasiunggulan.isi',[
                    'inovasiunggulan'=>$inovasiunggulan,
                    "arn"=>$arn,
                    "irc"=>$irc,
                    "aplikasi"=>$aplikasi,
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function cari(Request $request)
    {
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $whereQuery = '1=1';
            if ($json->arn <> '0'){
                $whereQuery .= ' and id_arn = '.$json->arn;
                //$proposal = $proposal->where('id','like','%'.$json->nomor_proposal.'%');
            }
            if ($json->irc <> 'null'){
                $whereQuery .= ' and id_teknologi like "%'.$json->irc.'%"';
                //$proposal = $proposal->where('judul','like','%'.$json->judul_proposal.'%');
            }

            if ($json->aplikasi <> 'null'){
                $whereQuery .= ' and id_aplikasi like "%'.$json->aplikasi.'%"';
                //$proposal = $proposal->where('judul','like','%'.$json->judul_proposal.'%');
            }

            if ($json->judul_singkat <> ''){
                $whereQuery .= ' and judul_singkat like "%'.$json->judul_singkat.'%"';
                //$proposal = $proposal->where('judul','like','%'.$json->judul_proposal.'%');
            }

            if ($json->short_title <> ''){
                $whereQuery .= ' and short_title like "%'.$json->short_title.'%"';
                //$proposal = $proposal->where('judul','like','%'.$json->judul_proposal.'%');
            }

            if ($json->judul_lengkap <> ''){
                $whereQuery .= ' and judul_lengkap like "%'.$json->judul_lengkap.'%"';
                //$proposal = $proposal->where('judul','like','%'.$json->judul_proposal.'%');
            }

            if ($json->status_paten <> '0'){
                $whereQuery .= ' and id_paten = '.$json->status_paten;
                //$proposal = $proposal->where('judul','like','%'.$json->judul_proposal.'%');
            }

            if ($json->kesiapan_inovasi <> '0'){
                $whereQuery .= ' and id_kesiapan_inovasi = '.$json->status_paten;
                //$proposal = $proposal->where('judul','like','%'.$json->judul_proposal.'%');
            }

            if ($json->kerjasama_bisnis <> '0'){
                $whereQuery .= ' and id_kerjasama_bisnis = '.$json->kerjasama_bisnis;
                //$proposal = $proposal->where('judul','like','%'.$json->judul_proposal.'%');
            }

            if ($json->peringkat_inovasi <> '0'){
                $whereQuery .= ' and id_peringkat_inovasi = '.$json->peringkat_inovasi;
                //$proposal = $proposal->where('judul','like','%'.$json->judul_proposal.'%');
            }

            if ($json->keyword <> ''){
                $whereQuery .= ' and (judul_singkat like "%'.$json->keyword.'%" or short_title like "%'.$json->keyword.'%" 
                or deskripsi_singkat like "%'.$json->keyword.'%" or short_description like "%'.$json->keyword.'%" 
                or keunggulan_inovasi like "%'.$json->keyword.'%" or potensi_aplikasi like "%'.$json->keyword.'%" 
                or judul_lengkap like "%'.$json->keyword.'%" or perspektif like "%'.$json->keyword.'%")';
            }

            $isiBuku = BukuIsi::whereRaw($whereQuery)->orderBy('id','asc')->get();
            $isiInovasi = InovasiUnggulanIsi::where('id_inovasi_unggulan',$json->id)->get();
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                "query"=>$whereQuery,
                "isibuku"=>$isiBuku,
                "isiInovasi"=>$isiInovasi
            );
            return response()->json($result);
        }
    }

    public function simpan(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $tanggal = new \DateTime();
            $inovasiUnggulan = InovasiUnggulan::where('id',$json->id)->get()[0];
            $isi = new InovasiUnggulanIsi();
            $date = new \DateTime();
            $isi->id_isi_buku = $json->id_isi_buku;
            $isi->tanggal = $date->format('Y-m-d H:i:s');
            $inovasiUnggulan->isi()->save($isi);
            $isiInovasiUnggulan = InovasiUnggulanIsi::orderBy('id','desc')->get();
            $isiInovasi = array();
            foreach($isiInovasiUnggulan as $item){
                $content = array();
                $content["id"] = $item->id;
                $content["id_isi_buku"] = $item->id_isi_buku;
                $content["tema"] = $item->inovasiUnggulan->tema;
                $content["judul_singkat"] = $item->isiBuku->judul_singkat;
                $content["short_title"] = $item->isiBuku->short_title;
                $content["judul_lengkap"] = $item->isiBuku->judul_lengkap;
                $isiInovasi[] = $content;
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                "isiInovasi"=>$isiInovasi
            );
            return response()->json($result);
        }
    }

    public function findStatus(){
        return view('jayakari.bic.admin::pages.inovasiunggulan.finduser');
    }

}