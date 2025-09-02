<?php
/**
 * Created by PhpStorm.
 * User: Roni Sinaga
 * Date: 11/17/2017
 * Time: 2:56 AM
 */

namespace jayakari\bic\admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use jayakari\bic\admin\Models\Batch;
use jayakari\bic\admin\Models\DictionaryKategori;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\ProposalJuri;
use jayakari\bic\admin\Models\ProposalMasukanTeknis;
use jayakari\bic\admin\Models\ProposalMessage;
use jayakari\bic\admin\Models\Topik;
use jayakari\bic\admin\Models\TopikJuri;
use jayakari\bic\admin\Models\TopikProposal;
use jayakari\bic\admin\Models\User;

class HomeController extends Controller{

    private $kategorilabel = 'kategori pengguna';

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function index(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        $users = User::orderBy('id','desc')->count();
        $totalProposal = Proposal::orderBy('id','desc')->count();
        $batal = Proposal::where('status',2)
            ->orderBy('inserted_date','desc')->count();
        $ditolak = Proposal::where('status',9)->count();
        if (Cookie::has('active_category')){
            return view('jayakari.bic.admin::pages.home.index',[
                'datauser'=>$user->get(),
                "users"=>$users,
                "totalProposal"=>$totalProposal,
                "batal"=>$batal,
                "ditolak"=>$ditolak,
                'activeCategory'=>$request->cookie('active_category'),
                "kategorilabel"=>$this->kategorilabel
            ]);
        }else{
            return view('jayakari.bic.admin::pages.home.index',[
                'datauser'=>$user->get(),
                "users"=>$users,
                "totalProposal"=>$totalProposal,
                "batal"=>$batal,
                "ditolak"=>$ditolak,
                'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                "kategorilabel"=>$this->kategorilabel
            ]);
        }
    }

    public function inovator(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);

        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id_inovator',$user->get()[0]->id)
                ->orderBy('inserted_date','desc')->get();
            $message = ProposalMessage::where('id_receiver',$user->get()[0]->id)
                ->where('status',0)
                ->orderBy('inserted_date','desc')->get();
            $TWI = DictionaryKategori::where('kode','TWI')->get()[0]->dictionary[0]->isi;
            $PWI = DictionaryKategori::where('kode','PWI')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "TWI"=>$TWI,
                "PWI"=>$PWI
            );
            $this->kategorilabel = 'dashboard inovator';
            if (Cookie::has('active_category')) {
                return view('jayakari.bic.admin::pages.home.inovator', [
                    'proposal' => $proposal,
                    'message' => $message,
                    "labels"=>$labels,
                    'datauser' => $user->get(),
                    'activeCategory' => $request->cookie('active_category'),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            } else {
                return view('jayakari.bic.admin::pages.home.inovator', [
                    'proposal' => $proposal,
                    'message' => $message,
                    "labels"=>$labels,
                    'datauser' => $user->get(),
                    'activeCategory' => $user->get()[0]->userCategory[0]->id,
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }
        }
    }

    public function reviewer(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposalNum = Proposal::where('status','<>',1)
                            ->where('status','<>',2)->count();
            $proposal = Proposal::where('status','<>',1)
                ->where('status','<>',2)
                ->orderBy('inserted_date','desc')->take(5)->get();

            $baruNum = Proposal::where('status',1)->count();
            $baru = Proposal::where('status',1)
                ->orderBy('inserted_date','desc')->take(5)->get();

            $diterimaNum = Proposal::where('status',8)->count();
            $diterima = Proposal::where('status',8)
                ->orderBy('inserted_date','desc')->take(5)->get();

            $ditolakNum = Proposal::where('status',9)->count();
            $ditolak = Proposal::where('status',9)
                ->orderBy('inserted_date','desc')->take(5)->get();

            $belumdireviewNum = Proposal::where('status',3)->count();
            $belumdireview = Proposal::where('status',3)->take(5)->get();

            $revisiNum = Proposal::where('status',4)->count();
            $revisi = Proposal::where('status',4)
                ->orderBy('inserted_date','desc')->take(5)->get();

            $sudahreviewNum = Proposal::where('status',5)->count();
            $sudahreview = Proposal::where('status',5)
                ->orderBy('inserted_date','desc')->take(5)->get();

            $seleksiNum = Proposal::where('status',6)->count();
            $seleksi = Proposal::where('status',6)
                ->orderBy('inserted_date','desc')->take(5)->get();

            $simpanNum = Proposal::where('status',7)->count();
            $simpan = Proposal::where('status',7)
                ->orderBy('inserted_date','desc')->take(5)->get();

            $batalNum = Proposal::where('status',2)->count();
            $batal = Proposal::where('status',2)
                ->orderBy('inserted_date','desc')->take(5)->get();

            $messageNum = ProposalMessage::where([
                'receiver'=>'Reviewer',
                'status'=>0
            ])->count();
            $message = ProposalMessage::where('receiver','Reviewer')
                ->where('status',0)
                ->orderBy('inserted_date','desc')->take(5)->get();

            $this->kategorilabel = 'dashboard reviewer';
            if (Cookie::has('active_category')) {
                return view('jayakari.bic.admin::pages.home.reviewer',
                    [
                        'datauser' => $user->get(),
                        "proposal"=>$proposal,
                        "proposalNum"=>$proposalNum,
                        "baru"=>$baru,
                        "baruNum"=>$baruNum,
                        "masuk"=>$proposal,
                        "masukNum"=>$proposalNum,
                        "diterima"=>$diterima,
                        "diterimaNum"=>$diterimaNum,
                        "ditolak"=>$ditolak,
                        "ditolakNum"=>$ditolakNum,
                        "belumreview"=>$belumdireview,
                        "belumreviewNum"=>$belumdireviewNum,
                        "revisi"=>$revisi,
                        "revisiNum"=>$revisiNum,
                        "sudahreview"=>$sudahreview,
                        "sudahreviewNum"=>$sudahreviewNum,
                        "seleksi"=>$seleksi,
                        "seleksiNum"=>$seleksiNum,
                        "disimpan"=>$simpan,
                        "disimpanNum"=>$simpanNum,
                        "batal"=>$batal,
                        "batalNum"=>$batalNum,
                        "message"=>$message,
                        "messageNum"=>$messageNum,
                        'activeCategory' => $request->cookie('active_category'),
                        "kategorilabel"=>$this->kategorilabel
                    ]
                );
            } else {
                return view('jayakari.bic.admin::pages.home.reviewer',
                    [
                        'datauser' => $user->get(),
                        "proposal"=>$proposal,
                        "proposalNum"=>$proposalNum,
                        "baru"=>$baru,
                        "baruNum"=>$baruNum,
                        "masuk"=>$proposal,
                        "masukNum"=>$proposalNum,
                        "diterima"=>$diterima,
                        "diterimaNum"=>$diterimaNum,
                        "ditolak"=>$ditolak,
                        "ditolakNum"=>$ditolakNum,
                        "belumreview"=>$belumdireview,
                        "belumreviewNum"=>$belumdireviewNum,
                        "revisi"=>$revisi,
                        "revisiNum"=>$revisiNum,
                        "sudahreview"=>$sudahreview,
                        "sudahreviewNum"=>$sudahreviewNum,
                        "seleksi"=>$seleksi,
                        "seleksiNum"=>$seleksiNum,
                        "disimpan"=>$simpan,
                        "disimpanNum"=>$simpanNum,
                        "batal"=>$batal,
                        "batalNum"=>$batalNum,
                        "message"=>$message,
                        "messageNum"=>$messageNum,
                        'activeCategory' => $user->get()[0]->userCategory[0]->id,
                        "kategorilabel"=>$this->kategorilabel
                    ]
                );
            }
        }
    }

    public function proposal(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $pemenangTahunLalu = array();
            $batch = Batch::where('is_finished',1)->get();
            $lastbatch = $batch[count($batch)-1];
            foreach($lastbatch->topik as $item){
                foreach($item->topikProposal as $rows){
                    if ($rows->proposal->status == 8){
                        $pemenangTahunLalu[] = $rows->proposal;
                    }
                }
            }
            $diterima = Proposal::where('status',8)
                ->orderBy('inserted_date','desc')->take(5)->get();
            $diterimaNum = Proposal::where('status',8)->count();

            $ditolak = Proposal::where('status',9)
                ->orderBy('inserted_date','desc')->take(5)->get();
            $ditolakNum = Proposal::where('status',9)->count();

            $sudahreview = Proposal::where('status',5)
                ->orderBy('inserted_date','desc')->take(5)->get();
            $sudahreviewNum = Proposal::where('status',5)->count();

            $seleksi = Proposal::where('status',6)
                ->orderBy('inserted_date','desc')->take(5)->get();
            $seleksiNum = Proposal::where('status',6)->count();

            $simpan = Proposal::where('status',7)
                ->orderBy('inserted_date','desc')->take(5)->get();
            $simpanNum = Proposal::where('status',7)->count();

            $message = ProposalMessage::where([
                    'receiver'=>'AdminProses',
                    'status'=>0
                ])->orderBy('inserted_date','desc')->take(5)->get();

            $messageNum = ProposalMessage::where([
                    'receiver'=>'AdminProses',
                    'status'=>0
                ])->count();
            $this->kategorilabel = 'dashboard admin proses';
            if (Cookie::has('active_category')) {
                return view('jayakari.bic.admin::pages.home.proposal',
                    [
                        "pemenangTahunLalu"=>$pemenangTahunLalu,
                        'datauser' => $user->get(),
                        "diterima"=>$diterima,
                        "diterimaNum"=>$diterimaNum,
                        "ditolak"=>$ditolak,
                        "ditolakNum"=>$ditolakNum,
                        "sudahreview"=>$sudahreview,
                        "sudahreviewNum"=>$sudahreviewNum,
                        "seleksi"=>$seleksi,
                        "seleksiNum"=>$seleksiNum,
                        "disimpan"=>$simpan,
                        "disimpanNum"=>$simpanNum,
                        "message"=>$message,
                        "messagNum"=>$messageNum,
                        'activeCategory' => $request->cookie('active_category'),
                        "kategorilabel"=>$this->kategorilabel
                    ]
                );
            } else {
                return view('jayakari.bic.admin::pages.home.proposal',
                    [
                        "pemenangTahunLalu"=>$pemenangTahunLalu,
                        'datauser' => $user->get(),
                        "diterima"=>$diterima,
                        "diterimaNum"=>$diterimaNum,
                        "ditolak"=>$ditolak,
                        "ditolakNum"=>$ditolakNum,
                        "sudahreview"=>$sudahreview,
                        "sudahreviewNum"=>$sudahreviewNum,
                        "seleksi"=>$seleksi,
                        "seleksiNum"=>$seleksiNum,
                        "disimpan"=>$simpan,
                        "disimpanNum"=>$simpanNum,
                        "message"=>$message,
                        "messagNum"=>$messageNum,
                        'activeCategory' => $user->get()[0]->userCategory[0]->id,
                        "kategorilabel"=>$this->kategorilabel
                    ]
                );
            }
        }
    }

    public function juri(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',0)
                ->orWhere('is_finished',2)->get();
            $juriProposal = array();
            //$topikProposal = array();
            foreach($batch as $outer){
                foreach($outer->topik as $item){
                    $topikProposal = TopikProposal::where('id_topik',$item->id)->get();
                    if (count($topikProposal) > 0){
                        foreach($topikProposal as $data){
                            $inner = new \stdClass();
                            $topikJuri = TopikJuri::where('id_topik',$item->id)->get();
                            $sudahnilai = 0;
                            $belumnilai = 0;
                            $inner->topik = $item->topik;
                            $inner->proposal = $data->proposal->judul;
                            $inner->jumlah_juri = count($topikJuri);
                            $idx=0;
                            foreach($topikJuri as $index){
                                $proposalJuri = ProposalJuri::where('id_topik',$index->id_topik)
                                    ->where('id_proposal',$data->id_proposal)
                                    ->where('id_juri',$index->id_juri)->get();
                                if (count($proposalJuri) == 0){
                                    $belumnilai++;
                                }else{
                                    $sudahnilai++;
                                }
                            }
                            $inner->belum_nilai = $belumnilai;
                            $inner->sudah_nilai = $sudahnilai;
                            array_push($juriProposal,$inner);
                        }
                    }

                }
            }

            $belumnilai = 0;
            $proposalBelumNilai = array();
            $sudahnilai = 0;
            $proposalSudahNilai = array();
            foreach ($batch as $item){
                foreach ($item->topik as $data){
                    /*$topikProposal = TopikProposal::where('id_topik',$data->id)->get();
                    foreach ($topikProposal as $index){
                        $proposalJuri = ProposalJuri::where('id_topik',$index->id_topik)
                                        ->where('id_proposal',$index->id_proposal)
                                        ->where('id_juri',$user->get()[0]->id)->get();
                        if (count($proposalJuri) > 0){
                            $sudahnilai++;
                            array_push($proposalSudahNilai,$proposalJuri[0]);
                        }else{
                            $belumnilai++;
                            array_push($proposalBelumNilai,$index);
                        }
                    }*/
                    $topikJuri = TopikJuri::where(['id_topik'=>$data->id,'id_juri'=>$user->get()[0]->id])->get();
                    foreach ($topikJuri as $index){
                        $topikProposal = TopikProposal::where('id_topik',$index->id_topik)->get();
                        foreach ($topikProposal as $inner){
                            $proposalJuri = ProposalJuri::where('id_topik',$index->id_topik)
                                ->where('id_proposal',$inner->id_proposal)
                                ->where('id_juri',$index->id_juri)->get();
                            if (count($proposalJuri) > 0){
                                $sudahnilai++;
                                array_push($proposalSudahNilai,$proposalJuri[0]);
                            }else{
                                $belumnilai++;
                                array_push($proposalBelumNilai,$inner);
                            }
                        }
                    }
                }
            }

            //pendapat teknis
            $masukanTeknisBelumNilai = ProposalMasukanTeknis::where('id_juri',$user->get()[0]->id)
                                    ->where('masukan',null)->get();
            $this->kategorilabel = 'dashboard juri';

            //find topik where juri exist
            $mytopic = array();
            $alltopics = array();
            if (count($batch) > 0){
                $topics = Topik::where('id_batch',$batch[0]->id)->orderBy('topik','asc')->get();
                foreach($topics as $topic){
                    $jmlProposalPerTopik = count(TopikProposal::where('id_topik',$topic->id)->get());
                    $topicjuris = TopikJuri::where('id_topik',$topic->id)->get();
                    $index = 1;
                    $isMy = false;
                    $num = count($topicjuris);
                    for ($i=0;($i<$num && !$isMy);$i++){
                        if ($topicjuris[$i]->id_juri == $userid){
                            $isMy = true;
                        }
                    }
                    foreach ($topicjuris as $topicjuri){
                        $done = count(ProposalJuri::where(['id_topik'=>$topicjuri->id_topik,'id_juri'=>$topicjuri->id_juri])->get());
                        $innerTopic = new \stdClass();
                        if ($isMy){
                            if ($userid == $topicjuri->id_juri){
                                $innerTopic->juri = '<label style="color:red"><b>'.$topic->topik."-".$index.'</b></label>';
                                $innerTopic->topic = '<label style="color:red"><b>'.$topic->topik.'</b></label>';
                                $innerTopic->total = '<label style="color:red"><b>'.$jmlProposalPerTopik.'</b></label>';
                                $innerTopic->done = '<label style="color:red"><b>'.$done.'</b></label>';
                                $notyet = $jmlProposalPerTopik - $done;
                                $innerTopic->notyet = '<label style="color:red"><b>'.$notyet.'</b></label>';
                            }else{
                                $innerTopic->juri = '<label style="color:black">'.$topic->topik."-".$index.'</label>';
                                $innerTopic->topic = '<label style="color:black">'.$topic->topik.'</label>';
                                $innerTopic->total = '<label style="color:black">'.$jmlProposalPerTopik.'</label>';
                                $innerTopic->done = '<label style="color:black">'.$done.'</label>';
                                $notyet = $jmlProposalPerTopik - $done;
                                $innerTopic->notyet = '<label style="color:black">'.$notyet.'</label>';
                            }
                            $alltopics[] = $innerTopic;
                            $mytopic[] = $innerTopic;
                        }else{
                            $innerTopic->juri = '<label style="color:black">'.$topic->topik."-".$index.'</label>';
                            $innerTopic->topic = '<label style="color:black">'.$topic->topik.'</label>';
                            $innerTopic->total = '<label style="color:black">'.$jmlProposalPerTopik.'</label>';
                            $innerTopic->done = '<label style="color:black">'.$done.'</label>';
                            $notyet = $jmlProposalPerTopik - $done;
                            $innerTopic->notyet = '<label style="color:black">'.$notyet.'</label>';
                            $alltopics[] = $innerTopic;
                        }
                        $index++;
                    }
                }
            }
            if (Cookie::has('active_category')) {
                return view('jayakari.bic.admin::pages.home.juri',
                    [
                        "batch"=>$batch,
                        'datauser' => $user->get(),
                        "belumnilai"=>$belumnilai,
                        "proposalBelumNilai"=>$proposalBelumNilai,
                        "sudahnilai"=>$sudahnilai,
                        "proposalSudahNilai"=>$proposalSudahNilai,
                        "juriProposal"=>$juriProposal,
                        "masukanTeknis"=>$masukanTeknisBelumNilai,
                        'activeCategory' => $request->cookie('active_category'),
                        "kategorilabel"=>$this->kategorilabel,
                        "alltopics"=>$alltopics,
                        "mytopic"=>$mytopic
                    ]
                );
            } else {
                return view('jayakari.bic.admin::pages.home.juri',
                    [
                        "batch"=>$batch,
                        'datauser' => $user->get(),
                        "belumnilai"=>$belumnilai,
                        "proposalBelumNilai"=>$proposalBelumNilai,
                        "sudahnilai"=>$sudahnilai,
                        "juriProposal"=>$juriProposal,
                        "proposalSudahNilai"=>$proposalSudahNilai,
                        "masukanTeknis"=>$masukanTeknisBelumNilai,
                        'activeCategory' => $user->get()[0]->userCategory[0]->id,
                        "kategorilabel"=>$this->kategorilabel,
                        "alltopics"=>$alltopics,
                        "mytopic"=>$mytopic
                    ]
                );
            }
        }
    }

    public function technical(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $message = ProposalMessage::where(['sender'=>'AdminProses','receiver'=>'TechnicalReviewer','id_receiver'=>$user->get()[0]->id])->get();
            $belumdirespon = array();
            $sudahdirespon = array();
            foreach($message as $item){
                $masukanteknis = ProposalMasukanTeknis::where('id_proposal',$item->id_proposal)->get();
                $technicalReviewer = new \stdClass();
                if (count($masukanteknis) > 0){
                    $technicalReviewer->id_proposal = $masukanteknis[0]->id_proposal;
                    $technicalReviewer->proposal = $masukanteknis[0]->proposal->judul;
                    $technicalReviewer->id_reviewer = $masukanteknis[0]->id_juri;
                    $technicalReviewer->reviewer = $masukanteknis[0]->juri->fullname;
                    $technicalReviewer->pertanyaan = $item->isi;
                    $technicalReviewer->jawaban = $masukanteknis[0]->masukan;
                    $sudahdirespon[] = $technicalReviewer;
                }else{
                    $technicalReviewer->id_proposal = $item->id_proposal;
                    $technicalReviewer->proposal = $item->proposal->judul;
                    $technicalReviewer->id_reviewer = $user->get()[0]->id;
                    $technicalReviewer->reviewer = $user->get()[0]->fullname;
                    $technicalReviewer->pertanyaan = $item->isi;
                    $technicalReviewer->jawaban = '';
                    $belumdirespon[] = $technicalReviewer;
                }
            }
            $this->kategorilabel = 'dashboard';
            if (Cookie::has('active_category')) {
                return view('jayakari.bic.admin::pages.home.technical', [
                    'belumdirespon' => $belumdirespon,
                    "sudahdirespon"=>$sudahdirespon,
                    'datauser' => $user->get(),
                    'activeCategory' => $request->cookie('active_category'),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            } else {
                return view('jayakari.bic.admin::pages.home.technical', [
                    'belumdirespon' => $belumdirespon,
                    "sudahdirespon"=>$sudahdirespon,
                    'datauser' => $user->get(),
                    'activeCategory' => $user->get()[0]->userCategory[0]->id,
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }
        }
    }

    public function administrasi(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $this->kategorilabel = 'dashboard';
            if (Cookie::has('active_category')) {
                return view('jayakari.bic.admin::pages.home.administrasi', [
                    'datauser' => $user->get(),
                    'activeCategory' => $request->cookie('active_category'),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            } else {
                return view('jayakari.bic.admin::pages.home.administrasi', [
                    'datauser' => $user->get(),
                    'activeCategory' => $user->get()[0]->userCategory[0]->id,
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }
        }
    }

    public function designer(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $this->kategorilabel = 'dashboard';
            if (Cookie::has('active_category')) {
                return view('jayakari.bic.admin::pages.home.designer', [
                    'datauser' => $user->get(),
                    'activeCategory' => $request->cookie('active_category'),
                    "kategorilabel"=>$this->kategorilabel
                ]);
            } else {
                return view('jayakari.bic.admin::pages.home.designer', [
                    'datauser' => $user->get(),
                    'activeCategory' => $user->get()[0]->userCategory[0]->id,
                    "kategorilabel"=>$this->kategorilabel
                ]);
            }
        }
    }
}