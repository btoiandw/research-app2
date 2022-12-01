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
                                <label for="year_research" class="col-sm-2 col-form-label" align="right">ปีงบประมาณ</label>
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
                                    class="col-sm-2 col-form-label " align="right">{{--&emsp;&emsp; --}}ชื่อโครงร่างงานวิจัยภาษาไทย</label>
                                <div class=" col-sm-10">
                                    <textarea class="form-control" id="research_nameTH" name="research_nameTH"></textarea>
                                    @if ($errors->has('research_nameTH'))
                                        <span class="text-danger">{{ $errors->first('research_nameTH') }}</span>
                                    @endif
                                </div>
                                
                            </div>
                            <div class="row mb-3">
                                <label for="research_nameEN"
                                    class="col-sm-2 col-form-label" align="right">{{-- &emsp;&emsp; --}}ชื่อโครงร่างงานวิจัยภาษาอังกฤษ</label>
                                <div class=" col-sm-10">
                                    <textarea class="form-control" id="research_nameEN" name="research_nameEN"></textarea>
                                    @if ($errors->has('research_nameEN'))
                                        <span class="text-danger">{{ $errors->first('research_nameEN') }}</span>
                                    @endif 
                                </div>
                                
                            </div>
                            <div class="mb-3">

                                <div class="card" style="border: none">
                                    <label for="message-text"style="text-align:left;font-weight:600;font-size:18px;background:#fff;border:none" class="pt-3 py-0 card-header"
                                        >รายชื่อนักวิจัย</label>
                                    <div class="card-body pt-0">
                                        <table class="table table-responsive" id="tableTap" name="tableTap">
                                            <thead align="center">
                                                <tr>
                                                    <th width="600px">ชื่อ-นามสกุล</th>
                                                    <th width="600px">สังกัด/คณะ</th>
                                                    <th width="300px">บทบาทในการวิจัย</th>
                                                    <th width="300px">ร้อยละบทบาทในการวิจัย</th>
                                                    <th width=""> 
                                                        
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody align="center" id="roleResearch">
                                                <tr id="row[]">
                                                    <td>
                                                        <input type="text" name="researcher[]" id="researcher"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <select class="form-select" id="faculty" name="faculty[]">
                                                            <option value="">--เลือกสังกัด/คณะ--</option>
                                                            @foreach ($list_fac as $row)
                                                                @if ($row->major == '0')
                                                                    <option value="{{ $row->id }} ">
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
                                                        <select class="form-select " name="role-research[]"
                                                            id="role-research">
                                                            <option value="หัวหน้าโครงการวิจัย" selected readonly>หัวหน้าโครงการวิจัย</option>
                                                            <option value="ผู้ร่วมวิจัย">ผู้ร่วมวิจัย</option>
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="pc[]"
                                                            id="pc" placeholder="0.00"{{--   onchange="Vpc()"onKeyUp="Vpc();" --}} />
                                                    <input type="hidden" name="sum[]" id="sum">
                                                        </td>
                                                    <td>
                                                       <button type="button" name="addBtn" class="btn btn-info"
                                                            id="addBtn">+</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="message-text" class="col-sm-2 col-form-label" align="right">แหล่งทุนวิจัย</label>
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
                                <legend class="col-form-label col-sm-2 pt-0" align="right">ประเภทงานวิจัย</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type" id="type"
                                            value="ชุมชนท้องถิ่น">
                                        <label class="form-check-label" for="type">
                                            ชุมชนท้องถิ่น
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type" id="type"
                                            value="ศิลปวัฒนธรรม">
                                        <label class="form-check-label" for="gridRadios2">
                                            ศิลปวัฒนธรรม
                                        </label>
                                    </div>
                                    @if ($errors->has('type'))
                                        <span class="text-danger">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>
                               
                            </fieldset>

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label" align="right">คำสำคัญ</label>
                                <div class="col-sm-10">
                                    <textarea name="keyword" id="keyword" placeholder="คำสำคัญในการวิจัย" class="form-control"></textarea>
                                    @if ($errors->has('keyword'))
                                        <span class="text-danger">{{ $errors->first('keyword') }}</span>
                                    @endif
                                </div>
                                
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail3"
                                    class="col-sm-2 col-form-label" align="right">พื้นที่ในการวิจัย</label>
                                <div class="row col-sm-10">
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="ที่อยู่" name="address"
                                            aria-label="ที่อยู่">
                                            @if ($errors->has('address'))
                                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" placeholder="จังหวัด" name="city"
                                            aria-label="จังหวัด">
                                            @if ($errors->has('city'))
                                                <span class="text-danger">{{ $errors->first('city') }}</span>
                                            @endif
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" placeholder="รหัสไปรษณีย์"
                                            name="zipcode" aria-label="รหัสไปรษณีย์">
                                            @if ($errors->has('zipcode'))
                                                <span class="text-danger">{{ $errors->first('zipcode') }}</span>
                                            @endif
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
                                <label for="inputEmail3"
                                    class="col-sm-2 col-form-label" align="right">วันที่เริ่มต้นการวิจัย</label>
                                <div class="row col-sm-10">
                                    <div class="col-sm">
                                        <input class="form-control" id="sdate" name="sdate"
                                            placeholder="MM/DD/YYY" type="date" />
                                        @if ($errors->has('sdate'))
                                            <span class="text-danger">{{ $errors->first('sdate') }}</span>
                                        @endif
                                    </div>
                                    <label for="inputEmail3"
                                        class="col-sm-2 col-form-label " align="right">วันที่สิ้นสุดการวิจัย</label>
                                    <div class="col-sm">
                                        <div class="col-sm">
                                            <input class="form-control" id="edate" name="edate"
                                                placeholder="MM/DD/YYY" type="date" />
                                            @if ($errors->has('edate'))
                                                <span class="text-danger">{{ $errors->first('edate') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail3"
                                    class="col-sm-2 col-form-label" align="right">งบประมาณการวิจัย</label>
                                <div class="col-sm-10">
                                    <input name="budage" id="budage" type="number" placeholder="0.00"
                                        class="form-control">
                                    @if ($errors->has('budage'))
                                        <span class="text-danger">{{ $errors->first('budage') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label " align="right">ไฟล์ Word</label>
                                <div class=" col-sm-10">
                                    <input type="file" name="word" id="word" class=" form-control">
                                    <span class="text-danger">*ไฟล์ .doc และ .docx เท่านั้น</span>
                                    @if ($errors->has('word'))
                                        <span class="text-danger">{{ $errors->first('word') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" align="right">ไฟล์ PDF</label>
                                <div class=" col-sm-10">
                                    <input type="file" name="pdf" id="pdf" class=" form-control">
                                    <span class="text-danger">*ไฟล์ .pdf เท่านั้น</span>
                                    @if ($errors->has('pdf'))
                                        <span class="text-danger">{{ $errors->first('pdf') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer text-center" style="background-color: #fff">
                                <a href="{{ route('user.dashboard') }}" type="button" class="btn btn-danger">ยกเลิก</a>
                                <input type="submit" value="ยืนยัน" name="submit" class="btn btn-primary">
                            </div>
                    </form>
                </div>
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
        /* function Vpc(){
            //var row = document.getElementById('row[]').value;
            var inpc = document.getElementById('pc[]');
            var re = [];

            for(let i=1; i<inpc.length;i++){
                re.push(inpc[i]);
            }
            console.log(re);
        } */
        $(document).ready(function() {
            var i = 1;

            $('#addBtn').click(function() {
                i++;
                var tr = '<tr id="row' + i + '">' +
                    '<td><input type="text" name="researcher[]" id="researcher" class="form-control"></td>' +
                    '<td><select class="form-select" id="faculty" name="faculty[]"><option value="">--เลือกสังกัด/คณะ--</option> ' +
                    '@foreach ($list_fac as $row)' +
                        '@if ($row->major == '0')'+
                            '<option value = "{{ $row->id }}" >{{ $row->organizational }} </option>'+
                        '@else'+
                            '<option value = "{{ $row->id }}" >{{ $row->organizational }} &nbsp;&nbsp;{{ $row->major }}</option>'+
                        '@endif'+
                    '@endforeach'+
                    /* tr = tr + select_option(); */
                    +
                    '</td>' +
                    '<td><select class="form-select" name="role-research[]" id="role-research"><option value="หัวหน้าโครงการวิจัย">หัวหน้าโครงการวิจัย</option><option value="ผู้ร่วมวิจัย" selected readonly>ผู้ร่วมวิจัย</option></select></td>' +
                    '<td><input type="number" class="form-control" name="pc[]" id="pc"placeholder="0.00" onchange="Vpc()" /></td>' +
                    '<td><button type="button" id="btnDel" class="btn btn-danger" >-</button></td>' +
                    '</tr>';
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
                format: 'dd/mm/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);
        });
    </script>
@endsection
