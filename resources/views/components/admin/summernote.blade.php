
@error($attributes->get('name'))

<textarea name="{{$name}}" class="summernote textarea-error">{{ old($attributes->get('name')) }}</textarea>

@else

<textarea name="{{$name}}" class="summernote">

    @if (old($attributes->get('name')))
    
    {{ old($attributes->get('name')) }}
    @else
    {{ $slot }}
        
    @endif


</textarea>

@enderror








@once

@push('css')


{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet"> --}}
<link href="{{ asset('css/admin/libs/bootstrap.min.css') }}" rel="stylesheet">

<link href="{{ asset('css/admin/libs/summernote.min.css') }}" rel="stylesheet">


@endpush


@push('js')




{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script> --}}

<script src="{{ asset('js/admin/libs/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/admin/libs/bootstrap.min.js') }}"></script>

<script src="{{ asset('js/admin/libs/summernote.min.js') }}"></script>

<script src="{{ asset('js/admin/libs/summernote-image-title.js') }}"></script>


<script>
    window.addEventListener("load", (event) => {

        $(document).ready(function() {
            $('.summernote').summernote({ 
                spellCheck: false,               
                toolbar: [
                  ['style', ['style']],
                  ['font', ['bold', 'underline', 'clear']],
                //   ['fontname', ['fontname']],
                //   ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['table', ['table']],
                  ['insert', ['link', 'picture', 'video']],
                  ['view', ['fullscreen', 'codeview', 'help']],
                ],

                callbacks: {
                    onPaste: function (e) {
                        let bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        let text = '<p>' + bufferText + '</p>';

                        e.preventDefault();
                        document.execCommand('insertHTML', false, text);                    
                    }
                },
                 // ? image title, alt
                imageTitle: {
                    specificAltField: true,
                },
                lang: 'en-US',
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']],
                        ['custom', ['imageTitle']],
                    ],
                },
            });
           
        });
    });


</script>

@endpush

@endonce