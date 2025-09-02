<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 12/27/2017
 * Time: 2:09 PM
 */

namespace jayakari\bic\admin\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use jayakari\bic\admin\Models\ARN;
use jayakari\bic\admin\Models\Development;
use jayakari\bic\admin\Models\Dictionary;
use jayakari\bic\admin\Models\DictionaryKategori;
use jayakari\bic\admin\Models\Employee;
use jayakari\bic\admin\Models\Instansi;
use jayakari\bic\admin\Models\KataKunciTeknologi;
use jayakari\bic\admin\Models\Proposal;
use jayakari\bic\admin\Models\ProposalMessage;
use jayakari\bic\admin\Models\RSC;
use jayakari\bic\admin\Models\User;


class EmailController extends Controller
{

    private $kategorilabel = 'message';

    function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    /*
     * New function
     */

    public function send(User $user){
        //$email = $request

        $title="Terimakasih...";
        $content = '';
        switch($user->jk){
            case "Pria":
                $content="Terimakasih kami ucapkan kepada Bapak <b>".$user->fullname.'</b> yang memiliki keinginan bergabung dengan BIC. Dalam 5 hari kerja kami akan memverifikasi data yang anda kirimkan';
                break;
            case "Wanita":
                $content="Terimakasih kami ucapkan kepada Ibu <b>".$$user->fullname.'</b> yang memiliki keinginan bergabung dengan BIC. Dalam 5 hari kerja kami akan memverifikasi data yang anda kirimkan';
                break;
        }
        $emailTo = $user->email;
        Mail::send('jayakari.bic.admin::pages.email.terimakasih',['title'=>'Terimakasih...','content'=>$content],function($message) use($emailTo){
            $message->subject('[BIC] Terimakasih telah memilih BIC...');
            $message->from('info@bic.web.id','Business Inovation Center (BIC)');
            $message->to($emailTo);
        });
    }

    public function sendAktivasi(User $user){
        $kategoriDictionary = DictionaryKategori::where('kode','EWI')->get();
        $dictionary = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','JPE')->get();
        $jpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();

        //$subject = '[BIC] - Revisi proposal '.$proposal->judul;
        $content = $dictionary[0]->isi;
        $content = str_replace("{inovator}",$user->fullname."</b>",$content);
        $content = str_replace("{username}",$user->email,$content);
        $content = str_replace("{password}",$user->password,$content);
        $content = str_replace("{pengirim}",$jpe[0]->isi,$content);

        $emailTo = $user->email;
        Mail::send('jayakari.bic.admin::pages.email.aktivasi',['title'=>'Selamat...','content'=>$content,'user'=>$user],function($message) use($emailTo){
            $message->subject('[BIC] Aktivasi Account');
            $message->from('info@bic.web.id','Business Inovation Center (BIC)');
            $message->to($emailTo);
        });
    }

    public function sendDeaktivasi(User $user){
        $emailTo = $user->email;
        Mail::send('jayakari.bic.admin::pages.email.deaktivasi',['title'=>'Mohon Maaf...','user'=>$user],function($message) use($emailTo){
            $message->subject('[BIC] De Aktivasi Account');
            $message->from('info@bic.web.id','Business Inovation Center (BIC)');
            $message->to($emailTo);
        });
    }

    public function askReview($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposal = Proposal::where('id',$id)->get();
            $development = Development::where('id',$proposal[0]->id_development)->get();
            $arn = ARN::where('id',$proposal[0]->id_arn)->get();
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
            $inovasiMember = array();
            $member = new \stdClass();
            $member->name = $proposal[0]->user->fullname;;
            $member->jabatan = 'Pengupload proposal';
            $inovasiMember[0] = $member;
            $index = 1;
            foreach($proposal[0]->inovasiMember as $item){
                $rsc = RSC::where('id',$item->pivot->id_rsc)->get();
                $member = new \stdClass();
                $member->name = $item->pivot->name;
                $member->jabatan = $rsc[0]->rsc;
                $inovasiMember[$index] = $member;
                $index++;
            }
            $PIR = DictionaryKategori::where('kode','PIR')->get()[0]->dictionary[0]->isi;
            $labels = array(
                "PIR"=>$PIR
            );
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.email.askReview', [
                    "proposal"=>$proposal,
                    "development"=>$development,
                    "arn"=>$arn,
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel,
                    'labels'=>$labels
                ]);
            }else{
                return view('jayakari.bic.admin::pages.email.askReview', [
                    "proposal"=>$proposal,
                    "development"=>$development,
                    "arn"=>$arn,
                    "bidangusaha"=>$bidangusaha,
                    "employee"=>$employee,
                    "inovasiMember"=>$inovasiMember,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel,
                    'labels'=>$labels
                ]);
            }
        }
    }

    public function saveMessage(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $proposal = Proposal::find($json->id_proposal);
            Proposal::where('id', $json->id_proposal)
                ->update(['status' => 3]);
            $proposalMessage = new ProposalMessage();
            $proposalMessage->judul = $json->judul;
            $proposalMessage->isi = $json->isi;
            $proposalMessage->status = 0;
            $proposalMessage->inserted_by = $user->get()[0]->id;
            $proposalMessage->updated_by = $user->get()[0]->id;
            $proposalMessage->id_sender = $user->get()[0]->id;
            $proposalMessage->sender = "Inovator";
            $proposalMessage->id_receiver = 0;
            $proposalMessage->receiver = "Reviewer";
            $proposal->message()->save($proposalMessage);
            //send auto reply email to inovator
            $this->sendAskReview($user->get()[0],$proposal,$proposalMessage);
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function sendAskReview(User $user,Proposal $proposal,ProposalMessage $proposalMessage){
        $kategoriDictionary = DictionaryKategori::where('kode','EIKP')->get();
        $dictionary = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','GPE')->get();
        $gpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','JPE')->get();
        $jpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','SEAR')->get();
        $sear = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $emailTo = $user->email;
        $inovasiMember = "";
        $idx=1;
        foreach($proposal->inovasiMember as $item){
            $inovasiMember .= $idx.'. '.$item->pivot->name.'<br>';
            $idx++;
        }
        //$subject = '[BIC] - Terimakasih atas proposalnya';
        $subject = $sear[0]->isi;
        $content = $dictionary[0]->isi;
        $content = str_replace("{inovator}",$user->fullname."</b>",$content);
        $content = str_replace("{nomor}",$proposal->id,$content);
        $content = str_replace("{judul}",$proposal->judul,$content);
        $content = str_replace("{tim}",$inovasiMember,$content);
        $content = str_replace("{pengirim}",$jpe[0]->isi,$content);
        $content = str_replace("{gambar}",'<img src="'.env('URL_APP').'/public/storage/'.$gpe[0]->public_path.'/'.$gpe[0]->isi.'" width="100px" height="100px">',$content);

        //$sender = 'info@bic.web.id';
		$sender = 'informasibic@gmail.com';
        $senderName = "[BIC] REVIEWER";
        Mail::send('jayakari.bic.admin::pages.email.sendAskReview',['title'=>$sear[0]->isi,'content'=>$content,'user'=>$user],function($message) use($emailTo,$subject,$sender,$senderName){
            $message->subject($subject);
            $message->from($sender,$senderName);
            $message->to($emailTo);
        });
    }

    public function sendRevisi(User $user,Proposal $proposal,ProposalMessage $proposalMessage){
        $kategoriDictionary = DictionaryKategori::where('kode','ER')->get();
        $dictionary = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','GPE')->get();
        $gpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','JPE')->get();
        $jpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','SER')->get();
        $ser = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $emailTo = $user->email;
        //$emailTo = 'dragonif01@gmail.com';
        $inovasiMember = "";
        $idx=1;
        /*foreach($proposal->inovasiMember as $item){
            $inovasiMember .= $idx.'. '.$item->pivot->name.'<br>';
            $idx++;
        }*/
        foreach($proposal->inovatorMember() as $item){
            $inovasiMember .= $idx.'. '.$item->name.'<br>';
            $idx++;
        }
        //$subject = '[BIC] - Revisi proposal '.$proposal->judul;
        $subject = $ser[0]->isi;
        $content = $dictionary[0]->isi;
        $content = str_replace("{inovator}",$user->fullname."</b>",$content);
        $content = str_replace("{nomor}",$proposal->id,$content);
        $content = str_replace("{judul}",$proposal->judul,$content);
        $content = str_replace("{review}",$proposalMessage->isi,$content);
        $content = str_replace("{tim}",$inovasiMember,$content);
        $content = str_replace("{pengirim}",$jpe[0]->isi,$content);
        $content = str_replace("{gambar}",'<img src="'.env('URL_APP').'/public/storage/'.$gpe[0]->public_path.'/'.$gpe[0]->isi.'" width="100px" height="100px">',$content);

        //$sender = 'info@bic.web.id';
		$sender = 'informasibic@gmail.com';
        $senderName = "REVIEWER";
        Mail::send('jayakari.bic.admin::pages.email.sendRevisi',['title'=>$ser[0]->isi,'content'=>$content,'user'=>$user],function($message) use($emailTo,$subject,$sender,$senderName){
            $message->subject($subject);
            $message->from($sender,$senderName);
            $message->to($emailTo);
        });
    }

    public function sendInReview(User $user,Proposal $proposal,ProposalMessage $proposalMessage){
        //$sender = "info@bic.web.id";
		$sender = 'informasibic@gmail.com';
        $senderName = "REVIEWER";
        //send to inovator
        $kategoriDictionary = DictionaryKategori::where('kode','EIRI')->get();
        $dictionary = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','GPE')->get();
        $gpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','JPE')->get();
        $jpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','SEIR')->get();
        $seir = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $emailTo = $user->email;
        $inovasiMember = "";
        $idx=1;
        /*foreach($proposal->inovasiMember as $item){
            $inovasiMember .= $idx.'. '.$item->pivot->name.'<br>';
            $idx++;
        }*/
        foreach ($proposal->inovatorMember as $item){
            $inovasiMember .= $idx.'. '.$item->name.'<br>';
            $idx++;
        }
        $subject = $seir[0]->isi;
        $content = $dictionary[0]->isi;
        $content = str_replace("{inovator}",$user->fullname."</b>",$content);
        $content = str_replace("{review}",$proposalMessage->isi,$content);
        $content = str_replace("{nomor}",$proposal->id,$content);
        $content = str_replace("{judul}",$proposal->judul,$content);
        $content = str_replace("{tim}",$inovasiMember,$content);
        $content = str_replace("{pengirim}",$jpe[0]->isi,$content);
        $content = str_replace("{gambar}",'<img src="'.env('URL_APP').'/public/storage/'.$gpe[0]->public_path.'/'.$gpe[0]->isi.'" width="100px" height="100px">',$content);
        Mail::send('jayakari.bic.admin::pages.email.sendInReview',['title'=>$seir[0]->isi,'content'=>$content,'user'=>$user],function($message) use($emailTo,$subject,$sender,$senderName){
            $message->subject($subject);
            $message->from($sender,$senderName);
            $message->to($emailTo);
        });

        //send to admin proses
        $kategoriDictionary = DictionaryKategori::where('kode','EAP')->get();
        $email = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','EIRAP')->get();
        $dictionary = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();

        $subject = $seir[0]->isi;
        $content = $dictionary[0]->isi;

        $content = str_replace("{nomor}",$proposal->id,$content);
        $content = str_replace("{judul}",$proposal->judul,$content);
        $content = str_replace("{review}",$proposalMessage->isi,$content);
        $content = str_replace("{tim}",$inovasiMember,$content);
        $content = str_replace("{pengirim}",$jpe[0]->isi,$content);
        $content = str_replace("{gambar}",'<img src="'.env('URL_APP').'/public/storage/'.$gpe[0]->public_path.'/'.$gpe[0]->isi.'">',$content);

        $emailTo = $email[0]->isi;
        //$subject = '[BIC]Permohonan Seleksi Juri - '.$proposalMessage->proposal->judul;
        //$sender = 'info@bic.web.id';
		$sender = 'informasibic@gmail.com';
        $senderName = "REVIEWER";
        //send to inovator
        Mail::send('jayakari.bic.admin::pages.email.sendSeleksi',['title'=>$seir[0]->isi,'content'=>$content,'user'=>$user,'proposalMessage'=>$proposalMessage],function($message) use($emailTo,$subject,$sender,$senderName){
            $message->subject($subject);
            $message->from($sender,$senderName);
            $message->to($emailTo);
        });
    }

    public function sendSeleksi(User $user,Proposal $proposal,ProposalMessage $proposalMessage,$isiReview){
        //$sender = "info@bic.web.id";
		$sender = 'informasibic@gmail.com';
        $senderName = "REVIEWER";
        //send to inovator
        $kategoriDictionary = DictionaryKategori::where('kode','ESI')->get();
        $dictionary = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','GPE')->get();
        $gpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','JPE')->get();
        $jpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','SES')->get();
        $ses = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $emailTo = $user->email;
        $inovasiMember = "";
        $idx=1;
        foreach($proposal->inovasiMember as $item){
            $inovasiMember .= $idx.'. '.$item->pivot->name.'<br>';
            $idx++;
        }
        $subject = $ses[0]->isi;
        $content = $dictionary[0]->isi;
        $content = str_replace("{inovator}",$user->fullname."</b>",$content);
        $content = str_replace("{review}",$isiReview,$content);
        $content = str_replace("{nomor}",$proposal->id,$content);
        $content = str_replace("{judul}",$proposal->judul,$content);
        $content = str_replace("{tim}",$inovasiMember,$content);
        $content = str_replace("{pengirim}",$jpe[0]->isi,$content);
        $content = str_replace("{gambar}",'<img src="'.env('URL_APP').'/public/storage/'.$gpe[0]->public_path.'/'.$gpe[0]->isi.'" width="100px" height="100px">',$content);
        Mail::send('jayakari.bic.admin::pages.email.sendSeleksi',['title'=>$ses[0]->isi,'content'=>$content,'user'=>$user],function($message) use($emailTo,$subject,$sender,$senderName){
            $message->subject($subject);
            $message->from($sender,$senderName);
            $message->to($emailTo);
        });
    }

    public function sendDiscontinued(User $user,Proposal $proposal,ProposalMessage $proposalMessage){
        //$sender = "info@bic.web.id";
		$sender = 'informasibic@gmail.com';
        $senderName = "REVIEWER";
        //send to inovator
        $kategoriDictionary = DictionaryKategori::where('kode','EDI')->get();
        $dictionary = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','GPE')->get();
        $gpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','JPE')->get();
        $jpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','SED')->get();
        $sed = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $emailTo = $user->email;
        $inovasiMember = "";
        $idx=1;
        foreach($proposal->inovasiMember as $item){
            $inovasiMember .= $idx.'. '.$item->pivot->name.'<br>';
            $idx++;
        }
        $subject = $sed[0]->isi;
        $content = $dictionary[0]->isi;
        $content = str_replace("{inovator}",$user->fullname."</b>",$content);
        $content = str_replace("{review}",$proposalMessage->isi,$content);
        $content = str_replace("{nomor}",$proposal->id,$content);
        $content = str_replace("{judul}",$proposal->judul,$content);
        $content = str_replace("{tim}",$inovasiMember,$content);
        $content = str_replace("{pengirim}",$jpe[0]->isi,$content);
        $content = str_replace("{gambar}",'<img src="'.env('URL_APP').'public/storage/'.$gpe[0]->public_path.$gpe[0]->isi.'" width="100px" height="100px">',$content);
        Mail::send('jayakari.bic.admin::pages.email.sendDiscontinued',['title'=>$sed[0]->isi,'content'=>$content,'user'=>$user],function($message) use($emailTo,$subject,$sender,$senderName){
            $message->subject($subject);
            $message->from($sender,$senderName);
            $message->to($emailTo);
        });
    }

    public function sendListedToRevisi(User $user,Proposal $proposal,ProposalMessage $proposalMessage){
        //$sender = "info@bic.web.id";
		$sender = 'informasibic@gmail.com';
        $senderName = "REVIEWER";
        //send to inovator
        $kategoriDictionary = DictionaryKategori::where('kode','ELTRI')->get();
        $dictionary = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','GPE')->get();
        $gpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','JPE')->get();
        $jpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','SELTR')->get();
        $seltr = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $emailTo = $user->email;
        $inovasiMember = "";
        $idx=1;
        foreach($proposal->inovasiMember as $item){
            $inovasiMember .= $idx.'. '.$item->pivot->name.'<br>';
            $idx++;
        }
        $subject = $seltr[0]->isi;
        $content = $dictionary[0]->isi;
        $content = str_replace("{inovator}",$user->fullname."</b>",$content);
        $content = str_replace("{review}",$proposalMessage->isi,$content);
        $content = str_replace("{nomor}",$proposal->id,$content);
        $content = str_replace("{judul}",'<b>'.$proposal->judul.'</b>',$content);
        $content = str_replace("{tim}",$inovasiMember,$content);
        $content = str_replace("{pengirim}",$jpe[0]->isi,$content);
        $content = str_replace("{gambar}",'<img src="'.env('URL_APP').'/public/storage/'.$gpe[0]->public_path.'/'.$gpe[0]->isi.'" width="100px" height="100px">',$content);
        Mail::send('jayakari.bic.admin::pages.email.sendListedToRevisi',['title'=>$seltr[0]->isi,'content'=>$content,'user'=>$user],function($message) use($emailTo,$subject,$sender,$senderName){
            $message->subject($subject);
            $message->from($sender,$senderName);
            $message->to($emailTo);
        });
    }

    public function sendRemindRevisi(User $user,Proposal $proposal,ProposalMessage $proposalMessage){
        //$sender = "info@bic.web.id";
		$sender = 'informasibic@gmail.com';
        $senderName = "REVIEWER";
        //send to inovator
        $kategoriDictionary = DictionaryKategori::where('kode','ERRI')->get();
        $dictionary = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','GPE')->get();
        $gpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','JPE')->get();
        $jpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','SERR')->get();
        $serr = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $emailTo = $user->email;
        $inovasiMember = "";
        $idx=1;
        foreach($proposal->inovasiMember as $item){
            $inovasiMember .= $idx.'. '.$item->pivot->name.'<br>';
            $idx++;
        }
        $subject = $serr[0]->isi;
        $content = $dictionary[0]->isi;
        $content = str_replace("{inovator}",$user->fullname."</b>",$content);
        $content = str_replace("{nomor}",$proposal->id,$content);
        $content = str_replace("{judul}",'<b>'.$proposal->judul.'</b>',$content);
        $content = str_replace("{tim}",$inovasiMember,$content);
        $content = str_replace("{review}",$proposalMessage->isi,$content);
        $content = str_replace("{pengirim}",$jpe[0]->isi,$content);
        $content = str_replace("{gambar}",'<img src="'.env('URL_APP').'/public/storage/'.$gpe[0]->public_path.'/'.$gpe[0]->isi.'" width="100px" height="100px">',$content);
        Mail::send('jayakari.bic.admin::pages.email.sendRemindRevisi',['title'=>$serr[0]->isi,'content'=>$content,'user'=>$user],function($message) use($emailTo,$subject,$sender,$senderName){
            $message->subject($subject);
            $message->from($sender,$senderName);
            $message->to($emailTo);
        });
    }

    public function sendRemindNew(User $user,Proposal $proposal,ProposalMessage $proposalMessage){
        //$sender = "info@bic.web.id";
		$sender = 'informasibic@gmail.com';
        $senderName = "REVIEWER";
        //send to inovator
        $kategoriDictionary = DictionaryKategori::where('kode','ERNI')->get();
        $dictionary = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','GPE')->get();
        $gpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','JPE')->get();
        $jpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','SERN')->get();
        $sern = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $emailTo = $user->email;
        $inovasiMember = "";
        $idx=1;
        foreach($proposal->inovasiMember as $item){
            $inovasiMember .= $idx.'. '.$item->pivot->name.'<br>';
            $idx++;
        }
        $subject = $sern[0]->isi;
        $content = $dictionary[0]->isi;
        $content = str_replace("{inovator}",$user->fullname."</b>",$content);
        $content = str_replace("{nomor}",$proposal->id,$content);
        $content = str_replace("{judul}",'<b>'.$proposal->judul.'</b>',$content);
        $content = str_replace("{tim}",$inovasiMember,$content);
        $content = str_replace("{review}",$proposalMessage->isi,$content);
        $content = str_replace("{pengirim}",$jpe[0]->isi,$content);
        $content = str_replace("{gambar}",'<img src="'.env('URL_APP').'/public/storage/'.$gpe[0]->public_path.'/'.$gpe[0]->isi.'" width="100px" height="100px">',$content);
        Mail::send('jayakari.bic.admin::pages.email.sendRemindNew',['title'=>$sern[0]->isi,'content'=>$content,'user'=>$user],function($message) use($emailTo,$subject,$sender,$senderName){
            $message->subject($subject);
            $message->from($sender,$senderName);
            $message->to($emailTo);
        });
    }

    public function sendTechnicalReviewer(User $user,Proposal $proposal,ProposalMessage $proposalMessage){
        //$sender = "info@bic.web.id";
		$sender = 'informasibic@gmail.com';
        $senderName = "REVIEWER";
        //send to inovator
        $kategoriDictionary = DictionaryKategori::where('kode','ETR')->get();
        $dictionary = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','GPE')->get();
        $gpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','JPE')->get();
        $jpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','SETR')->get();
        $setr = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $emailTo = $user->email;
        $inovasiMember = "";
        $idx=1;
        foreach($proposal->inovasiMember as $item){
            $inovasiMember .= $idx.'. '.$item->pivot->name.'<br>';
            $idx++;
        }
        $subject = $setr[0]->isi;
        $content = $dictionary[0]->isi;
        $content = str_replace("{technicalreviewer}",$user->fullname."</b>",$content);
        $content = str_replace("{nomor}",$proposal->id,$content);
        $content = str_replace("{judul}",'<b>'.$proposal->judul.'</b>',$content);
        $content = str_replace("{pengirim}",$jpe[0]->isi,$content);
        $content = str_replace("{gambar}",'<img src="'.env('URL_APP').'/public/storage/'.$gpe[0]->public_path.'/'.$gpe[0]->isi.'" width="100px" height="100px">',$content);
        Mail::send('jayakari.bic.admin::pages.email.sendTechnicalReviewer',['title'=>$setr[0]->isi,'content'=>$content,'user'=>$user],function($message) use($emailTo,$subject,$sender,$senderName){
            $message->subject($subject);
            $message->from($sender,$senderName);
            $message->to($emailTo);
        });
    }

    public function sendForgetPassword(User $user){
        $kategoriDictionary = DictionaryKategori::where('kode','EFP')->get();
        $dictionary = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','GPE')->get();
        $gpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','JPE')->get();
        $jpe = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $kategoriDictionary = DictionaryKategori::where('kode','SEFP')->get();
        $sefp = Dictionary::where('id_dictionary_kategori',$kategoriDictionary[0]->id)->get();
        $emailTo = $user->email;
        $subject = $sefp[0]->isi;
        $content = $dictionary[0]->isi;
        $content = str_replace("{inovator}",$user->fullname,$content);
        $content = str_replace("{username}",$user->email,$content);
        $content = str_replace("{password}",'12345678',$content);
        $content = str_replace("{jabatan}",$jpe[0]->isi,$content);
        $content = str_replace("{gambar}",'<img src="'.env('URL_APP').'/public/storage/'.$gpe[0]->public_path.'/'.$gpe[0]->isi.'" width="100px" height="100px">',$content);

        //$sender = 'info@bic.web.id';
		$sender = 'informasibic@gmail.com';
        $senderName = "[BIC]ADMIN";
        Mail::send('jayakari.bic.admin::pages.email.sendForgetPassword',['title'=>$sefp[0]->isi,'content'=>$content,'user'=>$user],function($message) use($emailTo,$subject,$sender,$senderName){
            $message->subject($subject);
            $message->from($sender,$senderName);
            $message->to($emailTo);
        });
    }

    public function sent(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposalMesasge = ProposalMessage::where('id_sender',$user->get()[0]->id)
                                ->orderBy('inserted_date','desc');
            $this->kategorilabel = 'message';
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.email.sent', [
                    "proposalMessage"=>$proposalMesasge->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.email.sent', [
                    "proposalMessage"=>$proposalMesasge->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function inbox(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposalMessage = ProposalMessage::where('id_receiver',$user->get()[0]->id)
                            ->orderBy('inserted_date','desc');
            $receiver = User::where('id',$proposalMessage->get()[0]->id_receiver)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.email.inbox', [
                    "proposalMessage"=>$proposalMessage->get(),
                    "receiver"=>$receiver,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.email.inbox', [
                    "proposalMessage"=>$proposalMessage->get(),
                    "receiver"=>$receiver,
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->id,
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
            $proposalMessage = ProposalMessage::where('id',$id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.email.content', [
                    "proposalMessage"=>$proposalMessage,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.email.content', [
                    "proposalMessage"=>$proposalMessage,
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function contentinbox($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            ProposalMessage::where('id',$id)->update(["status"=>1]);
            $proposalMessage = ProposalMessage::where('id',$id)->get();
            $receiver = User::where('id',$proposalMessage[0]->id_receiver)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.email.contentinbox', [
                    "proposalMessage"=>$proposalMessage,
                    "datauser" => $user->get(),
                    "receiver"=>$receiver,
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.email.contentinbox', [
                    "proposalMessage"=>$proposalMessage,
                    "receiver"=>$receiver,
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }
    public function inboxProposal(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposalMessage = ProposalMessage::where('receiver','AdminProses')
                        ->orderBy('inserted_date','desc');
            $proposalMessage->get()->sortByDesc('inserted_date');
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.email.inboxProposal', [
                    "proposalMessage"=>$proposalMessage->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.email.inboxProposal', [
                    "proposalMessage"=>$proposalMessage->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }


    public function contentProposal($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            ProposalMessage::where('id',$id)->update(['status'=>1]);
            $proposalMessage = ProposalMessage::where('id',$id)->get();
            $usaha = explode(',',$proposalMessage[0]->proposal->instansi->bidang_usaha);
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
                if ($proposalMessage[0]->proposal->instansi->id_employee == $allemployee[$i]->id){
                    $found = true;
                    $employee = $allemployee[$i]->employee;
                }
            }
            $inovasiMember = array();
            $index = 0;
            foreach($proposalMessage[0]->proposal->inovasiMember as $item){
                $rsc = RSC::where('id',$item->pivot->id_rsc)->get();
                $member = new \stdClass();
                $member->name = $item->pivot->name;
                $member->jabatan = $rsc[0]->rsc;
                $inovasiMember[$index] = $member;
                $index++;
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.email.contentProposal', [
                    "proposalMessage"=>$proposalMessage,
                    "datauser" => $user->get(),
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.email.contentProposal', [
                    "proposalMessage"=>$proposalMessage,
                    "datauser" => $user->get(),
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function sentReviewer(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposalMesasge = ProposalMessage::where('sender','Reviewer')
                                ->orderBy('inserted_date','desc');
            $receiver = User::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.email.sentReviewer', [
                    "proposalMessage"=>$proposalMesasge->get(),
                    "receiver"=>$receiver,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.email.sentReviewer', [
                    "proposalMessage"=>$proposalMesasge->get(),
                    "datauser" => $user->get(),
                    "receiver"=>$receiver,
                    'activeCategory'=>$user->get()[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function contentSentReviewer($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            ProposalMessage::where('id',$id)->update(["status"=>1]);
            $proposalMessage = ProposalMessage::where('id',$id)->get();
            $receiver = User::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.email.contentSentReviewer', [
                    "proposalMessage"=>$proposalMessage,
                    "datauser" => $user->get(),
                    "receiver"=>$receiver,
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.email.contentSentReviewer', [
                    "proposalMessage"=>$proposalMessage,
                    "receiver"=>$receiver,
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function inboxReviewer(Request $request){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $proposalMessage = ProposalMessage::where('receiver','Reviewer')
                            ->orderBy('inserted_date','desc');
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.email.inboxReviewer', [
                    "proposalMessage"=>$proposalMessage->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.email.inboxReviewer', [
                    "proposalMessage"=>$proposalMessage->get(),
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function contentReviewer($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            ProposalMessage::where('id',$id)->update(['status'=>1]);
            $proposalMessage = ProposalMessage::where('id',$id)->get();
            $usaha = explode(',',$proposalMessage[0]->proposal->instansi->bidang_usaha);
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
                if ($proposalMessage[0]->proposal->instansi->id_employee == $allemployee[$i]->id){
                    $found = true;
                    $employee = $allemployee[$i]->employee;
                }
            }
            $inovasiMember = array();
            $index = 0;
            foreach($proposalMessage[0]->proposal->inovasiMember as $item){
                $rsc = RSC::where('id',$item->pivot->id_rsc)->get();
                $member = new \stdClass();
                $member->name = $item->pivot->name;
                $member->jabatan = $rsc[0]->rsc;
                $inovasiMember[$index] = $member;
                $index++;
            }
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.email.contentReviewer', [
                    "proposalMessage"=>$proposalMessage,
                    "datauser" => $user->get(),
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.email.contentReviewer', [
                    "proposalMessage"=>$proposalMessage,
                    "datauser" => $user->get(),
                    "bidangusaha"=>$bidangusaha,
                    "inovasiMember"=>$inovasiMember,
                    "employee"=>$employee,
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }
    /*
     * end new function
     */

    public function listemails(){
        return view('jayakari.bic.admin::pages.email.listemails');
    }

    public function listemailsInovator(){
        return view('jayakari.bic.admin::pages.email.listemailsInovator');
    }

    public function listSentEmailsInovator(){
        return view('jayakari.bic.admin::pages.email.listSentEmailsInovator');
    }

    public function isiEmail(){
        return view('jayakari.bic.admin::pages.email.isiEmail');
    }

    public function isiEmailReviewer(){
        return view('jayakari.bic.admin::pages.email.isiEmailReviewer');
    }

    public function isiSentEmail(){
        return view('jayakari.bic.admin::pages.email.isiSentEmail');
    }

    public function isiSentEmailReviewer(){
        return view('jayakari.bic.admin::pages.email.isiSentEmailReviewer');
    }

    public function newemail(){
        return view('jayakari.bic.admin::pages.email.newemail');
    }

    public function newemailInovator(){
        return view('jayakari.bic.admin::pages.email.newemailInovator');
    }

    public function newemailReviewer(){
        return view('jayakari.bic.admin::pages.email.newemailReviewer');
    }

    public function kirimEmailDiterima(){
        return view('jayakari.bic.admin::pages.email.kirimEmailDiterima');
    }

    public function listEmailsReviewer(){
        return view('jayakari.bic.admin::pages.email.listEmailsReviewer');
    }

    public function listSentEmailsReviewer(){
        return view('jayakari.bic.admin::pages.email.listSentEmailsReviewer');
    }

    public function kirimEmailDitolak(){
        return view('jayakari.bic.admin::pages.email.kirimEmailDitolak');
    }
}