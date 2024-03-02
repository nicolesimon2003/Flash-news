@extends('layout')
@section('title','reset request')
@section('content')
    <div class="container mt-5" style="width: 500px">
             @if($errors->any())
                <div class="col-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                </div>
            @endif
        <form action="{{ route('reset.request.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email">Enter Your Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection