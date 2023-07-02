<div class="card-header border-bottom-0" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 1px 8px;z-index:1;background: white;">
    <div class="row align-items-center">
        <div class="col-sm-1">
            <img style="width: 30px;" class="d-inline" src="{{ asset('assets/vendor/boilerplate/images/vendor/favicon_new.png') }}" alt="">
        </div>
        <div class="col-sm-10 pr0 pl-4">
            <h5 class="card-title d-inline">Extrahourz</h5><br/>
            <small>Here are links to <a href="#">Terms</a> and <a href="#">Privacy Policy</a></small>
        </div>
        <div class="col-sm-1 p-2 refresh-chat-session" style="cursor: pointer;">
            <i class="fa fa-refresh" style="font-size:18px;"></i>
        </div>
    </div>
</div>
<div class="card-body pt-0 scroll-container" style="max-height: 60vh; overflow: scroll; overflow-x: hidden;height:60vh;position: relative;">
    <div class="row mt-4 pt-4 pb-3" id="question_list" style="max-height: 100%;overflow: auto;position: absolute;bottom: 0;overflow-x: hidden;width: 100%">
        <!-- <div class="col-md-10 ml-3 mr-3 mt-3 mb-3">
            <h6 class="result_info_div">Hello,</h6>
        </div> -->
        <ul class="p-0 data-container" style="list-style-type: none;width:100%">
            <li>
                <div class="col-md-12 mr-3 question_box_container_{{ $chatbot_questions_first->sequence_order}}">
                    <div class="row align-items-end">
                        <div class="col-sm-1 p-0 pl-2 mb-2">
                            <img style="width: 30px;" class="d-inline" src="{{ asset('assets/vendor/boilerplate/images/vendor/favicon_new.png') }}" alt="">
                        </div>
                        <div class="col-sm-10 form-group chatbot-form-container mb-1 pl0 pl-3">
                            <input class="form-control" name="question_id" type="hidden" value="{{ $chatbot_questions_first->id }}">
                            @if(isset($chatbot_questions_first->file_path) && !empty($chatbot_questions_first->file_path))
                                <img style="width: 160px;" class="d-inline mb-2" src="{{ url('storage/'. $chatbot_questions_first->file_path) }}" alt="">
                            @endif
                            <div><small class="chatbot-time-div mt-3">{{ $replace_greeting_time }}</small></div>
                            <div class="question-text mt-1" style="white-space: inherit">
                                <span class="current_question_text" style="white-space: inherit">{!! $chatbot_questions_first->question_text !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="col-md-12 mr-3 mt-2 d-none question_box_container_{{ $chatbot_questions_first->sequence_order}}_answer" style="text-align: end;">
                    <div>
                        <small class="user-chat-time-div">{{ $replace_greeting_time }}</small>
                    </div>
                    <span class="current_question_text btn btn-primary mt-1">Question</span>
                </div>
            </li>
            <div class="html_for_choice_answer d-none">
                <li>
                    <div class="question_text choice_ans_box mt-1 text-left">
                        <input data-choice-id="[CHOICE-OPTION-ID]" type="radio" id="choice_option_[CHOICE-OPTION-ID]" name="choice_ans_list_[QUESTION-ID]" value="[CHOICE-OPTION-VALUE]">
                        <label class="ml-1 choice_answer_label" for="choice_option_[CHOICE-OPTION-ID]">[CHOICE-OPTION-VALUE]</label>
                    </div>
                </li>
            </div>

            <div class="html_for_multi_choice_answer d-none">
                <li>
                    <div class="question_text choice_ans_box mt-1 text-left">
                        <input data-choice-id="[CHOICE-OPTION-ID]" type="checkbox" id="choice_option_[CHOICE-OPTION-ID]" name="choice_ans_list_[QUESTION-ID][]" value="[CHOICE-OPTION-VALUE]">
                        <label class="ml-1 choice_answer_label" for="choice_option_[CHOICE-OPTION-ID]">[CHOICE-OPTION-VALUE]</label>
                    </div>
                </li>
            </div>

            <div class="generate_user_file_html d-none">
                <li class="float-left-box li_index_[LI-INDEX-NUMBER]"  style="margin-left: 2.3rem;">
                    <div class="col-md-12 mr-3 question_box_container_[SEQUENCE-NUMBER]">
                        <div class="row align-items-end">
                            <div class="col-sm-10 form-group chatbot-form-container mb-1 pl0 pl-3">
                                {!! Form::file('user_file', ['id' => 'user_file',  'onchange' => "checkAndEnableSubmitButton('user_file')",'class' => 'd-block mt-3 mb-1', 'accept' => '[FILE-EXTENTIONS]']) !!}
                            </div>
                        </div>
                    </div>
                </li>
            </div>
            <div class="generate_resume_file_html d-none">
                <li class="float-left-box li_index_[LI-INDEX-NUMBER]"  style="margin-left: 2.3rem;">
                    <div class="col-md-12 mr-3 question_box_container_[SEQUENCE-NUMBER]">
                        <div class="row align-items-end">
                            <div class="col-sm-10 form-group chatbot-form-container mb-1 pl0 pl-3">
                                {!! Form::file('resume_file', ['id' => 'resume_file', 'onchange' => "checkAndEnableSubmitButton('resume_file')", 'class' => 'd-block mt-3 mb-1', 'accept' => 'application/pdf, .docx, .doc, .pdf']) !!}
                            </div>
                        </div>
                    </div>
                </li>
            </div>

            <div class="html_for_choice_answers_list d-none">
                <li class="float-left-box li_index_[LI-INDEX-NUMBER]" style="margin-left: 2.3rem;">
                    <div class="col-md-12 mr-3 mt-2 question_box_container_[SEQUENCE-NUMBER]" style="text-align: end;">
                        <div class="d-block float-left">
                            <ul class="list-unstyled choice_answer_options_list mt-3" id="choice_answer_options_list">
                                [CHOICE-OPTION-HTML]
                                {{-- <li>
                                    <div class="question_text choice_ans_box mt-1 text-left">
                                        <input data-choice-id="[CHOICE-OPTION-ID]" type="radio" id="html" name="gender" value="HTML">
                                        <label class="ml-1 choice_answer_label" for="html">Male</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="question_text choice_ans_box mt-1 text-left">
                                        <input data-choice-id="[CHOICE-OPTION-ID]" type="radio" id="html2" name="gender" value="HTML">
                                        <label class="ml-1 choice_answer_label" for="html2">Female</label>
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </li>
            </div>
        </ul>
    </div>
</div>
