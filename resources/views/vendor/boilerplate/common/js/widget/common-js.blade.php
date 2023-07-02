@include('boilerplate::common.js.widget.firebase-js')
<script>
    //delay_answer_template = '<li class="delay_loading_box float-left-box"> <div class="col-md-12 mr-3"> <div class="row align-items-end"> <div class="col-sm-1 p-0 pl-2 mb-2"> <img style="width: 30px;" class="d-inline" src="[EXTRAHOURZ-FAVICON]" alt=""> </div> <div class="col-sm-10 form-group chatbot-form-container mb-1 pl0 pl-3"> <div><small class="chatbot-time-div mt-3">[TIME]</small></div> <div class="question-text mt-1"> <span class="current_question_text"><div class="lds-ellipsis"><div></div><div></div><div></div></span> </div> </div> </div> </div> </li>';
    delay_answer_template = '<li class="delay_loading_box float-left-box"> <div class="col-md-12 mr-3"> <div class="row"> <div class="bot_image_box col-sm-2 p-0 pl-2 mb-2"> <img class="d-inline bot-icon mb-1" class="d-inline" src="[EXTRAHOURZ-FAVICON]" alt=""> </div> <div class="col-sm-10 form-group chatbot-form-container mb-1 pl0 pl-4"> <div class="question-text bg-yellow mt-1"> <span class="current_question_text"><div class="lds-ellipsis"><div></div><div></div><div></div></span> </div></div> <div class="chatbot-time-div-box"><small class="chatbot-time-div mt-3">[TIME]</small></div> </div> </div> </li>';
    delay_answer_template = delay_answer_template.replace("[EXTRAHOURZ-FAVICON]", extrahours_chat_facivon);
    var is_otp_choice_question = false;
    var is_exam_result_choice_question = false;
    var is_send_sms_to_user = is_phone_otp_question = false;
    var is_show_user_message = true;
    var current_user_name = '';
    var otp_error_message = 'OTP is invalid';
    var rst_phn_flw_bck = false;
    var is_preview_screen = false;
    @if (isset($is_preview_screen) && $is_preview_screen == 1)
        is_preview_screen = true;
    @endif

    $('textarea[name=answer_text]').keypress(function(e) {
        var a = [];
        var k = e.which;

        for (i = 48; i < 58; i++)
            a.push(i);

        if (!(a.indexOf(k)>=0) && (current_question_type_key && current_question_type_key == 'number' || current_question_type_key && current_question_type_key == 'zip')){
            e.preventDefault();
        }else if((current_question_type_key && current_question_type_key == 'zip') && ($(this).val().length + 1) > 6){
            //not allwoing >6 zip code length
            e.preventDefault();
        }
    });

    $('textarea[name=answer_text]').keyup(function (e) {
        if(current_question_type_key && current_question_type_key == 'zip'){
            // allow min 5-6 lenth zip code - else button disable it
            if($(this).val().length < 5){
                $(".btn-save-question-answer").attr('disabled', true);
            }else{
                $(".btn-save-question-answer").removeAttr('disabled');
            }
        }
    });

    $(document).on("click", ".btn-save-question-answer", function (e) {
        e.preventDefault();
        //console.log(current_question_type_key);
        if(current_question_type_key && (current_question_type_key != 'exam_result' && current_question_type_key != 'file' && current_question_type_key != 'resume_file' && current_question_type_key != 'choice' && current_question_type_key != 'multi_choice') && $('textarea[name=answer_text]').val().trim().length <= 0 ){
            return true;
        }

        if(current_question_type_key && current_question_type_key == 'resume_file' && $(current_quizbox_sequence_class + ' input[name=resume_file]')[0].files.length === 0){
            console.log('file not selected');
            return true;
        }

        if(current_question_type_key && current_question_type_key == 'file' && $(current_quizbox_sequence_class + ' input[name=user_file]')[0].files.length === 0){
            console.log('user file not selected');
            return true;
        }

        //if question is exam result - normal input - no choice options are then - then check value input
        if(is_exam_result_choice_question == false && current_question_type_key && current_question_type_key == 'exam_result' && $('textarea[name=answer_text]').val().trim().length <= 0 ){
            console.log('its exam result text not found');
            return true;
        }

        current_asked_question_id = $(current_quizbox_sequence_class + ' input[name=question_id]').val();
        current_ans_text_value = $('textarea[name=answer_text]').val();

        if(is_send_sms_to_user == true){
            user_answer_template_temp = user_answer_template;
            user_answer_template_temp = user_answer_template_temp.replace("[ANSWER-TEXT]", current_ans_text_value);
            user_answer_template_temp = user_answer_template_temp.replace("[SEQUENCE-NUMBER]", current_sequence_number);
            user_answer_template_temp = user_answer_template_temp.replace("[TIME]", getCurrentTimeString());
            $('#question_list .data-container').append(user_answer_template_temp);

            $(".btn-save-question-answer").attr('disabled', true);
            scrolltoLastQuestion();
            $('.user-action-input-text-area').val('');

            tverf(current_ans_text_value);
            return;
        }

        $('.result-box').css('display', 'none');
        var formData = new FormData();
        formData.append('chatbot_id', '{{ $chatbot_id }}');
        formData.append('interviewee_id', current_interviewee_id);
        formData.append('question_id', current_asked_question_id);
        if(is_otp_choice_question == false){
            formData.append('question_type_key', current_question_type_key);
        }else{
            formData.append('question_type_key', 'otp_choice');
        }
        if(is_preview_screen == true){
            formData.append('widget_preview', 1);
        }
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('queue_ids', queue_pending_ids);
        formData.append('current_seq_number', current_sequence_number);

        if (current_question_type_key && current_question_type_key == 'exam_result') {
            //check if exam_Result is choice question then check value
            if(is_exam_result_choice_question == true){
                if ($('input[name=choice_ans_list_' + current_asked_question_id  +']:checked').val() == undefined ) {
                    console.log('please select quston ans first');
                    return;
                }
                current_ans_text_value = $('input[name=choice_ans_list_' + current_asked_question_id  +']:checked').val();
            }
            formData.append('answer_text', current_ans_text_value);
        }else if (current_question_type_key && current_question_type_key == 'choice') {
            if ($('input[name=choice_ans_list_' + current_asked_question_id  +']:checked').val() == undefined ) {
                console.log('please select quston ans first');
                return;
            }
            current_ans_text_value = $('input[name=choice_ans_list_' + current_asked_question_id  +']:checked').val();
            formData.append('answer_text', current_ans_text_value);
            formData.append('answer_text_option_id', $('input[name=choice_ans_list_' + current_asked_question_id  +']:checked').attr('data-choice-id'));
        }else if (current_question_type_key && current_question_type_key == 'multi_choice') {
            answer_text_multi_choice = '';
            answer_text_multi_choice_option_ids = [];
            $("input[name='choice_ans_list_" + current_asked_question_id + "[]']:checked").each(function (index, obj) {
                if(answer_text_multi_choice.length == 0){
                    answer_text_multi_choice += obj.value ;
                }else{
                    answer_text_multi_choice +=  ' | ' + obj.value ;
                }
                answer_text_multi_choice_option_ids.push(obj.getAttribute('data-choice-id'));
                //console.log(obj.value, obj.getAttribute('data-choice-id'));
            });

            if (answer_text_multi_choice_option_ids.length <= 0) {
                console.log('no options selcted');
                $(".btn-save-question-answer").attr('disabled', true);
                return;
            }

            //console.log(answer_text_multi_choice, answer_text_multi_choice_option_ids);
            current_ans_text_value = answer_text_multi_choice;
            formData.append('answer_text', current_ans_text_value);
            formData.append('answer_text_option_id', answer_text_multi_choice_option_ids.join(","));
        }else if(current_question_type_key && current_question_type_key == 'resume_file' && $(current_quizbox_sequence_class + ' input[name=resume_file]')[0].files[0]){
            formData.append('answer_text', $(current_quizbox_sequence_class + ' input[name=resume_file]')[0].files[0]);
            current_ans_text_value = "File Uploaded.";
        }else if(current_question_type_key && current_question_type_key == 'file' && $(current_quizbox_sequence_class + ' input[name=user_file]')[0].files[0]){
            formData.append('answer_text', $(current_quizbox_sequence_class + ' input[name=user_file]')[0].files[0]);
            current_ans_text_value = "File Uploaded.";
        }else{
            formData.append('answer_text', current_ans_text_value);
        }

        if(current_user_name.length == 0 &&  current_question_type_key == 'name' ){
            current_user_name = current_ans_text_value;
        }

        if(is_first_question == true){
            $('.user-action-answer-button-container').css('display', 'none');
            @if(!empty($chatbot_questions_first->response_text))
                $('.user-action-answer-input-container').removeClass('d-none').css('display', 'contents');
            @else
                $('.user-action-answer-input-container').removeClass('d-none').css('display', 'unset');
            @endif
            is_first_question = false;
            let answerLabel = current_quizbox_sequence_class +'_answer';
            $(answerLabel + ' .current_question_text').text(current_ans_text_value); // data.data.last_ans
            $(answerLabel + ' .user-chat-time-div').text('sending..'); // data.data.last_ans
            $(answerLabel).removeClass('d-none');
        }else{
            if(is_show_user_message == true){
                user_answer_template_temp = user_answer_template;
                user_answer_template_temp = user_answer_template_temp.replace("[ANSWER-TEXT]", current_ans_text_value);
                user_answer_template_temp = user_answer_template_temp.replace("[SEQUENCE-NUMBER]", current_sequence_number);
                user_answer_template_temp = user_answer_template_temp.replace("[TIME]", 'sending..');
                $('#question_list .data-container').append(user_answer_template_temp);
            }else{
                is_show_user_message = true;
            }
        }

        if(rst_phn_flw_bck == true){
            rst_phn_flw_bck = false;
            formData.append('rst_phone', '_jm');
        }

        $(".btn-save-question-answer").attr('disabled', true);
        scrolltoLastQuestion();
        $('.user-action-input-text-area').val('');
        $.ajax({
            type: "POST",
            url: "{{ route('chatbots-questions.storeanswer')}}",
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType,
            dataType: "json",
            success: function(data) {
                $('input:radio').attr('disabled',true);
                $('input:checkbox').attr('disabled',true);

                //set OTP error message if found
                if(data.data.otp_error_message && data.data.otp_error_message.length > 0){
                    otp_error_message = data.data.otp_error_message;
                }

                if(data.data.is_send_sms_to_user && data.data.is_send_sms_to_user == true){
                    if(data.data.sender_phone_number && data.data.sender_phone_number.length > 0){
                        is_send_sms_to_user = true;
                        is_phone_otp_question = true;
                        tsndcd(data.data.sender_phone_number);
                    }else{
                        showErrorMessageToWidget('Phone number not found', getCurrentTimeString());
                    }
                }else{
                    $(".btn-save-question-answer").attr('disabled', false);
                }

                //store pendings ids - to resend into next api call
                queue_pending_ids = (data.data.queue_ids) ? data.data.queue_ids : '';
                $(current_quizbox_sequence_class + ' textarea[name=answer_text]').attr('readonly', '');
                current_interviewee_id = data.data.interviewee_id;

                //remove text from user input and set focus
                $('.user-action-input-text-area').val('').focus();
                $(current_quizbox_sequence_class +'_answer .user-chat-time-div').text(tConvert(data.data.timestamp)); // data.data.last_ans

                //Step 1: show response text first - if found
                if (data.data.response_text && data.data.response_text.length > 0) {
                    if(!data.data.next_que_id || data.data.next_que_id == ''){
                        current_sequence_number++;
                    }
                    bot_question_template_temp = bot_question_template;
                    if(is_preview_screen == true){
                        li_index_number++;
                        bot_question_template_temp = bot_question_template_temp.replace("[LI-INDEX-NUMBER]", li_index_number);
                    }

                    data.data.response_text = data.data.response_text.replace("{name}", current_user_name);
                    data.data.response_text = data.data.response_text.replace("{Name}", current_user_name);

                    bot_question_template_temp = bot_question_template_temp.replace("[QUESTION-TEXT]", data.data.response_text);
                    bot_question_template_temp = bot_question_template_temp.replace("[SEQUENCE-NUMBER]", current_sequence_number);
                    bot_question_template_temp = bot_question_template_temp.replace("[QUESTION-ID]", data.data.next_que_id);
                    bot_question_template_temp = bot_question_template_temp.replace("[TIME]", tConvert(data.data.timestamp));
                    $('#question_list .data-container').append(bot_question_template_temp);
                    if(!data.data.next_que_id || data.data.next_que_id == ''){
                        $('#question_list .data-container .question_box_container_' + current_sequence_number + ' .question-text').replaceAnchorLinks();
                    }
                    scrolltoLastQuestion();
                }

                //check delay and delay question UI to Screen
                //console.log('delay --> ', data.data.input_delay);
                if (data.data.input_delay != '0') {
                    delay_answer_template_temp = delay_answer_template;
                    delay_answer_template_temp = delay_answer_template_temp.replace("[TIME]", tConvert(data.data.timestamp));
                    $('#question_list .data-container').append(delay_answer_template_temp);

                    scrolltoLastQuestion();
                }

                que_delay_timeout = setTimeout(() => {
                    $('.delay_loading_box').remove();


                    //if next question id found - show it.
                    if(data.data.next_que_id && data.data.next_que_id != ''){
                        //console.log('old que class ' + current_quizbox_sequence_class);
                        current_sequence_number = data.data.next_seq;
                        current_quizbox_sequence_class = '.question_box_container_' + current_sequence_number;
                        if(data.data.extra_que_type){
                            if(data.data.extra_que_type == 'otp_choice'){
                                current_question_type_key = (data.data.next_que_type) ? data.data.next_que_type : '';
                                is_otp_choice_question = true;
                            }else{
                                current_question_type_key = data.data.extra_que_type;
                                is_otp_choice_question = false;
                            }
                        }else{
                            current_question_type_key = (data.data.next_que_type) ? data.data.next_que_type : '';
                        }

                        //this fold for - if user has qualified - asking for file question - acceptance message show casing
                        if(data.data.accepted_rejected_message && data.data.accepted_rejected_message.length > 0){
                            data.data.accepted_rejected_message = data.data.accepted_rejected_message.replace("{name}", current_user_name);
                            data.data.accepted_rejected_message = data.data.accepted_rejected_message.replace("{Name}", current_user_name);

                            bot_question_template_temp = bot_question_template;
                            if(is_preview_screen == true){
                                li_index_number++;
                                bot_question_template_temp = bot_question_template_temp.replace("[LI-INDEX-NUMBER]", li_index_number);
                            }
                            bot_question_template_temp = bot_question_template_temp.replace("[QUESTION-TEXT]", data.data.accepted_rejected_message);
                            bot_question_template_temp = bot_question_template_temp.replace("[SEQUENCE-NUMBER]", '');
                            bot_question_template_temp = bot_question_template_temp.replace("[QUESTION-ID]", '');
                            bot_question_template_temp = bot_question_template_temp.replace("[TIME]", (data.data.timestamp ? tConvert(data.data.timestamp) : '')); //tConvert(data.data.timestamp)
                            $('#question_list .data-container').append(bot_question_template_temp);
                            console.log('thank you message is there.');
                            $(current_quizbox_sequence_class +'_answer .user-chat-time-div').html( (data.data.timestamp ? tConvert(data.data.timestamp) : '') );
                        }

                        // [SEQUENCE-NUMBER], [EXTRAHOURZ-FAVICON], [QUESTION-ID], [QUESTION-TEXT], [TIME]
                        bot_question_template_temp = bot_question_template;
                        if(is_preview_screen == true){
                            li_index_number++;
                            bot_question_template_temp = bot_question_template_temp.replace("[LI-INDEX-NUMBER]", li_index_number);
                        }

                        //replace current user name with place holders
                        data.data.next_question_text = data.data.next_question_text.replace("{name}", current_user_name);
                        data.data.next_question_text = data.data.next_question_text.replace("{Name}", current_user_name);

                        bot_question_template_temp = bot_question_template_temp.replace("[QUESTION-TEXT]", data.data.next_question_text);
                        bot_question_template_temp = bot_question_template_temp.replace("[SEQUENCE-NUMBER]", current_sequence_number);
                        bot_question_template_temp = bot_question_template_temp.replace("[QUESTION-ID]", data.data.next_que_id);
                        bot_question_template_temp = bot_question_template_temp.replace("[TIME]", tConvert(data.data.timestamp));
                        $('#question_list .data-container').append(bot_question_template_temp);
                        $('#question_list .data-container .question_box_container_' + current_sequence_number + ' .question-text').replaceAnchorLinks();
                        if(is_phone_otp_question == true){
                            is_phone_otp_question = false;
                            $('.question_box_container_' + current_sequence_number).parent().addClass('d-none');
                        }
                        //console.log('next que class ' + current_quizbox_sequence_class);

                        if(current_question_type_key.length > 0 && current_question_type_key == 'exam_result'){
                            bot_choice_ans_list_template = $('.html_for_choice_answers_list').html();
                            bot_choice_ans_single_tempalte = $('.html_for_choice_answer').html();
                            bot_choices_que_html = "";
                            //console.log(data.data, data.data.question_options, typeof(data.data.question_options));
                            if (data.data.question_options.length > 0) {
                                $('input:radio').attr('disabled',true);
                                $('input:checkbox').attr('disabled',true);
                                $.each(data.data.question_options, function (index, value) {
                                    bot_choices_que_html_temp = bot_choice_ans_single_tempalte;
                                    bot_choices_que_html_temp = bot_choices_que_html_temp.replaceAll("[CHOICE-OPTION-ID]", Math.floor((Math.random() * 1000) + 1));
                                    bot_choices_que_html_temp = bot_choices_que_html_temp.replaceAll("[CHOICE-OPTION-VALUE]", value);
                                    bot_choices_que_html_temp = bot_choices_que_html_temp.replaceAll("[QUESTION-ID]", data.data.next_que_id);
                                    bot_choices_que_html += bot_choices_que_html_temp;
                                });

                                li_index_number++;
                                bot_choice_ans_list_template = bot_choice_ans_list_template.replace("[LI-INDEX-NUMBER]", li_index_number);
                                bot_choice_ans_list_template = bot_choice_ans_list_template.replace("[CHOICE-OPTION-HTML]", bot_choices_que_html);
                                bot_choice_ans_list_template = bot_choice_ans_list_template.replace("[SEQUENCE-NUMBER]", current_sequence_number);
                                $('#question_list .data-container').append(bot_choice_ans_list_template);
                                $(current_quizbox_sequence_class +' input:radio').removeAttr('disabled');
                                $('.user-action-input-boxes .chatbot-formbuton-container').addClass('single-btn-anwer-container').css({ 'text-align': 'center', 'padding': '15px' });
                                $('.user-answer').css('display', 'none');
                                $('.user-action-input-boxes .btn-save-question-answer').html('Submit');
                                $('.btn-save-question-answer').attr('disabled', true);
                                is_exam_result_choice_question = true
                            }else{
                                $('.user-action-input-boxes .chatbot-formbuton-container').css({ 'width': '10%', 'text-align': 'unset', 'padding': 'unset' });
                                $('.user-answer').css('display', 'block');
                                $('.user-action-input-boxes .btn-save-question-answer').html('<i class="fa fa-paper-plane" aria-hidden="true"></i>');
                                $('.btn-save-question-answer').removeAttr('disabled');
                                removeSingleButtonANswerBox();
                            }
                        }else if (current_question_type_key.length > 0 && current_question_type_key == 'choice') {
                            bot_choice_ans_list_template = $('.html_for_choice_answers_list').html();
                            bot_choice_ans_single_tempalte = $('.html_for_choice_answer').html();

                            //[CHOICE-OPTION-HTML]
                            bot_choices_que_html = "";
                            //console.log(data.data, data.data.question_options, typeof(data.data.question_options));
                            if (data.data.question_options.length > 0) {
                                $('input:radio').attr('disabled',true);
                                $('input:checkbox').attr('disabled',true);
                                $.each(data.data.question_options, function (index, value) {
                                    bot_choices_que_html_temp = bot_choice_ans_single_tempalte;
                                    bot_choices_que_html_temp = bot_choices_que_html_temp.replaceAll("[CHOICE-OPTION-ID]", value.id);
                                    bot_choices_que_html_temp = bot_choices_que_html_temp.replaceAll("[CHOICE-OPTION-VALUE]", value.answer_text);
                                    bot_choices_que_html_temp = bot_choices_que_html_temp.replaceAll("[QUESTION-ID]", data.data.next_que_id);
                                    bot_choices_que_html += bot_choices_que_html_temp;
                                });

                                li_index_number++;
                                bot_choice_ans_list_template = bot_choice_ans_list_template.replace("[LI-INDEX-NUMBER]", li_index_number);
                                bot_choice_ans_list_template = bot_choice_ans_list_template.replace("[CHOICE-OPTION-HTML]", bot_choices_que_html);
                                bot_choice_ans_list_template = bot_choice_ans_list_template.replace("[SEQUENCE-NUMBER]", current_sequence_number);
                                $('#question_list .data-container').append(bot_choice_ans_list_template);
                                $(current_quizbox_sequence_class +' input:radio').removeAttr('disabled');
                                $('.user-action-input-boxes .chatbot-formbuton-container').addClass('single-btn-anwer-container').css({ 'text-align': 'center', 'padding': '15px' });
                                $('.user-answer').css('display', 'none');
                                $('.user-action-input-boxes .btn-save-question-answer').html('Submit');
                                $('.btn-save-question-answer').attr('disabled', true);
                            }else{
                                removeSingleButtonANswerBox();
                            }
                        }else if (current_question_type_key.length > 0 && current_question_type_key == 'multi_choice') {
                            bot_choice_ans_list_template = $('.html_for_choice_answers_list').html();
                            bot_multichoice_ans_single_tempalte = $('.html_for_multi_choice_answer').html();

                            //[CHOICE-OPTION-HTML]
                            bot_choices_que_html = "";
                            //console.log(data.data, data.data.question_options, typeof(data.data.question_options));
                            if (data.data.question_options.length > 0) {
                                $('input:radio').attr('disabled',true);
                                $('input:checkbox').attr('disabled',true);
                                $.each(data.data.question_options, function (index, value) {
                                    bot_choices_que_html_temp = bot_multichoice_ans_single_tempalte;
                                    bot_choices_que_html_temp = bot_choices_que_html_temp.replaceAll("[CHOICE-OPTION-ID]", value.id);
                                    bot_choices_que_html_temp = bot_choices_que_html_temp.replaceAll("[CHOICE-OPTION-VALUE]", value.answer_text);
                                    bot_choices_que_html_temp = bot_choices_que_html_temp.replaceAll("[QUESTION-ID]", data.data.next_que_id);
                                    bot_choices_que_html += bot_choices_que_html_temp;
                                });

                                li_index_number++;
                                bot_choice_ans_list_template = bot_choice_ans_list_template.replace("[LI-INDEX-NUMBER]", li_index_number);
                                bot_choice_ans_list_template = bot_choice_ans_list_template.replace("[CHOICE-OPTION-HTML]", bot_choices_que_html);
                                bot_choice_ans_list_template = bot_choice_ans_list_template.replace("[SEQUENCE-NUMBER]", current_sequence_number);
                                $('#question_list .data-container').append(bot_choice_ans_list_template);
                                $(current_quizbox_sequence_class +' input:checkbox').removeAttr('disabled');
                                $('.user-action-input-boxes .chatbot-formbuton-container').addClass('single-btn-anwer-container').css({ 'text-align': 'center', 'padding': '15px' });
                                $('.user-answer').css('display', 'none');
                                $('.user-action-input-boxes .btn-save-question-answer').html('Submit');
                                $('.btn-save-question-answer').attr('disabled', true);
                            }else{
                                removeSingleButtonANswerBox();
                            }
                        }else if (current_question_type_key.length > 0 && current_question_type_key == 'file') {
                            bot_file_question_list_template = $('.generate_user_file_html').html();
                            li_index_number++;
                            bot_file_question_list_template = bot_file_question_list_template.replace("[LI-INDEX-NUMBER]", li_index_number);
                            bot_file_question_list_template = bot_file_question_list_template.replace("[SEQUENCE-NUMBER]", current_sequence_number);
                            if(data.data.next_que_file_extentions && data.data.next_que_file_extentions.length > 0){
                               bot_file_question_list_template = bot_file_question_list_template.replace("[FILE-EXTENTIONS]", data.data.next_que_file_extentions);
                            }else{
                                bot_file_question_list_template = bot_file_question_list_template.replace("[FILE-EXTENTIONS]", '*');
                            }
                            $('#question_list .data-container').append(bot_file_question_list_template);
                            $('.user-action-input-boxes .chatbot-formbuton-container').addClass('single-btn-anwer-container').css({ 'text-align': 'center', 'padding': '15px' });
                            $('.user-answer').css('display', 'none');
                            $('.user-action-input-boxes .btn-save-question-answer').html('Submit');
                            $('.btn-save-question-answer').attr('disabled', true);
                        }else if (current_question_type_key.length > 0 && current_question_type_key == 'resume_file') {
                            bot_file_question_list_template = $('.generate_resume_file_html').html();
                            li_index_number++;
                            bot_file_question_list_template = bot_file_question_list_template.replace("[LI-INDEX-NUMBER]", li_index_number);
                            bot_file_question_list_template = bot_file_question_list_template.replace("[SEQUENCE-NUMBER]", current_sequence_number);
                            $('#question_list .data-container').append(bot_file_question_list_template);
                            $('.user-action-input-boxes .chatbot-formbuton-container').addClass('single-btn-anwer-container').css({ 'text-align': 'center', 'padding': '15px' });
                            $('.user-answer').css('display', 'none');
                            $('.user-action-input-boxes .btn-save-question-answer').html('Submit');
                            $('.btn-save-question-answer').attr('disabled', true);
                        }else{
                            if(current_question_type_key.length > 0 && current_question_type_key == 'zip'){
                                $('.btn-save-question-answer').attr('disabled', true);
                            }else{
                                $('.btn-save-question-answer').removeAttr('disabled');
                            }
                            $('.user-action-input-boxes .chatbot-formbuton-container').css({ 'width': '10%', 'text-align': 'unset', 'padding': 'unset' });
                            $('.user-answer').css('display', 'block');
                            $('.user-action-input-boxes .btn-save-question-answer').html('<i class="fa fa-paper-plane" aria-hidden="true"></i>');
                            removeSingleButtonANswerBox();
                        }
                    }else{
                        // $('.chatbot-form-result-container').css('display', 'block');
                        $('textarea[name=answer_text]').css('display', 'none');
                        $('.user-action-test-complete-box').removeClass('d-none');
                        $('.user-action-input-boxes').css('display', 'none');

                        //thank_you_message
                        if(data.data.accepted_rejected_message && data.data.accepted_rejected_message.length > 0){
                            data.data.accepted_rejected_message = data.data.accepted_rejected_message.replace("{name}", current_user_name);
                            data.data.accepted_rejected_message = data.data.accepted_rejected_message.replace("{Name}", current_user_name);

                            bot_question_template_temp = bot_question_template;
                            if(is_preview_screen == true){
                                li_index_number++;
                                bot_question_template_temp = bot_question_template_temp.replace("[LI-INDEX-NUMBER]", li_index_number);
                            }
                            bot_question_template_temp = bot_question_template_temp.replace("[QUESTION-TEXT]", data.data.accepted_rejected_message);
                            bot_question_template_temp = bot_question_template_temp.replace("[SEQUENCE-NUMBER]", 'accepted_rejected_message');
                            bot_question_template_temp = bot_question_template_temp.replace("[QUESTION-ID]", '');
                            bot_question_template_temp = bot_question_template_temp.replace("[TIME]", (data.data.timestamp ? tConvert(data.data.timestamp) : '')); //tConvert(data.data.timestamp)
                            $('#question_list .data-container').append(bot_question_template_temp);
                            console.log('thank you message is there.');
                            $(current_quizbox_sequence_class +'_answer .user-chat-time-div').html( (data.data.timestamp ? tConvert(data.data.timestamp) : '') );

                            $('#question_list .data-container .question_box_container_accepted_rejected_message .question-text').replaceAnchorLinks();
                        }

                        if(data.data.thank_you_message && data.data.thank_you_message.length > 0){
                            data.data.thank_you_message = data.data.thank_you_message.replace("{name}", current_user_name);
                            data.data.thank_you_message = data.data.thank_you_message.replace("{Name}", current_user_name);
                            bot_question_template_temp = bot_question_template;
                            if(is_preview_screen == true){
                                li_index_number++;
                                bot_question_template_temp = bot_question_template_temp.replace("[LI-INDEX-NUMBER]", li_index_number);
                            }
                            bot_question_template_temp = bot_question_template_temp.replace("[QUESTION-TEXT]", data.data.thank_you_message);
                            bot_question_template_temp = bot_question_template_temp.replace("[SEQUENCE-NUMBER]", 'thankyou');
                            bot_question_template_temp = bot_question_template_temp.replace("[QUESTION-ID]", '');
                            bot_question_template_temp = bot_question_template_temp.replace("[TIME]", (data.data.timestamp ? tConvert(data.data.timestamp) : '')); //tConvert(data.data.timestamp)
                            $('#question_list .data-container').append(bot_question_template_temp);
                            console.log('thank you message is there.');
                            $(current_quizbox_sequence_class +'_answer .user-chat-time-div').html( (data.data.timestamp ? tConvert(data.data.timestamp) : '') );
                            $('#question_list .data-container .question_box_container_thankyou .question-text').replaceAnchorLinks();
                            //$('.user-action-test-complete-box').addClass('d-none');
                        }

                        //$('#question_list .data-container .question_box_container_' + current_sequence_number + ' .question-text').replaceAnchorLinks();
                    }

                    scrolltoLastQuestion();
                    // alertify.success(data.message);

                    //remove current timeout - clear memory
                    clearQueTimeout(que_delay_timeout);
                }, parseInt(data.data.input_delay));
            },
            error: function(xhr){
                $(".btn-save-question-answer").attr('disabled', false);
                $('.user-action-input-text-area').val('').focus();
                let errorMessage = '';
                const values = Object.values(xhr.responseJSON.data);
                for(let index = 0; index < values.length; index++) {
                    errorMessage += values[index] + "<br/>";
                }
                let time_error_string = (xhr.responseJSON.message ? tConvert(xhr.responseJSON.message) : '');
                showErrorMessageToWidget(errorMessage, time_error_string);
            }
        });

    });
    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            e.preventDefault();
            if(e.target.id == 'answer_text_input' ) {
                $(".btn-save-question-answer").click();
            }
        }
    });


    $(document).on("click", ".current_answer_button__phone_action", function (e) {
        e.preventDefault();
        current_action_type = $(this).attr('data-type');
        if(current_action_type){
            if(current_action_type == 'refresh'){
                window.location.reload();
                return;
            }else{
                rst_phn_flw_bck = true;
                $('textarea[name=answer_text]').val('Fetching...');
                $('.user-phone-action-answer-button-container').addClass('d-none');
                $('.user-action-answer-input-container').removeClass('d-none');
                is_send_sms_to_user = false;
                $('.btn-save-question-answer').removeAttr('disabled').click();
            }
            return;
        }
    });

    $(document).on("click", ".refresh-chat-session", function (e) {
        e.preventDefault();
        window.location.reload();
    });

    $(document).on("click", "input[type=radio]", function (e) {
        $('.btn-save-question-answer').removeAttr('disabled');
    });

    $(document).on("click", "input[type=checkbox]", function (e) {
        multi_choice_class = "input[name='" + $(this).attr('name') +"']:checked";
        //console.log('current_qustion selected length ', $(multi_choice_class).length);
        if ($(multi_choice_class).length > 0) {
            $('.btn-save-question-answer').removeAttr('disabled');
        }else{
            $(".btn-save-question-answer").attr('disabled', true);
        }
    });

    $(document).on("click", ".current_answer_button_action", function (e) {
            e.preventDefault();
            current_greeting_action_value = $(this).attr('data-value');
            //console.log(current_greeting_action_value);
            $('textarea[name=answer_text]').val(current_greeting_action_value);
            $('.btn-save-question-answer').click();
        });


    function scrolltoLastQuestion() {
        let questionDIV = document.getElementById("question_list");
        //questionDIV.scrollTop = questionDIV.scrollHeight;
        $("#question_list").animate({ scrollTop: questionDIV.scrollHeight}, 1000);
    }

    function tConvert(tim_val) {
        try {
            // Check correct time format and split into components
            time = tim_val.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [tim_val];

            if (time.length > 1) { // If time format correct
                time = time.slice (1);  // Remove full string match value
                time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
                time[0] = +time[0] % 12 || 12; // Adjust hours
            }
            time[3] = ' ';
            return time.join (''); // return adjusted time or original string
        } catch (error) {
            return time.substring(0, 5);
        }
    }

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    function clearQueTimeout(timeout){
        clearTimeout(timeout);
    }
    function checkAndEnableSubmitButton(key = 'resume_file'){
        if($(current_quizbox_sequence_class + ' input[name=' + key +']')[0].files.length > 0){
            $('.btn-save-question-answer').removeAttr('disabled');
        }else{
            $('.btn-save-question-answer').attr('disabled', true);
        }
    }

    function removeSingleButtonANswerBox(){
        $('.user-action-input-boxes .chatbot-formbuton-container').removeClass('single-btn-anwer-container');
    }

    function showErrorMessageToWidget(errorMessage, time_string, removeDisabledAttribute = true){
        if(removeDisabledAttribute == true){
            $('.user-action-input-text-area').val('').focus();
            $(".btn-save-question-answer").attr('disabled', false);
        }else{
            $(".btn-save-question-answer").attr('disabled', true);
        }

        bot_question_template_temp = bot_question_template;
        if(is_preview_screen == true){
            li_index_number++;
            bot_question_template_temp = bot_question_template_temp.replace("[LI-INDEX-NUMBER]", li_index_number);
        }
        bot_question_template_temp = bot_question_template_temp.replace("[QUESTION-TEXT]", errorMessage);
        bot_question_template_temp = bot_question_template_temp.replace("[SEQUENCE-NUMBER]", '');
        bot_question_template_temp = bot_question_template_temp.replace("[QUESTION-ID]", '');
        bot_question_template_temp = bot_question_template_temp.replace("[TIME]", time_string); //tConvert(data.data.timestamp)
        $('#question_list .data-container').append(bot_question_template_temp);
        scrolltoLastQuestion();
        $(current_quizbox_sequence_class +'_answer .user-chat-time-div').html(time_string);
    }

    function getCurrentTimeString(){
        var current_time_string = new Date().toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
        return tConvert(current_time_string);
    }

    $( document ).ready(function() {
       setTimeout(() => {
        scrolltoLastQuestion();
       }, 1500);
    });
</script>
