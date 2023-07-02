@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::candidates.menu_title'),
    'subtitle' => '',
    'breadcrumb' => [__('boilerplate::candidates.menu_title')],
])
@section('content')
    <div class="row">
        {{-- <div class="col-6 pb-3">
                <a href="{{ route("boilerplate.users.index") }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::users.returntolist')">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
            </div> --}}
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{ route('boilerplate.candidate.create') }}" class="btn btn-primary">
                    @lang('boilerplate::candidates.create.title')
                </a>
            </span>
        </div>
    </div>

    @component('boilerplate::card', ['title' => 'Filter By', 'reduce' => 1])
        <div class="row mt-2">
            <div class="col">
                <span class="btn-group d-block">
                    <label for="start_date">Start Date</label>
                    @component('boilerplate::datetimepicker', [
                        'id' => 'start_date',
                        'class' => 'filter_start_date',
                        'format' => 'DD-MM-Y',
                        'name' => 'start_date',
                        'value' => date('Y-m-d', strtotime('-1 month')),
                        'autocomplete' => 'off',
                    ])
                    @endcomponent
                </span>
            </div>
            <div class="col">
                <span class="btn-group d-block">
                    <label for="end_date">End Date</label>
                    @component('boilerplate::datetimepicker', [
                        'id' => 'end_date',
                        'class' => 'filter_end_date',
                        'format' => 'DD-MM-Y',
                        'name' => 'end_date',
                        'value' => now(),
                        'autocomplete' => 'off',
                    ])
                    @endcomponent
                </span>
            </div>
            <div class="col">
                <span class="btn-group">
                    <button class="btn btn-primary mt-4 btn-large btn_search_details">
                        @lang('boilerplate::dashboard.search_button_title')
                    </button>
                </span>
                {{-- <span  class="btn-group">
                <button class="btn btn-outline-dark mt-4 ml-2 btn_reset_search_details">
                    @lang('boilerplate::dashboard.reset_button_title')
                </button>
            </span> --}}
            </div>
        </div>
    @endcomponent
    @component('boilerplate::card')
        <div class="row justify-content-end mb-2">
            <button class="btn btn-primary mr-2" id="export-to-pdf">PDF</button>
            <button class="btn btn-primary" id="export-to-excel">Excel</button>

        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover va-middle" id="users-list">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>@lang('boilerplate::candidates.list.institute_name')</th>
                        <th>@lang('boilerplate::candidates.list.camp')</th>
                        <th>@lang('boilerplate::candidates.list.activity')</th>
                        <th>@lang('boilerplate::candidates.list.sr_no')</th>
                        <th>@lang('boilerplate::candidates.list.regiment_no')</th>
                        <th>@lang('boilerplate::candidates.list.name')</th>
                        <th>@lang('boilerplate::candidates.list.rank')</th>
                        <th>@lang('boilerplate::candidates.list.contact_no')</th>
                        <th>@lang('boilerplate::candidates.list.creationdate')</th>
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

            dataTableFetchRoute = '{!! route('boilerplate.candidate.dt') !!}';

            $(function() {
                showLoading();
                oTable = $('#users-list').DataTable({
                    "iDisplayLength": 50,
                    processing: true,
                    serverSide: false,
                    order: [
                        [0, "desc"]
                    ],
                    ajax: {
                        url: dataTableFetchRoute,
                        type: 'post',
                        dataSrc: function(d) {
                            closeSwalWhilePageLoaded();
                            return d.data;
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'institute',
                            name: 'institute',
                            render: function(data, row, type) {
                                console.log(data);
                                let institute_name = data.institute_name;
                                if (data.city) {
                                    institute_name += ", " + data.city
                                }
                                return institute_name
                            }
                        },
                        {
                            data: 'camp',
                            name: 'camp'
                        },
                        {
                            data: 'activity',
                            name: 'activity'
                        },
                        {
                            data: 'sr_no',
                            name: 'sr_no'
                        },
                        {
                            data: 'regiment_no',
                            name: 'regiment_no'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'rank',
                            name: 'rank'
                        },
                        {
                            data: 'contact_no',
                            name: 'contact_no'
                        },

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
                        // $('#users-list_filter').append('<button class="btn btn-default btn-sm ml-2" data-widget="control-sidebar" data-slide="true"><span class="fa fa-filter"></span></button>')
                    }
                });


                $('#filters select').on('change', function() {
                    //oTable.column(($(this).attr('name') === 'state' ? 0 : 6)).search($(this).val()).draw()
                    //console.log($(this).val());
                    oTable.column(1).search($(this).val()).draw();
                })

                //fetch data table records

                $(document).on('click', '#users-list .destroy', function(e) {
                    e.preventDefault();

                    var href = $(this).attr('href');

                    bootbox.confirm("@lang('boilerplate::candidate.list.confirmdelete')", function(result) {
                        if (result === false) return;

                        $.ajax({
                            url: href,
                            method: 'delete',
                            success: function(res) {
                                if (res.success) {
                                    oTable.ajax.reload();
                                    growl("@lang('boilerplate::candidate.list.deletesuccess')", "success");
                                } else {
                                    growl("@lang('boilerplate::candidate.list.deleteerror')", "error");
                                }
                            }
                        });
                    });
                });


                $(document).on('click', '.btn_search_details', function(e) {
                    e.preventDefault();
                    filterAnswersDataByInputs();
                });


                $('#export-to-excel').on('click', function(e) {
                    e.preventDefault()
                    console.log("generate excel");
                    generateFile('excel');
                })
                $('#export-to-pdf').on('click', function(e) {
                    e.preventDefault()
                    console.log("generate pdf");
                    generateFile('pdf');
                })
            });


            function generateFile(downloadType) {
                const tableData = oTable.data().toArray();
                const startDate = $("input[name=start_date]").val();
                const endDate = $("input[name=end_date]").val();

                $.ajax({
                    url: "{{ route('boilerplate.candidate-data-download') }}",
                    method: 'POST',
                    data: {
                        tableData: tableData,
                        downloadType: downloadType,
                        filter_start_date: startDate,
                        filter_end_date: endDate
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response) {
                        const downloadUrl = URL.createObjectURL(response);
                        if (downloadType === 'pdf') {
                            window.open(downloadUrl, '_blank');
                        } else if (downloadType === 'excel') {
                            const link = document.createElement('a');
                            link.href = downloadUrl;
                            link.download = 'user-credits-debits-history.xlsx';
                            link.click();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        if (downloadType === 'pdf') {
                            growl("Failed to generate PDF. Please try again later.", "error");
                        } else if (downloadType === 'excel') {
                            growl("Failed to generate Excel. Please try again later.", "error");
                        }
                    }
                });
            }

            function filterAnswersDataByInputs(updateNoteData = false) {
                let dataTableFetchRoute = "{{ route('boilerplate.filter-candidate.datatable') }}";
                data = {
                    filter_start_date: $("input[name=start_date]").val(),
                    filter_end_date: $("input[name=end_date]").val()
                };
                $.ajax({
                    type: 'POST',
                    url: dataTableFetchRoute,
                    data: data,
                    success: function(data) {
                        oTable.clear();
                        oTable.rows.add(data.data);
                        oTable.draw();
                    },
                    error: function(xhr) {
                        let errorMessage = '';
                        const values = Object.values(xhr.responseJSON.data);
                        for (let index = 0; index < values.length; index++) {
                            errorMessage += values[index] + "\n";
                        }
                        alertify.error(errorMessage, 'warning', 5, function() {
                            console.log('dismissed');
                        });
                    }
                });
            }
        </script>
    @endcomponent
@endpush

@push('css')
    <style>
        .img-circle {
            border: 1px solid #CCC
        }
    </style>
@endpush
