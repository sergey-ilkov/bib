@props(['value' => ''])





@error($attributes->get('name'))

<select {{$attributes->class([

    'input-form', 'input-error' ,

    ])->merge([


    ]) }}>



    {{$slot}}


</select>

@else

<select {{$attributes->class([

    'input-form',

    ])->merge([


    ]) }}>

    {{$slot}}

</select>


@enderror