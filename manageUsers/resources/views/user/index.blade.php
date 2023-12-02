@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Users
                        <a href="{{url('add-user')}}" class="btn btn-primary float-end">add user</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>LAST NAME</th>
                                <th>EMAIL</th>
                                <th>AVATAR</th>
                                <th>STATUS</th>
                                <th>SETTING</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $u)
                                <tr>
                                    <td>{{ $u->id }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->lastname }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>
                                        @foreach($profiles as $p)
                                            @if($p->user_id == $u->id)
                                                <img src="{{asset('uploads/users/'.$p->avatar)}}" height="70px" width="70px" alt="Image">
                                            @endif
                                        @endforeach
                                    </td>
                                    @if($u->status==1)
                                        <td>active</td>
                                    @elseif($u->status==2)
                                        <td>inactive</td>
                                    @endif

                                    <td>
                                        <div class="dropdown">
                                            <button class="dropbtn">...</button>
                                            <div class="dropdown-content">
                                                <a href="{{url('delete-user/'.$u->id)}}" class="btn btn-danger">DELETE</a>
                                                <a href="{{url('edit-user/'.$u->id)}}" class="btn btn-light">EDIT</a>
                                                <a href="{{url('active-user/'.$u->id)}}" class="btn btn-success">status</a>
                                            </div>
                                        </div>
                                    </td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>


@endsection
