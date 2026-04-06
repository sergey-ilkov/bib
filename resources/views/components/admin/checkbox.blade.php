@if ($attributes->get('checked') )

<input {{$attributes->class([

'input-form',

])->merge([
'type' => 'checkbox',
'checked' => true,
]) }}>
@else
<input {{$attributes->class([

'input-form',

])->merge([
'type' => 'checkbox',

]) }}>

@endif