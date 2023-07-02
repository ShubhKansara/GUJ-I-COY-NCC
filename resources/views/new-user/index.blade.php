@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::newUser.title'),
    'subtitle' => __('boilerplate::newUser.create.title'),
    'breadcrumb' => [
        __('boilerplate::newUser.title') => 'boilerplate.newUsers.index',
        __('boilerplate::newUser.create.title')
    ]
])

@section('content')
    {{ Form::open(['route' => 'boilerplate.newUsers.store', 'autocomplete' => 'off']) }}
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route('boilerplate.newUsers.index') }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::newUser.returntolist')">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                <span class="btn-group float-right">
                    <button type="submit" class="btn btn-primary">
                        @lang('boilerplate::newUser.save')
                    </button>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                @component('boilerplate::card', ['title' => 'boilerplate::newUser.informations'])
                    @component('boilerplate::select2', ['name' => 'active', 'label' => 'boilerplate::newUser.status', 'minimum-results-for-search' => '-1'])
                        <option value="1" @if (old('active', 1) == '1') selected="selected" @endif>@lang('boilerplate::newUser.active')</option>
                        <option value="0" @if (old('active') == '0') selected="selected" @endif>@lang('boilerplate::newUser.inactive')</option>
                    @endcomponent
                    <div class="row">
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            @component('boilerplate::input', ['name' => 'first_name', 'label' => 'boilerplate::newUser.firstname', 'autofocus' => true])@endcomponent
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            @component('boilerplate::input', ['name' => 'last_name', 'label' => 'boilerplate::newUser.lastname'])@endcomponent
                        </div>
                    </div>
                    @component('boilerplate::input', ['name' => 'email', 'label' => 'boilerplate::newUser.email', 'help' => 'boilerplate::newUser.create.help'])@endcomponent
                @endcomponent
            </div>
            <div class="col-lg-6">
                @component('boilerplate::card', ['color' => 'teal', 'title' => 'boilerplate::newUser.roles'])
                    <table class="table table-sm table-hover">
                        @foreach($roles as $role)
                            <tr>
                                <td style="width:25px">
                                    @component('boilerplate::icheck', ['name' => 'roles['.$role->id.']', 'id' => 'role_'.$role->id, 'checked' => old('roles.'.$role->id) == 'on'])@endcomponent
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