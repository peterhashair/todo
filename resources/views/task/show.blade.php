@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('task.update',array($task->id)) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header"><a href="{{ route('home') }}" class="btn btn-danger">Back to Home
                            </a>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Title <span class="required">*</span></label>
                                <input class="form-control" type="text" value="{{ $task->title }}" name="title">
                            </div>
                            <div class="form-group">
                                <label>Assign to<span class="required">*</span></label>
                                <assign-select users="{{ $users }}"></assign-select>
                            </div>
                            <div class="form-group">
                                <label>Description <span class="required">*</span></label>
                                <textarea class="form-control" name="description">{{ $task->body }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option>New</option>
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
