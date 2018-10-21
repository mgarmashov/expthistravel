@php
    $categoriesList = \App\Models\Category::all();
    $count = count($categoriesList);
    $i = 1;
@endphp

<!-- field_type_name -->
<div @include('crud::inc.field_wrapper_attributes')>
    <div class="">
        <row>
            <div class="col-sm-6">
                <table class="table table-condensed">
                    <tbody>
                    @foreach( $categoriesList as $category)
                        @php $fieldName = 'category-'.$category->id;  @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <input
                                        type="number"
                                        name="{{ $fieldName }}"
                                        min=0
                                        max=10
                                        value="{{ old($fieldName) ?? $field['value'][$category->id] ?? '0' }}"
                                        @include('crud::inc.field_attributes')
                                >
                            </td>
                        </tr>
                        {{--new column of table--}}
                        @if($i % (($count+1) / 2) == 0)
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
                <table class="table table-condensed">
                    <tbody>

                    @endif

                    @php $i++; @endphp
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