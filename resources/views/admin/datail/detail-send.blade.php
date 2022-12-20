@section('title', 'RDI-KPRU Admin ')
@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-4">
                <label style="font-size: 20px;" class=" fw-bold">รายละเอียดโครงร่างที่เสนอพิจารณา</label>
                <label style="font-size: 16px;">รหัสโครงร่างงานวิจัย : {{ $id }}</label>
            </div>
            <div class="col-4 text-end">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <div class="col-rt-3 equal-height">
                        <div class="sb-example-3">
                            <!-- partial:index.partial.html -->
                            <div class="search__container">
                                <input class="search__input" type="text" placeholder="Search">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <a class="btn btn-primary" href="{{ route('research.index') }}">เพิ่มโครงร่างงานวิจัย</a> --}}
            </div>
        </div>

        <div class="row justify-content-center">
            <div class=" card">

                <div class=" card-body">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label fw-bold">ชื่อโครงร่างงานวิจัยภาษาไทย</label>
                        <div class="col-sm-9">
                            <textarea type="text" readonly class="form-control-plaintext" value="">{{ $data[2]->research_th }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label fw-bold">ชื่อโครงร่างงานวิจัยภาษาไทย</label>
                        <div class="col-sm-9">
                            <textarea type="text" readonly class="form-control-plaintext" value="">{{ $data[2]->research_en }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label fw-bold">สถานะโครงร่างงานวิจัย</label>
                        <div class="col-sm-9" align="left">
                            @if ($data[2]->research_status == 0)
                                <input type="text" readonly class="form-control-plaintext" value="รอการตรวจสอบ">
                            @elseif ($data[2]->research_status == 1)
                                <input type="text" readonly class="form-control-plaintext"
                                    value="ไม่ผ่าน/ปรับปรุงครั้งที่ 1">
                            @elseif ($data[2]->research_status == 2)
                                <input type="text" readonly class="form-control-plaintext"
                                    value="ไม่ผ่าน/ปรับปรุงครั้งที่ 2">
                            @elseif ($data[2]->research_status == 3)
                                <input type="text" readonly class="form-control-plaintext"
                                    value="ไม่ผ่าน/ปรับปรุงครั้งที่ 3">
                            @elseif ($data[2]->research_status == 4)
                                <input type="text" readonly class="form-control-plaintext" value="ผ่าน">
                            @elseif ($data[2]->research_status == 5)
                                <input type="text" readonly class="form-control-plaintext" value="ยกเลิก">
                            @elseif ($data[2]->research_status == 6)
                                <input type="text" readonly class="form-control-plaintext"
                                    value="รอการตรวจสอบจากกรรมการ">
                            @elseif ($data[2]->research_status == 7)
                                <input type="text" readonly class="form-control-plaintext"
                                    value="ไม่ผ่านการประเมินโดยแอดมิน">
                            @endif

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-form-label fw-bold">รายชื่อนักวิจัย</label>
                        <div class="card-body pt-0">
                            <table class="table table-responsive" id="tableTap" name="tableTap">
                                <thead align="center">
                                    <tr>
                                        <th scope="col" width="50px">ลำดับ</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col" width="300px">สังกัด/คณะ</th>
                                        <th scope="col" width="350px">ร้อยละบทบาทในการวิจัย</th>
                                    </tr>
                                </thead>
                                <tbody id="roleResearch">
                                    @php
                                        $ro = '';
                                        
                                        for ($i = 0; $i < count($data_send); $i++) {
                                            echo '<tr align="center">';
                                            $x = 1 + $i;
                                            echo '<th>' . $x . '</th>';
                                            echo '<td>' . $data_send[$i]->name . '</td>';
                                            echo '<td>' . $data_send[$i]->major . '&nbsp;&nbsp;' . $data_send[$i]->organizational . '</td>';
                                            echo '<td align="center">' . $data_send[$i]->pc . '</td>';
                                            echo '</tr>';
                                        }
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-form-label fw-bold">รายชื่อคณะกรรมการประเมิน</label>
                        <div class="card-body pt-0">
                            <table class="table table-responsive" id="tableTap" name="tableTap">
                                <thead align="center">
                                    <tr>
                                        <th scope="col" width="400px">ชื่อ-นามสกุล</th>
                                        <th scope="col">วันที่ส่งให้</th>
                                        <th scope="col">วันที่ตรวจสอบ</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody id="roleResearch">
                                    @php
                                        $ro = '';
                                        for ($i = 0; $i < count($data); $i++) {
                                            echo '<tr>';
                                            echo '<td scope="col" align="left">' . $data[$i]->name . '</td>';
                                            echo '<td scope="col" align="center">' . $data[$i]->date_send_referess . '</td>';
                                            echo '<td scope="col" align="center">' . $data[$i]->Date_feedback_research . '</td>';
                                            echo '<td scope="col" align="center">
                                                <button type="button" class="btn btn-warning">แกไข</button>
                                                </td>';
                                            echo '</tr>';
                                        }
                                    @endphp
                                </tbody>
                            </table>
                        </div>


                    </div>

                </div>
                <div class=" card-footer d-grid gap-2 d-md-flex justify-content-md-center">
                    {{-- <form action="" method="post">
                        <input type="hidden" name="research_id" id="research_id" value="{{ $list[0]->research_id }}">
                        <input class="btn btn-warning" type="submit" name="submit" value="บันทึก">
                        <input class="btn btn-success" type="submit" name="submit" value="ยืนยัน">
                    </form> --}}
                    <a href="{{ url()->previous() }}" class="btn btn-danger" type="button">ย้อนกลับ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
