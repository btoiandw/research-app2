<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller as Controller;
use App\Models\Research;
use Illuminate\Support\Facades\DB;
use DateTime;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    //

    public function direcFeed1($id)
    {
        $data = DB::table('tb_feedback')
            ->select('tb_feedback.*', 'research.*', 'users.*')
            ->join('research', 'tb_feedback.research_id', '=', 'research.research_id')
            ->join('users', 'tb_feedback.id', '=', 'users.id')
            ->where('tb_feedback.research_id', '=', $id)
            ->get();
        $data_user = DB::table('users')
            ->join('tb_feedback', 'users.id', '=', 'tb_feedback.id')
            ->where('users.id', '=', $data[0]->id)
            ->where('tb_feedback.research_id', $id)
            ->get();

        return view('admin.datail.director-feedback1', ['data' => $data, 'data_user' => $data_user]);
        //dd($data[0],$data_user[0]);
    }
    public function direcFeed2($id)
    {
        $data = DB::table('tb_feedback')
            ->select('tb_feedback.*', 'research.*', 'users.*')
            ->join('research', 'tb_feedback.research_id', '=', 'research.research_id')
            ->join('users', 'tb_feedback.id', '=', 'users.id')
            ->where('tb_feedback.research_id', '=', $id)
            ->get();
        $data_user = DB::table('users')
            ->join('tb_feedback', 'users.id', '=', 'tb_feedback.id')
            ->where('users.id', '=', $data[1]->id)
            ->where('tb_feedback.research_id', $id)
            ->get();
        return view('admin.datail.director-feedback2', ['data' => $data, 'data_user' => $data_user]);
        //dd($data[0],$data_user);
    }
    public function direcFeed3($id)
    {
        $data = DB::table('tb_feedback')
            ->select('tb_feedback.*', 'research.*', 'users.*')
            ->join('research', 'tb_feedback.research_id', '=', 'research.research_id')
            ->join('users', 'tb_feedback.id', '=', 'users.id')
            ->where('tb_feedback.research_id', '=', $id)
            ->get();
        $data_user = DB::table('users')
            ->join('tb_feedback', 'users.id', '=', 'tb_feedback.id')
            ->where('users.id', '=', $data[2]->id)
            ->where('tb_feedback.research_id', $id)
            ->get();

        return view('admin.datail.director-feedback3', ['data' => $data, 'data_user' => $data_user]);
        //dd($data[0],$data_user);
    }

    public function viewFileFeed($id, $uid)
    {
        $p = DB::table('research')->select('*')->where('research_id', '=', $id)->get();
        $path = 'uploads/research/' . $p[0]->year_research . '/' . $p[0]->research_id;
        //$u = Auth::user()->id;
        $d = DB::table('tb_feedback')
            ->where('id', '=', $uid)
            ->where('research_id', '=', $id)
            ->get();
        //dd($id, $name,$path,$d);
        $file_name = $d[0]->suggestionFile;
        //dd($d);
        $file = $path . '/' . $file_name;
        return response()->file($file);
    }
}
