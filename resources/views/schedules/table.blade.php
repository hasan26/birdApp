<table class="table table-responsive" id="schedules-table">
    <thead>
        <th>Title</th>
        <th>Description</th>
        <th>Do Date</th>
        <th>Status</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($schedules as $schedule)
        <tr>
            <td>{!! $schedule->title !!}</td>
            <td>{!! $schedule->description !!}</td>
            <td>{!! $schedule->do_date !!}</td>
            <td>{!! $schedule->status !!}</td>
            <td>
                {!! Form::open(['route' => ['schedules.destroy', $schedule->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('schedules.show', [$schedule->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('schedules.edit', [$schedule->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>