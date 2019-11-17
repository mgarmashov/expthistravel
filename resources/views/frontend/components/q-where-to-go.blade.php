<h4>Where do you want to go?</h4>
<div class="col-xs-12"  id="q-countries">
    @foreach(\App\Models\Country::all() as $country)
        <div class="checkbox checkbox-info checkbox-circle">
            <label for="q-countries-{{$country->id}}">
                <input name="q_countries[{{$country->id}}]" id="q-countries-{{$country->id}}" class="styled" type="checkbox">
                <span>{{$country->name}}</span>
            </label>
        </div>
    @endforeach
    <hr>
    <div class="checkbox checkbox-info checkbox-circle">
        <label for="q-countries-all">
            <input name="q_countries[all]" id="q-countries-all" class="styled" type="checkbox">
            <span>I don’t know yet - inspire me!</span>
        </label>
    </div>
</div>