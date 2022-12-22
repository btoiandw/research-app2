@section('title', 'RDI-KPRU Admin ')
@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-6">
                <label style="font-size: 20px">รายละเอียดโครงร่างที่เสนอพิจารณา</label>

                <p>รหัสโครงร่างงานวิจัย : {{ $data[2]->research_id }}</p>
            </div>
            <div class="col-2 text-end">
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
            <div class="card">
                <div class="card-header" style="background-color: #fff;font-size:20px;">
                    กรรมการท่านที่ 3 
                </div>
                <div class=" card-body">{{ $data_user[0]->name }}
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label fw-bold">ชื่อโครงร่างงานวิจัยภาษาไทย</label>
                        <div class="col-sm-9">
                            <textarea type="text" readonly class="form-control-plaintext" value="">{{ $data[0]->research_th }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label fw-bold">ผลการประเมิน</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class=" form-control-plaintext" name="Assessment_result"
                                id="Assessment_result" value="{{ $data_user[0]->Assessment_result }}">
                        </div>
                    </div>
                    @if ($data_user[0]->feedback != '')
                        <div class="mb-3 row ">
                            <label class="col-sm-2 col-form-label fw-bold">ข้อเสนอแนะ</label>
                            <div class="col-sm-10">
                                <textarea readonly class=" form-control-plaintext" name="suggestion" >{{ $data_user[0]->feedback }}</textarea>
                            </div>
                        </div>
                    @elseif ($data_user[0]->suggestionFile != '')
                        <div class="mb-3 row ">
                            <label class="col-sm-2 col-form-label fw-bold">ข้อเสนอแนะ</label>
                            <div class="col-sm-10">
                                <a href="{{ route('view-file-feed-admin',[$data[0]->research_id,$data_user[0]->id]) }}" class="btn btn-warning" name="suggestionFile"
                                    target="_blank">ดูไฟล์</a>
                            </div>
                        </div>
                    @else
                        <div class="mb-3 row ">
                            <label class="col-sm-2 col-form-label fw-bold">ข้อเสนอแนะ</label>
                            <div class="col-sm-10">
                                <input type="text" class=" form-control-plaintext" readonly value="ไม่มีข้อเสนอแนะ">
                            </div>
                        </div>
                    @endif
                </div>
                <div class=" card-footer d-grid gap-2 d-md-flex justify-content-md-center" style="background-color: #fff">
                    <a href="{{ url()->previous() }}" class="btn btn-danger" type="button">ย้อนกลับ</a>
                </div>
            </div>

        </div>
    </div>
@endsection
