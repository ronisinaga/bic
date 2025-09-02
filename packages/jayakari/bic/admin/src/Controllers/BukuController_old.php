<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 6/30/2018
 * Time: 9:09 AM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use jayakari\bic\admin\Models\ARN;
use jayakari\bic\admin\Models\Batch;
use jayakari\bic\admin\Models\Buku;
use jayakari\bic\admin\Models\BukuIsi;
use jayakari\bic\admin\Models\BukuIsiFile;
use jayakari\bic\admin\Models\BukuIsiVideo;
use jayakari\bic\admin\Models\Employee;
use jayakari\bic\admin\Models\Instansi;
use jayakari\bic\admin\Models\KataKunciTeknologi;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\ProposalFile;
use jayakari\bic\admin\Models\ProposalInovatorMember;
use jayakari\bic\admin\Models\RSC;
use jayakari\bic\admin\Models\Topik;
use jayakari\bic\admin\Models\TopikProposal;
use jayakari\bic\admin\Models\User;

class BukuController extends Controller
{

    private $kategorilabel = 'manajemen buku';

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
            $buku = Buku::orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.index', [
                    "buku" => $buku,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.index', [
                    "buku" => $buku,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function inreview(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $allbuku = Buku::orderBy('id','desc')->get();
            $buku = array();
            foreach ($allbuku as $item){
                if (($item->batch->is_finished == 0) || ($item->batch->is_finished == 2)){
                    $buku[] = $item;
                }
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.inreview', [
                    "buku" => $buku,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.inreview', [
                    "buku" => $buku,
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
            $batch = Batch::where('is_finished',1)->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.create', [
                    "batch"=>$batch,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.create', [
                    "batch"=>$batch,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function addinreview(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',0)->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.createinreview', [
                    "batch"=>$batch,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.createinreview', [
                    "batch"=>$batch,
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
            $buku= Buku::where('id', $id)->get()[0];
            $batch = Batch::where('is_finished',1)->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.edit', [
                    'buku' => $buku,
                    'batch'=>$batch,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.edit', [
                    'buku' => $buku,
                    'batch'=>$batch,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function editinreview($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku= Buku::where('id', $id)->get()[0];
            $batch = Batch::where('is_finished',0)->orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.editinreview', [
                    'buku' => $buku,
                    'batch'=>$batch,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.editinreview', [
                    'buku' => $buku,
                    'batch'=>$batch,
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
            $buku = Buku::where('id',$id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.delete',[
                    'buku'=>$buku,
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.delete',[
                    'buku'=>$buku,
                    'datauser'=>$user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function isi($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku= Buku::where('id', $id)->get()[0];
            $topik = Topik::where('id_batch',$buku->id_batch)->get();
            $proposal = array();
            foreach ($topik as $item){
                $topikProposal = TopikProposal::where('id_topik',$item->id)->get();
                foreach($topikProposal as $data){
                    if ($data->proposal->status == 8){
                        $proposal[] = $data->proposal;
                    }
                }
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.isi', [
                    'buku' => $buku,
                    'proposal'=>$proposal,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.isi', [
                    'buku' => $buku,
                    'proposal'=>$proposal,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function isireview($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku= Buku::where('id', $id)->get()[0];
            $proposal = Proposal::whereIn('status',[5,6])->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.isireview', [
                    'buku' => $buku,
                    'proposal'=>$proposal,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.isireview', [
                    'buku' => $buku,
                    'proposal'=>$proposal,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function folderinreview($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku= Buku::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.folderreview', [
                    'buku' => $buku,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.folderreview', [
                    'buku' => $buku,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function savefolderinreview(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            Buku::where('id', $json->id)
                ->update([
                    'folder_inreview' => $json->folder,
                    'updated_by' =>$user->get()[0]->id
                ]);

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function coverinreview($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku= Buku::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.coverreview', [
                    'buku' => $buku,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.coverreview', [
                    'buku' => $buku,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function savecoverinreview(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            if ($request->hasFile('gambar')){
                $gambar = $request->file('gambar');
                if ($gambar->isValid()){
                    $nonFile = $request->get('data_non_file');
                    $json = json_decode($nonFile);
                    $buku = Buku::where('id',$json->id)->get()[0];
                    if ($buku->cover_inreview <> null){
                        Storage::disk('flippdf')->delete($buku->cover_inreview);
                    }
                    $pathGambar = $gambar->store('img','flippdf');
                    $arrPath = explode('.',$pathGambar);
                    $img = new ImageManager(array('driver' => 'gd'));
                    $img->make(public_path('jayakari/bic/regular/' . $pathGambar))->resize(300,241)->save(public_path('jayakari/bic/regular/'.$arrPath[0].'_thumb'.'.'.$arrPath[1]));
                    //insert non file data
                    Buku::where('id',$json->id)->update([
                        'cover_inreview'=>$pathGambar,
                        'updated_by'=>$user->get()[0]->id
                    ]);
                    $result = array(
                        "sender" => "bic",
                        "status" => 'success',
                        "path"=>$pathGambar
                    );
                    return response()->json($result);
                }else{
                    $result = array(
                        "sender" => "bic",
                        "status" => 'failed'
                    );
                    return response()->json($result);
                }
            }else{
                $result = array(
                    "sender" => "bic",
                    "status" => 'failed'
                );
                return response()->json($result);
            }
        }
    }

    public function folderfinal($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku= Buku::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.folderfinal', [
                    'buku' => $buku,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.folderfinal', [
                    'buku' => $buku,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function savefolderfinal(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            Buku::where('id', $json->id)
                ->update([
                    'folder_final' => $json->folder,
                    'updated_by' =>$user->get()[0]->id
                ]);

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function coverfinal($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku= Buku::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.coverfinal', [
                    'buku' => $buku,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.coverfinal', [
                    'buku' => $buku,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function savecoverfinal(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            if ($request->hasFile('gambar')){
                $gambar = $request->file('gambar');
                if ($gambar->isValid()){
                    $nonFile = $request->get('data_non_file');
                    $json = json_decode($nonFile);
                    $buku = Buku::where('id',$json->id)->get()[0];
                    if ($buku->cover_inreview <> null){
                        Storage::disk('flippdf')->delete($buku->cover_final);
                    }
                    $pathGambar = $gambar->store('img','flippdf');
                    $arrPath = explode('.',$pathGambar);
                    $img = new ImageManager(array('driver' => 'gd'));
                    $img->make(public_path('jayakari/bic/regular/' . $pathGambar))->resize(300,241)->save(public_path('jayakari/bic/regular/'.$arrPath[0].'_thumb'.'.'.$arrPath[1]));
                    //insert non file data
                    Buku::where('id',$json->id)->update([
                        'cover_final'=>$pathGambar,
                        'updated_by'=>$user->get()[0]->id
                    ]);
                    $result = array(
                        "sender" => "bic",
                        "status" => 'success',
                        "path"=>$pathGambar
                    );
                    return response()->json($result);
                }else{
                    $result = array(
                        "sender" => "bic",
                        "status" => 'failed'
                    );
                    return response()->json($result);
                }
            }else{
                $result = array(
                    "sender" => "bic",
                    "status" => 'failed'
                );
                return response()->json($result);
            }
        }
    }

    public function bookfinal($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku= Buku::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.bukufinal', [
                    'buku' => $buku,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.coverfinal', [
                    'buku' => $buku,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function savebookfinal(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            if ($request->hasFile('gambar')){
                $gambar = $request->file('gambar');
                if ($gambar->isValid()){
                    $nonFile = $request->get('data_non_file');
                    $json = json_decode($nonFile);
                    $buku = Buku::where('id',$json->id)->get()[0];
                    if ($buku->cover_inreview <> null){
                        Storage::disk('flippdf')->delete($buku->book_final);
                    }
                    $pathGambar = $gambar->store('img','flippdf');
                    $arrPath = explode('.',$pathGambar);
                    $img = new ImageManager(array('driver' => 'gd'));
                    $img->make(public_path('jayakari/bic/regular/' . $pathGambar))->resize(300,241)->save(public_path('jayakari/bic/regular/'.$arrPath[0].'_thumb'.'.'.$arrPath[1]));
                    //insert non file data
                    Buku::where('id',$json->id)->update([
                        'book_final'=>$pathGambar,
                        'updated_by'=>$user->get()[0]->id
                    ]);
                    $result = array(
                        "sender" => "bic",
                        "status" => 'success',
                        "path"=>$pathGambar
                    );
                    return response()->json($result);
                }else{
                    $result = array(
                        "sender" => "bic",
                        "status" => 'failed'
                    );
                    return response()->json($result);
                }
            }else{
                $result = array(
                    "sender" => "bic",
                    "status" => 'failed'
                );
                return response()->json($result);
            }
        }
    }

    public function buatIsiBukuInReview($idBuku,$idProposal){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku = Buku::where('id',$idBuku)->get()[0];
            $proposal = Proposal::where('id',$idProposal)->get()[0];
            $arn = ARN::orderBy('id','asc')->get();
            $irc = KataKunciTeknologi::where(['parent'=>0,'type'=>1])->get();
            $aplikasi = KataKunciTeknologi::where(['parent'=>0,'type'=>3])->get();
            if(count($proposal->instansi) > 0){
                $usaha = explode(',',$proposal->instansi->bidang_usaha);
                $instansi = Instansi::all();
                $bidangusaha = array();
                $index = 0;
                for($i=0;$i<count($instansi);$i++){
                    $found = false;
                    for($j=0;$j<count($usaha)&&!$found;$j++){
                        if ($usaha[$j] == $instansi[$i]->id){
                            $found = true;
                            $bidangusaha[$index] = $instansi[$i]->instansi;
                            $index++;
                        }
                    }
                }
                $allemployee = Employee::all();
                $found = false;
                $employee = "";
                for($i=0;$i<count($allemployee)&&!$found;$i++){
                    if ($proposal->instansi->id_employee == $allemployee[$i]->id){
                        $found = true;
                        $employee = $allemployee[$i]->employee;
                    }
                }
            }else{
                $bidangusaha = array();
                $employee = "";
            }
            $inovasiMember = array();
            $index = 0;
            foreach($proposal->inovasiMember as $item){
                $rsc = RSC::where('id',$item->pivot->id_rsc)->get();
                $member = new \stdClass();
                $member->name = $item->pivot->name;
                $member->jabatan = $rsc[0]->rsc;
                $inovasiMember[$index] = $member;
                $index++;
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.buatisibukuinreview', [
                    "arn"=>$arn,
                    "irc"=>$irc,
                    "aplikasi"=>$aplikasi,
                    "buku"=>$buku,
                    "proposal"=>$proposal,
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.buatisibukuinreview', [
                    "arn"=>$arn,
                    "irc"=>$irc,
                    "aplikasi"=>$aplikasi,
                    "buku"=>$buku,
                    "proposal"=>$proposal,
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function buatIsiBuku($idBuku,$idProposal){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku = Buku::where('id',$idBuku)->get()[0];
            $proposal = Proposal::where('id',$idProposal)->get()[0];
            $arn = ARN::orderBy('id','asc')->get();
            $irc = KataKunciTeknologi::where(['parent'=>0,'type'=>1])->get();
            $aplikasi = KataKunciTeknologi::where(['parent'=>0,'type'=>3])->get();
            if(count($proposal->instansi) > 0){
                $usaha = explode(',',$proposal->instansi->bidang_usaha);
                $instansi = Instansi::all();
                $bidangusaha = array();
                $index = 0;
                for($i=0;$i<count($instansi);$i++){
                    $found = false;
                    for($j=0;$j<count($usaha)&&!$found;$j++){
                        if ($usaha[$j] == $instansi[$i]->id){
                            $found = true;
                            $bidangusaha[$index] = $instansi[$i]->instansi;
                            $index++;
                        }
                    }
                }
                $allemployee = Employee::all();
                $found = false;
                $employee = "";
                for($i=0;$i<count($allemployee)&&!$found;$i++){
                    if ($proposal->instansi->id_employee == $allemployee[$i]->id){
                        $found = true;
                        $employee = $allemployee[$i]->employee;
                    }
                }
            }else{
                $bidangusaha = array();
                $employee = "";
            }
            $inovasiMember = array();
            $index = 0;
            foreach($proposal->inovasiMember as $item){
                $rsc = RSC::where('id',$item->pivot->id_rsc)->get();
                $member = new \stdClass();
                $member->name = $item->pivot->name;
                $member->jabatan = $rsc[0]->rsc;
                $inovasiMember[$index] = $member;
                $index++;
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.buatisibukuinreview', [
                    "arn"=>$arn,
                    "irc"=>$irc,
                    "aplikasi"=>$aplikasi,
                    "buku"=>$buku,
                    "proposal"=>$proposal,
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.buatisibukuinreview', [
                    "arn"=>$arn,
                    "irc"=>$irc,
                    "aplikasi"=>$aplikasi,
                    "buku"=>$buku,
                    "proposal"=>$proposal,
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function saveIsiBuku(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $teknologi = "";
            $aplikasi = "";
            $numTeknologi = count($json->teknologi);
            for($i=0;$i<$numTeknologi;$i++){
                if ($i == $numTeknologi-1){
                    $teknologi .= $json->teknologi[$i];
                }else{
                    $teknologi .= $json->teknologi[$i].',';
                }
            }
            $numAplikasi = count($json->aplikasi);
            for($i=0;$i<$numAplikasi;$i++){
                if ($i == $numAplikasi-1){
                    $aplikasi .= $json->aplikasi[$i];
                }else{
                    $aplikasi .= $json->aplikasi[$i].',';
                }
            }
            $isiBuku = BukuIsi::create([
                'id_buku' => $json->id_buku,
                'id_proposal' => $json->id_proposal,
                'id_arn' => $json->arn,
                'id_teknologi' => $teknologi,
                'id_aplikasi' => $aplikasi,
                'judul_singkat' => $json->judul_singkat,
                'short_title' => $json->short_title,
                'judul_lengkap' => $json->judul_teknis_lengkap,
                'deskripsi_singkat' => $json->deskripsi,
                'short_description' => $json->description,
                'perspektif' => $json->perspektif,
                'keunggulan_inovasi' => $json->keunggulan_inovasi,
                'potensi_aplikasi' => $json->potensi_aplikasi,
                'inovator' => $json->inovator,
                'institusi' => $json->institusi,
                'alamat' => $json->alamat,
                'id_paten' => $json->paten,
                'id_kesiapan_inovasi' => $json->kesiapan_inovasi,
                'id_kerjasama_bisnis' => $json->kerjasama_bisnis,
                'id_peringkat_inovasi' => $json->peringkat_inovasi,
                'inserted_by' =>$user->get()[0]->id,
                'updated_by' =>$user->get()[0]->id
            ]);

            /*$file = ProposalFile::where('id_proposal',$json->id_proposal)->get();
            foreach($file as $item){
                $bukuIsiFile = new BukuIsiFile();
                $bukuIsiFile->path = $item->path;
                $bukuIsiFile->file = $item->file;
                $bukuIsiFile->keterangan = '';
                $isiBuku->file()->save($bukuIsiFile);
            }*/
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function editIsiBuku($idIsiBuku){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $isiBuku = BukuIsi::where('id',$idIsiBuku)->get()[0];
            $buku = Buku::where('id',$isiBuku->id_buku)->get()[0];
            $proposal = Proposal::where('id',$isiBuku->id_proposal)->get()[0];
            $arn = ARN::orderBy('id','asc')->get();
            $irc = KataKunciTeknologi::where(['parent'=>0,'type'=>1])->get();
            $aplikasi = KataKunciTeknologi::where(['parent'=>0,'type'=>3])->get();
            if($proposal->instansi <> null){
                $usaha = explode(',',$proposal->instansi->bidang_usaha);
                $instansi = Instansi::all();
                $bidangusaha = array();
                $index = 0;
                for($i=0;$i<count($instansi);$i++){
                    $found = false;
                    for($j=0;$j<count($usaha)&&!$found;$j++){
                        if ($usaha[$j] == $instansi[$i]->id){
                            $found = true;
                            $bidangusaha[$index] = $instansi[$i]->instansi;
                            $index++;
                        }
                    }
                }
                $allemployee = Employee::all();
                $found = false;
                $employee = "";
                for($i=0;$i<count($allemployee)&&!$found;$i++){
                    if ($proposal->instansi->id_employee == $allemployee[$i]->id){
                        $found = true;
                        $employee = $allemployee[$i]->employee;
                    }
                }
            }else{
                $bidangusaha = array();
                $employee = "";
            }
            $inovasiMember = array();
            $index = 0;
            foreach($proposal->inovasiMember as $item){
                $rsc = RSC::where('id',$item->pivot->id_rsc)->get();
                $member = new \stdClass();
                $member->name = $item->pivot->name;
                $member->jabatan = $rsc[0]->rsc;
                $inovasiMember[$index] = $member;
                $index++;
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.editisibuku', [
                    "isibuku"=>$isiBuku,
                    "arn"=>$arn,
                    "irc"=>$irc,
                    "aplikasi"=>$aplikasi,
                    "buku"=>$buku,
                    "proposal"=>$proposal,
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.editisibuku', [
                    "isibuku"=>$isiBuku,
                    "arn"=>$arn,
                    "irc"=>$irc,
                    "aplikasi"=>$aplikasi,
                    "buku"=>$buku,
                    "proposal"=>$proposal,
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function editIsiBukuInReview($idIsiBuku){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $isiBuku = BukuIsi::where('id',$idIsiBuku)->get()[0];
            $buku = Buku::where('id',$isiBuku->id_buku)->get()[0];
            $proposal = Proposal::where('id',$isiBuku->id_proposal)->get()[0];
            $arn = ARN::orderBy('id','asc')->get();
            $irc = KataKunciTeknologi::where(['parent'=>0,'type'=>1])->get();
            $aplikasi = KataKunciTeknologi::where(['parent'=>0,'type'=>3])->get();
            if(count($proposal->instansi) > 0){
                $usaha = explode(',',$proposal->instansi->bidang_usaha);
                $instansi = Instansi::all();
                $bidangusaha = array();
                $index = 0;
                for($i=0;$i<count($instansi);$i++){
                    $found = false;
                    for($j=0;$j<count($usaha)&&!$found;$j++){
                        if ($usaha[$j] == $instansi[$i]->id){
                            $found = true;
                            $bidangusaha[$index] = $instansi[$i]->instansi;
                            $index++;
                        }
                    }
                }
                $allemployee = Employee::all();
                $found = false;
                $employee = "";
                for($i=0;$i<count($allemployee)&&!$found;$i++){
                    if ($proposal->instansi->id_employee == $allemployee[$i]->id){
                        $found = true;
                        $employee = $allemployee[$i]->employee;
                    }
                }
            }else{
                $bidangusaha = array();
                $employee = "";
            }
            $inovasiMember = array();
            $index = 0;
            foreach($proposal->inovasiMember as $item){
                $rsc = RSC::where('id',$item->pivot->id_rsc)->get();
                $member = new \stdClass();
                $member->name = $item->pivot->name;
                $member->email = $item->pivot->email;
                $member->telp = $item->pivot->telp;
                $member->alamat = $item->pivot->alamat;
                $member->jabatan = $rsc[0]->rsc;
                $inovasiMember[$index] = $member;
                $index++;
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.editisibukuinreview', [
                    "isibuku"=>$isiBuku,
                    "arn"=>$arn,
                    "irc"=>$irc,
                    "aplikasi"=>$aplikasi,
                    "buku"=>$buku,
                    "proposal"=>$proposal,
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.editisibukuinreview', [
                    "isibuku"=>$isiBuku,
                    "arn"=>$arn,
                    "irc"=>$irc,
                    "aplikasi"=>$aplikasi,
                    "buku"=>$buku,
                    "proposal"=>$proposal,
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function updateIsiBuku(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $teknologi = "";
            $aplikasi = "";
            $numTeknologi = count($json->teknologi);
            for($i=0;$i<$numTeknologi;$i++){
                if ($i == $numTeknologi-1){
                    $teknologi .= $json->teknologi[$i];
                }else{
                    $teknologi .= $json->teknologi[$i].',';
                }
            }
            $numAplikasi = count($json->aplikasi);
            for($i=0;$i<$numAplikasi;$i++){
                if ($i == $numAplikasi-1){
                    $aplikasi .= $json->aplikasi[$i];
                }else{
                    $aplikasi .= $json->aplikasi[$i].',';
                }
            }
            BukuIsi::where('id',$json->id)->update([
                'id_buku' => $json->id_buku,
                'id_proposal' => $json->id_proposal,
                'id_arn' => $json->arn,
                'id_teknologi' => $teknologi,
                'id_aplikasi' => $aplikasi,
                'judul_singkat' => $json->judul_singkat,
                'short_title' => $json->short_title,
                'judul_lengkap' => $json->judul_teknis_lengkap,
                'deskripsi_singkat' => $json->deskripsi,
                'short_description' => $json->description,
                'perspektif' => $json->perspektif,
                'keunggulan_inovasi' => $json->keunggulan_inovasi,
                'potensi_aplikasi' => $json->potensi_aplikasi,
                'inovator' => $json->inovator,
                'institusi' => $json->institusi,
                'alamat' => $json->alamat,
                'id_paten' => $json->paten,
                'id_kesiapan_inovasi' => $json->kesiapan_inovasi,
                'id_kerjasama_bisnis' => $json->kerjasama_bisnis,
                'id_peringkat_inovasi' => $json->peringkat_inovasi,
                'updated_by' =>$user->get()[0]->id
            ]);

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
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
            $date = new \DateTime($json->tanggal);
            Buku::create([
                'id_batch' => $json->batch,
                'judul' => $json->judul,
                'tgl_pembuatan' => $date->format('Y-m-d H:i:s'),
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
            $date = new \DateTime($json->tanggal);
            Buku::where('id', $json->id)
                ->update([
                    'id_batch' => $json->batch,
                    'judul' => $json->judul,
                    'tgl_pembuatan' => $date->format('Y-m-d H:i:s'),
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
            $buku = Buku::Destroy($json->id);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function findStatus(){
        return view('jayakari.bic.admin::pages.buku.finduser');
    }

    public function status(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku = Buku::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.status', [
                    "buku" => $buku,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.status', [
                    "buku" => $buku,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function editStatus($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku = Buku::where('id',$id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.editStatus', [
                    "buku" => $buku,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.editStatus', [
                    "buku" => $buku,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function updateStatus(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            Buku::where('id', $json->id)
                ->update([
                    'is_finished' => $json->status,
                    'updated_by' => $user->get()[0]->id
                ]);

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function file($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $isibuku= BukuIsi::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.file', [
                    'isibuku' => $isibuku,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.file', [
                    'isibuku' => $isibuku,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function fileinreview($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $isibuku= BukuIsi::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.fileinreview', [
                    'isibuku' => $isibuku,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.fileinreview', [
                    'isibuku' => $isibuku,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function saveFile(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $gambar = $request->file('gambar');
            if ($gambar->isValid()){
                $pathGambar = $gambar->store('buku','bic');
                $nonFile = $request->get('data_non_file');
                $json = json_decode($nonFile);
                $clientName = explode('.',$gambar->getClientOriginalName());
                $rename = str_replace(" ","_",$clientName[0]);
                $rename = str_replace(",","_",$rename);
                $rename = str_replace("-","_",$rename);
                $rename = str_replace(":","_",$rename);
                //$img = new ImageManager(array('driver' => 'gd'));
                //$img->make(public_path('storage/' . $pathGambar))->resize(300,300)->save(public_path('storage/news/'.$rename.'300x300.'.$clientName[count($clientName)-1]));
                //insert non file data
                $isibuku = BukuIsi::where('id',$json->id)->get()[0];
                $image = new BukuIsiFile([
                    'path'=>$pathGambar,
                    'file'=>$gambar->getClientOriginalName(),
                    'keterangan'=>$json->keterangan,
                    'inserted_by'=>Cookie::get('userid'),
                    'updated_by'=>Cookie::get('userid')
                ]);
                $isibuku->file()->save($image);
                $result = array(
                    "sender" => "bic",
                    "status" => 'success',
                );
                return response()->json($result);
            }else{
                $result = array(
                    "sender" => "bic",
                    "status" => 'failed'
                );
                return response()->json($result);
            }
        }
    }

    public function video($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $isibuku= BukuIsi::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.video', [
                    'isibuku' => $isibuku,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.video', [
                    'isibuku' => $isibuku,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function videoinreview($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $isibuku= BukuIsi::where('id', $id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.videoinreview', [
                    'isibuku' => $isibuku,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.videoinreview', [
                    'isibuku' => $isibuku,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function saveVideo(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            BukuIsiVideo::create([
                'id_isi_buku' => $json->id,
                'youtube_url' => $json->youtube,
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

    public function deleteVideo(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $buku = BukuIsiVideo::Destroy($json->id);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function download($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $file = BukuIsiFile::where('id',$id)->get()[0];
            return response()->download(public_path().'/storage/'.$file->path,$file->file);
        }
    }

    public function deleteFile(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $isiFile = BukuIsiFile::where('id',$json->id)->get()[0];
            Storage::disk('bic')->delete($isiFile->path);
            $isiFile->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function listBatch(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku = Buku::orderBy('id','desc')->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.listbatch', [
                    "buku" => $buku,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.listbatch', [
                    "buku" => $buku,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function daftarInovator(){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::whereIn('status',[1,3,8])->get();
            $proposals = array();
            foreach ($proposal as $item){
                $inner = new \stdClass();
                $inner->id = $item->id;
                $inner->judul = $item->judul;
                $inner->status = $item->statusProposal->status;
                $inner->user_id = $item->user->id;
                $inner->user_name = $item->user->nama;
                $inner->user_email = $item->user->email;
                $inner->user_hp = $item->user->hp;
                $note = '';
                if ($item->user->note <> null){
                    $note = $item->user->note.'<br>';
                    $date = new \DateTime($item->user->note_updated_date);
                    $note .= $date->format('d M Y').' | '.$item->user->noteUpdatedBy->fullname;
                }
                $inner->note = $note;
                $instansi = '';
                if ($item->instansi != null){
                    $instansi = $item->instansi->nama_instansi;
                }
                $inner->instansi = $instansi;
                $inner->member = $item->member;
                $proposals[] = $inner;
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.daftarinovator', [
                    'proposal'=>$proposals,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.daftarinovator', [
                    'proposal'=>$proposals,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function daftarInovatorEdit($type,$id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $curruser = null;
            if ($type == 'uploader'){
                $curruser = User::where('id',$id)->get()[0];
            }else{
                $curruser = ProposalInovatorMember::where('id',$id)->get()[0];
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.daftarinovator_edit', [
                    'type'=>$type,
                    'user'=>$curruser,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.daftarinovator_edit', [
                    'type'=>$type,
                    'user'=>$curruser,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function daftarInovatorUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $date = new \DateTime;
            if ($json->type == "uploader"){
                User::where('id',$json->id)->update([
                    'fullname'=>$json->name,
                    'email'=>$json->email,
                    'hp'=>$json->hp,
                    'note'=>$json->note,
                    'note_updated_date'=>$date->format('Y-m-d H:i:s'),
                    'note_updated_by'=>$user->get()[0]->id
                ]);
            }else{
                ProposalInovatorMember::where('id',$json->id)->update([
                    'name'=>$json->name,
                    'email'=>$json->email,
                    'telp'=>$json->hp,
                    'note'=>$json->note,
                    'note_updated_date'=>$date->format('Y-m-d H:i:s'),
                    'note_updated_by'=>$user->get()[0]->id
                ]);
            }

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function daftarPemenang($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $buku= Buku::where('id', $id)->get()[0];
            $topik = Topik::where('id_batch',$buku->id_batch)->get();
            $proposal = array();
            $inovasiMember = array();
            foreach ($topik as $item){
                $topikProposal = TopikProposal::where('id_topik',$item->id)->get();
                foreach($topikProposal as $data){
                    if ($data->proposal->status == 8){
                        $proposal[] = $data->proposal;
                        $itemMember = array();
                        foreach($data->proposal->inovasiMember as $item){
                            $rsc = RSC::where('id',$item->pivot->id_rsc)->get();
                            $member = new \stdClass();
                            $member->name = $item->pivot->name;
                            $member->email = $item->pivot->email;
                            $member->telp = $item->pivot->telp;
                            $member->jabatan = $rsc[0]->rsc;
                            $itemMember[] = $member;
                        }
                        $inovasiMember[] = $itemMember;
                    }
                }
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.daftarpemenang', [
                    'buku' => $buku,
                    'proposal'=>$proposal,
                    'inovasiMember'=>$inovasiMember,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.daftarpemenang', [
                    'buku' => $buku,
                    'proposal'=>$proposal,
                    'inovasiMember'=>$inovasiMember,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function draft($idIsiBuku)
    {
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $isiBuku = BukuIsi::where('id', $idIsiBuku)->get()[0];
            $buku = Buku::where('id', $isiBuku->id_buku)->get()[0];
            $word = new \PhpOffice\PhpWord\TemplateProcessor(public_path('storage/buku/template_draft.docx'));
            $word->setValue('judul_singkat',$isiBuku->judul_singkat);
            $word->setValue('short_title',$isiBuku->short_title);
            $word->setValue('kode',$isiBuku->id_proposal);
            $proposal = Proposal::where('id',$isiBuku->id_proposal)->get()[0];
            $word->setValue('arn',$proposal->arn->arn);
            $word->setValue('judul_lengkap',$isiBuku->judul_lengkap);
            $word->setValue('deskripsi',strip_tags(str_replace('&nbsp;','',$isiBuku->deskripsi_singkat)));
            $word->setValue('abstrak',strip_tags(str_replace('&nbsp;','',$proposal->abstrak)));
            $word->setValue('perspektif',strip_tags(str_replace('&nbsp;','',$isiBuku->perspektif)));
            $word->setValue('keunggulan_teknologi',strip_tags(str_replace('&nbsp;','',$isiBuku->keunggulan_inovasi)));
            $word->setValue('potensi_aplikasi',strip_tags(str_replace('&nbsp;','',$isiBuku->potensi_aplikasi)));
            $word->setValue('pengupload',$isiBuku->inovator);
            $word->setValue('institusi',$isiBuku->institusi);
            $word->setValue('alamat',$isiBuku->alamat);
            $word->setValue('paten',$proposal->ipr[0]->no_patent);
            switch ($proposal->id_development){
                case 1:
                    $word->setValue('PI_1','X');
                    $word->setValue('PI_2','');
                    $word->setValue('PI_3','');
                    $word->setValue('PI_4','');
                    $word->setValue('PI_5','');
                    $word->setValue('PI_6','');
                    $word->setValue('PI_7','');
                    $word->setValue('PI_8','');
                    $word->setValue('PI_9','');
                    $word->setValue('PI_10','');
                    break;
                case 2:
                    $word->setValue('PI_1','');
                    $word->setValue('PI_2','X');
                    $word->setValue('PI_3','');
                    $word->setValue('PI_4','');
                    $word->setValue('PI_5','');
                    $word->setValue('PI_6','');
                    $word->setValue('PI_7','');
                    $word->setValue('PI_8','');
                    $word->setValue('PI_9','');
                    $word->setValue('PI_10','');
                    break;
                case 3:
                    $word->setValue('PI_1','');
                    $word->setValue('PI_2','');
                    $word->setValue('PI_3','X');
                    $word->setValue('PI_4','');
                    $word->setValue('PI_5','');
                    $word->setValue('PI_6','');
                    $word->setValue('PI_7','');
                    $word->setValue('PI_8','');
                    $word->setValue('PI_9','');
                    $word->setValue('PI_10','');
                    break;
                case 4:
                    $word->setValue('PI_1','');
                    $word->setValue('PI_2','');
                    $word->setValue('PI_3','');
                    $word->setValue('PI_4','X');
                    $word->setValue('PI_5','');
                    $word->setValue('PI_6','');
                    $word->setValue('PI_7','');
                    $word->setValue('PI_8','');
                    $word->setValue('PI_9','');
                    $word->setValue('PI_10','');
                    break;
                case 5:
                    $word->setValue('PI_1','');
                    $word->setValue('PI_2','');
                    $word->setValue('PI_3','');
                    $word->setValue('PI_4','');
                    $word->setValue('PI_5','X');
                    $word->setValue('PI_6','');
                    $word->setValue('PI_7','');
                    $word->setValue('PI_8','');
                    $word->setValue('PI_9','');
                    $word->setValue('PI_10','');
                    break;
                case 6:
                    $word->setValue('PI_1','');
                    $word->setValue('PI_2','');
                    $word->setValue('PI_3','');
                    $word->setValue('PI_4','');
                    $word->setValue('PI_5','');
                    $word->setValue('PI_6','X');
                    $word->setValue('PI_7','');
                    $word->setValue('PI_8','');
                    $word->setValue('PI_9','');
                    $word->setValue('PI_10','');
                    break;
                case 7:
                    $word->setValue('PI_1','');
                    $word->setValue('PI_2','');
                    $word->setValue('PI_3','');
                    $word->setValue('PI_4','');
                    $word->setValue('PI_5','');
                    $word->setValue('PI_6','');
                    $word->setValue('PI_7','X');
                    $word->setValue('PI_8','');
                    $word->setValue('PI_9','');
                    $word->setValue('PI_10','');
                    break;
                case 8:
                    $word->setValue('PI_1','');
                    $word->setValue('PI_2','');
                    $word->setValue('PI_3','');
                    $word->setValue('PI_4','');
                    $word->setValue('PI_5','');
                    $word->setValue('PI_6','');
                    $word->setValue('PI_7','');
                    $word->setValue('PI_8','X');
                    $word->setValue('PI_9','');
                    $word->setValue('PI_10','');
                    break;
                case 9:
                    $word->setValue('PI_1','');
                    $word->setValue('PI_2','');
                    $word->setValue('PI_3','');
                    $word->setValue('PI_4','');
                    $word->setValue('PI_5','');
                    $word->setValue('PI_6','');
                    $word->setValue('PI_7','');
                    $word->setValue('PI_8','');
                    $word->setValue('PI_9','X');
                    $word->setValue('PI_10','');
                    break;
                case 10:
                    $word->setValue('PI_1','');
                    $word->setValue('PI_2','');
                    $word->setValue('PI_3','');
                    $word->setValue('PI_4','');
                    $word->setValue('PI_5','');
                    $word->setValue('PI_6','');
                    $word->setValue('PI_7','');
                    $word->setValue('PI_8','');
                    $word->setValue('PI_9','');
                    $word->setValue('PI_10','X');
                    break;
                default:
                    $word->setValue('PI_1','');
                    $word->setValue('PI_2','');
                    $word->setValue('PI_3','');
                    $word->setValue('PI_4','');
                    $word->setValue('PI_5','');
                    $word->setValue('PI_6','');
                    $word->setValue('PI_7','');
                    $word->setValue('PI_8','');
                    $word->setValue('PI_9','');
                    $word->setValue('PI_10','');
                    break;
            }
            $arrstrs = explode(',',$isiBuku->id_teknologi);
            $kunciTeknologi = array();
            foreach ($arrstrs as $arrstr){
                $kunci = KataKunciTeknologi::where('id',$arrstr)->get()[0];
                $kunciTeknologi[] = 'T'.$kunci->level1;
            }

            //filled selected technology
            foreach ($kunciTeknologi as $item){
                switch (trim($item)){
                    case 'T001':
                        $word->setValue('T001','X');
                        break;
                    case 'T002':
                        $word->setValue('T002','X');
                        break;
                    case 'T003':
                        $word->setValue('T003','X');
                        break;
                    case 'T004':
                        $word->setValue('T004','X');
                        break;
                    case 'T005':
                        $word->setValue('T005','X');
                        break;
                    case 'T006':
                        $word->setValue('T006','X');
                        break;
                    case 'T007':
                        $word->setValue('T007','X');
                        break;
                    case 'T008':
                        $word->setValue('T008','X');
                        break;
                    case 'T009':
                        $word->setValue('T009','X');
                        break;
                    case 'T010':
                        $word->setValue('T010','X');
                        break;
                    case 'T011':
                        $word->setValue('T011','X');
                        break;
                }
            }

            //filled non selected technology
            for($i=1;$i<=11;$i++){
                $found = false;
                $num = count($kunciTeknologi);
                for($j=0;$j<$num&&!$found;$j++){
                     if ($i < 10){
                         if ($kunciTeknologi[$j] == 'T00'.$i){
                             $found = true;
                         }
                     }else{
                         if ($kunciTeknologi[$j] == 'T0'.$i){
                             $found = true;
                         }
                     }
                }
                if (!$found){
                    if ($i < 10){
                        $word->setValue('T00'.$i,'');
                    }else{
                        $word->setValue('T0'.$i,'');
                    }
                }
            }
            $word->saveAs(public_path('storage/buku/draft_isian_pemenang.docx'));
            return response()->download(public_path('storage/buku/draft_isian_pemenang.docx'));

        }
    }

    public function pageinreview(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            //$buku= Buku::where('id', $id)->get()[0];
            //$proposal = Proposal::where('status',5)->get();
            $proposal = DB::table('bic_buku_isi as buku')
                ->join('bic_proposal as pro','buku.id_proposal','pro.id')
                ->whereIn('pro.status',[5,6,7])
                ->select('buku.*')
                ->get();
            $num = count($proposal);
            for($i=0;$i<$num;$i++){
                $buku = Buku::where('id',$proposal[$i]->id_buku)->get()[0];
                $proposal[$i]->buku_judul = $buku->judul;
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.pageinreview', [
                    'proposal'=>$proposal,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.pageinreview', [
                    'proposal'=>$proposal,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function pageInreviewEdit($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $isibuku = BukuIsi::where('id',$id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.buku.pageInreviewEdit', [
                    'isibuku'=>$isibuku,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.buku.pageInreviewEdit', [
                    'isibuku'=>$isibuku,
                    'datauser' => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function pageInreviewUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            BukuIsi::where('id', $json->id)
                ->update([
                    'page' => $json->page,
                    'orders'=>$json->order,
                    'updated_by' =>$user->get()[0]->id
                ]);

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

}