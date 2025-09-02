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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use jayakari\bic\admin\Controllers\EmailController;
use jayakari\bic\admin\Models\ARN;
use jayakari\bic\admin\Models\Banner;
use jayakari\bic\admin\Models\Buku;
use jayakari\bic\admin\Models\BukuIsi;
use jayakari\bic\admin\Models\BukuIsiFile;
use jayakari\bic\admin\Models\DictionaryKategori;
use jayakari\bic\admin\Models\FAQ;
use jayakari\bic\admin\Models\InovasiUnggulan;
use jayakari\bic\admin\Models\KataKunciTeknologi;
use jayakari\bic\admin\Models\KategoriMenu;
use jayakari\bic\admin\Models\News;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\ProposalInstansi;
use jayakari\bic\admin\Models\ProposalKataKunciAplikasi;
use jayakari\bic\admin\Models\ProposalKataKunciKolaborasi;
use jayakari\bic\admin\Models\ProposalKataKunciTeknologi;
use jayakari\bic\admin\Models\ProposalMessage;
use jayakari\bic\admin\Models\ProposalTempInstansi;
use jayakari\bic\admin\Models\ProposalTempKataKunciTeknologi;
use jayakari\bic\admin\Models\ProposalTempMessage;
use jayakari\bic\admin\Models\StatusProposal;
use jayakari\bic\admin\Models\TempDatabaseAll;
use jayakari\bic\admin\Models\Testimonial;
use jayakari\bic\admin\Models\User;
use jayakari\bic\admin\Models\UserMenuCategory;
use jayakari\bic\admin\Models\Videos;

class HomeController extends Controller{

    public function index_old(){
        $banner = Banner::orderBy('id','asc')->get();
        $latestNews = News::where('is_active',1)->orderBy('id','desc')->take(5)->get();
        $popularNews = News::where('is_active',1)->orderBy('views','desc')->take(5)->get();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        $testimonial = Testimonial::where('is_active',1)->get();
        $statusProposal = StatusProposal::all();
        $statistic = array();
        $index = 0;
        $users = User::all();
        $total = Proposal::all();
        $videos = Videos::orderBy('id','desc')->take(10)->get();
        $inovasiUnggulan = InovasiUnggulan::where('is_active',1)->get()[0];
        foreach($statusProposal as $item){
            $statistic[$index]['status'] = $item->status;
            $proposal = Proposal::where('status',$item->id)->get();
            $statistic[$index]['jumlah'] = count($proposal);
            $index++;
        }
        $BHV = DictionaryKategori::where('kode','BHV')->get()[0]->dictionary[0]->isi;
        $labels = array(
            "BHV"=>$BHV
        );
        return view('jayakari.bic.general::pages.home.index',[
            "buku"=>$buku,
            "banner"=>$banner,
            "latestNews"=>$latestNews,
            "popularNews"=>$popularNews,
            "kategoriMenu"=>$kategoriMenu,
            "testimonial"=>$testimonial,
            "statistic"=>$statistic,
            "total"=>count($total),
            "user"=>count($users),
            "videos"=>$videos,
            "inovasiunggulan"=>$inovasiUnggulan,
            "labels"=>$labels,
        ]);
    }

    public function login(){
        //$this->convertProposalMessage();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        $JLU = DictionaryKategori::where('kode','JLU')->get()[0]->dictionary[0]->isi;
        $TLU = DictionaryKategori::where('kode','TLU')->get()[0]->dictionary[0]->isi;
        $LLU = DictionaryKategori::where('kode','LLU')->get()[0]->dictionary[0]->isi;
        $labels = array(
            "JLU"=>$JLU,
            "TLU"=>$TLU,
            "LLU"=>$LLU
        );
        /*$labels = array(
            "JLU"=>"",
            "TLU"=>"",
            "LLU"=>""
        );*/
        return view('jayakari.bic.general::pages.home.login',[
            "kategoriMenu"=>$kategoriMenu,
            "buku"=>$buku,
            "labels"=>$labels
        ]);
    }

    public function diagram(){
        //$this->convertProposalInstansi();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.home.diagram',compact('kategoriMenu','buku'));
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
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
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

    public function convertProposalMessage(){
        $all = ProposalTempMessage::all();
        $rows = count($all);
        for($j=0;$j<$rows;$j++){
            $status = $all[$j]->t_titlen_status;
            if (strpos(strtolower($status),'migrasi')){
                $arrstatus = explode("-",$status);
                switch (trim(strtolower($arrstatus[1]))){
                    case 'baru':
                        if (strpos(strtolower($all[$j]->t_titlen_desc),'review') !== false){
                            $proposal = Proposal::where('id',$all[$j]->t_titlen_uid)->get();
                            $pm = new ProposalMessage();
                            $pm->id_proposal = $all[$j]->t_titlen_uid;
                            $pm->id_sender = $proposal[0]->id_inovator;
                            $pm->id_receiver = 0;
                            $pm->sender = 'Inovator';
                            $pm->receiver = 'Reviewer';
                            $pm->judul = "[BIC] Review Proposal - ".$proposal[0]->judul;
                            $pm->isi = $all[$j]->t_titlen_desc;
                            $pm->inserted_by = $proposal[0]->id_inovator;
                            $pm->updated_by = $proposal[0]->id_inovator;
                            $pm->status =1;
                            $pm->save();
                        }
                        break;
                    case 'review':
                        $proposal = Proposal::where('id',$all[$j]->t_titlen_uid)->get();
                        $pm = new ProposalMessage();
                        $pm->id_proposal = $all[$j]->t_titlen_uid;
                        $pm->id_sender = 0;
                        $pm->id_receiver = $proposal[0]->id_inovator;
                        $pm->sender = 'Reviewer';
                        $pm->receiver = 'Inovator';
                        if (strpos(strtolower($all[$j]->t_titlen_desc),'revisi') !== false){
                            $pm->judul = "[BIC] Revisi Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'inreview') !== false){
                            $pm->judul = "[BIC] In Review Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'discontinued') !== false){
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'listed') !== false){
                            $pm->judul = "[BIC] Simpan Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'approved') !== false){
                            $pm->judul = "[BIC] Approved Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'ditolak') !== false){
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                        }
                        $pm->isi = $all[$j]->t_titlen_desc;
                        $pm->inserted_by = $proposal[0]->id_inovator;
                        $pm->updated_by = $proposal[0]->id_inovator;
                        $pm->status =1;
                        $pm->save();
                        break;
                    case 'revisi':
                        $pm = new ProposalMessage();
                        $proposal = Proposal::where('id',$all[$j]->t_titlen_uid)->get();
                        if (strpos(strtolower($all[$j]->t_titlen_desc),'review') !== false){
                            $pm->id_sender = $proposal[0]->id_inovator;
                            $pm->id_receiver = 0;
                            $pm->sender = 'Inovator';
                            $pm->receiver = 'Reviewer';
                            $pm->judul = "[BIC] Review Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $proposal[0]->id_inovator;
                            $pm->updated_by = $proposal[0]->id_inovator;

                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'discontinued') !== false){
                            $pm->id_sender = 0;
                            $pm->id_receiver = $proposal[0]->id_inovator;
                            $pm->sender = 'Reviewer';
                            $pm->receiver = 'Inovator';
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $all[$j]->t_titlen_userid;
                            $pm->updated_by = $all[$j]->t_titlen_userid;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'inreview') !== false){
                            $pm->id_sender = 0;
                            $pm->id_receiver = $proposal[0]->id_inovator;
                            $pm->sender = 'Reviewer';
                            $pm->receiver = 'Inovator';
                            $pm->judul = "[BIC] In Review Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $all[$j]->t_titlen_userid;
                            $pm->updated_by = $all[$j]->t_titlen_userid;
                        }
                        else if (strpos(strtolower($all[$j]->t_titlen_desc),'listed') !== false){
                            $pm->id_sender = 0;
                            $pm->id_receiver = $proposal[0]->id_inovator;
                            $pm->sender = 'Reviewer';
                            $pm->receiver = 'Inovator';
                            $pm->judul = "[BIC] Disimpan Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $all[$j]->t_titlen_userid;
                            $pm->updated_by = $all[$j]->t_titlen_userid;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'approved') !== false){
                            $pm->id_sender = 0;
                            $pm->id_receiver = $proposal[0]->id_inovator;
                            $pm->sender = 'Reviewer';
                            $pm->receiver = 'Inovator';
                            $pm->judul = "[BIC] Approved Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $all[$j]->t_titlen_userid;
                            $pm->updated_by = $all[$j]->t_titlen_userid;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'ditolak') !== false){
                            $pm->id_sender = 0;
                            $pm->id_receiver = $proposal[0]->id_inovator;
                            $pm->sender = 'Reviewer';
                            $pm->receiver = 'Inovator';
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $all[$j]->t_titlen_userid;
                            $pm->updated_by = $all[$j]->t_titlen_userid;
                        }
                        $pm->status =1;
                        $pm->isi = $all[$j]->t_titlen_desc;
                        $pm->id_proposal = $all[$j]->t_titlen_uid;
                        $pm->save();
                        break;
                    case 'inreview':
                        $proposal = Proposal::where('id',$all[$j]->t_titlen_uid)->get();
                        $pm = new ProposalMessage();
                        $pm->id_proposal = $all[$j]->t_titlen_uid;
                        $pm->id_sender = 0;
                        $pm->id_receiver = $proposal[0]->id_inovator;
                        $pm->sender = 'Reviewer';
                        $pm->receiver = 'Inovator';
                        if (strpos(strtolower($all[$j]->t_titlen_desc),'revisi') !== false){
                            $pm->judul = "[BIC] Revisi Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'seleksi') !== false){
                            $pm->judul = "[BIC] In Review Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'discontinued') !== false){
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'listed') !== false){
                            $pm->judul = "[BIC] Simpan Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'approved') !== false){
                            $pm->judul = "[BIC] Approved Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'ditolak') !== false){
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                        }
                        $pm->isi = $all[$j]->t_titlen_desc;
                        $pm->inserted_by = $proposal[0]->id_inovator;
                        $pm->updated_by = $proposal[0]->id_inovator;
                        $pm->status =1;
                        $pm->save();
                        break;
                    case 'seleksi':
                        $proposal = Proposal::where('id',$all[$j]->t_titlen_uid)->get();
                        $pm = new ProposalMessage();
                        $pm->id_proposal = $all[$j]->t_titlen_uid;
                        $pm->id_sender = 0;
                        $pm->id_receiver = $proposal[0]->id_inovator;
                        $pm->sender = 'Reviewer';
                        $pm->receiver = 'Inovator';
                        if (strpos(strtolower($all[$j]->t_titlen_desc),'listed') !== false){
                            $pm->judul = "[BIC] Simpan Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'discontinued') !== false){
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'approved') !== false){
                            $pm->judul = "[BIC] Approved Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'inreview') !== false){
                            $pm->judul = "[BIC] In Review Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'ditolak') !== false){
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                        }
                        $pm->isi = $all[$j]->t_titlen_desc;
                        $pm->inserted_by = $proposal[0]->id_inovator;
                        $pm->updated_by = $proposal[0]->id_inovator;
                        $pm->status =1;
                        $pm->save();
                        break;
                }
            }else{
                switch (strtolower(($status))){
                    case 'baru':
                        if (strpos(strtolower($all[$j]->t_titlen_desc),'review') !== false){
                            $proposal = Proposal::where('id',$all[$j]->t_titlen_uid)->get();
                            $pm = new ProposalMessage();
                            $pm->id_proposal = $all[$j]->t_titlen_uid;
                            $pm->id_sender = $proposal[0]->id_inovator;
                            $pm->id_receiver = 0;
                            $pm->sender = 'Inovator';
                            $pm->receiver = 'Reviewer';
                            $pm->judul = "[BIC] Review Proposal - ".$proposal[0]->judul;
                            $pm->isi = $all[$j]->t_titlen_desc;
                            $pm->inserted_by = $proposal[0]->id_inovator;
                            $pm->updated_by = $proposal[0]->id_inovator;
                            $pm->status =1;
                            $pm->save();
                        }
                        break;
                    case 'review':
                        $proposal = Proposal::where('id',$all[$j]->t_titlen_uid)->get();
                        $pm = new ProposalMessage();
                        $pm->id_proposal = $all[$j]->t_titlen_uid;
                        $pm->id_sender = 0;
                        $pm->id_receiver = $proposal[0]->id_inovator;
                        $pm->sender = 'Reviewer';
                        $pm->receiver = 'Inovator';
                        if (strpos(strtolower($all[$j]->t_titlen_desc),'revisi') !== false){
                            $pm->judul = "[BIC] Revisi Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'inreview') !== false){
                            $pm->judul = "[BIC] In Review Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'discontinued') !== false){
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'listed') !== false){
                            $pm->judul = "[BIC] Simpan Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'approved') !== false){
                            $pm->judul = "[BIC] Approved Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'ditolak') !== false){
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'revisi') !== false){
                            $pm->judul = "[BIC] Revisi Proposal - ".$proposal[0]->judul;
                        }else{
                            $pm->judul = "[BIC] Unknown Proposal Status - ".$proposal[0]->judul;
                        }
                        $pm->isi = $all[$j]->t_titlen_desc;
                        $pm->inserted_by = $proposal[0]->id_inovator;
                        $pm->updated_by = $proposal[0]->id_inovator;
                        $pm->status =1;
                        $pm->save();
                        break;
                    case 'revisi':
                        $pm = new ProposalMessage();
                        $proposal = Proposal::where('id',$all[$j]->t_titlen_uid)->get();
                        if (strpos(strtolower($all[$j]->t_titlen_desc),'review') !== false){
                            $pm->id_sender = $proposal[0]->id_inovator;
                            $pm->id_receiver = 0;
                            $pm->sender = 'Inovator';
                            $pm->receiver = 'Reviewer';
                            $pm->judul = "[BIC] Review Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $proposal[0]->id_inovator;
                            $pm->updated_by = $proposal[0]->id_inovator;

                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'discontinued') !== false){
                            $pm->id_sender = 0;
                            $pm->id_receiver = $proposal[0]->id_inovator;
                            $pm->sender = 'Reviewer';
                            $pm->receiver = 'Inovator';
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $all[$j]->t_titlen_userid;
                            $pm->updated_by = $all[$j]->t_titlen_userid;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'inreview') !== false){
                            $pm->id_sender = 0;
                            $pm->id_receiver = $proposal[0]->id_inovator;
                            $pm->sender = 'Reviewer';
                            $pm->receiver = 'Inovator';
                            $pm->judul = "[BIC] In Review Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $all[$j]->t_titlen_userid;
                            $pm->updated_by = $all[$j]->t_titlen_userid;
                        }
                        else if (strpos(strtolower($all[$j]->t_titlen_desc),'listed') !== false){
                            $pm->id_sender = 0;
                            $pm->id_receiver = $proposal[0]->id_inovator;
                            $pm->sender = 'Reviewer';
                            $pm->receiver = 'Inovator';
                            $pm->judul = "[BIC] Disimpan Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $all[$j]->t_titlen_userid;
                            $pm->updated_by = $all[$j]->t_titlen_userid;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'approved') !== false){
                            $pm->id_sender = 0;
                            $pm->id_receiver = $proposal[0]->id_inovator;
                            $pm->sender = 'Reviewer';
                            $pm->receiver = 'Inovator';
                            $pm->judul = "[BIC] Approved Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $all[$j]->t_titlen_userid;
                            $pm->updated_by = $all[$j]->t_titlen_userid;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'ditolak') !== false){
                            $pm->id_sender = 0;
                            $pm->id_receiver = $proposal[0]->id_inovator;
                            $pm->sender = 'Reviewer';
                            $pm->receiver = 'Inovator';
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $all[$j]->t_titlen_userid;
                            $pm->updated_by = $all[$j]->t_titlen_userid;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'revisi') !== false){
                            $pm->id_sender = 0;
                            $pm->id_receiver = $proposal[0]->id_inovator;
                            $pm->sender = 'Reviewer';
                            $pm->receiver = 'Inovator';
                            $pm->judul = "[BIC] Revisi Proposal - ".$proposal[0]->judul;
                            $pm->inserted_by = $all[$j]->t_titlen_userid;
                            $pm->updated_by = $all[$j]->t_titlen_userid;
                        }else{
                            $pm->id_sender = 0;
                            $pm->id_receiver = $proposal[0]->id_inovator;
                            $pm->sender = 'Reviewer';
                            $pm->receiver = 'Inovator';
                            $pm->judul = "[BIC] Unknown Proposal Status - ".$proposal[0]->judul;
                            $pm->inserted_by = $all[$j]->t_titlen_userid;
                            $pm->updated_by = $all[$j]->t_titlen_userid;
                        }
                        $pm->status =1;
                        $pm->isi = $all[$j]->t_titlen_desc;
                        $pm->id_proposal = $all[$j]->t_titlen_uid;
                        $pm->save();
                        break;
                    case 'inreview':
                        $proposal = Proposal::where('id',$all[$j]->t_titlen_uid)->get();
                        $pm = new ProposalMessage();
                        $pm->id_proposal = $all[$j]->t_titlen_uid;
                        $pm->id_sender = 0;
                        $pm->id_receiver = $proposal[0]->id_inovator;
                        $pm->sender = 'Reviewer';
                        $pm->receiver = 'Inovator';
                        if (strpos(strtolower($all[$j]->t_titlen_desc),'revisi') !== false){
                            $pm->judul = "[BIC] Revisi Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'seleksi') !== false){
                            $pm->judul = "[BIC] In Review Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'discontinued') !== false){
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'listed') !== false){
                            $pm->judul = "[BIC] Simpan Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'approved') !== false){
                            $pm->judul = "[BIC] Approved Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'ditolak') !== false){
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'inreview') !== false){
                            $pm->judul = "[BIC] In Review Proposal - ".$proposal[0]->judul;
                        }else{
                            $pm->judul = "[BIC] Unknown Proposal Status - ".$proposal[0]->judul;
                        }
                        $pm->isi = $all[$j]->t_titlen_desc;
                        $pm->inserted_by = $proposal[0]->id_inovator;
                        $pm->updated_by = $proposal[0]->id_inovator;
                        $pm->status =1;
                        $pm->save();
                        break;
                    case 'seleksi':
                        $proposal = Proposal::where('id',$all[$j]->t_titlen_uid)->get();
                        $pm = new ProposalMessage();
                        $pm->id_proposal = $all[$j]->t_titlen_uid;
                        $pm->id_sender = 0;
                        $pm->id_receiver = $proposal[0]->id_inovator;
                        $pm->sender = 'Reviewer';
                        $pm->receiver = 'Inovator';
                        if (strpos(strtolower($all[$j]->t_titlen_desc),'listed') !== false){
                            $pm->judul = "[BIC] Simpan Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'discontinued') !== false){
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'approved') !== false){
                            $pm->judul = "[BIC] Approved Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'inreview') !== false){
                            $pm->judul = "[BIC] In Review Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'ditolak') !== false){
                            $pm->judul = "[BIC] Discontinued Proposal - ".$proposal[0]->judul;
                        }else if (strpos(strtolower($all[$j]->t_titlen_desc),'seleksi') !== false){
                            $pm->judul = "[BIC] Seleksi Proposal - ".$proposal[0]->judul;
                        }else{
                            $pm->judul = "[BIC] Unknown Proposal Status - ".$proposal[0]->judul;
                        }
                        $pm->isi = $all[$j]->t_titlen_desc;
                        $pm->inserted_by = $proposal[0]->id_inovator;
                        $pm->updated_by = $proposal[0]->id_inovator;
                        $pm->status =1;
                        $pm->save();
                        break;
                }
            }
        }
    }

    public function manual(){
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.home.manual',compact('kategoriMenu','buku'));
    }

    public function inovator(){
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.home.inovator',compact('kategoriMenu','buku'));
    }

    public function detailInovator($id){
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        switch ($id){
            case '1':
                return view('jayakari.bic.general::pages.home.inovatorDashboard',compact('kategoriMenu','buku'));
                break;
            case '2':
                return view('jayakari.bic.general::pages.home.inovatorProfile',compact('kategoriMenu','buku'));
                break;
            case '3':
                return view('jayakari.bic.general::pages.home.inovatorProposal',compact('kategoriMenu','buku'));
                break;
            case '4':
                return view('jayakari.bic.general::pages.home.inovatorMessage',compact('kategoriMenu','buku'));
                break;
        }
    }

    public function reviewer(){
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.home.reviewer',compact('kategoriMenu','buku'));
    }

    public function detailReviewer($id){
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        switch ($id){
            case '1':
                return view('jayakari.bic.general::pages.home.reviewerDashboard',compact('kategoriMenu','buku'));
                break;
            case '2':
                return view('jayakari.bic.general::pages.home.reviewerProfile',compact('kategoriMenu','buku'));
                break;
            case '3':
                return view('jayakari.bic.general::pages.home.reviewerProposal',compact('kategoriMenu','buku'));
                break;
            case '4':
                return view('jayakari.bic.general::pages.home.reviewerMessage',compact('kategoriMenu','buku'));
                break;
        }
    }

    public function adminProses(){
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.home.adminProses',compact('kategoriMenu','buku'));
    }

    public function detailAdminProses($id){
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        switch ($id){
            case '1':
                return view('jayakari.bic.general::pages.home.adminProsesDashboard',compact('kategoriMenu','buku'));
                break;
            case '2':
                return view('jayakari.bic.general::pages.home.adminProsesProfile',compact('kategoriMenu','buku'));
                break;
            case '3':
                return view('jayakari.bic.general::pages.home.adminProsesPenjurian',compact('kategoriMenu','buku'));
                break;
            case '4':
                return view('jayakari.bic.general::pages.home.adminProsesProposal',compact('kategoriMenu','buku'));
                break;
            case '5':
                return view('jayakari.bic.general::pages.home.adminProsesMessage',compact('kategoriMenu','buku'));
                break;
        }
    }

    public function juri(){
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.home.juri',compact('kategoriMenu','buku'));
    }

    public function detailJuri($id){
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        switch ($id){
            case '1':
                return view('jayakari.bic.general::pages.home.juriDashboard',compact('kategoriMenu','buku'));
                break;
            case '2':
                return view('jayakari.bic.general::pages.home.juriProfile',compact('kategoriMenu','buku'));
                break;
            case '3':
                return view('jayakari.bic.general::pages.home.juriPenilaian',compact('kategoriMenu','buku'));
                break;
            case '4':
                return view('jayakari.bic.general::pages.home.juriHistoryPenilaian',compact('kategoriMenu','buku'));
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
        $buku = Buku::orderBy('tgl_pembuatan','asc')->get();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.home.registrasi',[
            "buku"=>$buku,
            "labels"=>$labels,
            "kategoriMenu"=>$kategoriMenu
        ]);
    }

    public function registrasiseminar(){
        $TAR = DictionaryKategori::where('kode','TAR')->get()[0]->dictionary[0]->isi;
        $PAR = DictionaryKategori::where('kode','PAR')->get()[0]->dictionary[0]->isi;
        $labels = array(
            "TAR"=>$TAR,
            "PAR"=>$PAR
        );
        $buku = Buku::orderBy('tgl_pembuatan','asc')->get();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.home.registrasiseminar',[
            "buku"=>$buku,
            "labels"=>$labels,
            "kategoriMenu"=>$kategoriMenu
        ]);
    }

    public function saveRegistrasiSeminar(Request $request){
        $data = $request->input('data');
        $json = json_decode($data);
        //send data to participant
        $emailTo = $json->email;
        Mail::send('jayakari.bic.general::pages.home.email',['data'=>$data],function($message) use($emailTo){
            $message->subject('[Seminar dan Workshop] Terimakasih atas registrasi Anda');
            $message->from('info@bic.web.id','Business Inovation Center (BIC)');
            $message->to($emailTo);
            $message->bcc('dragonif01@gmail.com');
        });

        //send data to BIC
        Mail::send('jayakari.bic.general::pages.home.emailInternal',['data'=>$data],function($message){
            $message->subject('[Seminar dan Workshop] Registrasi Peserta Baru');
            $message->from('info@bic.web.id','Business Inovation Center (BIC)');
            $message->to('info@bic.web.id');
            $message->bcc('dragonif01@gmail.com');
        });

        $result = array(
            "sender" => "bic",
            "status" => 'success'
        );
        return response()->json($result);
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
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.home.terimakasih',[
            "kategoriMenu"=>$kategoriMenu,
            "buku"=>$buku,
            "labels"=>$labels
        ]);
    }

    public function terimakasihSeminar(){
        $TTR = DictionaryKategori::where('kode','TTR')->get()[0]->dictionary[0]->isi;
        $PTR = DictionaryKategori::where('kode','PTR')->get()[0]->dictionary[0]->isi;
        $labels = array(
            "TTR"=>$TTR,
            "PTR"=>$PTR
        );
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.home.terimakasihseminar',[
            "kategoriMenu"=>$kategoriMenu,
            "buku"=>$buku,
            "labels"=>$labels
        ]);
    }

    public function viewVideo($videoid){
        return view('jayakari.bic.general::pages.home.viewVideo',[
            "videoid"=>$videoid
        ]);
    }

    public function migrasi(){
        $banner = Banner::orderBy('id','desc')->get();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        $tempDatabase = TempDatabaseAll::all();
        //mapping data
        foreach($tempDatabase as $item){
            $buku = Buku::where('judul',$item->field_buku_inovasi_indonesia)->get()[0];
            $str_arn = '';
            if ($item->field_agenda_riset_nasional == 'Lain-Lain'){
                $str_arn .= strtoupper($item->field_agenda_riset_nasional);
            }else{
                $arr = explode(' ',$item->field_agenda_riset_nasional);
                if (strtolower($arr[1]) == 'tik'){
                    $str_arn .= 'ICT';
                }else{
                    $num = count($arr);
                    $str_arr ='';
                    for($i=1;$i<$num;$i++){
                        if ($i == $num-1){
                            $str_arr .= $arr[$i];
                        }else{
                            $str_arr .= $arr[$i].' ';
                        }
                    }
                    if (strtolower($str_arr) == 'sehat obat'){
                        $str_arn .= 'SEHAT-OBAT';
                    }else if(strtolower($str_arr) == 'material maju'){
                        $str_arn .= 'MATERIAL';
                    }else if(strtolower($str_arr) == 'transportasi'){
                        $str_arn .= 'TRANSPORT';
                    }else if(strtolower($str_arr) == 'hankam'){
                        $str_arn .= 'PERTAHANAN';
                    }else{
                        $str_arn .= strtoupper($str_arr);
                    }
                }
            }
            $arn = ARN::where('kode',$str_arn)->get()[0];
            $id_teknologi = '';
            $arr_teknologi = explode(',',$tempDatabase[0]->field_kategori_teknologi);
            $num = count($arr_teknologi);
            for($i=0;$i<$num;$i++){
                $teknologi_space = explode(' ',trim($arr_teknologi[$i]));
                $num_tek = count($teknologi_space);
                $tek = '';
                for($j=1;$j<$num_tek;$j++){
                    if ($j == $num_tek-1){
                        $tek .= $teknologi_space[$j];
                    }else{
                        $tek .= $teknologi_space[$j].' ';
                    }
                }
                $teknologi = \jayakari\bic\admin\Models\KataKunciTeknologi::where('kata_kunci',trim($tek))->get()[0];
                //$teknologi = KataKunciTeknologi::where('kata_kunci','LIKE','%'.trim($tek).'%')->get()[0];
                if ($i == $num-1){
                    $id_teknologi .=$teknologi->id;
                }else{
                    $id_teknologi .=$teknologi->id.',';
                }
            }
            $id_aplikasi = '';
            if (($item->field_kategori_aplikasi == NULL) || ($item->field_kategori_aplikasi == 'NULL') || ($item->field_kategori_aplikasi == '') ){
                $aplikasi = KataKunciTeknologi::where('kata_kunci','OTHER')->get()[0];
                $id_aplikasi .=$aplikasi->id;
            }else{
                $arr_aplikasi = explode(',',$item->field_kategori_aplikasi);
                $num = count($arr_aplikasi);
                for($i=0;$i<$num;$i++){
                    $aplikasi_space = explode(' ',trim($arr_aplikasi[$i]));
                    $num_apps = count($aplikasi_space);
                    $apps = '';
                    for($j=1;$j<$num_apps;$j++){
                        if ($j == $num_apps-1){
                            $apps .= $aplikasi_space[$j];
                        }else{
                            $apps .= $aplikasi_space[$j].' ';
                        }
                    }
                    $aplikasi = KataKunciTeknologi::where('kata_kunci',trim($apps))->get()[0];
                    if ($i == $num-1){
                        $id_aplikasi .=$aplikasi->id;
                    }else{
                        $id_aplikasi .=$aplikasi->id.',';
                    }
                }
            }
            $id_paten = 0;
            switch ($item->field_status_paten){
                case 'Telah Dipatenkan':
                    $id_paten = 1;
                    break;
                case 'Telah Terdaftar':
                    $id_paten = 1;
                    break;
                case "Dalam Proses Pengajuan":
                    $id_paten = 2;
                    break;
                case "Belum Didaftarkan":
                    $id_paten = 3;
                    break;
                case "Tidak Ingin Didaftarkan":
                    $id_paten = 4;
                    break;
            }

            $id_kesiapan_inovasi = 0;
            switch ($item->field_kesiapan_inovasi){
                case '*** Telah Dikomersialkan':
                    $id_kesiapan_inovasi = 1;
                    break;
                case "** Siap Dikomersialkan":
                    $id_kesiapan_inovasi = 2;
                    break;
                case "* Prototype":
                    $id_kesiapan_inovasi = 3;
                    break;
                case "* Prototype Sudah Ada":
                    $id_kesiapan_inovasi = 3;
                    break;
            }

            $id_kerjasama_bisnis = 0;
            switch ($item->field_kerjasama_bisnis){
                case '*** Terbuka':
                    $id_kerjasama_bisnis = 1;
                    break;
                case "** Luas":
                    $id_kerjasama_bisnis = 2;
                    break;
                case "** Luas/Wide":
                    $id_kerjasama_bisnis = 2;
                    break;
                case "* Terbatas":
                    $id_kerjasama_bisnis = 3;
                    break;
                case "* Terbatas/Limited":
                    $id_kerjasama_bisnis = 3;
                    break;
            }

            $id_peringkat_inovasi = 0;
            switch ($item->field_peringkat_inovasi){
                case '*** Paling Prospektif':
                    $id_peringkat_inovasi = 1;
                    break;
                case "** Sangat Prospektif":
                    $id_peringkat_inovasi = 2;
                    break;
                case "* Prospektif":
                    $id_peringkat_inovasi = 3;
                    break;
            }
            $isibuku = BukuIsi::create([
               'id_buku'=>$buku->id,
                'id_proposal'=>$item->id_proposal,
                'id_arn'=>$arn->id,
                'id_teknologi'=>$id_teknologi,
                'id_aplikasi'=>$id_aplikasi,
                'judul_singkat'=>$item->field_judul_singkat,
                'short_title'=>$item->field_short_title,
                'judul_lengkap'=>$item->field_judul_teknis_proposal_lengkap,
                'deskripsi_singkat'=>$item->field_deskripsi_singkat,
                'short_description'=>$item->field_short_description,
                'perspektif'=>$item->perspektif,
                'keunggulan_inovasi'=>$item->field_keunggulan_inovasi,
                'potensi_aplikasi'=>$item->field_potensi_aplikasi,
                'inovator'=>$item->field_nama_inovator,
                'institusi'=>$item->field_institusi,
                'alamat'=>$item->field_alamat_,
                'id_paten'=>$id_paten,
                'id_kesiapan_inovasi'=>$id_kesiapan_inovasi,
                'id_kerjasama_bisnis'=>$id_kerjasama_bisnis,
                'id_peringkat_inovasi'=>$id_peringkat_inovasi,
                'inserted_by'=>8,
                'updated_by'=>8
            ]);
            if (($item->field_gambar1 == 'NULL') || ($item->field_gambar1 == '')){

            }else{
                $path = 'buku/'.$item->field_gambar1;
                BukuIsiFile::create([
                   'id_isi_buku'=>$isibuku->id,
                    'path'=>$path,
                    'file'=>$item->field_gambar1,
                    'keterangan'=>'Gambar 1'
                ]);
            }
            if (($item->field_gambar2 == 'NULL') || ($item->field_gambar2 == '')){

            }else{
                $path = 'buku/'.$item->field_gambar2;
                BukuIsiFile::create([
                    'id_isi_buku'=>$isibuku->id,
                    'path'=>$path,
                    'file'=>$item->field_gambar2,
                    'keterangan'=>'Gambar 2'
                ]);
            }
        }
        return view('jayakari.bic.general::pages.home.migrasi',[
            "buku"=>$buku,
            "banner"=>$banner,
            "kategoriMenu"=>$kategoriMenu,
            'tempDatabase'=>$tempDatabase
        ]);
    }

    public function about(){
        $TTR = DictionaryKategori::where('kode','TTR')->get()[0]->dictionary[0]->isi;
        $PTR = DictionaryKategori::where('kode','PTR')->get()[0]->dictionary[0]->isi;
        $labels = array(
            "TTR"=>$TTR,
            "PTR"=>$PTR
        );
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.home.about',[
            "kategoriMenu"=>$kategoriMenu,
            "buku"=>$buku,
            "labels"=>$labels
        ]);
    }

    public function aboutBIC(){
        $TTR = DictionaryKategori::where('kode','TTR')->get()[0]->dictionary[0]->isi;
        $PTR = DictionaryKategori::where('kode','PTR')->get()[0]->dictionary[0]->isi;
        $labels = array(
            "TTR"=>$TTR,
            "PTR"=>$PTR
        );
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.home.aboutbic',[
            "kategoriMenu"=>$kategoriMenu,
            "buku"=>$buku,
            "labels"=>$labels
        ]);
    }

    public function testimoni(){
        $TTR = DictionaryKategori::where('kode','TTR')->get()[0]->dictionary[0]->isi;
        $PTR = DictionaryKategori::where('kode','PTR')->get()[0]->dictionary[0]->isi;
        $labels = array(
            "TTR"=>$TTR,
            "PTR"=>$PTR
        );
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        return view('jayakari.bic.general::pages.home.testimoni',[
            "kategoriMenu"=>$kategoriMenu,
            "buku"=>$buku,
            "labels"=>$labels
        ]);
    }

    public function index(){
        $latestNewses = News::where('is_active',1)->orderBy('tanggal','desc')->take(12)->get();
        $latestNews = array();
        foreach ($latestNewses as $item){
            $inner = new \stdClass();
            $inner->id = $item->id;
            $inner->judul = $item->judul;
            $inner->image = $item->image;
            $latestNews[] = $inner;
        }
        $banner = Buku::whereNotNull('cover_inreview')->orderBy('id','desc')->get()[0];
        $challenger = Buku::whereNotNull('cover_inreview')->orderBy('id','desc')->get()[0];
        $books = Buku::WhereNotNull('book_final')->orderBy('id','desc')->get();
        $videos = Videos::where('is_active',1)->orderBy('id','desc')->get();
        $statusProposal = StatusProposal::all();
        $statistic = array();
        $index = 0;
        $total = 0;
        $pro = DB::table('bic_proposal')
                    ->select('status',DB::raw('count(*) as total'))
                    ->groupBy('status')
                    ->orderBy('status','asc')
                    ->get();
        $num = count($pro);
        foreach($statusProposal as $item){
            $found = false;
            for($i=0;$i<$num&&!$found;$i++){
                if ($item->id == $pro[$i]->status){
                    $found = true;
                    $statistic[$index]['status'] = $item->status;
                    $total += $pro[$i]->total;
                    $statistic[$index]['jumlah'] = $pro[$i]->total;
                    $index++;
                }
            }
            if (!$found){
                $statistic[$index]['status'] = $item->status;
                $statistic[$index]['jumlah'] = 0;
                $index++;
            }
            //$proposal = Proposal::where('status',$item->id)->get()->count();
        }
        //$user = User::select('id')->get()->count();
        //$total = Proposal::select('id')->get()->count();
        /*$user = 0;
        foreach (User::select('id')->cursor() as $item){
            $user++;
        }*/
        $usr = DB::table('bic_user')
                ->select(DB::raw('count(*) as total'))
                ->get();
        $user = $usr[0]->total;
        /*foreach (Proposal::select('id')->cursor() as $item){
            $total++;
        }*/
        $faq_inoina = FAQ::where('faq_type','Inovasi Indonesia')->get();
        $faq_torina = FAQ::where('faq_type','Inovator Indonesia')->get();
        $faq_proina = FAQ::where('faq_type','Proposal Inovasi')->get();
        $faq_incina = FAQ::where('faq_type','E-Incubator BIC')->get();
        $faq = array();
        foreach (FAQ::orderBy('id','desc')->cursor() as $item){
            $faq[] = $item;
        }
        $BHV = DictionaryKategori::where('kode','BHV')->get()[0]->dictionary[0]->isi;
        $PIB = DictionaryKategori::where('kode','PIB')->get()[0]->dictionary[0]->isi;
        $EIB = DictionaryKategori::where('kode','EIB')->get()[0]->dictionary[0]->isi;
        $BICU = DictionaryKategori::where('kode','BICU')->get()[0]->dictionary[0]->isi;
        $BICS = DictionaryKategori::where('kode','BICS')->get()[0]->dictionary[0]->isi;
        $BICA = DictionaryKategori::where('kode','BICA')->get()[0]->dictionary[0]->isi;
        $BICP = DictionaryKategori::where('kode','BICP')->get()[0]->dictionary[0]->isi;
        $labels = array(
            "BHV"=>$BHV,
            "PIB"=>$PIB,
            "EIB"=>$EIB,
            "BICU"=>$BICU,
            "BICS"=>$BICS,
            "BICA"=>$BICA,
            "BICP"=>$BICP
        );
        return view('jayakari.bic.general::pages.home.index',compact('latestNews','statistic','videos','user','total','labels','banner','challenger','books','faq_inoina','faq_torina','faq_proina','faq_incina','faq'));
    }

    public function newLayout1(){
        //$kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        //$buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        $latestNews = News::where('is_active',1)->orderBy('tanggal','desc')->take(12)->get();
        $statusProposal = StatusProposal::all();
        $statistic = array();
        $index = 0;
        foreach($statusProposal as $item){
            $statistic[$index]['status'] = $item->status;
            $proposal = Proposal::where('status',$item->id)->get();
            $statistic[$index]['jumlah'] = count($proposal);
            $index++;
        }
        $user = count(User::all());
        $total = count(Proposal::all());
        return view('jayakari.bic.general::pages.home.new',compact('latestNews','statistic','user','total'));
    }

    public function faq(Request $request){
        $id = $request->input('data');
        $faq = FAQ::where('id',$id)->get()[0];

        $result = array(
            "sender" => "bic",
            "status" => 'success',
            "message"=>$faq->answer
        );
        return response()->json($result);
    }
}