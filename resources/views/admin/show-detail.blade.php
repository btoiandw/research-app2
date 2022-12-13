@section('title', 'RDI-KPRU Admin ')
@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-6 ">
                <h3>รายละเอียดโครงร่างงานวิจัย</h3>
                <label>ปี&nbsp;{{ $data[0]->year_research }}&nbsp;&nbsp;id:{{ $data[0]->research_id }}</label>
                <span>วันเวลาที่ส่ง:&nbsp;{{ $data[0]->date_upload_file }}</span>
            </div>
            <div class="col-4 text-end">

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="card col-sm-12">
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label fw-bold">ชื่อโครงร่างงานวิจัยภาษาไทย</label>
                    <div class="col-sm-9">
                        <textarea type="text" readonly class="form-control-plaintext" value="">{{ $data[0]->research_th }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label fw-bold">ชื่อโครงร่างงานวิจัยภาษาอังกฤษ</label>
                    <div class="col-sm-9">
                        <textarea type="text" readonly class="form-control-plaintext" value="">{{ $data[0]->research_en }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">

                    <label class="col-form-label">รายชื่อนักวิจัย</label>
                    <div class="card-body pt-0">
                        <table class="table table-responsive" id="tableTap" name="tableTap">
                            <thead align="center">
                                <tr>
                                    <th width="400px">ชื่อ-นามสกุล</th>
                                    <th width="600px">สังกัด/คณะ</th>
                                    <th width="300px">บทบาทในการวิจัย</th>
                                    <th width="350px">ร้อยละบทบาทในการวิจัย</th>
                                </tr>
                            </thead>
                            <tbody id="roleResearch">
                                @php
                                    $ro = '';
                                    for ($i = 0; $i < count($data); $i++) {
                                        echo '<tr>';
                                        echo '<td align="left">' . $data[$i]->name . '</td>';
                                        echo '<td align="left">' . $data[$i]->major . '&nbsp;&nbsp;' . $data[$i]->organizational . '</td>';
                                        if ($data[$i]->pc >= 50) {
                                            echo '<td align="center">หัวหน้าโครงการวิจัย</td>';
                                        } else {
                                            echo '<td align="center">ผู้ร่วมโครงการวิจัย</td>';
                                        }
                                        echo '<td align="center">' . $data[$i]->pc . '</td>';
                                        echo '</tr>';
                                    }
                                @endphp
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label fw-bold">ชื่อแหล่งทุน</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control-plaintext"
                                value="{{ $data[0]->research_source_name }}">
                        </div>
                        <label class="col-sm-2 col-form-label fw-bold">ประเภทงานวิจัย</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control-plaintext"
                                value="{{ $data[0]->type_research_id }}">
                        </div>
                    </div>
                    <div class="mb-3 row">

                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label fw-bold">คำสำคัญ</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $data[0]->keyword }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">วันที่เริ่มต้นการวิจัย</label>
                        <div class="row col-sm-10">
                            <div class="col-sm-4">
                                <input class="form-control-plaintext" id="sdate" name="sdate" placeholder="MM/DD/YYY"
                                    type="date" readonly value="{{ $data[0]->date_research_start }}" />
                            </div>
                            <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">วันที่สิ้นสุดการวิจัย</label>
                            <div class="col-sm">
                                <div class="col-sm">
                                    <input class="form-control-plaintext" id="edate" name="edate"
                                        placeholder="MM/DD/YYYY" readonly type="date"
                                        value="{{ $data[0]->date_research_end }}" />

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label fw-bold">พื้นที่ในการวิจัย</label>
                        <div class="col-sm-3">
                            <input type="text" readonly class="form-control-plaintext"
                                value="{{ $data[0]->research_area }}">
                        </div>
                        <label class="col-sm-3 col-form-label fw-bold">งบประมาณในการวิจัย</label>
                        <div class="col-sm-3">
                            <input type="text" readonly class="form-control-plaintext"
                                value="{{ $data[0]->budage_research }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="d-grid gap-2 d-md-flex mx-auto">
                            <a class="btn btn-warning" href="uploads/research/{{ $data[0]->year_research }}/{{ $data[0]->research_id }}/{{ $data[0]->word_file }}" target="_blank">WORD FILE</a>
                            <a class="btn btn-warning" href="uploads/research/{{ $data[0]->year_research }}/{{ $data[0]->research_id }}/{{ $data[0]->pdf_file }}" target="_blank">PDF FILE</a>
                        </div>
                    </div>
                </div>
                <div class=" card-footer d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-danger" type="button">ย้อนกลับ</a>
                    <button class="btn btn-success" type="button">เพิ่มข้อเสนอแนะ</button>
                </div>
            </div>
        </div>
    </div>

@endsection
