@php

    $user = \App\Models\User::find($id);
    $userProducts = $user->products()->get()->sortByDesc('created_at');

@endphp

<!-- field_type_name -->
<div @include('crud::inc.field_wrapper_attributes')>
    <div class="">
        <row>
            <div>
                <table class="table table-condensed table-bordered">

                    <thead>
                        <th>Experience</th>
                        <th>Date of adding</th>
                    </thead>
                    <tbody>
                        @foreach($userProducts as $product)
                            <tr>
                                <td>
                                    <a href="{{ route('product', ['id' => $product->id]) }}" target="_blank">{{ $product->name }}</a>
                                </td>
                                <td>
                                    {{ $product->pivot->created_at }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </row>
    </div>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}

    @push('crud_fields_styles')
        <!-- no styles -->
    @endpush

    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}

    @push('crud_fields_scripts')
        <!-- no scripts -->
    @endpush
@endif