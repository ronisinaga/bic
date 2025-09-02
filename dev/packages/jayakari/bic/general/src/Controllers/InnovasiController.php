<?php
/**
 * Created by PhpStorm.
 * User: Roni Sinaga
 * Date: 11/23/2017
 * Time: 4:33 AM
 */

namespace jayakari\bic\general\Controllers;
use App\Http\Controllers\Controller;

class InnovasiController extends Controller{

    public function index(){
        echo 'innovasi Page';
    }

    public function inovasipertahun($tahun){
        return view('jayakari.bic.general::pages.inovasi.inovasipertahun');
    }

    public function inovasidetail($judul){
        return view('jayakari.bic.general::pages.inovasi.inovasidetail');
    }
}