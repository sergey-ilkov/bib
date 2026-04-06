@if ($alert = session()->pull('alert'))
   
    <div class="alert-page alert-{{ session()->pull('alert_type') }} mb-0 rounded-0 text-center small py-2" role="alert">

        {{ $alert }}

    </div>

@endif