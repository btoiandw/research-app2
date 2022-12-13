@section('title', 'RDI-KPRU Admin ')
@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-6 ">
                <h3>รายละเอียดโครงร่างงานวิจัย</h3>
                <label>ปี&nbsp;{{ $data->year_research }}&nbsp;&nbsp;id:{{ $data->research_id }}</label>
            </div>
            <div class="col-4 text-end">
                {{--  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <div class="col-rt-3 equal-height">
                        <div class="sb-example-3">
                            <!-- partial:index.partial.html -->
                            <div class="search__container">
                                <input class="search__input" type="text" placeholder="Search">
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <a class="btn btn-primary" href="{{ route('research.index') }}">เพิ่มโครงร่างงานวิจัย</a> --}}
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="card col-sm-12">
                <div class="mb-3 row">
                    <label  class="col-sm-3 col-form-label">ชื่อโครงร่างงานวิจัยภาษาไทย</label>
                    <div class="col-sm-9">
                        <textarea type="text" readonly class="form-control-plaintext"
                            value="">{{ $data->research_th }}</textarea>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
@endsection
