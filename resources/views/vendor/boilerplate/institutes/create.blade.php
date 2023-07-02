@extends('boilerplate::layout.index', [
    'title' => 'Institutes',
    'subtitle' => 'Add',
    'breadcrumb' => ['Add']]
)
@section('content')
{{ Form::open(['route' => 'boilerplate.institutes.store', 'autocomplete' => 'off']) }}
<div class="row">
    <div class="col-12 pb-3">
        <a href="{{ route("boilerplate.institutes.index") }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::chatbot.returntolist')">
            <span class="far fa-arrow-alt-circle-left text-muted"></span>
        </a>
        <span class="btn-group float-right">
            <button type="submit" class="btn btn-primary btn-check-and-submit">
                @lang('boilerplate::institutes.save')
            </button>
        </span>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-6">
        @component('boilerplate::card', ['title' => 'Add Institute'])
            <div class="row">
                <div class="col-md-12">
                    @component('boilerplate::select2', ['name' => 'status', 'label' => 'boilerplate::institutes.status'])
                        <option value="1" @if (old('status', 1) == '1') selected="selected" @endif>@lang('boilerplate::institutes.active')</option>
                        <option value="0" @if (old('status') == '0') selected="selected" @endif>@lang('boilerplate::institutes.inactive')</option>

                    @endcomponent

                </div>
                <div class="col-md-12">
                    @component('boilerplate::input', ['name' => 'institute_name', 'label' => 'Instute Name'])@endcomponent
                </div>
                <div class="col-md-12">
                    @component('boilerplate::select2', ['name' => 'institute_type', 'label' => 'Instute Type'])
                        <option value="school">@lang('boilerplate::institutes.school')</option>
                        <option value="collage">@lang('boilerplate::institutes.collage')</option>
                    @endcomponent
                </div>
                <div class="col-md-12">
                    @component('boilerplate::input', ['name' => 'city', 'label' => 'City'])@endcomponent
                </div>
            </div>
        @endcomponent
    </div>
</div>
{{ Form::close() }}

@endsection
@push('js')
    <script>
        $(document).ready(function() {
            showLoading();
            closeSwalWhilePageLoaded();
        });
    </script>
@endpush
