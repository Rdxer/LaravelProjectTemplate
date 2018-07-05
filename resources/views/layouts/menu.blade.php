

@role("super-admin")
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Users</span></a>
</li>
@endrole
{{--<li class="{{ Request::is('letters*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('letters.index') !!}"><i class="fa fa-edit"></i><span>Letters</span></a>--}}
{{--</li>--}}

