<?php

namespace App\Http\Controllers\backend;

use App\Models\Research;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller as Controller;
use App\Models\sendResearch;
use App\Models\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use DateTime;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list_user = DB::table('users')->get();
        $list_fac = DB::table('faculties')->get();
        $list_source = DB::table('research_sources')->get();
        return view(
            'user.create_page',
            [
                'list_source' => $list_source,
                'list_fac' => $list_fac,
                'list_user' => $list_user
            ]
        );
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
        $validation = $request->validate(
            [
                'year_research' => 'required|max:4',
                'research_nameTH' => 'required|unique:research,research_th',
                'research_nameEN' => 'required|unique:research,research_en',
                'researcher' => 'required',
                'researcher.*' => 'required',
                //'faculty' => 'required',
                //'faculty.*' => 'required', 
                'role-research' => 'required',
                'role-research.*' => 'required',
                'pc' => 'required',
                'pc.*' => 'required|',
                'source_id' => 'required',
                'type' => 'required',
                'type.*' => 'required',
                'keyword' => 'required',
                'address' => 'required',
                'city' => 'required',
                'zipcode' => 'required',
                'sdate' => 'required|date|after:tomorrow',
                'edate' => 'required|date|after:start_date',
                'budage' => 'required|numeric',
                'word' => 'required|file|mimes:doc,docx',
                'pdf' => 'required|file|mimes:pdf'
            ],
            [
                'year_research.required' => 'ข้อมูลห้ามเกิน 4 ตัว',
                'research_nameTH.required' => 'โปรดระบุชื่อโครงร่างภาษาไทย',
                'research_nameEN.required' => 'โปรดระบุชื่อโครงร่างภาษาอังกฤษ',
                'researcher.required' => 'โปรดระบุชื่อนักวิจัย',
                'researcher.*.required' => 'โปรดระบุชื่อนักวิจัย',
                //'faculty.required' => 'โปรดระบุสังกัด/คณะ',
                //'faculty.*.required' => 'โปรดระบุสังกัด/คณะ', 
                'role-research.required' => 'โปรดระบุบทบาทในการวิจัย',
                'role-research.*.required' => 'โปรดระบุบทบาทในการวิจัย',
                'pc.required' => 'โปรดระบุร้อยละบทบาทในการวิจัย',
                'pc.*.required' => 'โปรดระบุร้อยละบทบาทในการวิจัย',
                'source_id.required' => 'โปรดระบุชื่อแหล่งทุน',
                'type.required' => 'โปรดระบุประเภทในการวิจัย',
                'type.*.required' => 'โปรดระบุประเภทในการวิจัย',
                'keyword.required' => 'โปรดระบุคำสำคัญในการวิจัย',
                'address.required' => 'โปรดระบุพื้นที่ในการวิจัย',
                'city.required' => 'โปรดระบุพื้นที่ในการวิจัย',
                'zipcode.required' => 'โปรดระบุพื้นที่ในการวิจัย',
                //'area_research.required' => '',  
                'sdate.required' => 'โปรดระบุวันที่เริ่มทำการวิจัย',
                'edate.required' => 'โปรดระบุวันที่สิ้นสุดการทำการวิจัย',
                'budage.required' => 'โปรดระบุจำนวนเงินในการทำการวิจัย',
                'word.required' => 'โปรดระบุไฟล์ word และเป็นไฟล์ word เท่านั้น',
                'pdf.required' => 'โปรดระบุไฟล์ pdf และเป็นไฟล์ pdf เท่านั้น',
                'word.mimes' => 'โปรดระบุไฟล์ word เท่านั้น',
                'pdf.mimes' => 'โปรดระบุเป็นไฟล์ pdf เท่านั้น'
            ]
        );

        $type = $request->type;
        //$cType = count($type);
        $allType = array();
        if (count($request->type) > 1) {
            $allType = $type[0] . "_" . $type[1];
        } else {
            $allType = $type;
        }
        //dd($type, count($type), $allType);
        $address = $request->address;
        $city = $request->city;
        $zipcode = $request->zipcode;
        $area = $address . "_" . $city . "_" . $zipcode;

        //dd($type,$allType,$request->all());
        $re_id = DB::table('research')->count();
        if ($re_id == 0) {
            $id_re = 1;
        } else {
            $id_re = $re_id + 1;
        }
        //dd($id);
        $reYear = $request->year_research;
        $status = 0; //รอการตรวจสอบ

        //หา id user ตามชื่อที่กรอกมา

        $rc = $request->researcher;
        $us = array();
        $result = DB::table('users')->whereIn('name', $rc)->get('id'); //whereIn ใช้กับ where array
        for ($i = 0; $i < sizeof($rc); $i++) {
            if (empty($result[$i])) {
                $us = $request->researcher[$i];
                Alert::error('ไม่พบข้อมูลชื่อ-นามสกุลนักวิจัย', $us);
                return redirect()->back();
                //dd($rc, $result, sizeof($rc), $us,$i);
            }
        }

        $user_fac = array();
        $user_fac = DB::table('users')->select('users.id', 'users.organization_id', 'faculties.organizational', 'faculties.major')->join('faculties', 'users.organization_id', '=', 'faculties.id')->whereIn('users.name', $rc)->get();

        //เช็คค่าร้อยละงานวิจัยว่าครบ100มั้ย 
        $pc = collect($request->pc);  //collect=>จับ array เป็นกลุ่มเพื่อนับจำนวน
        $sumpc = $pc->reduce(function ($value, $sum) { //reduce => ค่าทุกตัวบวกกัน
            return $sum + $value;
        });

        if ($sumpc > 100) {
            Alert::error('ร้อยละบทบาทในการวิจัยไม่ควรเกิน 100');
            return redirect()->back();
        } elseif ($sumpc < 100) {
            Alert::error('ร้อยละบทบาทในการวิจัยไม่ควรน้อยกว่า 100');
            return redirect()->back();
        } else {
            //จัดการกับไฟล์
            if ($filew = $request->file('word')) {
                if ($filep = $request->file('pdf')) {
                    //get ชื่อไฟล์จากที่กรอก
                    $namep = $filep->getClientOriginalName();
                    $name = $filew->getClientOriginalName();

                    //แยกชื่ออกจากนามสกุลไฟล์ word
                    $eNamew = explode('.', $name);
                    $infow = end($eNamew);
                    //mix name+status to file name
                    $fileName_w = $id_re . "_" . $status . "." . $infow; //ทำการรวมตัวแปร $id กับ $status และ $infow
                    //แยกชื่ออกจากนามสกุลไฟล์ pdf
                    $eNamep = explode('.', $namep);
                    $infop = end($eNamep);
                    $fileName_p = $id_re . "_" . $status . "." . $infop;

                    $path = 'uploads/research/' . $reYear . '/' . $id_re;
                    //$filew->move('uploads/research/'.$reYear.'/'.$id_re, $fileName_w);
                    if ($filew->move($path, $fileName_w)) { //move=>เซฟในโฟลเดอร์ ''=>''แรกชื่อโฟลเดอร์ $name=>ชื่อไฟล์  ->จะอยู่ในโฟลเดอร์ public
                        if ($filep->move($path, $fileName_p)) {

                            /* DB::beginTransaction();
                            try { */
                            DB::insert(
                                'insert into research (research_id, research_th,research_en,research_source_id,type_research_id,keyword,date_research_start,date_research_end,research_area,budage_research,word_file,pdf_file,research_status,year_research) values (?, ?,?, ?,?, ?,?, ?,?, ?,?, ?,?, ?)',
                                //$op = 
                                [
                                    $id_re,
                                    $request->research_nameTH,
                                    $request->research_nameEN,
                                    $request->source_id,
                                    $allType,
                                    $request->keyword,
                                    $request->sdate,
                                    $request->edate,
                                    $area,
                                    $request->budage,
                                    $fileName_w,
                                    $fileName_p,
                                    $reYear,
                                    $status
                                ]


                            );
                            for ($i = 0; $i < sizeof($rc); $i++) {
                                DB::insert(
                                    'insert into send_research (research_id,id,pc) values (?, ?,?)',
                                    $ur =
                                        [$id_re, $result[$i], $request->pc[$i]]
                                );
                            }

                            //dd($op,$ur);


                            //dd($post);
                            DB::commit();
                            Alert::success('insert successfully!.');
                            return redirect()->route('user.dashboard');
                            /* } catch (Exception $e) {
                                //dd('error', $e);
                                DB::rollBack();
                            } */

                            /* for ($i = 0; $i < sizeof($rc); $i++) {
                                $data = [
                                    'research_id' => $id_re,
                                    'id' => $result[$i],
                                    'pc' => $request->pc[$i]
                                ];
                                /* $send = new sendResearch();
                                $send-> = ;
                                $send-> = ;
                                $send-> = ; 
                            }
                            DB::beginTransaction();
                            try {
                                $post->save();
                                //sendResearch::insert($data);
                                DB::commit();
                                Alert::success('insert successfully!.');
                                return redirect()->route('user.dashboard');
                            } catch (Exception $e) {
                                
                                DB::rollBack();
                                Alert::error('insert fail');
                                return redirect()->back();
                            } */
                        }
                    }
                }
            }
        }

        //

        //$send = array();


        //dd($user_fac, $result, $send_user, $post, $request->all());

        //dd($send, $post);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function show(Research $research)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function edit(Research $research)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Research $research)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function destroy(Research $research)
    {
        //
    }


    public function sumFeedDirec($id)
    {
        $data_sum = DB::table('research')
            ->where('research_id', '=', $id)
            ->orderByDesc('date_upload_file')
            ->get();
        //dd($data_sum[0]);
        return view('admin.pages.sum-feed-director', ['list' => $data_sum]);
    }

    public function addSumFeed(Request $request)
    {
        $research_id = $request->research_id;
        $data = DB::table('research')
            ->where('research_id', '=', $research_id)
            //->update(['research_summary_feedback'=>$request->suggestion,'research_status'=>'1'])
            ->get();
        $c_research = $data->count();
        $sumfeed = $data[0]->research_summary_feedback;

        /*
        0=รอตรวจสอบ, 
        1=ไม่ผ่าน/ปรับปรุงครั้งที่ 1, 
        2=ไม่ผ่าน/ปรับปรุงครั้งที่ 2, 
        3=ไม่ผ่าน/ปรับปรุงครั้งที่ 3, 
        4=ผ่าน, 
        5=ยกเลิก,
        6=รอการตวจสอบจากคระกรรมการ,
        7=ไม่ผ่านการตรวจสอบโดยแอดมิน 
        */
        if ($c_research == 1) {
            $status = "1";
        } elseif ($c_research == 2) {
            $status = "2";
        } elseif ($c_research == 3) {
            $status = "3";
        } elseif ($c_research == 4) {
            $status = "ไม่ผ่าน/ปรับปรุงครั้งที่ 4";
        } elseif ($c_research == 5) {
            $status = "ไม่ผ่าน/ปรับปรุงครั้งที่ 5";
        }
        $filefeed = $request->file('suggestionFile');
        $reYear = $data[0]->year_research;

        if ($request->AssessmentResults == "ไม่ผ่าน") {
            if ($request->suggestion != '') {
                $feed = $request->suggestion;
            } else {
                $feed = null;
            }
            if ($filefeed != '') {
                $file_name = $filefeed->getClientOriginalName();
                $eNamep = explode('.', $file_name);
                $infop = end($eNamep);
                $file = $research_id . "_" . $status . "." . $infop;
                $path = 'uploads/research/' . $reYear . '/' . $research_id; //path save file

                $filefeed->move($path, $file);
                $feed_file = $file;
            } else {
                $feed_file = null;
            }

            if ($request->submit = "ยืนยัน") {
                DB::table('research')
                    ->where('research_id', $research_id)
                    ->update([
                        'research_summary_feedback' => $feed,
                        'summary_feedback_file' => $feed_file,
                        'research_status' => $status
                    ]);
                return redirect()->route('admin.dashboard');
            } elseif ($request->submit = "บันทึก") {
                DB::table('research')
                    ->where('research_id', $research_id)
                    ->update([
                        'research_summary_feedback' => $feed,
                        'summary_feedback_file' => $feed_file,
                    ]);
                return redirect()->route('admin.dashboard');
            }
        }

        if ($request->AssessmentResults == "ผ่าน") {
            DB::table('research')
                ->where('research_id', $research_id)
                ->update([

                    'research_status' => '4'
                ]);
            return redirect()->route('admin.dashboard');
        }
        dd($request->all(), $data[0], $feed, $feed_file, $status);
        //DB::update('update research set research_summary_feedback = ?,research_status=? where research_id = ?', [$request->suggestion,'1',$$request->research_id]);

    }


    public function cancleResearch($id)
    {
        /* DB::table('research')
            ->where('research_id', '=', $id)
            ->get(); */
        DB::table('research')
            ->where('research_id', '=', $id)
            ->update([
                'research_status' => '5'
            ]);
        return redirect()->route('user.dashboard');
    }

    public function viewEdit1($id)
    {
        $data = DB::table('research')
            ->where('research_id', $id)
            //->and('research_status','=','1')
            ->orWhere('research_status', '=', '1')
            ->get();

        return view('user.pages.1.modify-r1', ['data' => $data]);
        //dd($id, $data[0]);
    }

    public function viewFileFeed1($id)
    {
        $p = DB::table('research')->select('*')->where('research_id', '=', $id)->get();
        $path = 'uploads/research/' . $p[0]->year_research . '/' . $p[0]->research_id;
        //$u = Auth::user()->id;

        $file_name = $p[0]->summary_feedback_file;
        //dd($d);
        $file = $path . '/' . $file_name;
        return response()->file($file);
    }
}
