@section('title', 'RDI-KPRU Admin ')
@extends('layouts.director')

@section('content')
    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-4 header">
                หน้าหลัก
            </div>
            <div class="col-4 text-end">
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
            <div class=" card">
                <table class="table table-hover text-center justify-content-center" id='empTable'>
                    <thead>
                        <tr align="center">
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อโครงร่างงานวิจัย</th>
                            <th scope="col" >แหล่งทุน</th>
                            <th scope="col">วันที่ส่ง</th>
                            <th scope="col" >รายละเอียด</th>
                            <th scope="col">ผลประเมิน/ข้อเสนอแนะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1
                        @endphp
                        @foreach ($data as $items)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $items->research_th }}</td>
                                <td>{{ $items->research_source_name }}</td>
                                <td>{{ $items->date_send_referess }}</td>
                                <td><button class="btn btn-secondary"><i class="fa-solid fa-circle-info"></i>&nbsp;<span>รายละเอียด</span></button></td>
                                <td><button class="btn btn-info"><i class="fa-solid fa-plus"></i>&nbsp;<span>ผลประเมิน/ข้อเสนอแนะ</span></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
