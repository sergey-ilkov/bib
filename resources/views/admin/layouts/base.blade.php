<!DOCTYPE html>
<html lang="uk">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{__('Admin panel')}}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/admin/favicon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">


    @stack('css')



    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet"> --}}


    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') . '?v=' . rand(10, 1000)  }}">


    @stack('js')

    
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script> --}}



    {{-- <script>
        window.addEventListener("load", (event) => {
        
            $(document).ready(function() {
                $('.summernote').summernote({               
                    toolbar: [
                      ['style', ['style']],
                      ['font', ['bold', 'underline', 'clear']],
                    //   ['fontname', ['fontname']],
                      ['color', ['color']],
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
                    }
                });
            
            });
        });
    
    
    </script> --}}

    <script src="{{ asset('js/admin/admin.js') . '?v=' . rand(10, 1000)  }}" defer></script>

</head>

<body>


    <div class="wrapper">


        <x-admin.alert-page></x-admin.alert-page>





        <div class="admin-panel">

            @include('admin.includes.aside')

            <div class="admin-panel-content">

                @include('admin.includes.header')


                @yield('content')
            </div>



        </div>




    </div>


</body>

</html>