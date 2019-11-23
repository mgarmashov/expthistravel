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
            <li><a href="{{ route('product', ['id' => $productId]) }}">{{ \App\Models\Product::find($productId)->name }}</a></li>
        @endforeach
    </ul>
    @endif
    </p>

    <p>
        Do you have fixed dates for this trip?:
        @if($data->b_field_dates=='yes')
            Yes, from <b>{{ $data-> b_field_dates_from}}</b> to <b>{{ $data-> b_field_dates_to}}</b>
        @else
            No
        @endif
    </p>
    <p>
        How can we help you book your trip?
        @if($data->b_how_can_help)
            <b>{{ isset($data->b_how_can_help['experiences']) ? 'Experiences' : ''}}</b>
            <b>{{ isset($data->b_how_can_help['accom']) ? 'Accomodation' : ''}}</b>
            <b>{{ isset($data->b_how_can_help['transport']) ? 'Transport' : ''}}</b>
        @else
            Nothing
        @endif
    </p>

    <p>
        Comment: <br />
        {{ $data->b_comment ?? '' }}
    </p>

