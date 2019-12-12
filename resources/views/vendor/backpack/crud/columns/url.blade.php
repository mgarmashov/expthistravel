{{-- regular object attribute --}}
@php
	$value = data_get($entry, $column['name']);

	if (is_array($value)) {
		$value = json_encode($value);
	}

    $url = config('app.url').'/'.(isset($column['options']['slug_path']) ? ($column['options']['slug_path'].'/'.$value) : $value);
@endphp

<a href="{{ $url }}" target="_blank">{{ $value }}</a>
