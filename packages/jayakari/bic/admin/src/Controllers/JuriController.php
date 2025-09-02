<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/21/2018
 * Time: 11:27 AM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use jayakari\bic\admin\Models\Banner;
use jayakari\bic\admin\Models\Batch;
use jayakari\bic\admin\Models\Buku;
use jayakari\bic\admin\Models\DictionaryKategori;
use jayakari\bic\admin\Models\Employee;
use jayakari\bic\admin\Models\Instansi;
use jayakari\bic\admin\Models\KataKunciTeknologi;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\ProposalJuri;
use jayakari\bic\admin\Models\ProposalMasukanTeknis;
use jayakari\bic\admin\Models\ProposalMessage;
use jayakari\bic\admin\Models\RSC;
use jayakari\bic\admin\Models\Topik;
use jayakari\bic\admin\Models\TopikJuri;
use jayakari\bic\admin\Models\TopikProposal;
use jayakari\bic\admin\Models\User;

class JuriController extends Controller
{
    private $kategorilabel = 'penilaian';

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function belumnilai(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',0)
                    ->orWhere('is_finished',2)->get();
            $proposal = array();
            foreach($batch as $item){
                foreach($item->topik as $data){
                    $topikJuri = TopikJuri::where('id_topik',$data->id)
                                ->where('id_juri',$user->get()[0]->id)->get();
                    if (count($topikJuri) > 0){
                        $topikProposal = TopikProposal::where('id_topik',$data->id)->get();
                        foreach($topikProposal as $inner){
                            $proposalJuri = ProposalJuri::where('id_topik',$inner->id_topik)
                                ->where('id_juri',$user->get()[0]->id)
                                ->where('id_proposal',$inner->id_proposal)->get();
                            if (count($proposalJuri) > 0){

                            }else{
                                $proposal[] = $inner;
                            }
                        }
                    }
                }
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.juri.belumnilai', [
                    "proposal"=>$proposal,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.juri.belumnilai', [
                    "proposal"=>$proposal,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function sudahnilai(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',0)
                ->orWhere('is_finished',2)->get();
            $proposal = array();
            foreach($batch as $item){
                foreach($item->topik as $data){
                    $topikJuri = TopikJuri::where('id_topik',$data->id)
                        ->where('id_juri',$user->get()[0]->id)->get();
                    if (count($topikJuri) > 0){
                        $topikProposal = TopikProposal::where('id_topik',$data->id)->get();
                        foreach($topikProposal as $inner){
                            $proposalJuri = ProposalJuri::where('id_topik',$inner->id_topik)
                                ->where('id_juri',$user->get()[0]->id)
                                ->where('id_proposal',$inner->id_proposal)->get();
                            if (count($proposalJuri) > 0){
                                $proposal[] = $inner;
                            }
                        }
                    }
                }
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.juri.sudahnilai', [
                    "proposal"=>$proposal,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.juri.sudahnilai', [
                    "proposal"=>$proposal,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function historynilai(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',1)->get();
            $arrtopik = array();
            foreach($batch as $item){
                foreach($item->topik as $data){
                    $topikJuri = TopikJuri::where('id_topik',$data->id)
                        ->where('id_juri',$user->get()[0]->id)->get();
                    foreach ($topikJuri as $inner){
                        $topik = Topik::where('id',$inner->id_topik)->get()[0];
                        array_push($arrtopik,$topik);
                    }
                }
            }
            $this->kategorilabel = 'history penilaian';
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.juri.historynilai', [
                    "topik"=>$arrtopik,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.juri.historynilai', [
                    "topik"=>$arrtopik,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function activenilai(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',0)
                    ->orWhere('is_finished',2)->get();
            $arrtopik = array();
            foreach($batch as $item){
                foreach($item->topik as $data){
                    $topikJuri = TopikJuri::where('id_topik',$data->id)
                        ->where('id_juri',$user->get()[0]->id)->get();
                    foreach ($topikJuri as $inner){
                        $topik = Topik::where('id',$inner->id_topik)->get()[0];
                        array_push($arrtopik,$topik);
                    }
                }
            }
            $this->kategorilabel = 'history penilaian';
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.juri.activenilai', [
                    "topik"=>$arrtopik,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.juri.activenilai', [
                    "topik"=>$arrtopik,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function topiknilai($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposalJuri = ProposalJuri::where('id_topik',$id)
                ->where('id_juri',$user->get()[0]->id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.juri.topiknilai', [
                    "proposalJuri"=>$proposalJuri,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.juri.topiknilai', [
                    "proposalJuri"=>$proposalJuri,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function belumrespon(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $teknis =  ProposalMasukanTeknis::where('id_juri',$user->get()[0]->id)
                ->where('masukan',null)->get();
            $num = count($teknis);
            for($i=0;$i<$num;$i++){
                $proposalMessage = ProposalMessage::where('id_proposal',$teknis[$i]->id_proposal)
                                    ->where('sender','AdminProses')
                                    ->where('receiver','Juri')->get();
                $teknis[$i]->pertanyaan = $proposalMessage[0]->isi;

            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.juri.belumrespon', [
                    "teknis"=>$teknis,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.juri.belumrespon', [
                    "teknis"=>$teknis,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function sudahrespon(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $teknis =  ProposalMasukanTeknis::where('id_juri',$user->get()[0]->id)
                ->where('masukan','<>',null)
                ->orWhere('masukan','<>','')->get();
            $num = count($teknis);
            for($i=0;$i<$num;$i++){
                $proposalMessage = ProposalMessage::where('id_proposal',$teknis[$i]->id_proposal)
                    ->where('sender','AdminProses')
                    ->where('receiver','Juri')->get();
                $teknis[$i]->pertanyaan = $proposalMessage[0]->isi;

            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.juri.sudahrespon', [
                    "teknis"=>$teknis,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.juri.sudahrespon', [
                    "teknis"=>$teknis,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function review(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',0)
                ->orWhere('is_finished',2)->get();
            $proposal = array();
            $proposalTopik = array();
            foreach($batch as $item){
                foreach($item->topik as $data){
                    $topikJuri = TopikJuri::where('id_topik',$data->id)
                        ->where('id_juri',$user->get()[0]->id)->get();
                    if (count($topikJuri) > 0){
                        $topikProposal = TopikProposal::where('id_topik',$data->id)->get();
                        foreach($topikProposal as $inner){
                            $proposalJuri = ProposalJuri::where('id_topik',$inner->id_topik)
                                ->where('id_juri',$user->get()[0]->id)
                                ->where('id_proposal',$inner->id_proposal)->get();
                            if (count($proposalJuri) > 0){
                                $proposal[] = $proposalJuri[0];
                                $proposalTopik[] = $inner;
                            }
                        }
                    }
                }
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.juri.review', [
                    "proposal"=>$proposal,
                    "topikProposal"=>$proposalTopik,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.juri.review', [
                    "proposal"=>$proposal,
                    "topikProposal"=>$proposalTopik,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function respon($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $teknis =  ProposalMasukanTeknis::where('id',$id)->get()[0];
            $proposal = Proposal::find($teknis->id_proposal);
            //$proposal->message->sortByDesc('inserted_date');

            //label
            $lengkapi = DictionaryKategori::where('kode','HL')->get()[0]->dictionary[0]->isi;
            $T1T = DictionaryKategori::where('kode','T1T')->get()[0]->dictionary[0]->isi;
            $T1D = DictionaryKategori::where('kode','T1D')->get()[0]->dictionary[0]->isi;
            $T2T = DictionaryKategori::where('kode','T2T')->get()[0]->dictionary[0]->isi;
            $T2D = DictionaryKategori::where('kode','T2D')->get()[0]->dictionary[0]->isi;
            $T3T = DictionaryKategori::where('kode','T3T')->get()[0]->dictionary[0]->isi;
            $T3D = DictionaryKategori::where('kode','T3D')->get()[0]->dictionary[0]->isi;
            $T1A = DictionaryKategori::where('kode','T1A')->get()[0]->dictionary[0]->isi;
            $T1DK = DictionaryKategori::where('kode','T1DK')->get()[0]->dictionary[0]->isi;
            $T1KT = DictionaryKategori::where('kode','T1KT')->get()[0]->dictionary[0]->isi;
            $T1PA = DictionaryKategori::where('kode','T1PA')->get()[0]->dictionary[0]->isi;
            $T2TP = DictionaryKategori::where('kode','T2TP')->get()[0]->dictionary[0]->isi;
            $T2H = DictionaryKategori::where('kode','T2H')->get()[0]->dictionary[0]->isi;
            $T2KKT = DictionaryKategori::where('kode','T2KKT')->get()[0]->dictionary[0]->isi;
            $T2KKA = DictionaryKategori::where('kode','T2KKA')->get()[0]->dictionary[0]->isi;
            $T2FBR = DictionaryKategori::where('kode','T2FBR')->get()[0]->dictionary[0]->isi;
            $T2K = DictionaryKategori::where('kode','T2K')->get()[0]->dictionary[0]->isi;
            $T2DI = DictionaryKategori::where('kode','T2DI')->get()[0]->dictionary[0]->isi;
            $T3DP = DictionaryKategori::where('kode','T3DP')->get()[0]->dictionary[0]->isi;
            $T3F = DictionaryKategori::where('kode','T3F')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "lengkapi"=>$lengkapi,
                "T1T"=>$T1T,
                "T1D"=>$T1D,
                "T2T"=>$T2T,
                "T2D"=>$T2D,
                "T3T"=>$T3T,
                "T3D"=>$T3D,
                "T1A"=>$T1A,
                "T1DK"=>$T1DK,
                "T1KT"=>$T1KT,
                "T1PA"=>$T1PA,
                "T2TP"=>$T2TP,
                "T2H"=>$T2H,
                "T2KKT"=>$T2KKT,
                "T2KKA"=>$T2KKA,
                "T2FBR"=>$T2FBR,
                "T2K"=>$T2K,
                "T2DI"=>$T2DI,
                "T3DP"=>$T3DP,
                "T3F"=>$T3F
            );

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
                return view('jayakari.bic.admin::pages.juri.respon',
                    [
                        "proposal"=>$proposal,
                        "teknis"=>$teknis,
                        "labels"=>$labels,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.juri.respon',
                    [
                        "proposal"=>$proposal,
                        "teknis"=>$teknis,
                        "labels"=>$labels,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }
        }
    }

    public function saveRespon(Request $request){

        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposalMasukanTeknis = ProposalMasukanTeknis::where('id',$json->id);
            $proposalMasukanTeknis->update(["masukan"=>$json->isi]);
            //kirim message ke adminproses
            $proposal = Proposal::where('id',$proposalMasukanTeknis->get()[0]->id_proposal);
            $proposalMessage = new ProposalMessage();
            $proposalMessage->judul = '[BIC] Respon permintaan masukan teknis - '.$proposal->get()[0]->judul;
            $proposalMessage->isi = $json->isi;
            $proposalMessage->id_sender = 0;
            $proposalMessage->id_receiver = 0;
            $proposalMessage->sender = "Juri";
            $proposalMessage->receiver = "AdminProses";
            $proposalMessage->status = 1;
            $proposalMessage->inserted_by = $user->get()[0]->id;
            $proposalMessage->updated_by = $user->get()[0]->id;
            $proposal->get()[0]->message()->save($proposalMessage);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function nilai($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',0)->get()[0];
            $buku = Buku::where('id_batch',$batch->id)->get()[0];
            $banner = Buku::whereNotNull('cover_inreview')->orderBy('id','desc')->get()[0];
            $topikProposal =TopikProposal::where('id',$id)->get()[0];
            $teknis =  ProposalMasukanTeknis::where('id_proposal',$topikProposal->id_proposal)->get();
            $proposal = Proposal::find($topikProposal->id_proposal);
            //$proposal->message->sortByDesc('inserted_date');


            //label
            $lengkapi = DictionaryKategori::where('kode','HL')->get()[0]->dictionary[0]->isi;
            $T1T = DictionaryKategori::where('kode','T1T')->get()[0]->dictionary[0]->isi;
            $T1D = DictionaryKategori::where('kode','T1D')->get()[0]->dictionary[0]->isi;
            $T2T = DictionaryKategori::where('kode','T2T')->get()[0]->dictionary[0]->isi;
            $T2D = DictionaryKategori::where('kode','T2D')->get()[0]->dictionary[0]->isi;
            $T3T = DictionaryKategori::where('kode','T3T')->get()[0]->dictionary[0]->isi;
            $T3D = DictionaryKategori::where('kode','T3D')->get()[0]->dictionary[0]->isi;
            $T1A = DictionaryKategori::where('kode','T1A')->get()[0]->dictionary[0]->isi;
            $T1DK = DictionaryKategori::where('kode','T1DK')->get()[0]->dictionary[0]->isi;
            $T1KT = DictionaryKategori::where('kode','T1KT')->get()[0]->dictionary[0]->isi;
            $T1PA = DictionaryKategori::where('kode','T1PA')->get()[0]->dictionary[0]->isi;
            $T2TP = DictionaryKategori::where('kode','T2TP')->get()[0]->dictionary[0]->isi;
            $T2H = DictionaryKategori::where('kode','T2H')->get()[0]->dictionary[0]->isi;
            $T2KKT = DictionaryKategori::where('kode','T2KKT')->get()[0]->dictionary[0]->isi;
            $T2KKA = DictionaryKategori::where('kode','T2KKA')->get()[0]->dictionary[0]->isi;
            $T2FBR = DictionaryKategori::where('kode','T2FBR')->get()[0]->dictionary[0]->isi;
            $T2K = DictionaryKategori::where('kode','T2K')->get()[0]->dictionary[0]->isi;
            $T2DI = DictionaryKategori::where('kode','T2DI')->get()[0]->dictionary[0]->isi;
            $T3DP = DictionaryKategori::where('kode','T3DP')->get()[0]->dictionary[0]->isi;
            $T3F = DictionaryKategori::where('kode','T3F')->get()[0]->dictionary[0]->isi;
            $TNO = DictionaryKategori::where('kode','TNO')->get()[0]->dictionary[0]->isi;
            $PNO = DictionaryKategori::where('kode','PNO')->get()[0]->dictionary[0]->isi;
            $TNRU = DictionaryKategori::where('kode','TNRU')->get()[0]->dictionary[0]->isi;
            $PNRU = DictionaryKategori::where('kode','PNRU')->get()[0]->dictionary[0]->isi;
            $TNDT = DictionaryKategori::where('kode','TNDT')->get()[0]->dictionary[0]->isi;
            $PNDT = DictionaryKategori::where('kode','PNDT')->get()[0]->dictionary[0]->isi;
            $TNT = DictionaryKategori::where('kode','TNT')->get()[0]->dictionary[0]->isi;
            $PNT = DictionaryKategori::where('kode','PNT')->get()[0]->dictionary[0]->isi;
            $TNP = DictionaryKategori::where('kode','TNP')->get()[0]->dictionary[0]->isi;
            $PNP = DictionaryKategori::where('kode','PNP')->get()[0]->dictionary[0]->isi;
            $TNPE = DictionaryKategori::where('kode','TNPE')->get()[0]->dictionary[0]->isi;
            $PNPE = DictionaryKategori::where('kode','PNPE')->get()[0]->dictionary[0]->isi;
            $TNPB = DictionaryKategori::where('kode','TNPB')->get()[0]->dictionary[0]->isi;
            $PNPB = DictionaryKategori::where('kode','PNPB')->get()[0]->dictionary[0]->isi;
            $TNRB = DictionaryKategori::where('kode','TNRB')->get()[0]->dictionary[0]->isi;
            $PNRB = DictionaryKategori::where('kode','PNRB')->get()[0]->dictionary[0]->isi;
            $TNR = DictionaryKategori::where('kode','TNR')->get()[0]->dictionary[0]->isi;
            $PNR = DictionaryKategori::where('kode','PNR')->get()[0]->dictionary[0]->isi;
            $TCR = DictionaryKategori::where('kode','TCR')->get()[0]->dictionary[0]->isi;
            $PCR = DictionaryKategori::where('kode','PCR')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "lengkapi"=>$lengkapi,
                "T1T"=>$T1T,
                "T1D"=>$T1D,
                "T2T"=>$T2T,
                "T2D"=>$T2D,
                "T3T"=>$T3T,
                "T3D"=>$T3D,
                "T1A"=>$T1A,
                "T1DK"=>$T1DK,
                "T1KT"=>$T1KT,
                "T1PA"=>$T1PA,
                "T2TP"=>$T2TP,
                "T2H"=>$T2H,
                "T2KKT"=>$T2KKT,
                "T2KKA"=>$T2KKA,
                "T2FBR"=>$T2FBR,
                "T2K"=>$T2K,
                "T2DI"=>$T2DI,
                "T3DP"=>$T3DP,
                "T3F"=>$T3F,
                "TNO"=>$TNO,
                "PNO"=>$PNO,
                "TNRU"=>$TNRU,
                "PNRU"=>$PNRU,
                "TNDT"=>$TNDT,
                "PNDT"=>$PNDT,
                "TNT"=>$TNT,
                "PNT"=>$PNT,
                "TNP"=>$TNP,
                "PNP"=>$PNP,
                "TNPE"=>$TNPE,
                "PNPE"=>$PNPE,
                "TNPB"=>$TNPB,
                "PNPB"=>$PNPB,
                "TNRB"=>$TNRB,
                "PNRB"=>$PNRB,
                "TNR"=>$TNR,
                "PNR"=>$PNR,
                "TCR"=>$TCR,
                "PCR"=>$PCR
            );

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
                return view('jayakari.bic.admin::pages.juri.nilai',
                    [
                        "topikProposal"=>$topikProposal,
                        "proposal"=>$proposal,
                        "teknis"=>$teknis,
                        "labels"=>$labels,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel,
                        'banner'=>$banner,
                        'buku'=>$buku
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.juri.nilai',
                    [
                        "topikProposal"=>$topikProposal,
                        "proposal"=>$proposal,
                        "teknis"=>$teknis,
                        "labels"=>$labels,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                        'kategorilabel'=>$this->kategorilabel,
                        'banner'=>$banner,
                        'buku'=>$buku
                    ]
                );
            }
        }
    }

    public function saveNilai(Request $request){

        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proJuri = ProposalJuri::where(['id_topik'=>$json->id_topik,'id_proposal'=>$json->id_proposal,'id_juri'=>$json->id_juri])->get();
            $average = ($json->TNO+$json->TNRU+$json->TNDT+$json->TNT+$json->TNP+$json->TNPE+$json->TNPB+$json->TNRB)/8;
            if (count($proJuri) > 0){
                $proposalJuri = ProposalJuri::where('id',$proJuri[0]->id)
                    ->update([
                        "nilai_1"=>$json->TNO,
                        "nilai_2"=>$json->TNRU,
                        "nilai_3"=>$json->TNDT,
                        "nilai_4"=>$json->TNT,
                        "nilai_5"=>$json->TNP,
                        "nilai_6"=>$json->TNPE,
                        "nilai_7"=>$json->TNPB,
                        "nilai_8"=>$json->TNRB,
                        "nilai_9"=>$json->TNR,
                        "alasan"=>$json->alasan,
                        "average"=>$average

                    ]);
                $result = array(
                    "sender" => "bic",
                    "status" => 'success'
                );
            }else{
                $proposalJuri = new ProposalJuri();
                $proposalJuri->id_topik = $json->id_topik;
                $proposalJuri->id_proposal = $json->id_proposal;
                $proposalJuri->id_juri = $json->id_juri;
                $proposalJuri->nilai_1 = $json->TNO;
                $proposalJuri->nilai_2 = $json->TNRU;
                $proposalJuri->nilai_3 = $json->TNDT;
                $proposalJuri->nilai_4 = $json->TNT;
                $proposalJuri->nilai_5 = $json->TNP;
                $proposalJuri->nilai_6 = $json->TNPE;
                $proposalJuri->nilai_7 = $json->TNPB;
                $proposalJuri->nilai_8 = $json->TNRB;
                $proposalJuri->nilai_9 = $json->TNR;
                $average = number_format($average,3,'.',',');
                $proposalJuri->average = $average;
                $proposalJuri->alasan = $json->alasan;
                $proposalJuri->is_complete = 1;
                $proposalJuri->save();
                $result = array(
                    "sender" => "bic",
                    "status" => 'success'
                );
            }
            return response()->json($result);
        }
    }

    public function revisinilai($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $topikProposal =TopikProposal::where('id',$id)->get()[0];
            $teknis =  ProposalMasukanTeknis::where('id_proposal',$topikProposal->id_proposal)->get();
            $proposal = Proposal::find($topikProposal->id_proposal);
            $proposalJuri = ProposalJuri::where('id_topik',$topikProposal->id_topik)
                                ->where('id_proposal',$topikProposal->id_proposal)
                                ->where('id_juri',$user->get()[0]->id)->get()[0];
            //$proposal->message->sortByDesc('inserted_date');

            //label
            $lengkapi = DictionaryKategori::where('kode','HL')->get()[0]->dictionary[0]->isi;
            $T1T = DictionaryKategori::where('kode','T1T')->get()[0]->dictionary[0]->isi;
            $T1D = DictionaryKategori::where('kode','T1D')->get()[0]->dictionary[0]->isi;
            $T2T = DictionaryKategori::where('kode','T2T')->get()[0]->dictionary[0]->isi;
            $T2D = DictionaryKategori::where('kode','T2D')->get()[0]->dictionary[0]->isi;
            $T3T = DictionaryKategori::where('kode','T3T')->get()[0]->dictionary[0]->isi;
            $T3D = DictionaryKategori::where('kode','T3D')->get()[0]->dictionary[0]->isi;
            $T1A = DictionaryKategori::where('kode','T1A')->get()[0]->dictionary[0]->isi;
            $T1DK = DictionaryKategori::where('kode','T1DK')->get()[0]->dictionary[0]->isi;
            $T1KT = DictionaryKategori::where('kode','T1KT')->get()[0]->dictionary[0]->isi;
            $T1PA = DictionaryKategori::where('kode','T1PA')->get()[0]->dictionary[0]->isi;
            $T2TP = DictionaryKategori::where('kode','T2TP')->get()[0]->dictionary[0]->isi;
            $T2H = DictionaryKategori::where('kode','T2H')->get()[0]->dictionary[0]->isi;
            $T2KKT = DictionaryKategori::where('kode','T2KKT')->get()[0]->dictionary[0]->isi;
            $T2KKA = DictionaryKategori::where('kode','T2KKA')->get()[0]->dictionary[0]->isi;
            $T2FBR = DictionaryKategori::where('kode','T2FBR')->get()[0]->dictionary[0]->isi;
            $T2K = DictionaryKategori::where('kode','T2K')->get()[0]->dictionary[0]->isi;
            $T2DI = DictionaryKategori::where('kode','T2DI')->get()[0]->dictionary[0]->isi;
            $T3DP = DictionaryKategori::where('kode','T3DP')->get()[0]->dictionary[0]->isi;
            $T3F = DictionaryKategori::where('kode','T3F')->get()[0]->dictionary[0]->isi;
            $TNO = DictionaryKategori::where('kode','TNO')->get()[0]->dictionary[0]->isi;
            $PNO = DictionaryKategori::where('kode','PNO')->get()[0]->dictionary[0]->isi;
            $TNRU = DictionaryKategori::where('kode','TNRU')->get()[0]->dictionary[0]->isi;
            $PNRU = DictionaryKategori::where('kode','PNRU')->get()[0]->dictionary[0]->isi;
            $TNDT = DictionaryKategori::where('kode','TNDT')->get()[0]->dictionary[0]->isi;
            $PNDT = DictionaryKategori::where('kode','PNDT')->get()[0]->dictionary[0]->isi;
            $TNT = DictionaryKategori::where('kode','TNT')->get()[0]->dictionary[0]->isi;
            $PNT = DictionaryKategori::where('kode','PNT')->get()[0]->dictionary[0]->isi;
            $TNP = DictionaryKategori::where('kode','TNP')->get()[0]->dictionary[0]->isi;
            $PNP = DictionaryKategori::where('kode','PNP')->get()[0]->dictionary[0]->isi;
            $TNPE = DictionaryKategori::where('kode','TNPE')->get()[0]->dictionary[0]->isi;
            $PNPE = DictionaryKategori::where('kode','PNPE')->get()[0]->dictionary[0]->isi;
            $TNPB = DictionaryKategori::where('kode','TNPB')->get()[0]->dictionary[0]->isi;
            $PNPB = DictionaryKategori::where('kode','PNPB')->get()[0]->dictionary[0]->isi;
            $TNRB = DictionaryKategori::where('kode','TNRB')->get()[0]->dictionary[0]->isi;
            $PNRB = DictionaryKategori::where('kode','PNRB')->get()[0]->dictionary[0]->isi;
            $TNR = DictionaryKategori::where('kode','TNR')->get()[0]->dictionary[0]->isi;
            $PNR = DictionaryKategori::where('kode','PNR')->get()[0]->dictionary[0]->isi;
            $TCR = DictionaryKategori::where('kode','TCR')->get()[0]->dictionary[0]->isi;
            $PCR = DictionaryKategori::where('kode','PCR')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "lengkapi"=>$lengkapi,
                "T1T"=>$T1T,
                "T1D"=>$T1D,
                "T2T"=>$T2T,
                "T2D"=>$T2D,
                "T3T"=>$T3T,
                "T3D"=>$T3D,
                "T1A"=>$T1A,
                "T1DK"=>$T1DK,
                "T1KT"=>$T1KT,
                "T1PA"=>$T1PA,
                "T2TP"=>$T2TP,
                "T2H"=>$T2H,
                "T2KKT"=>$T2KKT,
                "T2KKA"=>$T2KKA,
                "T2FBR"=>$T2FBR,
                "T2K"=>$T2K,
                "T2DI"=>$T2DI,
                "T3DP"=>$T3DP,
                "T3F"=>$T3F,
                "TNO"=>$TNO,
                "PNO"=>$PNO,
                "TNRU"=>$TNRU,
                "PNRU"=>$PNRU,
                "TNDT"=>$TNDT,
                "PNDT"=>$PNDT,
                "TNT"=>$TNT,
                "PNT"=>$PNT,
                "TNP"=>$TNP,
                "PNP"=>$PNP,
                "TNPE"=>$TNPE,
                "PNPE"=>$PNPE,
                "TNPB"=>$TNPB,
                "PNPB"=>$PNPB,
                "TNRB"=>$TNRB,
                "PNRB"=>$PNRB,
                "TNR"=>$TNR,
                "PNR"=>$PNR,
                "TCR"=>$TCR,
                "PCR"=>$PCR
            );


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
                return view('jayakari.bic.admin::pages.juri.revisinilai',
                    [
                        "proposal"=>$proposal,
                        "proposalJuri"=>$proposalJuri,
                        "teknis"=>$teknis,
                        "labels"=>$labels,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.juri.revisinilai',
                    [
                        "proposalJuri"=>$proposalJuri,
                        "proposal"=>$proposal,
                        "teknis"=>$teknis,
                        "labels"=>$labels,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }
        }
    }

    public function lihatNilai($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $topikProposal =TopikProposal::where('id',$id)->get()[0];
            $teknis =  ProposalMasukanTeknis::where('id_proposal',$topikProposal->id_proposal)
                                        ->where('id_juri',$user->get()[0]->id)->get();
            $proposal = Proposal::find($topikProposal->id_proposal);
            $proposalJuri = ProposalJuri::where('id_topik',$topikProposal->id_topik)
                                    ->where('id_proposal',$topikProposal->id_proposal)
                                    ->where('id_juri',$user->get()[0]->id)->get();

            //label
            $lengkapi = DictionaryKategori::where('kode','HL')->get()[0]->dictionary[0]->isi;
            $T1T = DictionaryKategori::where('kode','T1T')->get()[0]->dictionary[0]->isi;
            $T1D = DictionaryKategori::where('kode','T1D')->get()[0]->dictionary[0]->isi;
            $T2T = DictionaryKategori::where('kode','T2T')->get()[0]->dictionary[0]->isi;
            $T2D = DictionaryKategori::where('kode','T2D')->get()[0]->dictionary[0]->isi;
            $T3T = DictionaryKategori::where('kode','T3T')->get()[0]->dictionary[0]->isi;
            $T3D = DictionaryKategori::where('kode','T3D')->get()[0]->dictionary[0]->isi;
            $T1A = DictionaryKategori::where('kode','T1A')->get()[0]->dictionary[0]->isi;
            $T1DK = DictionaryKategori::where('kode','T1DK')->get()[0]->dictionary[0]->isi;
            $T1KT = DictionaryKategori::where('kode','T1KT')->get()[0]->dictionary[0]->isi;
            $T1PA = DictionaryKategori::where('kode','T1PA')->get()[0]->dictionary[0]->isi;
            $T2TP = DictionaryKategori::where('kode','T2TP')->get()[0]->dictionary[0]->isi;
            $T2H = DictionaryKategori::where('kode','T2H')->get()[0]->dictionary[0]->isi;
            $T2KKT = DictionaryKategori::where('kode','T2KKT')->get()[0]->dictionary[0]->isi;
            $T2KKA = DictionaryKategori::where('kode','T2KKA')->get()[0]->dictionary[0]->isi;
            $T2FBR = DictionaryKategori::where('kode','T2FBR')->get()[0]->dictionary[0]->isi;
            $T2K = DictionaryKategori::where('kode','T2K')->get()[0]->dictionary[0]->isi;
            $T2DI = DictionaryKategori::where('kode','T2DI')->get()[0]->dictionary[0]->isi;
            $T3DP = DictionaryKategori::where('kode','T3DP')->get()[0]->dictionary[0]->isi;
            $T3F = DictionaryKategori::where('kode','T3F')->get()[0]->dictionary[0]->isi;
            $TNO = DictionaryKategori::where('kode','TNO')->get()[0]->dictionary[0]->isi;
            $PNO = DictionaryKategori::where('kode','PNO')->get()[0]->dictionary[0]->isi;
            $TNRU = DictionaryKategori::where('kode','TNRU')->get()[0]->dictionary[0]->isi;
            $PNRU = DictionaryKategori::where('kode','PNRU')->get()[0]->dictionary[0]->isi;
            $TNDT = DictionaryKategori::where('kode','TNDT')->get()[0]->dictionary[0]->isi;
            $PNDT = DictionaryKategori::where('kode','PNDT')->get()[0]->dictionary[0]->isi;
            $TNT = DictionaryKategori::where('kode','TNT')->get()[0]->dictionary[0]->isi;
            $PNT = DictionaryKategori::where('kode','PNT')->get()[0]->dictionary[0]->isi;
            $TNP = DictionaryKategori::where('kode','TNP')->get()[0]->dictionary[0]->isi;
            $PNP = DictionaryKategori::where('kode','PNP')->get()[0]->dictionary[0]->isi;
            $TNPE = DictionaryKategori::where('kode','TNPE')->get()[0]->dictionary[0]->isi;
            $PNPE = DictionaryKategori::where('kode','PNPE')->get()[0]->dictionary[0]->isi;
            $TNPB = DictionaryKategori::where('kode','TNPB')->get()[0]->dictionary[0]->isi;
            $PNPB = DictionaryKategori::where('kode','PNPB')->get()[0]->dictionary[0]->isi;
            $TNRB = DictionaryKategori::where('kode','TNRB')->get()[0]->dictionary[0]->isi;
            $PNRB = DictionaryKategori::where('kode','PNRB')->get()[0]->dictionary[0]->isi;
            $TNR = DictionaryKategori::where('kode','TNR')->get()[0]->dictionary[0]->isi;
            $PNR = DictionaryKategori::where('kode','PNR')->get()[0]->dictionary[0]->isi;
            $TCR = DictionaryKategori::where('kode','TCR')->get()[0]->dictionary[0]->isi;
            $PCR = DictionaryKategori::where('kode','PCR')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "lengkapi"=>$lengkapi,
                "T1T"=>$T1T,
                "T1D"=>$T1D,
                "T2T"=>$T2T,
                "T2D"=>$T2D,
                "T3T"=>$T3T,
                "T3D"=>$T3D,
                "T1A"=>$T1A,
                "T1DK"=>$T1DK,
                "T1KT"=>$T1KT,
                "T1PA"=>$T1PA,
                "T2TP"=>$T2TP,
                "T2H"=>$T2H,
                "T2KKT"=>$T2KKT,
                "T2KKA"=>$T2KKA,
                "T2FBR"=>$T2FBR,
                "T2K"=>$T2K,
                "T2DI"=>$T2DI,
                "T3DP"=>$T3DP,
                "T3F"=>$T3F,
                "TNO"=>$TNO,
                "PNO"=>$PNO,
                "TNRU"=>$TNRU,
                "PNRU"=>$PNRU,
                "TNDT"=>$TNDT,
                "PNDT"=>$PNDT,
                "TNT"=>$TNT,
                "PNT"=>$PNT,
                "TNP"=>$TNP,
                "PNP"=>$PNP,
                "TNPE"=>$TNPE,
                "PNPE"=>$PNPE,
                "TNPB"=>$TNPB,
                "PNPB"=>$PNPB,
                "TNRB"=>$TNRB,
                "PNRB"=>$PNRB,
                "TNR"=>$TNR,
                "PNR"=>$PNR,
                "TCR"=>$TCR,
                "PCR"=>$PCR
            );

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
                return view('jayakari.bic.admin::pages.juri.lihatnilai',
                    [
                        "topikProposal"=>$topikProposal,
                        "proposal"=>$proposal,
                        "proposalJuri"=>$proposalJuri,
                        "teknis"=>$teknis,
                        "labels"=>$labels,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.juri.lihatnilai',
                    [
                        "topikProposal"=>$topikProposal,
                        "proposal"=>$proposal,
                        "proposalJuri"=>$proposalJuri,
                        "teknis"=>$teknis,
                        "labels"=>$labels,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }
        }
    }

    public function updateNilai(Request $request){

        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $average = ($json->TNO+$json->TNRU+$json->TNDT+$json->TNT+$json->TNP+$json->TNPE+$json->TNPB+$json->TNRB)/8;
            $average = number_format($average,3,'.',',');
            $proposalJuri = ProposalJuri::where('id',$json->id)
                        ->update([
                            "nilai_1"=>$json->TNO,
                            "nilai_2"=>$json->TNRU,
                            "nilai_3"=>$json->TNDT,
                            "nilai_4"=>$json->TNT,
                            "nilai_5"=>$json->TNP,
                            "nilai_6"=>$json->TNPE,
                            "nilai_7"=>$json->TNPB,
                            "nilai_8"=>$json->TNRB,
                            "nilai_9"=>$json->TNR,
                            "alasan"=>$json->alasan,
                            "average"=>$average

                        ]);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

}