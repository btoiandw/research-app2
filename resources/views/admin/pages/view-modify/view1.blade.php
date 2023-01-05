@section('title', 'RDI-KPRU Admin ')
@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-6 ">
                <label style="font-size: 24px" class="fw-bold">รายละเอียดข้อเสนอแนะ</label>
                <br>
                <label>รหัสโครงร่างงานวิจัย : {{ $data_feed[0]->research_id }}</label>
            </div>
            <div class="col-2 text-end">

            </div>
        </div>

        <div class="row justify-content-center">

            <div class="card col-sm-12">
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label fw-bold">ชื่อโครงร่างงานวิจัยภาษาไทย</label>
                    <div class="col-sm-9">
                        <textarea type="text" readonly class="form-control-plaintext" value="">{{ $data_feed[0]->research_th }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label fw-bold">ชื่อโครงร่างงานวิจัยภาษาอังกฤษ</label>
                    <div class="col-sm-9">
                        <textarea type="text" readonly class="form-control-plaintext" value="">{{ $data_feed[0]->research_en }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label fw-bold">ข้อสรุปข้อเสนอแนะ</label>
                    <div class="col-sm-9">
                        @if ($data_feed[0]->research_summary_feedback!=)
                            
                        @else
                            
                        @endif
                        <textarea type="text" readonly class="form-control-plaintext" value=""></textarea>
                    </div>
                </div>

                <div class=" card-footer d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-danger" type="button">ย้อนกลับ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
