<form class="" id="filter-form" method="get" action="{{ route('search') }}">
    <div class="container form-with-labels">
    @auth
        @if(\Illuminate\Support\Facades\Auth::user()->scores())
        <div class="col-xs-12 grey-bottom-line">
            <div class="text-left font-light filter-checkbox">

                <label for="applyScores">
                    <input type="checkbox" name="applyScores" id="applyScores" class="styled" {{ (isset($filter['applyScores']) && $filter['applyScores']=='yes') ? 'checked' : ''}}>
                    <span>Apply personal recommendations</span>
                </label>
            </div>
        </div>
            @else
                <div class="col-sm-12">
                    <div class="col-sm-12 margin20">
                        <p>Get personalised travel inspiration here - <a class="link-large" href="{{ route('quiz-step1') }}">Get Started</a></p>
                    </div>
                </div>
            @endif
    @endauth
    @guest
            <div class="col-sm-12">
                <div class="col-sm-12 margin20">
                    <p>Get personalised travel inspiration here - <a class="link-large" href="{{ route('quiz-step1') }}">Get Started</a></p>
                </div>
            </div>
    @endguest

        <div class="col-sm-12">
            <div class="col-sm-6 col-md-3">
                <label for="filter-countries">Select country</label>
                <select id="filter-countries" multiple name="country[]">
    {{--                <option value="all" {{ isset($filter['country']) && in_array('all', $filter['country']) ? 'selected' : '' }}>Any</option>--}}
                    @foreach(\App\Models\Country::all() as $country)
                        <option value="{{$country->id}}" {{ isset($filter['country']) && !in_array('all', $filter['country']) && in_array($country->id, $filter['country']) ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <label for="filter-month">Select month</label>
                <select id="filter-month" multiple name="month[]">
    {{--                <option value="all" {{ isset($filter['month']) && in_array('all', $filter['month']) ? 'selected' : '' }}>Any</option>--}}
                    @foreach(monthsList() as $key => $month)
                        <option value="{{ $key }}" {{ isset($filter['month']) && !in_array('all', $filter['month']) && in_array($key, $filter['month']) ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-12 col-md-6 filter-duration">
                <label for="" class="block">Select duration (days)</label>
                <span>From:</span>
                <div class="filter-duration-field">
                    <select id="filter-duration-from" name="filter_duration_from" class="">
                        @php
                            $duration_from = $filter['q_how_long_from'] ?? 1;
                            $duration_to = $filter['q_how_long_to'] ?? 29;
                        @endphp
                        @for($i=1; $i<=29;$i++)
                            <option value="{{$i}}" {{ $i == $duration_from ? 'selected' : '' }}>{{$i==29 ? '28+' : $i}}</option>
                        @endfor
                    </select>
                </div>
                <span>To:</span>
                <div class="filter-duration-field">
                    <select id="filter-duration-to" name="filter_duration_to" class="">
                        @for($i=1; $i<=29;$i++)
                            <option value="{{$i}}" {{ $i == $duration_to ? 'selected' : '' }}>{{$i==29 ? '28+' : $i}}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="filter-travel-styles">Travel style &nbsp;<span><small><i class="brown-text">(Just Itineraries)</i></small></span></label>
                <select id="filter-travel-styles" multiple name="travel_styles[]">
                    {{--                    <option value="all" {{ isset($filter['country']) && in_array('all', $filter['country']) ? 'selected' : '' }} selected>Travel style</option>--}}
                    @foreach(config('questions.q_travel_style') as $alias => $name)
                        <option value="{{$alias}}" {{ (isset($filter['travel_styles']) && $filter['travel_styles'] == $alias) ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="filter-sights">Preferred Sights</label>
                <select id="filter-sights" multiple name="sights[]">
                    {{--                <option value="all" {{ isset($filter['month']) && in_array('all', $filter['month']) ? 'selected' : '' }}>Any</option>--}}
                    @foreach(config('questions.q_preferred_sight') as $alias => $name)
                        <option value="{{ $alias }}" {{ (isset($filter['sights']) && $filter['sights'] == $alias) ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>
</form>

@push('after_scripts')
    <script>
      $(document).ready(function() {
        if(isExperienceTab()) {
            $('.nav-tabs [href="#experiences-list-container"]').trigger('click');
        }
      });

      $('.nav-tabs [href="#experiences-list-container"]').click(function(){
        //todo change query for t=2
      });

      function isExperienceTab(){
        // return window.location.href.search("[?&]t=2") != -1;
        return window.location.href.search("experiences") != -1;
      }
    </script>
    <script>
        for (var inputId of ['applyScores', 'filter-countries', 'filter-month', 'filter-duration-from', 'filter-duration-to', 'filter-travel-styles', 'filter-sights']) {
          if (document.getElementById(inputId) == null) { continue; } //applyScores can be absent
          document.getElementById(inputId).onchange = function() {
           if((this.getAttribute('id') == 'filter-duration-from' || this.getAttribute('id') == 'filter-duration-to') && parseInt(document.getElementById('filter-duration-from').value) > parseInt(document.getElementById('filter-duration-to').value)) {
              document.getElementsByClassName('filter-duration')[0].classList.add('invalid');
              return
            }
            document.getElementsByClassName('filter-duration')[0].classList.remove('invalid');
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

              $('#itineraries-list').height($('#itineraries-list-list').height());
              $('#itineraries-list').html('');
            },

            success: function(data) {
              $('#product-list').replaceWith(data.products);
              $('#itineraries-list').replaceWith(data.itineraries);
            },
            error: function() {
              $('#product-list').html('Something wrong... Please update page');
              $('#itineraries-list').html('Something wrong... Please update page');
            }
          })
        }
    </script>
@endpush
