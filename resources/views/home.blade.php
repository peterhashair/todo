@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="{{ route('task.create') }}" class="btn btn-success">Create Task</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-4">
                                <new-task></new-task>
                            </div>
                            <div class="col-md-4">
                                <inprogress-task></inprogress-task>
                            </div>
                            <div class="col-md-4">
                                <complete-task></complete-task>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
