@section('title', 'Research')
@extends('layouts.user')
<style>
    .body {
        background: #F9F9F9;
        width: 100%;
    }

    .box-z {
        box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.5)
    }
</style>
@section('content')
    <div class="body">
        <div class="container-fluid py-5 px-lg-5">
            {{--  <div class="row justify-content-around mb-4 align-items-center">
                <div class="col-4 header">
                    
                </div>
                <div class="col-4 text-end">

                </div>
            </div> --}}

            @if ($errors->any())
                <!-- ตรวจสอบว่ามี Error ของ validation ขึ้นมาหรือเปล่า -->

                <div class="alert alert-danger" id="ERROR_COPY" {{-- style="display:none;" --}}>
                    <ul style="list-style: none;">
                        @foreach ($errors->all() as $error)
                            <!-- ทำการ วน Loop เพื่อแสดง Error ของ validation ขึ้นมาทั้งหมด -->
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif


            <div class="row justify-content-center">
                {{-- <div class="card box-z">
                    <div class="card-header" style="background-color: #fff;"> --}}
                <div class="row justify-content-around align-items-center">
                    <div class="col-4">
                        <h4 class=" text-dark">เพิ่มไฟล์การปรับปรุงแก้ไข</h4>
                    </div>
                    <div class="col-4 text-end">
                        <?php
                        echo '<h7>' . thaidate('j F Y H:i:s') . '</h7>';
                        ?>
                    </div>
                </div>

                {{--  </div> --}}
                <form id="form-insert" name="form-insert" method="POST" action="" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class=" card-body">
                        <div class="row mb-3">
                            <label for="year_research" class="col-sm-2 col-form-label" align="right">ปีงบประมาณ</label>
                            <div class="col-sm-10">
                                <input readonly type="text" class=" form-control-plaintext" id="year_research"
                                    value="{{ date('Y') + 544 }}" name="year_research">

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="research_nameTH" class="col-sm-2 col-form-label "
                                align="right">{{-- &emsp;&emsp; --}}ชื่อโครงร่างงานวิจัยภาษาไทย</label>
                            <div class=" col-sm-10">
                                <textarea class="form-control" id="research_nameTH" name="research_nameTH">{{ $data[0]->research_th }}</textarea>

                            </div>

                        </div>
                        <div class="row mb-3">
                            <label for="research_nameEN" class="col-sm-2 col-form-label"
                                align="right">{{-- &emsp;&emsp; --}}ชื่อโครงร่างงานวิจัยภาษาอังกฤษ</label>
                            <div class=" col-sm-10">
                                <textarea class="form-control" id="research_nameEN" name="research_nameEN">{{ $data[0]->research_en }}</textarea>

                            </div>

                        </div>
                        <div class="mb-3">

                            <div class="card" style="border: none">
                                <label
                                    for="message-text"style="text-align:left;font-weight:600;font-size:18px;background:#fff;border:none"
                                    class="pt-3 py-0 card-header">รายชื่อนักวิจัย</label>
                                <div class="card-body pt-0">
                                    <table class="table table-responsive" id="tableTap" name="tableTap">
                                        <thead align="center">
                                            <tr>
                                                <th>ชื่อ-นามสกุล</th>
                                                {{-- <th width="600px">สังกัด/คณะ</th>
                                                <th width="300px">บทบาทในการวิจัย</th> --}}
                                                <th>ร้อยละบทบาทในการวิจัย</th>
                                                <th width="">

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody align="center" id="roleResearch">
                                            @foreach ($data as $items)
                                                <tr id="row[]">
                                                    <td>
                                                        <input type="text" name="researcher[]" id="researcher"
                                                            class="form-control" value="{{ $items->name }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="pc[]"
                                                            id="pc" value="{{ $items->pc }}" />
                                                        <input type="hidden" name="sum[]" id="sum">
                                                    </td>
                                                    <td>
                                                        {{-- <button type="button" name="addBtn" class="btn btn-info"
                                                            id="addBtn">+</button> --}}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="message-text" class="col-sm-2 col-form-label" align="right">แหล่งทุนวิจัย</label>
                            <div class=" row col-sm-10">
                                <div class=" col-sm-3">
                                    <input readonly class="form-control-plaintext"
                                        value="{{ $data[0]->research_source_name }}">
                                </div>

                                <label for="message-text" class="col-sm-2 col-form-label"
                                    align="right">ประเภทงานวิจัย</label>
                                <div class=" col-sm">
                                    <input readonly class="col-sm-2 form-control-plaintext"
                                        value="{{ $data[0]->type_research_id }}">
                                </div>

                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label" align="right">คำสำคัญ</label>
                            <div class="col-sm-10">
                                <textarea name="keyword" id="keyword" placeholder="คำสำคัญในการวิจัย" class="form-control">{{ $data[0]->keyword }}</textarea>
                                <span class="text-danger">โปรดใช้เครื่องหมาย , ในการคั่นคำ</span>

                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label"
                                align="right">พื้นที่ในการวิจัย</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class=" form-control-plaintext"
                                    value="{{ $data[0]->research_area }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label"
                                align="right">วันที่เริ่มต้นการวิจัย</label>
                            <div class="row col-sm-10">
                                <div class="col-sm">
                                    <input class="form-control" id="sdate" name="sdate"
                                        value="{{ $data[0]->date_research_start }}" placeholder="MM/DD/YYY"
                                        type="date" />

                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label "
                                    align="right">วันที่สิ้นสุดการวิจัย</label>
                                <div class="col-sm">
                                    <div class="col-sm">
                                        <input class="form-control" id="edate" name="edate"
                                            placeholder="MM/DD/YYY" type="date"
                                            value="{{ $data[0]->date_research_end }}" />

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label"
                                align="right">งบประมาณการวิจัย</label>
                            <div class="col-sm-10">
                                <input name="budage" id="budage" type="number" placeholder="0.00"
                                    class="form-control" value="{{ $data[0]->budage_research }}">

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label " align="right">ไฟล์ Word</label>
                            <div class=" col-sm-10">
                                <input type="file" name="word" id="word" class=" form-control">
                                <span class="text-danger">*ไฟล์ .doc และ .docx เท่านั้น</span>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" align="right">ไฟล์ PDF</label>
                            <div class=" col-sm-10">
                                <input type="file" name="pdf" id="pdf" class=" form-control">
                                <span class="text-danger">*ไฟล์ .pdf เท่านั้น</span>

                            </div>
                        </div>

                        <div class="card-footer text-center" style="background-color: #fff">
                            <a href="{{ route('user.dashboard') }}" type="button" class="btn btn-danger">ยกเลิก</a>
                            <input type="submit" value="ยืนยัน" name="submit" class="btn btn-primary">
                        </div>
                </form>
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <script>
        var has_error = {{ $errors->count() > 0 ? 'true' : 'false' }};
        if (has_error) {
            Swal.fire({
                title: 'Error',
                icon: 'error',
                type: 'error',
                html: jQuery("#ERROR_COPY").html(),
                showCloseButton: true,
            });
        }
    </script>

    <script type="text/javascript">
        $(document).on('click', '#btnDel', function() {
            $(this).closest('tr').remove();
        });

        $(document).ready(function() {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            var options = {
                format: 'dd/mm/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);
        });
    </script>
@endsection
