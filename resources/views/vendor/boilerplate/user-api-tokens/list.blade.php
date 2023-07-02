@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::userapitoken.title'),
    'subtitle' => __('boilerplate::userapitoken.list.title'),
    'breadcrumb' => [
        __('boilerplate::userapitoken.title') => 'boilerplate.user-api-tokens.index'
    ]
])

@section('right-sidebar')
    <div id="filters">
        {{-- <div class="form-group">
            <select name="role" class="form-control select2" data-placeholder="@lang('boilerplate::role.role')">
                <option></option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                @endforeach
            </select>
        </div> --}}
    </div>
@endsection

@section('content')
    <div class="row">
        {{-- <div class="col-6 pb-3">
                <a href="{{ route("boilerplate.users.index") }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::users.returntolist')">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
            </div> --}}
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{ route("boilerplate.user-api-tokens.create") }}" class="btn btn-primary">
                    @lang('boilerplate::userapitoken.create.title')
                </a>
            </span>
        </div>
    </div>
    @component('boilerplate::card')
        <div class="table-responsive">
            <table class="table table-striped table-hover va-middle" id="users-list">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>@lang('boilerplate::userapitoken.list.name')</th>
                        <th>@lang('boilerplate::userapitoken.list.token')</th>
                        <th>@lang('boilerplate::userapitoken.list.creationdate')</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endcomponent
@endsection

@include('boilerplate::load.datatables')

@push('js')
@component('boilerplate::minify')
    <script>
        var oTable;

        dataTableFetchRoute = '{!! route("boilerplate.userAPITokens.datatable") !!}';

        $(function () {
            oTable = $('#users-list').DataTable({
                "iDisplayLength": 50,
                processing: true,
                serverSide: false,
                order: [[0, "desc"]],
                ajax: {
                    url: dataTableFetchRoute,
                    type: 'post',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'token', name: 'token'},
                    {
                        data: 'created_at',
                        name: 'chatbot.created_at',
                        searchable: false,
                        /* render: $.fn.dataTable.render.moment('@lang('boilerplate::date.YmdHis')') */
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        width: '80px',
                        class: 'text-nowrap'
                    },
                ],
                fnInitComplete: function() {
                    $('#users-list_filter').append('<button class="btn btn-default btn-sm ml-2" data-widget="control-sidebar" data-slide="true"><span class="fa fa-filter"></span></button>')
                }
            });


            $('#filters select').on('change', function() {
                //oTable.column(($(this).attr('name') === 'state' ? 0 : 6)).search($(this).val()).draw()
                //console.log($(this).val());
                oTable.column(1).search($(this).val()).draw();
            })

            //fetch data table records

            $(document).on('click', '#users-list .destroy', function (e) {
                e.preventDefault();

                var href = $(this).attr('href');

                bootbox.confirm("@lang('boilerplate::userapitoken.list.confirmdelete')", function (result) {
                    if (result === false) return;

                    $.ajax({
                        url: href,
                        method: 'delete',
                        success: function (res) {
                            if(res.success) {
                                oTable.ajax.reload();
                                growl("@lang('boilerplate::userapitoken.list.deletesuccess')", "success");
                            } else {
                                growl("@lang('boilerplate::userapitoken.list.deleteerror')", "error");
                            }
                        }
                    });
                });
            });

        });
    </script>
@endcomponent
@endpush

@push('css')
    <style>.img-circle { border:1px solid #CCC }</style>
@endpush
