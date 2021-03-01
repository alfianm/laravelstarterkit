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
        <div class="page-title-actions d-flex">
            <button onclick="event.preventDefault();
                    document.getElementById('clean-old-backup').submit();" class="btn-shadow mr-4 btn btn-danger">
                <i class="fas fa-trash"></i>
                Clean Old Backups
            </button>
            <form action="{{route('app.backups.clean')}}" method="POST" id="clean-old-backup">
            @csrf
            @method('DELETE')
            </form>

            <button type="button" onclick="event.preventDefault();
                    document.getElementById('new-backup-form').submit();" class="btn-shadow mr-4 btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Create New Backups
            </button>
            <form action="{{route('app.backups.store')}}" method="POST" id="new-backup-form">
            @csrf
            </form>
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
                        <th class="text-center">File Name</th>
                        <th class="text-center">Size</th>
                        <th class="text-center">Created at</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($backups as $key => $backup)
                    <tr>
                        <td class="text-center text-muted">#{{ $key + 1 }}</td>
                        <td class="text-center"><code>{{$backup['file_name']}}</code></td>
                        <td class="text-center">{{$backup['file_size']}}</td>
                        <td class="text-center">{{$backup['created_at']}}</td>
                        <td class="text-center">
                            <a href="{{route('app.backups.download',$backup['file_name'])}}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                                <span>Download</span>
                            </a>
                                                    
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{$key}})"><i class="fas fa-trash-alt"></i><span>Delete</span></button>
                            <form id="delete-form-{{$key}}" action="{{route('app.backups.destroy', $backup['file_name'])}}" method="POST" style="display: none">
                            @csrf
                            @method('DELETE')
                            </form>

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