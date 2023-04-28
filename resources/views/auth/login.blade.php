@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-5">
            <div class="col-md-12 mt-5">
                <h1 class="text-center mb-5">Trang quản trị vintage korean</h1>
                <form method="POST" action="{{ route('login') }}" style="margin-top: 100px;">
                    @csrf

                    <div class="row mb-5">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Tên tài khoản</label>

                        <div class="col-md-5">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-5">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Mật khẩu</label>

                        <div class="col-md-5">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-md btn-outline-primary">
                                Đăng nhập
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
