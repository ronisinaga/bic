<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 11/23/2017
 * Time: 5:26 AM
 */
namespace jayakari\bic\general\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use jayakari\bic\admin\Controllers\EmailController;
use jayakari\bic\admin\Models\DictionaryKategori;
use jayakari\bic\admin\Models\KataKunciTeknologi;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\ProposalInstansi;
use jayakari\bic\admin\Models\ProposalKataKunciAplikasi;
use jayakari\bic\admin\Models\ProposalKataKunciKolaborasi;
use jayakari\bic\admin\Models\ProposalKataKunciTeknologi;
use jayakari\bic\admin\Models\ProposalTempInstansi;
use jayakari\bic\admin\Models\ProposalTempKataKunciTeknologi;
use jayakari\bic\admin\Models\StatusProposal;
use jayakari\bic\admin\Models\User;

class HomeController extends Controller{

    public function index(){
        return view('jayakari.bic.general::pages.home.index');
    }

    public function login(){
        //$this->convertProposalInstansi();
        return view('jayakari.bic.general::pages.home.login');
    }

    public function diagram(){
        //$this->convertProposalInstansi();
        return view('jayakari.bic.general::pages.home.diagram');
    }

    public function statistic(){
        //$this->convertProposalInstansi();
        $statusProposal = StatusProposal::all();
        $statistic = array();
        $index = 0;
        $users = User::all();
        $total = Proposal::all();
        foreach($statusProposal as $item){
            $statistic[$index]['status'] = $item->status;
            $proposal = Proposal::where('status',$item->id)->get();
            $statistic[$index]['jumlah'] = count($proposal);
            $index++;
        }
        return view('jayakari.bic.general::pages.home.statistic',[
            'user'=>$users,
            "statistic"=>$statistic,
            "total"=>count($total)
        ]);
    }

    public function sendEmail(Request $request){
        //$this->convertProposalInstansi();
        $data = $request->input('data');
        $json = json_decode($data);
        $user = User::where(['email' => $json->email]);
        if (count($user->get()) > 0){
            $user->update(['password'=>md5('12345678')]);
            $email = new EmailController();
            $email->sendForgetPassword($user->get()[0]);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
        }else{
            $result = array(
                "sender" => "bic",
                "status" => 'invalid'
            );
        }
        return response()->json($result);
    }

    public function convertProposalKataKunciTeknologi(){
        $all = ProposalTempKataKunciTeknologi::all();
        $rows = count($all);
        for($j=0;$j<$rows;$j++){
            $arrKataKunci = explode(",",$all[$j]->id_kata_kunci);
            $num = count($arrKataKunci);
            for($i=0;$i<$num;$i++){
                $len = strlen($arrKataKunci[$i]);
                switch ($len){
                    case 3:
                        $level1 = KataKunciTeknologi::where([['level1','=',$arrKataKunci[$i]],['level2','=','000'],['level3','=','000'],['type','=',1]])->get()[0];
                        $proposalKataKunci = new ProposalKataKunciTeknologi();
                        $proposalKataKunci->id_proposal = $all[$j]->id_proposal;
                        $proposalKataKunci->id_kata_kunci = 0;
                        $proposalKataKunci->id_level_1 = $level1->id;
                        $proposalKataKunci->id_level_2 = 0;
                        $proposalKataKunci->save();
                        break;
                    case 6:
                        $part1 = substr($arrKataKunci[$i],0,3);
                        $part2 = substr($arrKataKunci[$i],3,3);
                        $level1 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=','000'],['level3','=','000'],['type','=',1]])->get()[0];
                        $level2 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=',$part2],['level3','=','000'],['type','=',1]])->get()[0];
                        $proposalKataKunci = new ProposalKataKunciTeknologi();
                        $proposalKataKunci->id_proposal = $all[$j]->id_proposal;
                        $proposalKataKunci->id_kata_kunci = 0;
                        $proposalKataKunci->id_level_1 = $level1->id;
                        $proposalKataKunci->id_level_2 = $level2->id;
                        $proposalKataKunci->save();
                        break;
                    case 9:
                        $part1 = substr($arrKataKunci[$i],0,3);
                        $part2 = substr($arrKataKunci[$i],3,3);
                        $part3 = substr($arrKataKunci[$i],6,3);
                        $level1 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=','000'],['level3','=','000'],['type','=',1]])->get()[0];
                        $level2 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=',$part2],['level3','=','000'],['type','=',1]])->get()[0];
                        $level3 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=',$part2],['level3','=',$part3],['type','=',1]])->get()[0];
                        $proposalKataKunci = new ProposalKataKunciTeknologi();
                        $proposalKataKunci->id_proposal = $all[$j]->id_proposal;
                        $proposalKataKunci->id_kata_kunci = $level3->id;
                        $proposalKataKunci->id_level_1 = $level1->id;
                        $proposalKataKunci->id_level_2 = $level2->id;
                        $proposalKataKunci->save();
                        //$proposalKataKunci->
                        break;
                }
            }

        }
        return $rows;
    }

    public function convertProposalKataKunciAplikasi(){
        $all = ProposalTempKataKunciTeknologi::all();
        $rows = count($all);
        for($j=0;$j<$rows;$j++){
            $arrKataKunci = explode(",",$all[$j]->id_kata_kunci);
            $num = count($arrKataKunci);
            for($i=0;$i<$num;$i++){
                $len = strlen($arrKataKunci[$i]);
                switch ($len){
                    case 3:
                        $level1 = KataKunciTeknologi::where([['level1','=',$arrKataKunci[$i]],['level2','=','000'],['level3','=','000'],['type','=',3]])->get()[0];
                        $proposalKataKunci = new ProposalKataKunciAplikasi();
                        $proposalKataKunci->id_proposal = $all[$j]->id_proposal;
                        $proposalKataKunci->id_kata_kunci = 0;
                        $proposalKataKunci->id_level_1 = $level1->id;
                        $proposalKataKunci->id_level_2 = 0;
                        $proposalKataKunci->save();
                        break;
                    case 6:
                        $part1 = substr($arrKataKunci[$i],0,3);
                        $part2 = substr($arrKataKunci[$i],3,3);
                        $level1 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=','000'],['level3','=','000'],['type','=',3]])->get()[0];
                        $level2 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=',$part2],['level3','=','000'],['type','=',3]])->get()[0];
                        $proposalKataKunci = new ProposalKataKunciAplikasi();
                        $proposalKataKunci->id_proposal = $all[$j]->id_proposal;
                        $proposalKataKunci->id_kata_kunci = 0;
                        $proposalKataKunci->id_level_1 = $level1->id;
                        $proposalKataKunci->id_level_2 = $level2->id;
                        $proposalKataKunci->save();
                        break;
                    case 9:
                        $part1 = substr($arrKataKunci[$i],0,3);
                        $part2 = substr($arrKataKunci[$i],3,3);
                        $part3 = substr($arrKataKunci[$i],6,3);
                        $level1 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=','000'],['level3','=','000'],['type','=',3]])->get()[0];
                        $level2 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=',$part2],['level3','=','000'],['type','=',3]])->get()[0];
                        $level3 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=',$part2],['level3','=',$part3],['type','=',3]])->get()[0];
                        $proposalKataKunci = new ProposalKataKunciAplikasi();
                        $proposalKataKunci->id_proposal = $all[$j]->id_proposal;
                        $proposalKataKunci->id_kata_kunci = $level3->id;
                        $proposalKataKunci->id_level_1 = $level1->id;
                        $proposalKataKunci->id_level_2 = $level2->id;
                        $proposalKataKunci->save();
                        //$proposalKataKunci->
                        break;
                }
            }

        }
        return $rows;
    }

    public function convertProposalKataKunciKolaborasi(){
        $all = ProposalTempKataKunciTeknologi::all();
        $rows = count($all);
        for($j=0;$j<$rows;$j++){
            $arrKataKunci = explode(",",$all[$j]->id_kata_kunci);
            $num = count($arrKataKunci);
            for($i=0;$i<$num;$i++){
                $len = strlen($arrKataKunci[$i]);
                switch ($len){
                    case 3:
                        $level1 = KataKunciTeknologi::where([['level1','=',$arrKataKunci[$i]],['level2','=','000'],['level3','=','000'],['type','=',2]])->get()[0];
                        $proposalKataKunci = new ProposalKataKunciKolaborasi();
                        $proposalKataKunci->id_proposal = $all[$j]->id_proposal;
                        $proposalKataKunci->id_kata_kunci = 0;
                        $proposalKataKunci->id_level_1 = $level1->id;
                        $proposalKataKunci->save();
                        break;
                    case 6:
                        $part1 = substr($arrKataKunci[$i],0,3);
                        $part2 = substr($arrKataKunci[$i],3,3);
                        $level1 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=','000'],['level3','=','000'],['type','=',2]])->get()[0];
                        $level2 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=',$part2],['level3','=','000'],['type','=',2]])->get()[0];
                        $proposalKataKunci = new ProposalKataKunciKolaborasi();
                        $proposalKataKunci->id_proposal = $all[$j]->id_proposal;
                        $proposalKataKunci->id_kata_kunci = $level2->id;
                        $proposalKataKunci->id_level_1 = $level1->id;
                        $proposalKataKunci->save();
                        break;
                    case 9:
                        $part1 = substr($arrKataKunci[$i],0,3);
                        $part2 = substr($arrKataKunci[$i],3,3);
                        $part3 = substr($arrKataKunci[$i],6,3);
                        $level1 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=','000'],['level3','=','000'],['type','=',2]])->get()[0];
                        $level2 = KataKunciTeknologi::where([['level1','=',$part1],['level2','=',$part2],['level3','=','000'],['type','=',2]])->get()[0];
                        $proposalKataKunci = new ProposalKataKunciKolaborasi();
                        $proposalKataKunci->id_proposal = $all[$j]->id_proposal;
                        $proposalKataKunci->id_kata_kunci = $level2->id;
                        $proposalKataKunci->id_level_1 = $level1->id;
                        $proposalKataKunci->save();
                        //$proposalKataKunci->
                        break;
                }
            }

        }
        return $rows;
    }

    public function convertProposalInstansi(){
        $all = ProposalTempInstansi::all();
        $rows = count($all);
        for($j=0;$j<$rows;$j++){
            $instansi = explode(",",$all[$j]->bidang_usaha);
            foreach($instansi as $item){
                switch (strtolower($item)){
                    case "industri":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 1;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "perusahaan":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 1;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "uni":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 2;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "universitas/perguruan tinggi":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 2;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "rnd":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 3;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "lembaga litbang":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 3;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "bumn_d":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 4;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "bumn/bumd":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 4;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "eng":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 5;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "pusat rekayasa teknologi":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 5;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "lsm":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 6;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "lembaga swadaya masyarakat":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 6;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "lp":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 7;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "lembaga pemerintahan":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 7;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "jasa":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 8;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "jasa/pelayanan":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 8;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "ins-lain-lain":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 9;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "lain-lain":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 9;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "rnd/uni":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 10;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    case "litbang/universitas":
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = 10;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                    default:
                        $proposalInstansi = new ProposalInstansi();
                        $proposalInstansi->id_proposal = $all[$j]->id_proposal;
                        $proposalInstansi->nama_instansi = $all[$j]->nama_instansi;
                        $proposalInstansi->bidang_usaha = $all[$j]->bidang_usaha;
                        $proposalInstansi->id_employee = $all[$j]->id_employee;
                        $proposalInstansi->inserted_by = 8;
                        $proposalInstansi->updated_by = 8;
                        $proposalInstansi->save();
                        break;
                }
            }

        }
    }

    public function manual(){
        return view('jayakari.bic.general::pages.home.manual');
    }

    public function inovator(){
        return view('jayakari.bic.general::pages.home.inovator');
    }

    public function detailInovator($id){
        switch ($id){
            case '1':
                return view('jayakari.bic.general::pages.home.inovatorDashboard');
                break;
            case '2':
                return view('jayakari.bic.general::pages.home.inovatorProfile');
                break;
            case '3':
                return view('jayakari.bic.general::pages.home.inovatorProposal');
                break;
            case '4':
                return view('jayakari.bic.general::pages.home.inovatorMessage');
                break;
        }
    }

    public function reviewer(){
        return view('jayakari.bic.general::pages.home.reviewer');
    }

    public function detailReviewer($id){
        switch ($id){
            case '1':
                return view('jayakari.bic.general::pages.home.reviewerDashboard');
                break;
            case '2':
                return view('jayakari.bic.general::pages.home.reviewerProfile');
                break;
            case '3':
                return view('jayakari.bic.general::pages.home.reviewerProposal');
                break;
            case '4':
                return view('jayakari.bic.general::pages.home.reviewerMessage');
                break;
        }
    }

    public function adminProses(){
        return view('jayakari.bic.general::pages.home.adminProses');
    }

    public function detailAdminProses($id){
        switch ($id){
            case '1':
                return view('jayakari.bic.general::pages.home.adminProsesDashboard');
                break;
            case '2':
                return view('jayakari.bic.general::pages.home.adminProsesProfile');
                break;
            case '3':
                return view('jayakari.bic.general::pages.home.adminProsesPenjurian');
                break;
            case '4':
                return view('jayakari.bic.general::pages.home.adminProsesProposal');
                break;
            case '5':
                return view('jayakari.bic.general::pages.home.adminProsesMessage');
                break;
        }
    }

    public function juri(){
        return view('jayakari.bic.general::pages.home.juri');
    }

    public function detailJuri($id){
        switch ($id){
            case '1':
                return view('jayakari.bic.general::pages.home.juriDashboard');
                break;
            case '2':
                return view('jayakari.bic.general::pages.home.juriProfile');
                break;
            case '3':
                return view('jayakari.bic.general::pages.home.juriPenilaian');
                break;
            case '4':
                return view('jayakari.bic.general::pages.home.juriHistoryPenilaian');
                break;
        }
    }

    public function registrasi(){
        $TAR = DictionaryKategori::where('kode','TAR')->get()[0]->dictionary[0]->isi;
        $PAR = DictionaryKategori::where('kode','PAR')->get()[0]->dictionary[0]->isi;
        $labels = array(
            "TAR"=>$TAR,
            "PAR"=>$PAR
        );
        return view('jayakari.bic.general::pages.home.registrasi',[
            "labels"=>$labels]);
    }

    public function emailContent(){
        return view('jayakari.bic.admin::pages.email.terimakasihEmail');
    }

    public function terimakasih(){
        $TTR = DictionaryKategori::where('kode','TTR')->get()[0]->dictionary[0]->isi;
        $PTR = DictionaryKategori::where('kode','PTR')->get()[0]->dictionary[0]->isi;
        $labels = array(
            "TTR"=>$TTR,
            "PTR"=>$PTR
        );
        return view('jayakari.bic.general::pages.home.terimakasih',[
        "labels"=>$labels]);
    }

    public function kegiatan(){
        return view('jayakari.bic.general::pages.home.kegiatan');
    }
}