<form class="" id="filter-form" method="get" action="{{ route('search') }}">
    @auth
        <row>
            <div class="text-left font-light filter-checkbox">
                <input type="checkbox" name="applyScores" id="applyScores" class="styled" {{ isset($filter['applyScores']) ? 'checked' : ''}}>
                <label for="applyScores">Apply personal recommendations</label>
            </div>
        </row>
    @endauth
    <div class="row">
        <div class="input-field col s4">
            <select id="filter-country" multiple name="country[]">
                <option value="0" disabled selected>Select country</option>
                <option value="0">Any</option>
                @foreach(\App\Models\Country::all() as $country)
                    <option value="{{$country->id}}">{{ $country->name }}</option>
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
        <div class="input-field col s4">
            <select id="filter-month" multiple name="month[]">
                <option value="" disabled selected>Select month</option>
                <option value="0">Any</option>
                @foreach($months as $key => $month)
                    <option value="{{ $key }}">{{ $month }}</option>
                @endforeach
            </select>
        </div>

        <div class="input-field col s4">
            <select id="filter-duration" multiple name="duration[]">
                <option value="0" disabled selected>Select duration</option>
                <option value="0" {{ $filter['duration'] && in_array('all', $filter['duration']) ? 'selected' : '' }}>Any</option>
                <option value="up7" {{ $filter['duration'] && in_array('up7', $filter['duration']) ? 'selected' : '' }}>7 nights or less</option>
                <option value="8-13" {{ $filter['duration'] && in_array('8-13', $filter['duration']) ? 'selected' : '' }}>8 to 13 nights</option>
                <option value="14more" {{ $filter['duration'] && in_array('14more', $filter['duration']) ? 'selected' : '' }}>14 nights or more</option>
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