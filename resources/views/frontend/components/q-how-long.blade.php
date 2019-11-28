<h4>How long do you want to go for?</h4>
<div class="col-xs-12">
    <div class="checkbox checkbox-info checkbox-circle">
        <input name="q_how_long_from" id="q-how-long-from" class="styled hidden" type="number" value="7">
        <input name="q_how_long_to" id="q-how-long-to" class="styled hidden" type="number" value="14">
        <span>Days:</span>
        <div id="q-how-long-visible-slider" class="q-how-long-visible-slider"></div>
    </div>
    <div class="clearfix"></div>
</div>

@push('after_scripts')
    <script src="{{asset('vendor/noUiSlider/nouislider.min.js')}}?v={{ filemtime(public_path('vendor/noUiSlider/nouislider.min.js')) }}"></script>
    <script src="{{asset('vendor/wnumb/wNumb.min.js')}}?v={{ filemtime(public_path('vendor/wnumb/wNumb.min.js')) }}"></script>
    <script>
      var slider = document.getElementById('q-how-long-visible-slider');
      noUiSlider.create(slider, {
        start: [7, 14],
        step: 1,
        margin: 1,
        tooltips: [wNumb({decimals: 0}), wNumb({decimals: 0})],
        format: {
          to: function (value) {
            return parseInt(value);
          },
          from: function (value) {
            return parseInt(value);
          }
        },
        connect: true,
        range: {
          'min': 0,
          'max': 29
        },
        pips: {
          mode: 'values',
          values: [7, 14, 21, 28],
          density: 7
        }
      });

      //get values
      slider.noUiSlider.on('change', function () {
        console.log(slider.noUiSlider.get());
        document.getElementById('q-how-long-from').value = slider.noUiSlider.get()[0];
        document.getElementById('q-how-long-to').value = slider.noUiSlider.get()[1];
      });

      //change text of tooltip on last step
      slider.noUiSlider.on('update.one', function () {
        if (document.getElementsByClassName('noUi-tooltip')[1].innerHTML == '29') {
          document.getElementsByClassName('noUi-tooltip')[1].innerHTML = '28+'
        }
      });


    </script>
@endpush