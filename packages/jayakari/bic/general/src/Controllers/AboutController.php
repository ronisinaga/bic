<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 11/23/2017
 * Time: 4:14 AM
 */

namespace jayakari\bic\general\Controllers;
use App\Http\Controllers\Controller;

class AboutController extends Controller{

    public function index(){
        return view('jayakari.bic.general::pages.about.index');
    }
}