@extends('admin.layouts.admin.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if ($permission)
                            <h3>Edit Permission</h3>
                        @else
                            <h3>Create Permission</h3>
                        @endif
                    </div>

                    <div class="panel-body">
                        <form method="post" action="{{ route('admin.permission.createPermission') }}">
                            {{ csrf_field() }}
                            @if ($permission)
                                <input type="hidden" name="id" value="{{ $permission->id }}" />
                            @endif
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label">Name</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Permission's name..."
                                           value="{{ $permission ? old('name', $permission->name) : old('title', '')}}">
                                    <small class="form-text text-muted">Example: article-create, category-edit, etc.</small>
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-2 col-form-label">Description</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="description" name="description" rows="3" placeholder="Permission's description..."
                                              value="{{ $permission ? old('description', $permission->description) : old('description', '')}}">
                                    @if ($errors->has('description'))
                                        <p class="text-danger">{{ $errors->first('description')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
