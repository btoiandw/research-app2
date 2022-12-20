<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller as Controller;
use App\Models\Research;
use Illuminate\Support\Facades\DB;
use DateTime;

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
        /*         $feed = DB::table('tb_feedback')
            ->select('research_id', DB::raw('count(research_id) as total'))
            ->orderBy('research_id', 'asc')
            ->groupBy('research_id')
            ->get();
        for ($i = 0; $i < sizeof($feed); $i++) {
            $fee[$i] = $feed[$i]->research_id;
        }*/

        $list_res = DB::table('research')
            ->select('research.*')->distinct('research_id')
            ->where('research.research_status', '!=', '6')
            ->get();
        //dd($list_res, $feed, sizeof($feed), $fee);
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
        $research_id = $request->research_id;
        //DB::update('update research set research_summary_feedback = ?,research_status=? where research_id = ?', [$request->suggestion,'1',$$request->research_id]);
        $data = DB::table('research')
            ->where('research_id', '=', $research_id)
            //->update(['research_summary_feedback'=>$request->suggestion,'research_status'=>'1'])
            ->get();

        $get_file = $request->file('suggestionFile');
        if ($get_file != null) {
            $reYear = $data[0]->year_research;
            $path = 'uploads/research/' . $reYear . '/' . $research_id; //path save file
            $file_post = $get_file->getClientOriginalName();
            $eNamep = explode('.', $file_post);
            $infop = end($eNamep);
            $fileName = $research_id . "_7." . $infop;
        } else {
            $fileName = null;
        }
        if ($request->suggestion != null) {
            $feedback = $request->suggestion;
        } else {
            $feedback = null;
        }

        if ($request->submit == "บันทึก") {
            $var = 'can save';
            if ($get_file->move($path, $fileName)) {
                DB::update('update research set research_summary_feedback=?, summary_feedback_file=? where research_id = ?', [$feedback, $fileName, $research_id]);
            }
        } elseif ($request->submit == "ยืนยัน") {
            /*0=รอตรวจสอบ, 1=ไม่ผ่าน/ปรับปรุงครั้งที่ 1, 2=ไม่ผ่าน/ปรับปรุงครั้งที่ 2, 3=ไม่ผ่าน/ปรับปรุงครั้งที่ 3, 4=ผ่าน, 5=ยกเลิก,6=รอการตวจสอบจากคระกรรมการ,7=ไม่ผ่านการตรวจสอบโดยแอดมิน */
            $var = 'can save and add to another level user';
            if ($get_file->move($path, $fileName)) {
                DB::update('update research set research_summary_feedback=?, summary_feedback_file=?, research_status=? where research_id = ?', [$feedback, $fileName, '7', $research_id]);
            }
        }
        //dd($request->all(), $data[0], $var, $file_post, $feedback, $fileName);
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
            ->select('users.*', 'faculties.organizational', 'major')
            ->join('faculties', 'users.organization_id', '=', 'faculties.id')
            ->where('role', '=', '2')
            ->get();

        return view('admin.add-director', ['data' => $data, 'list_direc' => $list_direc]);
    }
    public function addDirector(Request $request)
    {
        $id = $request->research_id;


        $now = new DateTime();
        //dd($request->all(), $id, sizeof($request->referees), $c_data, $id_feedback,$now);
        for ($i = 0; $i < sizeof($request->referees); $i++) {
            /* $c_data[$i] = DB::table('tb_feedback')->count();
            if ($c_data[$i] == 0) {
                $id_feedback[$i] = 1;
            } else {
                $id_feedback[$i] = $c_data[$i] + 1;
            } */
            DB::insert('insert into tb_feedback (id,research_id,date_send_referess) values (?,?,?)', [$request->referees[$i], $id, $now]);
            DB::update('update research set research_status = ? where research_id = ?', ['6', $id]);;
        }

        return redirect()->route('admin.dashboard');

        //DB::table('tb_feedback')->insert('feedback_id','id','research_id','date_send_referess');

    }


    public function sendDirectorView()
    {
        $data_send = DB::table('tb_feedback')
            ->select('tb_feedback.*', 'research.*', 'users.*')
            ->join('research', 'tb_feedback.research_id', '=', 'research.research_id')
            ->join('users', 'tb_feedback.id', '=', 'users.id')
            ->groupBy('tb_feedback.research_id')
            ->get();
        return view('admin.pages.re-send-director', ['data_send' => $data_send]);
    }

    public function sendDetail($id)
    {
        $data = DB::table('tb_feedback')
            ->select('tb_feedback.*', 'research.*', 'users.*')
            ->join('research', 'tb_feedback.research_id', '=', 'research.research_id')
            ->join('users', 'tb_feedback.id', '=', 'users.id')
            ->where('tb_feedback.research_id', '=', $id)
            ->get();
        $data_send = DB::table('send_research')
            ->select('send_research.*', 'users.*', 'faculties.*')
            ->join('users', 'send_research.id', '=', 'users.id')
            ->join('faculties', 'users.organization_id', '=', 'faculties.id')
            ->where('send_research.research_id', '=', $id)
            ->get();
        return view('admin.datail.detail-send', ['id' => $id, 'data' => $data, 'data_send' => $data_send]);
    }
}
