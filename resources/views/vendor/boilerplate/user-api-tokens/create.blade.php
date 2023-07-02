@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::userapitoken.title'),
    'subtitle' => __('boilerplate::userapitoken.create.title'),
    'breadcrumb' => [
        __('boilerplate::userapitoken.title') => 'boilerplate.user-api-tokens.index',
        __('boilerplate::userapitoken.create.title')
    ]
])

@section('content')
    <style>
        .custom-card-label{display: inline;}
        .tempaltes_selection_list .card-body{padding:0.75rem}
        .slider{height:30px;width:60px;position:absolute;cursor:pointer;top:0;left:5px;right:0;bottom:0;background-color:#ccc;-webkit-transition:.4s;transition:.4s}
        .slider:before{position:absolute;content:"";height:26px;width:26px;left:2px;bottom:4px;background-color:#fff;-webkit-transition:.4s;transition:.4s;top:2px;}
        input:checked + .slider{background-color:#2196F3}
        input:focus + .slider{box-shadow:0 0 1px #2196F3}
        input:checked + .slider:before{-webkit-transform:translateX(30px);-ms-transform:translateX(30px);transform:translateX(30px)}
        .slider.round{border-radius:34px}
        .slider.round:before{border-radius:50%}
    </style>
    {{ Form::open(['route' => 'boilerplate.user-api-tokens.store', 'autocomplete' => 'off']) }}
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("boilerplate.user-api-tokens.index") }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::chatbot.returntolist')">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                <span class="btn-group float-right">
                    <button type="submit" class="btn btn-primary btn-check-and-submit">
                        @lang('boilerplate::userapitoken.save')
                    </button>
                </span>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                @component('boilerplate::card', ['title' => 'boilerplate::userapitoken.create.page_title'])
                    <div class="row">
                        <div class="col-md-12">
                            @component('boilerplate::input', ['name' => 'name', 'label' => 'boilerplate::userapitoken.create.token_name'])@endcomponent
                        </div>
                    </div>
                @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection

@push('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
@endpush
@push('js')
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
@endpush
