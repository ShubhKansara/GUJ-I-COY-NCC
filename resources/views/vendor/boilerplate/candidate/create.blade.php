@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::candidates.menu_title'),
    'subtitle' => 'Add',
    'breadcrumb' => [
        __('boilerplate::candidates.menu_title')=> 'boilerplate.candidate.index',
        'Add']]
)
@section('content')
    {{ Form::open(['route' => 'boilerplate.candidate.store', 'autocomplete' => 'off']) }}
    <div class="row">
        <div class="col-12 pb-3">
            <a href="{{ route("boilerplate.candidate.index") }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::chatbot.returntolist')">
                <span class="far fa-arrow-alt-circle-left text-muted"></span>
            </a>
            <span class="btn-group float-right">
                <button type="submit" class="btn btn-primary btn-check-and-submit">
                    @lang('boilerplate::candidates.save')
                </button>
            </span>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            @component('boilerplate::card', ['title' => 'boilerplate::candidates.create.title'])
                <div class="row">
                    <div class="col-md-12">
                        @component('boilerplate::select2', [
                            'name' => 'institute_id',
                            'label' => 'boilerplate::institutes.list.institute_name',
                        ])
                            @foreach ($institutesList as $institute)
                                <option value="{{ $institute->id }}">
                                    {{ $institute->institute_name }}{{ $institute->city ? ', ' . $institute->city : '' }}</option>
                            @endforeach
                        @endcomponent
                    </div>

                    <div class="col-md-12">
                        @component('boilerplate::input', ['name' => 'camp', 'label' => 'boilerplate::candidates.list.camp'])
                        @endcomponent
                    </div>

                    <div class="col-md-12">
                        @component('boilerplate::input', ['name' => 'activity', 'label' => 'boilerplate::candidates.list.activity'])
                        @endcomponent
                    </div>
                    <div class="col-md-12">
                        @component('boilerplate::input', ['name' => 'sr_no', 'label' => 'boilerplate::candidates.list.sr_no'])
                        @endcomponent
                    </div>
                    <div class="col-md-12">
                        @component('boilerplate::input', ['name' => 'regiment_no', 'label' => 'boilerplate::candidates.list.regiment_no'])
                        @endcomponent
                    </div>
                    <div class="col-md-12">
                        @component('boilerplate::input', ['name' => 'name', 'label' => 'boilerplate::candidates.list.name'])
                        @endcomponent
                    </div>
                    <div class="col-md-12">
                        @component('boilerplate::input', ['name' => 'rank', 'label' => 'boilerplate::candidates.list.rank'])
                        @endcomponent
                    </div>
                    <div class="col-md-12">
                        @component('boilerplate::input', ['name' => 'contact_no', 'label' => 'boilerplate::candidates.list.contact_no'])
                        @endcomponent
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
