@extends('admin.layouts.admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3>All Users</h3>
                </div>

                <div class="panel-body">
                    <div>
                       <a href="{{ route('admin.user.create') }}">
                           <button type="button" class="btn btn-success btn-xs">Create New User</button>
                       </a>
                   </div>
                    <table class="table table-striped task-table">
                        <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="table-text">
                                <div> {{ $user->id }}</div>
                            </td>
                            <td class="table-text">
                                <div> {{ $user -> name }}</div>
                            </td>
                            <td class="table-text">
                                <div> {{ $user->email }}</div>
                            </td>
                            <td class="table-text">
                                @foreach($user->roles as $role)
                                    <p>{{$role->name}}</p>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.user.edit', $user->id) }}">
                                    <button type="button" class="btn btn-primary btn-xs">Edit</button>
                                </a>
                                <form class="delete visible-lg-inline-block" action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input class="btn btn-danger btn-xs"  type="submit" onclick="return confirm('Are you sure you want to delete this item?');" value="Delete">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $users->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
