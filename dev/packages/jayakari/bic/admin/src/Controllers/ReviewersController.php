<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/6/2018
 * Time: 6:10 PM
 */

namespace jayakari\bic\admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use jayakari\bic\admin\Models\Employee;
use jayakari\bic\admin\Models\Instansi;
use jayakari\bic\admin\Models\KataKunciTeknologi;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\ProposalMessage;
use jayakari\bic\admin\Models\ProposalReview;
use jayakari\bic\admin\Models\RSC;
use jayakari\bic\admin\Models\StatusProposal;
use jayakari\bic\admin\Models\User;


class ReviewersController extends Controller
{

    private $kategorilabel = 'proposal';

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function sendEmail($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$id)->get();
            $proposalReview = ProposalReview::where('id_proposal',$id)
                ->where('is_sent',0)->get();
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
                return view('jayakari.bic.admin::pages.reviewers.sendEmail',
                    [
                        "proposal"=>$proposal,
                        "review"=>$proposalReview,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.reviewers.sendEmail',
                    [
                        "proposal"=>$proposal,
                        "review"=>$proposalReview,
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

    public function saveEmail(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::where('id',$json->id_proposal);
            $proposalReview = new ProposalReview();
            $proposalReview->judul = "[BIC]Reminder Revisi - ".$proposal->get()[0]->judul;
            $proposalReview->isi = $json->isi;
            $proposalReview->is_sent = 1;
            $proposalReview->inserted_by = $user->get()[0]->id;
            $proposalReview->updated_by = $user->get()[0]->id;
            $proposal->get()[0]->review()->save($proposalReview);

            $email = new EmailController();
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
            $email->sendRemindRevisi($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function sendNewEmail($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$id)->get();
            $proposalReview = ProposalReview::where('id_proposal',$id)
                ->where('is_sent',0)->get();
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
            $statusProposal = StatusProposal::whereNotIn('status',["BATAL","REVISI","REVIEW","SELEKSI","DISIMPAN","DITERIMA","IN REVIEW"])->get();
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
                return view('jayakari.bic.admin::pages.reviewers.sendNewEmail',
                    [
                        "proposal"=>$proposal,
                        "statusProposal"=>$statusProposal,
                        "review"=>$proposalReview,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.reviewers.sendNewEmail',
                    [
                        "proposal"=>$proposal,
                        "review"=>$proposalReview,
                        "statusProposal"=>$statusProposal,
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

    public function saveNewEmail(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::where('id',$json->id_proposal);

            //update proposal status
            $proposal->update(["status"=>$json->status]);

            $proposalReview = new ProposalReview();
            $proposalReview->judul = "[BIC]Reminder Melengkapi Proposal - ".$proposal->get()[0]->judul;
            $proposalReview->isi = $json->isi;
            $proposalReview->is_sent = 1;
            $proposalReview->inserted_by = $user->get()[0]->id;
            $proposalReview->updated_by = $user->get()[0]->id;
            $proposal->get()[0]->review()->save($proposalReview);

            $email = new EmailController();
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
            switch ($json->status){
                case "1":
                    $email->sendRemindNew($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
                    break;
                case "9":
                    $email->sendDiscontinued($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
                    break;
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function sendDiscontinued($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$id)->get();
            $proposalReview = ProposalReview::where('id_proposal',$id)
                ->where('is_sent',0)->get();
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
                return view('jayakari.bic.admin::pages.reviewers.sendDiscontinued',
                    [
                        "proposal"=>$proposal,
                        "review"=>$proposalReview,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.reviewers.sendDiscontinued',
                    [
                        "proposal"=>$proposal,
                        "review"=>$proposalReview,
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

    public function saveDiscontinued(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::where('id',$json->id_proposal);
            $proposal->update(["status"=>9]);
            $proposalReview = new ProposalReview();
            $proposalReview->judul = "[BIC]Discontinued Proposal - ".$proposal->get()[0]->judul;
            $proposalReview->isi = $json->isi;
            $proposalReview->is_sent = 1;
            $proposalReview->inserted_by = $user->get()[0]->id;
            $proposalReview->updated_by = $user->get()[0]->id;
            $proposal->get()[0]->review()->save($proposalReview);

            $email = new EmailController();
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
            $email->sendDiscontinued($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
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
                return view('jayakari.bic.admin::pages.reviewers.cari', [
                    "proposalStatus"=>$proposalStatus,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.reviewers.cari', [
                    "proposalStatus"=>$proposalStatus,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }
}