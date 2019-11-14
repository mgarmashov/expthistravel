<h4>Who is travelling?</h4>
<div class="col-xs-12" id="q-who-travels">
    <div class="checkbox checkbox-info checkbox-circle">
        <label for="q-who-travels-solo">
            <input name="q_who_travels" id="q-who-travels-solo" class="with-gap" type="radio" value="solo">
            <span>I’m going solo</span>
        </label>
    </div>
    <div class="checkbox checkbox-info checkbox-circle">
        <label for="q-who-travels-couple">
            <input name="q_who_travels" id="q-who-travels-couple" class="with-gap" type="radio" value="couple">
            <span>Couple</span>
        </label>
    </div>
    <div class="checkbox checkbox-info checkbox-circle">
        <label for="q-who-travels-group">
            <input name="q_who_travels" id="q-who-travels-group" class="with-gap" type="radio" value="group">
            <span>Group – friends/ family</span>
        </label>
    </div>
    <hr>
    <div class="checkbox checkbox-info checkbox-circle">
        <label for="q-who-travels-all">
            <input name="q_who_travels" id="q-who-travels-all" class="with-gap" type="radio" checked value="all">
            <span>Not sure</span>
        </label>
    </div>
</div>
<div id="q-how-many" class="hidden">
    <h4>How many people in total?</h4>
    <div class="col-xs-12">
        <div class="checkbox checkbox-info checkbox-circle">
            <label for="q-how-many-adults" class="col-xs-4">
                <input name="q_how_many_adults" id="q-how-many-adults" class="styled" type="number" min="0" max="10">
                <span>Adults</span>
            </label>
            <label for="q-how-many-child" class="col-xs-4">
                <input name="q_how_many_child" id="q-how-many-child" class="styled" type="number" min="0" max="10">
                <span>Children</span> (Aged 0-16)
            </label>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="margin10"></div>



@push('after_scripts')
    <script>
      document.getElementById('q-who-travels').onclick = function () {
        if (document.getElementById('q-who-travels-group').checked == true) {
          document.getElementById('q-how-many').classList.remove('hidden');
        } else {
          document.getElementById('q-how-many').classList.add('hidden');
        }
      }
    </script>
@endpush