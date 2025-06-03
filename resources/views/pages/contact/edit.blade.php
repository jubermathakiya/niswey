@extends('partials.main')

@section('title', 'Edit Contact')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('message.contact.edit_contact') }}</h3>
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
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card card-primary card-outline mb-4">
                        <form action="{{ route('contacts.update', $contact->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="contact_id" id="contact_id" value="{{ $contact->id }}" />
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('message.contact.name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                    value="@if(old('name')){{ old('name') }}@elseif(isset($contact->name)){{ $contact->name }}@endif"
                                        />
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('message.email') }}</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ isset($contact->email) ? $contact->email : old('email') }}" />
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">{{ __('message.contact.phone') }}</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="@if(old('phone')){{ old('phone') }}@elseif(isset($contact->phone)){{ $contact->phone }}@endif" />
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">{{ __('message.cancel') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('message.update') }}</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
