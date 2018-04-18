@extends('admin.layouts.admin.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if ($role)
                            <h3>Edit Role</h3>
                        @else
                            <h3>Create Role</h3>
                        @endif
                    </div>

                    <div class="panel-body">
                        <form method="post" action="{{ route('admin.role.createRole') }}">
                            {{ csrf_field() }}
                            @if ($role)
                                <input type="hidden" name="id" value="{{ $role->id }}" />
                            @endif
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label">Name</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Role's name..."
                                           value="{{ $role ? old('name', $role->name) : old('title', '')}}">
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-md-2 control-label">Permissions</label>
                                <div class="col-md-10 ">
                                    @foreach ($permissions as $permission)
                                        <input  type="checkbox" name="permisions[]" value="{{ $permission ? old('id', $permission->id) : old('id', '')}}"
                                                {{($role) ? (in_array($permission->id, array_map(function ($a){return $a["id"];}, $role->permissions->toArray())) ? 'checked' : '') :'' }}
                                        > {{$permission->name}} <br>
                                    @endforeach
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