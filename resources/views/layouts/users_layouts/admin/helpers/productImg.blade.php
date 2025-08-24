@php
        if (empty($imgFile)) {
            $imgFile = 'images/placeholder.jpg';
        }
        if (null !== $attrs) {
            $attrs = 'class="' . $attrs . '"';
        }

@endphp
<img src="{{ asset('storage/images/products/'.$imgFile) }}" {!! $attrs !!}>