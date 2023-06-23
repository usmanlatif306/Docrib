@extends('doctor.layouts.master')
@section('content')
    <div class="login-main" style="background-image: url('{{ asset('assets/admin/images/login.jpg') }}')">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-8 col-sm-11">
                    <div class="login-area">
                        <div class="login-wrapper">
                            <div class="login-wrapper__top">
                                <a href="{{ route('home') }}">
                                    <h3 class="title text-white">@lang('Welcome to')
                                        <strong>{{ __($general->site_name) }}</strong>
                                    </h3>
                                </a>
                                <p class="text-white">{{ __($pageTitle) }} @lang('to') {{ __($general->site_name) }}
                                    @lang('Dashboard')</p>
                            </div>
                            <div class="login-wrapper__body">
                                <form action="{{ route('patient.register') }}" method="POST"
                                    class="cmn-form verify-gcaptcha login-form">
                                    @csrf
                                    <div class="form-group">
                                        <label>@lang('Name')</label>
                                        <input type="text" class="form-control" value="{{ old('name') }}"
                                            name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Username')</label>
                                        <input type="text" class="form-control" value="{{ old('username') }}"
                                            name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Email Address')</label>
                                        <input type="text" class="form-control" value="{{ old('email') }}"
                                            name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Mobile Number')</label>
                                        <input type="tel" class="form-control" value="{{ old('mobile') }}"
                                            name="mobile" required>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Address')</label>
                                        <input type="text" class="form-control" value="{{ old('address') }}"
                                            name="address" required>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Password')</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Password Confirmation')</label>
                                        <input type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                    <x-captcha></x-captcha>
                                    <button type="submit" class="btn cmn-btn w-100">@lang('Register')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
