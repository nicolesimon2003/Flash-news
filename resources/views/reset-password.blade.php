@extends('layout')

@section('content')
    <div class="container mt-5" style="width: 500px">
    <div class="mt-5">
            @if($errors->any())
                <div class="col-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                </div>
            @endif
        </div>
        <form action="{{ route('reset.password.post') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <div class="mb-3">
                <label for="password">New Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
@endsection