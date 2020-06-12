@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.client.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clients.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="passport_photo">{{ trans('cruds.client.fields.passport_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('passport_photo') ? 'is-invalid' : '' }}" id="passport_photo-dropzone">
                </div>
                @if($errors->has('passport_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('passport_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.passport_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.client.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.client.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_number">{{ trans('cruds.client.fields.id_number') }}</label>
                <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="number" name="id_number" id="id_number" value="{{ old('id_number', '') }}" step="1" required>
                @if($errors->has('id_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.id_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.client.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}" required>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.client.fields.gender') }}</label>
                @foreach(App\Client::GENDER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="zone">{{ trans('cruds.client.fields.zone') }}</label>
                <input class="form-control {{ $errors->has('zone') ? 'is-invalid' : '' }}" type="text" name="zone" id="zone" value="{{ old('zone', '') }}" required>
                @if($errors->has('zone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.zone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kra_pin">{{ trans('cruds.client.fields.kra_pin') }}</label>
                <input class="form-control {{ $errors->has('kra_pin') ? 'is-invalid' : '' }}" type="text" name="kra_pin" id="kra_pin" value="{{ old('kra_pin', '') }}">
                @if($errors->has('kra_pin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kra_pin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.kra_pin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="postal_address">{{ trans('cruds.client.fields.postal_address') }}</label>
                <textarea class="form-control {{ $errors->has('postal_address') ? 'is-invalid' : '' }}" name="postal_address" id="postal_address">{{ old('postal_address') }}</textarea>
                @if($errors->has('postal_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('postal_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.postal_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email_address">{{ trans('cruds.client.fields.email_address') }}</label>
                <input class="form-control {{ $errors->has('email_address') ? 'is-invalid' : '' }}" type="email" name="email_address" id="email_address" value="{{ old('email_address') }}">
                @if($errors->has('email_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.email_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="occupation">{{ trans('cruds.client.fields.occupation') }}</label>
                <input class="form-control {{ $errors->has('occupation') ? 'is-invalid' : '' }}" type="text" name="occupation" id="occupation" value="{{ old('occupation', '') }}">
                @if($errors->has('occupation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('occupation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.occupation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_front">{{ trans('cruds.client.fields.id_front') }}</label>
                <div class="needsclick dropzone {{ $errors->has('id_front') ? 'is-invalid' : '' }}" id="id_front-dropzone">
                </div>
                @if($errors->has('id_front'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_front') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.id_front_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_back">{{ trans('cruds.client.fields.id_back') }}</label>
                <div class="needsclick dropzone {{ $errors->has('id_back') ? 'is-invalid' : '' }}" id="id_back-dropzone">
                </div>
                @if($errors->has('id_back'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_back') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.id_back_helper') }}</span>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.passportPhotoDropzone = {
    url: '{{ route('admin.clients.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="passport_photo"]').remove()
      $('form').append('<input type="hidden" name="passport_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="passport_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($client) && $client->passport_photo)
      var file = {!! json_encode($client->passport_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $client->passport_photo->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="passport_photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    Dropzone.options.idFrontDropzone = {
    url: '{{ route('admin.clients.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="id_front"]').remove()
      $('form').append('<input type="hidden" name="id_front" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="id_front"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($client) && $client->id_front)
      var file = {!! json_encode($client->id_front) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $client->id_front->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="id_front" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    Dropzone.options.idBackDropzone = {
    url: '{{ route('admin.clients.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="id_back"]').remove()
      $('form').append('<input type="hidden" name="id_back" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="id_back"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($client) && $client->id_back)
      var file = {!! json_encode($client->id_back) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $client->id_back->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="id_back" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection
