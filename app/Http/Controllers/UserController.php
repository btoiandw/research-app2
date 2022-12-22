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
            ->select('research.*', 'send_research.*', 'users.*')
            ->join('send_research', 'research.research_id', '=', 'send_research.research_id')
            ->join('users', 'send_research.id', '=', 'users.id')
            ->whereIn('send_research.id', Auth::user())
            ->get();

        return view('user.index', ['list_res' => $list_res]);
    }

    public function detailResearch($id)
    {
        $data_de = DB::table('send_research')
            ->select('research.*', 'send_research.*', 'users.*', 'research_sources.*', 'faculties.*')
            ->join('research', 'send_research.research_id', '=', 'research.research_id')
            ->join('users', 'send_research.id', '=', 'users.id')
            ->join('faculties', 'users.organization_id', '=', 'faculties.id')
            ->join('research_sources', 'research.research_source_id', '=', 'research_sources.research_sources_id')
            ->where('research.research_id', '=', $id)
            ->get();

        return view('user.pages.detail-research', ['data_de' => $data_de]);
        //dd($id,$data_de);
    }
    public function viewFilePDF($id)
    {
        //dd($id);
        $p = DB::table('research')->select('*')->where('research_id', '=', $id)->get();
        $pdf = $p[0]->pdf_file;
        $path = 'uploads/research/' . $p[0]->year_research . '/' . $p[0]->research_id;
        $file = $path . '/' . $pdf;
        return response()->file($file);
    }
    public function viewFileWord($id)
    {
        $p = DB::table('research')->select('*')->where('research_id', '=', $id)->get();
        $word = $p[0]->word_file;
        $path = 'uploads/research/' . $p[0]->year_research . '/' . $p[0]->research_id;
        $file = $path . '/' . $word;
        return response()->file($file);
    }

    public function modifyPages1($id)
    {
        $data = DB::table('send_research')
            ->select('send_research.*', 'research.*', 'users.*', 'faculties.*', 'research_sources.*')
            ->join('research', 'send_research.research_id', '=', 'research.research_id')
            ->join('users', 'send_research.id', '=', 'users.id')
            ->join('faculties', 'users.organization_id', '=', 'faculties.id')
            ->join('research_sources', 'research.research_source_id', '=', 'research_sources.research_sources_id')
            ->where('send_research.research_id', '=', $id)
            ->get();
       // dd($data[0]);
        return view('user.pages.1.add-modify1', ['data' => $data]);
    }
    /* public function create_research(){
        return 
    } */
}
