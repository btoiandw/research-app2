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
                                        <a href="{{ route('view-refer', $items->research_id) }}" class="btn btn-info"
                                            {{-- data-bs-toggle="modal" data-bs-target="#refer" --}}>
                                            <i class="fa-solid fa-plus"></i>
                                            ข้อเสนอแนะ
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-success">
                                            <i class="fa-solid fa-plus"></i>
                                            กรรมการ
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Script -->
    {{-- <script type='text/javascript'>
        $(document).ready(function() {

            $('#empTable').on('click', '.viewdetails', function() {
                var empid = $(this).attr('data-id');

                if (empid > 0) {

                    // AJAX request
                    var url = "{{ route('show', [':empid']) }}";
                    url = url.replace(':empid', empid);

                    // Empty modal data
                    $('#tblempinfo tbody').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response) {

                            // Add employee details
                            $('#tblempinfo tbody').html(response.html);

                            // Display Modal
                            $('#empModal').modal('show');
                        }
                    });
                }
            });

        });
    </script> --}}
@endsection
