@props( ['required' => false] )

<label {{$attributes->class([

    'form-label', ($required ? 'required' : ''),

    ])}}>

    {{$slot}}

</label>