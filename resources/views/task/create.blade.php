@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="" method="post">
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
                                <input class="form-control" type="text" name="title">
                            </div>
                            <div class="form-group">
                                <label>Assign to<span class="required">*</span></label>
                                <assign-select users="{{ $users }}"></assign-select>
                            </div>
                            <div class="form-group">
                                <label>Description <span class="required">*</span></label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-success" value="Create">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
