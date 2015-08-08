@if(\Session::has('flashstatus'))

    @if(Session::has('flashstatus') && Session::get('flashstatus') == 'success')
    <div class='alert alert-success'>
        <a aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
        {{\Session::get('flashmsg') }}
    </div>
    @elseif(Session::has('flashstatus') && Session::get('flashstatus') == 'error')
    <div class='alert alert-danger'>
        <a aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
        {{\Session::get('flashmsg') }}
    </div>
    @elseif(Session::has('flashstatus') && Session::get('flashstatus') == 'warning')
    <div class='alert alert-warning'>
        <a aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
        {{\Session::get('flashmsg') }}
    </div>
    @else
    <div class='alert alert-info'>
        <a aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
        {{\Session::get('flashmsg') }}
    </div>

    @endif
@endif
