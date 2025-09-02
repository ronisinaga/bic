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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use jayakari\bic\admin\Models\ARN;
use jayakari\bic\admin\Models\Development;
use jayakari\bic\admin\Models\DictionaryKategori;
use jayakari\bic\admin\Models\Employee;
use jayakari\bic\admin\Models\InovatorMember;
use jayakari\bic\admin\Models\Instansi;
use jayakari\bic\admin\Models\IPR;
use jayakari\bic\admin\Models\KataKunciTeknologi;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\ProposalFile;
use jayakari\bic\admin\Models\ProposalInovatorMember;
use jayakari\bic\admin\Models\ProposalInstansi;
use jayakari\bic\admin\Models\ProposalIPR;
use jayakari\bic\admin\Models\ProposalJuri;
use jayakari\bic\admin\Models\ProposalKataKunciAplikasi;
use jayakari\bic\admin\Models\ProposalKataKunciKolaborasi;
use jayakari\bic\admin\Models\ProposalKataKunciTeknologi;
use jayakari\bic\admin\Models\ProposalMessage;
use jayakari\bic\admin\Models\ProposalReview;
use jayakari\bic\admin\Models\ProposalURL;
use jayakari\bic\admin\Models\RSC;
use jayakari\bic\admin\Models\StatusProposal;
use jayakari\bic\admin\Models\Topik;
use jayakari\bic\admin\Models\User;
use Maatwebsite\Excel\Facades\Excel;


class ProposalsController extends Controller
{
    private $kategorilabel = 'proposal';

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    /*
     * new method
     */
    public function index(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id_inovator',$user->get()[0]->id)
                                ->orderBy('inserted_date','desc');
            $status = StatusProposal::all();
            $HWI = DictionaryKategori::where('kode','HWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "HWI"=>$HWI
            );
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.index', [
                    "proposal"=>$proposal->get(),
                    "status"=>$status,
                    "datauser" => $user->get(),
                    "labels"=>$labels,
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.index', [
                    "proposal"=>$proposal->get(),
                    "status"=>$status,
                    "datauser" => $user->get(),
                    "labels"=>$labels,
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function judul(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.add', [
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.add', [
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }

    }

    public function saveJudul(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = new Proposal();
            $proposal->judul = $json->judul;
            $proposal->tgl_pembuatan = new \DateTime();
            $proposal->id_inovator = $user->get()[0]->id;
            $proposal->status = 1;
            $proposal->inserted_by = $user->get()[0]->id;
            $proposal->updated_by = $user->get()[0]->id;
            $proposal->save();
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                "id_proposal"=>$proposal->id
            );
            return response()->json($result);
        }

    }

    public function updateJudul(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::find($json->id);
            $proposal->judul = $json->judul;
            $proposal->updated_by = $user->get()[0]->id;
            $proposal->save();
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                "id_proposal"=>$proposal->id
            );
            return response()->json($result);
        }

    }

    public function lengkapi($idProposal){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            //$proposal = Proposal::where('id',$idProposal);
            $proposal = Proposal::find($idProposal);
            $proposal->message->sortByDesc('inserted_date');

            //cek apakah semua field sudah diisi atau belum
            $filled = true;
            if ($proposal->abstrak == null){
                $filled = false;
            }
            if ($filled){
                if ($proposal->deskripsi == null){
                    $filled = false;
                }
            }

            if ($filled){
                if ($proposal->keunggulan_teknologi == null){
                    $filled = false;
                }
            }

            if ($filled){
                if ($proposal->potensi_aplikasi == null){
                    $filled = false;
                }
            }

            if ($filled){
                if (($proposal->id_development == null) || ($proposal->id_development == 0)){
                    $filled = false;
                }
            }

            if ($filled){
                if (count($proposal->ipr) == 0){
                    $filled = false;
                }
            }

            if ($filled){
                $num = count($proposal->kataKunciTeknologi);
                if ($num == 0){
                    $filled = false;
                }
            }

            if ($filled){
                $num = count($proposal->kataKunciAplikasi);
                if ($num == 0){
                    $filled = false;
                }
            }

            if ($filled){
                if (($proposal->id_arn == null) || ($proposal->id_arn == 0)){
                    $filled = false;
                }
            }

            if ($filled){
                $num = count($proposal->kataKunciKolaborasi);
                if ($num == 0){
                    $filled = false;
                }
            }

            if ($filled){
                if ($proposal->instansi == null){
                    $filled = false;
                }
            }

            if ($filled){
                if (count($proposal->inovasiMember) == 0){
                    $filled = false;
                }
            }

            if ($filled){
                if (count($proposal->file) == 0){
                    $filled = false;
                }
            }

            //label
            $lengkapi = DictionaryKategori::where('kode','HL')->get()[0]->dictionary[0]->isi;
            $sudahlengkap = DictionaryKategori::where('kode','HLKP')->get()[0]->dictionary[0]->isi;
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
                "sudahlengkap"=>$sudahlengkap,
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

            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.lengkapi', [
                    "proposal"=>$proposal,
                    "labels"=>$labels,
                    "filled" => $filled,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.lengkapi', [
                    "proposal"=>$proposal,
                    "labels"=>$labels,
                    "filled" => $filled,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }

    }

    public function edit($idProposal){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$idProposal);
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.editJudulProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.editJudulProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }

    }

    public function detail($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$id)->get();
            if (count($proposal[0]->kataKunciTeknologi) > 0){
                $kunciTeknologiLevel1 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciTeknologi[0]->pivot->id_level_1)->get();
                $kunciTeknologiLevel2 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciTeknologi[0]->pivot->id_level_2)->get();
            }else{
                $kunciTeknologiLevel1 = array();
                $kunciTeknologiLevel2 = array();
            }
            if (count($proposal[0]->kataKunciAplikasi)){
                $kunciAplikasiLevel1 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciAplikasi[0]->pivot->id_level_1)->get();
                $kunciAplikasiLevel2 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciAplikasi[0]->pivot->id_level_2)->get();
            }else{
                $kunciAplikasiLevel1 = array();
                $kunciAplikasiLevel2 = array();
            }
            if (count($proposal[0]->kataKunciKolaborasi) > 0){
                $kunciKolaborasiLevel1 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciKolaborasi[0]->pivot->id_level_1)->get();
            }else{
                $kunciKolaborasiLevel1 = array();
            }
            if($proposal[0]->instansi <> null){
                $usaha = explode(',',$proposal[0]->instansi->bidang_usaha);
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
                    if ($proposal[0]->instansi->id_employee == $allemployee[$i]->id){
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
            foreach($proposal[0]->inovasiMember as $item){
                $rsc = RSC::where('id',$item->pivot->id_rsc)->get();
                $member = new \stdClass();
                $member->name = $item->pivot->name;
                $member->jabatan = $rsc[0]->rsc;
                $inovasiMember[$index] = $member;
                $index++;
            }

            //label
            $lengkapi = DictionaryKategori::where('kode','HL')->get()[0]->dictionary[0]->isi;
            $T1T = DictionaryKategori::where('kode','T1T')->get()[0]->dictionary[0]->isi;
            $T1D = DictionaryKategori::where('kode','T1D')->get()[0]->dictionary[0]->isi;
            $T2T = DictionaryKategori::where('kode','T2T')->get()[0]->dictionary[0]->isi;
            $T2D = DictionaryKategori::where('kode','T2D')->get()[0]->dictionary[0]->isi;
            $T3T = DictionaryKategori::where('kode','T3T')->get()[0]->dictionary[0]->isi;
            $T3D = DictionaryKategori::where('kode','T3D')->get()[0]->dictionary[0]->isi;
            $T1A = DictionaryKategori::where('kode','T1A')->get()[0]->dictionary[0]->isi;
            $T1AD = DictionaryKategori::where('kode','T1AD')->get()[0]->dictionary[0]->isi;
            $T1DK = DictionaryKategori::where('kode','T1DK')->get()[0]->dictionary[0]->isi;
            $T1DKD = DictionaryKategori::where('kode','T1DKD')->get()[0]->dictionary[0]->isi;
            $T1KT = DictionaryKategori::where('kode','T1KT')->get()[0]->dictionary[0]->isi;
            $T1KTD = DictionaryKategori::where('kode','T1KTD')->get()[0]->dictionary[0]->isi;
            $T1PA = DictionaryKategori::where('kode','T1PA')->get()[0]->dictionary[0]->isi;
            $T1PAD = DictionaryKategori::where('kode','T1PAD')->get()[0]->dictionary[0]->isi;
            $T2TP = DictionaryKategori::where('kode','T2TP')->get()[0]->dictionary[0]->isi;
            $T2TPK = DictionaryKategori::where('kode','T2TPK')->get()[0]->dictionary[0]->isi;
            $T2H = DictionaryKategori::where('kode','T2H')->get()[0]->dictionary[0]->isi;
            $T2HK = DictionaryKategori::where('kode','T2HK')->get()[0]->dictionary[0]->isi;
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
                "T1AD"=>$T1AD,
                "T1DK"=>$T1DK,
                "T1DKD"=>$T1DKD,
                "T1KT"=>$T1KT,
                "T1KTD"=>$T1KTD,
                "T1PA"=>$T1PA,
                "T1PAD"=>$T1PAD,
                "T2TP"=>$T2TP,
                "T2TPK"=>$T2TPK,
                "T2H"=>$T2H,
                "T2HK"=>$T2HK,
                "T2KKT"=>$T2KKT,
                "T2KKA"=>$T2KKA,
                "T2FBR"=>$T2FBR,
                "T2K"=>$T2K,
                "T2DI"=>$T2DI,
                "T3DP"=>$T3DP,
                "T3F"=>$T3F
            );

            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.detail',
                    [
                        "labels"=>$labels,
                        "proposal"=>$proposal,
                        "kunciTeknologiLevel1"=>$kunciTeknologiLevel1,
                        "kunciTeknologiLevel2"=>$kunciTeknologiLevel2,
                        "kunciAplikasiLevel1"=>$kunciAplikasiLevel1,
                        "kunciAplikasiLevel2"=>$kunciAplikasiLevel2,
                        "kunciKolaborasiLevel1"=>$kunciKolaborasiLevel1,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.proposals.detail',
                    [
                        "labels"=>$labels,
                        "proposal"=>$proposal,
                        "kunciTeknologiLevel1"=>$kunciTeknologiLevel1,
                        "kunciTeknologiLevel2"=>$kunciTeknologiLevel2,
                        "kunciAplikasiLevel1"=>$kunciAplikasiLevel1,
                        "kunciAplikasiLevel2"=>$kunciAplikasiLevel2,
                        "kunciKolaborasiLevel1"=>$kunciKolaborasiLevel1,
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

    public function editProposal($idProposal,$tab){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$idProposal)->get();
            $development = Development::all();
            $ipr = IPR::all();
            $arn = ARN::all();
            $employee = Employee::all();
            $instansi = Instansi::all();
            $katakunciteknologi = KataKunciTeknologi::where('parent',0)
                                        ->where('type',1)->get();
            if (count($proposal[0]->kataKunciTeknologi) > 0){
                $katakunciteknologiLev2 = KataKunciTeknologi::where('parent',$proposal[0]->kataKunciTeknologi[0]->pivot->id_level_1)
                                                            ->where('type',1)->get();
                $katakunciteknologiLev3 = KataKunciTeknologi::where('parent',$proposal[0]->kataKunciTeknologi[0]->pivot->id_level_2)
                                                            ->where('type',1)->get();
            }else{
                $katakunciteknologiLev2 = new Collection();
                $katakunciteknologiLev3 = new Collection();
            }
            /*$kataKunciTeknologiLevel1 = array();
            $kataKunciTeknologiLevel2 = array();
            if (count($proposal[0]->kunciTeknologi) > 0){
                foreach($proposal[0]->kunciTeknologi as $item){
                    $kataKunciTeknologiLevel1[] = KataKunciTeknologi::where('id',$item->id_level_1)->get()[0];
                    $kataKunciTeknologiLevel2[] = KataKunciTeknologi::where('id',$item->id_level_2)->get()[0];
                }
            }*/
            $katakunciaplikasi = KataKunciTeknologi::where('parent',0)
                                        ->where('type',3)->get();
            if (count($proposal[0]->kataKunciAplikasi) > 0){
                $katakunciaplikasiLev2 = KataKunciTeknologi::where('parent',$proposal[0]->kataKunciAplikasi[0]->pivot->id_level_1)
                                                            ->where('type',3)->get();
                $katakunciaplikasiLev3 = KataKunciTeknologi::where('parent',$proposal[0]->kataKunciAplikasi[0]->pivot->id_level_2)
                                                            ->where('type',3)->get();
            }else{
                $katakunciaplikasiLev2 = new Collection();
                $katakunciaplikasiLev3 = new Collection();
            }
            /*$katakunciAplikasiLevel1 = array();
            $katakunciAplikasiLevel2 = array();
            if (count($proposal[0]->kunciTeknologi) > 0){
                foreach($proposal[0]->kunciTeknologi as $item){
                    $katakunciteknologiLev1[] = KataKunciTeknologi::where('id',$item->id_level_1)->get()[0];
                    $katakunciteknologiLev2[] = KataKunciTeknologi::where('id',$item->id_level_2)->get()[0];
                }
            }*/
            $kolaborasi = KataKunciTeknologi::where('parent',0)
                                        ->where('type',2)->get();
            if (count($proposal[0]->kataKunciKolaborasi) > 0){
                $kolaborasiLev2 = KataKunciTeknologi::where('parent',$proposal[0]->kataKunciKolaborasi[0]->pivot->id_level_1)
                                                            ->where('type',2)->get();
            }else{
                $kolaborasiLev2 = new Collection();
            }
            $proposalKolaborasi = ProposalKataKunciKolaborasi::where('id_proposal',$proposal[0]->id)->get();
            $rsc = RSC::all();

            //inovator member
            $inovatorMember = InovatorMember::where('id_inovator',$user->get()[0]->id);

            $num =count($proposal);
            for($i=0;$i<$num;$i++){
                $proposal[$i]->abstrak = str_replace(array("\r\n","\r","\n"),'\n',$proposal[$i]->abstrak);
                $proposal[$i]->deskripsi = str_replace(array("\r\n","\r","\n"),'\n',$proposal[$i]->deskripsi);
                $proposal[$i]->keunggulan_teknologi = str_replace(array("\r\n","\r","\n"),'\n',$proposal[$i]->keunggulan_teknologi);
                $proposal[$i]->potensi_aplikasi = str_replace(array("\r\n","\r","\n"),'\n',$proposal[$i]->potensi_aplikasi);
            }

            //label
            $lengkapi = DictionaryKategori::where('kode','HL')->get()[0]->dictionary[0]->isi;
            $T1T = DictionaryKategori::where('kode','T1T')->get()[0]->dictionary[0]->isi;
            $T1D = DictionaryKategori::where('kode','T1D')->get()[0]->dictionary[0]->isi;
            $T2T = DictionaryKategori::where('kode','T2T')->get()[0]->dictionary[0]->isi;
            $T2D = DictionaryKategori::where('kode','T2D')->get()[0]->dictionary[0]->isi;
            $T3T = DictionaryKategori::where('kode','T3T')->get()[0]->dictionary[0]->isi;
            $T3D = DictionaryKategori::where('kode','T3D')->get()[0]->dictionary[0]->isi;
            $T1A = DictionaryKategori::where('kode','T1A')->get()[0]->dictionary[0]->isi;
            $T1AD = DictionaryKategori::where('kode','T1AD')->get()[0]->dictionary[0]->isi;
            $T1DK = DictionaryKategori::where('kode','T1DK')->get()[0]->dictionary[0]->isi;
            $T1DKD = DictionaryKategori::where('kode','T1DKD')->get()[0]->dictionary[0]->isi;
            $T1KT = DictionaryKategori::where('kode','T1KT')->get()[0]->dictionary[0]->isi;
            $T1KTD = DictionaryKategori::where('kode','T1KTD')->get()[0]->dictionary[0]->isi;
            $T1PA = DictionaryKategori::where('kode','T1PA')->get()[0]->dictionary[0]->isi;
            $T1PAD = DictionaryKategori::where('kode','T1PAD')->get()[0]->dictionary[0]->isi;
            $T2TP = DictionaryKategori::where('kode','T2TP')->get()[0]->dictionary[0]->isi;
            $T2TPK = DictionaryKategori::where('kode','T2TPK')->get()[0]->dictionary[0]->isi;
            $T2H = DictionaryKategori::where('kode','T2H')->get()[0]->dictionary[0]->isi;
            $T2HK = DictionaryKategori::where('kode','T2HK')->get()[0]->dictionary[0]->isi;
            $T2KKT = DictionaryKategori::where('kode','T2KKT')->get()[0]->dictionary[0]->isi;
            $T2PKKT = DictionaryKategori::where('kode','T2PKKT')->get()[0]->dictionary[0]->isi;
            $T2KKTL1 = DictionaryKategori::where('kode','T2KKTL1')->get()[0]->dictionary[0]->isi;
            $T2KKTL2 = DictionaryKategori::where('kode','T2KKTL2')->get()[0]->dictionary[0]->isi;
            $T2KKTL3 = DictionaryKategori::where('kode','T2KKTL3')->get()[0]->dictionary[0]->isi;
            $T2KKA = DictionaryKategori::where('kode','T2KKA')->get()[0]->dictionary[0]->isi;
            if (count(DictionaryKategori::where('kode','T2PKKA')->get()[0]->dictionary) > 0){
                $T2PKKA = DictionaryKategori::where('kode','T2PKKA')->get()[0]->dictionary[0]->isi;
            }else{
                $T2PKKA = '';
            }
            $T2KKAL1 = DictionaryKategori::where('kode','T2KKAL1')->get()[0]->dictionary[0]->isi;
            $T2KKAL2 = DictionaryKategori::where('kode','T2KKAL2')->get()[0]->dictionary[0]->isi;
            $T2KKAL3 = DictionaryKategori::where('kode','T2KKAL3')->get()[0]->dictionary[0]->isi;
            $T2FBR = DictionaryKategori::where('kode','T2FBR')->get()[0]->dictionary[0]->isi;
            if (count(DictionaryKategori::where('kode','T2PFBR')->get()[0]->dictionary) > 0){
                $T2PFBR = DictionaryKategori::where('kode','T2PFBR')->get()[0]->dictionary[0]->isi;
            }else{
                $T2PFBR = '';
            }
            $T2K = DictionaryKategori::where('kode','T2K')->get()[0]->dictionary[0]->isi;
            if (count(DictionaryKategori::where('kode','T2PKYAI')->get()[0]->dictionary) > 0){
                $T2PKYAI = DictionaryKategori::where('kode','T2PKYAI')->get()[0]->dictionary[0]->isi;
            }else{
                $T2PKYAI = '';
            }
            $T2KL1 = DictionaryKategori::where('kode','T2KL1')->get()[0]->dictionary[0]->isi;
            $T2CBMK = DictionaryKategori::where('kode','T2CBMK')->get()[0]->dictionary[0]->isi;
            $T2DI = DictionaryKategori::where('kode','T2DI')->get()[0]->dictionary[0]->isi;
            $T3DP = DictionaryKategori::where('kode','T3DP')->get()[0]->dictionary[0]->isi;
            $T3F = DictionaryKategori::where('kode','T3F')->get()[0]->dictionary[0]->isi;
            $T2PTP = DictionaryKategori::where('kode','T2PTP')->get()[0]->dictionary[0]->isi;
            $T2PH = DictionaryKategori::where('kode','T2PH')->get()[0]->dictionary[0]->isi;
            $T3PDP = DictionaryKategori::where('kode','T3PDP')->get()[0]->dictionary[0]->isi;
            $T3PDFP = DictionaryKategori::where('kode','T3PDFP')->get()[0]->dictionary[0]->isi;
            $CP = DictionaryKategori::where('kode','CP')->get()[0]->dictionary[0]->isi;

            $labels = array(
                "lengkapi"=>$lengkapi,
                "T1T"=>$T1T,
                "T1D"=>$T1D,
                "T2T"=>$T2T,
                "T2D"=>$T2D,
                "T3T"=>$T3T,
                "T3D"=>$T3D,
                "T1A"=>$T1A,
                "T1AD"=>$T1AD,
                "T1DK"=>$T1DK,
                "T1DKD"=>$T1DKD,
                "T1KT"=>$T1KT,
                "T1KTD"=>$T1KTD,
                "T1PA"=>$T1PA,
                "T1PAD"=>$T1PAD,
                "T2TP"=>$T2TP,
                "T2TPK"=>$T2TPK,
                "T2H"=>$T2H,
                "T2HK"=>$T2HK,
                "T2KKT"=>$T2KKT,
                "T2PKKT"=>$T2PKKT,
                "T2KKTL1"=>$T2KKTL1,
                "T2KKTL2"=>$T2KKTL2,
                "T2KKTL3"=>$T2KKTL3,
                "T2KKA"=>$T2KKA,
                "T2PKKA"=>$T2PKKA,
                "T2KKAL1"=>$T2KKAL1,
                "T2KKAL2"=>$T2KKAL2,
                "T2KKAL3"=>$T2KKAL3,
                "T2FBR"=>$T2FBR,
                "T2PFBR"=>$T2PFBR,
                "T2K"=>$T2K,
                "T2PKYAI"=>$T2PKYAI,
                "T2KL1"=>$T2KL1,
                "T2CBMK"=>$T2CBMK,
                "T2DI"=>$T2DI,
                "T3DP"=>$T3DP,
                "T3F"=>$T3F,
                "T2PTP"=>$T2PTP,
                "T2PH"=>$T2PH,
                "T3PDP"=>$T3PDP,
                "T3PDFP"=>$T3PDFP,
                "CP"=>$CP
            );

            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.edit',
                    [
                        "proposal"=>$proposal,
                        "labels"=>$labels,
                        "development"=>$development,
                        "ipr"=>$ipr,
                        "arn"=>$arn,
                        "kunciteknologi"=>$katakunciteknologi,
                        "kunciteknologiLev2"=>$katakunciteknologiLev2,
                        "kunciteknologiLev3"=>$katakunciteknologiLev3,
                        "kunciaplikasi"=>$katakunciaplikasi,
                        "kunciaplikasiLev2"=>$katakunciaplikasiLev2,
                        "kunciaplikasiLev3"=>$katakunciaplikasiLev3,
                        "kolaborasi"=>$kolaborasi,
                        "kolaborasiLev2"=>$kolaborasiLev2,
                        "proposalKolaborasi"=>$proposalKolaborasi,
                        "rsc"=>$rsc,
                        "employee"=>$employee,
                        "instansi"=>$instansi,
                        "tab"=>$tab,
                        "datauser" => $user->get(),
                        "activeCategory"=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.proposals.edit',
                    [
                        "proposal"=>$proposal,
                        "labels"=>$labels,
                        "development"=>$development,
                        "ipr"=>$ipr,
                        "arn"=>$arn,
                        "kunciteknologi"=>$katakunciteknologi,
                        "kunciteknologiLev2"=>$katakunciteknologiLev2,
                        "kunciteknologiLev3"=>$katakunciteknologiLev3,
                        "kunciaplikasi"=>$katakunciaplikasi,
                        "kunciaplikasiLev2"=>$katakunciaplikasiLev2,
                        "kunciaplikasiLev3"=>$katakunciaplikasiLev3,
                        "kolaborasi"=>$kolaborasi,
                        "kolaborasiLev2"=>$kolaborasiLev2,
                        "proposalKolaborasi"=>$proposalKolaborasi,
                        "rsc"=>$rsc,
                        "employee"=>$employee,
                        "instansi"=>$instansi,
                        "tab"=>$tab,
                        "datauser" => $user->get(),
                        'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }
        }

    }

    public function saveProposal(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::find($json->id_proposal);
            $proposal->abstrak = $json->abstrak;
            $proposal->deskripsi = $json->deskripsi;
            $proposal->keunggulan_teknologi = $json->keunggulan_teknologi;
            $proposal->potensi_aplikasi = $json->potensi_aplikasi;
            $proposal->id_development = $json->id_development;
            $proposal->id_arn = $json->id_arn;
            $proposal->catatan = $json->catatan;
            $proposal->updated_by = $user->get()[0]->id;
            $proposal->save();
            $teknologi = array();
            /*$parent_teknologi = array(
                'id_level_1'=>$json->parent_teknologi[0],
                'id_level_2'=>$json->parent_teknologi[1]
            );*/
            foreach($json->kata_kunci_teknologi as $item){
                //$teknologi[$item] = $parent_teknologi;
                $kataKunciTeknologi = new ProposalKataKunciTeknologi();
                $kataKunciTeknologi->id_kata_kunci = $item[0];
                $kataKunciTeknologi->id_level_2 = $item[1];
                $kataKunciTeknologi->id_level_1 = $item[2];
                array_push($teknologi,$kataKunciTeknologi);
            }
            $proposal->kunciTeknologi()->delete();
            $proposal->kunciTeknologi()->saveMany($teknologi);
            $aplikasi = array();
            /*$parent_aplikasi = array(
                'id_level_1'=>$json->parent_aplikasi[0],
                'id_level_2'=>$json->parent_aplikasi[1]
            );*/
            foreach($json->kata_kunci_aplikasi as $item){
                //$aplikasi[$item] = $parent_aplikasi;
                $kataKunciAplikasi = new ProposalKataKunciAplikasi();
                $kataKunciAplikasi->id_kata_kunci = $item[0];
                $kataKunciAplikasi->id_level_2 = $item[1];
                $kataKunciAplikasi->id_level_1 = $item[2];
                array_push($aplikasi,$kataKunciAplikasi);
            }
            $proposal->kunciAplikasi()->delete();
            $proposal->kunciAplikasi()->saveMany($aplikasi);

            $kolaborasi = array();
            /*$parent_kolaborasi = array(
                'id_level_1'=>$json->parent_kolaborasi[0]
            );*/
            $proposal->proposalKataKunciKolaborasi()->delete();
            $proposalKataKunciKolaborasi = array();
            foreach($json->kolaborasi as $item){
                //$kolaborasi[$item] = $parent_kolaborasi;
                $proposalKolaborasi = new ProposalKataKunciKolaborasi();
                $proposalKolaborasi->id_kata_kunci = $item[1];
                $proposalKolaborasi->id_level_1 = $item[0];
                array_push($proposalKataKunciKolaborasi,$proposalKolaborasi);
            }
            $proposal->proposalKataKunciKolaborasi()->saveMany($proposalKataKunciKolaborasi);

            if (count($json->instansi) > 0){
                $numB = count($json->instansi[1]);
                $strbidang = "";
                for($i=0;$i<$numB;$i++){
                    if ($i == $numB-1){
                        $strbidang .= $json->instansi[1][$i];
                    }else{
                        $strbidang .= $json->instansi[1][$i].',';
                    }
                }
                $proposalInstansi = new ProposalInstansi(
                    [
                        "nama_instansi"=>$json->instansi[0],
                        "bidang_usaha"=>$strbidang,
                        "id_employee"=>$json->instansi[2],
                        "inserted_by"=>$user->get()[0]->id,
                        "updated_by"=>$user->get()[0]->id
                    ]
                );
                if ($proposal->instansi <> null){
                    $proposal->instansi()->update([
                        "nama_instansi"=>$json->instansi[0],
                        "bidang_usaha"=>$strbidang,
                        "id_employee"=>$json->instansi[2],
                        "inserted_by"=>$user->get()[0]->id,
                        "updated_by"=>$user->get()[0]->id
                    ]);
                }else{
                    $proposal->instansi()->save($proposalInstansi);
                }

            }

            $proposalInovatorMember = array();
            $idx = 0;
            foreach($json->proposalInovatorMember as $item){
                $inovatorMember = InovatorMember::where('id',$item[0]);
                $member = new ProposalInovatorMember();
                $member->id_inovator_member = $inovatorMember->get()[0]->id;
                $member->id_rsc = $item[1];
                $member->name = $inovatorMember->get()[0]->name;
                $member->email = $inovatorMember->get()[0]->email;
                $member->institusi = $inovatorMember->get()[0]->institusi;
                $member->telp = $inovatorMember->get()[0]->telp;
                $member->alamat = $inovatorMember->get()[0]->alamat;
                $member->inserted_by = $user->get()[0]->id;
                $member->updated_by = $user->get()[0]->id;
                array_push($proposalInovatorMember,$member);
            }
            $proposal->inovatorMember()->delete();
            $proposal->inovatorMember()->saveMany($proposalInovatorMember);
            //delete proposal Url
            ProposalURL::where('id_proposal',$proposal->id)->delete();
            foreach($json->proposalUrl as $item){
                ProposalURL::Create([
                    'id_proposal'=>$proposal->id,
                    'url'=>$item[1],
                    'inserted_by'=>$user->get()[0]->id,
                    'updated_by'=>$user->get()[0]->id
                ]);
            }

            $proposalIPR = array();
            $ipr = new ProposalIPR();
            $ipr->id_ipr = $json->id_ipr;
            $ipr->no_patent = $json->ipr_value;
            array_push($proposalIPR,$ipr);
            $proposal->proposalIPR()->delete();
            $proposal->proposalIPR()->saveMany($proposalIPR);

            //$proposal->kataKunciTeknologi()->detach();
            //$proposal->kataKunciTeknologi()->attach($teknologi);
            //$proposal->kataKunciAplikasi()->detach();
           // $proposal->kataKunciAplikasi()->attach($aplikasi);
            //$proposal->kataKunciKolaborasi()->detach();
            //$proposal->kataKunciKolaborasi()->attach($kolaborasi);
            //$proposal->inovasiMember()->detach();
            //$proposal->inovasiMember()->attach($proposalInovatorMember);
            //$proposal->ipr()->detach();
            //$proposal->ipr()->attach($proposalIPR);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }

    }

    public function saveProposalMember(Request $request)
    {
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $inovatorMember = new InovatorMember();
            $inovatorMember->name = $json->name;
            $inovatorMember->email = $json->email;
            $inovatorMember->institusi = $json->institusi;
            $inovatorMember->telp = $json->telp;
            $inovatorMember->alamat = $json->alamat;
            $inovatorMember->id_inovator = $user->get()[0]->id;
            $inovatorMember->inserted_by = $user->get()[0]->id;
            $inovatorMember->updated_by = $user->get()[0]->id;
            $inovatorMember->save();
            $memberInovator = InovatorMember::where('id_inovator',$user->get()[0]->id);
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                "member"=>$memberInovator->get()
            );
            return response()->json($result);
        }
    }

    public function updateProposalMember(Request $request)
    {
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $inovatorMember = InovatorMember::find($json->id);
            $inovatorMember->name = $json->name;
            $inovatorMember->email = $json->email;
            $inovatorMember->institusi = $json->institusi;
            $inovatorMember->telp = $json->telp;
            $inovatorMember->alamat = $json->alamat;
            $inovatorMember->id_inovator = $user->get()[0]->id;
            $inovatorMember->inserted_by = $user->get()[0]->id;
            $inovatorMember->updated_by = $user->get()[0]->id;
            $inovatorMember->save();
            $memberInovator = InovatorMember::where('id_inovator',$user->get()[0]->id);
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                "member"=>$memberInovator->get()
            );
            return response()->json($result);
        }
    }

    public function deleteProposalMember(Request $request)
    {
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $inovatorMember = InovatorMember::find($json->id);
            $inovatorMember->delete();
            $memberInovator = InovatorMember::where('id_inovator',$user->get()[0]->id);
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                "member"=>$memberInovator->get()
            );
            return response()->json($result);
        }
    }

    public function uploadFile(Request $request){
        $all = $request->all();
        if ($request->hasFile('file')){
            $file = $request->file('file');
            if ($file->isValid()){
                //save to proposal file table
                $path = $file->store('proposal','bic');
                $publicPath = Storage::url($path);
                $proposal = Proposal::find($request->get('id_proposal'));
                $proposalFile = new ProposalFile([
                    'file'=>$file->getClientOriginalName(),
                    'path'=>$path,
                    'public_path'=>$publicPath,
                    'inserted_by'=>Cookie::get('userid'),
                    'updated_by'=>Cookie::get('userid')
                ]);
                $proposal->file()->save($proposalFile);
                $pFile = ProposalFile::where('id_proposal',$request->get('id_proposal'));
                $result = array(
                    "sender" => "bic",
                    "status" => 'success',
                    'files'=>$pFile->get()
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

    public function deleteProposalFile(Request $request)
    {
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposalFile = ProposalFile::find($json->id);
            $proFile = ProposalFile::where('id',$json->id)->get();
            $path = $proFile[0]->path;
            Storage::disk('bic')->delete($path);
            $proposalFile->delete();
            $proposalFile = ProposalFile::where('id_proposal',$json->id_proposal);
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                "proposalFile"=>$proposalFile->get()
            );
            return response()->json($result);
        }
    }

    public function batal(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            Proposal::where('id', $json->id_proposal)
                ->update(['status' => 2]);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function review($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$id)->get();
            $proposalReview = ProposalReview::where('id_proposal',$id)
                                        ->where('is_sent',0)->get();
            $proposalStatus = StatusProposal::all();
            $statusProposal = StatusProposal::whereNotIn('status',["BARU","BATAL","REVIEW","SELEKSI","DISIMPAN","DITERIMA"])->get();
            if (count($proposal[0]->kataKunciTeknologi) > 0){
                $kunciTeknologiLevel1 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciTeknologi[0]->pivot->id_level_1)->get();
                $kunciTeknologiLevel2 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciTeknologi[0]->pivot->id_level_2)->get();
            }else{
                $kunciTeknologiLevel1 = array();
                $kunciTeknologiLevel2 = array();
            }
            if (count($proposal[0]->kataKunciAplikasi)){
                $kunciAplikasiLevel1 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciAplikasi[0]->pivot->id_level_1)->get();
                $kunciAplikasiLevel2 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciAplikasi[0]->pivot->id_level_2)->get();
            }else{
                $kunciAplikasiLevel1 = array();
                $kunciAplikasiLevel2 = array();
            }
            if (count($proposal[0]->kataKunciKolaborasi) > 0){
                $kunciKolaborasiLevel1 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciKolaborasi[0]->pivot->id_level_1)->get();
            }else{
                $kunciKolaborasiLevel1 = array();
            }
            if($proposal[0]->instansi <> null){
                $usaha = explode(',',$proposal[0]->instansi->bidang_usaha);
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
                    if ($proposal[0]->instansi->id_employee == $allemployee[$i]->id){
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
            foreach($proposal[0]->inovasiMember as $item){
                $rsc = RSC::where('id',$item->pivot->id_rsc)->get();
                $member = new \stdClass();
                $member->name = $item->pivot->name;
                $member->jabatan = $rsc[0]->rsc;
                $inovasiMember[$index] = $member;
                $index++;
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.review',
                    [
                        "proposal"=>$proposal,
                        "review"=>$proposalReview,
                        "statusProposal"=>$statusProposal,
                        "kunciTeknologiLevel1"=>$kunciTeknologiLevel1,
                        "kunciTeknologiLevel2"=>$kunciTeknologiLevel2,
                        "kunciAplikasiLevel1"=>$kunciAplikasiLevel1,
                        "kunciAplikasiLevel2"=>$kunciAplikasiLevel2,
                        "kunciKolaborasiLevel1"=>$kunciKolaborasiLevel1,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel,
                        "proposalStatus"=>$proposalStatus
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.proposals.review',
                    [
                        "proposal"=>$proposal,
                        "review"=>$proposalReview,
                        "statusProposal"=>$statusProposal,
                        "kunciTeknologiLevel1"=>$kunciTeknologiLevel1,
                        "kunciTeknologiLevel2"=>$kunciTeknologiLevel2,
                        "kunciAplikasiLevel1"=>$kunciAplikasiLevel1,
                        "kunciAplikasiLevel2"=>$kunciAplikasiLevel2,
                        "kunciKolaborasiLevel1"=>$kunciKolaborasiLevel1,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                        'kategorilabel'=>$this->kategorilabel,
                        "proposalStatus"=>$proposalStatus
                    ]
                );
            }
        }
    }

    public function cariProposal(Request $request)
    {
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $whereQuery = '1=1';
            //$proposal = Proposal::whereRaw('1=1');
            if ($json->nomor_awal <> ''){
                $whereQuery .= ' and id >= '.$json->nomor_awal.'';
                //$proposal = $proposal->where('id','like','%'.$json->nomor_proposal.'%');
            }
            if ($json->nomor_akhir <> ''){
                $whereQuery .= ' and id <= '.$json->nomor_akhir.'';
                //$proposal = $proposal->where('id','like','%'.$json->nomor_proposal.'%');
            }
            if ($json->judul_proposal <> ''){
                $whereQuery .= ' and judul like "%'.$json->judul_proposal.'%"';
                //$proposal = $proposal->where('judul','like','%'.$json->judul_proposal.'%');
            }
            if ($json->keyword_proposal <> ''){
                $whereQuery .= ' and (abstrak like "%'.$json->keyword_proposal.'%" or deskripsi like "%'.$json->keyword_proposal.'%" 
                or keunggulan_teknologi like "%'.$json->keyword_proposal.'%" or potensi_aplikasi like "%'.$json->keyword_proposal.'%" 
                or judul like "%'.$json->keyword_proposal.'%")';
                /*$proposal = $proposal->where('abstrak','like','%'.$json->keyword_proposal.'%')
                                    ->orWhere('deskripsi','like','%'.$json->keyword_proposal.'%')
                                    ->orWhere('keunggulan_teknologi','like','%'.$json->keyword_proposal.'%')
                                    ->orWhere('potensi_aplikasi','like','%'.$json->keyword_proposal.'%');*/
            }
            if ($json->status_proposal <> '0'){
                $whereQuery .= ' and status like "%'.$json->status_proposal.'%"';
                //$proposal = $proposal->where('status',$json->status_proposal);
            }

            if ($json->start <> ''){
                $start = new \DateTime($json->start);
                $whereQuery .= " and updated_date >='".$start->format('Y-m-d')."'";
                //$proposal = $proposal->where('status',$json->status_proposal);
            }

            if ($json->end <> ''){
                $end = new \DateTime($json->end);
                $whereQuery .= " and updated_date <='".$end->format('Y-m-d')."'";
                //$proposal = $proposal->where('status',$json->status_proposal);
            }

            //pencarian berdasarkan nama Invator
            $users = User::where('fullname','like','%'.$json->nama_inovator.'%')->get();
            $ids = "";
            foreach($users as $item){
                $ids .= $item->id.',';
            }
            if ($ids <> ""){
                $ids = rtrim(trim($ids),",");
                $whereQuery .= ' and id_inovator in ('.$ids.')';
            }
            $proposal = Proposal::whereRaw($whereQuery)->orderBy('updated_date','desc');
            $idx = 0;
            $resultProposal = array();
            foreach($proposal->get() as $item){
                $prop = new \stdClass();
                $prop->id = $item->id;
                $updatedDate = new \DateTime($item->updated_date);
                $tglBuat = new \DateTime($item->tgl_pembuatan);
                $prop->updated_date = $updatedDate->format('d M Y H:i:s');
                $prop->created_date = $tglBuat->format('d M Y H:i:s');
                if ($json->judul_proposal <> ''){
                    $judul = str_ireplace($json->judul_proposal,'<b><font color="red">'.$json->judul_proposal.'</font></b>',$item->judul);
                    $prop->judul = $judul;
                }else{
                    $prop->judul = $item->judul;
                }
                if ($json->keyword_proposal <> ''){
                    $judul = str_ireplace($json->keyword_proposal,'<b><font color="red">\''.$json->keyword_proposal.'</font></b>',$item->judul);
                    $prop->judul = $judul;
                    $abstrak = str_ireplace($json->keyword_proposal,'<b><font color="red">\''.$json->keyword_proposal.'</font></b>',$item->abstrak);
                    $prop->abstrak = $abstrak;
                    $deskripsi = str_ireplace($json->keyword_proposal,'<b><font color="red">\''.$json->keyword_proposal.'</font></b>',$item->deskripsi);
                    $prop->deskripsi = $deskripsi;
                    $keunggulan_teknologi = str_ireplace($json->keyword_proposal,'<b><font color="red">\''.$json->keyword_proposal.'</font></b>',$item->keunggulan_teknologi);
                    $prop->keunggulan_teknologi = $keunggulan_teknologi;
                    $potensi_aplikasi = str_ireplace($json->keyword_proposal,'<b><font color="red">\''.$json->keyword_proposal.'</font></b>',$item->potensi_aplikasi);
                    $prop->potensi_aplikasi = $potensi_aplikasi;
                }else{
                    $prop->judul = $item->judul;
                    $prop->abstrak = $item->abstrak;
                    $prop->deskripsi = $item->deskripsi;
                    $prop->keunggulan_teknologi = $item->keunggulan_teknologi;
                    $prop->potensi_aplikasi = $item->potensi_aplikasi;
                }
                $member = "";
                if ($item->id_inovator <> 0){
                    $member .= "<b>".$item->user->fullname.'</b>,';
                }
                foreach($item->inovatorMember as $data){
                    if ($item->id_inovator<> 0){
                        /*if (strtolower($item->user->fullname) <> strtolower($data->name)){
                            $member .= $data->name.', ';
                        }*/
                        $member .= $data->name.', ';
                    }
                }
                $member = rtrim(trim($member),",");
                $prop->fullname = $member;
                $prop->email = $item->user->email;
                if ($item->user->hp <> null){
                    $prop->hp = $item->user->hp;
                }else{
                    $prop->hp = '';
                }

                if ($item->user->alamat <> null){
                    $prop->alamat = $item->user->alamat;
                }else{
                    $prop->alamat = '';
                }
                switch($item->status){
                    case 1:
                        $prop->status = "Baru";
                        break;
                    case 2:
                        $prop->status = "Batal";
                        break;
                    case 3:
                        $prop->status = "Review";
                        break;
                    case 4:
                        $prop->status = "Revisi";
                        break;
                    case 5:
                        $prop->status = "In Review";
                        break;
                    case 6:
                        $prop->status = "Seleksi";
                        break;
                    case 7:
                        $prop->status = "Disimpan";
                        break;
                    case 8:
                        $prop->status = "Diterima";
                        break;
                    case 9:
                        $prop->status = "Discontinued";
                        break;
                }
                if ($item->instansi <> null){
                    if ($item->instansi->instansi <> null){
                        $prop->jenis_instansi = $item->instansi->instansi->instansi;
                    }else{
                        $prop->jenis_instansi = '';
                    }
                    $prop->nama_instansi = $item->instansi->nama_instansi;
                }else{
                    $prop->jenis_instansi = '';
                    $prop->nama_instansi = '';
                }
                if ($item->arn <> null){
                    $prop->nama_arn = $item->arn->arn;
                }else{
                    $prop->nama_arn = '';
                }
                $resultProposal[] = $prop;
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                "proposal"=>$resultProposal
            );
            return response()->json($result);
        }
    }

    public function cariProposalDownload(Request $request)
    {
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $whereQuery = '1=1';
            //$proposal = Proposal::whereRaw('1=1');
            if ($json->nomor_awal <> ''){
                $whereQuery .= ' and id >= '.$json->nomor_awal.'';
                //$proposal = $proposal->where('id','like','%'.$json->nomor_proposal.'%');
            }
            if ($json->nomor_akhir <> ''){
                $whereQuery .= ' and id <= '.$json->nomor_akhir.'';
                //$proposal = $proposal->where('id','like','%'.$json->nomor_proposal.'%');
            }
            if ($json->judul_proposal <> ''){
                $whereQuery .= ' and judul like "%'.$json->judul_proposal.'%"';
                //$proposal = $proposal->where('judul','like','%'.$json->judul_proposal.'%');
            }
            if ($json->keyword_proposal <> ''){
                $whereQuery .= ' and (abstrak like "%'.$json->keyword_proposal.'%" or deskripsi like "%'.$json->keyword_proposal.'%" 
                or keunggulan_teknologi like "%'.$json->keyword_proposal.'%" or potensi_aplikasi like "%'.$json->keyword_proposal.'%" 
                or judul like "%'.$json->keyword_proposal.'%")';
                /*$proposal = $proposal->where('abstrak','like','%'.$json->keyword_proposal.'%')
                                    ->orWhere('deskripsi','like','%'.$json->keyword_proposal.'%')
                                    ->orWhere('keunggulan_teknologi','like','%'.$json->keyword_proposal.'%')
                                    ->orWhere('potensi_aplikasi','like','%'.$json->keyword_proposal.'%');*/
            }
            if ($json->status_proposal <> '0'){
                $whereQuery .= ' and status like "%'.$json->status_proposal.'%"';
                //$proposal = $proposal->where('status',$json->status_proposal);
            }

            if ($json->start <> ''){
                $start = new \DateTime($json->start);
                $whereQuery .= " and updated_date >='".$start->format('Y-m-d')."'";
                //$proposal = $proposal->where('status',$json->status_proposal);
            }

            if ($json->end <> ''){
                $end = new \DateTime($json->end);
                $whereQuery .= " and updated_date <='".$end->format('Y-m-d')."'";
                //$proposal = $proposal->where('status',$json->status_proposal);
            }

            //pencarian berdasarkan nama Invator
            $users = User::where('fullname','like','%'.$json->nama_inovator.'%')->get();
            $ids = "";
            foreach($users as $item){
                $ids .= $item->id.',';
            }
            if ($ids <> ""){
                $ids = rtrim(trim($ids),",");
                $whereQuery .= ' and id_inovator in ('.$ids.')';
            }
            $proposal = Proposal::whereRaw($whereQuery)->orderBy('updated_date','desc');
            $idx = 0;
            $resultProposal = array();
            foreach($proposal->get() as $item){
                $prop = new \stdClass();
                $prop->id = $item->id;
                $updatedDate = new \DateTime($item->updated_date);
                $tglBuat = new \DateTime($item->tgl_pembuatan);
                $prop->updated_date = $updatedDate->format('d M Y H:i:s');
                $prop->created_date = $tglBuat->format('d M Y H:i:s');
                if ($json->judul_proposal <> ''){
                    $judul = str_ireplace($json->judul_proposal,'<b><font color="red">'.$json->judul_proposal.'</font></b>',$item->judul);
                    $prop->judul = $judul;
                }else{
                    $prop->judul = $item->judul;
                }
                if ($json->keyword_proposal <> ''){
                    $judul = str_ireplace($json->keyword_proposal,'<b><font color="red">\''.$json->keyword_proposal.'</font></b>',$item->judul);
                    $prop->judul = $judul;
                    $abstrak = str_ireplace($json->keyword_proposal,'<b><font color="red">\''.$json->keyword_proposal.'</font></b>',$item->abstrak);
                    $prop->abstrak = $abstrak;
                    $deskripsi = str_ireplace($json->keyword_proposal,'<b><font color="red">\''.$json->keyword_proposal.'</font></b>',$item->deskripsi);
                    $prop->deskripsi = $deskripsi;
                    $keunggulan_teknologi = str_ireplace($json->keyword_proposal,'<b><font color="red">\''.$json->keyword_proposal.'</font></b>',$item->keunggulan_teknologi);
                    $prop->keunggulan_teknologi = $keunggulan_teknologi;
                    $potensi_aplikasi = str_ireplace($json->keyword_proposal,'<b><font color="red">\''.$json->keyword_proposal.'</font></b>',$item->potensi_aplikasi);
                    $prop->potensi_aplikasi = $potensi_aplikasi;
                }else{
                    $prop->judul = $item->judul;
                    $prop->abstrak = $item->abstrak;
                    $prop->deskripsi = $item->deskripsi;
                    $prop->keunggulan_teknologi = $item->keunggulan_teknologi;
                    $prop->potensi_aplikasi = $item->potensi_aplikasi;
                }
                $member = "";
                if ($item->id_inovator <> 0){
                    $member .= $item->user->fullname.PHP_EOL;
                }
                foreach($item->inovatorMember as $data){
                    if ($item->id_inovator<> 0){
                        /*if (strtolower($item->user->fullname) <> strtolower($data->name)){
                            $member .= $data->name.', ';
                        }*/
                        $member .= $data->name.PHP_EOL;
                    }
                }
                $member = rtrim(trim($member),",");
                $prop->fullname = $member;
                $prop->email = $item->user->email;
                if ($item->user->hp <> null){
                    $prop->hp = $item->user->hp;
                }else{
                    $prop->hp = '';
                }

                if ($item->user->alamat <> null){
                    $prop->alamat = $item->user->alamat;
                }else{
                    $prop->alamat = '';
                }
                switch($item->status){
                    case 1:
                        $prop->status = "Baru";
                        break;
                    case 2:
                        $prop->status = "Batal";
                        break;
                    case 3:
                        $prop->status = "Review";
                        break;
                    case 4:
                        $prop->status = "Revisi";
                        break;
                    case 5:
                        $prop->status = "In Review";
                        break;
                    case 6:
                        $prop->status = "Seleksi";
                        break;
                    case 7:
                        $prop->status = "Disimpan";
                        break;
                    case 8:
                        $prop->status = "Diterima";
                        break;
                    case 9:
                        $prop->status = "Discontinued";
                        break;
                }
                if ($item->instansi <> null){
                    $prop->jenis_instansi = $item->instansi->instansi->instansi;
                    $prop->nama_instansi = $item->instansi->nama_instansi;
                }else{
                    $prop->jenis_instansi = '';
                    $prop->nama_instansi = '';
                }
                if ($item->arn <> null){
                    $prop->nama_arn = $item->arn->arn;
                }else{
                    $prop->nama_arn = '';
                }
                $resultProposal[] = $prop;
            }
            $fileType = 'Excel2007';
            $fileName = public_path('storage/template/report_proposal.xlsx');
            Excel::load('public/storage/template/project.xlsx',function($reader) use($resultProposal,$fileType,$fileName){
                $objExcel = $reader->getExcel();
                $sheet = $objExcel->getSheet(0);
                $sheet->setTitle('proposal');
                $sheet->mergeCells('A1:S1');
                $sheet->setCellValue('A1','Laporan Data Proposal');
                $sheet->getStyle('A1')->getFont()->setBold(true);
                $sheet->getStyle('A1')->getFont()->setName('Times New Roman');
                $sheet->getStyle('A1')->getFont()->setSize('16');
                $start = 3;
                $start = $this->createProposalTableHeader($sheet,$start);
                $start++;
                $start = $this->createProposalContent($sheet,$start,$resultProposal);

                $objWriter = \PHPExcel_IOFactory::createWriter($objExcel, $fileType);
                $objWriter->save($fileName);
                //add totalPO, totalBudget, paidInvoice

            });
            $result = array(
                "sender"=>"simpro",
                "status"=>'success',
                "filename"=>'report_proposal.xlsx'
            );
            return response()->json($result);
        }
    }

    public function downloadProposal($filename){
        return Excel::load('public/storage/template/'.$filename,function($reader){

        })->download('xlsx');
    }

    private function createProposalTableHeader($sheet,$currstart)
    {
        $styleArrayOutline = array(
            'borders' => array(
                'outline' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            ),
        );
        $start = $currstart;
        $sheet->insertNewRowBefore($start, 1);
        $sheet->setCellValue('A'.$start,'No');
        $sheet->getStyle('A'.$start)->getFont()->setBold(true);
        $sheet->getStyle('A'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('A'.$start)->getFont()->setSize('12');
        $sheet->getStyle('A'.$start.':A'.$start)->applyFromArray($styleArrayOutline);
        $sheet->setCellValue('B'.$start,'ID Proposal');
        $sheet->getStyle('B'.$start)->getFont()->setBold(true);
        $sheet->getStyle('B'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('B'.$start)->getFont()->setSize('12');
        $sheet->getStyle('B'.$start.':B'.$start)->applyFromArray($styleArrayOutline);
        $sheet->setCellValue('C'.$start,'Judul');
        $sheet->getStyle('C'.$start)->getFont()->setBold(true);
        $sheet->getStyle('C'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('C'.$start)->getFont()->setSize('12');
        $sheet->getStyle('C'.$start.':C'.$start)->applyFromArray($styleArrayOutline);
        $sheet->setCellValue('D'.$start,'Inovator');
        $sheet->getStyle('D'.$start)->getFont()->setBold(true);
        $sheet->getStyle('D'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('D'.$start)->getFont()->setSize('12');
        $sheet->getStyle('D'.$start.':D'.$start)->applyFromArray($styleArrayOutline);
        $sheet->setCellValue('E'.$start,'Jenis Instansi');
        $sheet->getStyle('E'.$start)->getFont()->setBold(true);
        $sheet->getStyle('E'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('E'.$start)->getFont()->setSize('12');
        $sheet->getStyle('E'.$start.':E'.$start)->applyFromArray($styleArrayOutline);
        $sheet->setCellValue('F'.$start,'Nama Instansi');
        $sheet->getStyle('F'.$start)->getFont()->setBold(true);
        $sheet->getStyle('F'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('F'.$start)->getFont()->setSize('12');
        $sheet->getStyle('F'.$start.':F'.$start)->applyFromArray($styleArrayOutline);
        $sheet->setCellValue('G'.$start,'ARN');
        $sheet->getStyle('G'.$start)->getFont()->setBold(true);
        $sheet->getStyle('G'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('G'.$start)->getFont()->setSize('12');
        $sheet->getStyle('G'.$start.':G'.$start)->applyFromArray($styleArrayOutline);
        $sheet->setCellValue('H'.$start,'Status');
        $sheet->getStyle('H'.$start)->getFont()->setBold(true);
        $sheet->getStyle('H'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('H'.$start)->getFont()->setSize('12');
        $sheet->getStyle('H'.$start.':H'.$start)->applyFromArray($styleArrayOutline);
        $sheet->setCellValue('I'.$start,'Tanggal Buat');
        $sheet->getStyle('I'.$start)->getFont()->setBold(true);
        $sheet->getStyle('I'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('I'.$start)->getFont()->setSize('12');
        $sheet->getStyle('I'.$start.':I'.$start)->applyFromArray($styleArrayOutline);
        $sheet->setCellValue('J'.$start,'Tanggal Ubah');
        $sheet->getStyle('J'.$start)->getFont()->setBold(true);
        $sheet->getStyle('J'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('J'.$start)->getFont()->setSize('12');
        $sheet->getStyle('J'.$start.':J'.$start)->applyFromArray($styleArrayOutline);
        $sheet->setCellValue('K'.$start,'Email');
        $sheet->getStyle('K'.$start)->getFont()->setBold(true);
        $sheet->getStyle('K'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('K'.$start)->getFont()->setSize('12');
        $sheet->getStyle('K'.$start.':K'.$start)->applyFromArray($styleArrayOutline);
        $sheet->setCellValue('L'.$start,'Telp/Hp');
        $sheet->getStyle('L'.$start)->getFont()->setBold(true);
        $sheet->getStyle('L'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('L'.$start)->getFont()->setSize('12');
        $sheet->getStyle('L'.$start.':L'.$start)->applyFromArray($styleArrayOutline);
        $sheet->setCellValue('M'.$start,'Alamat');
        $sheet->getStyle('M'.$start)->getFont()->setBold(true);
        $sheet->getStyle('M'.$start)->getFont()->setName('Times New Roman');
        $sheet->getStyle('M'.$start)->getFont()->setSize('12');
        $sheet->getStyle('M'.$start.':M'.$start)->applyFromArray($styleArrayOutline);

        return $start;
    }

    private function createProposalContent($sheet,$currstart,$data)
    {
        $styleArrayOutline = array(
            'borders' => array(
                'outline' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                )
            ),
        );
        $start = $currstart;
        $index = 1;
        foreach ($data as $item){
            $sheet->insertNewRowBefore($start, 1);
            $sheet->setCellValue('A'.$start,$index);
            $sheet->getStyle('A'.$start)->getFont()->setBold(false);
            $sheet->getStyle('A'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('A'.$start)->getFont()->setSize('12');
            $sheet->getStyle('A'.$start.':A'.$start)->applyFromArray($styleArrayOutline);
            $sheet->setCellValue('B'.$start,$item->id);
            $sheet->getStyle('B'.$start)->getFont()->setBold(false);
            $sheet->getStyle('B'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('B'.$start)->getFont()->setSize('12');
            $sheet->getStyle('B'.$start.':B'.$start)->applyFromArray($styleArrayOutline);
            $sheet->setCellValue('C'.$start,$item->judul);
            $sheet->getStyle('C'.$start)->getFont()->setBold(false);
            $sheet->getStyle('C'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('C'.$start)->getFont()->setSize('12');
            $sheet->getStyle('C'.$start.':C'.$start)->applyFromArray($styleArrayOutline);
            $sheet->setCellValue('D'.$start,$item->fullname);
            $sheet->getStyle('D'.$start)->getFont()->setBold(false);
            $sheet->getStyle('D'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('D'.$start)->getFont()->setSize('12');
            $sheet->getStyle('D'.$start.':D'.$start)->applyFromArray($styleArrayOutline);
            $sheet->getStyle('D'.$start)->getAlignment()->setWrapText(true);
            $sheet->setCellValue('E'.$start,$item->jenis_instansi);
            $sheet->getStyle('E'.$start)->getFont()->setBold(false);
            $sheet->getStyle('E'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('E'.$start)->getFont()->setSize('12');
            $sheet->getStyle('E'.$start.':E'.$start)->applyFromArray($styleArrayOutline);
            $sheet->setCellValue('F'.$start,$item->nama_instansi);
            $sheet->getStyle('F'.$start)->getFont()->setBold(false);
            $sheet->getStyle('F'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('F'.$start)->getFont()->setSize('12');
            $sheet->getStyle('F'.$start.':F'.$start)->applyFromArray($styleArrayOutline);
            $sheet->setCellValue('G'.$start,$item->nama_arn);
            $sheet->getStyle('G'.$start)->getFont()->setBold(false);
            $sheet->getStyle('G'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('G'.$start)->getFont()->setSize('12');
            $sheet->getStyle('G'.$start.':G'.$start)->applyFromArray($styleArrayOutline);
            $sheet->setCellValue('H'.$start,$item->status);
            $sheet->getStyle('H'.$start)->getFont()->setBold(false);
            $sheet->getStyle('H'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('H'.$start)->getFont()->setSize('12');
            $sheet->getStyle('H'.$start.':H'.$start)->applyFromArray($styleArrayOutline);
            $sheet->setCellValue('I'.$start,$item->created_date);
            $sheet->getStyle('I'.$start)->getFont()->setBold(false);
            $sheet->getStyle('I'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('I'.$start)->getFont()->setSize('12');
            $sheet->getStyle('I'.$start.':I'.$start)->applyFromArray($styleArrayOutline);
            $sheet->setCellValue('J'.$start,$item->updated_date);
            $sheet->getStyle('J'.$start)->getFont()->setBold(false);
            $sheet->getStyle('J'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('J'.$start)->getFont()->setSize('12');
            $sheet->getStyle('J'.$start.':J'.$start)->applyFromArray($styleArrayOutline);
            $sheet->setCellValue('K'.$start,$item->email);
            $sheet->getStyle('K'.$start)->getFont()->setBold(false);
            $sheet->getStyle('K'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('K'.$start)->getFont()->setSize('12');
            $sheet->getStyle('K'.$start.':K'.$start)->applyFromArray($styleArrayOutline);
            $sheet->setCellValue('L'.$start,$item->hp);
            $sheet->getStyle('L'.$start)->getFont()->setBold(false);
            $sheet->getStyle('L'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('L'.$start)->getFont()->setSize('12');
            $sheet->getStyle('L'.$start.':L'.$start)->applyFromArray($styleArrayOutline);
            $sheet->setCellValue('M'.$start,$item->alamat);
            $sheet->getStyle('M'.$start)->getFont()->setBold(false);
            $sheet->getStyle('M'.$start)->getFont()->setName('Times New Roman');
            $sheet->getStyle('M'.$start)->getFont()->setSize('12');
            $sheet->getStyle('M'.$start.':M'.$start)->applyFromArray($styleArrayOutline);
            $start++;
            $index++;
        }

        return $start;
    }

    public function saveReview(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::where('id',$json->id_proposal);
            $proReview = ProposalReview::where('is_sent',0)->get();
            if(count($proReview) > 0){
                if ($json->status <> 0){
                    ProposalReview::where('id',$proReview[0]->id)
                        ->update(['isi'=>$json->isi,"id_proposal"=>$json->id_proposal,"is_sent"=>1,"updated_by"=>$user->get()[0]->id]);
                    //update proposal
                    $proposal->update(["status"=>$json->status]);
                    $email = new EmailController();
                    switch($json->status){
                        case "4":
                            //save message to inovator
                            $proposalMessage = new ProposalMessage();
                            $proposalMessage->judul = $proposal->get()[0]->judul.'<br>';
                            $proposalMessage->isi = $proReview[0]->isi;
                            $proposalMessage->id_sender = 0;
                            $proposalMessage->id_receiver = $proposal->get()[0]->user->id;
                            $proposalMessage->sender = "Reviewer";
                            $proposalMessage->receiver = "Inovator";
                            $proposalMessage->status = 0;
                            $proposalMessage->inserted_by = $user->get()[0]->id;
                            $proposalMessage->updated_by = $user->get()[0]->id;
                            $proposal->get()[0]->message()->save($proposalMessage);
                            $email->sendRevisi($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
                            break;
                        case "5":
                            //save message to inovator
                            $proposalMessage = new ProposalMessage();
                            $proposalMessage->judul = $proposal->get()[0]->judul.'<br>';
                            $proposalMessage->isi = $proReview[0]->isi;
                            $proposalMessage->id_sender = 0;
                            $proposalMessage->id_receiver = $proposal->get()[0]->user->id;
                            $proposalMessage->sender = "Reviewer";
                            $proposalMessage->receiver = "Inovator";
                            $proposalMessage->status = 0;
                            $proposalMessage->inserted_by = $user->get()[0]->id;
                            $proposalMessage->updated_by = $user->get()[0]->id;
                            $proposal->get()[0]->message()->save($proposalMessage);

                            //save message to admin prosess
                            $proposalMessageProses = new ProposalMessage();
                            $proposalMessageProses->judul = '[BIC] Proses In Review - '.$proposal->judul;
                            $proposalMessageProses->isi = '<p style="text-align: justify">Mohon kepada tim admin proses untuk melakukan review secara menyeluruh terhadap proposal dibawah ini<br><br>';
                            $proposalMessageProses->isi .= 'Resume Proposal:<br>';
                            $proposalMessageProses->isi .= 'Judul    : '.$proposal->judul.'<br>';
                            $proposalMessageProses->isi .= 'Inovator : '.$proposal->user->fullname.'<br>';
                            $proposalMessageProses->id_sender = 0;
                            $proposalMessageProses->id_receiver = 0;
                            $proposalMessageProses->sender = "Reviewer";
                            $proposalMessageProses->receiver = "AdminProses";
                            $proposalMessageProses->status = 0;
                            $proposalMessageProses->inserted_by = $user->get()[0]->id;
                            $proposalMessageProses->updated_by = $user->get()[0]->id;
                            $proposal->get()[0]->message()->save($proposalMessageProses);
                            $email->sendInReview($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
                            break;
                        case "9":
                            //save message to inovator
                            $proposalMessage = new ProposalMessage();
                            $proposalMessage->judul = $proposal->get()[0]->judul.'<br>';
                            $proposalMessage->isi = $json->isi;
                            $proposalMessage->id_sender = 0;
                            $proposalMessage->id_receiver = $proposal->get()[0]->user->id;
                            $proposalMessage->sender = "Reviewer";
                            $proposalMessage->receiver = "Inovator";
                            $proposalMessage->status = 0;
                            $proposalMessage->inserted_by = $user->get()[0]->id;
                            $proposalMessage->updated_by = $user->get()[0]->id;
                            $proposal->get()[0]->message()->save($proposalMessage);
                            $email->sendDiscontinued($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage,$json->isi);
                            break;
                    }

                    /*switch ($json->status){
                        case "4":

                            break;
                        case "5":

                            break;
                    }*/
                }else{
                    ProposalReview::where('id',$proReview[0]->id)
                        ->update(['isi'=>$json->isi,"id_proposal"=>$json->id_proposal,"updated_by"=>$user->get()[0]->id]);
                }
            }else{
                $proposalReview = new ProposalReview();
                $proposalReview->judul = "[BIC]Hasil Review - ".$proposal->get()[0]->judul;
                $proposalReview->isi = $json->isi;
                $email = new EmailController();
                if ($json->status <> 0){
                    $proposalReview->is_sent = 1;
                    $proposalReview->inserted_by = $user->get()[0]->id;
                    $proposalReview->updated_by = $user->get()[0]->id;
                    //update status proposal
                    $proposal->update(["status"=>$json->status]);
                    //insert proposal review
                    $proposal->get()[0]->review()->save($proposalReview);
                    switch ($json->status){
                        case "4":
                            //insert proposal message
                            $proposalMessage = new ProposalMessage();
                            $proposalMessage->judul = $proposalReview->judul;
                            $proposalMessage->isi = $proposalReview->isi;
                            $proposalMessage->id_sender = 0;
                            $proposalMessage->id_receiver = $proposal->get()[0]->user->id;
                            $proposalMessage->sender = "Reviewer";
                            $proposalMessage->receiver = "Inovator";
                            $proposalMessage->status = 0;
                            $proposalMessage->inserted_by = $user->get()[0]->id;
                            $proposalMessage->updated_by = $user->get()[0]->id;
                            $proposal->get()[0]->message()->save($proposalMessage);
                            $email->sendRevisi($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
                            break;
                        case "5":
                            //insert proposal message
                            $proposalMessage = new ProposalMessage();
                            $proposalMessage->judul = $proposalReview->judul;
                            $proposalMessage->isi = $proposalReview->isi;
                            $proposalMessage->id_sender = 0;
                            $proposalMessage->id_receiver = $proposal->get()[0]->user->id;
                            $proposalMessage->sender = "Reviewer";
                            $proposalMessage->receiver = "Inovator";
                            $proposalMessage->status = 0;
                            $proposalMessage->inserted_by = $user->get()[0]->id;
                            $proposalMessage->updated_by = $user->get()[0]->id;
                            $proposal->get()[0]->message()->save($proposalMessage);
                            $email->sendRevisi($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
                            //send email to inovator & admin proses
                            //save message to admin prosess
                            $proposalMessageProses = new ProposalMessage();
                            $proposalMessageProses->judul = '[BIC]Permohonan Review secara teknis isi proposal - '.$proposal->get()[0]->judul;
                            $proposalMessageProses->isi = '<p style="text-align: justify">Mohon kepada tim admin proses untuk mereview secara teknis isi proposal ini<br>';
                            $proposalMessageProses->isi .= 'Resume Proposal:<br>';
                            $proposalMessageProses->isi .= 'Judul    : '.$proposal->get()[0]->judul.'<br>';
                            //$proposalMessageProses->isi .= 'Para Inovator : '.$proposal->get()[0]->user->fullname.'<br><br>';
                            //$proposalMessageProses->isi .= 'Para Inovator : ';
                            //foreach($proposal->get()[0]->)
                            $proposalMessageProses->id_sender = 0;
                            $proposalMessageProses->id_receiver = 0;
                            $proposalMessageProses->sender = "Reviewer";
                            $proposalMessageProses->receiver = "AdminProses";
                            $proposalMessageProses->status = 0;
                            $proposalMessageProses->inserted_by = $user->get()[0]->id;
                            $proposalMessageProses->updated_by = $user->get()[0]->id;
                            $proposal->get()[0]->message()->save($proposalMessageProses);
                            $email->sendInReview($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
                            break;
                        case "9":
                            //save message to inovator
                            $proposalMessage = new ProposalMessage();
                            $proposalMessage->judul = $proposal->get()[0]->judul.'<br>';
                            $proposalMessage->isi = $json->isi;
                            $proposalMessage->id_sender = 0;
                            $proposalMessage->id_receiver = $proposal->get()[0]->user->id;
                            $proposalMessage->sender = "Reviewer";
                            $proposalMessage->receiver = "Inovator";
                            $proposalMessage->status = 0;
                            $proposalMessage->inserted_by = $user->get()[0]->id;
                            $proposalMessage->updated_by = $user->get()[0]->id;
                            $proposal->get()[0]->message()->save($proposalMessage);
                            $email->sendDiscontinued($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage,$json->isi);
                            break;
                    }

                }else{
                    $proposalReview->is_sent = 0;
                    $proposalReview->inserted_by = $user->get()[0]->id;
                    $proposalReview->updated_by = $user->get()[0]->id;
                    $proposal->get()[0]->review()->save($proposalReview);
                }
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function masuk(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::whereIn('status',[1]);
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.masuk', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.masuk', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function detailMasuk($id,$tahapan){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$id)->get();
            if (count($proposal[0]->kunciTeknologi) > 0){
                $kunciTeknologiLevel1 = array();
                $kunciTeknologiLevel2 = array();
                foreach($proposal[0]->kunciTeknologi as $item){
                    $level1 = KataKunciTeknologi::where('id',$item->id_level_1)->get();
                    if (count($level1) > 0){
                        $kunciTeknologiLevel1[] = $level1[0];
                    }
                    $level2 = KataKunciTeknologi::where('id',$item->id_level_2)->get();
                    if (count($level2) > 0){
                        $kunciTeknologiLevel2[] = $level2[0];
                    }
                }
            }else{
                $kunciTeknologiLevel1 = array();
                $kunciTeknologiLevel2 = array();
            }
            if (count($proposal[0]->kunciAplikasi) > 0){
                $kunciAplikasiLevel1 = array();
                $kunciAplikasiLevel2 = array();
                foreach($proposal[0]->kunciAplikasi as $item){
                    $level1 = KataKunciTeknologi::where('id',$item->id_level_1)->get();
                    if (count($level1) > 0){
                        $kunciAplikasiLevel1[] = $level1[0];
                    }
                    $level2 = KataKunciTeknologi::where('id',$item->id_level_2)->get();
                    if (count($level2) > 0){
                        $kunciAplikasiLevel2[] = $level2[0];
                    }
                }
            }else{
                $kunciAplikasiLevel1 = array();
                $kunciAplikasiLevel2 = array();
            }
            if (count($proposal[0]->kunciKolaborasi) > 0){
                $kunciKolaborasiLevel1 = array();
                foreach($proposal[0]->kunciKolaborasi as $item){
                    $level1 = KataKunciTeknologi::where('id',$item->id_level_1)->get();
                    if (count($level1) > 0){
                        $kunciKolaborasiLevel1[] = $level1[0];
                    }
                }
            }else{
                $kunciKolaborasiLevel1 = array();
            }
            if($proposal[0]->instansi <> null){
                $usaha = explode(',',$proposal[0]->instansi->bidang_usaha);
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
                    if ($proposal[0]->instansi->id_employee == $allemployee[$i]->id){
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
            foreach($proposal[0]->inovasiMember as $item){
                $rsc = RSC::where('id',$item->pivot->id_rsc)->get();
                $member = new \stdClass();
                $member->name = $item->pivot->name;
                $member->jabatan = $rsc[0]->rsc;
                $inovasiMember[$index] = $member;
                $index++;
            }
            //grouping nilai juri
            $topik = DB::table('bic_proposal_juri')->select(DB::raw('distinct(id_topik)'))
                ->where('id_proposal',$proposal[0]->id)->get();
            $penilaianJuri = array();
            foreach ($topik as $item){
                $oTopik = new \stdClass();
                $currentTopik = Topik::where('id',$item->id_topik)->get()[0];
                $oTopik->batch = $currentTopik->batch->batch;
                $oTopik->short = $currentTopik->batch->short;
                $oTopik->kategori = $currentTopik->topik;
                $proposalJuri = ProposalJuri::where(['id_topik'=>$currentTopik->id,'id_proposal'=>$proposal[0]->id])->get();
                $oTopik->jumlah_juri = count($proposalJuri);
                $d1=0;$d2=0;$d3=0;$d3=0;$d4=0;$d5=0;$d6=0;$d7=0;$d8=0;
                $min=""; $max="";
                $totalNilai = 0;
                $juri = array();
                for($i=0;$i<count($proposalJuri);$i++){
                    if ($i == 0){
                        $min =$proposalJuri[$i]->nilai_9;
                        $max =$proposalJuri[$i]->nilai_9;
                    }else{
                        if ($min > $proposalJuri[$i]->nilai_9){
                            $min = $proposalJuri[$i]->nilai_9;
                        }
                        if ($max < $proposalJuri[$i]->nilai_9){
                            $max = $proposalJuri[$i]->nilai_9;
                        }
                    }
                    $nilai = new \stdClass();
                    $nilai->d1 = $proposalJuri[$i]->nilai_1;
                    $nilai->d2 = $proposalJuri[$i]->nilai_2;
                    $nilai->d3 = $proposalJuri[$i]->nilai_3;
                    $nilai->d4 = $proposalJuri[$i]->nilai_4;
                    $nilai->d5 = $proposalJuri[$i]->nilai_5;
                    $nilai->d6 = $proposalJuri[$i]->nilai_6;
                    $nilai->d7 = $proposalJuri[$i]->nilai_7;
                    $nilai->d8 = $proposalJuri[$i]->nilai_8;
                    if ($proposalJuri[$i]->nilai_9 == 'A'){
                        $nilai->d9 = '<span style="font-size:36px;color:red"><b>'.$proposalJuri[$i]->nilai_9.'</b></span>';
                    }else{
                        $nilai->d9 = $proposalJuri[$i]->nilai_9;
                    }
                    $nilai->average = $proposalJuri[$i]->average;
                    $nilai->juri = $proposalJuri[$i]->juri->fullname;
                    $date = new \DateTime($proposalJuri[$i]->inserted_date);
                    $nilai->komentar = $proposalJuri[$i]->alasan.' ('.$date->format('d M Y H:i:s').')';
                    $juri[$i] = $nilai;
                    for($j=$i+1;$j<count($proposalJuri);$j++){
                        $selisih1 = abs($proposalJuri[$j]->nilai_1 - $proposalJuri[$i]->nilai_1);
                        if ($selisih1 > $d1){
                            $d1 = $selisih1;
                        }
                        $selisih2 = abs($proposalJuri[$j]->nilai_2 - $proposalJuri[$i]->nilai_2);
                        if ($selisih2 > $d2){
                            $d2 = $selisih2;
                        }
                        $selisih3 = abs($proposalJuri[$j]->nilai_3 - $proposalJuri[$i]->nilai_3);
                        if ($selisih3 > $d3){
                            $d3 = $selisih3;
                        }
                        $selisih4 = abs($proposalJuri[$j]->nilai_4 - $proposalJuri[$i]->nilai_4);
                        if ($selisih4 > $d4){
                            $d4 = $selisih4;
                        }
                        $selisih5 = abs($proposalJuri[$j]->nilai_5 - $proposalJuri[$i]->nilai_5);
                        if ($selisih5 > $d5){
                            $d5 = $selisih5;
                        }
                        $selisih6 = abs($proposalJuri[$j]->nilai_6 - $proposalJuri[$i]->nilai_6);
                        if ($selisih6 > $d6){
                            $d6 = $selisih6;
                        }
                        $selisih7 = abs($proposalJuri[$j]->nilai_7 - $proposalJuri[$i]->nilai_7);
                        if ($selisih7 > $d7){
                            $d7 = $selisih7;
                        }
                        $selisih8 = abs($proposalJuri[$j]->nilai_8 - $proposalJuri[$i]->nilai_8);
                        if ($selisih8 > $d8){
                            $d8 = $selisih8;
                        }
                    }
                    $totalNilai += $proposalJuri[$i]->average;
                }
                $rata2 = $totalNilai/count($proposalJuri);
                $rata2 = number_format($rata2,5,'.','.');
                $oTopik->average = $rata2;
                $oTopik->penilaian_juri = $juri;
                if ($min == 'A'){
                    $oTopik->min = '<span style="font-size:36px;color:red"><b>'.$min.'</b></span>';
                }else{
                    $oTopik->min = $min;
                }
                if ($max == 'A'){
                    $oTopik->max = '<span style="font-size:36px;color:red"><b>'.$max.'</b></span>';
                }else{
                    $oTopik->max = $max;
                }
                $oTopik->kode = $proposal[0]->id;
                $g = 0;
                if ($d1 >=2){
                    $g++;
                    $d1 = '<span style="font-size:30px;color:red"><b>'.$d1.'</b></span>';
                }
                if ($d2 >=2){
                    $g++;
                    $d2 = '<span style="font-size:30px;color:red"><b>'.$d2.'</b></span>';
                }
                if ($d3 >=2){
                    $g++;
                    $d3 = '<span style="font-size:30px;color:red"><b>'.$d3.'</b></span>';
                }
                if ($d4 >=2){
                    $g++;
                    $d4 = '<span style="font-size:30px;color:red"><b>'.$d4.'</b></span>';
                }
                if ($d5 >=2){
                    $g++;
                    $d5 = '<span style="font-size:30px;color:red"><b>'.$d5.'</b></span>';
                }
                if ($d6 >=2){
                    $g++;
                    $d6 = '<span style="font-size:30px;color:red"><b>'.$d6.'</b></span>';
                }
                if ($d7 >=2){
                    $g++;
                    $d7 = '<span style="font-size:30px;color:red"><b>'.$d7.'</b></span>';
                }
                if ($d8 >=2){
                    $g++;
                    $d8 = '<span style="font-size:30px;color:red"><b>'.$d8.'</b></span>';
                }
                $oTopik->d1 = $d1;
                $oTopik->d2 = $d2;
                $oTopik->d3 = $d3;
                $oTopik->d4 = $d4;
                $oTopik->d5 = $d5;
                $oTopik->d6 = $d6;
                $oTopik->d7 = $d7;
                $oTopik->d8 = $d8;
                $oTopik->g = $g;
                $penilaianJuri[] = $oTopik;
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.detailMasuk1',
                    [
                        "tahapan"=>$tahapan,
                        "proposal"=>$proposal,
                        "penilaianJuri"=>$penilaianJuri,
                        "kunciTeknologiLevel1"=>$kunciTeknologiLevel1,
                        "kunciTeknologiLevel2"=>$kunciTeknologiLevel2,
                        "kunciAplikasiLevel1"=>$kunciAplikasiLevel1,
                        "kunciAplikasiLevel2"=>$kunciAplikasiLevel2,
                        "kunciKolaborasiLevel1"=>$kunciKolaborasiLevel1,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.proposals.detailMasuk1',
                    [
                        "tahapan"=>$tahapan,
                        "proposal"=>$proposal,
                        "penilaianJuri"=>$penilaianJuri,
                        "kunciTeknologiLevel1"=>$kunciTeknologiLevel1,
                        "kunciTeknologiLevel2"=>$kunciTeknologiLevel2,
                        "kunciAplikasiLevel1"=>$kunciAplikasiLevel1,
                        "kunciAplikasiLevel2"=>$kunciAplikasiLevel2,
                        "kunciKolaborasiLevel1"=>$kunciKolaborasiLevel1,
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

    public function revisi(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',4);
            $TRP = DictionaryKategori::where('kode','TRP')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "TRP"=>$TRP
            );
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.revisi', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel,
                    'labels'=>$labels
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.revisi', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel,
                    'labels'=>$labels
                ]);
            }
        }
    }

    public function sudahreview(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',5);
            $TSR = DictionaryKategori::where('kode','TSR')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "TSR"=>$TSR
            );
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.sudahreview', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel,
                    'labels'=>$labels
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.sudahreview', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel,
                    'labels'=>$labels
                ]);
            }
        }
    }

    public function belumreview(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',3);
            $TBR = DictionaryKategori::where('kode','TBR')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "TBR"=>$TBR
            );
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.belumreview', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel,
                    'labels'=>$labels
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.belumreview', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel,
                    'labels'=>$labels
                ]);
            }
        }
    }

    public function seleksi(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',6);
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.seleksi', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.seleksi', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function disimpan(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',7);
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.disimpan', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.disimpan', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function diterima(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',8);
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.diterima', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.diterima', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function ditolak(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',9);
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.ditolak', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.ditolak', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }
    /*
     * end new method
     */

    /*
     * Admin Proses
     */
    public function sudahreviewProposal(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',5);
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.sudahreviewProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.sudahreviewProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function seleksiProposal(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',6);
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.seleksiProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.seleksiProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function disimpanProposal(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',7);
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.disimpanProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.disimpanProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function diterimaProposal(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',8);
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.diterimaProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.diterimaProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function totalDiterimaProposal(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',8);
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.totalDiterimaProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.totalDiterimaProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function ditolakProposal(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('status',9);
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.ditolakProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.proposals.ditolakProposal', [
                    "proposal"=>$proposal->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function saveJuri(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::find($json->id_proposal);
            $status = "success";
            $juriexist = array();
            switch($json->kategori){
                case "1":
                    $kataKunci = KataKunciTeknologi::find($json->kata_kunci);
                    foreach ($kataKunci->user as $item){
                        $found = false;
                        $num = count($proposal->juri);
                        $juri = "";
                        for($i=0;$i<$num&&!$found;$i++){
                            if ($proposal->juri[$i]->id == $item->id){
                                $found = true;
                                $juri = $item->fullname;
                            }
                        }
                        if (!$found){
                            $proposal->juri()->attach($item->id,['id_kata_kunci_teknologi'=>$json->kata_kunci]);
                        }else{
                            array_push($juriexist,$juri);
                        }
                    }
                    break;
                case "2":
                    $proposal = Proposal::find($json->id_proposal);
                    $found = false;
                    $num = count($proposal->juri);
                    $juri = "";
                    for($i=0;$i<$num&&!$found;$i++){
                        if ($proposal->juri[$i]->id == $json->juri){
                            $found = true;
                            $juri = $proposal->juri[$i]->fullname;
                        }
                    }
                    if (!$found){
                        $proposal->juri()->attach($json->juri,['id_kata_kunci_teknologi'=>0]);
                    }else{
                        array_push($juriexist,$juri);
                    }
                    break;
            }
            Proposal::where('id',$json->id_proposal)->update(['status'=>6]);
            $proposal = Proposal::where('id',$json->id_proposal)->get();
            if (count($juriexist) > 0){
                $status = "exist";
                $result = array(
                    "sender" => "bic",
                    "status" => $status,
                    "exist"=>$juriexist,
                    "juri"=>$proposal[0]->juri
                );
            }else{
                $result = array(
                    "sender" => "bic",
                    "status" => $status,
                    "juri"=>$proposal[0]->juri
                );
            }
            return response()->json($result);
        }
    }

    public function deleteJuri(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::find($json->id_proposal);
            $proposal->juri()->detach($json->juri);
            $result = array(
                "sender" => "bic",
                "status" => "success",
                "juri"=>$proposal->juri
            );
            return response()->json($result);
        }
    }

    public function pilihjuri($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$id)->get();
            $kataKunci = KataKunciTeknologi::where('parent',0)
                                    ->where('type',1)->get();
            $users = User::all();
            if (count($proposal[0]->kataKunciTeknologi) > 0){
                $kunciTeknologiLevel1 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciTeknologi[0]->pivot->id_level_1)->get();
                $kunciTeknologiLevel2 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciTeknologi[0]->pivot->id_level_2)->get();
            }else{
                $kunciTeknologiLevel1 = array();
                $kunciTeknologiLevel2 = array();
            }
            if (count($proposal[0]->kataKunciAplikasi)){
                $kunciAplikasiLevel1 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciAplikasi[0]->pivot->id_level_1)->get();
                $kunciAplikasiLevel2 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciAplikasi[0]->pivot->id_level_2)->get();
            }else{
                $kunciAplikasiLevel1 = array();
                $kunciAplikasiLevel2 = array();
            }
            if (count($proposal[0]->kataKunciKolaborasi) > 0){
                $kunciKolaborasiLevel1 = KataKunciTeknologi::where('id',$proposal[0]->kataKunciKolaborasi[0]->pivot->id_level_1)->get();
            }else{
                $kunciKolaborasiLevel1 = array();
            }
            if($proposal[0]->instansi <> null){
                $usaha = explode(',',$proposal[0]->instansi->bidang_usaha);
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
                    if ($proposal[0]->instansi->id_employee == $allemployee[$i]->id){
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
            foreach($proposal[0]->inovasiMember as $item){
                $rsc = RSC::where('id',$item->pivot->id_rsc)->get();
                $member = new \stdClass();
                $member->name = $item->pivot->name;
                $member->jabatan = $rsc[0]->rsc;
                $inovasiMember[$index] = $member;
                $index++;
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.proposals.pilihjuri',
                    [
                        "proposal"=>$proposal,
                        "kunciTeknologiLevel1"=>$kunciTeknologiLevel1,
                        "kunciTeknologiLevel2"=>$kunciTeknologiLevel2,
                        "kunciAplikasiLevel1"=>$kunciAplikasiLevel1,
                        "kunciAplikasiLevel2"=>$kunciAplikasiLevel2,
                        "kunciKolaborasiLevel1"=>$kunciKolaborasiLevel1,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        "users"=>$users,
                        "kataKunci"=>$kataKunci,
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.proposals.pilihjuri',
                    [
                        "proposal"=>$proposal,
                        "kunciTeknologiLevel1"=>$kunciTeknologiLevel1,
                        "kunciTeknologiLevel2"=>$kunciTeknologiLevel2,
                        "kunciAplikasiLevel1"=>$kunciAplikasiLevel1,
                        "kunciAplikasiLevel2"=>$kunciAplikasiLevel2,
                        "kunciKolaborasiLevel1"=>$kunciKolaborasiLevel1,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        "users"=>$users,
                        "kataKunci"=>$kataKunci,
                        'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }
        }
    }

    public function ubahBatalToNew(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::where('id',$json->id)
                            ->update(["status"=>1]);

            $result = array(
                "sender" => "bic",
                "status" => "success"
            );
            return response()->json($result);
        }
    }

    public function findProposalMemberInstitusi(Request $request){
        $term = $request->term;
        $data = InovatorMember::where('institusi','LIKE','%'.$term.'%')->get();
        $result = array();
        foreach ($data as $key=>$value){
            $result[] = ['value'=>$value->institusi];
        }
        return response()->json($result);
    }

    public function download($id){
        $file = ProposalFile::where('id',$id)->get()[0];
        return response()->download(public_path().$file->public_path,$file->file);
    }

    public function cari(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        $this->kategorilabel = "proposal";
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposalStatus = StatusProposal::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.admin.find', [
                    "proposalStatus"=>$proposalStatus,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.admin.find', [
                    "proposalStatus"=>$proposalStatus,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }
}