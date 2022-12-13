<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    //
    public function index()
    {
        $list_research = DB::table('research');
        return view('user.index', ['list_research' => $list_research]);
    }

    public function showResearch()
    {
        $list_res = DB::table('research')
                        ->select('research.*','send_research.*','users.*')
                        ->join('send_research','research.research_id','=','send_research.research_id')
                        ->join('users','send_research.id','=','users.id')
                        ->whereIn('send_research.id',Auth::user())
                        ->get();

        return view('user.index', ['list_res' => $list_res]);
    }

    /* public function create_research(){
        return 
    } */
}
