@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fas fa-shopping-cart"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary pull-right">Добавить заказ</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Дата создания </th>
                            <th> Имя </th>
                            <th> Телефон </th>
                            <th class="text-center"> Сумма </th>
                            <th class="text-center"> Статус </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->created_at }}</td>
                                <td>{{ $record->first_name }}</td>
                                <td>{{ $record->phone }}</td>

                                <td>{{ $record->sum }} {{ config('settings.currency_symbol') }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $record->payment_status->id == 1 ? 'badge-success' : 'badge-danger' }} ">
                                        {{ $record->payment_status->name }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('admin.orders.edit', $record->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('admin.orders.delete', $record->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable({
            ordering: false,
            language: {
                url: '{{ asset('/backend/js/plugins/dataTables/localizations/Russian.json') }}'
            }
        });
    </script>
@endpush
