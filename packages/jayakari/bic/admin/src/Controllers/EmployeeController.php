<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/18/2018
 * Time: 9:12 AM
 */

namespace jayakari\bic\admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use jayakari\bic\admin\Models\Employee;
use jayakari\bic\admin\Models\User;

class EmployeeController extends Controller
{
    private $kategorilabel = 'master data';

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
            $employee = Employee::all();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.employee.index', [
                    "employee" => $employee,
                    "datauser" => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.employee.index', [
                    "employee" => $employee,
                    "datauser" => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }
        }
    }

    public function add(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.employee.create', [
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.employee.create', [
                    'datauser' => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function edit($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $employee= Employee::where('id', $id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.employee.edit', [
                    'employee' => $employee,
                    'datauser' => $user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.employee.edit', [
                    'employee' => $employee,
                    'datauser' => $user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function delete($id){
        $userid = Cookie::get('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else{
            $employee = Employee::where('id',$id)->get();
            if (Cookie::has('active_category')){
                return view('jayakari.bic.admin::pages.employee.delete',[
                    'employee'=>$employee,
                    'datauser'=>$user->get(),
                    'activeCategory'=>Cookie::get('active_category'),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }else{
                return view('jayakari.bic.admin::pages.employee.delete',[
                    'employee'=>$employee,
                    'datauser'=>$user->get(),
                    'kategorilabel'=>$this->kategorilabel
                ]);
            }

        }
    }

    public function store(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            Employee::create(['employee' => $json->employee, 'kode' => $json->kode, 'keterangan' => $json->keterangan, 'inserted_by' =>$user->get()[0]->id, 'updated_by' =>$user->get()[0]->id]);

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function update(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            Employee::where('id', $json->id)
                ->update(['employee' => $json->employee, 'kode' => $json->kode, 'keterangan' => $json->keterangan, 'updated_by' => $user->get()[0]->id]);

            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function deleteData(Request $request){
        $userid = $request->cookie('userid');
        $user = User::where('id',$userid);
        if (count($user->get()) == 0){
            return redirect('general/login');
        }else {
            $data = $request->input('data');
            $json = json_decode($data);
            $employee = Employee::find($json->id);
            $employee->delete();
            $result = array(
                "sender" => "bic",
                "status" => 'success'
            );
            return response()->json($result);
        }
    }

    public function findStatus(){
        return view('jayakari.bic.admin::pages.employee.finduser');
    }

}