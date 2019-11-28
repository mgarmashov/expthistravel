@php
    $user=\Illuminate\Support\Facades\Auth::user();
    $whoTravels = getAttr('q_who_travels');
    $adults = getAttr('q_how_many_adults');
    $child = getAttr('q_how_many_child');
    $travelStyle = getAttr('q_travel_style');
    $prefferedSight = getAttr('q_preferred_sight');
    $countriesArr = getAttr('q_countries');
    $experiencesArr = getAttr('q_experiences');
    $monthArr = getAttr('q3');

    $howLongFrom = getAttr('q_how_long_from');
    $howLongTo = getAttr('q_how_long_to');

    function getAttr($attr) {
        $user=\Illuminate\Support\Facades\Auth::user();
        return ($user && $user->$attr) ?  $user->$attr : (session()->has($attr) ? session()->get($attr) : null);
    }
@endphp

<p>
    First name: <b>{{ $data->b_name ?? '' }}</b>
</p>
<p>
    Surname: <b>{{ $data->b_surname ?? '' }}</b>
</p>
<p>
    Email: <b>{{ $data->b_email ?? '' }}</b>
</p>
<p>
    Phone number: <b>{{ $data->b_phone ?? '' }}</b>
</p>
<p>
    Select your experience:
    @if($data->b_products)
    <ul>
        @foreach( $data->b_products as $productId)
            <li><a href="{{ route('product', ['id' => $productId]) }}">{{ \App\Models\Product::find($productId)->name ?? '' }}</a></li>
        @endforeach
    </ul>
    @endif
    </p>

    <p>
        Do you have fixed dates for this trip?:
        @if($data->b_field_dates=='yes')
            Yes, from <b>{{ $data-> b_field_dates_from ?? ''}}</b> to <b>{{ $data-> b_field_dates_to ?? ''}}</b>
        @else
            No
        @endif
    </p>
    <p>
        How many people are travelling? Adults: <b>{{ $data->b_how_many_adults ?? '_' }}</b> Childs: <b>{{ $data->b_how_many_child ?? '_' }}</b>
    </p>
    <p>
        How can we help you book your trip?
        @if($data->b_how_can_help)
            <b>{{ isset($data->b_how_can_help['experiences']) ? config('questions.b_how_can_help.experiences') : ''}}</b>
            <b>{{ isset($data->b_how_can_help['accom']) ? config('questions.b_how_can_help.accom') : ''}}</b>
            <b>{{ isset($data->b_how_can_help['transport']) ? config('questions.b_how_can_help.transport') : ''}}</b>
        @else
            Nothing
        @endif
    </p>
    <p>
        Comment: <br />
        <b>{{ $data->b_comment ?? '' }}</b>
    </p>

    <hr>

    <p>Information from User profile/session:</p>

    <ul>
        @if($whoTravels)
            <li>Who travels: <b>{{ config('questions')['q_who_travels'][$whoTravels] }} Adults: {{ $adults }} Child: {{ $child }}</b></li>
        @endif
        @if($countriesArr)
            <li>Countries: <b>
            @foreach ($countriesArr as $key=>$value)
                {{ \App\Models\Country::find($value)->name ?? '' }},
            @endforeach
            </b>
            </li>
        @endif
        @if($monthArr)
            <li>Months: <b>
                    @foreach ($monthArr as $key=>$value)
                        {{ config('questions')['q3'][$value] }}
                    @endforeach
                </b>
            </li>
        @endif
        @if($travelStyle)
            <li>Travel Style: <b>{{ config('questions')['q_travel_style'][$travelStyle] ?? '' }}</b></li>
        @endif
        @if($howLongFrom)
            <li>Days: <b>{{ $howLongFrom }} - {{ $howLongTo }}</b></li>
        @endif
        @if($prefferedSight)
            <li>Preffered Sight: <b>{{ config('questions')['q_preferred_sight'][$prefferedSight] ?? '' }}</b></li>
        @endif
        @if($experiencesArr)
            <li><b>
                @foreach ($experiencesArr as $value)
                    {{ \App\Models\Experience::find($value)->name ?? '' }},
                @endforeach
                </b>
            </li>
        @endif
    </ul>



