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
                    <h4>add user
                        <a href="{{url('user')}}" class="btn btn-danger float-end">back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('add-user')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label>name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>last name</label>
                            <input type="text" name="lastname" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>email</label>
                            <input type="text" name="email" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>password</label>
                            <input type="text" name="pass" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>avatar</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="cars">user status:</label>
                            <select name="status" id="statuses">
                                <option value="1">active</option>
                                <option value="2">inactive</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">add user</button>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

