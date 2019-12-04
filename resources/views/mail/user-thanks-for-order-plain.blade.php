Hi {{ $request->b_name ?? '' }},
Thanks for your booking enquiry.

One of our destination experts will be in touch within 2 working days. Please check your spam folder if you haven’t heard from us by then.
Here’s a copy of your enquiry. If any details are incorrect, missing or if you have any further requests, just let us know
info@experiencethistravel.com

@if( count($request->b_products) == 1 )
Your experience: {{ \App\Models\Product::find($request->b_products[0])->name ?? '' }}
@else
    @foreach($request->b_products as $key => $productId)
    - {{\App\Models\Product::find($productId)->name ?? ''}}
    @endforeach
@endif

@if($request->b_field_dates == 'no')
You are not sure about travel dates
@else
Your travel dates: {{ $request->b_field_dates_from  ?? ''}} - {{ $request->b_field_dates_to  ?? ''}}
@endif
Number of travellers:  Adults: {{ $request->b_how_many_adults  ?? '0'}} @if($request->b_how_many_child > 0), Children: {{ $request->b_how_many_child  ?? '0'}}@endif

@if(isset($request->b_how_can_help) && ($request->b_how_can_help > 0) )
You want help with: @foreach($request->b_how_can_help as $key => $value){{ config('questions.b_how_can_help')[$key]  ?? ''}} @endforeach
@endif

@if($request->b_comment)
Trip notes: {{ $request->b_comment  ?? ''}}
@endif

