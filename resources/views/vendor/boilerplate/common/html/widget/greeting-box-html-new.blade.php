<div class="card-header border-bottom-0 header-title-box" style="z-index:1;background: white;">
    <div class="row align-items-center">
        <div class="col-sm-2 pl0 pr0 text-center">
            <img  class="d-inline bot-icon left-bot-icon" src="{{ asset('assets/vendor/boilerplate/images/vendor/robo_logo_new.png') }}" alt="">
        </div>
        <div class="col-sm-9 pr0 pl0 text-center p-2">
            <h5 class="card-title d-inline" style="font-weight: normal;">Hi I’m Eva.<br/>Let's get your job application started!</h5><br/>
        </div>
        <div class="col-sm-1 p-2 refresh-chat-session" style="cursor: pointer;">
            <i title="Refresh Chat" class="fa fa-refresh" style="font-size:18px;"></i>
            {{-- <img src="{{ asset('assets/vendor/boilerplate/images/vendor/chatbot_minus.png') }}" style="max-width: 30px;"> --}}
        </div>
    </div>
</div>
<div class="card-body pt-0 scroll-container" style="overflow: scroll; overflow-x: hidden;position: relative;/* max-height: 60vh;height:60vh; */">
    <div class="row mt-4 pt-4 pb-4" id="question_list" style="max-height: 100%;overflow: auto;position: absolute;bottom: 0;overflow-x: hidden;width: 100%">
        <!-- <div class="col-md-10 ml-3 mr-3 mt-3 mb-3">
            <h6 class="result_info_div">Hello,</h6>
        </div> -->
        <ul class="p-0 data-container" style="list-style-type: none;width:100%">
            <li>
                <div class="date_sec">
                    <p><span>{{ date('d M Y') }}</span></p>
                </div>
            </li>
            <li>
                <div class="col-md-12 mr-3 question_box_container_{{ $chatbot_questions_first->sequence_order}}">
                    @if(isset($chatbot_questions_first->file_path) && !empty($chatbot_questions_first->file_path))
                        <div class="row">
                            <div class="bot_image_box col-sm-2 p-0 pl-2 mb-4">
                            </div>
                            <div class="col-sm-10 form-group chatbot-form-container mb-1 pl0 pl-4">
                                <img style="width: 160px;" class="d-inline mb-2" src="{{ url('storage/'. $chatbot_questions_first->file_path) }}" alt="">
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-2 bot_image_box p-0 mb-4">
                            <img class="d-inline bot-icon left-bot-icon mb-1" src="{{ asset('assets/vendor/boilerplate/images/vendor/robo_logo_new.png') }}" alt="">
                        </div>
                        <div class="col-sm-10 form-group chatbot-form-container mb-1 pl0 pl-4">
                            <input class="form-control" name="question_id" type="hidden" value="{{ $chatbot_questions_first->id }}">
                            <div class="question-text bg-yellow mt-1" style="white-space: inherit">
                                <span class="current_question_text" style="white-space: inherit">{!! nl2br($chatbot_questions_first->question_text) !!}</span>
                            </div>
                            <div class="chatbot-time-div-box"><small class="chatbot-time-div mt-3">{{ $replace_greeting_time }}</small></div>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="col-md-12 mr-3 mt-2 d-none question_box_container_{{ $chatbot_questions_first->sequence_order}}_answer" style="text-align: end;">
                    <div class="col-md-12 mr-3 question_box_container_[SEQUENCE-NUMBER]_answer" style="text-align: end;">
                        <div class="row align-items-end">
                            <div class="col-sm-12 form-group chatbot-form-container mb-1 pl0 pl-3 pl0 pr0">
                                <span class="current_question_text btn bg-white mt-1 mr-3">[ANSWER-TEXT]</span>
                                <img class="d-inline bot-icon user-bot-icon" src="{{ asset('assets/vendor/boilerplate/images/vendor/user_art_board.png') }}" alt="">
                            </div>
                        </div>
                        <div> <small class="user-chat-time-div">{{ $replace_greeting_time }}</small> </div>
                    </div>
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
                <li class="float-left-box li_index_[LI-INDEX-NUMBER]">
                    <div class="col-md-12 mr-3 question_box_container_[SEQUENCE-NUMBER]">
                        <div class="row">
                            <div class="bot_image_box col-sm-2 p-0 pl-2 mb-2"></div>
                            <div class="col-sm-10 form-group chatbot-form-container mb-1 pl0 pl-4">
                                {!! Form::file('user_file', ['id' => 'user_file',  'onchange' => "checkAndEnableSubmitButton('user_file')",'class' => 'd-block mb-1', 'accept' => '[FILE-EXTENTIONS]']) !!}
                            </div>
                        </div>
                    </div>
                </li>
            </div>
            <div class="generate_resume_file_html d-none">
                <li class="float-left-box li_index_[LI-INDEX-NUMBER]">
                    <div class="col-md-12 mr-3 question_box_container_[SEQUENCE-NUMBER]">
                        <div class="row">
                            <div class="bot_image_box col-sm-2 p-0 pl-2 mb-2"></div>
                            <div class="col-sm-10 form-group chatbot-form-container mb-1 pl0 pl-4">
                                {!! Form::file('resume_file', ['id' => 'resume_file', 'onchange' => "checkAndEnableSubmitButton('resume_file')", 'class' => 'd-block mb-1', 'accept' => 'application/pdf, .docx, .doc, .pdf']) !!}
                            </div>
                        </div>
                    </div>
                </li>
            </div>
            <div class="user-answer-template-box d-none">
                <li class="float-left-box">
                    <div class="col-md-12 mr-3 mt-1 question_box_container_[SEQUENCE-NUMBER]_answer" style="text-align: end;">
                        <div class="row">
                            <div class="col-sm-12 form-group chatbot-form-container mb-1 pl0 pl-3">
                                <span class="current_question_text btn bg-white mt-1 mr-3">[ANSWER-TEXT]</span>
                                <img class="d-inline bot-icon user-bot-icon" src="{{ asset('assets/vendor/boilerplate/images/vendor/user_art_board.png') }}" alt="">
                            </div>
                        </div>
                        <div> <small class="user-chat-time-div">[TIME]</small> </div>
                    </div>
                </li>
            </div>

            <div class="bot-template-default-box d-none">
                <li class="float-left-box mt-3">
                    <div class="col-md-12 mr-3 question_box_container_[SEQUENCE-NUMBER]">
                        <div class="row">
                            <div class="bot_image_box col-sm-2 p-0 pl-2 mb-4">
                                <img class="d-inline bot-icon mb-1" src="[EXTRAHOURZ-FAVICON]" alt="">
                            </div>
                            <div class="col-sm-10 form-group chatbot-form-container mb-1 pl0 pl-4">
                                <input class="form-control" name="question_id" type="hidden" value="[QUESTION-ID]">
                                <div class="question-text bg-yellow mt-1"> <span class="current_question_text">[QUESTION-TEXT]</span> </div>
                                <div class="chatbot-time-div-box"><small class="chatbot-time-div mt-3">[TIME]</small></div>
                            </div>
                        </div>
                    </div>
                </li>
            </div>

            <div class="html_for_choice_answers_list d-none">
                <li class="float-left-box li_index_[LI-INDEX-NUMBER]">
                    <div class="col-md-12 mr-3 question_box_container_[SEQUENCE-NUMBER]" style="text-align: end;">
                        <div class="row">
                            <div class="bot_image_box col-sm-2 p-0 pl-2 mb-2"></div>
                            <div class="col-sm-10 form-group mb-1 pl0 pl-3">
                                <div class="d-block float-left">
                                    <ul class="list-unstyled choice_answer_options_list mt-1" id="choice_answer_options_list">
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
                        </div>

                    </div>
                </li>
            </div>
        </ul>
    </div>
</div>
