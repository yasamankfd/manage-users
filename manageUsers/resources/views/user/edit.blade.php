@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <h6 class="alert alert-success">{{session('status')}}</h6>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>edit user
                            <a href="{{url('user')}}" class="btn btn-danger float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('update-user/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label>name</label>
                                <input type="text" value="{{$user->name}}" name="name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>last name</label>
                                <input type="text" value="{{$user->lastname}}" name="lastname" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>email</label>
                                <input type="text" value="{{$user->email}}" name="email" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>password</label>
                                <input type="text" value="{{$user->pass}}" name="pass" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>avatar</label>
                                <input type="file" name="avatar" class="form-control">
                                <img src="{{asset('uploads/users/'.$user->avatar)}}" width="70px" height="70px" alt="Image">

                            </div>

                            <div class="form-group mb-3">
                                <label>status</label>
                                <input type="number" value="{{$user->status}}" name="status" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">edit user</button>

                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

