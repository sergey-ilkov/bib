@props(['method' => 'GET'])

@php($method = strtoupper($method))

@php($res_method = in_array($method, ['GET', 'POST']))
    


<form {{$attributes}} method="{{ $res_method ? $method : 'POST' }}">

    @unless ($res_method)

        @method($method)
        
    @endunless
      
    @if ($method !== 'GET')

        @csrf
        
    @endif

    {{$slot}}

</form>