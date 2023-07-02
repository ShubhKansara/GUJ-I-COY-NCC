<script>
    function parse_question_data(current_element, choice_class = '.user_choice_answer', pending_question = false) {
        response = { 'data': {}, 'status' : true, 'message': '', 'current_question_id' : ''};
        current_question_id = null;
        try {
            //check next element id delay and value is 0
            console.log(current_element.attr('data-que-id'), current_element.next().hasClass('delay_question_box'), current_element.next().find('.edit_input_delay').val());
            if(current_element.next().hasClass('delay_question_box') && (current_element.next().find('.edit_input_delay').val() == '' || current_element.next().find('.edit_input_delay').val() == '0') ){
                //console.log('Delay value is 0');
                throw "Delay value is required";
            }

            temp = {};
            if(pending_question == false){
                current_question_id = current_element.attr('data-que-id');
                temp.id = current_question_id;
            }else{
                current_question_id = current_element.attr('data-que-id');
                temp.temp_que_id = current_question_id;
            }
            response.current_question_id = current_question_id;
            console.log('processing ', current_question_id);

            temp.question_type_id = current_element.find('.edit_question_type_id').val();
            temp.question_text = current_element.find('.edit_question_text').val().trim();
            temp.column_name = current_element.find('.edit_column_name').val().trim();
            temp.distance = current_element.find('.edit_distance').val().trim();
            temp.zip_code = current_element.find('.edit_zip_code').val().trim();
            temp.file_extentions = current_element.find('.edit_file_extetions').val().trim();
            if (temp.question_text.length <= 0) {
                throw "Question Text is Required";
            }
            if (temp.column_name.length <= 0) {
                throw "Column Name is Required";
            }

            if (current_element.find('.edit_question_type_id').val() == question_type_ids_list['zip']){
                if(temp.zip_code.length <= 0){
                    throw "Zip Code Value is Required";
                }else if(temp.distance.length <= 0){
                    throw "Distance Value is Required";
                }
            }

            //if choice option - then process and store to options array
            if (current_element.find('.edit_question_type_id').val() == choice_question_id || current_element.find('.edit_question_type_id').val() == question_type_ids_list['number']) {
                $is_pending_save_choice_answers = false;
                temp.question_options = [];
                $crr_que_type = (current_element.find('.edit_question_type_id').val() == choice_question_id) ? 'choice': 'number';
                choice_class = '.choice_answers_list ' + choice_class;
                //console.log('found user choice', choice_class , current_element.find('.edit_question_type_id').val(), $crr_que_type, current_element.find(choice_class).length);
                current_element.find(choice_class).each(function() {
                    if (pending_question == true && typeof($(this).attr('data-delete')) != undefined && $(this).attr('data-delete') == '1') {
                        return;
                    }
                    temp_choice = {};

                    check_pending_question_text = true;
                    //if already stored choice option - then add ids and is delete thing
                    if(pending_question == false){
                        temp_choice.id = $(this).attr('data-option-id');
                        temp_choice.question_id = current_question_id;
                        temp_choice.is_delete = $(this).attr('data-delete');
                        if (temp_choice.is_delete == 1) {
                            check_pending_question_text = false;
                        }
                    }

                    if($crr_que_type == 'choice'){
                        temp_choice.answer_text = $(this).find('.choice_answer_input-box').val().trim();
                    }else{
                        temp_choice.answer_text = $(this).find('.number_start_range').val().trim();
                        if ($(this).find('.number_end_range').val().trim().length > 0) {
                            temp_choice.answer_text +=  '-' + $(this).find('.number_end_range').val().trim();
                        }
                    }
                    if (check_pending_question_text == true && temp_choice.answer_text.length <= 0) {
                        $is_pending_save_choice_answers = true;
                        return false;
                    }
                    temp_choice.answer_weight = $(this).find('.choice_answer_weight').val();
                    temp_choice.answer_next_question = ($(this).find('.choice_answer_next_coumn').val() != '-1') ? $(this).find('.choice_answer_next_coumn').val() : '';
                    temp.question_options.push(temp_choice);
                });

                if ($is_pending_save_choice_answers) {
                    throw "Choice Answer Text is Required";
                }

                if(temp.question_options.length <= 0){
                    throw "Choice Options are Required";
                }
            }

            //process multi choice question value
            if (current_element.find('.edit_question_type_id').val() == multi_choice_question_id) {
                $is_pending_save_choice_answers = false;
                temp.question_options = [];
                choice_class = '.multichoice_answers_list ' + choice_class;
                //console.log('found user multi choice', choice_class, current_element.find(choice_class).length);
                current_element.find(choice_class).each(function() {
                    if (pending_question == true && typeof($(this).attr('data-delete')) != undefined && $(this).attr('data-delete') == '1') {
                        return;
                    }
                    temp_choice = {};

                    check_pending_question_text = true;
                    //if already stored choice option - then add ids and is delete thing
                    if(pending_question == false){
                        temp_choice.id = $(this).attr('data-option-id');
                        temp_choice.question_id = current_question_id;
                        temp_choice.is_delete = $(this).attr('data-delete');
                        if (temp_choice.is_delete == 1) {
                            check_pending_question_text = false;
                        }
                    }
                    temp_choice.answer_text = $(this).find('.choice_answer_input-box').val().trim();
                    if (check_pending_question_text == true && temp_choice.answer_text.length <= 0) {
                        $is_pending_save_choice_answers = true;
                        return false;
                    }
                    temp_choice.answer_weight = $(this).find('.choice_answer_weight').val();
                    temp_choice.answer_next_question = '';
                    //console.log(temp_choice);
                    temp.question_options.push(temp_choice);
                });

                if ($is_pending_save_choice_answers) {
                    throw "Choice Answer Text is Required";
                }

                if(temp.question_options.length <= 0){
                    throw "Choice Options are Required";
                }
            }

            if(current_element.next().hasClass('delay_question_box') ){
                temp.input_delay = current_element.next().find('.edit_input_delay').val().trim();
                if(current_element.next().next().hasClass('delay_question_box')){
                    next_2nd_delay_value = current_element.next().next().find('.edit_input_delay').val().trim();
                    if(parseInt(next_2nd_delay_value) > parseInt(temp.input_delay)){
                        temp.input_delay = next_2nd_delay_value;
                    }
                    alertify.notify('Continuous delay question\'s found, storing bigger one. other will ignored.', 'custom-alertify', 5, function(){console.log('dismissed');});
                    window.prevent_loading_show_delay_message = true;
                }
            }else{
                temp.input_delay = 0;
            }

            //temp.input_delay = (current_element.find('input[name=edit_input_delay]').val().trim().length <= 0) ? '0' : current_element.find('input[name=edit_input_delay]').val().trim();
            temp.next_question_id = (current_element.find('.edit_parent_next_column').val() != '-1') ? current_element.find('.edit_parent_next_column').val() : '';
            temp.is_critical = (current_element.find('input[name=edit_is_critical]').is(':checked')) ? 1 : 0;
            temp.is_neutral = (current_element.find('input[name=edit_is_neutral]').is(':checked')) ? 1 : 0;
            temp.create_mode = current_element.attr('data-create-mode').trim();
            temp.error_message = current_element.find('.edit_question_error_message').val().trim();
            temp.response_text = current_element.find('.edit_question_response_text').val().trim();
            temp.regular_expression = current_element.find('.edit_question_regex').val().trim();
            response.data = temp;
        } catch (e) {
            console.log('error found -> ', e);
            response.status = false;
            response.message = e;
        }
        return response;
    }
</script>
