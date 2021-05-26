@extends('cms.includes.layout')
@section('title','Users')
@section('page_title','Users')
@section('author','')
@section('description','')
@section('header')

@endsection
@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="users">
                <thead>
                <tr>
                    <th>*</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>*</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User Roles</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('cms/edituserroles') }}" class="form form-horizontal create-form">
                        <div class="form-group">
                            <label for="" class="control-label">Users:</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="add-view-user" name="roles[users][view]" value="TRUE">
                                <label class="form-check-label" for="add-view-user">View</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="add-user-roles" name="roles[users][roles]" value="TRUE">
                                <label class="form-check-label" for="add-user-roles">Roles</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="add-user_status" name="roles[users][status]" value="TRUE">
                                <label class="form-check-label" for="add-user_status">Status</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Moderation:</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="add-moderation" name="roles[moderate]" value="TRUE">
                                <label class="form-check-label" for="add-roles">Can Moderate</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Rates:</label>
                            <br>
                            <input type="hidden" name="userid" id="userid">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="add-rates" name="roles[rates][add]" value="TRUE">
                                <label class="form-check-label" for="add-rates">Add</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="add-rates-view" name="roles[rates][view]" value="TRUE">
                                <label class="form-check-label" for="add-rates-view">View</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="add-rates-update" name="roles[rates][update]" value="TRUE">
                                <label class="form-check-label" for="add-rates-update">Update</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="add-rates-delete" name="roles[rates][delete]" value="TRUE">
                                <label class="form-check-label" for="add-rates-delete">delete</label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $('#users').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "{{ url('get_users') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token :"{{csrf_token()}}"}
            },
            "columns": [
                { "data": "*" },
                { "data": "name" },
                { "data": "email" },
                { "data": "phoneno" },
                { "data": "status" },
                { "data": "action"}
            ],
            "order": [[ 0, "desc" ]]


        });
    </script>
@endsection
