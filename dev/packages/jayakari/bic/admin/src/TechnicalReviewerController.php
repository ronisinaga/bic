<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 5/16/2018
 * Time: 8:23 AM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use jayakari\bic\admin\Models\Employee;
use jayakari\bic\admin\Models\Instansi;
use jayakari\bic\admin\Models\KataKunciTeknologi;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\ProposalMasukanTeknis;
use jayakari\bic\admin\Models\ProposalMessage;
use jayakari\bic\admin\Models\ProposalReview;
use jayakari\bic\admin\Models\RSC;
use jayakari\bic\admin\Models\User;

class TechnicalReviewerController extends Controller
{

    private $kategorilabel = 'pendapat teknis';

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function belumrespon(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $message = ProposalMessage::where(['sender'=>'AdminProses','receiver'=>'TechnicalReviewer','id_receiver'=>$user->get()[0]->id])->get();
            $technicalreviewer = array();
            foreach ($message as $item){
                $reviewer = ProposalMasukanTeknis::where(['id_proposal'=>$item->id_proposal,'id_juri'=>$item->id_receiver])->get();
                if (count($reviewer) == 0){
                    $tr = new \stdClass();
                    $tr->id_proposal = $item->id_proposal;
                    $tr->proposal = $item->proposal->judul;
                    $tr->id_juri = $item->id_receiver;
                    $tr->juri = $user->get()[0]->fullname;
                    $tr->pertanyaan = $item->isi;
                    $technicalreviewer[] = $tr;
                }
            }

            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.technicalreviewer.belumrespon', [
                    "technicalreviewer" => $technicalreviewer,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.technicalreviewer.belumrespon', [
                    "technicalreviewer" => $technicalreviewer,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function sudahrespon(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $message = ProposalMessage::where(['sender'=>'AdminProses','receiver'=>'TechnicalReviewer','id_receiver'=>$user->get()[0]->id])->get();
            $technicalreviewer = array();
            foreach ($message as $item){
                $reviewer = ProposalMasukanTeknis::where(['id_proposal'=>$item->id_proposal,'id_juri'=>$item->id_receiver])->get();
                if (count($reviewer) > 0){
                    $tr = new \stdClass();
                    $tr->id_proposal = $item->id_proposal;
                    $tr->proposal = $item->proposal->judul;
                    $tr->id_juri = $item->id_receiver;
                    $tr->juri = $user->get()[0]->fullname;
                    $tr->pertanyaan = $item->isi;
                    $tr->jawaban = $reviewer[0]->masukan;
                    $technicalreviewer[] = $tr;
                }
            }

            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.technicalreviewer.sudahrespon', [
                    "technicalreviewer" => $technicalreviewer,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.technicalreviewer.sudahrespon', [
                    "technicalreviewer" => $technicalreviewer,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function jawaban($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$id)->get();
            $proposalReview = ProposalReview::where('id_proposal',$id)
                ->where('is_sent',0)->get();

            if(count($proposal[0]->instansi) > 0){
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
                return view('jayakari.bic.admin::pages.technicalreviewer.jawaban',
                    [
                        "proposal"=>$proposal,
                        "review"=>$proposalReview,
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
                return view('jayakari.bic.admin::pages.technicalreviewer.jawaban',
                    [
                        "proposal"=>$proposal,
                        "review"=>$proposalReview,
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

    public function saveJawaban(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::where('id',$json->id_proposal);
            $message = ProposalMessage::where(['sender'=>'AdminProses','receiver'=>'TechnicalReviewer','id_proposal'=>$json->id_proposal,'id_receiver'=>$user->get()[0]->id])->get()[0];
            $proposalReview = new ProposalReview();
            $proposalReview->judul = "[BIC]Jawaban Pertanyaan - ".$message->isi;
            $proposalReview->isi = $json->jawaban;
            $proposalReview->is_sent = 1;
            $proposalReview->inserted_by = $user->get()[0]->id;
            $proposalReview->updated_by = $user->get()[0]->id;
            $proposal->get()[0]->review()->save($proposalReview);

            //$email = new EmailController();
            $proposalMessage = new ProposalMessage();
            $proposalMessage->judul = "[BIC]Jawaban Pertanyaan - ".$message->isi;
            $proposalMessage->isi = $proposalReview->isi;
            $proposalMessage->id_sender = $user->get()[0]->id;
            $proposalMessage->id_receiver = 0;
            $proposalMessage->sender = "TechnicalReviewer";
            $proposalMessage->receiver = "AdminProses";
            $proposalMessage->status = 0;
            $proposalMessage->inserted_by = $user->get()[0]->id;
            $proposalMessage->updated_by = $user->get()[0]->id;
            $proposal->get()[0]->message()->save($proposalMessage);
            //$email->sendTechnicalReviewAnswer($user->get()[0],$proposal->get()[0],$proposalMessage);

            //save to proposal masukan teknis
            /*$masukanTeknis = new ProposalMasukanTeknis();
            $masukanTeknis->id_juri = $user->get()[0]->id;
            $masukanTeknis->masukan = $json->jawaban;
            $masukanTeknis->inserted_by = $user->get()[0]->id;
            $masukanTeknis->updated_by = $user->get()[0]->id;
            $proposal->get()[0]->masukanTeknis()->save($masukanTeknis);*/
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

}