@section('title', 'RDI-KPRU Director ')
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
                            <th scope="col" width="150px">แหล่งทุน</th>
                            <th scope="col" width="200px">วันที่ส่ง</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col" width="150px">รายละเอียด</th>
                            <th scope="col" width="250px">ผลประเมิน/ข้อเสนอแนะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($data as $items)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $items->research_th }}</td>
                                <td>{{ $items->research_source_name }}</td>
                                <td>{{ $items->date_send_referess }}</td>
                                <td>{{ $items->status }}</td>
                                <td><a href="{{ route('detail-view', $items->research_id) }}" class="btn btn-secondary"><i
                                            class="fa-solid fa-circle-info"></i>&nbsp;<span>รายละเอียด</span></a></td>
                                <td>
                                    @if ($items->status == 'รอตรวจสอบ')
                                        <a href="{{ route('add-feed-pages', $items->research_id) }}" class="btn btn-info"><i
                                                class="fa-solid fa-plus"></i>&nbsp;<span>ประเมิน</span></a>
                                    @elseif ($items->status == 'กำลังตรวจสอบ')
                                        <a href="{{ route('edit-feed', $items->research_id) }}"
                                            class="btn btn-warning">ประเมินต่อ</a>
                                    @elseif ($items->status == 'ตรวจสอบแล้ว')
                                        <a href="{{ route('view-feed',$items->research_id) }}" class="btn btn-success">ดู</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
