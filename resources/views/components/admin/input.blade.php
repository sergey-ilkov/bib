@props(['value' => ''])





@error($attributes->get('name'))

<input {{$attributes->class([

'form-input', 'input-error' ,

])->merge([

'type' => 'text',
'value' => (old($attributes->get('name')) ? : $value),
'autocomplete'=>"off",

]) }}>


@else

<input {{$attributes->class([

'form-input',

])->merge([

'type' => 'text',
'value' => (old($attributes->get('name')) ? : $value),
'autocomplete'=>"off",

]) }}>

@enderror