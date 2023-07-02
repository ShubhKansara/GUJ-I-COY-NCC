@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::layout.dashboard'),
    'subtitle' => '',
    'breadcrumb' => ['Dashboard'],
])
@section('content')

<div class="row">

    <div class="col-sm-12 col-lg-3">
        @component('boilerplate::smallbox', ['color' => 'green','nb'=> $candidates, 'text' => 'Candidates', 'icon' => 'fas fa-users', 'link' => route('boilerplate.candidate.create'), 'link-text' => 'Add New Candidate']) @endcomponent
    </div>
    <div class="col-sm-12 col-lg-3">
        @component('boilerplate::smallbox', ['color' => 'indigo','nb'=> $institutes,  'text' => 'Institutes', 'icon' => 'fas fa-university', 'link' => route('boilerplate.institutes.create'),'link-text' => 'Add New Institute']) @endcomponent
    </div>

</div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            showLoading();
            closeSwalWhilePageLoaded();
        });
    </script>
@endpush


