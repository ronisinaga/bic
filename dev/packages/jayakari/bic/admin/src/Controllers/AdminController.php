<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 5/18/2019
 * Time: 11:39 AM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use jayakari\bic\admin\Models\User;

class AdminController extends Controller
{

    private $kategorilabel = "system";

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function index(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.admin.index', [
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.admin.index', [
                    "datauser" => $user->get(),
                    'activeCategory'=>$user->get()[0]->userCategory[0]->id,
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function find(Request $request){
        $data = $request->input('data');
        $json = json_decode($data);
        $path = public_path('/storage/'.$json->folder);
        $scandir = scandir($path);
        $result = array();
        $index = 1;
        foreach ($scandir as $file){
            if(!is_file($path.'/'.$file)) continue;
            $size = filesize($path.'/'.$file)/1024;
            $size = round($size,3);
            if($size >= 1024){
                $size = round($size/1024,2).' MB';
            }else{
                $size = $size.' KB';
            }
            $inner = new \stdClass();
            $inner->index = $index;
            $str = file_get_contents($path.'/'.$file);
            $status = '';
            if (strpos($str,'<?php') !== false){
                $status = 'File Infected';
            }else if(strpos($str,'<script>') !== false){
                $arrfile = explode(".",$file);
                if ($arrfile[1] == 'htm' || $arrfile[1] == 'html'){
                    $status = 'File Clear';
                }else{
                    $status = 'File Infected';
                }
            }else if(strpos($str,'<html>') !== false){
                $arrfile = explode(".",$file);
                if ($arrfile[1] == 'htm' || $arrfile[1] == 'html'){
                    $status = 'File Clear';
                }else{
                    $status = 'File Infected';
                }
            }else if(strpos($str,'push graphic-context') !== false || strpos($str,'pop graphic-context') !== false){
                $status = 'File Infected';
            }else{
                $status = 'File Clear';
            }
            $inner->folder = $json->folder;
            $inner->file = $file;
            $inner->status = $status;
            if ($status <> 'File Clear'){
                $result[] = $inner;
            }
            $index++;
        }
        $result = array(
            "sender" => "SITEKAD",
            "status" => 'success',
            "result"=>$result
        );
        return response()->json($result);
    }

    public function delete(Request $request){
        $data = $request->input('data');
        $json = json_decode($data);
        Storage::disk('bic')->delete($json->folder.'/'.$json->file);
        $result = array(
            "sender" => "SITEKAD",
            "status" => 'success'
        );
        return response()->json($result);
    }

}