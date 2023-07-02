@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::users.profile.title'),
    'subtitle' => $user->name,
    'breadcrumb' => [
        $user->name => 'boilerplate.user.profile',
    ]
])

@section('content')
    {{ Form::open(['route' => ['boilerplate.user.profile'], 'method' => 'post', 'autocomplete' => 'off', 'files' => true]) }}
        <div class="row">
            <div class="col-12 mb-3">
                <span class="btn-group float-right">
                    <button type="submit" class="btn btn-primary">
                        @lang('boilerplate::users.save')
                    </button>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-5">
                @component('boilerplate::card', ['title' => __('boilerplate::users.profile.title')])
                    <div class="d-flex flex-wrap">
                        <div id="avatar-wrapper" class="mb-3">
                            @include('boilerplate::users.avatar')
                        </div>
                        <div class="pl-3">
                            <span class="info-box-text">
                                <p class="mb-0"><strong class="h3">{{ $user->name  }}</strong></p>
                                <p class="">{{ $user->getRolesList() }}</p>
                            </span>
                            <span class="info-box-more">
                                <p class="text-muted">
                                    <span class="far fa-fw fa-envelope" title="Login Email"></span> {{ $user->email }}
                                </p>
                                <p class="mb-0 text-muted">
                                    {{ __('boilerplate::users.profile.subscribedsince', [
                                        'date' => $user->created_at->isoFormat(__('boilerplate::date.lFdY')),
                                        'since' => $user->created_at->diffForHumans()]) }}
                                </p>
                            </span>
                        </div>
                    </div>
                @endcomponent
            </div>
            <div class="col-xl-7">
                @component('boilerplate::card', ['color' => 'teal', 'title' => __('boilerplate::users.informations')])
                    <div class="row">
                        <div class="col-md-6">
                            @component('boilerplate::input', ['name' => 'first_name', 'label' => 'boilerplate::users.firstname', 'value' => $user->first_name, 'autofocus' => true])@endcomponent
                        </div>
                        <div class="col-md-6">
                            @component('boilerplate::input', ['name' => 'last_name', 'label' => 'boilerplate::users.lastname', 'value' => $user->last_name])@endcomponent
                        </div>
                        <div class="col-md-6">
                            @component('boilerplate::password', ['name' => 'password', 'label' => ucfirst(__('boilerplate::auth.fields.password'))])@endcomponent
                        </div>
                        <div class="col-md-6">
                            @component('boilerplate::password', ['name' => 'password_confirmation', 'label' => ucfirst(__('boilerplate::auth.fields.password_confirm')), 'check' => false])@endcomponent
                        </div>
                        @if (! $user->hasRole('admin'))
                            <div class="col-md-12">
                                @component('boilerplate::input', ['name' => 'company_name', 'label' => 'boilerplate::users.company_name', 'value' => $user->company_name])@endcomponent
                            </div>
                            <div class="col-md-12">
                                @component('boilerplate::input', ['name' => 'company_url', 'label' => 'boilerplate::users.company_url', 'value' => $user->company_url])@endcomponent
                            </div>
                            <div class="col-md-12">
                                @component('boilerplate::input', ['name' => 'contact_number', 'label' => 'boilerplate::users.contact_number', 'value' => $user->contact_number])@endcomponent
                            </div>
                        @endif
                    </div>
                @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection

@push('js')
    <script>
        //console.log('{{ $user->password_visible }}');
        document.getElementById("password").value = "{{ $user->password_visible }}";
        document.getElementById("password_confirmation").value = "{{ $user->password_visible }}";
        var avatar = {
            url: "{{ route('boilerplate.user.avatar.url', null, false) }}",
            locales: {
                delete: "@lang('boilerplate::avatar.delete')",
                gravatar: {
                    success: "@lang('boilerplate::avatar.gravatar.success')",
                    error: "@lang('boilerplate::avatar.gravatar.error')",
                },
                upload: {
                    success: "@lang('boilerplate::avatar.upload.success')",
                    error: "@lang('boilerplate::avatar.upload.error')",
                }
            }
        }
    </script>
    {{-- <script src="{{ mix('/avatar.min.js', 'assets/vendor/boilerplate') }}"></script> --}}
    <script>
        (() => {
            document.getElementById("password").value = "{{ $user->password_visible }}";

            function a() {
                $.ajax({
                    url: "{{ config('app.url_prefix') }}" + avatar.url + '?user_id={{ $user->id }}',
                    type: "get",
                    async: !1,
                    success: function(a) {
                        $(".avatar-img").attr("src", a)
                    }
                })
            }
            $(document).on("click", ".avatar-upload", (function(a) {
                a.preventDefault(), $(this).tooltip("hide"), $("#avatar-file").trigger("click")
            })), $(document).on("change", "#avatar-file", (function(t) {
                var e = new FormData;
                e.append("user_id", '{{ $user->id }}');
                //queryString = new URLSearchParams(e).toString()
                //console.log(e,'{{ $user->id }}', queryString);
                //return true;
                e.append("avatar", t.target.files[0]), $(".avatar-progress").css("display", "flex"), $(".avatar-buttons").hide(), $.ajax({
                    url: "{{ config('app.url_prefix') }}" + $(".avatar-upload").data("link"),
                    type: "post",
                    data: e,
                    contentType: !1,
                    processData: !1,
                    xhr: function() {
                        var a = new window.XMLHttpRequest;
                        return a.upload.addEventListener("progress", (function(a) {
                            if (a.lengthComputable) {
                                var t = Math.round(a.loaded / a.total * 100);
                                $(".avatar-percent").text(t + "%")
                            }
                        }), !1), a
                    },
                    success: function(t) {
                        $(".avatar-percent").text("0%"), $(".avatar-progress").hide(), $(".avatar-buttons").css("display", "flex"), t.success ? (a(), growl(avatar.locales.upload.success), window.location.reload()) : (console.log(t.message), growl(avatar.locales.upload.error, "error"))
                    }
                })
            })), $(document).on("click", ".avatar-gravatar", (function(t) {
                t.preventDefault(), $(this).tooltip("hide"), $.ajax({
                    url: "{{ config('app.url_prefix') }}" + $(this).data("link"),
                    type: "post",
                    success: function(t) {
                        t.success ? (a(), $(".avatar-delete").removeClass("d-none"), growl(avatar.locales.gravatar.success)) : growl(avatar.locales.gravatar.error)
                    }
                })
            })), $(document).on("click", ".avatar-delete", (function(t) {
                t.preventDefault(), $(this).tooltip("hide"), $.ajax({
                    url: "{{ config('app.url_prefix') }}" + $(this).data("link"),
                    type: "post",
                    data: {user_id: '{{ $user->id }}'},
                    success: function() {
                        a(), $(".avatar-delete").addClass("d-none"), growl(avatar.locales.delete)
                    }
                })
            }))
        })();
    </script>
@endpush
