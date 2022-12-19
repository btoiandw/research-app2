<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
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
    public function indexDetailView($id){
        $data = DB::table('research')
                    ->select(/* 'tb_feedback.*', */'research.*','research_sources.*','send_research.*','users.*','faculties.*')
                    ->join('research_sources','research.research_source_id','=','research_sources.research_sources_id')
                    //->whereIn('id',Auth::user())
                    ->join('send_research','research.research_id','=','send_research.research_id')
                    ->join('users','send_research.id','=','users.id')
                    ->join('faculties','users.organization_id','=','faculties.id')
                    ->where('research.research_id','=',$id)
                    ->get();
        //dd($data);
        return view('director.pages.detail-view',['id'=>$id,'data'=>$data]);
    }

    public function addFeedback($id){
        $list = DB::table('research')->where('research_id','=',$id)->get();
        return view('director.pages.add-feedback',['list'=>$list]);
    }
}