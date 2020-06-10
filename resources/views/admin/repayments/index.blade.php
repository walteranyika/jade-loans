@extends('layouts.admin')
@section('content')
@can('repayment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.repayments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.repayment.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.repayment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Repayment">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.repayment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.repayment.fields.client') }}
                        </th>
                        <th>
                            {{ trans('cruds.repayment.fields.loan') }}
                        </th>
                        <th>
                            {{ trans('cruds.repayment.fields.repayment_date') }}
                        </th>

                        <th>
                           Created On
                        </th>
                        <th>
                            {{ trans('cruds.repayment.fields.repayment_amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.repayment.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repayments as $key => $repayment)
                        <tr data-entry-id="{{ $repayment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $repayment->id ?? '' }}
                            </td>
                            <td>
                                {{ $repayment->client->first_name .' '. $repayment->client->last_name }}
                            </td>
                            <td>
                                {{ $repayment->loan->amount ?? '' }}
                            </td>
                            <td>
                                {{ $repayment->repayment_date ?? '' }}
                            </td>
                            <td>
                                {{ $repayment->created_at }}
                            </td>
                            <td>
                                {{ $repayment->repayment_amount ?? '' }}
                            </td>
                            <td>
                                {{ $repayment->user->name ?? '' }}
                            </td>
                            <td>
                                @can('repayment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.repayments.show', $repayment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('repayment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.repayments.edit', $repayment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('repayment_delete')
                                    <form action="{{ route('admin.repayments.destroy', $repayment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('repayment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.repayments.massDestroy') }}",
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
  let table = $('.datatable-Repayment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
