@extends('admin.layouts.admin.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if ($users)
                            <h3>Edit User</h3>
                        @else
                            <h3>Create User</h3>
                        @endif
                    </div>

                    <div class="panel-body">
                        <form method="post" action="{{ route('admin.user.create') }}">
                            {{ csrf_field() }}
                            @if ($users)
                                <input type="hidden" name="id" value="{{ $users->id }}" />
                            @endif
                            <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $users ? old('name', $users->name) : old('name', '')}}"  autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $users ? old('email', $users->email) : old('email', '')}}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group row">--}}
                                {{--<label for="role" class="col-md-4 control-label">Role</label>--}}

                                {{--<div class="col-md-6 ">--}}


                                    {{--<div class='form-group'>--}}
                                        {{--@foreach ($roles as $role)--}}
                                            {{--<input  type="checkbox" id = "{{ $role->slug }}"name="roles[]" value="{{ $role ? old('id', $role->id) : old('id', '')}}"--}}
                                                    {{--{{($users) ? (in_array($role->id, array_map(function ($a){return $a["id"];}, $users->roles->toArray())) ? 'checked' : '') :'' }}--}}
                                            {{--> {{$role->name}} &nbsp;&nbsp;--}}
                                        {{--@endforeach--}}
                                    {{--</div>--}}
                                    {{--<select id="categories" multiple name="category" class="form-control">--}}
                                        {{--<option></option>--}}
                                        {{--@foreach($categories as $category)--}}
                                            {{--<option value="{{ $category->id }}" > {{ $category->name }} </option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group row">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{--<script src="{{ asset('js/backend/check_secretary.js') }}"></script>--}}
@endsection
