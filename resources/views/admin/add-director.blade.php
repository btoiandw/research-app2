@section('title', 'RDI-KPRU Admin ')
@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-6">
                <h4>เพิ่มกรรมการตรวจสอบโครงร่างงานวิจัย</h4>
                <label>รหัสโครงร่างงานวิจัย: {{ $data[0]->research_id }}</label>
            </div>
            <div class="col-2 text-end">

            </div>
        </div>

        <div class="row justify-content-center">
            <div class=" card col-12" style="border: none">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="research_id" id="research_id" value="{{ $data[0]->research_id }}">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label fw-bold">ชื่อโครงร่างงานวิจัยภาษาไทย</label>
                        <div class="col-sm-9">
                            <textarea type="text" readonly class="form-control-plaintext" value="">{{ $data[0]->research_th }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label fw-bold">ประเภทงานวิจัย</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext"
                                value="{{ $data[0]->type_research_id }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label fw-bold">กรรมการท่านที่ 1</label>
                        <div class="col-sm-9">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>--เลือกชื่อกรรมการท่านที่ 1--</option>
                                @foreach ($list_direc as $rows)
                                    <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label fw-bold">กรรมการท่านที่ 2</label>
                        <div class="col-sm-9">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>--เลือกชื่อกรรมการท่านที่ 2--</option>
                                @foreach ($list_direc as $rows)
                                    <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label fw-bold">กรรมการท่านที่ 3</label>
                        <div class="col-sm-9">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>--เลือกชื่อกรรมการท่านที่ 3--</option>
                                @foreach ($list_direc as $rows)
                                    <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
