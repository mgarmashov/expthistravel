    <p>
        Select Country or place: <b>
            @php
                if(isset($data->countries)) {
                    $arr = [];
                    foreach ($data->countries as $id) {
                        $arr[] = \App\Models\Country::find($id)->name;
                    }
                    $output = implode(', ', $arr);
                    echo $output;
                }
            @endphp
        </b>
    </p>
    <p>
        Select your experience:
        @if($data->products)
            <ul>
                @foreach( $data->products as $productId)
                    <li><a href="{{ route('product', ['id' => $productId]) }}">{{ \App\Models\Product::find($productId)->name }}</a></li>
                @endforeach
            </ul>
        @endif
    </p>

    <p>
        Choose months when you plan to travel:
        @if($data->months)
            <ul>
                @foreach( $data->months as $montId)
                    <li>{{ monthsList()[$montId] }}</li>
                @endforeach
            </ul>
        @endif
    </p>
    <p>
        First name: <b>{{ $data->name ?? '' }}</b>
    </p>
    <p>
        Surname: <b>{{ $data->surname ?? '' }}</b>
    </p>
    <p>
        Email: <b>{{ $data->email ?? '' }}</b>
    </p>
    <p>
        Phone number: <b>{{ $data->phone ?? '' }}</b>
    </p>
    <p>
        How many people will go: <b>{{ $data->people ?? '' }}</b>
    </p>
    <p>
        How long do you plan to travel: <b>{{ $data->duration ?? '' }}</b>
    </p>
    <p>
        Comment: <br />
        {{ $data->comment ?? '' }}
    </p>

