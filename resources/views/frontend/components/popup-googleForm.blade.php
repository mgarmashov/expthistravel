@push('after_styles')
    <link rel="stylesheet" href="{{asset('vendor/magnific-popup/magnific-popup.css')}}?v={{ filemtime(public_path('vendor/magnific-popup/magnific-popup.css')) }}">
@endpush

<div id="popup-review" class="mfp-hide popup popup-review">
    <h3>Please help us improve our services</h3>
    <h4>Share your feedback for a chance to win a £50 Amazon voucher!</h4>
    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfsMhGpCGJicwtNrAanj6lH5QJkE2XXWVo_0vCWGeh_4fjwzw/viewform?embedded=true" width="100%" height="750" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
    <p><a class="popup-modal-dismiss" href="#">Dismiss</a></p>
</div>

@push('popup-btn')
    <p>
        <a class="popup-btn-footer" href="#popap-review">Help us to improve services</a>
    </p>
@endpush

@push('after_scripts')
    <script src="{{asset('vendor/magnific-popup/jquery.magnific-popup.min.js')}}?v={{ filemtime(public_path('vendor/magnific-popup/jquery.magnific-popup.min.js')) }}"></script>
    <script>
      $(document).ready(function() {
        setTimeout(function(){
          popup();
        }, 30000);
      });

      $('.popup-btn-footer').click(function(){
        event.preventDefault();
        popup();
      });

      function popup() {
        $(function () {
          $.magnificPopup.open({
            items: {
              src: '#popup-review'
            },
            type: 'inline',
            preloader: false,
            modal: false,
            closeOnBgClick: true,
            closeBtnInside: true,
            showCloseBtn: true,
            enableEscapeKey: true,
            overflowY: true
          });
          $(document).on('click', '.popup-modal-dismiss', function (e) {
            e.preventDefault();
            $.magnificPopup.close();
          });
        })
      }
    </script>
@endpush