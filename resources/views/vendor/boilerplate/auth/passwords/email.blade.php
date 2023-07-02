@extends('boilerplate::auth.layout', ['title' => __('boilerplate::auth.password.title'), 'bodyClass' => 'hold-transition login-page'])

@section('content')
    <style>
        .login-page{background: white;}
        .card{box-shadow: unset;}
        .card .card-body{padding: 0;}
        .main-box-right-padding{padding-right:50px;}
        .main-box-left-padding{padding-left:50px;}
        .d-inline-table{
            display: inline-table;
        }
        .v-center {
            height: 100vh;
            display: flex;
            align-items: center;
            padding: 35px;
            justify-content: center;
            width: 100%;
        }
        .login-box, .register-box{
            width: 85%;
            max-width: 500px;
            display: inline-table;
            text-align: left;
        }
        label:not(.form-check-label):not(.custom-file-label){margin-bottom: 8px;}
        @media(min-width: 1200px){
            .v-center{
                width: 100%;
            }
        }
        @media only screen and (min-device-width: 786px) and (max-device-width: 1200px) {
            .chatbot_iframe{
                width: 400px;
            }
        }
        @media(max-width: 786px){
            .login-box, .register-box{width: 100%!important;display:inline-table;text-align: left;}
            .v-center{padding: 30px;}
            .v-center .col-md-6:first-child{text-align: center;}
            .login-box .col-sm-9{flex: 0 0 75%;max-width: 75%}
            .login-box .col-sm-3{flex: 0 0 25%;max-width: 25%}
            .main-box-left-padding{padding-left: 0px;}
            .main-box-right-padding{padding-right: 0px;}
            .chatbot_iframe{
                width: 100%;
                margin-top: 50px;
            }
        }
    </style>

    <div class="row v-center">
        <div class="col-md-6 justify-content-center d-inline-table text-right">
            @component('boilerplate::auth.loginbox')
                <p class="login-box-msg text-sm text-left pl-0 mt-3">@lang('boilerplate::auth.password.intro')</p>
                @if (session('status'))
                    <div class="alert alert-success d-flex align-items-center">
                        <span class="far fa-check-circle fa-3x mr-3"></span>
                        {{ session('status') }}
                    </div>
                @else
                    {!! Form::open(['route' => 'boilerplate.password.email', 'method' => 'post', 'autocomplete'=> 'off']) !!}
                        @component('boilerplate::input', ['label' => "boilerplate::users.email_address", 'name' => 'email', 'placeholder' => 'boilerplate::users.email_address_place_holder', 'type' => 'email', 'autofocus' => true])@endcomponent
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary btn-block mt-4">@lang('boilerplate::auth.password.submit')</button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                @endif
                <p class="mb-0 text-sm">
                    <a href="{{ route('boilerplate.login') }}">@lang('boilerplate::auth.password.login_link')</a>
                </p>
                @if(config('boilerplate.auth.register'))
                    <p class="mb-0 text-sm">
                        <a href="{{ route('boilerplate.register') }}" class="text-center">@lang('boilerplate::auth.login.register')</a>
                    </p>
                @endif
            @endcomponent
        </div>
        <div class="col-md-6 justify-content-center text-center  d-inline-table">
            <div class="d-inline-table text-left main-box-left-padding">
                <iframe class="chatbot_iframe" src='https://eva.extrahourz.com/widget/landing%20page' height='550px' width='500px' frameborder=0></iframe>
            </div>
        </div>
    </div>

@endsection
