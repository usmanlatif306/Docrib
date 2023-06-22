<div class="row">
    <div class="col-12">
        @if (session('error'))
            <div class="alert alert-danger p-3" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="mb-2 date-label">@lang('Select Date')</label>
            <input type="date" class="form-control" name="booking_date" id=""
                min="{{ now()->format('Y-m-d') }}" wire:model="date" required>
        </div>
    </div>
    <div class="col-md-6" wire:ignore>
        <div class="form-group">
            <label>@lang('Procedures')</label>
            <div class="form-group">
                {{-- select2-basic --}}
                <select id="procedure" class="select2-basic" name="procedure" required>
                    <option selected disabled>@lang('Select Procedure')</option>
                    @foreach ($procedures as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="mb-2 date-label">@lang('Start Time')</label>
            <input type="text" id="starting" class="form-control time-picker" name="starting" wire:model="starting"
                required autocomplete="off">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="mb-2 date-label">@lang('End Time')</label>
            <input type="text" id="ending" class="form-control time-picker" name="ending" wire:model="ending"
                required autocomplete="off">
        </div>
    </div>

    {{-- chairs buttons --}}
    <div class="col-md-12 my-3 text-center">
        <input type="radio" class="btn-check" name="chair" value="Chair 1" id="chair1" wire:model="chair"
            required>
        <label class="btn btn-outline-primary shadow-none" for="chair1">@lang('Chair 1')
        </label>

        <input type="radio" class="btn-check" name="chair" value="Chair 2" id="chair2" wire:model="chair"
            required>
        <label class="btn btn-outline-primary shadow-none mx-4" for="chair2">@lang('Chair 2')</label>

        <input type="radio" class="btn-check" name="chair" value="Chair 3" id="chair3" wire:model="chair"
            required>
        <label class="btn btn-outline-primary shadow-none" for="chair3">@lang('Chair 3')</label>
    </div>

</div>
