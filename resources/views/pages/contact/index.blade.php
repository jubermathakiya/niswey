@extends('partials.main')

@section('title', 'Contacts')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('message.contact.contact_list') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">{{ __('message.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('message.contact.contacts') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header common_filter_div">
                                <a href="{{ route('contacts.create') }}"
                                    class="btn btn-primary float-md-right">{{ __('message.contact.add_contact') }}</a>
                                <a href="javascript:void(0)" id="import_file" class="btn btn-primary float-md-right">Import
                                    XML</a>
                                <input type="file" id="xml_file" style="display:none" accept=".xml" />
                            </div>
                            <div class="card-body table-responsive-sm table-responsive-md">

                                <table id="data-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.name') }}</th>
                                            <th>{{ __('message.email') }}</th>
                                            <th>{{ __('message.phone') }}</th>
                                            <th>{{ __('message.created') }}</th>
                                            <th>{{ __('message.action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="contact_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete</h4>
                </div>
                <form method="post" id="contact_delete_fr">
                    <input type="hidden" name="contact_id" id="contact_id" />
                    <div class="modal-body">
                        <p>Are you sure you want to delete this contact?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        var route = "{{ route('contacts.index') }}";
        var deleteContact = "{{ route('contacts.destroy', '') }}";
    </script>
    <script src="{{ asset('assets/js/contact/datatable.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('#import_file').click(function() {
                $('#xml_file').click();
            })

            $('#xml_file').change(function() {
                var file = this.files[0];
                
                var formData = new FormData();
                formData.append('file', file);
                
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('importxml') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr) {
                        errorToast('Something went wrong')
                        document.getElementById("xml_file").value = "";
                    }
                });
            })

        })
    </script>
@endpush
