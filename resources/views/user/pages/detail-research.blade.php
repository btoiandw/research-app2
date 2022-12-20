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
        </div>
    </div>
@endsection
