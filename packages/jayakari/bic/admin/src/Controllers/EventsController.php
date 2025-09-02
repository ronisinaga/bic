<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 1/6/2018
 * Time: 3:45 PM
 */

namespace jayakari\bic\admin\Controllers;

use App\Http\Controllers\Controller;


class EventsController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
    }

    public function listevents(){
        return view('jayakari.bic.admin::pages.events.listevents');
    }

    public function addevent(){
        return view('jayakari.bic.admin::pages.events.addevent');
    }

    public function editEvent(){
        return view('jayakari.bic.admin::pages.events.editEvent');
    }

    public function deleteEvent(){
        return view('jayakari.bic.admin::pages.events.deleteEvent');
    }

    public function eventImage(){
        return view('jayakari.bic.admin::pages.events.eventImage');
    }

    public function selectedEventImage(){
        return view('jayakari.bic.admin::pages.events.selectedEventImage');
    }

    public function findEvent(){
        return view('jayakari.bic.admin::pages.events.findEvent');
    }
}