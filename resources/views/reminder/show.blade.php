<div class="modal-body">
    <div class="product-card">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-1 mt-2">
                <b>{{ __('Date') }} : </b>
                {{ dateFormat($reminder->date) }}
                </p>
            </div>
            <div class="col-md-6">
                <p class="mb-1 mt-2">
                <b>{{ __('Time') }} : </b>
                {{ timeFormat($reminder->time) }}
                </p>
            </div>
            <div class="col-md-6">
                <p class="mb-1 mt-2">
                <b>{{ __('Created By') }} : </b>
                {{ !empty($reminder->createdBy) ? $reminder->createdBy->name : '-' }}
                </p>
            </div>
            <div class="col-md-6">
                <p class="mb-1 mt-2">
                <b>{{ __('Assign User') }} : </b>

                @foreach ($reminder->users() as $user)
                    {{ $user->name }}<br>
                @endforeach

                </p>
            </div>
            <div class="col-md-12">
                <p class="mb-1 mt-2">
                <b>{{ __('Subject') }} : </b>
                {{ $reminder->subject }}
                </p>
            </div>
            <div class="col-md-12">
                <p class="mb-1 mt-2">
                <b>{{ __('Message') }} : </b>
                {{ $reminder->message }}
                </p>
            </div>

        </div>
    </div>
</div>
