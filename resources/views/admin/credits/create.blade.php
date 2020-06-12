@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.credit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.credits.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.credit.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as  $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->id_number.' | '.$client->first_name.' '.$client->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.client_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.credit.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }} product_select" name="product_id" id="product_id" required>
                    <option>Select A Loan Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->package_name.' | KES'.$product->amount.' | For '.$product->duration.' Days' }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.product_helper') }}</span>

                <div class="items">
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <p><b class="item-package-name"></b></p>
                            <p><b class="item-amount"></b></p>
                            <p><b class="item-deposit"></b></p>
                            <p><b class="item-duration"></b></p>
                        </div>
                    </div>

                </div>

            </div>


            <div class="form-group">
                <label class="required" for="guarantor_id">{{ trans('cruds.credit.fields.guarantor') }}</label>
                <select class="form-control select2 {{ $errors->has('guarantor') ? 'is-invalid' : '' }}" name="guarantor_id" id="guarantor_id" required>
                    @foreach($guarantors as  $guarantor)
                        <option value="{{ $guarantor->id }}" {{ old('guarantor_id') == $guarantor->id ? 'selected' : '' }}>{{ 'ID '.$guarantor->idd_number.' | '.$guarantor->first_name.' '. $guarantor->last_name}}</option>
                    @endforeach
                </select>
                @if($errors->has('guarantor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guarantor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.guarantor_helper') }}</span>
            </div>


            <div class="form-group">
                <label class="required" for="date_issued">{{ trans('cruds.credit.fields.date_issued') }}</label>
                <input class="form-control  date {{ $errors->has('date_issued') ? 'is-invalid' : '' }}" type="text"  name="date_issued" id="date_issued" value="{{ old('date_issued') }}" required>
                @if($errors->has('date_issued'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_issued') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.date_issued_helper') }}</span>

                <br>
                <p class="end_date"></p>
            </div>



            <div class="form-group">
                <label for="mpesa_code">{{ trans('cruds.credit.fields.mpesa_code') }}</label>
                <input class="form-control {{ $errors->has('mpesa_code') ? 'is-invalid' : '' }}" type="text" name="mpesa_code" id="mpesa_code" value="{{ old('mpesa_code', '') }}">
                @if($errors->has('mpesa_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mpesa_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.credit.fields.mpesa_code_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        $('.items').hide();
        $('.product_select').on('change', function() {
            $('.items').hide();
            if(!isNaN(this.value)){
                $.ajax({
                    url: 'http://66.228.55.80:7777/api/product/'+ this.value, //this is your uri
                    type: 'GET', //this is your method
                    success: function(response){
                        console.log(response)
                        $('.item-package-name').text("Loan Package "+response.package_name)
                        $('.item-amount').text("Loan Amount "+response.amount)
                        $('.item-deposit').text("Deposit Amount "+response.deposit)
                        $('.item-duration').text("Duration "+response.duration)
                        $('.items').show();
                    }
                });
            }
        });
        //date
        $("#date_issued").on("focusout", function(){
            // Print entered value in a div box
            var start_date=$(this).val();
            var loan_id = $('.product_select').val();

            $.ajax({
                url: 'http://66.228.55.80:7777/api/dates',
                type: 'POST',
                data: {date: start_date, loan_id: loan_id},
                success: function (result) {
                    $('.end_date').text("End Date "+result)
                }
            });

        });

    });
</script>

@endsection
