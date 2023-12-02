@extends('layouts.master')
@section('content')
    <style>
        /* Style The Dropdown Button */
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: rgba(31, 31, 31, 0)
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: list-item;

        }

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
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
                                        <img src="{{asset('uploads/users/'.$u->avatar)}}" height="70px" width="70px" alt="Image">
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
