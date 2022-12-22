@section('title', 'RDI-KPRU Director ')
@extends('layouts.director')

@section('content')
    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-4 ">
                <label style="font-size: 20px;" class=" fw-bold">ประเมินผลโครงร่างงานวิจัย</label>
                <br>
                <label>รหัสโครงร่างงานวิจัย : {{ $list[0]->research_id }}</label>
            </div>
            <div class="col-4 text-end">

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="card col-sm-12">
                <form action="{{ route('update-feed') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="research_id" id="research_id" value="{{ $list[0]->research_id }}">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label fw-bold">ชื่อโครงร่างงานวิจัยภาษาไทย</label>
                        <div class="col-sm-9">
                            <textarea type="text" readonly class="form-control-plaintext" value="">{{ $list[0]->research_th }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label fw-bold">ผลการประเมิน</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class=" form-control-plaintext" name="Assessment_result"
                                id="Assessment_result" value="{{ $list[0]->Assessment_result }}">
                        </div>
                    </div>
                    @if ($list[0]->feedback != '')
                        <div class="mb-3 row ">
                            <label class="col-sm-2 col-form-label fw-bold">ข้อเสนอแนะ</label>
                            <div class="col-sm-10">
                                <textarea readonly class=" form-control-plaintext" name="suggestion" >{{ $list[0]->feedback }}</textarea>
                            </div>
                        </div>
                    @elseif ($list[0]->suggestionFile != '')
                        <div class="mb-3 row ">
                            <label class="col-sm-2 col-form-label fw-bold">ข้อเสนอแนะ</label>
                            <div class="col-sm-10">
                                <a href="{{ route('view-file-feed',[$list[0]->research_id, $list[0]->suggestionFile]) }}" class="btn btn-warning"
                                    name="suggestionFile" {{-- value="{{ $list[0]->suggestionFile }}" --}} target="_blank">ดูไฟล์</a>
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

                    <div class=" card-footer d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="{{ route('director.dashboard') }}" class="btn btn-danger" type="button">ย้อนกลับ</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"
        integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>

@endsection
