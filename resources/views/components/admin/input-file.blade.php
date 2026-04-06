@error($attributes->get('name'))

<div class='file-input input-error'>
    <input {{$attributes->class([

    'input-file',

    ])->merge([

    'type' => 'file',

    ]) }}>

    <span class='file-input__btn'>{{ __('admin.button.select') }}</span>
    <span class='file-input__label' data-js-label>{{ __('admin.label.file-not-select') }}</span>

</div>

@else

<div class='file-input'>
    <input {{$attributes->class([

    'input-file',

    ])->merge([

    'type' => 'file',

    ]) }}>

    <span class='file-input__btn'>{{ __('admin.button.select') }}</span>
    <span class='file-input__label' data-js-label>{{ __('admin.label.file-not-select') }}</span>

</div>

@enderror