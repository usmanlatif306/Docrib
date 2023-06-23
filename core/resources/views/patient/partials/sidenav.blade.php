<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{ route('patient.dashboard') }}" class="sidebar__main-logo"><img
                    src="{{ getImage(getFilePath('logoIcon') . '/logo_dark.png') }}" alt="@lang('image')"></a>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{ menuActive('patient.dashboard') }}">
                    <a href="{{ route('patient.dashboard') }}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>

                {{-- <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('patient.appointment*', 3) }}">
                        <i class="menu-icon las la-handshake"></i>
                        <span class="menu-title">@lang('Appointments')</span>
                        @if (@$newAppointmentsCount)
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{ menuActive('patient.appointment*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('patient.appointment.booking') }} ">
                                <a href="{{ route('patient.appointment.booking') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Make Appoinment')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('patient.appointment.new') }} ">
                                <a href="{{ route('patient.appointment.new') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('New Appointments')</span>
                                    @if (@$newAppointmentsCount)
                                        <span
                                            class="menu-badge pill bg--danger ms-auto">{{ $newAppointmentsCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('patient.appointment.done') }} ">
                                <a href="{{ route('patient.appointment.done') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Done Appointments')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('patient.appointment.trashed') }} ">
                                <a href="{{ route('patient.appointment.trashed') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Trashed Appointments')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}


                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('patient.info*', 3) }}">
                        <i class="menu-icon las la-info-circle"></i>
                        <span class="menu-title">@lang('My Info')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('patient.info*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('patient.info.profile') }} ">
                                <a href="{{ route('patient.info.profile') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Profile')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <div class="text-center mb-3 text-uppercase">
                <span class="text--primary">{{ __(systemDetails()['name']) }}</span>
                <span class="text--success">@lang('V'){{ systemDetails()['version'] }} </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->

@push('script')
    <script>
        if ($('li').hasClass('active')) {
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            }, 500);
        }
    </script>
@endpush
