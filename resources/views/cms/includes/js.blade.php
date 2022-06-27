<script>
    $(document).on('submit', '.create-form', function (e) {
        e.preventDefault();
        var frm = $(this);
        $.ajax({
            type: 'POST',
            url: frm.attr('action'),
            headers: {"X-CSRF-TOKEN": "{{csrf_token()}}"},
            data: $(e.target).serialize(),
            success: function (Mess) {
                if (Mess.status == true) {
                    $($(this).data('modal')).modal('toggle');

                    toastr.success(Mess.msg, Mess.header, {
                        timeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        newestOnTop: true,
                        onHidden: function () {
                            frm.trigger("reset");
                            window.location.reload();
                        }
                    });


                } else {
                    toastr.error(Mess.msg, Mess.header, {
                        timeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        newestOnTop: true
                    });
                }
            },
            error: function (f) {
                console.log(f);
                $.each(f.responseJSON.errors, function (key, val) {
                    toastr.error(val[0], f.responseJSON.message, {
                        timeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        newestOnTop: true,
                        onHidden: function () {
                            window.location.reload();
                        }
                    });

                });


            }
        });

    });
    $(document).on('click','.delete-record',function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ url('cms/delete') }}',
            headers: { "X-CSRF-TOKEN":"{{ csrf_token() }}"},
            data: {"id":$(this).data("id"),"table":$(this).data("table")},
            success: function (Mess) {
                if (Mess.status == true) {
                    toastr.success(Mess.msg, Mess.header, {
                        timeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        newestOnTop: true,
                        onHidden: function () {
                            window.location.reload();
                        }
                    });


                } else {
                    toastr.error(Mess.msg, Mess.header, {
                        timeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        newestOnTop: true,
                        onHidden: function () {
                            window.location.reload();
                        }
                    });
                }
            },
            error: function (f) {
                console.log(f);
                $.each(f.responseJSON.errors, function (key, val) {
                    toastr.error(val[0], f.responseJSON.message, {
                        timeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        newestOnTop: true,
                        onHidden: function () {
                            window.location.reload();
                        }
                    });

                });


            }

        });

    });
    $(document).on('click','.updaterecord',function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ url('cms/update') }}',
            headers: { "X-CSRF-TOKEN":"{{csrf_token()}}" },
            data: {"id":$(this).data("id"),"table":$(this).data("table"),"column":$(this).data("column"),"value":$(this).data("value")},
            success: function (Mess) {
                if (Mess.status == true) {
                    toastr.success(Mess.msg, Mess.header, {
                        timeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        newestOnTop: true,
                        onHidden: function () {
                            window.location.reload();
                        }
                    });


                } else {
                    toastr.error(Mess.msg, Mess.header, {
                        timeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        newestOnTop: true,
                        onHidden: function () {
                            window.location.reload();
                        }
                    });
                }
            },
            error: function (f) {
                console.log(f);
                $.each(f.responseJSON.errors, function (key, val) {
                    toastr.error(val[0], f.responseJSON.message, {
                        timeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        newestOnTop: true,
                        onHidden: function () {
                            window.location.reload();
                        }
                    });

                });


            }

        });

    });
    $(document).on('submit', '.upload-form', function (e) {
        e.preventDefault();
        var frm         =   $(this);
        var formData    =   new FormData(frm[0]);



        $.ajax({
            url : frm.attr('action'),
            type : 'POST',
            headers: {"X-CSRF-TOKEN": "{{csrf_token()}}"},
            data : formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success : function(Mess) {
                if (Mess.status == true) {
                    $($(this).data('modal')).modal('toggle');

                    toastr.success(Mess.msg, Mess.header, {
                        timeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        newestOnTop: true,
                        onHidden: function () {
                            frm.trigger("reset");
                            window.location.reload();
                        }
                    });


                } else {
                    toastr.error(Mess.msg, Mess.header, {
                        timeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        newestOnTop: true
                    });
                }
            },
            error: function (f) {
                console.log(f);
                $.each(f.responseJSON.errors, function (key, val) {
                    toastr.error(val[0], f.responseJSON.message, {
                        timeOut: 1000,
                        closeButton: true,
                        progressBar: true,
                        newestOnTop: true,
                        onHidden: function () {
                            window.location.reload();
                        }
                    });

                });


            }
        });
    });

</script>
