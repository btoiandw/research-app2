@section('title', 'User dashboard')
@extends('layouts.user')
<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    .body {
        background: #B2B2B2;
        width: 100%;
    }

    .box-z {
        box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.5)
    }
</style>
@section('content')
    <div class="body">
        <div class="container py-5">
            {{--  <div class="row justify-content-around mb-4 align-items-center">
                <div class="col-4 header">
                    
                </div>
                <div class="col-4 text-end">

                </div>
            </div> --}}

            @if ($errors->any())
                <!-- ตรวจสอบว่ามี Error ของ validation ขึ้นมาหรือเปล่า -->

                <div class="alert alert-danger" id="ERROR_COPY" style="display:none;">
                    <ul style="list-style: none;">
                        @foreach ($errors->all() as $error)
                            <!-- ทำการ วน Loop เพื่อแสดง Error ของ validation ขึ้นมาทั้งหมด -->
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <!-- ref - https://laravel.com/docs/7.x/validation#DisplayingTheValidationErrors  -->
            @endif


            <div class="row justify-content-center">
                <div class="card box-z">
                    <div class="card-header" style="background-color: #fff;">
                        <div class="row justify-content-around align-items-center">
                            <div class="col-4">
                                <h4 class=" text-dark">เพิ่มโครงร่างงานวิจัย</h4>
                            </div>
                            <div class="col-4 text-end">
                                <?php
                                echo '<h7>' . thaidate('j F Y H:i:s') . '</h7>';
                                ?>
                            </div>
                        </div>

                    </div>
                    <form id="form-insert" name="form-insert" method="POST" action="{{ route('research.store') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class=" card-body">
                            <div class="row mb-3">
                                <label for="year_research" class="col-sm-2 col-form-label">ปีงบประมาณ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="year_research"
                                        value="{{ date('Y') + 544 }}" name="year_research">
                                    @if ($errors->has('year_research'))
                                        <span class="text-danger">{{ $errors->first('year_research') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="research_nameTH"
                                    class="col-sm-2 col-form-label">ชื่อโครงร่างงานวิจัย&emsp;&emsp;ภาษาไทย</label>
                                <div class=" col-sm-10">
                                    <textarea class="form-control" id="research_nameTH" name="research_nameTH"></textarea>
                                </div>
                                @if ($errors->has('research_nameTH'))
                                    <span class="text-danger">{{ $errors->first('research_nameTH') }}</span>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <label for="research_nameEN"
                                    class="col-sm-2 col-form-label">ชื่อโครงร่างงานวิจัย&emsp;&emsp;ภาษาอังกฤษ</label>
                                <div class=" col-sm-10">
                                    <textarea class="form-control" id="research_nameEN" name="research_nameEN"></textarea>
                                </div>

                                @if ($errors->has('research_nameEN'))
                                    <span class="text-danger">{{ $errors->first('research_nameEN') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="row col-sm-2 col-form-label">รายชื่อนักวิจัย</label>
                                <div class="card">
                                    <table class="table" id="tableTap" name="tableTap">
                                        <thead align="center">
                                            <tr>
                                                <th width="400px">ชื่อ-นามสกุล</th>
                                                <th width="">สังกัด/คณะ</th>
                                                <th width="200px">บทบาทในการวิจัย</th>
                                                <th width="200px">ร้อยละในการวิจัย</th>
                                                <th width="50px"></th>
                                            </tr>
                                        </thead>
                                        <tbody align="center" id="roleResearch">
                                            <tr>
                                                <td>
                                                    <input type="text" name="researcher[]" id="researcher"
                                                        class="form-control">

                                                </td>
                                                <td>
                                                    <select class="form-select" id="faculty" name="faculty[]">
                                                        <option value="">--เลือกสังกัด/คณะ--</option>
                                                        @foreach ($list_fac as $row)
                                                            @if ($row->major == '0')
                                                                <option value="{{ $row->id }}">
                                                                    {{ $row->organizational }}</option>
                                                            @else
                                                                <option value="{{ $row->id }}">
                                                                    {{ $row->organizational }}&nbsp;&nbsp;{{ $row->major }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select " name="role-research[]" id="role-research">
                                                        <option value="หัวหน้าโครงการวิจัย">หัวหน้าโครงการวิจัย</option>
                                                        <option value="ผู้ร่วมวิจัย">ผู้ร่วมวิจัย</option>
                                                    </select>

                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="pc[]" id="pc"
                                                        placeholder="0.00" />

                                                </td>
                                                <td>
                                                    <button type="button" name="addBtn[]" class="btn btn-info"
                                                        id="addBtn">+</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="message-text" class="col-sm-2 col-form-label">แหล่งทุนวิจัย</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="source_id" name="source_id">
                                        <option value="">--เลือกแหล่งทุน--</option>
                                        @foreach ($list_source as $row)
                                            <option value="{{ $row->research_sources_id }}">
                                                {{ $row->research_source_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('source_id'))
                                        <span class="text-danger">{{ $errors->first('source_id') }}</span>
                                    @endif
                                </div>

                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">ประเภทงานวิจัย</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" id="type"
                                            value="ชุมชนท้องถิ่น">
                                        <label class="form-check-label" for="type">
                                            ชุมชนท้องถิ่น
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" id="type"
                                            value="ศิลปวัฒนธรรม">
                                        <label class="form-check-label" for="gridRadios2">
                                            ศิลปวัฒนธรรม
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('type'))
                                    <span class="text-danger">{{ $errors->first('type') }}</span>
                                @endif
                            </fieldset>

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">คำสำคัญ</label>
                                <div class="col-sm-10">
                                    <textarea name="keyword" id="keyword" placeholder="คำสำคัญในการวิจัย" class="form-control"></textarea>
                                </div>
                                @if ($errors->has('keyword'))
                                    <span class="text-danger">{{ $errors->first('keyword') }}</span>
                                @endif
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">พื้นที่ในการวิจัย</label>
                                <div class="row col-sm-10">
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="ที่อยู่"
                                            aria-label="ที่อยู่">
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" placeholder="จังหวัด"
                                            aria-label="จังหวัด">
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" placeholder="รหัสไปรษณีย์"
                                            aria-label="รหัสไปรษณีย์">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                                <label>พื้นที่ในการวิจัย</label>
                                <textarea name="area_research" id="area_research" placeholder="" class="form-control"></textarea>
                                @if ($errors->has('area_research'))
                                    <span class="text-danger">{{ $errors->first('area_research') }}</span>
                                @endif
                            </div> --}}

                            <div class="row mb-3">

                            </div>
                            <div class="mb-3">
                                <label for="">วันที่เริ่มต้นการวิจัย</label>
                                <input class="form-control" id="sdate" name="sdate" placeholder="MM/DD/YYY"
                                    type="date" />
                                @if ($errors->has('sdate'))
                                    <span class="text-danger">{{ $errors->first('sdate') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="">วันที่สิ้นสุดการวิจัย</label>
                                <input class="form-control" id="edate" name="edate" placeholder="MM/DD/YYY"
                                    type="date" />
                                @if ($errors->has('edate'))
                                    <span class="text-danger">{{ $errors->first('edate') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label>งบประมาณการวิจัย</label>
                                <input name="budage" id="budage" type="number" placeholder="0.00"
                                    class="form-control form-floating" />
                                @if ($errors->has('budage'))
                                    <span class="text-danger">{{ $errors->first('budage') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <input type="file" name="word" id="word" class=" form-control">
                                <span class="text-danger">*ไฟล์ .doc และ .docx เท่านั้น</span>
                                @if ($errors->has('word'))
                                    <span class="text-danger">{{ $errors->first('word') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <input type="file" name="pdf" id="pdf" class=" form-control">
                                <span class="text-danger">*ไฟล์ .pdf เท่านั้น</span>
                                @if ($errors->has('pdf'))
                                    <span class="text-danger">{{ $errors->first('pdf') }}</span>
                                @endif
                            </div>
                            <div class="card-footer text-center">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                                <input type="submit" value="ยืนยัน" name="submit" class="btn btn-primary">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
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
        $(document).ready(function() {
            var i = 1;

            $('#addBtn').click(function() {
                i++;
                var tr = '<tr id="row' + i + '">';
                tr = tr +
                    '<td><input type="text" name="researcher[]" id="researcher" class="form-control"></td>';
                tr = tr + '<td><input type="text" class="form-control" name="faculty[]" id="faculty" ></td>'
                tr = tr +
                    '<td><select class="form-select " name="role-research[]" id="role-research"><option value="หัวหน้าโครงการวิจัย">หัวหน้าโครงการวิจัย</option><option value="ผู้ร่วมวิจัย" selected>ผู้ร่วมวิจัย</option></select></td>';
                tr = tr +
                    '<td><input type="number" class="form-control" name="pc[]" id="pc"placeholder="0.00" /></td>';
                tr = tr +
                    '<td><button type="button" id="btnDel" class="btn btn-danger" >-</button></td>';
                tr = tr + '</tr>';
                $('#roleResearch').append(tr);

                //alert('id:'.$id.'name:'.$name.'major:'.$major);
            });
        });
        $(document).on('click', '#btnDel', function() {
            $(this).closest('tr').remove();
        });

        $(document).ready(function() {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            var options = {
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);
        });
    </script>
@endsection
