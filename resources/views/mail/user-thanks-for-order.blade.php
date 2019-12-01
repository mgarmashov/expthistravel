@extends('mail.template')

@section('title')
    You've got new order
@endsection

@section('preheader')
    You've got new order
@endsection


@section('content')
    <h1>Thank you for your enquiry.</h1>
    <h2> We'll be in touch shortly</h2>
    <table border="0" cellpadding="0" cellspacing="0">
        <tr style="text-align: center">
            <td>
                <h3>Hello {{ $request->b_name ?? '' }}!</h3>
                <p>You made an order!</p>
            </td>
        </tr>
        <tr>
            <hr/>
            <td>Please check that information is correct:</td>
        </tr>
        <tr>
            <td>

                @if($request->b_name)Your name is <b>{{ $request->b_name }} {{ $request->b_surname ?? '' }}</b><br /> @endif
                @if($request->b_phone) We can call you at <b>{{ $request->b_phone ?? '' }}</b> @endif
            </td>
        </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0">
        @if( count($request->b_products) == 1 )
            <tr>
                <td>
                    You're interested in next experience: <b><a href="{{ route('product', ['id'=>\App\Models\Product::find($request->b_products[0])->slug]) ?? '' }}">{{ \App\Models\Product::find($request->b_products[0])->name ?? '' }}</a></b></td>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <img src="{{ asset(cropImage(\App\Models\Product::find($request->b_products[0])->image, 550, 353)) }}" alt="">
                </td>
            </tr>
        @else
            <tr>
                <td colspan="2">
                    You're interested by few experiences:
                    <hr />
                </td>

            </tr>
            @foreach($request->b_products as $key => $productId)
                @php($product = \App\Models\Product::find($productId))
                <tr>
                    <td>
                        <b><a href="{{ route('product', ['id'=>$product->slug])  ?? ''}}">{{ $product->name  ?? ''}}</a></b></td>
                    <td>
                        <img style="width: 100%" src="{{ asset(cropImage($product->image, 370, 250)) }}" alt="">
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                @if($request->b_field_dates == 'no')
                    You are not sure about trip dates
                @else
                    Your trip dates are: <b>{{ $request->b_field_dates_from  ?? ''}} - {{ $request->b_field_dates_to  ?? ''}}</b>
                @endif

            </td>
        </tr>
        <tr>
            <td>
                Adults: <b>{{ $request->b_how_many_adults  ?? ''}}, Children: {{ $request->b_how_many_child  ?? ''}}</b>
            </td>
        </tr>
        @if(isset($request->b_how_can_help) && ($request->b_how_can_help > 0) )
            <tr>
                <td>
                    You also want next services: <b>
                    @foreach($request->b_how_can_help as $key => $value)
                        {{ config('questions.b_how_can_help')[$key]  ?? ''}}
                    @endforeach
                    </b>
                </td>
            </tr>
        @endif
        @if($request->b_comment)
            <tr>
                <td>
                    Trip notes/ requests: <b>{{ $request->b_comment  ?? ''}}</b>
                </td>
            </tr>
        @endif
        <tr>
            <td style="text-align: center">
                <br/>
                <hr>
                <a href="{{ route('index') }}">Welcome back</a>
            </td>
        </tr>
    </table>
@endsection
