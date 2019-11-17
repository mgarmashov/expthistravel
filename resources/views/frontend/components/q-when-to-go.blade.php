<h4>When do you want to go?</h4>
@php
    $months = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    ]
@endphp
<div id="q3">
    <div class="col-sm-6">
        @foreach($months as $val => $month)

            <div class="checkbox checkbox-info checkbox-circle">
                <label for="q3-{{$val}}">
                    <input name="q3[{{$val}}]" id="q3-{{$val}}" class="styled" type="checkbox">
                    <span>{{ $month }}</span>
                </label>
            </div>
            @if($val == 6)
    </div>
    <div class="col-sm-6">
        @endif

        @endforeach
    </div>
    <div class="clearfix"></div>
    <hr class="margin10">
    <div class="col-xs-12">
        <div class="checkbox checkbox-info checkbox-circle">
            <label for="q3-all">
                <input name="q3[0]" id="q3-all" class="styled" type="checkbox">
                <span>I don’t mind</span>
            </label>
        </div>
    </div>

</div>