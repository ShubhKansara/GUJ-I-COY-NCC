

<section class="content-wrapper">
        <div class="content container-fluid user-form-box p-3 p-sm-2 mb-2" style="position:fixed;bottom:55px;right:20px;">
                <div class="row float-right mt-2">
                    <div class="col" style="width: 480px;">
                        <div class="card card-outline card-info" style="background: #f5fafe;box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
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
                            <div class="card-body pt-0 scroll-container" style="max-height: 500px; overflow: scroll; overflow-x: hidden;height:350px;position: relative;">
                                <div class="row mt-4 pt-4 pb-3" id="question_list" style="max-height: 350px;overflow: auto;position: absolute;bottom: 0;overflow-x: hidden;width: 100%">
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
                                                        <div class="question-text mt-1">
                                                            <span class="current_question_text">{!! $chatbot_questions_first->question_text !!}</span>
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

                                        <div class="html_for_choice_answers_list d-none">
                                            <li class="float-left-box li_index_[LI-INDEX-NUMBER]" style="margin-left: 2.3rem;">
                                                <div class="col-md-12 mr-3 mt-2 question_box_container_[SEQUENCE-NUMBER]" style="text-align: end;">
                                                    <div class="d-block float-left">
                                                        <ul class="list-unstyled choice_answer_options_list" id="choice_answer_options_list">
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
                            <div class="user_action_area">
                                @php
                                    if(!empty($chatbot_questions_first->response_text)){
                                        $greeting_response_boxes = explode(',', $chatbot_questions_first->response_text);
                                    }
                                @endphp

                                @if (isset($greeting_response_boxes) && is_array($greeting_response_boxes) && count($greeting_response_boxes) > 0)
                                    <div class="user-action-answer-button-container p-3 justify-content-center text-center" style="width: 100%;">
                                        @foreach ($greeting_response_boxes as $grt_box)
                                            <span class="btn btn-primary mt-1 ml-2 current_answer_button_action" data-value="{{ $grt_box }}">{{ $grt_box }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="user-action-answer-input-container {{ count($greeting_response_boxes) }}  @if(isset($greeting_response_boxes) && is_array($greeting_response_boxes) && count($greeting_response_boxes) > 0) d-none @endif">
                                    <div class='user-action-input-boxes' style="display:contents;">
                                        <div class="user-answer" style="width: 85%">
                                            <textarea class="form-control user-action-input-text-area" id="answer_text_input" style="resize: none;" placeholder="powered by Extrahourz" name="answer_text" rows="2" cols="20" type="text" value="" autofocus="true"></textarea>
                                        </div>
                                        <div class=" chatbot-formbuton-container" style="width: 10%">
                                            <span class="btn-group">
                                                <button type="button" class="btn btn-large btn-primary btn-save-question-answer">
                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="user-action-test-complete-box d-none" style="width: 100%">
                                        <div class="p-3 text-center">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="" style="position: fixed; bottom: 20px; right: 30px;">
            <span class="btn-group">
                <button type="button" class="btn btn-large btn-outline-dark" style="border-radius: 30px; padding: 0.375rem 0.75rem;">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </span>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
