<div class="row">
    <div class="col-md-12" wire:ignore>
        <div class="form-group">
            <label>@lang('Registered Patients')</label>
            <div class="form-group">
                <select id="patient" class="select2-basic">
                    <option selected disabled>@lang('Select Patient')</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name . '(' . $patient->email . ')' }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('Full Name')</label>
            <input type="text" name="name" class="form-control" required wire:model="name">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('Age')</label>
            <div class="input-group">
                <input type="number" name="age" step="any" class="form-control" value="{{ old('age') }}"
                    required>
                <span class="input-group-text">
                    @lang('Years')
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('E-mail')</label>
            <input type="email" name="email" class="form-control" wire:model="email" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">@lang('Mobile')
                <i class="fa fa-info-circle text--primary" title="@lang('Add the country code by general setting. Otherwise, SMS won\'t send to that number.')">
                </i>
            </label>
            <div class="input-group">
                <span class="input-group-text">{{ $general->country_code }}</span>
                <input type="number" name="mobile" wire:model="mobile" class="form-control" autocomplete="off"
                    required>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('livewire:load', () => {
            let patient = $('#patient');

            Livewire.hook('message.processed', (message, component) => {
                console.log(message);
            });


            patient.on('change', function(e) {
                @this.set('patient_id', e.target.value);
            })

        })
    </script>
@endpush
