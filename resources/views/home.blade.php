@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><a href="{{ route('task.create') }}" class="btn btn-success">Create
                            Task</a>
                        <a style="float:right" href="{{ route('log.home') }}" class="btn btn-info">Show Log</a>
                    </div>

                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-4">
                                <new-task :tasks="tasks" v-on:deletetask="deleteTask" v-on:changestatus="changeStatus" v-on:gettask="getTask"></new-task>
                            </div>
                            <div class="col-md-4">
                                <inprogress-task :ptasks="ptasks" v-on:deletetask="deleteTask" v-on:changestatus="changeStatus" v-on:gettask="getTask"></inprogress-task>
                            </div>
                            <div class="col-md-4">
                                <complete-task :ctasks="ctasks" v-on:deletetask="deleteTask" v-on:changestatus="changeStatus" v-on:gettask="getTask"></complete-task>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
