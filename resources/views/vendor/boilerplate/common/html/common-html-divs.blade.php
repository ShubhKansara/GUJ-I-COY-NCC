<div class="generated_temp_que_div_html d-none">
   <li class="main_que_list_box [CLASS-NAME] li_que_[QUESTION-ID]" data-mode="draft" data-create-mode="{{ $current_page_create_mode }}" data-question-type-id="[QUESTION-TYPE-ID]" data-text="[QUESTION-TEXT]" data-error-message="[ERROR-MESSAGE]" data-response-text="[RESPONSE-TEXT]" data-regex="[REGEX-VALIDATION]" data-que-id="[QUESTION-ID]">
      @component('boilerplate::card', ['title' => ' [QUESTION-BADGE]<span class="question-type-badge question-badge question-badge-blue ml-2 mr-2">DRAFT</span>' . '[COLUMN-NAME]', 'class' => 'mt-3 pt-0', 'reduce' => 1, "collapsed" => 1])
      <div class="row">
         <div class="col-sm-8">
         </div>
         <div class="col-md-4 @if( isset($isRegistrationTemplate) && $isRegistrationTemplate == 1) d-none  @endif">
            <button class="btn btn-sm btn-danger ml-2 float-right button_delete_question" data-mode="draft" data-question-id="[QUESTION-ID]" type="button"><i class="fa fa-fw fa-trash"></i></button>
         </div>
      </div>
      <div class="row mt-2 mr-0 edit_q_box">
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-6 mt-3">
                  <label for="edit_question_type_id">@lang('boilerplate::chatbot.create_question_type')</label>
                  <select name="edit_question_type_id" class="edit_question_type_id">
                  @foreach ($questionTypes as $indx => $type)
                  @php
                    if(!in_array($type->key_name, array('text', 'choice', 'multi_choice', 'number', 'zip', 'file')) ){
                        continue;
                    }
                  @endphp
                  <option value="{{ $type->id }}" @if($type->key_name == 'text') selected @endif  > {{ $type->question_type_name }}</option>
                  @endforeach
                  </select>
               </div>
               <div class="mt-3 col-md-6 new_question_response_text_box edit_critical_box">
                   <div class="row">
                        <div class="col">
                            <label for="edit_is_critical">@lang('boilerplate::chatbot.edit.critical_headertitle')</label><br/>
                            <label class="switch mt-1">
                            <input type="checkbox" name="edit_is_critical" class="edit_is_critical">
                            <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="col">
                            <label for="edit_is_neutral">@lang('boilerplate::chatbot.edit.neutral_headertitle')</label><br/>
                            <label class="switch mt-1">
                            <input type="checkbox" name="edit_is_neutral" class="edit_is_neutral">
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
               </div>
               <div class="mt-3 col-md-6 edit_delete_box @if( isset($isRegistrationTemplate) && $isRegistrationTemplate == 0) d-none  @endif">
                    <div class="row">
                        <div class="col text-right">
                            <button class="btn btn-sm btn-danger ml-2 float-right button_delete_question" data-mode="draft" data-question-id="[QUESTION-ID]" type="button"><i class="fa fa-fw fa-trash"></i></button>
                        </div>
                    </div>
                </div>
               <div class="mt-3 col-md-6 edit_question_text_box">
                  <label for="edit_question_text">Enter Your Question Here*</label>
                  <textarea class="form-control edit_question_text" rows="3" cols="40" placeholder="Enter Your Question Here" name="edit_question_text">[QUESTION-TEXT]</textarea>
                  <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_help_placeholder')</small>
               </div>
               <div class="mt-3 col-md-6 edit_question_error_message_box">
                  <label for="edit_question_error_message">Question Error Message</label>
                  <textarea id="edit_question_error_message" class="form-control edit_question_error_message" rows="3" cols="40" name="edit_question_error_message">[ERROR-MESSAGE]</textarea>
                  <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_error_message')</small>
               </div>
               <div class="mt-3 col-md-6 edit_question_regex_box d-none">
                  <label for="edit_question_regex">Question Validation Regex</label>
                  <textarea id="edit_question_regex" class="form-control edit_question_regex mt-1" rows="2" cols="40" name="edit_question_regex">[REGEX-VALIDATION]</textarea>
                  <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_regular_expression')</small>
               </div>
               <div class="mt-3 col-md-6 edit_question_response_text_box">
                  <label for="edit_question_response_text">Response Text</label>
                  <textarea id="edit_question_response_text" class="form-control edit_question_response_text" rows="3" cols="40" name="edit_question_response_text">[RESPONSE-TEXT]</textarea>
                  <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_response_text')</small>
               </div>
               <div class="mt-3 col-md-6 edit_column_name_box">
                  <label for="edit_column_name">Column Name*</label>
                  <textarea id="edit_column_name"  placeholder="@lang('boilerplate::chatbot.edit.column_name_placeholder')"  class="form-control edit_column_name" rows="3" cols="40" name="edit_column_name">[COLUMN-NAME]</textarea>
                  <small class="form-text text-muted">@lang('boilerplate::chatbot.column_question_input_help')</small>
               </div>
               <div class="mt-3 col-md-6 edit_zip_code_box d-none">
                @component('boilerplate::input', ['name' => 'edit_zip_code', 'class' => 'edit_zip_code', 'type' => 'number', 'label' => 'boilerplate::chatbot.zip_code', 'help' => 'boilerplate::chatbot.zip_code_help', 'value' => '[ZIP-CODE]'])@endcomponent
                </div>
                <div class="mt-3 col-md-6 edit_distance_box d-none">
                @component('boilerplate::input', ['name' => 'edit_distance', 'class' => 'edit_distance','type' => 'number', 'label' => 'boilerplate::chatbot.distance',  'help' => 'boilerplate::chatbot.distance_help','value' => '[DISTANCE]'])@endcomponent
                </div>
                <div class="mt-3 col-md-6 edit_file_extentions_box d-none">
                @component('boilerplate::input', ['name' => 'edit_file_extetions', 'class' => 'edit_file_extetions','type' => 'text', 'label' => 'boilerplate::chatbot.file_extentions',  'help' => 'boilerplate::chatbot.file_extentions_help','value' => '[FILE-EXTENTIONS]'])@endcomponent
                </div>
               <div class="mt-4 col-md-12 edit_choice_input_box">
                  <label for="new_question_choice_text">@lang('boilerplate::chatbot.edit.choice_options')
                    <button class="btn btn-sm btn-primary ml-2 edit-add-more-choice-button btn-add-more-answer-box" data-question-type="number"  data-choice-class="pending_choice_answer" data-container-class="li_que_[QUESTION-ID]" type="button"><i class="fa fa-fw fa-plus"></i></button>
                  </label>
                    <div class="edit_number_options_label_box d-none">
                        <small>@lang('boilerplate::chatbot.edit.number_options_help_title')</small>
                    </div>
                  <div class="mt-3">
                     <ul class="choice_answers_list pl-0" style="list-style-type: none;">
                        <li class="header_row mt-3">
                           <div class="row">
                              <div class="header_choice edit_choice_options_first_box col col-sm-4">
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
                     </ul>
                  </div>
               </div>
               <div class="mt-4 col-md-12 edit_multi_choice_input_box">
                  <label for="new_question_choice_text">@lang('boilerplate::chatbot.edit.choice_options') <button class="btn btn-sm btn-primary ml-2 btn-add-more-answer-box" onclick="addMoreAsnwerToMultiChoiceChoices('li_que_[QUESTION-ID]');" type="button"><i class="fa fa-fw fa-plus"></i></button>
                  </label>
                  <div class="mt-3">
                     <ul class="multichoice_answers_list pl-0" style="list-style-type: none;">
                        <li class="header_row mt-3">
                           <div class="row">
                              <div class="header_choice col col-sm-10">
                                 {{ __('boilerplate::chatbot.edit.choice_answer_column') }}
                              </div>
                              <div class="header_choice col col-sm-2">
                                 Actions
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="mt-3 col-md-6 edit_parent_next_column_box">
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
                     @component('boilerplate::input', ['class' => 'edit_input_delay', 'value' => '0','name' => 'edit_input_delay', 'label' => 'boilerplate::chatbot.edit.input_delay', 'help' => 'boilerplate::chatbot.edit.input_delay_help'])@endcomponent
                  </div>
               </div>
            </div>
         </div>
      </div>
      @endcomponent
   </li>
</div>
<div class="generate_choice_option_html d-none">
    <li class="[LI-CLASS-NAME] temp_html_choice mt-3" data-option-id="" data-delete="0">
        <div class="row">
            <div class="col-md-4 [PLACEHOLDER-CLASS]header_choice_value_first_box">
                <input class="form-control choice_answer_input-box" name="choice_answer_text" type="text">
            </div>
            <div class="col-sm-4 row [PLACEHOLDER-CLASS]header_number_value_second_box d-none">
                <div class="col col-sm-6">
                    <input class="form-control choice_answer_input-box number_start_range" name="number_start_range" type="text">
                </div>
                <div class="col col-sm-6">
                    <input class="form-control choice_answer_input-box number_end_range" name="number_end_range" type="text">
                </div>
            </div>
            <div class="col-md-2">
                <select name="choice_answer_weight" class="[CHOICE-CLASS]">
                    <option value="0">0%</option>
                    <option value="25">25%</option>
                    <option value="50">50%</option>
                    <option value="75">75%</option>
                    <option value="100" selected>100%</option>
                </select>
            </div>
            <div class="col-md-4">
                <select name="choice_answer_next_coumn" class="n_next_column [CHOICE-NEXT-COLUMN-CLASS]">
                    <option value="-1">None</option>
                    @foreach ($column_names as $c_id => $value)
                        <option value="{{ $c_id }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 justify-content-center text-center">
                <span class="delete_choice_answer_input mt-2 p-3"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </li>
</div>
<div class="generate_multichoice_option_html d-none">
    <li class="[LI-CLASS-NAME] temp_html_choice mt-3" data-option-id="" data-delete="0">
        <div class="row">
            <div class="col-md-7">
                <input class="form-control choice_answer_input-box" name="choice_answer_text" type="text">
            </div>
            <div class="col-md-3">
                <select name="choice_answer_weight" class="[CHOICE-CLASS]">
                    <option value="0">0%</option>
                    <option value="25">25%</option>
                    <option value="50">50%</option>
                    <option value="75">75%</option>
                    <option value="100" selected>100%</option>
                </select>
            </div>
            <div class="col-md-2 justify-content-center text-center">
                <span class="delete_choice_answer_input mt-2 p-3"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </li>
</div>

<div class="generate_delay_html d-none">
    <li>
        <div class="lds-ellipsis"><div></div><div></div><div></div>
    </li>
</div>

<div class="generate_delay_question_box d-none">
    <li class="delay_question_box delay_li_que_[QUESTION-ID]" data-que-id="[QUESTION-ID]">
        @component('boilerplate::card', ['title' => '<span class="question-badge mr-2">Delay</span>' , 'class' => 'mt-3 pt-0', 'reduce' => 1, "collapsed" => 1])
            <div class="row mt-2 mr-0 edit_q_box">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12 edit_delay_input_box">
                            <div class="col-sm-12">
                                @component('boilerplate::input', ['class' => 'edit_input_delay mt-1', 'data-question-id' => '[QUESTION-ID]'  ,  'name' => 'edit_input_delay', 'label' => 'boilerplate::chatbot.edit.input_delay', 'help' => 'boilerplate::chatbot.edit.input_delay_help', 'value' => '[DELAY-VALUE]'])@endcomponent
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-sm btn-danger ml-2 float-right button_delete_delay_question" data-question-id="[QUESTION-ID]" type="button"><i class="fa fa-fw fa-trash"></i></button>
                </div>
            </div>
        @endcomponent
    </li>
</div>

<div class="generate_reference_link_html d-none">
    <li class='reference_box_[REFERENCE-ID]'>
        <div class="row">
            <div class="col-sm-3 pl0 pr0" style="word-break: break-word;">
                [DISPLAY-REFERENCE-TEXT] :
            </div>
            <div class="rference_link_box col-sm-6 pl0 pr0">
                <button class="reference-anchor btn btn-link chatbot-url-generation-[REFERENCE-ID]" data-preview="[REFERENCE-LINK-GENERATED]&preview=1"  data-href="[REFERENCE-LINK-GENERATED]" data-href="[REFERENCE-LINK-GENERATED]" target="_blank">[REFERENCE-LINK-GENERATED]</button>
            </div>
            <div class="rference_link_box col-sm-3 pl0 pr0 text-center">
                <button type="button" class="btn btn-small btn-copy-ref-link"  data-class="chatbot-url-generation-[REFERENCE-ID]">
                    <i class="fa fa-copy"></i>
                </button>
                <button type="button" class="btn btn-small btn-delete-ref-link" data-id="[REFERENCE-ID]">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
    </li>
</div>
