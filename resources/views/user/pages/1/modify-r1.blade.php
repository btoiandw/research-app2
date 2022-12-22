@section('title', 'Research')
@extends('layouts.user')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('content')

    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-4 ">
                <label class="fw-bold" style="font-size: 20px">รายละเอียด</label>
                <br>
                <label>รหัสโครงร่างงานวิจัย : {{ $data[0]->research_id }}</label>
            </div>
            <div class="col-4 text-end">
                <a href="{{ route('modify-view-1',$data[0]->research_id) }}" class="btn btn-primary">เพิ่มไฟล์ปรับปรุงแก้ไข</a>
            </div>
        </div>
        <div class="row col-md-12 mb-3">

        </div>

        <div class="row justify-content-center">
            <div class=" card">
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
                    <label class="col-sm-3 col-form-label fw-bold">ผลประเมิน</label>
                    <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" value="ไม่ผ่าน">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label fw-bold">ข้อเสนอแนะ</label>
                    <div class="col-sm-9">
                        @if ($data[0]->research_summary_feedback != '')
                            <textarea type="text" readonly class="form-control-plaintext" name="" id="" cols="30">{{ $data[0]->research_summary_feedback }}</textarea>
                        @elseif ($data[0]->summary_feedback_file != '')
                            <a href="{{ route('view-file-feed-1',$data[0]->research_id) }}" target="_blank" class="btn btn-dark" style="background-color: #434242">ดู</a>
                        @endif
                        {{-- <input type="text" readonly class="form-control-plaintext" value=""> --}}
                    </div>
                </div>
                <div class=" card-footer d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ url()->previous() }}" class="btn btn-danger" type="button">ย้อนกลับ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
