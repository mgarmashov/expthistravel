<form class="" id="filter-form" method="get" action="{{ route('search') }}">

    @auth
        @if(\Illuminate\Support\Facades\Auth::user()->scores())
        <row>
            <div class="text-left font-light filter-checkbox">
                <input type="checkbox" name="applyScores" id="applyScores" class="styled" {{ isset($filter['applyScores']) ? 'checked' : ''}}>
                <label for="applyScores">Apply personal recommendations</label>
            </div>
        </row>
            @else
                <p>We can help you to choose tour. Just answer some questions in <a href="{{ route('quiz-part1') }}">our Quiz</a></p>
            @endif
    @endauth
    <div class="row form-with-labels">
        <div class="col l4 m12 s12">
            <label for="filter-country">Select country</label>
            <select id="filter-country" multiple name="country[]">
                <option value="all" {{ isset($filter['country']) && in_array('all', $filter['country']) ? 'selected' : '' }}>Any</option>
                @foreach(\App\Models\Country::all() as $country)
                    <option value="{{$country->id}}" {{ isset($filter['country']) && !in_array('all', $filter['country']) && in_array($country->id, $filter['country']) ? 'selected' : '' }}>{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
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
            ];
        @endphp
        <div class="col l4 m12 s12">
            <label for="filter-month">Select month</label>
            <select id="filter-month" multiple name="month[]">
                <option value="all" {{ isset($filter['month']) && in_array('all', $filter['month']) ? 'selected' : '' }}>Any</option>
                @foreach($months as $key => $month)
                    <option value="{{ $key }}" {{ isset($filter['month']) && !in_array('all', $filter['month']) && in_array($key, $filter['month']) ? 'selected' : '' }}>{{ $month }}</option>
                @endforeach
            </select>
        </div>

        <div class="col l4 m12 s12">
            <label for="filter-duration">Select duration</label>
            <select id="filter-duration" multiple name="duration[]">
                <option value="all" {{ isset($filter['duration']) && !in_array('all', $filter['duration']) && in_array('all', $filter['duration']) ? 'selected' : '' }}>Any</option>
                <option value="up7" {{ isset($filter['duration']) && !in_array('all', $filter['duration']) && in_array('up7', $filter['duration']) ? 'selected' : '' }}>7 nights or less</option>
                <option value="8-13" {{ isset($filter['duration']) && !in_array('all', $filter['duration']) && in_array('8-13', $filter['duration']) ? 'selected' : '' }}>8 to 13 nights</option>
                <option value="14more" {{ isset($filter['duration']) && !in_array('all', $filter['duration']) && in_array('14more', $filter['duration']) ? 'selected' : '' }}>14 nights or more</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="input-field col s12" id="filter-submit-btn">
            <input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn v2-ser-btn">
        </div>
    </div>
</form>

@push('after_scripts')

    <script>
        document.getElementById('filter-submit-btn').onclick = function() {
            let form = document.getElementById('filter-form');
            form.submit();
        }
    </script>
@endpush