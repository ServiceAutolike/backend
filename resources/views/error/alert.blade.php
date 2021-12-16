@if (Session::has('add_messages'))
    <div class="alert alert-{!! Session::get('add_level') !!} text-left">
        {!! Session::get('add_messages') !!}
    </div>
@endif


