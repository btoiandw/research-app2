<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller as Controller;
use App\Models\Research;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list_res = DB::table('research')
            ->select('research.*')->distinct('research_id')
            //->join('send_research', 'research.research_id', '=', 'send_research.research_id')
            //->join('users', 'send_research.id', '=', 'users.id')

            /*  ->whereIn('send_research.id',Auth::user()) */
            ->get();
        //dd($list_res);
        return view('admin.index', compact('list_res'));
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
        $data = DB::table('research')
            ->select('research.*', 'send_research.*', 'users.*', 'research_sources.*', 'faculties.*')
            ->join('send_research', 'research.research_id', '=', 'send_research.research_id')
            ->join('research_sources', 'research.research_source_id', '=', 'research_sources.research_sources_id')
            ->join('users', 'send_research.id', '=', 'users.id')
            ->join('faculties', 'users.organization_id', '=', 'faculties.id')
            ->where('research.research_id', $id)
            ->get();

        return view('admin.show-detail', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function viewReferDe($id)
    {
        $data = DB::table('research')
            ->select('research.*'/* , 'send_research.*', 'users.*', 'research_sources.*', 'faculties.*' */)
            ->join('send_research', 'research.research_id', '=', 'send_research.research_id')
            /* ->join('research_sources', 'research.research_source_id', '=', 'research_sources.research_sources_id')
            ->join('users', 'send_research.id', '=', 'users.id')
            ->join('faculties', 'users.organization_id', '=', 'faculties.id') */
            ->where('research.research_id', $id)
            ->get();

        return view('admin.refer-de', ['data' => $data]);
    }
    public function addRefer(Request $request)
    {
        //DB::update('update research set research_summary_feedback = ?,research_status=? where research_id = ?', [$request->suggestion,'1',$$request->research_id]);
        $data = DB::table('research')
            ->where('research_id', $request->research_id)
           //->update(['research_summary_feedback'=>$request->suggestion,'research_status'=>'1'])
            ->get();
        dd($request->all(), $data[0]);
        return redirect()->route('admin.dashboard');
    }

    public function viewAddDirector($id)
    {
        $data = DB::table('research')
            ->select('research.*'/* , 'send_research.*', 'users.*', 'research_sources.*', 'faculties.*' */)
            ->join('send_research', 'research.research_id', '=', 'send_research.research_id')
            /* ->join('research_sources', 'research.research_source_id', '=', 'research_sources.research_sources_id')
            ->join('users', 'send_research.id', '=', 'users.id')
            ->join('faculties', 'users.organization_id', '=', 'faculties.id') */
            ->where('research.research_id', $id)
            ->get();

        $list_direc = DB::table('users')
            ->select('users.*', 'faculties.*')
            ->join('faculties', 'users.organization_id', '=', 'faculties.id')
            ->where('role', '=', '2')
            ->get();

        return view('admin.add-director', ['data' => $data, 'list_direc' => $list_direc]);
    }
}
