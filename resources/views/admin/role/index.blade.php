@extends('admin.layouts.admin.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3>Roles</h3>
                    </div>

                    <div class="panel-body">
                        <div>
                            <a href="{{ route('admin.role.create') }}">
                                <button type="button" class="btn btn-success btn-xs">New Role</button>
                            </a>
                        </div>
                       <table class="table table-striped task-table">
                           <thead>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Permission</th>
                                <th>Action</th>
                           </thead>
                           <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td class="table-text">
                                            <div> {{ $role->id }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div> {{ $role->name }}</div>
                                        </td>
                                        <td class="table-text" style="width: 60%;">
                                            <div>
                                                @foreach($role->permissions as $permission)
                                                    <label class="label label-success"> {{$permission->description }}  </label> &nbsp;&nbsp;
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.role.edit', $role->id) }}">
                                                <button type="button" class="btn btn-primary btn-xs">Edit</button>
                                            </a>
                                            <form class="delete visible-lg-inline-block" action="{{ route('admin.role.destroy', $role->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <input class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Are you sure you want to delete this item?');" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                           </tbody>
                       </table>
                        <div class="text-center">
                            {{ $roles->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
