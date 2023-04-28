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
                        Danh sách tài khoản
                        <a href="{{ url('we-admin/accounts/create') }}" class="btn btn-sm btn-primary float-end text-white">
                            Thêm tài khoản
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bodered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên tài khoản</th>
                                <th>Email</th>
                                <th>Quyền truy cập</th>
                                <th>Xóa tài khoản</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <th>{{ $user->id }}</th>
                                    <th>{{ $user->name }}</th>
                                    <th>{{ $user->email }}</th>
                                    <th>
                                        <p>Quyền hiện tại: {{ $user->role_as == '1' ? 'Admin' : 'Người dùng' }} </p>
                                        <a href="{{ url("we-admin/accounts/$user->id") }}"
                                            class="btn {{ $user->role_as == '1' ? 'btn-danger' : 'btn-primary' }} text-white ">
                                            {{ $user->role_as == '1' ? 'Hạ quyền' : 'Cấp quyền Admin' }}</a>
                                    </th>
                                    <th><a href="#" class="btn btn-danger text-white">Xóa</a></th>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="5">No record</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
