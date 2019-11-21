@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4"><new-task></new-task></div>
                            <div class="col-md-4">2</div>
                            <div class="col-md-4">3</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
