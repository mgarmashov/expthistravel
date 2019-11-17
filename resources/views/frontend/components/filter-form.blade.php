<form class="" id="filter-form" method="get" action="{{ route('search') }}">
    <div class="container form-with-labels">
    @auth
        @if(\Illuminate\Support\Facades\Auth::user()->scores())
        <div class="col-xs-12">
            <div class="text-left font-light filter-checkbox">

                <label for="applyScores">
                    <input type="checkbox" name="applyScores" id="applyScores" class="styled" {{ (isset($filter['applyScores']) && $filter['applyScores']=='yes') ? 'checked' : ''}}>
                    <span>Apply personal recommendations</span>
                </label>
            </div>
        </div>
            @else
            <p>Get personalised travel inspiration here - <a class="link-large" href="{{ route('quiz-step0') }}">Get Started</a></p>
            @endif
    @endauth

        <div class="col-sm-4">
            <label for="filter-countries">Select country</label>
            <select id="filter-countries" multiple name="country[]">
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
        <div class="col-sm-4">
            <label for="filter-month">Select month</label>
            <select id="filter-month" multiple name="month[]">
                <option value="all" {{ isset($filter['month']) && in_array('all', $filter['month']) ? 'selected' : '' }}>Any</option>
                @foreach($months as $key => $month)
                    <option value="{{ $key }}" {{ isset($filter['month']) && !in_array('all', $filter['month']) && in_array($key, $filter['month']) ? 'selected' : '' }}>{{ $month }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-4">
            <label for="filter-duration">Select duration</label>
            <select id="filter-duration" multiple name="duration[]">
                <option value="all" {{ isset($filter['duration']) && !in_array('all', $filter['duration']) && in_array('all', $filter['duration']) ? 'selected' : '' }}>Any</option>
                <option value="up7" {{ isset($filter['duration']) && !in_array('all', $filter['duration']) && in_array('up7', $filter['duration']) ? 'selected' : '' }}>7 nights or less</option>
                <option value="8-13" {{ isset($filter['duration']) && !in_array('all', $filter['duration']) && in_array('8-13', $filter['duration']) ? 'selected' : '' }}>8 to 13 nights</option>
                <option value="14more" {{ isset($filter['duration']) && !in_array('all', $filter['duration']) && in_array('14more', $filter['duration']) ? 'selected' : '' }}>14 nights or more</option>
            </select>
        </div>
    </div>
</form>

@push('after_scripts')

    <script>
        for (let inputId of ['applyScores', 'filter-countries', 'filter-month', 'filter-duration']) {
          if (document.getElementById(inputId) == null) { continue; } //applyScores can be absent
          document.getElementById(inputId).onchange = function() {
            changeUrl(this);
            updateResults($('#filter-form').serializeArray());
          }
        }

        function changeUrl(field)
        {
        }

        function updateResults(data) {
          $.ajax({
            type: "get",
            url: '{{ route('updateResults') }}',
            data: data,

            beforeSend: function(){
              $('#product-list').height($('#product-list').height());
              $('#product-list').html('');
            },

            success: function(data) {
              $('#product-list').replaceWith(data);
            },
            error: function() {
              $('#product-list').html('Something wrong... Please update page');
            }
          })
        }
    </script>
@endpush