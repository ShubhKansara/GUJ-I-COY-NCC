@extends('add_candidate.index', [
    'title' => __('boilerplate::auth.login.title'),
    'bodyClass' => 'hold-transition login-page',
])
@section('front_content')
    {{ Form::open(['route' => 'add_candidate', 'autocomplete' => 'off']) }}

    <div class="row justify-content-center">
        <div class="col-md-6">
            @component('boilerplate::card', ['title' => 'boilerplate::candidates.create.title'])
                <div class="row">
                    <div class="col-md-12">
                        @component('boilerplate::select2', [
                            'name' => 'institute_id',
                            'label' => 'boilerplate::institutes.list.institute_name',
                        ])
                            @foreach ($institutes as $institute)
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

            <button type="submit" class="btn btn-primary btn-check-and-submit">
                @lang('boilerplate::candidates.save')
            </button>
        </div>
    </div>
    {{ Form::close() }}
@endsection
