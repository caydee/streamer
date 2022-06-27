@extends('cms.includes.layout')
@section('title','Company')
@section('page_title','Company')
@section('author','')
@section('description','')
@section('header')

@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="text-right">
                <button class="btn btn-default" data-toggle="modal" data-target="#add-company">
                    <i class="align-middle" data-feather="plus"></i>Add Company
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="company-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Company Name</th>
                        <th>Location</th>
                        <th>Contact name</th>
                        <th>Contact email</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Company Name</th>
                        <th>Location</th>
                        <th>Contact name</th>
                        <th>Contact email</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
    <div class="modal" id="add-company" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('cms/addcompany') }}" class="form form-horizontal create-form" method="post">
                       @csrf
                        <div class="form-group">
                            <label for="add-companyname" class="control-label">Company Name</label>
                            <input type="text" id="add-companyname" name="company" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="add-location" class="control-label">Location</label>
                            <input type="text" id="add-location" name="location" class="form-control">
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <label for="add-contact-name" class="control-label">Contact Name</label>
                                <input type="text" id="add-contact-name" name="contact_name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="add-contact-email" class="control-label">Contact Email</label>
                                <input type="text" id="add-contact-email" name="contact_email" class="form-control">
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
    <div class="modal" id="edit-company" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/cms/editcompany') }}" class="form form-horizontal create-form" method="post">
                        @csrf
                        <input type="hidden" name="id" id="edit-company-id">
                        <div class="form-group">
                            <label for="edit-company-name" class="control-label">Company Name</label>
                            <input type="text" id="edit-company-name" name="company" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit-location" class="control-label">Location</label>
                            <input type="text" id="edit-location" name="location" class="form-control">
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <label for="edit-contact-name" class="control-label">Contact Name</label>
                                <input type="text" id="edit-contact-name" name="contact_name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="edit-contact_email" class="control-label">Contact Email</label>
                                <input type="text" id="edit-contact_email" name="contact_email" class="form-control">
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
@endsection
@section('footer')
    <script>
        $(document).on('click','.edit-company',function(e){
            e.preventDefault();
            var company = $(this).data('company');
            var user = $(this).data('user');
            $('#edit-company-id').val(company.id);
            $('#edit-company-name').val(company.company_name);
            $('#edit-location').val(company.location);
            $('#edit-contact-name').val(user.name);
            $('#edit-contact_email').val(user.email);
            $('#edit-company').modal('toggle');
        });
        $('#company-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "{{ url('get_companies') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "company" },
                { "data": "location" },
                { "data": "contact_name" },
                { "data": "contact_email" },
                { "data": "status" },
                { "data": "created_at" },
                { "data": "action"}
            ],
            "order": [[ 0, "desc" ]]
        });

    </script>
@endsection
