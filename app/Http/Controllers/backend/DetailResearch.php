<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as Controller;


use Illuminate\Http\Request;

class DetailResearch extends Controller
{
    //
    public function showDetail($id)
    {
        $data = DB::table('research')
            ->select('research.*'/* , 'send_research.*', 'users.*' */)->distinct('research.research_id')
           /*  ->join('send_research', 'research.research_id', '=', 'send_research.research_id')
            ->join('users', 'send_research.id', '=', 'users.id') */
            ->whereIn('research.research_id', $id)
            ->get();

        //dd($data);
        return redirect()->route('admin.dashboard', compact('data'));
    }
}
