@extends('doctor.layouts.master')
@section('content')
    <div class="login-main" style="background-image: url('{{ asset('assets/admin/images/login.jpg') }}')">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-sm-11">
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
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('First Name')</label>
                                                <input type="text" class="form-control" value="{{ old('first_name') }}"
                                                    name="first_name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Last Name')</label>
                                                <input type="text" class="form-control" value="{{ old('last_name') }}"
                                                    name="last_name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Username')</label>
                                                <input type="text" class="form-control" value="{{ old('username') }}"
                                                    name="username" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Email Address')</label>
                                                <input type="text" class="form-control" value="{{ old('email') }}"
                                                    name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Phone Number')</label>
                                                <input type="tel" class="form-control" value="{{ old('mobile') }}"
                                                    name="mobile" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Gender')</label>
                                                <select name="gender" id=""
                                                    class="form-control form-control-select" required>
                                                    <option value="">@lang('Select Gender')</option>
                                                    <option value="male">@lang('Male')</option>
                                                    <option value="female">@lang('Female')</option>
                                                    <option value="transgender">@lang('Transgender')</option>
                                                    <option value="other">@lang('Other')</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Address')</label>
                                                <input type="text" class="form-control" value="{{ old('address') }}"
                                                    name="address" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Post Office')</label>
                                                <input type="text" class="form-control" value="{{ old('post_office') }}"
                                                    name="post_office" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('City')</label>
                                                <input type="text" class="form-control" value="{{ old('city') }}"
                                                    name="city" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Nationality')</label>
                                                <input type="text" class="form-control" value="{{ old('nationality') }}"
                                                    name="nationality" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Social Security Code')</label>
                                                <input type="text" class="form-control"
                                                    value="{{ old('social_security_code') }}" name="social_security_code"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Language')</label>
                                                <input type="text" class="form-control" value="{{ old('language') }}"
                                                    name="language" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>@lang('Lease Payments')</label>
                                                <input type="text" class="form-control"
                                                    value="{{ old('lease_payments') }}" name="lease_payments" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>@lang('How did you find about clinic?')</label>
                                                <textarea class="form-control form-control-textarea" name="how_find_us" rows="5" required>{{ old('how_find_us') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Password')</label>
                                                <input type="password" class="form-control" name="password" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>@lang('Password Confirmation')</label>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    required>
                                            </div>
                                        </div>
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
