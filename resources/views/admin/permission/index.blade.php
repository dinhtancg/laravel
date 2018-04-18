@extends('admin.layouts.admin.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3>Permission</h3>
                    </div>

                    <div class="panel-body">
                        <div>
                            <a href="{{ route('admin.permission.create') }}">
                                <button type="button" class="btn btn-success btn-xs">New Permission</button>
                            </a>
                        </div>
                       <table class="table table-striped task-table">
                           <thead>
                                <th>Name</th>
                                <th>Description</th>
                           </thead>
                           <tbody>
                                @foreach($permissions as $permission)
                                    <tr>

                                        <td class="table-text">
                                            <div> {{ $permission->name }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div> {{ $permission->description }}</div>
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.permission.edit', $permission->id) }}">
                                                <button type="button" class="btn btn-primary btn-xs">Edit</button>
                                            </a>
                                            <form class="delete visible-lg-inline-block" action="{{ route('admin.permission.destroy', $permission->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <input class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Are you sure you want to delete this item?');"  value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                           </tbody>
                       </table>
                        <div class="text-center">
                            {{ $permissions->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
