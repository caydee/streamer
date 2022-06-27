@extends('cms.includes.layout')
@section('title','Livestream')
@section('page_title','Livestream')
@section('author','')
@section('description','')
@section('header')

@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="text-right">
                <button class="btn btn-default" data-toggle="modal" data-target="#add-livestream">
                    <i class="align-middle" data-feather="plus"></i>Add Livestream
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table  table-hover table-striped" id="livestream-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Company</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Livestream Link</th>
                        <th>Status</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Company</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Livestream Link</th>
                        <th>Status</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="modal" id="add-livestream" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Livestream</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url("cms/addlivestream") }}" class="form form-horizontal upload-form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="add-title" class="control-label">Title</label>
                            <input type="text" id="add-title" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="add-description" class="control-label">Description</label>
                            <input type="text" id="add-description" name="description" class="form-control wyswig">
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <label for="add-company" class="control-label">Company</label>
                                <select id="add-company" name="company" class="form-control select2">
                                    @foreach($company as $value)
                                    <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="add-devices" class="control-label">Devices per Watch</label>
                                <input type="number" name="devices" id="add-devices" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-md col-12">
                                <label for="add-start-date" class="control-label">Start date</label>
                                <input type="text" id="add-start-date" class="form-control datetime" name="publishdate">
                            </div>
                            <div class="col-md col-12">
                                <label for="add-end-date" class="control-label">End date</label>
                                <input type="text" id="add-end-date" class="form-control datetime" name="enddate">
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="add-livestream-link" class="control-label">Livestream Link</label>
                                <input type="text" id="add-livestream-link" name="livestream_link" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-12 col-md-7">
                                <label for="keywords" class="control-label">Keywords</label>
                                <input type="text" id="keywords" data-role="tagsinput" name="keywords" class="form-control">
                            </div>
                            <div class="col-12 col-md">
                                <label for="thumbnail" class="control-label">Thumbnail</label>
                                <div class="custom-file" id="thumbnail">
                                    <input type="file" class="custom-file-input" name="image" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
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
    <div class="modal" id="edit-livestream" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Livestream</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/cms/editlivestream') }}" class="form form-horizontal create-form" method="post">
                        @csrf
                        <input type="hidden" name="id" id="edit-id">
                        <div class="form-group">
                            <label for="edit-title" class="control-label">Title</label>
                            <input type="text" id="edit-title" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit-description" class="control-label">Description</label>
                            <input type="text" id="edit-description" name="description" class="form-control wyswig">
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <label for="edit-company" class="control-label">Company</label>
                                <select id="edit-company" name="company" class="form-control select2">
                                    @foreach($company as $value)
                                        <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="edit-devices" class="control-label">Devices per Watch</label>
                                <input type="number" name="devices" id="edit-devices" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <label for="edit-publishdate" class="control-label">Start date</label>
                                <input type="text" id="edit-publishdate" class="form-control datetime" name="publishdate">
                            </div>
                            <div class="col">
                                <label for="edit-livestream_link" class="control-label">Livestream Link</label>
                                <input type="text" id="edit-livestream_link" name="livestream_link" class="form-control">
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
        jQuery(document).ready(function($) {
            $('#livestream-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": "{{ url('get_livestreams') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "company" },
                    { "data": "title" },
                    { "data": "description" },
                    { "data": "livestream_link" },
                    { "data": "status" },
                    { "data": "startdate" },
                    { "data": "enddate" },
                    { "data": "action"}
                ],
                "order": [[ 0, "desc" ]]
            });
            $('.wyswig').summernote({
                height: 300,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: true                  // set focus to editable area after initializing summernote
            });
            $('select').select2();


        });
        $('.datetime').daterangepicker({
            singleDatePicker: true,
            timePicker:true,
            opens: 'center',
            drops:'up',
            locale: {
                format: 'DD/MM/Y hh:mm A'
            }
        });
        $(document).on('click','.edit-livestream',function (e){
            e.preventDefault();
            var livestream = $(this).data("livestream");
            $("#edit-id").val(livestream.id);
            $("#edit-title").val(livestream.title);
            $("#edit-description").val(livestream.description);
            $('#edit-company option[value="'+livestream.company_id+'"]').attr("selected","selected");
            $("#edit-devices").val(livestream.viewsperuser);
            $("#edit-publishdate").val(livestream.publishdate);
            $("#edit-livestream_link").val(livestream.livestream_link);
            $("#edit-livestream").modal("show");
        });
    </script>
@endsection
