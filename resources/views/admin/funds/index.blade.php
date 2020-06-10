@extends('layouts.admin')
@section('content')
@can('fund_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.funds.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.fund.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.fund.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Fund">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.fund.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.fund.fields.asset_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.fund.fields.asset_category') }}
                        </th>
                        <th>
                            {{ trans('cruds.fund.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.fund.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.fund.fields.made_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.fund.fields.date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($funds as $key => $fund)
                        <tr data-entry-id="{{ $fund->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $fund->id ?? '' }}
                            </td>
                            <td>
                                {{ $fund->asset_name ?? '' }}
                            </td>
                            <td>
                                {{ $fund->asset_category ?? '' }}
                            </td>
                            <td>
                                {{ $fund->amount ?? '' }}
                            </td>
                            <td>
                                {{ App\Fund::TYPE_RADIO[$fund->type] ?? '' }}
                            </td>
                            <td>
                                {{ App\Fund::MADE_BY_RADIO[$fund->made_by] ?? '' }}
                            </td>
                            <td>
                                {{ $fund->date ?? '' }}
                            </td>
                            <td>
                                @can('fund_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.funds.show', $fund->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('fund_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.funds.edit', $fund->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('fund_delete')
                                    <form action="{{ route('admin.funds.destroy', $fund->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('fund_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.funds.massDestroy') }}",
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
  let table = $('.datatable-Fund:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection