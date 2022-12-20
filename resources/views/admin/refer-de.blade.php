@section('title', 'RDI-KPRU Admin ')
@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-4 ">
                <h2>ข้อเสนอแนะ</h2>
                <label>รหัสโครงร่างงานวิจัย: {{ $data[0]->research_id }}</label>
            </div>
            <div class="col-4 text-end">

                {{-- <a class="btn btn-primary" href="{{ route('research.index') }}">เพิ่มโครงร่างงานวิจัย</a> --}}
            </div>
        </div>

        <div class="row justify-content-center">
            <div class=" card col-12" style="border: none">
                <form action="{{ route('refer-add') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="research_id" id="research_id" value="{{ $data[0]->research_id }}">
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
                        <label class="col-sm-2 col-form-label fw-bold">ผลการประเมิน</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="AssessmentResults"
                                    id="AssessmentResults1" value="ไม่ผ่าน" checked>
                                <label class="form-check-label" for="AssessmentResults1">ไม่ผ่าน</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="AssessmentResults"
                                    id="AssessmentResults3" value="ผ่าน" {{-- disabled --}}>
                                <label class="form-check-label" for="AssessmentResults3">ผ่าน</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input onclick="sugges()" class="form-check-input" type="checkbox" id="mustAddFile"
                                    name="mustAddFile" value="mustAddFile">
                                <label class="form-check-label text-danger"
                                    for="mustAddFile">ต้องการเพิ่มไฟล์ข้อเสนอแนะ</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row " id="suggestion">
                        <label class="col-sm-2 col-form-label fw-bold">ข้อเสนอแนะ</label>
                        <div class="col-sm-10">
                            <textarea {{-- onkeyup="sugges()" --}} class="form-control" name="suggestion" {{-- id="suggestion" --}} rows="20"></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row" id="suggestionFile">
                        <label class="col-sm-2 col-form-label fw-bold">ไฟล์ข้อเสนอแนะ</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="suggestionFile" id="suggestionFile"
                                rows="20">
                            </ด>
                        </div>
                    </div>

                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-center">
                        <input class="btn btn-warning" type="submit" name="submit" value="บันทึก">
                        <input class="btn btn-success" type="submit" name="submit" value="ยืนยัน">
                        <a href="{{ url()->previous() }}" class="btn btn-danger" type="button">ย้อนกลับ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"
        integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            document.getElementById("suggestionFile").style.display = "none";
        });

        function sugges() {
            var ck = document.getElementById('mustAddFile');
            var x = document.getElementById("suggestionFile");
            var z = document.getElementById("suggestion");
            //x.value = x.value.toUpperCase();

            if (ck.checked == true) {
                console.log('true');
                Swal.fire({
                    /*  title: 'คุณแน่ใจ?', */
                    text: "คุณต้องการเพิ่มไฟล์ข้อเสนอแนะ ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่',
                    cancelButtonText: 'ไม่',
                }).then((result) => {
                    if (result.isConfirmed) {
                        x.style.display = "";
                        z.style.display = "none";
                    }
                    if (result.dismiss) {
                        //console.log('false');
                        ck.checked = false;
                        x.style.display = "none";
                        z.style.display = "";
                    }
                })

            } else {
                //console.log('false');
                x.style.display = "none";
                z.style.display = "";
            }

        }
    </script>
@endsection
