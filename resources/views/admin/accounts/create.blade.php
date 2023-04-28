@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card-header">
                <h4>
                    Thêm người dùng
                    <a href="{{ url('we-admin/accounts') }}" class="btn btn-sm btn-danger float-end text-white">
                        Trở lại
                    </a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('we-admin/accounts') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="">Tên tài khoản</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Mật khẩu</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
