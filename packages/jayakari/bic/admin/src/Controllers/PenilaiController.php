<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 12/24/2017
 * Time: 1:30 PM
 */

namespace jayakari\bic\admin\Controllers;

use App\Http\Controllers\Controller;


class PenilaiController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function download(){
        return view('jayakari.bic.admin::pages.penilai.download');
    }

    public function listpenilai(){
        return view('jayakari.bic.admin::pages.penilai.listpenilai');
    }

    public function addpenilai(){
        return view('jayakari.bic.admin::pages.penilai.addpenilai');
    }
}