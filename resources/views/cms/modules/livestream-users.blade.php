@extends('cms.includes.layout')
@section('title','Livestream Users')
@section('page_title',ucfirst($livestream_title).' : Livestream Users')
@section('author','')
@section('description','')
@section('header')

@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="text-right">
                <button class="btn btn-default" data-toggle="modal" data-target="#add-livestream-users">
                    <i class="align-middle" data-feather="plus"></i>Add Livestream users
                </button>

            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="livestream-users">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logged in Devices</th>
                        <th>Status</th>
                        <th>Notified</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logged in Devices</th>
                        <th>Status</th>
                        <th>Notified</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="modal" id="add-livestream-users" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Livestream Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="accordion">
                    <div class="btn-group mb-3">
                        <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#formupload" aria-expanded="false" aria-controls="multiCollapseExample2">Form Upload</button>
                        <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#bulkupload" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Bulk Upload</button>
                    </div>
                    <div class="collapse show" id="formupload" data-parent="#accordion">
                        <form action="{{ url('cms/addlivestreamusers') }}" class="form form-horizontal create-form" method="post">
                            <input type="hidden" name="livestream_id" value="{{ $id }}">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="control-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <hr>
                            <div class="form-group form-row">
                                <div class="ml-auto">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="collapse" id="bulkupload" data-parent="#accordion">
                        <a href="{{ asset('assets/csv/bulk.csv') }}">Bulk Upload csv</a>
                        <form action="{{ url('cms/bulkupload') }}" class="form form-horizontal upload-form" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="livestream_id" value="{{ $id }}">
                            @csrf
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="file">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group form-row">
                                <div class="ml-auto">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal" id="edit-livestream-users" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Livestream Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                        <form action="{{ url('cms/editlivestreamusers') }}" class="form form-horizontal create-form" method="post">
                            <input type="hidden" name="livestream_id" value="{{ $id }}">
                            @csrf
                            <input type="hidden" name="id" >
                            <div class="form-group">
                                <label for="name" class="control-label">Name</label>
                                <input type="text" name="name" id="edit-name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" name="email" id="edit-email" class="form-control">
                            </div>
                            <hr>
                            <div class="form-group form-row">
                                <div class="ml-auto">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('footer')
    <script>
        $('#livestream-users').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "{{ url('get_livestream_users') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}",id:"{{ $id }}"}
            },
            "columns": [
                { "data": "name" },
                { "data": "email" },
                { "data": "devices" },
                { "data": "status" },
                { "data": "notified" },
                { "data": "action"}
            ],
            "order": [[ 0, "asc" ]]
        });
        $(document).on("click",".edit-user",function(e){
            e.preventDefault();
            var user    =   $(this).data("user");
            $("#edit-id").val(user.id);
            $("#edit-name").val(user.name);
            $("#edit-email").val(user.email);
            $("#edit-livestream-users").modal("show");
        });
    </script>
@endsection
