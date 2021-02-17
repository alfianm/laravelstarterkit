@extends('layouts.backend.app')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
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
                Roles
            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{route('app.roles.create')}}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-plus-circle"></i>
                <span>Create Roles</span>
            </a>
        </div>    
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="datatable">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">City</th>
                        <th class="text-center">Updated at</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $key => $role)
                    <tr>
                        <td class="text-center text-muted">#{{ $key + 1 }}</td>
                        <td class="text-center">{{$role->name}}</td>
                        <td class="text-center">
                            @if ($role->permissions->count() > 0)
                                <div class="badge badge-info">{{$role->permissions->count()}}</div>
                            @else
                                <div class="badge badge-danger">No permission found</div>
                            @endif
                        </td>
                        <td class="text-center">{{$role->updated_at->diffForHumans()}}</td>

                        <td class="text-center">
                            <a href="{{route('app.roles.edit', $role->id)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i><span>Edit</span></a>
                            @if ($role->deletable == true)                                
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{$role->id}})"><i class="fas fa-trash-alt"></i><span>Delete</span></button>
                            <form id="delete-form-{{$role->id}}" action="{{route('app.roles.destroy', $role->id)}}" method="POST" style="display: none">
                            @csrf
                            @method('DELETE')
                            </form>
                            @endif

                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush