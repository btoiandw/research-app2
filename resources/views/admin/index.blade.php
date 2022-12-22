@section('title', 'RDI-KPRU Admin ')
@extends('layouts.admin')

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
            @if (!$list_res->isEmpty())

                <div class="card">
                    <table class="table table-hover text-center justify-content-center" id='empTable'>
                        <thead>
                            <tr align="center">
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อโครงร่างงานวิจัย</th>
                                <th scope="col" width="150px">รายละเอียด</th>
                                <th scope="col" width="150px">สถานะ</th>
                                <th scope="col" width="200px">สรุปผล/ข้อเสนอแนะ</th>
                                <th scope="col" width="150px">เพิ่มกรรมการ</th>
                                {{-- <th scope="col" width="200px">จัดการ</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
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
                                        <a href="{{ route('admin.show', $items->research_id) }}" {{-- data-bs-target="#show" --}}
                                            class="btn btn-secondary {{-- viewdetails' data-id='{{ $items->research_id }}' --}} " {{-- data-bs-toggle="modal" --}}>
                                            {{--  <button > --}}
                                            รายละเอียด
                                            {{-- </button> --}}
                                        </a>
                                    </td>
                                    {{-- 0=รอตรวจสอบ, 1=ไม่ผ่าน/ปรับปรุงครั้งที่ 1, 2=ไม่ผ่าน/ปรับปรุงครั้งที่ 2, 3=ไม่ผ่าน/ปรับปรุงครั้งที่ 3, 4=ผ่าน, 5=ยกเลิก,6=รอการตวจสอบจากคระกรรมการ,7=ไม่ผ่านการตรวจสอบโดยแอดมิน --}}
                                    <td>
                                        @if ($items->research_status == 0)
                                            รอตรวจสอบ
                                        @elseif ($items->research_status == 1)
                                            <a href="" class="btn btn-warning">ไม่ผ่าน/ปรับปรุงครั้งที่ 1</a>
                                        @elseif ($items->research_status == 2)
                                            ไม่ผ่าน/ปรับปรุงครั้งที่ 2
                                        @elseif ($items->research_status == 3)
                                            ไม่ผ่าน/ปรับปรุงครั้งที่ 3
                                        @elseif ($items->research_status == 4)
                                            ผ่าน
                                        @elseif ($items->research_status == 5)
                                            ยกเลิก
                                        @elseif ($items->research_status == 6)
                                            รอการตรวจสอบจากผู้ประเมิน
                                        @elseif ($items->research_status == 7)
                                            ไม่ผ่านการประเมินโดยแอดมิน
                                        @endif
                                    </td>
                                    <td>
                                        @if ($items->research_status != 0)
                                            <button class="btn btn-secondary"><i
                                                    class="fa-solid fa-circle-info"></i></button>
                                        @else
                                            <a href="{{ route('view-refer', $items->research_id) }}" class="btn btn-info"
                                                {{-- data-bs-toggle="modal" data-bs-target="#refer" --}}>
                                                <i class="fa-solid fa-plus"></i>
                                                ข้อเสนอแนะ
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($items->research_status != 0)
                                        @else
                                            <a href="{{ route('view-director', $items->research_id) }}"
                                                class="btn btn-success">
                                                <i class="fa-solid fa-plus"></i>
                                                กรรมการ
                                            </a>
                                        @endif

                                    </td>
                                    @if ($items->research_status == 4)
                                        <td scope="col">
                                            <a href="" class="btn btn-dark"
                                                style="background-color: #4B56D2; border:none">
                                                <i class="fa-solid fa-file-contract"></i>
                                                <span>อนุมัติสัญญาทุน</span>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
@endsection
