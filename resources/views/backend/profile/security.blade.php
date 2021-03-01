@extends('layouts.backend.app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>

<style>
    .dropify-wrapper .dropify-message p {
        font-size: initial;
    }
</style>
@endpush

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-check icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                {{ isset($user) ? 'Edit' : 'Create' }} Users
            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('app.users.index')}}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-arrow-circle-left"></i>
                <span>Back to list</span>
            </a>
        </div>  
       
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form method="POST" action="{{isset($user) ? route('app.users.update', $user->id) : route('app.users.store')}}" enctype="multipart/form-data">
            @csrf
            @isset($user)
                @method('PUT')
            @endisset
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
        
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? old('name') }}" autofocus>
        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" autofocus>
        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autofocus>
        
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autofocus>
        
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Select Roles and Status</h5>

                            <div class="form-group">
                                <label for="role">Select Roles</label>
                                <select id="role" type="text" class="select-role form-control @error('role') is-invalid @enderror" name="role">
                                    @foreach ($roles as $key => $role)
                                        <option value="{{$role->id}}" @isset($user) {{$user->role->id == $role->id ? 'selected' : ''}} @endisset>{{$role->name}}</option>
                                    @endforeach
                                </select>
        
                                @error('roles')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input id="avatar" type="file" class="form-control avatar @error('avatar') is-invalid @enderror" name="avatar" data-default-file="{{isset($user) ? $user->getFirstMediaUrl('avatar') : ''}}">
        
                                @error('avatar')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status" @isset($user) {{ $user->status == true ? 'checked' : '' }} @endisset>
                                    <label class="custom-control-label" for="status">Status</label>
                                </div>
                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            @isset($user)
                                <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Update</button>
                            @else
                                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create</button>
                            @endisset

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $(document).ready(function(){
        $('.select-role').select2();

        $('.avatar').dropify();
    })
</script>
@endpush