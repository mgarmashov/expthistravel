@php
    $activities = \App\Models\Activity::all();
    $likes = \App\Models\QuizHistory::where('user', $id)->where('answer', 'like')->select('activity')->get();
    $dislikes = \App\Models\QuizHistory::where('user', $id)->where('answer', 'dislike')->select('activity')->get();
    $missed = \App\Models\QuizHistory::where('user', $id)->where('answer', 'missed')->select('activity')->get();

    $kinds = [
        'likes' => 'Likes',
        'dislikes' => 'Dislikes',
        'missed' => 'Missed',
    ];
@endphp

<!-- field_type_name -->
<div @include('crud::inc.field_wrapper_attributes')>
    <div class="">
        <row>
            <div class="col-sm-6">
                <table class="table table-condensed table-bordered">
                    <tbody>

                    @foreach ($kinds as $key => $label)
                        <tr>
                            <td>{{ $label }}</td>
                            <td>
                                @foreach(${$key} as $item)
                                    @php
                                        $activity = $activities->firstWhere('id', $item->activity);
                                    @endphp
                                    <img src="{{ asset(cropImage($activity->image, 50, 50)) }}" alt="{{ $activity->name }}" title="{{ $activity->name }}">
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    {{--@foreach( $categoriesList as $category)--}}
                        {{--@php $fieldName = 'category-'.$category->id;  @endphp--}}
                        {{--<tr>--}}
                            {{--<td>{{ $i }}</td>--}}
                            {{--<td>{{ $category->name }}</td>--}}
                            {{--<td>--}}
                                {{--<input--}}
                                        {{--type="number"--}}
                                        {{--name="{{ $fieldName }}"--}}
                                        {{--min=0--}}
                                        {{--max=10--}}
                                        {{--value="{{ old($fieldName) ?? $field['value'][$category->id] ?? '0' }}"--}}
                                        {{--@include('crud::inc.field_attributes')--}}
                                {{-->--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--new column of table--}}
                        {{--@if($i % (($count+1) / 2) == 0)--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
            {{--<div class="col-sm-6">--}}
                {{--<table class="table table-condensed">--}}
                    {{--<tbody>--}}

                    {{--@endif--}}

                    {{--@php $i++; @endphp--}}
                    {{--@endforeach--}}
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