@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <h4>Feedback</h4>
        </div>
        <div class="col-lg-4 text-right">
            <a href="{{ route('feedback.form') }}" class="btn btn-primary">
                Add new
            </a>
        </div>
    </div><br>

    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>
                        E-mail
                        <a href="{{ route('feedback.index', ['sortColumn' => 'email', 'sortDirection' => 'desc']) }}">DESC</a>
                        <a href="{{ route('feedback.index', ['sortColumn' => 'email', 'sortDirection' => 'asc']) }}">ASC</a>
                    </th>
                    <th>
                        Name
                        <a href="{{ route('feedback.index', ['sortColumn' => 'name', 'sortDirection' => 'desc']) }}">DESC</a>
                        <a href="{{ route('feedback.index', ['sortColumn' => 'name', 'sortDirection' => 'asc']) }}">ASC</a>
                    </th>
                    <th>
                        Rate
                        <a href="{{ route('feedback.index', ['sortColumn' => 'rate', 'sortDirection' => 'desc']) }}">DESC</a>
                        <a href="{{ route('feedback.index', ['sortColumn' => 'rate', 'sortDirection' => 'asc']) }}">ASC</a>
                    </th>
                    <th>Comment</th>
                    <th>File</th>
                    <th>
                        Date
                        <a href="{{ route('feedback.index', ['sortColumn' => 'created_at', 'sortDirection' => 'desc']) }}">DESC</a>
                        <a href="{{ route('feedback.index', ['sortColumn' => 'created_at', 'sortDirection' => 'asc']) }}">ASC</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->rate }}</td>
                        <td>{{ $row->comment }}</td>
                        <td>
                            @if($row->file_name !== null)
                                <img src="{{ asset('storage/' . $row->file_name) }}" style="max-width: 150px;">
                            @endif
                        </td>
                        <td>{{ $row->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
