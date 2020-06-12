@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.guarantor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.guarantors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.guarantor.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guarantor.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.guarantor.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guarantor.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="idd_number">{{ trans('cruds.guarantor.fields.idd_number') }}</label>
                <input class="form-control {{ $errors->has('idd_number') ? 'is-invalid' : '' }}" type="text" name="idd_number" id="idd_number" value="{{ old('idd_number', '') }}" step="1" required>
                @if($errors->has('idd_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('idd_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guarantor.fields.idd_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.guarantor.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}" required>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guarantor.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_number">{{ trans('cruds.guarantor.fields.id_number') }}</label>
                <div class="needsclick dropzone {{ $errors->has('id_number') ? 'is-invalid' : '' }}" id="id_number-dropzone">
                </div>
                @if($errors->has('id_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guarantor.fields.id_number_helper') }}</span>
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
                <label for="address">{{ trans('cruds.guarantor.fields.address') }}</label>
                <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address"  value="{{ old('address') }}"/>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guarantor.fields.address_helper') }}</span>
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
    Dropzone.options.idNumberDropzone = {
    url: '{{ route('admin.guarantors.storeMedia') }}',
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
      $('form').find('input[name="id_number"]').remove()
      $('form').append('<input type="hidden" name="id_number" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="id_number"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($guarantor) && $guarantor->id_number)
      var file = {!! json_encode($guarantor->id_number) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $guarantor->id_number->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="id_number" value="' + file.file_name + '">')
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
