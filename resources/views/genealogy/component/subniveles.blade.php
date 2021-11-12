<a class="a" onclick="tarjeta({{$data}},'{{ route('genealogy_type_id', [base64_encode($data->id)]) }}', '{{ asset('assets/img/royal_green/logos/logo.svg')}}')">
    <div class="media">
        {{--@if (empty($data->photoDB))
            <img src="{{ asset('assets/img/pandora-logo.png') }}" height="48" width="48"
                class="rounded-circle align-self-center mr-1 di" alt="{{ $data->firstname }}" title="{{ $data->firstname }}">
        @else--}}
            <img src="{{ asset('storage/' ) }}" height="48" width="48" class="rounded-circle align-self-center mr-1 di"
                alt="{{ $data->firstname }}" title="{{ $data->firstname }}">
        {{--@endif--}}
        <div class="media-body">
                            <h5 class="mt-0 a"> <b>{{ $data->firstname }}</b></h5>
                            <p class="mb-0">{{ $data->getStatus() }} |  {{$data->montoInvertido()}} USD </p>
        </div>
    </div>
</a>
