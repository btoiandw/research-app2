@section('title', 'Research')
@extends('layouts.user')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('content')

    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-4 header">
                หน้าหลัก
            </div>
            <div class="col-4 text-end">
                <a class="btn btn-primary" href="{{ route('research.index') }}">เพิ่มโครงร่างงานวิจัย</a>
            </div>
        </div>
        <div class="row col-md-12 mb-3">
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

        </div>

        <div class="row justify-content-center">

            @if (! $list_res->isEmpty())
                <div class="card">
                    <table class="table table-hover text-center justify-content-center">
                        <thead>
                            <tr align="center">
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อโครงร่างงานวิจัย</th>
                                <th scope="col" width="200px">บทบาทในงานวิจัย</th>
                                <th scope="col" width="150px">รายละเอียด</th>
                                <th scope="col" width="150px">สถานะ</th>
                                <th scope="col" width="200px">จัดการ</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                ($i=1)
                            @endphp
                            @foreach ($list_res as $items)
                                <tr>
                                    <th>
                                        {{ $i++ }}
                                    </th>
                                    <td>
                                        {{ $items->research_th }}
                                    </td>
                                    <td>
                                        @if ($items->pc >= 50)
                                            หัวหน้าโครงการวิจัย
                                        @else
                                            ผู้ร่วมวิจัย
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-secondary">
                                            รายละเอียด
                                        </button>
                                    </td>
                                    {{-- 0=รอตรวจสอบ, 1=ไม่ผ่าน/ปรับปรุงครั้งที่ 1, 2=ไม่ผ่าน/ปรับปรุงครั้งที่ 2, 3=ไม่ผ่าน/ปรับปรุงครั้งที่ 3, 4=ผ่าน, 5=ยกเลิก --}}
                                    <td>
                                        @if ($items->research_status == 0)
                                            รอตรวจสอบ
                                        @elseif ($items->research_status == 1)
                                            ไม่ผ่าน/ปรับปรุงครั้งที่ 1
                                        @elseif ($items->research_status == 2)
                                            ไม่ผ่าน/ปรับปรุงครั้งที่ 2
                                        @elseif ($items->research_status == 3)
                                            ไม่ผ่าน/ปรับปรุงครั้งที่ 3
                                        @elseif ($items->research_status == 4)
                                            ผ่าน
                                        @elseif ($items->research_status == 5)
                                            ยกเลิก
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                            <button class="btn btn-warning me-md-1" type="button">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                แก้ไข
                                            </button>
                                            <button class="btn btn-danger" type="button">
                                                <i class="fa-solid fa-xmark"></i>
                                                ยกเลิก
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@endsection
