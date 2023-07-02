<div class="col-md-12 new-questions-list-container">
   @component('boilerplate::card', ['title' => 'boilerplate::chatbot.create_question'])
   <div class="row mt-2 mr-0 view_q_box">
      <div class="col-md-12">
         @component('boilerplate::card')
         <div class="row">
            <div class="col-md-6 mt-3">
               @component('boilerplate::select2', ['name' => 'new_question_type_id', 'id' => 'new_question_type_id',
               'label' => 'boilerplate::chatbot.create_question_type', 'minimum-results-for-search' => '-1'])
               @foreach ($questionTypes as $indx => $type)
               @php
                if(!in_array($type->key_name, array('text', 'choice', 'multi_choice', 'delay', 'number', 'zip', 'file')) ){
                    continue;
                }
               @endphp
               <option value="{{ $type->id }}" @if($type->key_name == 'text') selected @endif  > {{ $type->question_type_name }}</option>
               @endforeach
               @endcomponent
            </div>
            <div class="mt-3 col-md-6 new_question_choice_text_box new_question_critical_box">
               <div class="row">
                    <div class="col">
                        <label for="new_is_critical">@lang('boilerplate::chatbot.edit.critical_headertitle')</label><br/>
                            <label class="switch mt-1">
                            <input type="checkbox" name="new_is_critical" class="new_is_critical">
                            <span class="slider round"></span>
                            </label>
                    </div>
                    <div class="col">
                        <label for="new_is_neutral">@lang('boilerplate::chatbot.edit.neutral_headertitle')</label><br/>
                            <label class="switch mt-1">
                            <input type="checkbox" name="new_is_neutral" class="new_is_neutral">
                            <span class="slider round"></span>
                            </label>
                    </div>
               </div>
            </div>
            <div class="mt-3 col-md-6 new_question_text_box">
               <label for="new_question_text">Enter Your Question Here*</label>
               <textarea id="new_question_text" class="form-control new_question_text" rows="3" cols="40" placeholder="Enter Your Question Here" name="new_question_text"></textarea>
               <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_help_placeholder')</small>
            </div>
            <div class="mt-3 col-md-6 new_question_error_message_box">
               <label for="new_question_error_text">Question Error Message</label>
               <textarea id="new_question_error_text" class="form-control new_question_error_text" rows="3" cols="40" name="new_question_error_text"></textarea>
               <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_error_message')</small>
            </div>
            <div class="mt-3 col-md-6 new_question_regex_box d-none">
               <label for="new_question_regex">Question Validation Regex</label>
               <textarea id="new_question_regex" class="form-control mt-1" rows="3" cols="40" name="new_question_regex"></textarea>
               <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_regular_expression')</small>
            </div>
            <div class="mt-3 col-md-6 new_question_response_text_box">
               <label for="new_question_response_text">Response Text</label>
               <textarea id="new_question_response_text" class="form-control mt-1" rows="3" cols="40" name="new_question_response_text"></textarea>
               <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_response_text')</small>
            </div>
            <div class="mt-3 col-md-6 new_column_name_box">
               <label for="new_column_name">@lang('boilerplate::chatbot.edit.column_name')</label>
               <textarea id="new_column_name"  placeholder="@lang('boilerplate::chatbot.edit.column_name_placeholder')" class="form-control new_column_name" rows="3" cols="40" name="new_column_name"></textarea>
               <small class="form-text text-muted">@lang('boilerplate::chatbot.column_question_input_help')</small>
            </div>
            <div class="mt-3 col-md-6 new_zip_code_box d-none">
               @component('boilerplate::input', ['name' => 'new_zip_code','class' => 'new_zip_code', 'type' => 'number', 'label' => 'boilerplate::chatbot.zip_code', 'help' => 'boilerplate::chatbot.zip_code_help', 'value' => ''])@endcomponent
            </div>
            <div class="mt-3 col-md-6 new_distance_box d-none">
               @component('boilerplate::input', ['name' => 'new_distance', 'class' => 'new_distance','type' => 'number', 'label' => 'boilerplate::chatbot.distance',  'help' => 'boilerplate::chatbot.distance_help','value' => ''])@endcomponent
            </div>
            <div class="mt-3 col-md-6 new_file_extentions_box d-none">
               @component('boilerplate::input', ['name' => 'new_file_extetions', 'class' => 'new_file_extetions','type' => 'text', 'label' => 'boilerplate::chatbot.file_extentions',  'help' => 'boilerplate::chatbot.file_extentions_help','value' => ''])@endcomponent
            </div>
            <div class="mt-4 col-md-12 new_choice_input_box d-none">
               <label for="new_question_choice_text">@lang('boilerplate::chatbot.edit.choice_options')
                    <button class="btn btn-sm btn-primary ml-2 new-add-more-choice-button btn-add-more-answer-box" data-question-type="" data-container-class="new-questions-list-container" data-choice-class="pending_choice_answer" type="button"><i class="fa fa-fw fa-plus"></i></button>
                    {{-- addMoreAsnwerToChoices('new-questions-list-container') --}}
               </label>
               <div class="new_number_options_label_box d-none">
                    <small>@lang('boilerplate::chatbot.edit.number_options_help_title')</small>
                </div>
               <div class="mt-3">
                  <ul class="choice_answers_list pl-0" style="list-style-type: none;">
                     <li class="header_row mt-3">
                        <div class="row">
                           <div class="header_choice new_choice_options_first_box col col-sm-4">
                              {{ __('boilerplate::chatbot.edit.choice_answer_column') }}
                           </div>
                           <div class="header_choice new_number_options_first_box col col-sm-4 d-none row">
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
                     <li class="pending_choice_answer mt-3">
                        <div class="row">
                           <div class="col-sm-4 new_header_choice_value_first_box">
                              <input class="form-control choice_answer_input-box" name="choice_answer_text" type="text">
                           </div>
                           <div class="col-sm-4 row new_header_number_value_second_box d-none">
                               <div class="col col-sm-6">
                                  <input class="form-control choice_answer_input-box number_start_range" name="number_start_range" type="text">
                               </div>
                               <div class="col col-sm-6">
                                  <input class="form-control choice_answer_input-box number_end_range" name="number_end_range" type="text">
                               </div>
                           </div>
                           <div class="col-sm-2">
                              <select name="choice_answer_weight" class="choice_answer_weight">
                                 <option value="0">0%</option>
                                 <option value="25">25%</option>
                                 <option value="50">50%</option>
                                 <option value="75">75%</option>
                                 <option value="100" selected>100%</option>
                              </select>
                           </div>
                           <div class="col-sm-4">
                              <select name="choice_answer_next_coumn" class="choice_answer_next_coumn">
                                 <option value="-1">None</option>
                                 @foreach ($column_names as $c_id => $value)
                                 <option value="{{ $c_id }}">{{ $value }}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-sm-2 justify-content-center text-center">
                              <span class="delete_choice_answer_input mt-2"><i class="fa fa-times"></i></span>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="mt-4 col-md-12 new_multi_choice_input_box d-none">
               <label for="new_question_choice_text">@lang('boilerplate::chatbot.edit.choice_options') <button class="btn btn-sm btn-primary ml-2 btn-add-more-answer-box" onclick="addMoreAsnwerToMultiChoiceChoices('new-questions-list-container');" type="button"><i class="fa fa-fw fa-plus"></i></button>
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
                     <li class="pending_choice_answer mt-3">
                        <div class="row">
                           <div class="col-md-7">
                              <input class="form-control choice_answer_input-box" name="choice_answer_text" type="text">
                           </div>
                           <div class="col-md-3">
                              <select name="choice_answer_weight" class="choice_answer_weight">
                                 <option value="0">0%</option>
                                 <option value="25">25%</option>
                                 <option value="50">50%</option>
                                 <option value="75">75%</option>
                                 <option value="100" selected>100%</option>
                              </select>
                           </div>
                           <div class="col-md-2 justify-content-center text-center">
                              <span class="delete_choice_answer_input mt-2"><i class="fa fa-times"></i></span>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="mt-3 col-md-6 new_parent_next_column_box">
               <label for="new_parent_next_column">@lang('boilerplate::chatbot.edit.next_questions_column')</label>
               <select name="new_parent_next_column" class="new_parent_next_column">
                  <option value="-1">None</option>
                  @foreach ($column_names as $c_id => $value)
                  <option value="{{ $c_id }}">{{ $value }}</option>
                  @endforeach
               </select>
               <small class="form-text text-muted">@lang('boilerplate::chatbot.edit.next_questions_column_help')</small>
            </div>
            <div class="mt-3 col-md-6 new_delay_input_box d-none">
               <div class="col-md-12">
                  @component('boilerplate::input', ['id' => 'new_input_delay', 'value' => '0', 'name' => 'new_input_delay', 'label' => 'boilerplate::chatbot.edit.input_delay', 'help' => 'boilerplate::chatbot.edit.input_delay_help'])@endcomponent
               </div>
            </div>
         </div>
         @endcomponent
      </div>
   </div>
   <div class="row">
      <div class="col-md-12 mt-2">
         <span class="btn-group col-md-12 pl-0">
         <button type="button" class="btn btn-primary save_new_question">
         @lang('boilerplate::chatbot.edit.add_new_question')
         </button>
         </span>
      </div>
   </div>
   @endcomponent
</div>
