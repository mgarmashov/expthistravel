
    <div class="db-2-com db-2-main">
        <h4>Your trip</h4>
        <div class="db-2-main-com db-2-main-com-table">
            @if(count($products))
                <table class="responsive-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Experience</th>
                        <th>Duration</th>
                        <th>Place</th>
                        <th>More</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1 @endphp
                    @foreach($products as $product)
                        <tr data-product="{{ $product->id }}">
                            <td>{{ $i }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->duration() }}</td>
                            <td>{{ $product->place() }}</td>
                            <td><a href="{{ route('product', ['id' => $product->slug]) }}" class="db-done text-nowrap">view more</a>
                            </td>
                            <td><a href="#" class="db-done btn-delete-product">Delete</a>
                            </td>
                        </tr>
                        @php $i++ @endphp
                    @endforeach
                    </tbody>
                </table>
                <div class="right-align margin20">
                    <a href="{{ route('bookingPage') }}" class="link-btn">Book Now</a>
                </div>
            @else
                You haven't added experiences to your cart. <a href="{{ route('experiences') }}">Explore new tours</a>
            @endif
        </div>
    </div>

    @push('after_scripts')
        <script>
            var deleteButtons = document.getElementsByClassName(' btn-delete-product');
            for ( var button of deleteButtons ) {
                button.onclick = function() {
                    event.preventDefault();
                    var row = this.closest('tr');
                    $.ajax({
                        type: "get",
                        url: '{{ route('productDeleteFromOrder') }}/'+row.dataset.product,

                        success: function () {
                        },
                    });

                    row.remove();
                }
            }
        </script>
    @endpush