@extends('admin.layouts.admin.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3>Categories</h3>
                    </div>

                    <div class="panel-body">
                        <div>
                            <a href="{{ route('admin.category.create') }}">
                                <button type="button" class="btn btn-success btn-xs">New Category</button>
                            </a>
                        </div>
                       <table class="table table-striped task-table">
                           <thead>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created Time</th>
                           </thead>
                           <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="table-text">
                                            <div> {{ $category->id }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div> {{ $category->name }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div> {{ $category->description }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{$category->created_at}}</div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.category.edit', $category->id) }}">
                                                <button type="button" class="btn btn-primary btn-xs">Edit</button>
                                            </a>
                                            <form class="delete visible-lg-inline-block" action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
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
                            {{ $categories->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
