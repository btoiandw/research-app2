<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    //
    public function index(){
        $data = DB::table('tb_feedback')
                    ->select('tb_feedback.*','research.*','research_sources.*')
                    ->join('research','tb_feedback.research_id','=','research.research_id')
                    ->join('research_sources','research.research_source_id','=','research_sources.research_sources_id')
                    ->whereIn('id',Auth::user())
                    ->get();
        //dd($data);
        return view('director.index',['data'=>$data]);
    }
}
