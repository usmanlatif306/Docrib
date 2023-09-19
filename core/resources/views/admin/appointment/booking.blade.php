@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-4 mb-30">
            <div class="card b-radius--5 overflow-hidden">
                <div class="card-body">
                    <div class="form-group">
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview"
                                        style="background-image: url({{ getImage(getFilePath('doctorProfile') . '/' . $doctor->image, getFileSize('doctorProfile')) }})">
                                        <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card b-radius--5 overflow-hidden mt-4">
                <div class="card-body p-0">
                    <h3 class="p-3">@lang('Doctor Information')</h3>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Doctor')
                            <span class="fw-bold">{{ __($doctor->name) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <a href="{{ route('admin.doctor.detail', $doctor->id) }}"><span
                                    class="fw-bold">{{ $doctor->username }}</span></a>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Email')
                            <span class="fw-bold">{{ $doctor->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            <span class="fw-bold"> @php echo $doctor->statusBadge @endphp</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Feature')
                            <span class="fw-bold"> @php echo $doctor->featureBadge @endphp</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Department')
                            <span class="fw-bold"> {{ __($doctor->department->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Location')
                            <span class="fw-bold"> {{ __($doctor->location->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Fees')
                            <span class="fw-bold"> {{ __($doctor->fees) }} {{ $general->cur_text }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 mb-30">
            <form action="{{ route('admin.appointment.store', $doctor->id) }}" method="post">
                @csrf
                <div class="card b-radius--10 overflow-hidden box--shadow1">
                    <div class="card-body p-0">
                        <div class="p-3 bg--white">
                            <div class="widget-two box--shadow2 b-radius--5 bg--white mb-4">
                                <i class="far fa-clock overlay-icon text--primary"></i>
                                <div class="widget-two__icon b-radius--5 bg--primary">
                                    <i class="far fa-clock"></i>
                                </div>
                                <div class="widget-two__content">
                                    @if (($doctor->start_time == null || $doctor->end_time == null) && $doctor->max_serial)
                                        <h3>{{ $doctor->max_serial }}</h3>
                                        <p>@lang('Limit of Serial')</p>
                                    @elseif($doctor->start_time && $doctor->end_time)
                                        <h3>{{ $doctor->start_time }} - {{ $doctor->end_time }}</h3>
                                        <p>@lang('Limit Of Time')</p>
                                    @endif
                                </div>
                            </div>

                            @livewire('appointment.check-slot', ['doctor' => $doctor])
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>

                <div class="card b-radius--10 overflow-hidden box--shadow1 mt-4">
                    <div class="card-body p-0">
                        <div class="p-3 bg--white">
                            <h3 class="py-2">@lang('Patient Information')</h3>

                            {{-- select patient livewire module --}}
                            @livewire('appointment.select-patient')

                            <div class="form-group">
                                <label>@lang('Disease Details')</label>
                                <textarea name="disease" class="form-control" rows="2" required></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" id="submitButton" class="btn btn--primary w-100 h-45"
                                    disabled>@lang('Submit')</button>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
        @include('partials.event-detail')
        {{-- <div class="col-12">
            <div class="card b-radius--5 overflow-hidden mt-4">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/datepicker.min.css') }}">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
@endpush

@push('script-lib')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js"></script>
    <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                slotMinTime: "{{ $data['slot_min_time'] }}",
                slotMaxTime: "{{ $data['slot_max_time'] }}",
                events: @json($data['events']),
                eventClick: function(info) {
                    let data = info.event.textColor.split(',');
                    var modal = $('#eventModal');
                    $('#doctor').text(data[0].split(':')[1]);
                    $('#time').text(data[1].split(';')[1]);
                    $('#chair').text(data[2].split(':')[1]);
                    $('#desease').text(data[3].split(':')[1]);
                    modal.modal('show');
                }
            });
            calendar.render();
        });
    </script>

    <script>
        (function($) {
            $('[name=time_serial]').on('change', function(e) {
                console.log(e.target.value);
            })
            "use strict";

            $(".available-time").on('click', function() {
                $(this).parent('.time-serial-parent').find('.btn--success').removeClass(
                    'btn--success disabled').addClass('btn--primary');

                $('[name=time_serial]').val($(this).data('value'));
                $(this).removeClass('btn--primary');
                $(this).addClass('btn--success disabled');
            })

            function slug(text) {
                return text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            }
            $("select[name=booking_date]").on('change', function() {

                $('.available-time').removeClass('btn--success disabled').addClass('btn--primary');

                let url = "{{ route('admin.appointment.available.date') }}";
                let data = {
                    date: $(this).val(),
                    doctor_id: '{{ $doctor->id }}'
                }

                $.get(url, data, function(response) {
                    $('[name=time_serial]').val('');
                    if (response.length == 0) {
                        $('.available-time').removeClass('btn--danger disabled');
                    } else {
                        $.each(response, function(key, value) {
                            var demo = slug(value);
                            $(`.item-${demo}`).addClass('btn--danger disabled');
                        });
                    }
                });
            });

            initTimePicker();

            function initTimePicker() {
                var start = new Date();
                start.setHours(9);
                start.setMinutes(0);

                var end = new Date();
                end.setHours("{{ $data['end_time'] }}");
                end.setMinutes(0);

                $('#starting').datepicker({
                    onlyTimepicker: true,
                    timepicker: true,
                    startDate: start,
                    endDate: end,
                    language: 'en',
                    // minHours: "{{ $data['start_time'] }}",
                    // maxHours: "{{ $data['end_time'] }}",
                    onSelect: function(time) {
                        Livewire.emit('startTimeSelected', time)
                    }
                });

                $('#ending').datepicker({
                    onlyTimepicker: true,
                    timepicker: true,
                    startDate: start,
                    endDate: end,
                    language: 'en',
                    // minHours: "{{ $data['start_time'] }}",
                    // maxHours: "{{ $data['end_time'] }}",
                    onSelect: function(time) {
                        Livewire.emit('endTimeSelected', time)
                    }
                });
            }

            window.addEventListener('slotCheck', event => {
                if (event.detail.result) {
                    $('#submitButton').removeAttr('disabled');
                } else {
                    $('#submitButton').attr('disabled', 'disabled');
                }
            })


        })(jQuery);
    </script>
@endpush
