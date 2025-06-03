var datatableId = '#data-table';
$(function() {

    var table = $(datatableId).DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        ajax: {
            url : route,
            data : function(d){
                d.search = $('#search').val();
            }
        },
        stateSaveParams: function (settings, data) {
            $(".common_filter_div :input").map(function () {
                if ($(this).attr("data-state") !== "false") {
                    var name = $(this).attr("id");
                    var value = $(this).val();
                    data[name] = value;
                }
            });
            // toggle column state save
            $(".dt_toggle_colums :input").map(function () {
                if ($(this).attr("data-state") !== "false") {
                    var name = $(this).attr("id");
                    var value = $(this).val();
                    data[name] = value;
                }
            });
        },
        stateLoadParams: function (settings, data) {
            $(".common_filter_div :input").map(function () {
                var name = $(this).attr("id");
                $(this).val(data[name]).trigger("change");
            });
            // toggle column state load
            $(".dt_toggle_colums :input").map(function () {
                var name = $(this).attr("id");
                $(this).val(data[name]).trigger("change");
            });
        },
        dom: '<"card-body p-0"tr><"row align-items-center"<"col-auto d-none d-xl-block"i><"col-auto"l><"col-auto ms-auto"p>>',
        
        columns: [
            
            {data: 'name',name: 'name', orderable: true},
            {data: 'email',name: 'email', orderable: true},
            {data: 'phone',name: 'phone', orderable: true},
            {data: 'created_at', name: 'created_at', searchable: true},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        fnDrawCallback: function() {
            $('.delete_user').click(function(){
                var contact_id = $(this).data('contact_id');
                $('#contact_delete_modal #contact_id').val(contact_id);
                $('#contact_delete_modal').modal('show');
            })
            $('.close_modal').click(function(){
                $('#contact_delete_modal').modal('toggle');
            })
        },
    });

});

$(document).ready(function () {

    $('#search_btn').click(function () {
        $(datatableId).DataTable().draw();
    });

   

    $('#contact_delete_fr').submit(function(evnet){
        evnet.preventDefault()
        
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var contact_id = $('#contact_delete_modal #contact_id').val()
        $.ajax({
            url: deleteContact + '/' + contact_id,
            method: "DELETE",
            dataType: "json",
            success: function (response) {
                $('#contact_delete_modal').modal('toggle');
                
                if (response.status == "success") {
                    successToast(response.message);
                }
                if (response.status == "failure") {
                    errorToast(response.message);
                }
                $(datatableId).DataTable().draw();
            },
            error: function(xhr, status, error) {
                // Handle any errors
                errorToast('Something went wrong. Please try again.');
            }
        });
    })


});
