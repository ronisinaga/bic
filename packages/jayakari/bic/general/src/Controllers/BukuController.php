<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 7/3/2018
 * Time: 3:21 PM
 */

namespace jayakari\bic\general\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use jayakari\bic\admin\Models\ARN;
use jayakari\bic\admin\Models\Batch;
use jayakari\bic\admin\Models\Buku;
use jayakari\bic\admin\Models\BukuIsi;
use jayakari\bic\admin\Models\BukuIsiComment;
use jayakari\bic\admin\Models\BukuIsiFile;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\ProposalPemenangFile;
use jayakari\bic\admin\Models\User;
use jayakari\bic\admin\Models\UserMenuCategory;

class BukuController extends Controller
{
    public function index($judul){
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        $currbuku = Buku::where('judul',$judul)->get()[0];
        //$books = Buku::where('id_batch',$currbuku->id_batch)->get();
        $winner = false;
        if (!str_contains($judul, 'challenger')) {
            $winner = true;
        }
        /*if (count($books) > 1){
            $id_buku = $books[0]->id;
        }else{
            $id_buku = $currbuku->id;
        }*/
        //$isibukus = BukuIsi::where('id_buku',$id_buku)->orderBy('judul_singkat','asc')->get();
        $isibukus = BukuIsi::where('id_buku',$currbuku->id)->orderBy('judul_singkat','asc')->get();
        $isibuku = array();
        $winnertext = '';
        if (!$winner){
            $winnertext = 'false';
            foreach ($isibukus as $item){
                if ($item->proposal->status == 5 || $item->proposal->status == 6){
                    $isibuku[] = $item;
                }
            }
        }else{
            $winnertext = 'true';
            foreach ($isibukus as $item){
                if ($item->proposal->status == 8){
                    $isibuku[] = $item;
                }
            }
        }
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.buku.index',[
            "buku"=>$buku,
            "currbuku"=>$currbuku,
            "isibuku"=>$isibuku,
            "judul"=>$judul,
            "sort"=>'judul',
            "winnertext"=>$winnertext,
            "kategoriMenu"=>$kategoriMenu,
        ]);
    }

    public function inreview(Request $request){
        $batch = Batch::where('is_finished',0)->get();
        if (count($batch) > 0){
            $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
            $currbuku = Buku::where('id_batch',$batch[0]->id)->get();
            $isibuku = array();
            if (count($currbuku) > 0){
                $isibuku = BukuIsi::where('id_buku',$currbuku[0]->id)->orderBy('judul_singkat','asc')->get();
            }
        }else{
            $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
            $currbuku = array();
            $isibuku = array();
        }
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.buku.inreview',[
            "buku"=>$buku,
            "currbuku"=>$currbuku,
            "isibuku"=>$isibuku,
            "sort"=>'judul',
            "kategoriMenu"=>$kategoriMenu,
        ]);
    }

    public function alphabet($judul,$sort='judul',$alphabet=' a'){
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        $currbuku = Buku::where('judul',$judul)->get()[0];
        if ($sort == 'judul'){
            $isibuku = BukuIsi::where('id_buku',$currbuku->id)
                ->where('judul_singkat','like',$alphabet.'%')->orderBy('judul_singkat','asc')->get();
        }else if ($sort == 'title'){
            $isibuku = BukuIsi::where('id_buku',$currbuku->id)
                ->where('short_title','like',$alphabet.'%')->orderBy('short_title','asc')->get();
        }
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.buku.index',[
            "buku"=>$buku,
            "currbuku"=>$currbuku,
            "isibuku"=>$isibuku,
            "judul"=>$judul,
            "sort"=>$sort,
            "kategoriMenu"=>$kategoriMenu,
        ]);
    }

    public function sort($judul,$sort='judul'){
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        $currbuku = Buku::where('judul',$judul)->get()[0];
        if ($sort == 'judul'){
            $isibuku = BukuIsi::where('id_buku',$currbuku->id)->orderBy('judul_singkat','asc')->get();
        }else if ($sort == 'title'){
            $isibuku = BukuIsi::where('id_buku',$currbuku->id)->orderBy('short_title','asc')->get();
        }
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.buku.index',[
            "buku"=>$buku,
            "currbuku"=>$currbuku,
            "isibuku"=>$isibuku,
            "judul"=>$judul,
            "sort"=>$sort,
            "kategoriMenu"=>$kategoriMenu,
        ]);
    }

    public function view($judul){
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        $title = urldecode($judul);
        $title = str_replace('~','+',$title);
        $isibuku = BukuIsi::where('judul_singkat',trim($title))->get()[0];
        $proposal = Proposal::where('id',$isibuku->id_proposal)->get()[0];
        $books = Buku::where('id_batch',$isibuku->buku->id_batch)->get();
        $book = '';
        if (count($books) > 1){
            if ($proposal->status == 8){
                foreach ($books as $item){
                    if (!str_contains(strtolower($item->judul),'challenger')){
                        $book = $item->judul;
                    }
                }
            }else if ($proposal->status == 5 || $proposal->status == 6){
                foreach ($books as $item){
                    if (str_contains(strtolower($item->judul),'challenger')){
                        $book = $item->judul;
                    }
                }
            }
        }
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.buku.view',[
            "buku"=>$buku,
            "isibuku"=>$isibuku,
            "proposal"=>$proposal,
            "judul"=>$judul,
            "sort"=>'judul',
            'nickname'=>$proposal->user->nickname,
            'book'=>$book,
            "kategoriMenu"=>$kategoriMenu,
        ]);
    }

    public function viewProposal($id){
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        $proposal = Proposal::where('id',$id)->get()[0];
        $isibuku = BukuIsi::where('id_proposal',$id)->get()[0];
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.buku.proposal',[
            "buku"=>$buku,
            "proposal"=>$proposal,
            'isibuku'=>$isibuku,
            "kategoriMenu"=>$kategoriMenu,
        ]);
    }

    public function viewProposalInReview($id){
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        $proposal = Proposal::where('id',$id)->get()[0];
        $isibuku = BukuIsi::where('id_proposal',$id)->get()[0];
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.buku.proposalinreview',[
            "buku"=>$buku,
            "proposal"=>$proposal,
            'isibuku'=>$isibuku,
            "kategoriMenu"=>$kategoriMenu,
        ]);
    }

    public function kategori($kategori){
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        $arn = 0;
        switch ($kategori){
            case 'pangan':
                $arn = 1;
                break;
            case 'energi':
                $arn = 2;
                break;
            case 'transport':
                $arn = 3;
                break;
            case 'tik':
                $arn = 4;
                break;
            case 'hankam':
                $arn = 5;
                break;
            case 'kesehatan':
                $arn = 6;
                break;
            case 'material':
                $arn = 7;
                break;
            case 'sosial':
                $arn = 8;
                break;
            case 'lainnya':
                $arn = 9;
                break;
        }
        $isibuku = BukuIsi::where('id_arn',$arn)->orderBy('judul_singkat','asc')->get();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.buku.kategori',[
            "buku"=>$buku,
            "kategori"=>$kategori,
            "isibuku"=>$isibuku,
            "sort"=>'judul',
            "kategoriMenu"=>$kategoriMenu,
        ]);
    }

    public function kategoriAlphabet($kategori,$sort='judul',$alphabet=' a'){
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        switch ($kategori){
            case 'pangan':
                $arn = 1;
                break;
            case 'energi':
                $arn = 2;
                break;
            case 'transport':
                $arn = 3;
                break;
            case 'tik':
                $arn = 4;
                break;
            case 'hankam':
                $arn = 5;
                break;
            case 'kesehatan':
                $arn = 6;
                break;
            case 'material':
                $arn = 7;
                break;
            case 'sosial':
                $arn = 8;
                break;
            case 'lainnya':
                $arn = 9;
                break;
        }
        if ($sort == 'judul'){
            $isibuku = BukuIsi::where('id_arn',$arn)
                ->where('judul_singkat','like',$alphabet.'%')->orderBy('judul_singkat','asc')->get();
        }else if ($sort == 'title'){
            $isibuku = BukuIsi::where('id_arn',$arn)
                ->where('short_title','like',$alphabet.'%')->orderBy('short_title','asc')->get();
        }
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.buku.kategori',[
            "buku"=>$buku,
            "kategori"=>$kategori,
            "isibuku"=>$isibuku,
            "sort"=>$sort,
            "kategoriMenu"=>$kategoriMenu,
        ]);
    }

    public function kategoriSort($kategori,$sort='judul'){
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        switch ($kategori){
            case 'pangan':
                $arn = 1;
                break;
            case 'energi':
                $arn = 2;
                break;
            case 'transport':
                $arn = 3;
                break;
            case 'tik':
                $arn = 4;
                break;
            case 'hankam':
                $arn = 5;
                break;
            case 'kesehatan':
                $arn = 6;
                break;
            case 'material':
                $arn = 7;
                break;
            case 'sosial':
                $arn = 8;
                break;
            case 'lainnya':
                $arn = 9;
                break;
        }
        if ($sort == 'judul'){
            $isibuku = BukuIsi::where('id_arn',$arn)->orderBy('judul_singkat','asc')->get();
        }else if ($sort == 'title'){
            $isibuku = BukuIsi::where('id_arn',$arn)->orderBy('short_title','asc')->get();
        }
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.buku.kategori',[
            "buku"=>$buku,
            "kategori"=>$kategori,
            "isibuku"=>$isibuku,
            "sort"=>$sort,
            "kategoriMenu"=>$kategoriMenu,
        ]);
    }

    public function download($id){
        $file = BukuIsiFile::where('id',$id)->get()[0];
        return response()->download(public_path().'/storage/'.$file->path,$file->file);
    }

    public function downloadFile($id){
        $file = ProposalPemenangFile::where('id',$id)->get()[0];
        return response()->download(public_path().'/storage/'.$file->path,$file->name);
    }

    public function inreviewPage(Request $request){
        $batch = Batch::where('is_finished',0)->get();
        $buku = array();
        $proposal = array();
        if (count($batch) > 0){
            $batch = $batch[0];
            $book = Buku::where('id_batch',$batch->id)->orderBy('tgl_pembuatan','desc')->get();
            if (count($book) > 0){
                $book = $book[0];
                $proposal = DB::table('bic_buku_isi as buku')
                    ->where('id_buku',$book->id)
                    ->join('bic_proposal as pro','buku.id_proposal','pro.id')
                    ->whereIn('pro.status',[5,6,7])
                    ->select('buku.*')
                    ->get();
                $num = count($proposal);
                for($i=0;$i<$num;$i++){
                    $currbuku = Buku::where('id',$proposal[$i]->id_buku)->get()[0];
                    $pro = Proposal::where('id',$proposal[$i]->id_proposal)->get()[0];
                    $arn = ARN::where('id',$proposal[$i]->id_arn)->get()[0];
                    $proposal[$i]->buku_judul = $currbuku->judul;
                    $proposal[$i]->arn = $arn->arn;
                }
            }
        }
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.buku.inreviewPage',[
            'buku'=>$buku,
            "isibuku"=>$proposal,
            "kategoriMenu"=>$kategoriMenu,
        ]);
    }

    public function inreviewTitle($judul){
        $buku = Buku::orderBy('tgl_pembuatan','desc')->get();
        $title = urldecode($judul);
        $title = str_replace('~','+',$title);
        $isibuku = BukuIsi::where('judul_singkat',$title)->get()[0];
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        $proposal = Proposal::where('id',$isibuku->id_proposal)->get()[0];
        $comments = BukuIsiComment::where('id_isi_buku',$isibuku->id)->get();
        return view('jayakari.bic.general::pages.buku.inreviewTitle',[
            "buku"=>$buku,
            "isibuku"=>$isibuku,
            "proposal"=>$proposal,
            "judul"=>$judul,
            "sort"=>'judul',
            'comments'=>$comments,
            'nickname'=>$proposal->user->nickname,
            "kategoriMenu"=>$kategoriMenu,
        ]);
    }

    public function downloadFileInReview($id){
        $file = BukuIsiFile::where('id',$id)->get()[0];
        return response()->download(public_path().'/storage/'.$file->path,$file->file);
    }

    public function incubator(Request $request){
        $proposal = Proposal::where([
            'status'=>8
        ])->orderBy('id','desc')
        ->get();
        $bukuisi = array();
        foreach($proposal as $item){
            $inner = BukuIsi::where([
                'id_proposal'=>$item->id
            ])->get();
            if (count($inner) > 0){
                $inner[0]->uploader = $item->user->fullname;
                $bukuisi[] = $inner[0];
            }
        }
        $buku = Buku::orderBy('id','desc')->get();
        $kategoriMenu = UserMenuCategory::where('id_user_kategori',8)->get();
        return view('jayakari.bic.general::pages.buku.incubator', [
            "buku" => $buku,
            'bukuisi'=>$bukuisi,
            "kategoriMenu"=>$kategoriMenu
        ]);
    }
}