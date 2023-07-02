@extends('boilerplate::auth.layout', ['title' => __('boilerplate::auth.password_reset.title')])

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
                <p class="login-box-msg text-sm"> Jatin @lang('boilerplate::auth.password_reset.intro')</p>
                {!! Form::open(['route' => 'boilerplate.password.reset.post', 'method' => 'post', 'autocomplete'=> 'off']) !!}
                    {!! Form::hidden('token', $token) !!}
                    @component('boilerplate::input', ['label' => 'boilerplate::users.email_address','name' => 'email', 'placeholder' => 'boilerplate::users.email_address_place_holder','type' => 'email', 'value' => $email, 'autofocus' => true])@endcomponent
                    @component('boilerplate::password', ['label' => 'Password', 'name' => 'password', 'placeholder' => 'boilerplate::auth.fields.password'])@endcomponent
                    @component('boilerplate::password', ['label' => 'Password Confirmation', 'name' => 'password_confirmation', 'placeholder' => 'boilerplate::auth.fields.password_confirm', 'check' => false])@endcomponent
                    <div class="row">
                        <div class="col-12 text-center">
                            <button class="btn btn-primary btn-block mt-4" type="submit">@lang('boilerplate::auth.password_reset.submit')</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
        <div class="col-md-6 justify-content-center d-inline-table">
            <div class="d-inline-table text-left main-box-left-padding">
                <iframe class="chatbot_iframe" src='https://eva.extrahourz.com/widget/landing%20page' height='550px' width='500px' frameborder=0></iframe>
            </div>
        </div>
    </div>
@endsection
