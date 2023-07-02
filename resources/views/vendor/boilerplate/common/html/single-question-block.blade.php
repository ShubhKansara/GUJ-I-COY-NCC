@php
    $is_show_error_box = true;
    $is_show_response_message = true;
    $is_show_choice_options_box = false;
    $is_show_multichoice_options_box = false;
    $is_show_parent_column_box = true;
    $is_zipcode_question_box = false;
    $is_file_type_question_box = false;

    if($question->question_type_id == $choiceQuestionIndex || $question->question_type_id == $multiChoiceQuestionIndex || $question->question_type_id == $questionTypesIdsArray['number']){
        $is_show_error_box = false;
        $is_show_response_message = false;
    }

    if ($question->question_type_id == $choiceQuestionIndex) {
        $is_show_parent_column_box = false;
        $is_show_choice_options_box = true;
        $is_show_multichoice_options_box = false;
    }

    if ($question->question_type_id == $multiChoiceQuestionIndex) {
        $is_show_choice_options_box = false;
        $is_show_multichoice_options_box = true;
    }
    if($question->question_type_id == $questionTypesIdsArray['zip']){
        $is_zipcode_question_box = true;
    }
    if($question->question_type_id == $questionTypesIdsArray['file']){
        $is_file_type_question_box = true;
    }

    if($question->question_type_id == $questionTypesIdsArray['number']){
        $is_show_parent_column_box = false;
        $is_show_multichoice_options_box = false;
        $is_show_choice_options_box = true;
        $is_show_error_box = true;
        $is_show_multichoice_options_box = false;
    }
@endphp
<li class="main_que_list_box user_question_card_box user_generated_question li_que_{{ $question->id }}" data-que-id="{{ $question->id }}" data-mode="default" data-create-mode="{{ $question->create_mode }}" data-question-type-id="{{ $question->question_type_id }}" data-text="{{ $question->question_text }}" data-error-message="{{ $question->error_message }}" data-response-text="{{ $question->response_text }}" data-regex="{{ $question->regular_expression }}">
    @component('boilerplate::card', ['title' => '<span class="question-badge mr-2">' . $question->type->question_type_name . '</span>' . ( (isset($question->is_critical) && $question->is_critical == 1) ? '<span class="question-badge question-badge-danger mr-2">Critical</span>' : '') . ( (isset($question->is_neutral) && $question->is_neutral == 1) ? '<span class="question-badge question-badge-info mr-2">Neutral</span>' : '') .$question->column_name, 'class' => 'mt-3 pt-0', 'reduce' => 1, "collapsed" => 1])
        <div class="row view_q_box">
            <div class="col-sm-8">
            </div>
            <div class="col-md-4 @if( isset($isRegistrationTemplate) && $isRegistrationTemplate == 1) d-none  @endif">
                <button class="btn btn-sm btn-danger ml-2 float-right button_delete_question" data-question-id="{{ $question->id }}" type="button"><i class="fa fa-fw fa-trash"></i></button>
                {{-- <button class="btn btn-sm btn-primary ml-2 float-right button_edit_question"  data-question-id="{{ $question->id }}" type="button"><i class="fa fa-fw fa-pencil-alt"></i></button> --}}
            </div>
        </div>
        <div class="row mt-2 mr-0 edit_q_box">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 mt-3">
                        @component('boilerplate::select2', ['name' => 'edit_question_type_id', 'class' => 'edit_question_type_id',
                            'label' => 'boilerplate::chatbot.create_question_type', 'minimum-results-for-search' => '-1'])
                            @foreach ($questionTypes as $indx => $type)
                                @php
                                    if(!in_array($type->key_name, array('text', 'choice', 'multi_choice', 'number', 'zip', 'file')) ){
                                        continue;
                                    }
                                @endphp
                                <option value="{{ $type->id }}" @if($type->id == $question->question_type_id) selected @endif  > {{ $type->question_type_name }}</option>
                            @endforeach
                        @endcomponent
                    </div>
                    <div class="mt-3 col-md-6 edit_critical_box">
                        <div class="row">
                            <div class="col">
                                <label for="edit_is_critical">@lang('boilerplate::chatbot.edit.critical_headertitle')</label><br/>
                                    <label class="switch mt-1">
                                    <input type="checkbox" name="edit_is_critical" class="edit_is_critical" @if($question->is_critical == 1) checked  @endif>
                                    <span class="slider round"></span>
                                    </label>
                            </div>
                            <div class="col">
                                <label for="edit_is_neutral">@lang('boilerplate::chatbot.edit.neutral_headertitle')</label><br/>
                                    <label class="switch mt-1">
                                    <input type="checkbox" name="edit_is_neutral" class="edit_is_neutral" @if($question->is_neutral == 1) checked  @endif>
                                    <span class="slider round"></span>
                                    </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 col-md-6 edit_delete_box @if( isset($isRegistrationTemplate) && $isRegistrationTemplate == 0) d-none  @endif">
                        <div class="row">
                            <div class="col text-right">
                                <button class="btn btn-sm btn-danger ml-2 float-right button_delete_question" data-question-id="{{ $question->id }}" type="button"><i class="fa fa-fw fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 col-md-6 edit_question_text_box">
                        <label for="edit_question_text">Enter Your Question Here*</label>
                        <textarea class="form-control edit_question_text" rows="3" cols="40" placeholder="Enter Your Question Here" name="edit_question_text">{{ $question->question_text }}</textarea>
                        <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_help_placeholder')</small>
                    </div>
                    <div class="mt-3 col-md-6 edit_question_error_message_box @if($is_show_error_box == false) d-none @endif">
                        <label for="edit_question_error_message">Question Error Message</label>
                        <textarea id="edit_question_error_message" class="form-control edit_question_error_message" rows="3" cols="40" name="edit_question_error_message">{{ $question->error_message }}</textarea>
                        <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_error_message')</small>
                    </div>
                    <div class="mt-3 col-md-6 edit_question_regex_box d-none">
                        <label for="edit_question_regex">Question Validation Regex</label>
                        <textarea id="edit_question_regex" class="form-control edit_question_regex" rows="3" cols="40" name="edit_question_regex">{{ $question->regular_expression }}</textarea>
                        <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_regular_expression')</small>
                    </div>
                    <div class="mt-3 col-md-6 edit_question_response_text_box @if($is_show_response_message == false) d-none @endif">
                        <label for="edit_question_response_text">Response Text</label>
                        <textarea id="edit_question_response_text" class="form-control edit_question_response_text" rows="3" cols="40" name="edit_question_response_text">{{ $question->response_text }}</textarea>
                        <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_response_text')</small>
                    </div>
                    <div class="mt-3 col-md-6 edit_column_name_box">
                        <label for="edit_column_name">Column Name*</label>
                        <textarea id="edit_column_name" placeholder="@lang('boilerplate::chatbot.edit.column_name_placeholder')" class="form-control edit_column_name" rows="3" cols="40" name="edit_column_name">{{ $question->column_name }}</textarea>
                        <small class="form-text text-muted">@lang('boilerplate::chatbot.column_question_input_help')</small>
                    </div>
                    <div class="mt-3 col-md-6 edit_zip_code_box @if($is_zipcode_question_box == false) d-none @endif">
                        @component('boilerplate::input', ['name' => 'edit_zip_code','class' => 'edit_zip_code', 'type' => 'number', 'label' => 'boilerplate::chatbot.zip_code', 'help' => 'boilerplate::chatbot.zip_code_help', 'value' => $question->zip_code])@endcomponent
                    </div>
                    <div class="mt-3 col-md-6 edit_distance_box @if($is_zipcode_question_box == false) d-none @endif">
                        @component('boilerplate::input', ['name' => 'edit_distance', 'class' => 'edit_distance','type' => 'number', 'label' => 'boilerplate::chatbot.distance',  'help' => 'boilerplate::chatbot.distance_help','value' =>  $question->distance])@endcomponent
                    </div>
                     <div class="mt-3 col-md-6 edit_file_extentions_box @if($is_file_type_question_box == false) d-none @endif">
                        @component('boilerplate::input', ['name' => 'edit_file_extetions', 'class' => 'edit_file_extetions','type' => 'text', 'label' => 'boilerplate::chatbot.file_extentions',  'help' => 'boilerplate::chatbot.file_extentions_help','value' => $question->file_extentions . ''])@endcomponent
                    </div>
                    <div class="mt-4 col-md-12 edit_choice_input_box @if($is_show_choice_options_box == false) d-none @endif">
                        <label for="new_question_choice_text">@lang('boilerplate::chatbot.edit.choice_options')
                            <button class="btn btn-sm btn-primary ml-2 edit-add-more-choice-button btn-add-more-answer-box"  data-question-type="{{ ($question->question_type_id == $questionTypesIdsArray['choice']) ? 'choice' : 'number'}}" data-container-class="li_que_{{ $question->id }}" data-choice-class="user_choice_answer" type="button"><i class="fa fa-fw fa-plus"></i></button>
                        </label>
                        <div class="edit_number_options_label_box @if($question->question_type_id == $questionTypesIdsArray['choice']) d-none @endif">
                            <small>@lang('boilerplate::chatbot.edit.number_options_help_title')</small>
                        </div>
                        <div class="mt-3">
                            <ul class="choice_answers_list pl-0" style="list-style-type: none;">
                                <li class="header_row mt-3">
                                    <div class="row">
                                        <div class="header_choice col edit_choice_options_first_box col-sm-4">
                                            {{ __('boilerplate::chatbot.edit.choice_answer_column') }}
                                        </div>
                                        <div class="header_choice edit_number_options_first_box col col-sm-4 d-none row">
                                            <div class="col col-sm-6">
                                                {{ __('boilerplate::chatbot.edit.number_range_start_column') }}
                                            </div>
                                            <div class="col col-sm-6">
                                                {{ __('boilerplate::chatbot.edit.number_range_end_column') }}
                                            </div>
                                        </div>
                                        <div class="header_choice col col-sm-2">
                                            {{ __('boilerplate::chatbot.edit.choice_score_box_column') }}
                                        </div>
                                        <div class="header_choice col col-sm-4">
                                            {{ __('boilerplate::chatbot.edit.choice_next_que_column') }}
                                        </div>
                                        <div class="header_choice col col-sm-2">
                                            Actions
                                        </div>
                                    </div>
                                </li>
                                @foreach ($question->chatbotOptions as $q_option)
                                    <li class="user_choice_answer mt-3" data-delete='0' data-option-id="{{ $q_option->id}}">
                                        <div class="row">
                                            <div class="col-sm-4 edit_header_choice_value_first_box @if($question->question_type_id == $questionTypesIdsArray['number']) d-none @endif">
                                                <input class="form-control choice_answer_input-box" name="choice_answer_text" type="text" value="{{ $q_option->answer_text }}">
                                            </div>
                                            <div class="col-sm-4 row edit_header_number_value_second_box @if($question->question_type_id == $questionTypesIdsArray['choice']) d-none @endif">
                                                @php
                                                    if($question->question_type_id == $questionTypesIdsArray['number']){
                                                        $t_option_rages = explode('-', $q_option->answer_text);
                                                        $t_start_range = $t_option_rages[0];
                                                        $t_end_range = '';
                                                        if( is_array($t_option_rages) && count($t_option_rages) > 1 ){
                                                            $t_end_range = $t_option_rages[1];
                                                        }
                                                    }else{
                                                        $t_start_range = $t_end_range = '';
                                                    }
                                                @endphp
                                                <div class="col col-sm-6">
                                                    <input class="form-control choice_answer_input-box number_start_range" name="number_start_range" type="text" value="{{ $t_start_range }}">
                                                </div>
                                                <div class="col col-sm-6">
                                                    <input class="form-control choice_answer_input-box number_end_range" name="number_end_range" type="text"  value="{{ $t_end_range }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                @component('boilerplate::select2', ['name' => 'choice_answer_weight', 'class' => 'choice_answer_weight', 'minimum-results-for-search' => '-1'])
                                                    <option value="0" @if($q_option->answer_weight == 0) selected @endif>0%</option>
                                                    <option value="25" @if($q_option->answer_weight == 25) selected @endif>25%</option>
                                                    <option value="50"@if($q_option->answer_weight == 50) selected @endif>50%</option>
                                                    <option value="75" @if($q_option->answer_weight == 75) selected @endif>75%</option>
                                                    <option value="100" @if($q_option->answer_weight == 100) selected @endif>100%</option>
                                                @endcomponent
                                            </div>
                                            <div class="col-sm-4">
                                                <select name="choice_answer_next_coumn" class="choice_answer_next_coumn">
                                                    <option value="-1">None</option>
                                                    @foreach ($column_names as $c_id => $value)
                                                        <option value="{{ $c_id }}" @if(!empty($value) && $c_id == $q_option->next_question_id) selected @endif>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-2 justify-content-center text-center">
                                                <span class="delete_choice_answer_input mt-2 p-3"><i class="fa fa-times"></i></span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mt-4 col-md-12 edit_multi_choice_input_box @if($is_show_multichoice_options_box == false) d-none @endif">
                        <label for="new_question_choice_text">@lang('boilerplate::chatbot.edit.choice_options')<button class="btn btn-sm btn-primary ml-2 btn-add-more-answer-box" onclick="addMoreAsnwerToMultiChoiceChoices('li_que_{{ $question->id }}', {}, 'user_choice_answer');" type="button"><i class="fa fa-fw fa-plus"></i></button>
                        </label>
                        <div class="mt-3">
                            <ul class="multichoice_answers_list pl-0" style="list-style-type: none;">
                                <li class="header_row mt-3">
                                    <div class="row">
                                        <div class="header_choice col col-sm-7 text-left">
                                            {{ __('boilerplate::chatbot.edit.choice_answer_column') }}
                                        </div>
                                        <div class="header_choice col col-sm-3">
                                            {{ __('boilerplate::chatbot.edit.choice_score_box_column') }}
                                        </div>
                                        <div class="header_choice col col-sm-2">
                                            Actions
                                        </div>
                                    </div>
                                </li>
                                @foreach ($question->chatbotOptions as $q_option)
                                    <li class="user_choice_answer mt-3" data-delete='0' data-option-id="{{ $q_option->id}}">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <input class="form-control choice_answer_input-box" name="choice_answer_text" type="text" value="{{ $q_option->answer_text }}">
                                            </div>
                                            <div class="col-md-3">
                                                @component('boilerplate::select2', ['name' => 'choice_answer_weight', 'class' => 'choice_answer_weight', 'minimum-results-for-search' => '-1'])
                                                    <option value="0" @if($q_option->answer_weight == 0) selected @endif>0%</option>
                                                    <option value="25" @if($q_option->answer_weight == 25) selected @endif>25%</option>
                                                    <option value="50"@if($q_option->answer_weight == 50) selected @endif>50%</option>
                                                    <option value="75" @if($q_option->answer_weight == 75) selected @endif>75%</option>
                                                    <option value="100" @if($q_option->answer_weight == 100) selected @endif>100%</option>
                                                @endcomponent
                                            </div>
                                            <div class="col-md-2 justify-content-center text-center">
                                                <span class="delete_choice_answer_input mt-2 p-3"><i class="fa fa-times"></i></span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3 col-md-6 edit_parent_next_column_box @if($is_show_parent_column_box == false) d-none @endif">
                        <label for="edit_parent_next_column">@lang('boilerplate::chatbot.edit.next_questions_column')</label>
                        <select name="edit_parent_next_column" class="edit_parent_next_column">
                            <option value="-1">None</option>
                            @foreach ($column_names as $c_id => $value)
                                <option value="{{ $c_id }}" @if(!empty($value) && $c_id == $question->next_question_id) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">@lang('boilerplate::chatbot.edit.next_questions_column_help')</small>
                    </div>
                    <div class="mt-3 col-md-6 edit_delay_input_box d-none">
                        <div class="col-md-12">
                            @component('boilerplate::input', ['class' => 'edit_input_delay', 'name' => 'edit_input_delay', 'label' => 'boilerplate::chatbot.edit.input_delay', 'help' => 'boilerplate::chatbot.edit.input_delay_help', 'value' => $question->input_delay])@endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
</li>
@if(!empty($question->input_delay))
    <li class="delay_question_box delay_li_que_temp">
        @component('boilerplate::card', ['title' => '<span class="question-badge mr-2">Delay</span>' , 'class' => 'mt-3 pt-0', 'reduce' => 1, "collapsed" => 1])
            <div class="row mt-2 mr-0 edit_q_box">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 edit_delay_input_box">
                            <div class="col-md-12">
                                @component('boilerplate::input', ['class' => 'edit_input_delay mt-1', 'name' => 'edit_input_delay', 'label' => 'boilerplate::chatbot.edit.input_delay', 'help' => 'boilerplate::chatbot.edit.input_delay_help', 'value' => $question->input_delay])@endcomponent
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-sm btn-danger ml-2 float-right button_delete_delay_question" type="button"><i class="fa fa-fw fa-trash"></i></button>
                    {{-- <button class="btn btn-sm btn-primary ml-2 float-right button_edit_question"  data-question-id="{{ $question->id }}" type="button"><i class="fa fa-fw fa-pencil-alt"></i></button> --}}
                </div>
            </div>
        @endcomponent
    </li>
@endif
