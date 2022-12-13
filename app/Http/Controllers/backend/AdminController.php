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
    public function show($id)
    {
        //
        /* $data_id = DB::table('research')->where('research_id', '=', $id)->get();
        $send = DB::select('select id from send_research where research_id = ?', [$id]); */
        $data = DB::table('research')
            ->select('research.*', 'send_research.*', 'users.*','research_sources.*','faculties.*')
            ->join('send_research', 'research.research_id', '=', 'send_research.research_id')
            ->join('research_sources','research.research_source_id','=','research_sources.research_sources_id')
            ->join('users', 'send_research.id', '=', 'users.id')
            ->join('faculties','users.organization_id','=','faculties.id')
            ->where('research.research_id', $id)
            ->get();

        /* $dq = $data->map(function ($da,$key) {
            return [
                'id'=>$da->research_id,
                'nameTH'=>$da->research_th,

            ];
        }); */

        //$dq=$data->pluck('research_id','research_th');
        //$sUser=DB::select('select * from users where id = ?', [$send]);
        //dd($data);
        //dd($dq->all());
        //return 
        return view('admin.show-detail',['data'=>$data]);
        //return redirect()->route('admin.dashboard',['data_id'=>$data_id]);
        //return view('admin.show-detail',['data_id'=>$data_id]);
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
}
