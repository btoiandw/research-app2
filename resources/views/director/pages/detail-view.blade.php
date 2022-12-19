@section('title', 'RDI-KPRU Director ')
@extends('layouts.director')

@section('content')
    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-4 ">
                <label style="font-size: 20px;" class=" fw-bold">รายละเอียดโครงร่างงานวิจัย</label>
                <label>รหัสโครงร่างงานวิจัย : {{ $data[0]->research_id }}</label>
            </div>
            <div class="col-4 text-end">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <div class="col-rt-3 equal-height">
                        <div class="sb-example-3">
                            <!-- partial:index.partial.html
                                                <div class="search__container">
                                                    <input class="search__input" type="text" placeholder="Search">
                                                </div>-->
                        </div>
                    </div>
                </div>
                {{-- <a class="btn btn-primary" href="{{ route('research.index') }}">เพิ่มโครงร่างงานวิจัย</a> --}}
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
                    <label class="col-form-label fw-bold">รายชื่อนักวิจัย</label>
                    <div class="card-body pt-0">
                        <table class="table table-responsive" id="tableTap" name="tableTap">
                            <thead align="center">
                                <tr>
                                    <th width="400px">ชื่อ-นามสกุล</th>
                                    <th width="600px">สังกัด/คณะ</th>
                                </tr>
                            </thead>
                            <tbody id="roleResearch">
                                @php
                                    $ro = '';
                                    for ($i = 0; $i < count($data); $i++) {
                                        echo '<tr>';
                                        echo '<td align="left">' . $data[$i]->name . '</td>';
                                        echo '<td align="left">' . $data[$i]->major . '&nbsp;&nbsp;' . $data[$i]->organizational . '</td>';
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
                            <a class="btn btn-warning" href="{{ route('view-word', $data[0]->research_id) }}"
                                target="_blank">WORD FILE</a>
                            <a class="btn btn-warning" href="{{ route('view-pdf', $data[0]->research_id) }}"
                                target="_blank">PDF FILE</a>
                        </div>
                    </div>
                </div>
                <div class=" card-footer d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ route('director.dashboard') }}" class="btn btn-danger" type="button">ย้อนกลับ</a>
                    <form action="" method="post">
                        <input type="hidden" name="research_id" id="research_id" value="{{ $data[0]->research_id }}">
                        <a href="{{ route('add-feed-pages',$data[0]->research_id) }}" class="btn btn-info"
                            type="button">เพิ่มข้อเสนอแนะ</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
