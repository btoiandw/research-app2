@section('title', 'RDI-KPRU Admin ')
@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-5 px-lg-5">
        <div class="row justify-content-around mb-4 align-items-center">
            <div class="col-6 header">
                โครงร่างที่เสนอพิจารณา
            </div>
            <div class="col-2 text-end">
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
            <div class="card">
                <table class="table table-hover text-center justify-content-center" id='empTable'>
                    <thead>
                        <tr align="center">
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อโครงร่างงานวิจัย</th>
                            <th scope="col">กรรมการคนที่ 1</th>
                            <th scope="col">กรรมการคนที่ 2</th>
                            <th scope="col">กรรมการคนที่ 3</th>
                            <th scope="col">รายละเอียด</th>
                            <th scope="col">สรุปผล/ข้อเสนอแนะ</th>
                            <th scope="col">สัญญาทุน</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($data_send as $items)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $items->research_th }}</td>
                                <td>
                                    @if ($data_l[0]->Assessment_result == 'ผ่าน')
                                        <a href="{{ route('view-direc1', [$items->research_id]) }}"
                                            class="btn btn-success"><i class="fa-solid fa-circle-info"></i></a>
                                    @elseif ($data_l[0]->Assessment_result == 'ไม่ผ่าน')
                                        <a href="{{ route('view-direc1', [$items->research_id]) }}"
                                            class="btn btn-danger"><i class="fa-solid fa-circle-info"></i></a>
                                    @else
                                        <a href="{{ route('view-direc1', [$items->research_id]) }}"
                                            class="btn btn-secondary"><i class="fa-solid fa-circle-info"></i></a>
                                    @endif
                                </td>
                                <td>
                                    @if ($data_l[1]->Assessment_result == 'ผ่าน')
                                        <a href="{{ route('view-direc2', [$items->research_id]) }}"
                                            class="btn btn-success"><i class="fa-solid fa-circle-info"></i></a>
                                    @elseif ($data_l[1]->Assessment_result == 'ไม่ผ่าน')
                                        <a href="{{ route('view-direc2', [$items->research_id]) }}"
                                            class="btn btn-danger"><i class="fa-solid fa-circle-info"></i></a>
                                    @else
                                        <a href="{{ route('view-direc2', [$items->research_id]) }}"
                                            class="btn btn-secondary"><i class="fa-solid fa-circle-info"></i></a>
                                    @endif
                                    {{-- <a href="{{ route('view-direc2', [$items->research_id]) }}" class="btn btn-secondary"><i
                                            class="fa-solid fa-circle-info"></i></a> --}}
                                </td>
                                <td>
                                    @if ($data_l[2]->Assessment_result == 'ผ่าน')
                                        <a href="{{ route('view-direc3', [$items->research_id]) }}"
                                            class="btn btn-success"><i class="fa-solid fa-circle-info"></i></a>
                                    @elseif ($data_l[2]->Assessment_result == 'ไม่ผ่าน')
                                        <a href="{{ route('view-direc3', [$items->research_id]) }}"
                                            class="btn btn-danger"><i class="fa-solid fa-circle-info"></i></a>
                                    @else
                                        <a href="{{ route('view-direc3', [$items->research_id]) }}"
                                            class="btn btn-secondary"><i class="fa-solid fa-circle-info"></i></a>
                                    @endif
                                    {{-- <a href="{{ route('view-direc3', [$items->research_id]) }}" class="btn btn-secondary"><i
                                            class="fa-solid fa-circle-info"></i></a> --}}
                                </td>
                                <td>

                                    <a href="{{ route('send-detail', $items->research_id) }}"
                                        class="btn btn-secondary">รายละเอียด</a>
                                </td>
                                <td>
                                    <a href="{{ route('sum-feed', $items->research_id) }}" class="btn btn-info">
                                        <i class="fa-solid fa-plus"></i>
                                        สรุปข้อเสนอแนะ
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-success">อนุมัติ</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
