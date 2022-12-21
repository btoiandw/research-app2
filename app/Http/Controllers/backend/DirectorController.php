<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\TbFeedback;
use DateTime;

class DirectorController extends Controller
{
    //
    public function index()
    {
        $data = DB::table('tb_feedback')
            ->select('tb_feedback.*', 'research.*', 'research_sources.*')
            ->join('research', 'tb_feedback.research_id', '=', 'research.research_id')
            ->join('research_sources', 'research.research_source_id', '=', 'research_sources.research_sources_id')
            ->whereIn('id', Auth::user())
            ->get();
        //dd($data);
        return view('director.index', ['data' => $data]);
    }
    public function indexDetailView($id)
    {
        $data = DB::table('research')
            ->select(/* 'tb_feedback.*', */'research.*', 'research_sources.*', 'send_research.*', 'users.*', 'faculties.*')
            ->join('research_sources', 'research.research_source_id', '=', 'research_sources.research_sources_id')
            //->whereIn('id',Auth::user())
            ->join('send_research', 'research.research_id', '=', 'send_research.research_id')
            ->join('users', 'send_research.id', '=', 'users.id')
            ->join('faculties', 'users.organization_id', '=', 'faculties.id')
            ->where('research.research_id', '=', $id)
            ->get();
        //dd($data);
        return view('director.pages.detail-view', ['id' => $id, 'data' => $data]);
    }

    public function addFeedback($id)
    {
        $list = DB::table('research')->where('research_id', '=', $id)->get();
        return view('director.pages.add-feedback', ['list' => $list]);
    }

    public function addFeed(Request $request)
    {
        $research_id = $request->research_id;
        //DB::update('update research set research_summary_feedback = ?,research_status=? where research_id = ?', [$request->suggestion,'1',$$request->research_id]);
        $data = DB::table('research')
            ->where('research_id', '=', $research_id)
            //->update(['research_summary_feedback'=>$request->suggestion,'research_status'=>'1'])
            ->get();
        $data_feed = DB::table('tb_feedback')
            ->select('tb_feedback.*', 'users.*')
            ->join('users', 'tb_feedback.id', '=', 'users.id')
            ->whereIn('tb_feedback.id', Auth::user())
            ->where('tb_feedback.research_id', $research_id)
            ->get();

        $reYear = $data[0]->year_research;
        $submit = $request->submit;
        $suggestion = $request->suggestion;
        $filefeed = $request->file('suggestionFile');
        $now = new DateTime();

        if ($suggestion != '') {
            $feedResult = $suggestion;
        } else {
            $feedResult = null;
        }
        if ($filefeed != '') {
            $reYear = $data[0]->year_research;
            $file_name = $filefeed->getClientOriginalName();
            $eNamep = explode('.', $file_name);
            $infop = end($eNamep);
            $file = $research_id . "_0_Feedback." . $infop;
            $path = 'uploads/research/' . $reYear . '/' . $research_id; //path save file

            $filefeed->move(public_path($path), $file);
        } else {
            $file = null;
        }


        /* if radio ผ่าน/ไม่ผ่าน */
        if ($request->AssessmentResults == 'ไม่ผ่าน') {
            if ($submit == "บันทึก") {

                DB::table('tb_feedback')
                    ->whereIn('id', Auth::user())
                    ->where('research_id', $research_id)
                    ->update(['status' => 'กำลังตรวจสอบ', 'feedback' => $feedResult, 'Assessment_result' => $request->AssessmentResults, 'suggestionFile' => $file]);

                return redirect()->route('director.dashboard');

                //DB::update();
            } elseif ($submit == "ยืนยัน") {
                /// DB::update();

                DB::table('tb_feedback')
                    ->whereIn('id', Auth::user())
                    ->where('research_id', $research_id)
                    ->update([
                        'status' => 'ตรวจสอบแล้ว',
                        'feedback' => $feedResult,
                        'Assessment_result' => $request->AssessmentResults,
                        'suggestionFile' => $file,
                        'Date_feedback_research' => $now
                    ]);
                return redirect()->route('director.dashboard');
            }
        } elseif ($request->AssessmentResults == 'ผ่าน') {
            /// DB::update();

            DB::table('tb_feedback')
                ->whereIn('id', Auth::user())
                ->where('research_id', $research_id)
                ->update([
                    'status' => 'ตรวจสอบแล้ว',
                    'feedback' => $feedResult,
                    'Assessment_result' => $request->AssessmentResults,
                    'suggestionFile' => $file,
                    'Date_feedback_research' => $now
                ]);
            return redirect()->route('director.dashboard');
        }
        //return $tbresearch;
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

    public function editFeed($id)
    {
        $data_editfeed = DB::table('tb_feedback')
            ->select('tb_feedback.*', 'research.*', 'users.*')
            ->join('research', 'tb_feedback.research_id', '=', 'research.research_id')
            ->join('users', 'tb_feedback.id', '=', 'users.id')
            ->whereIn('tb_feedback.id', Auth::user())
            ->where('tb_feedback.research_id', $id)
            ->get();
        
        return view('director.pages.edit-refer',['list'=>$data_editfeed]);
        //dd($id, $data_editfeed);
    }
}
