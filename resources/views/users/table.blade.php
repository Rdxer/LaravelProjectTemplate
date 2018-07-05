<table class="table table-responsive" id="users-table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Phone</th>
        <th>RoleName</th>
        <th>Email</th>
        <th colspan="4">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->id !!}</td>
            <td>{!! $user->name !!}</td>
            <td>{!! $user->phone !!}</td>
            <td>{!! $user->roleDesc() !!}</td>
            <td>{!! $user->email !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>

                    <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>

                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>

                    @if($user->hasRole('admin'))

                    <a href="{!! route('users.revoke_admin', [$user->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-ban-circle"></i></a>
                    @else
                        <a href="{!! route('users.become_admin', [$user->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-knight"></i></a>
                    @endif

                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}

                </div>
                {!! Form::close() !!}

            </td>
        </tr>
    @endforeach
    </tbody>
</table>