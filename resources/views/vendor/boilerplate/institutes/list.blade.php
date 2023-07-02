@extends('boilerplate::layout.index', [
    'title' => 'Institutes',
    'subtitle' => 'List',
    'breadcrumb' => ['List']]
)
@section('content')
    <div class="row">
        {{-- <div class="col-6 pb-3">
                <a href="{{ route("boilerplate.users.index") }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::users.returntolist')">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
            </div> --}}
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{ route("boilerplate.institutes.create") }}" class="btn btn-primary">
                    @lang('boilerplate::institutes.create.title')
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
                        <th>@lang('boilerplate::institutes.list.institute_name')</th>
                        <th>@lang('boilerplate::institutes.list.institute_type')</th>
                        <th>@lang('boilerplate::institutes.list.city')</th>
                        <th>@lang('boilerplate::institutes.list.creationdate')</th>
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

        dataTableFetchRoute = '{!! route("boilerplate.institutes.dt") !!}';

        $(function () {
            showLoading();

            oTable = $('#users-list').DataTable({
                "iDisplayLength": 50,
                processing: true,
                serverSide: false,
                order: [[0, "desc"]],
                ajax: {
                    url: dataTableFetchRoute,
                    type: 'post',
                    dataSrc: function(d){
                        closeSwalWhilePageLoaded();
                        return d.data;
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'institute_name', name: 'institute_name'},
                    {data: 'institute_type', name: 'institute_type'},
                    {data: 'city', name: 'city'},

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

                bootbox.confirm("@lang('boilerplate::institutes.list.confirmdelete')", function (result) {
                    if (result === false) return;

                    $.ajax({
                        url: href,
                        method: 'delete',
                        success: function (res) {
                            if(res.success) {
                                oTable.ajax.reload();
                                growl("@lang('boilerplate::institutes.list.deletesuccess')", "success");
                            } else {
                                growl("@lang('boilerplate::institutes.list.deleteerror')", "error");
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
