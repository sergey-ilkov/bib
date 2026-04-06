<input id="{{$name}}" type="hidden" {{ $attributes }} value="{{ old($attributes->get('name')) }}">

@error($attributes->get('name'))

<trix-editor input="{{$name}}" class="textarea-error"></trix-editor>

@else

<trix-editor input="{{$name}}"></trix-editor>

@enderror




@once

@push('css')

<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

@endpush

@push('js')

<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

{{-- <script>
    // Trix.config.blockAttributes.default.tagName = 'p';
    Trix.config.blockAttributes.heading2 = {
        tagName: 'h2',
        terminal: true,
        breakOnReturn: true,
        group: false
    }

    addEventListener("trix-initialize", event => {
        const { toolbarElement } = event.target
        const h1Button = toolbarElement.querySelector("[data-trix-attribute=heading1]")
        h1Button.insertAdjacentHTML("afterend", `
            <button type="button" class="trix-button" data-trix-attribute="heading2" title="Heading 2" tabindex="-1" data-trix-active="">H2</button>
        `)
    })


</script> --}}

@endpush

@endonce