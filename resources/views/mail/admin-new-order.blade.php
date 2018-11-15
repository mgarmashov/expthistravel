@extends('mail.template')

@section('preheader')
    You've got new order
@endsection


@section('content')
    <h1>You've got new order</h1>
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                @if($order->user_id && $order->user_id != 0)
                    User: {!! $order->user()->name ?? '' !!} {!! $order->user()->surname ?? '' !!} {!! $order->user()->email ?? '' !!}
                @else
                    User: Anonymous
                @endif


            </td>
        </tr>
        <tr>
            <td>{!! $order->comment !!}</td>
        </tr>
        <tr>
            <td>
                <a href="{{ route('crud.orders.show', ['order' => $order->id]) }}">Watch at the system</a>
            </td>
        </tr>
    </table>
@endsection