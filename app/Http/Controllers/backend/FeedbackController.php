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
            ->select('tb_feedback.*', 'research.research_th', 'research.research_en')
            ->join('research', 'tb_feedback.research_id', '=', 'research.research_id')
            ->where('tb_feedback.research_id', '=', $id)
            ->get();
        $data_user = DB::table('users')
            ->where('id', '=', $data[0]->id)
            ->get();

        return view('admin.datail.director-feedback1', ['data' => $data, 'data_user' => $data_user]);
        //dd($data[0],$data_user);
    }
    public function direcFeed2($id)
    {
        $data = DB::table('tb_feedback')
            ->select('tb_feedback.*', 'research.research_th', 'research.research_en')
            ->join('research', 'tb_feedback.research_id', '=', 'research.research_id')
            ->where('tb_feedback.research_id', '=', $id)
            ->get();
        $data_user = DB::table('users')
            ->where('id', '=', $data[1]->id)
            ->get();

        return view('admin.datail.director-feedback2', ['data' => $data, 'data_user' => $data_user]);
        //dd($data[0],$data_user);
    }
    public function direcFeed3($id)
    {
        $data = DB::table('tb_feedback')
            ->select('tb_feedback.*', 'research.research_th', 'research.research_en')
            ->join('research', 'tb_feedback.research_id', '=', 'research.research_id')
            ->where('tb_feedback.research_id', '=', $id)
            ->get();
        $data_user = DB::table('users')
            ->where('id', '=', $data[2]->id)
            ->get();

        return view('admin.datail.director-feedback3', ['data' => $data, 'data_user' => $data_user]);
        //dd($data[0],$data_user);
    }

    
}
