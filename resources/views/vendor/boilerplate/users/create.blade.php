@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::users.title'),
    'subtitle' => __('boilerplate::users.create.title'),
    'breadcrumb' => [
        __('boilerplate::users.title') => 'boilerplate.users.index',
        __('boilerplate::users.create.title')
    ]
])

@section('content')
    {{ Form::open(['route' => 'boilerplate.users.store', 'autocomplete' => 'off']) }}
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("boilerplate.users.index") }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::users.returntolist')">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                <span class="btn-group float-right">
                    <button type="submit" class="btn btn-primary">
                        @lang('boilerplate::users.save')
                    </button>
                </span>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @component('boilerplate::card', ['title' => 'boilerplate::users.informations'])
                    @component('boilerplate::select2', ['name' => 'active', 'label' => 'boilerplate::users.status', 'minimum-results-for-search' => '-1'])
                        <option value="1" @if (old('active', 1) == '1') selected="selected" @endif>@lang('boilerplate::users.active')</option>
                        <option value="0" @if (old('active') == '0') selected="selected" @endif>@lang('boilerplate::users.inactive')</option>
                    @endcomponent
                    <div class="row">
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            @component('boilerplate::input', ['name' => 'first_name', 'label' => 'boilerplate::users.firstname', 'autofocus' => true])@endcomponent
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            @component('boilerplate::input', ['name' => 'last_name', 'label' => 'boilerplate::users.lastname'])@endcomponent
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @component('boilerplate::input', ['name' => 'company_name', 'label' => 'boilerplate::users.company_name'])@endcomponent
                        </div>
                        <div class="col-md-12">
                            @component('boilerplate::input', ['name' => 'company_url', 'label' => 'boilerplate::users.company_url'])@endcomponent
                        </div>
                    </div>
                    @component('boilerplate::input', ['name' => 'email', 'label' => 'boilerplate::users.email'])@endcomponent
                    <div class="row">
                        <div class="col-md-12">
                            @component('boilerplate::input', ['name' => 'contact_number', 'label' => 'boilerplate::users.contact_number'])@endcomponent
                        </div>
                        <div class="col-md-12">
                            @component('boilerplate::password', ['name' => 'password', 'label' => ucfirst(__('boilerplate::auth.fields.password'))])@endcomponent
                        </div>
                    </div>
                @endcomponent
            </div>
            <div class="col-lg-6">
                @component('boilerplate::card', ['color' => 'teal', 'title' => 'boilerplate::users.roles'])
                    <table class="table table-sm table-hover">
                        @foreach($roles as $role)
                            <tr>
                                <td style="width:25px">
                                    @if ($role->id == 4)
                                        @component('boilerplate::icheck', ['name' => 'roles['.$role->id.']', 'id' => 'role_'.$role->id, 'checked' => old('roles.'.$role->id) == 'on', 'checked' => true])@endcomponent
                                    @else
                                        @component('boilerplate::icheck', ['name' => 'roles['.$role->id.']', 'id' => 'role_'.$role->id, 'checked' => old('roles.'.$role->id) == 'on'])@endcomponent
                                    @endif
                                </td>
                                <td>
                                    {{ Form::label('role_'.$role->id, $role->display_name, ['class' => 'mb-0 pb-0']) }}<br />
                                    <span class="small">{{ $role->description }}</span><br />
                                    <span class="small text-muted">{{ $role->permissions->implode('display_name', ', ') }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection

@push('js')
    <script>
        $('.password .input-group-append button').click();
    </script>
@endpush
