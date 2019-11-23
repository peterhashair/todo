@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->user->name }}</td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>

                </div>

                {{ $logs->links() }}
            </div>
        </div>
    </div>
@endsection
