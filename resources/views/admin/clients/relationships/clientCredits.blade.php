@can('credit_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.credits.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.credit.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.credit.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-clientCredits">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.credit.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.credit.fields.client') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.credit.fields.product') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.duration') }}
                        </th>
                        <th>
                            {{ trans('cruds.credit.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.credit.fields.guarantor') }}
                        </th>
                        <th>
                            {{ trans('cruds.guarantor.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.credit.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.credit.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.credit.fields.date_issued') }}
                        </th>
                        <th>
                            {{ trans('cruds.credit.fields.total_repayment') }}
                        </th>
                        <th>
                            {{ trans('cruds.credit.fields.balance') }}
                        </th>
                        <th>
                            {{ trans('cruds.credit.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.credit.fields.mpesa_code') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($credits as $key => $credit)
                        <tr data-entry-id="{{ $credit->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $credit->id ?? '' }}
                            </td>
                            <td>
                                {{ $credit->client->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $credit->client->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $credit->product->package_name ?? '' }}
                            </td>
                            <td>
                                {{ $credit->product->amount ?? '' }}
                            </td>
                            <td>
                                {{ $credit->product->duration ?? '' }}
                            </td>
                            <td>
                                {{ $credit->amount ?? '' }}
                            </td>
                            <td>
                                {{ $credit->guarantor->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $credit->guarantor->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $credit->status ?? '' }}
                            </td>
                            <td>
                                {{ $credit->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $credit->date_issued ?? '' }}
                            </td>
                            <td>
                                {{ $credit->total_repayment ?? '' }}
                            </td>
                            <td>
                                {{ $credit->balance ?? '' }}
                            </td>
                            <td>
                                {{ $credit->location->branch_name ?? '' }}
                            </td>
                            <td>
                                {{ $credit->mpesa_code ?? '' }}
                            </td>
                            <td>
                                @can('credit_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.credits.show', $credit->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('credit_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.credits.edit', $credit->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('credit_delete')
                                    <form action="{{ route('admin.credits.destroy', $credit->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('credit_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.credits.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-clientCredits:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection