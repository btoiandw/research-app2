@section('title', 'Research')
@extends('layouts.user')

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
            <div class="card">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อโครงร่างงานวิจัย</th>
                            <th scope="col">รายละเอียด</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">จัดการ</th>

                        </tr>
                    </thead>
                    <tbody>
                        {{--  <tr>
                            <th scope="row">1</th>
                            <td></td>
                            <td>
                                <button class="btn btn-secondary">รายละเอียด</button>
                            </td>
                            <td></td>
                            <td>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <button class="btn btn-warning me-md-2" type="button">แก้ไข</button>
                                    <button class="btn btn-danger" type="button">ยกเลิก</button>
                                </div>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
