
    <div class="db-2-com db-2-main">
        <div class="db-2-main-com db-2-main-com-table">
            @if(count($itineraries))
                <h4>Itineraries</h4>
                <table class="">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Itinerary</th>
                        <th>Duration</th>
                        <th>Place</th>
                        <th>More</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1 @endphp
                    @foreach($itineraries as $itinerary)
                        <tr data-itinerary="{{ $itinerary->id }}">
                            <td>{{ $i }}</td>
                            <td>{{ $itinerary->name }}</td>
                            <td>{{ $itinerary->duration() }}</td>
                            <td>{{ $itinerary->place() }}</td>
                            <td><a href="{{ route('itinerary', ['id' => $itinerary->slug]) }}" class="db-done text-nowrap">view more</a>
                            </td>
                            <td><a href="#" class="db-done btn-delete-product">Delete</a>
                            </td>
                        </tr>
                        @php $i++ @endphp
                    @endforeach
                    </tbody>
                </table>
            @endif

                <div class="margin50"></div>

            <h4>Experiences</h4>
            @if(count($products))
                <table class="">
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
            @endif


            @if(count($products) || count($itineraries))
                <div class="right-align margin20">
                    <a href="{{ route('bookingPage') }}" class="link-btn">Book Now</a>
                </div>
            @else
                You haven't added itineraries or experiences to your cart. <a href="{{ route('itineraries') }}">Explore new tours</a>
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
                    var url;
                    if(row.dataset.product) {
                      url = '{{ route('productDeleteFromOrder') }}/'+row.dataset.product;
                    } else {
                      url = '{{ route('itineraryDeleteFromOrder') }}/'+row.dataset.itinerary;
                    }
                    $.ajax({
                        type: "get",
                        url: url,

                        success: function () {
                        },
                    });

                    row.remove();
                }
            }
        </script>
    @endpush
