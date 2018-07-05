<table class="table table-responsive" id="letters-table">
    <thead>
        <tr>
            <th>Id</th>
        <th>User Id</th>
        <th>Type</th>
        <th>Read At</th>
        <th>Title</th>
        <th>Details</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($letters as $letter)
        <tr>
            <td>{!! $letter->id !!}</td>
            <td>{!! $letter->user_id !!}</td>
            <td>{!! $letter->type !!}</td>
            <td>{!! $letter->read_at !!}</td>
            <td>{!! $letter->title !!}</td>
            <td>{!! $letter->details !!}</td>
            <td>
                {!! Form::open(['route' => ['letters.destroy', $letter->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('letters.show', [$letter->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('letters.edit', [$letter->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>