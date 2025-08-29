@php
    $bool_img = empty($imgFile) || $imgFile==="";
    if (null !== $attrs) {
        $attrs = 'class="' . $attrs . '"';
    }
@endphp
@if ($bool_img)
    <img src="{{ asset('images/placeholder.jpg') }}" {!! $attrs !!}>
@else
    <img src="{{ asset('storage/images/products/'.$imgFile) }}" {!! $attrs !!}>
@endif