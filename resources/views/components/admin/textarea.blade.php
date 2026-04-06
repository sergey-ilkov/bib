@error($attributes->get('name'))
<textarea {{$attributes}} class="form-texterea textarea-error" rows="5">{{ old($attributes->get('name')) }}</textarea>
@else
<textarea {{$attributes}} class="form-texterea" rows="5">

    @if (old($attributes->get('name')))

    {{ old($attributes->get('name')) }}

    @else
    
    {{ $slot }}
        
    @endif
</textarea>
@enderror