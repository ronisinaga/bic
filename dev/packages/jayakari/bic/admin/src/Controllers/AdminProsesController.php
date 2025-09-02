<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 2/20/2018
 * Time: 3:54 PM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use jayakari\bic\admin\Models\Batch;
use jayakari\bic\admin\Models\Employee;
use jayakari\bic\admin\Models\Instansi;
use jayakari\bic\admin\Models\KataKunciTeknologi;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\ProposalJuri;
use jayakari\bic\admin\Models\ProposalMasukanTeknis;
use jayakari\bic\admin\Models\ProposalMessage;
use jayakari\bic\admin\Models\ProposalReview;
use jayakari\bic\admin\Models\RSC;
use jayakari\bic\admin\Models\StatusProposal;
use jayakari\bic\admin\Models\Topik;
use jayakari\bic\admin\Models\TopikJuri;
use jayakari\bic\admin\Models\TopikProposal;
use jayakari\bic\admin\Models\User;
use jayakari\bic\admin\Models\UserCategory;

class AdminProsesController extends Controller
{
    private $kategorilabel = 'penjurian';

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function masukanTeknis($id,$juriid){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$id)->get()[0];
            $kategori = UserCategory::where('id',6)->get()[0];
            $juri =  array();
            foreach($kategori->user as $item){
                $juri[] = $item;
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.masukanTeknis', [
                    "juri"=>$juri,
                    "proposal"=>$proposal,
                    "expert"=>$juriid,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.masukanTeknis', [
                    "juri"=>$juri,
                    "proposal"=>$proposal,
                    "expert"=>$juriid,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function saveMasukanTeknis(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            //save to proposal message
            $technicalreviewer = User::where('id',$json->id_juri)->get()[0];
            $proposal = Proposal::where('id',$json->id_proposal);
            $proposalReview = new ProposalReview();
            $proposalReview->judul = "[BIC] Mohon Masukan Teknis - ".$proposal->get()[0]->judul;
            $proposalReview->isi = $json->isi;
            $proposalReview->is_sent = 1;
            $proposalReview->inserted_by = $user->get()[0]->id;
            $proposalReview->updated_by = $user->get()[0]->id;
            $proposal->get()[0]->review()->save($proposalReview);

            ProposalMessage::where([
                'sender'=>'AdminProses',
                'receiver'=>'TechnicalReviewer',
                'id_receiver'=>$json->id_juri_old,
                'id_proposal'=>$json->id_proposal
            ])->delete();

            //hapus di ProposakMasukanTeknis
            ProposalMasukanTeknis::where([
                'id_proposal'=>$json->id_proposal,
                'id_juri'=>$json->id_juri_old
            ])->delete();

            $proposalMessage = new ProposalMessage();
            $proposalMessage->judul = '[BIC] Mohon Masukan Teknis '.$proposal->get()[0]->judul;
            $proposalMessage->isi = $json->isi;
            $proposalMessage->id_sender = 0;
            $proposalMessage->id_receiver = $json->id_juri;
            $proposalMessage->sender = "AdminProses";
            $proposalMessage->receiver = "TechnicalReviewer";
            $proposalMessage->status = 1;
            $proposalMessage->inserted_by = $user->get()[0]->id;
            $proposalMessage->updated_by = $user->get()[0]->id;
            $proposal->get()[0]->message()->save($proposalMessage);
            $email = new EmailController();
            $email->sendTechnicalReviewer($technicalreviewer,$proposal->get()[0],$proposalMessage);
            //save to proposal masukan teknis
            /*$masukanTeknis = new ProposalMasukanTeknis();
            $masukanTeknis->id_proposal = $json->id_proposal;
            $masukanTeknis->id_juri = $json->id_juri;
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

    public function sent(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $message = ProposalMessage::where('sender','AdminProses')
                        ->orderBy('inserted_date','desc')->get();
            $this->kategorilabel = 'message';
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.sent', [
                    "message"=>$message,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.sent', [
                    "message"=>$message,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function content($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $message = ProposalMessage::where('id',$id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.content', [
                    "proposalMessage"=>$message,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.content', [
                    "proposalMessage"=>$message,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function juri(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $juri = TopikJuri::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.juri', [
                    "juri"=>$juri,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.juri', [
                    "juri"=>$juri,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function juriCreate(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',0)->get();
            //$juri = User::where('id_user_kategori',5)->get();
            $alljuri = User::all();
            $juri = array();
            foreach($alljuri as $item){
                if (count($item->userCategory) > 0){
                    foreach ($item->userCategory as $data){
                        if ($data->id ==5){
                            $selectedUser = new User();
                            $selectedUser->id = $item->id;
                            $selectedUser->fullname = $item->fullname;
                            //$juri[] = $item;
                            $juri[] = $selectedUser;
                        }
                    }
                }
                /*if ($item->userCategory[0]->id_user_category == 5){

                }*/
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.juriCreate', [
                    "batch"=>$batch,
                    "juri"=>$juri,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.juriCreate', [
                    "batch"=>$batch,
                    "juri"=>$juri,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function juriSave(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $juri = TopikJuri::where('id_topik',$json->id_topik)
                                ->where('id_juri',$json->id_juri)->get();
            if (count($juri) > 0){
                $result = array(
                    "sender" => "bic",
                    "status" => 'exist'
                );
            }else{
                $topikJuri = new TopikJuri();
                $topikJuri->id_topik = $json->id_topik;
                $topikJuri->id_juri = $json->id_juri;
                $topikJuri->inserted_by = $user->get()[0]->id;
                $topikJuri->updated_by = $user->get()[0]->id;
                $topikJuri->save();

                $result = array(
                    "sender" => "bic",
                    "status" => 'success'
                );
            }
            return response()->json($result);
        }
    }

    public function juriEdit($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',0)->get();
            //$juri = User::where('id_user_kategori',5)->get();
            $alljuri = User::all();
            $juri = array();
            foreach($alljuri as $item){
                if (count($item->userCategory) > 0){
                    foreach ($item->userCategory as $data){
                        if ($data->id ==5){
                            $selectedUser = new User();
                            $selectedUser->id = $item->id;
                            $selectedUser->fullname = $item->fullname;
                            //$juri[] = $item;
                            $juri[] = $selectedUser;
                        }
                    }
                }
                /*if ($item->userCategory[0]->id_user_category == 5){

                }*/
            }
            $topikJuri = TopikJuri::where('id',$id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.juriEdit', [
                    "topikJuri"=>$topikJuri,
                    "batch"=>$batch,
                    "juri"=>$juri,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.juriEdit', [
                    "topikJuri"=>$topikJuri,
                    "batch"=>$batch,
                    "juri"=>$juri,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function juriUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $juri = TopikJuri::where('id_topik',$json->id_topik)
                ->where('id_juri',$json->id_juri)->get();
            if (count($juri) > 0){
                $result = array(
                    "sender" => "bic",
                    "status" => 'exist'
                );
            }else{
                $juri = TopikJuri::where('id',$json->id);
                $juri->update([
                    "id_topik"=>$json->id_topik,
                    "id_juri"=>$json->id_juri
                ]);

                $result = array(
                    "sender" => "bic",
                    "status" => 'success'
                );
            }
            return response()->json($result);
        }
    }

    public function juriDelete($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $topikJuri = TopikJuri::where('id',$id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.juriDelete', [
                    "topikJuri"=>$topikJuri,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.juriDelete', [
                    "topikJuri"=>$topikJuri,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function juriDataDelete(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            topikJuri::where('id',$json->id)->delete();

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function juriPenilaian(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.juriPenilaian', [
                    "batch"=>$batch,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.juriPenilaian', [
                    "batch"=>$batch,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function getPenilaianPerTopik($idTopik,$idProposal,$globalUrutan,$topikUrut){
        $topikProposal = TopikProposal::where(['id_topik'=>$idTopik,'id_proposal'=>$idProposal])->get()[0];
        $topikJuri = TopikJuri::where('id_topik',$idTopik)->get();
        $proposalJuri = ProposalJuri::where(['id_topik'=>$idTopik,'id_proposal'=>$idProposal])->get();
        $listProposal = array();
        $total = 0;
        $selisih_D1=0;
        $selisih_D2 = 0;
        $selisih_D3 = 0;
        $selisih_D4 = 0;
        $selisih_D5 = 0;
        $selisih_D6 = 0;
        $selisih_D7 = 0;
        $selisih_D8 = 0;
        $G = 0;
        $min_9 = 1;
        $max_9 = 1;
        $num = count($proposalJuri);
        if ($num > 0){
            if ($num == 1){
                $content = new \stdClass();
                $content->selisih_D1 = $selisih_D1;
                $content->selisih_D2 = $selisih_D2;
                $content->selisih_D3 = $selisih_D3;
                $content->selisih_D4 = $selisih_D4;
                $content->selisih_D5 = $selisih_D5;
                $content->selisih_D6 = $selisih_D6;
                $content->selisih_D7 = $selisih_D7;
                $content->selisih_D8 = $selisih_D8;
                $content->G = $G;
                $content->juri = 1;
                $content->average = $proposalJuri[0]->average;
                switch ($proposalJuri[0]->nilai_9){
                    case 1:
                        $content->min_9 = "A";
                        $content->max_9 = "A";
                        break;
                    case 2:
                        $content->min_9 = "B";
                        $content->max_9 = "B";
                        break;
                    case 3:
                        $content->min_9 = "C";
                        $content->max_9 = "C";
                        break;
                    case 4:
                        $content->min_9 = "D";
                        $content->max_9 = "D";
                        break;
                }
                $content->id = $proposalJuri[0]->proposal->id;
                $content->status = $proposalJuri[0]->proposal->status;
                $content->alasan = $proposalJuri[0]->proposal->judul;
                $content->topik = $topikProposal->topik->topik;
                $content->batch = $topikProposal->topik->batch->batch;
                array_push($listProposal,$content);
                $content = new \stdClass();
                $content->selisih_D1 = $proposalJuri[0]->nilai_1;
                $content->selisih_D2 = $proposalJuri[0]->nilai_2;
                $content->selisih_D3 = $proposalJuri[0]->nilai_3;
                $content->selisih_D4 = $proposalJuri[0]->nilai_4;
                $content->selisih_D5 = $proposalJuri[0]->nilai_5;
                $content->selisih_D6 = $proposalJuri[0]->nilai_6;
                $content->selisih_D7 = $proposalJuri[0]->nilai_7;
                $content->selisih_D8 = $proposalJuri[0]->nilai_8;
                switch ($proposalJuri[0]->nilai_9){
                    case 1:
                        $content->G = "A";
                        break;
                    case 2:
                        $content->G = "B";
                        break;
                    case 3:
                        $content->G = "C";
                        break;
                    case 4:
                        $content->G = "D";
                        break;
                }
                $content->juri = "";
                $content->average = $proposalJuri[0]->average;
                $content->min_9 = $proposalJuri[0]->juri->fullname;
                //$content->min_9 = $content->G;
                $content->max_9 = "";
                $content->alasan = $proposalJuri[0]->alasan;
                $content->topik = $topikProposal->topik->topik;
                $content->batch = $topikProposal->topik->batch->batch;
                $content->global_urutan = $globalUrutan;
                $content->topik_urutan = $topikUrut;
                array_push($listProposal,$content);
            }else{
                //find selisih D_1
                for($i=0;$i<$num;$i++){
                    for($j=$i+1;$j<$num;$j++){
                        if ($j==1){
                            $selisih_D1 = abs($proposalJuri[$i]->nilai_1 - $proposalJuri[$j]->nilai_1);
                            $selisih_D2 = abs($proposalJuri[$i]->nilai_2 - $proposalJuri[$j]->nilai_2);
                            $selisih_D3 = abs($proposalJuri[$i]->nilai_3 - $proposalJuri[$j]->nilai_3);
                            $selisih_D4 = abs($proposalJuri[$i]->nilai_4 - $proposalJuri[$j]->nilai_4);
                            $selisih_D5 = abs($proposalJuri[$i]->nilai_5 - $proposalJuri[$j]->nilai_5);
                            $selisih_D6 = abs($proposalJuri[$i]->nilai_6 - $proposalJuri[$j]->nilai_6);
                            $selisih_D7 = abs($proposalJuri[$i]->nilai_7 - $proposalJuri[$j]->nilai_7);
                            $selisih_D8 = abs($proposalJuri[$i]->nilai_8 - $proposalJuri[$j]->nilai_8);
                            if ($proposalJuri[$i]->nilai_9 >= $proposalJuri[$j]->nilai_9){
                                $max_9 = $proposalJuri[$i]->nilai_9;
                                $min_9 = $proposalJuri[$j]->nilai_9;
                            }else{
                                $max_9 = $proposalJuri[$j]->nilai_9;
                                $min_9 = $proposalJuri[$i]->nilai_9;
                            }
                        }else{
                            $temp1 = abs($proposalJuri[$i]->nilai_1 - $proposalJuri[$j]->nilai_1);
                            $temp2 = abs($proposalJuri[$i]->nilai_2 - $proposalJuri[$j]->nilai_2);
                            $temp3 = abs($proposalJuri[$i]->nilai_3 - $proposalJuri[$j]->nilai_3);
                            $temp4 = abs($proposalJuri[$i]->nilai_4 - $proposalJuri[$j]->nilai_4);
                            $temp5 = abs($proposalJuri[$i]->nilai_5 - $proposalJuri[$j]->nilai_5);
                            $temp6= abs($proposalJuri[$i]->nilai_6 - $proposalJuri[$j]->nilai_6);
                            $temp7 = abs($proposalJuri[$i]->nilai_7 - $proposalJuri[$j]->nilai_7);
                            $temp8 = abs($proposalJuri[$i]->nilai_8 - $proposalJuri[$j]->nilai_8);
                            if ($temp1 > $selisih_D1){
                                $selisih_D1 = $temp1;
                            }
                            if ($temp2 > $selisih_D2){
                                $selisih_D2 = $temp1;
                            }
                            if ($temp3 > $selisih_D3){
                                $selisih_D3 = $temp3;
                            }
                            if ($temp4 > $selisih_D4){
                                $selisih_D4 = $temp4;
                            }
                            if ($temp5 > $selisih_D5){
                                $selisih_D5 = $temp5;
                            }
                            if ($temp6 > $selisih_D6){
                                $selisih_D6 = $temp6;
                            }
                            if ($temp7 > $selisih_D7){
                                $selisih_D7 = $temp7;
                            }
                            if ($temp8 > $selisih_D8){
                                $selisih_D8 = $temp8;
                            }

                            if ($min_9 >= $proposalJuri[$j]->nilai_9){
                                $min_9 = $proposalJuri[$j]->nilai_9;
                            }
                            if ($max_9 <= $proposalJuri[$j]->nilai_9){
                                $max_9 = $proposalJuri[$j]->nilai_9;
                            }
                        }
                    }
                    $total += $proposalJuri[$i]->average;
                }
                if ($selisih_D1 >= 2){
                    $G++;
                }
                if ($selisih_D2 >= 2){
                    $G++;
                }
                if ($selisih_D3 >= 2){
                    $G++;
                }
                if ($selisih_D4 >= 2){
                    $G++;
                }
                if ($selisih_D5 >= 2){
                    $G++;
                }
                if ($selisih_D6 >= 2){
                    $G++;
                }
                if ($selisih_D7 >= 2){
                    $G++;
                }
                if ($selisih_D8 >= 2){
                    $G++;
                }
                $content = new \stdClass();
                $content->selisih_D1 = $selisih_D1;
                $content->selisih_D2 = $selisih_D2;
                $content->selisih_D3 = $selisih_D3;
                $content->selisih_D4 = $selisih_D4;
                $content->selisih_D5 = $selisih_D5;
                $content->selisih_D6 = $selisih_D6;
                $content->selisih_D7 = $selisih_D7;
                $content->selisih_D8 = $selisih_D8;
                $content->G = $G;
                $content->juri = count($proposalJuri);
                $content->average = number_format($total/$num,4,'.',',');
                $textMin ="";
                switch ($min_9){
                    case 1:
                        $textMin = "A";
                        break;
                    case 2:
                        $textMin = "B";
                        break;
                    case 3:
                        $textMin = "C";
                        break;
                    case 4:
                        $textMin = "D";
                        break;
                }
                $textMax ="";
                switch ($max_9){
                    case 1:
                        $textMax = "A";
                        break;
                    case 2:
                        $textMax = "B";
                        break;
                    case 3:
                        $textMax = "C";
                        break;
                    case 4:
                        $textMax = "D";
                        break;
                }
                $content->min_9 = $textMin;
                $content->max_9 = $textMax;
                $content->id = $proposalJuri[0]->proposal->id;
                $content->status = $proposalJuri[0]->proposal->status;
                $content->alasan = $proposalJuri[0]->proposal->judul;
                $content->topik = $topikProposal->topik->topik;
                $content->batch = $topikProposal->topik->batch->batch;
                $content->global_urutan = $globalUrutan;
                $content->topik_urutan = $topikUrut;
                array_push($listProposal,$content);
                //add masing-masing penilaian juri kedalam list proposal
                for($i=0;$i<$num;$i++){
                    $content = new \stdClass();
                    $content->selisih_D1 = $proposalJuri[$i]->nilai_1;
                    $content->selisih_D2 = $proposalJuri[$i]->nilai_2;
                    $content->selisih_D3 = $proposalJuri[$i]->nilai_3;
                    $content->selisih_D4 = $proposalJuri[$i]->nilai_4;
                    $content->selisih_D5 = $proposalJuri[$i]->nilai_5;
                    $content->selisih_D6 = $proposalJuri[$i]->nilai_6;
                    $content->selisih_D7 = $proposalJuri[$i]->nilai_7;
                    $content->selisih_D8 = $proposalJuri[$i]->nilai_8;
                    switch ($proposalJuri[$i]->nilai_9) {
                        case 1:
                            $content->G = "A";
                            break;
                        case 2:
                            $content->G = "B";
                            break;
                        case 3:
                            $content->G = "C";
                            break;
                        case 4:
                            $content->G = "D";
                            break;
                    }
                    $content->juri = "";
                    $content->average = $proposalJuri[$i]->average;
                    $content->min_9 = $proposalJuri[$i]->juri->fullname;
                    $content->max_9 = "";
                    $content->alasan = $proposalJuri[$i]->alasan;
                    $content->topik = $topikProposal->topik->topik;
                    $content->batch = $topikProposal->topik->batch->batch;
                    array_push($listProposal,$content);
                }

            }
        }else{
            $content = new \stdClass();
            $content->selisih_D1 = "";
            $content->selisih_D2 = "";
            $content->selisih_D3 = "";
            $content->selisih_D4 = "";
            $content->selisih_D5 = "";
            $content->selisih_D6 = "";
            $content->selisih_D7 = "";
            $content->selisih_D8 = "";
            $content->G = "";
            $content->juri = 0;
            $content->average = 0;
            $content->min_9 = "";
            $content->max_9 = "";
            $content->id = 0;
            $content->status = 0;
            $content->alasan = $topikProposal->proposal->judul;
            $content->topik = $topikProposal->topik->topik;
            $content->batch = $topikProposal->topik->batch->batch;
            $content->global_urutan = $globalUrutan;
            $content->topik_urutan = $topikUrut;
            array_push($listProposal,$content);
        }
        //list juri2 dalam topik tapi tidak melakukan penjurian
        foreach($topikJuri as $item){
            $proposalJuri = ProposalJuri::where('id_topik',$idTopik)
                ->where('id_proposal',$idProposal)
                ->where('id_juri',$item->id_juri)->get();
            if (count($proposalJuri) > 0){

            }else{
                $content = new \stdClass();
                $content->selisih_D1 = "";
                $content->selisih_D2 = "";
                $content->selisih_D3 = "";
                $content->selisih_D4 = "";
                $content->selisih_D5 = "";
                $content->selisih_D6 = "";
                $content->selisih_D7 = "";
                $content->selisih_D8 = "";
                $content->G = "";
                $content->juri = "";
                $content->average = 0;
                $content->min_9 = $item->juri->fullname;
                $content->max_9 = "";
                $content->alasan = "";
                $content->topik = $item->topik->topik;
                $content->batch = $item->topik->batch->batch;
                array_push($listProposal,$content);
            }
        }
        //sort proposal
        /*usort($listProposal,function($first,$second){
            return $first->average < $second->average;
        });*/
        return $listProposal;
    }

    public function showPenilaian(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $listProposal = array();
            if ($json->id_topik == "0"){
                //pencarian berdasarkan batch
                $urutan = 1;
                $topikBatch = Topik::where('id_batch',$json->id_batch)->get();
                foreach ($topikBatch as $item){
                    $topikProposal = TopikProposal::where('id_topik',$item->id)->get();
                    $topikUrut = 1;
                    foreach ($topikProposal as $data){
                        array_push($listProposal,$this->getPenilaianPerTopik($data->id_topik,$data->id_proposal,$urutan,$topikUrut));
                        $urutan++;
                        $topikUrut++;
                    }
                }

            }else if ($json->id_proposal == "0"){
                //pencarian berdasarkan topik
                $topikProposal = TopikProposal::where('id_topik',$json->id_topik)->get();
                $urutan = 1;
                $topikUrut = 1;
                foreach ($topikProposal as $item){
                    array_push($listProposal,$this->getPenilaianPerTopik($item->id_topik,$item->id_proposal,$urutan,$topikUrut));
                    $urutan++;
                    $topikUrut++;
                }
            }else{
                //pencarian berdasarkan proposal
                $urutan = 1;
                $topikUrut = 1;
                $listProposal = $this->getPenilaianPerTopik($json->id_topik,$json->id_proposal,$urutan,$topikUrut);
            }
            $tempProposal = $listProposal;
            //sort proposal
            switch($json->sorting){
                case "ascending":
                    usort($listProposal,function($first,$second){
                        return $first[0]->average > $second[0]->average;
                        //return $first->average > $second->average;
                    });
                    $num = count($listProposal);
                    $index = $num-1;
                    for($i=1;$i < $num;$i++){
                        $listProposal[$i][0]->global_urutan = $index;
                        $index--;
                    }
                    break;
                case "descending":
                    usort($listProposal,function($first,$second){
                        return $first[0]->average < $second[0]->average;
                        //return $first->average < $second->average;
                    });
                    $num = count($listProposal);
                    $index = 1;
                    for($i=0;$i<$num;$i++){
                        $listProposal[$i][0]->global_urutan = $index;
                        //$listProposal[$i]->global_urutan = $index;
                        $index++;
                    }
                    break;
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                "listProposal"=>$listProposal
            );
            return response()->json($result);
        }
    }

    public function proposal(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',0)
                ->orWhere('is_finished',2)->get();
            foreach($batch as $index){
                $topik = $index->topik;
                $proposal = array();
                foreach($topik as $rows){
                    $topikproposal = TopikProposal::where('id_topik',$rows->id)->get();
                    foreach ($topikproposal as $item){
                        $proposal[] = $item;
                    }
                }
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.proposal', [
                    "batch"=>$batch,
                    "proposal"=>$proposal,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.proposal', [
                    "batch"=>$batch,
                    "proposal"=>$proposal,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function proposalCreate(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',0)->get();
            $proposal = Proposal::where('status',6)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.proposalCreate', [
                    "batch"=>$batch,
                    "proposal"=>$proposal,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.proposalCreate', [
                    "batch"=>$batch,
                    "proposal"=>$proposal,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function proposalEdit($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',0)->get();
            $proposal = Proposal::where('id',$id)->get();
            $batchTopik = Topik::where('id_batch',$proposal[0]->id_batch)->get();
            $topikProposal = TopikProposal::where('id_proposal',$proposal[0]->id)->get()[0];
            $proposalReview = ProposalReview::where('id_proposal',$id)
                ->where('is_sent',0)->get();
            $statusProposal = StatusProposal::whereNotIn('status',["BARU","BATAL","REVIEW","SELEKSI","DISIMPAN","TERPILIH","DISCONTINUED"])->get();
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
                return view('jayakari.bic.admin::pages.adminproses.proposalEdit',
                    [
                        "batch"=>$batch,
                        "batchTopik"=>$batchTopik,
                        "topikProposal"=>$topikProposal,
                        "proposal"=>$proposal,
                        "review"=>$proposalReview,
                        "statusProposal"=>$statusProposal,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.adminproses.proposalEdit',
                    [
                        "batch"=>$batch,
                        "batchTopik"=>$batchTopik,
                        "topikProposal"=>$topikProposal,
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

    public function proposalSave(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = TopikProposal::where('id_topik',$json->id_topik)
                ->where('id_proposal',$json->id_proposal)->get();
            if (count($proposal) > 0){
                $result = array(
                    "sender" => "bic",
                    "status" => 'exist'
                );
            }else{
                $topikProposal =  new TopikProposal();
                $topikProposal->id_topik = $json->id_topik;
                $topikProposal->id_proposal = $json->id_proposal;
                $topikProposal->inserted_by = $user->get()[0]->id;
                $topikProposal->updated_by = $user->get()[0]->id;
                $topikProposal->save();

                //update status proposal menjadi seleksi
                Proposal::where('id',$json->id_proposal)
                    ->update(["status"=>6]);

                $result = array(
                    "sender" => "bic",
                    "status" => 'success'
                );
            }
            return response()->json($result);
        }
    }

    public function proposalUpdate(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = TopikProposal::where('id',$json->id)
                ->update(['id_topik'=>$json->id_topik]);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function proposalDelete($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $topikProposal = TopikProposal::where('id',$id)->get()[0];
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.proposalDelete', [
                    "topikProposal"=>$topikProposal,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.proposalDelete', [
                    "topikProposal"=>$topikProposal,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function proposalDataDelete(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            //ProposalJuri::Destroy($json->id);
            $topikProposal = TopikProposal::where('id',$json->id);
            Proposal::where('id',$topikProposal->get()[0]->proposal->id)
                        ->update(["status"=>6]);
            //delete seluruh penilaian yang sudah diberikan juri pada topik sebelumnya
            $proposalJuris = ProposalJuri::where(['id_topik'=>$topikProposal->get()[0]->topik->id,'id_proposal'=>$topikProposal->get()[0]->proposal->id]);
            $proposalJuris->delete();
            $topikProposal->delete();

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function findTopik(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $topik = Topik::where('id_batch',$json->id)->get();
            return response()->json($topik);
        }
    }

    public function findProposal(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $topik = TopikProposal::where('id_topik',$json->id)->get();
            $proposal = array();
            if (count($topik) > 0){
                foreach($topik as $item){
                    $proposal[] = $item->proposal;
                }
            }
            return response()->json($proposal);
        }
    }

    public function updateProposal(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            foreach ($json->result as $item){
                Proposal::where('id',$item[0])
                        ->update(["status"=>$item[1]]);
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function detailProposal(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            foreach ($json->result as $item){
                Proposal::where('id',$item[0])
                    ->update(["status"=>$item[1]]);
            }
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function saveUbahProposal(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::where('id',$json->id);
            $proposal->update([
                "status"=>$json->status
            ]);
            $email = new EmailController();

            //send email to inovator
            $proposalMessage = new ProposalMessage();
            $proposalMessage->judul = $proposal->get()[0]->judul.'<br>';
            $proposalMessage->isi = $json->message;
            $proposalMessage->id_sender = 0;
            $proposalMessage->id_receiver = $proposal->get()[0]->user->id;
            $proposalMessage->sender = "Reviewer";
            $proposalMessage->receiver = "Inovator";
            $proposalMessage->status = 0;
            $proposalMessage->inserted_by = $user->get()[0]->id;
            $proposalMessage->updated_by = $user->get()[0]->id;
            $proposal->get()[0]->message()->save($proposalMessage);
            switch ($json->status){
                case "4":
                    $email->sendListedToRevisi($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
                    $proposal->update([
                        "is_always_active"=>1
                    ]);
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

    public function ubahProposal($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$id)->get();
            $proposalReview = ProposalReview::where('id_proposal',$id)
                ->where('is_sent',0)->get();
            $statusProposal = StatusProposal::whereNotIn('status',["BARU","BATAL","REVIEW","SELEKSI","DISIMPAN","DITERIMA","IN REVIEW"])->get();
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
            $this->kategorilabel = "proposal";

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
                return view('jayakari.bic.admin::pages.adminproses.ubahProposal',
                    [
                        "proposal"=>$proposal,
                        "penilaianJuri"=>$penilaianJuri,
                        "review"=>$proposalReview,
                        "statusProposal"=>$statusProposal,
                        "bidangusaha"=>$bidangusaha,
                        "inovasiMember"=>$inovasiMember,
                        "employee"=>$employee,
                        "datauser" => $user->get(),
                        'activeCategory'=>Cookie::get('active_category'),
                        'kategorilabel'=>$this->kategorilabel
                    ]
                );
            }else{
                return view('jayakari.bic.admin::pages.adminproses.ubahProposal',
                    [
                        "proposal"=>$proposal,
                        "penilaianJuri"=>$penilaianJuri,
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

    public function proposalShow(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::where('id',$json->id)->get()[0];
            $kunciTeknologiLevel1 = KataKunciTeknologi::where('id',$proposal->kataKunciTeknologi[0]->pivot->id_level_1)->get();
            $kunciTeknologiLevel2 = KataKunciTeknologi::where('id',$proposal->kataKunciTeknologi[0]->pivot->id_level_2)->get();
            $kunciAplikasiLevel1 = KataKunciTeknologi::where('id',$proposal->kataKunciAplikasi[0]->pivot->id_level_1)->get();
            $kunciAplikasiLevel2 = KataKunciTeknologi::where('id',$proposal->kataKunciAplikasi[0]->pivot->id_level_2)->get();
            $kunciKolaborasiLevel1 = KataKunciTeknologi::where('id',$proposal->kataKunciKolaborasi[0]->pivot->id_level_1)->get();
            $newproposal = new \stdClass();
            $newproposal->judul = $proposal->judul;
            $newproposal->abstrak = $proposal->abstrak;
            $newproposal->deskripsi = $proposal->deskripsi;
            $newproposal->keunggulan_teknologi = $proposal->keunggulan_teknologi;
            $newproposal->potensi_aplikasi = $proposal->potensi_aplikasi;
            $newproposal->development = $proposal->development->development;
            $haki = array();
            $haki[0] = $proposal->ipr[0]->ipr;
            if (($proposal->ipr[0]->id == 1) || ($proposal->ipr[0]->id == 2)){
                $haki[1] = $proposal->ipr[0]->pivot->no_patent;
            }else{
                $haki[1] = "";
            }
            $newproposal->haki = $haki;
            //kata kunci teknologi
            $katakunciteknologi = array();
            foreach ($proposal->kataKunciTeknologi as $item){
                $innerKKT = array();
                $innerKKT[0] = $kunciTeknologiLevel1[0]->kata_kunci;
                $innerKKT[1] = $kunciTeknologiLevel2[0]->kata_kunci;
                $innerKKT[2] = $item->kata_kunci;
                $katakunciteknologi[] = $innerKKT;
            }
            $newproposal->kataKunciTeknologi = $katakunciteknologi;
            $katakunciaplikasi = array();
            foreach ($proposal->kataKunciAplikasi as $item){
                $innerKKA = array();
                $innerKKA[0] = $kunciAplikasiLevel1[0]->kata_kunci;
                $innerKKA[1] = $kunciAplikasiLevel2[0]->kata_kunci;
                $innerKKA[2] = $item->kata_kunci;
                $katakunciaplikasi[] = $innerKKA;
            }
            $newproposal->kataKunciAplikasi = $katakunciaplikasi;
            $result = array(
                "sender" => "bic",
                "status" => 'success',
                "proposal"=>$newproposal
            );
            return response()->json($result);
        }
    }

    public function proposalPemenang(){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $batch = Batch::where('is_finished',2)->get();
            $proposal = Proposal::where('status',6)->get();
            $statusProposal = StatusProposal::where('id',7)
                        ->orWhere('id',8)
                        ->orWhere('id',9)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.proposalPemenang', [
                    "batch"=>$batch,
                    "proposal"=>$proposal,
                    "statusProposal"=>$statusProposal,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.proposalPemenang', [
                    "batch"=>$batch,
                    "proposal"=>$proposal,
                    "statusProposal"=>$statusProposal,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
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
            //$statusProposal = StatusProposal::whereNotIn('status',["BARU","BATAL","REVIEW","SELEKSI","DISIMPAN","DITERIMA","DISCONTINUED"])->get();
            $statusProposal = StatusProposal::whereNotIn('status',["BARU","BATAL","REVIEW","IN REVIEW","DISIMPAN","DITERIMA"])->get();
            $proposalStatus = StatusProposal::all();
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
            $this->kategorilabel = "proposal";
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
                return view('jayakari.bic.admin::pages.adminproses.review',
                    [
                        "proposal"=>$proposal,
                        "review"=>$proposalReview,
                        "penilaianJuri"=>$penilaianJuri,
                        "statusProposal"=>$statusProposal,
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
                return view('jayakari.bic.admin::pages.adminproses.review',
                    [
                        "proposal"=>$proposal,
                        "penilaianJuri"=>$penilaianJuri,
                        "review"=>$proposalReview,
                        "statusProposal"=>$statusProposal,
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

    public function saveReview(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id', $userid);
        if (count($user->get()) == 0) {
            return redirect('general/login');
        } else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::where('id',$json->id_proposal);
            $proReview = ProposalReview::where(['is_sent'=>0,'id_proposal'=>$proposal->get()[0]->id]);
            if(count($proReview->get()) > 0){
                if ($json->status <> 0){
                    $proReview->update(['isi'=>$json->isi,"id_proposal"=>$json->id_proposal,"is_sent"=>1,"updated_by"=>$user->get()[0]->id]);
                    //update proposal
                    $proposal->update(["status"=>$json->status]);
                    $email = new EmailController();
                    switch($json->status){
                        case "4":
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
                            //$email->sendRevisi($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
                            break;
                        case "6":
                            //save message to inovator
                            $proposalMessage = new ProposalMessage();
                            $proposalMessage->judul = $proposal->get()[0]->judul.'<br>';
                            $proposalMessage->isi = $proReview->get()[0]->isi;
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
                            $proposalMessageProses->judul = '[BIC]Permohonan Seleksi Juri - '.$proposal->judul;
                            $proposalMessageProses->isi = '<p style="text-align: justify">Mohon kepada tim admin proses untuk memilih juri yang tepat untuk proposal ini<br><br>';
                            $proposalMessageProses->isi .= 'Resume Proposal:<br>';
                            $proposalMessageProses->isi .= 'Nomor/Judul    : '.$proposal->id.'/'.$proposal->judul.'<br>';
                            $proposalMessageProses->isi .= 'Inovator : '.$proposal->user->fullname.'<br>';
                            $proposalMessageProses->id_sender = 0;
                            $proposalMessageProses->id_receiver = 0;
                            $proposalMessageProses->sender = "Reviewer";
                            $proposalMessageProses->receiver = "AdminProses";
                            $proposalMessageProses->status = 0;
                            $proposalMessageProses->inserted_by = $user->get()[0]->id;
                            $proposalMessageProses->updated_by = $user->get()[0]->id;
                            $proposal->get()[0]->message()->save($proposalMessageProses);
                            //$email->sendSeleksi($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage,$json->isi);
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
                            //$email->sendDiscontinued($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
                            break;
                    }
                }else{
                    ProposalReview::where('id',$proReview->get()[0]->id)
                        ->update(['isi'=>$json->isi,"id_proposal"=>$json->id_proposal,"updated_by"=>$user->get()[0]->id]);
                }
            }else{
                $proposalReview = new ProposalReview();
                $proposalReview->judul = "[BIC]Hasil Review - ".$proposal->get()[0]->judul;
                $proposalReview->isi = $json->isi;
                if ($json->status <> 0){
                    //save message to admin prosess
                    $proposalReview->is_sent = 1;
                    $proposalReview->inserted_by = $user->get()[0]->id;
                    $proposalReview->updated_by = $user->get()[0]->id;
                    //update status proposal
                    $proposal->update(["status"=>$json->status]);
                    $proposal->get()[0]->review()->save($proposalReview);
                    $email = new EmailController();
                    switch ($json->status){
                        case "4":
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
                            //$email->sendRevisi($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
                            break;
                        case "6":
                            $proposalMessageProses = new ProposalMessage();
                            $proposalMessageProses->judul = '[BIC]Permohonan Seleksi Juri - '.$proposal->get()[0]->judul;
                            $proposalMessageProses->isi = '<p style="text-align: justify">Mohon kepada tim admin proses untuk memilih juri yang tepat untuk proposal ini<br>';
                            $proposalMessageProses->isi .= 'Resume Proposal:<br>';
                            $proposalMessageProses->isi .= 'Judul    : '.$proposalReview->judul.'<br>';
                            //$proposalMessageProses->isi .= 'Inovator : '.$proposal->get()[0]->user->fullname.'<br><br>';
                            $proposalMessageProses->isi .= 'Para Inovator : <br><br>';
                            $proposalMessageProses->isi .='<ol>';
                            foreach($proposal->get()[0]->inovasiMember as $item){
                                $rsc = RSC::where('id',$item->pivot->id_rsc)->get()[0];
                                $proposalMessageProses->isi .='<li>'.$item->pivot->name.' ('.$rsc->rsc.')</li>';
                            }
                            $proposalMessageProses->isi .='</ol>';
                            $proposalMessageProses->id_sender = 0;
                            $proposalMessageProses->id_receiver = 0;
                            $proposalMessageProses->sender = "Reviewer";
                            $proposalMessageProses->receiver = "AdminProses";
                            $proposalMessageProses->status = 0;
                            $proposalMessageProses->inserted_by = $user->get()[0]->id;
                            $proposalMessageProses->updated_by = $user->get()[0]->id;
                            $proposal->get()[0]->message()->save($proposalMessageProses);

                            //$email->sendSeleksi($proposal->get()[0]->user,$proposal->get()[0],$proposalMessageProses,$json->isi);
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
                            //$email->sendDiscontinued($proposal->get()[0]->user,$proposal->get()[0],$proposalMessage);
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

    public function expert(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::whereIn('status',[5,6])->get();
            $num = count($proposal);
            $technicalreviewer = array();
            for($i=0;$i<$num;$i++){
                $message = ProposalMessage::where([
                    'sender'=>'AdminProses',
                    'receiver'=>'TechnicalReviewer',
                    'id_proposal'=>$proposal[$i]->id
                ])->get();
                if (count($message) > 0){
                    foreach ($message as $item){
                        $expert = ProposalMasukanTeknis::where(['id_proposal'=>$item->id_proposal,'id_juri'=>$item->id_receiver])->get();
                        if (count($expert) > 0){
                            $expert = $expert[0];
                            $std = new \stdClass();
                            $std->id = $proposal[$i]->id;
                            $std->judul = $proposal[$i]->judul;
                            $std->id_juri = $item->id_receiver;
                            $std->juri = $expert->juri->fullname;
                            $std->question = $item->isi;
                            $std->answer = $expert->masukan;
                            $std->status = $proposal[$i]->statusProposal->status;
                            $technicalreviewer[] = $std;
                        }else{
                            $user = User::where('id',$item->id_receiver)->get()[0];
                            $std = new \stdClass();
                            $std->id = $proposal[$i]->id;
                            $std->judul = $proposal[$i]->judul;
                            $std->id_juri = $item->id_receiver;
                            $std->juri = $user->fullname;
                            $std->question = $item->isi;
                            $std->answer = '';
                            $std->status = $proposal[$i]->statusProposal->status;
                            $technicalreviewer[] = $std;
                        }

                    }
                }else{
                    $proposal[$i]->id_juri = 0;
                    $proposal[$i]->juri = '';
                    $proposal[$i]->question = '';
                    $proposal[$i]->answer = '';
                    $technicalreviewer[] = $proposal[$i];
                }
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.adminproses.expert', [
                    "technicalreviewer"=>$technicalreviewer,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.adminproses.expert', [
                    "technicalreviewer"=>$technicalreviewer,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

}