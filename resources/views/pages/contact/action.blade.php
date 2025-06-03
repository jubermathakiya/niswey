
    <a href="{{ route('contacts.edit', $data->id) }}"  class="btn btn-warning btn-sm" >
        {{ __('message.edit') }}
    </a>
    <a href="javascript:void(0);" data-contact_id="{{ $data->id }}"  class="btn btn-danger btn-sm delete_user">
        {{ __('message.delete') }}
    </a>



    