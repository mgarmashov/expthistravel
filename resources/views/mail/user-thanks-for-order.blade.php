@extends('mail.template')

@section('title')
    Thanks for your booking enquiry
@endsection

@section('preheader')
    Thanks for your booking enquiry
@endsection


@section('content')
    <table class="welcome-part" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <a href="#">
                    <img src="{{ asset('images/logos/ExperienceThisTravel-Logo-Grey.png') }}" alt="Experience This Travel">
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <hr>
            </td>
        </tr>
        <tr>
            <td class="align-left">
                <p>
                    Hi {{ $request->b_name ?? '' }},
                </p>
                <p>
                    Thanks for your booking enquiry.
                </p>
                <p>
                    One of our destination experts will be in touch within 2 working days. Please check your spam folder if you haven’t heard from us by then.
                </p>
                <p>
                    Here’s a copy of your enquiry. If any details are incorrect, missing or if you have any further requests, just let us know
                    <a href="mailto: info@experiencethistravel.com">info@experiencethistravel.com</a>.
                </p>
            </td>
        </tr>
    </table>
    @if( count($request->b_products) == 1 )
        <table>
            <tr><td>
                    Your experience: <b><a href="{{ route('product', ['id'=>\App\Models\Product::find($request->b_products[0])->slug]) ?? '' }}">{{ \App\Models\Product::find($request->b_products[0])->name ?? '' }}</a></b>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <img src="{{ asset(cropImage(\App\Models\Product::find($request->b_products[0])->image, 550, 353)) }}" alt="">
                </td>
            </tr>
        </table>
    @else
        <table>
            <tr><td colspan="2">Your experience:<hr/></td></tr>
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
        </table>
    @endif

    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <hr>
                <p>
                    @if($request->b_field_dates == 'no')
                        You are not sure about travel dates
                    @else
                        Your travel dates: <b>{{ $request->b_field_dates_from  ?? ''}} - {{ $request->b_field_dates_to  ?? ''}}</b>
                    @endif
                </p>
                <p>
                    Number of travellers:  Adults: <b>{{ $request->b_how_many_adults  ?? '0'}}</b> @if($request->b_how_many_child > 0), Children: <b>{{ $request->b_how_many_child  ?? '0'}}</b>@endif
                </p>
                @if(isset($request->b_how_can_help) && ($request->b_how_can_help > 0) )
                <p>
                    You want help with: <b>
                        @foreach($request->b_how_can_help as $key => $value)
                            {{ config('questions.b_how_can_help')[$key]  ?? ''}}
                        @endforeach</b>
                </p>
                @endif

                @if($request->b_comment)
                <p>
                    Trip notes: <b>{{ $request->b_comment  ?? ''}}</b>
                </p>
                @endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center">
                <p>We look forward to helping you put together your perfect trip</p>
            </td>
        </tr>
    </table>
@endsection
