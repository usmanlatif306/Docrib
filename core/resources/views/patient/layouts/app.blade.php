@extends('patient.layouts.master')

@section('content')
    <div class="page-wrapper default-version">
        @include('patient.partials.sidenav')
        @include('patient.partials.topnav')
        <div class="body-wrapper">
            <div class="bodywrapper__inner">
                @include('patient.partials.breadcrumb')
                @yield('panel')
            </div>
        </div>
    </div>
@endsection
