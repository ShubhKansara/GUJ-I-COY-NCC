<script>
    last_next_que_modal_zindex = 1050;

    $(document).on('change', '.edit_question_type_id', function() {
        if(this.value && this.value == multi_choice_question_id){
            //console.log('its multi choice ques user', multi_choice_question_id);
            $(this).closest('.main_que_list_box').find('.edit_multi_choice_input_box').removeClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_choice_input_box').addClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_question_error_message_box').addClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_question_response_text_box').addClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_parent_next_column_box').removeClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_zip_code_box').addClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_distance_box').addClass('d-none');
        }else if(this.value && (this.value == choice_question_id || this.value == question_type_ids_list['number']) ){
            //console.log('its choice ques user', choice_question_id);
            $(this).closest('.main_que_list_box').find('.edit_choice_input_box').removeClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_multi_choice_input_box').addClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_question_response_text_box').addClass('d-none');
            $(this).closest('.main_que_list_box').find('.choice_answers_list .user_choice_answer').remove();
            $(this).closest('.main_que_list_box').find('.edit_zip_code_box').addClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_distance_box').addClass('d-none');
            if(this.value == choice_question_id){
                $(this).closest('.main_que_list_box').find('.edit_question_error_message_box').addClass('d-none');
                //$(this).closest('.main_que_list_box').find('.edit_parent_next_column_box').addClass('d-none');
                $(this).closest('.main_que_list_box').find('.edit_number_options_label_box').addClass('d-none');
                $(this).closest('.main_que_list_box').find('.edit-add-more-choice-button').attr('data-question-type', 'choice');
                $(this).closest('.main_que_list_box').find('.edit_number_options_first_box, .edit_header_number_value_second_box').addClass('d-none');
                $(this).closest('.main_que_list_box').find('.edit_choice_options_first_box, .edit_header_choice_value_first_box').removeClass('d-none');
            }else{
                $(this).closest('.main_que_list_box').find('.edit_question_error_message_box').removeClass('d-none');
                //$(this).closest('.main_que_list_box').find('.edit_parent_next_column_box').removeClass('d-none');
                $(this).closest('.main_que_list_box').find('.edit_number_options_label_box').removeClass('d-none');
                $(this).closest('.main_que_list_box').find('.edit-add-more-choice-button').attr('data-question-type', 'number');
                $(this).closest('.main_que_list_box').find('.edit_number_options_first_box, .edit_header_number_value_second_box').removeClass('d-none');
                $(this).closest('.main_que_list_box').find('.edit_choice_options_first_box, .edit_header_choice_value_first_box').addClass('d-none');
            }
            $(this).closest('.main_que_list_box').find('.edit_parent_next_column_box').addClass('d-none');
        }else{
            //console.log('its other question user', this.value);
            $(this).closest('.main_que_list_box').find('.edit_multi_choice_input_box').addClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_choice_input_box').addClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_question_error_message_box').removeClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_question_response_text_box').removeClass('d-none');
            $(this).closest('.main_que_list_box').find('.edit_parent_next_column_box').removeClass('d-none');
            if(this.value == question_type_ids_list['zip']){
                $(this).closest('.main_que_list_box').find('.edit_zip_code_box').removeClass('d-none');
                $(this).closest('.main_que_list_box').find('.edit_distance_box').removeClass('d-none');
            }else{
                $(this).closest('.main_que_list_box').find('.edit_zip_code_box').addClass('d-none');
                $(this).closest('.main_que_list_box').find('.edit_distance_box').addClass('d-none');
            }
            if(this.value == question_type_ids_list['file']){
                $(this).closest('.main_que_list_box').find('.edit_file_extentions_box').removeClass('d-none');
            }else{
                $(this).closest('.main_que_list_box').find('.edit_file_extentions_box').addClass('d-none');
            }
        }
        $(this).closest('.main_que_list_box').find('.edit_parent_next_column').val('-1').trigger('change');
    });

    $( "#new_question_type_id" ).change(function() {
        if (this.value && this.value == multi_choice_question_id){
            //console.log('its choice ques', multi_choice_question_id);
            $('.new_multi_choice_input_box').removeClass('d-none');
            $('.new_parent_next_column_box').removeClass('d-none');
            $('.new_choice_input_box').addClass('d-none');
            $('.new_question_error_message_box').addClass('d-none');
            $('.new_question_response_text_box').addClass('d-none');
            $('.new_parent_next_column').val('-1').trigger('change');
            $('.new_delay_input_box').addClass('d-none');
            $('.new_question_text_box').removeClass('d-none');
            $('.new_question_choice_text_box').removeClass('d-none');
            $('.new_column_name_box').removeClass('d-none');
            $('.new_parent_next_column_box label').text('Next Question Column Name');
            $('.new_parent_next_column_box small').text('Select the question that should come next.');
            $('.new_zip_code_box').addClass('d-none');
            $('.new_distance_box').addClass('d-none');
        }else if(this.value && (this.value == choice_question_id || this.value == question_type_ids_list['number'])){
            //console.log('its choice/number ques', choice_question_id);
            $('.new_choice_input_box').removeClass('d-none');
            $('.new_multi_choice_input_box').addClass('d-none');
            $('.new_question_response_text_box').addClass('d-none');
            $('.new_zip_code_box').addClass('d-none');
            $('.new_distance_box').addClass('d-none');
            $('.new_delay_input_box').addClass('d-none');
            $('.new_question_text_box').removeClass('d-none');
            $('.new_question_choice_text_box').removeClass('d-none');
            $('.new_column_name_box').removeClass('d-none');
            $('.new_parent_next_column_box label').text('Next Question Column Name');
            $('.new_parent_next_column_box small').text('Select the question that should come next.');
            if(this.value == question_type_ids_list['choice']){
                $('.new-add-more-choice-button').attr('data-question-type', 'choice');
                $('.new_question_error_message_box').addClass('d-none');
                $('.new_number_options_label_box').addClass('d-none');
                $('.new_number_options_first_box, .new_header_number_value_second_box').addClass('d-none');
                $('.new_choice_options_first_box, .new_header_choice_value_first_box').removeClass('d-none');
                //$('.new_parent_next_column_box').addClass('d-none');
            }else{
                //console.log('its number question');
                $('.new-add-more-choice-button').attr('data-question-type', 'number');
                $('.new_question_error_message_box').removeClass('d-none');
                $('.new_number_options_label_box').removeClass('d-none');
                $('.new_number_options_first_box, .new_header_number_value_second_box').removeClass('d-none');
                $('.new_choice_options_first_box, .new_header_choice_value_first_box').addClass('d-none');
                //$('.new_parent_next_column_box').removeClass('d-none');
            }
            $('.new_parent_next_column_box').addClass('d-none');
            $('.new-questions-list-container .choice_answers_list .pending_choice_answer').remove();
        }else if(this.value && this.value == delay_question_id){
            $('.new_delay_input_box').removeClass('d-none');
            $('.new_multi_choice_input_box').addClass('d-none');
            $('.new_choice_input_box').addClass('d-none');
            $('.new_question_error_message_box').addClass('d-none');
            $('.new_question_response_text_box').addClass('d-none');
            $('.new_question_text_box').addClass('d-none');
            $('.new_question_choice_text_box').addClass('d-none');
            $('.new_column_name_box').addClass('d-none');
            $('.new_parent_next_column_box').addClass('d-none');
            $('.new_zip_code_box').addClass('d-none');
            $('.new_distance_box').addClass('d-none');
            /* $('.new_parent_next_column_box').removeClass('d-none');
            $('.new_parent_next_column_box label').text('Select Question For Delay');
            $('.new_parent_next_column_box small').text(''); */
        }else{
            //console.log('its other question', this.value);
            $('.new_delay_input_box').addClass('d-none');
            $('.new_multi_choice_input_box').addClass('d-none');
            $('.new_choice_input_box').addClass('d-none');
            $('.new_question_error_message_box').removeClass('d-none');
            $('.new_question_response_text_box').removeClass('d-none');
            $('.new_parent_next_column_box').removeClass('d-none');
            $('.new_question_text_box').removeClass('d-none');
            $('.new_question_choice_text_box').removeClass('d-none');
            $('.new_column_name_box').removeClass('d-none');
            $('.new_parent_next_column_box label').text('Next Question Column Name');
            $('.new_parent_next_column_box small').text('Select the question that should come next.');
            if(this.value == question_type_ids_list['zip']){
                $('.new_zip_code_box').removeClass('d-none');
                $('.new_distance_box').removeClass('d-none');
            }else{
                $('.new_zip_code_box').addClass('d-none');
                $('.new_distance_box').addClass('d-none');
            }
            if(this.value == question_type_ids_list['file']){
                $('.new_file_extentions_box').removeClass('d-none');
            }else{
                $('.new_file_extentions_box').addClass('d-none');
            }
        }
        $('.new_parent_next_column_box .new_parent_next_column').val('-1').trigger('change');
    });

    $("a").click(function(ev) {
        ev.preventDefault();
        clicked_current_url = $(this).attr('href');
        if(clicked_current_url == 'undefined' || clicked_current_url == undefined){
            return;
        }
        checkAndReloadClickedUrl(clicked_current_url);
    });

    $(function() {
        $( "#user_question_list_ul" ).sortable({
            connectWith: ".connectedSortable",
            cursor: 'move',
            opacity: 0.6,
        }).disableSelection();

        $( ".connectedSortable" ).on( "sortupdate", function( event, ui ) {
            var updatedQueListOrder = [];
            $("#user_question_list_ul .main_que_list_box").each(function( index ) {
                updatedQueListOrder[index] = $(this).attr('data-que-id');
            });

            current_sequence_orderlist = updatedQueListOrder;
            //console.log(current_sequence_orderlist);
            updateDetailsChangedFlags();
            updatedQueListOrder = null;
            return;
        });
    });

    $(document).on('click', '.delete_choice_answer_input', function (e) {
        e.preventDefault();
        $(this).closest('li').addClass('d-none').attr('data-delete', '1');
    });

    $(document).on('click', '.button_delete_delay_question', function (e) {
        e.preventDefault();
        $(this).closest('.delay_question_box').remove();
    });

    $(document).on('click', '.button_delete_question', function (e) {
        e.preventDefault();
        var question_id_box = $(this).attr('data-question-id');
        var que_mode = $(this).attr('data-mode');
        if (typeof(que_mode) != undefined && que_mode == 'draft') {
            //console.log('delete called',question_id_box,que_mode);
            $(this).closest('li').remove();
            if(current_sequence_orderlist && current_sequence_orderlist.length > 0){
                //console.log('removed qustion from sequence list');
                var index = current_sequence_orderlist.indexOf(question_id_box);
                if (index !== -1) {
                    current_sequence_orderlist.splice(index, 1);
                }
            }
            removeOptionsFromNextQuestionColumn(question_id_box);
            return;
        }

        // $(".choice_answer_next_coumn option[value='X']").remove();
        is_delete_allow = true;
        $(".choice_answer_next_coumn, .edit_parent_next_column").each(function() {
            if ($(this).val() && $(this).val() == question_id_box) {
                //console.log('not allowed -> ', $(this).val());
                is_delete_allow = false;
                return;
            }
        });

        if(is_delete_allow == false){
            alertify.error('Question already linked with other question.');
            return;
        }

        bootbox.confirm("@lang('boilerplate::chatbot.list.confirmdeleteque')", function (result) {
            if (result === false) return;
            $.ajax({
                url: "{{ route('boilerplate.chatbots-questions.index') }}/" + question_id_box,
                method: 'delete',
                data: current_page_delete_question_object,
                success: function(data) {
                    alertify.success('Question deleted sucessfully.');
                    $(".li_que_"+question_id_box).remove();
                    removeOptionsFromNextQuestionColumn(question_id_box);
                },
                error: function(xhr){
                    let errorMessage = '';
                    if (typeof(xhr.responseJSON.data) == 'undefined') {
                        errorMessage = xhr.responseJSON.message;
                    }else{
                        const values = Object.values(xhr.responseJSON.data);
                        for(let index = 0; index < values.length; index++) {
                            errorMessage += values[index] + (index > 0 ? "<br/>" : '');
                        }
                    }
                    //console.log(errorMessage);
                    alertify.error(errorMessage, 5, function(){  console.log('dismissed'); });
                }
            });
        });
    });

    $(document).on('click', '.save_new_question', function (e) {
        e.preventDefault();

        if ($('#new_question_type_id').val() == delay_question_id) {
            if($('#new_input_delay').val().trim() == '' || $('#new_input_delay').val().trim() == '0'){
                alertify.error('Delay value is required.');
                return;
            }
                //console.log('its slected question id', $('.new_parent_next_column').val(), $('#new_input_delay').val().trim());
            deleay_generated_box_html = $('.generate_delay_question_box').html();
            deleay_generated_box_html = deleay_generated_box_html.replaceAll("[QUESTION-ID]", '-1');
            deleay_generated_box_html = deleay_generated_box_html.replaceAll("[DELAY-VALUE]", $('#new_input_delay').val().trim());

            $(".questions_list_ul").append(deleay_generated_box_html);
            alertify.success('Delay Added Succesfully.');
            resetNewQuestionForm();
            return;
        }

        /* if($('#new_column_name').val().trim().length <= 0){
            $('#new_column_name').val('Question ' + ($(".questions_list_ul .main_que_list_box").length + 1));
        } */

        if ($('#new_column_name').val().trim().length <= 0) {
            alertify.error('Column Name is Required');
            return;
        }

        if ($('#new_question_type_id').val() == question_type_ids_list['zip']){
            if($('#new_zip_code').val().trim().length <= 0){
                alertify.error('Zip Code Value is Required');
                return;
            }else if($('#new_distance').val().trim().length <= 0){
                alertify.error('Distance Value is Required');
                return;
            }
        }

        question_options = [];
        is_new_que_choice_question = false;
        is_new_que_multichoice_question = false;

        //new-questions-list-container
        if ($('#new_question_type_id').val() == choice_question_id || $('#new_question_type_id').val() == question_type_ids_list['number']) {
            is_new_que_choice_question = true;
            $crr_que_type = ($('#new_question_type_id').val() == choice_question_id) ? 'choice': 'number';
            //console.log('its choice question');
            $is_pending_save_choice_answers = false;
            new_question_options_count = 0;
            $(".new-questions-list-container .choice_answers_list .pending_choice_answer").each(function() {
                if($(this).find('.delete_choice_answer_input').closest('.pending_choice_answer').attr('data-delete') && $(this).find('.delete_choice_answer_input').closest('.pending_choice_answer').attr('data-delete') == '1'){
                    return true;
                }
                temp_choice = {};
                if($crr_que_type == 'choice'){
                    temp_choice.answer_text = $(this).find('.choice_answer_input-box').val().trim();
                }else{
                    temp_choice.answer_text = $(this).find('.number_start_range').val().trim();
                    if ($(this).find('.number_end_range').val().trim().length > 0) {
                        temp_choice.answer_text +=  '-' + $(this).find('.number_end_range').val().trim();
                    }
                }
                if (temp_choice.answer_text.length <= 0) {
                    $is_pending_save_choice_answers = true;
                    return;
                }
                temp_choice.answer_weight = $(this).find('.choice_answer_weight').val();
                temp_choice.answer_next_question = ($(this).find('.choice_answer_next_coumn').val() != '-1') ? $(this).find('.choice_answer_next_coumn').val() : '';
                question_options.push(temp_choice);
                new_question_options_count++;
            });
            if ($is_pending_save_choice_answers == true) {
                alertify.error('Choice Answer Text Required');
                return;
            }
            if(new_question_options_count <= 0){
                alertify.error('Choice Options are Required.');
                return;
            }
            //console.log('question optins', question_options);
        }else if ($('#new_question_type_id').val() == multi_choice_question_id) {
            is_new_que_multichoice_question = true;
            //console.log('its multichoice question');
            $is_pending_save_choice_answers = false;
            new_question_options_count = 0;
            $(".new-questions-list-container .multichoice_answers_list .pending_choice_answer").each(function() {
                if($(this).find('.delete_choice_answer_input').closest('.pending_choice_answer').attr('data-delete') && $(this).find('.delete_choice_answer_input').closest('.pending_choice_answer').attr('data-delete') == '1'){
                    return true;
                }
                temp_choice = {};
                temp_choice.answer_text = $(this).find('.choice_answer_input-box').val().trim();
                if (temp_choice.answer_text.length <= 0) {
                    $is_pending_save_choice_answers = true;
                    return;
                }
                //temp_choice.answer_weight = 0;
                temp_choice.answer_weight = $(this).find('.choice_answer_weight').val();
                temp_choice.answer_next_question = '';
                question_options.push(temp_choice);
                new_question_options_count++;
            });
            if ($is_pending_save_choice_answers == true) {
                alertify.error('Choice Answer Text Required');
                return;
            }
            if(new_question_options_count <= 0){
                alertify.error('Choice Options are Required.');
                return;
            }
            //console.log('question optins', question_options);
        }else{
            //console.log('its other question');
        }

        //var href = $(this).attr('href');
        temp_question_id = makeid(6);
        //console.log('generated que id ', temp_question_id, $('#new_question_type_id').val());
        li_card_html = $('.generated_temp_que_div_html').html();

        //update values
        //[QUESTION-ID] [QUESTION-TEXT] [QUESTION-TYPE-ID] [REGEX-VALIDATION] [RESPONSE-TEXT] [ERROR-MESSAGE]
        badge_html = '<span class="question-type-badge question-badge">[QUESTION-TYPE-TEXT]</span>';
        if ($('input[name=new_is_critical]').is(':checked')) {
            badge_html += '<span class="question-badge question-badge-danger ml-2">Critical</span>';
        }
        if ($('input[name=new_is_neutral]').is(':checked')) {
            badge_html += '<span class="question-badge question-badge-info ml-2">Neutral</span>';
        }

        li_card_html = li_card_html.replaceAll("[QUESTION-BADGE]", badge_html);
        li_card_html = li_card_html.replaceAll("[CLASS-NAME]", 'pending_save_question');
        li_card_html = li_card_html.replaceAll("[QUESTION-ID]", temp_question_id);
        li_card_html = li_card_html.replaceAll("[QUESTION-TEXT]", $('#new_question_text').val().trim());
        li_card_html = li_card_html.replaceAll("[QUESTION-TYPE-ID]", $('#new_question_type_id').val());
        li_card_html = li_card_html.replaceAll("[RESPONSE-TEXT]", $('#new_question_response_text').val().trim());
        li_card_html = li_card_html.replaceAll("[ERROR-MESSAGE]", $('#new_question_error_text').val().trim());
        li_card_html = li_card_html.replaceAll("[REGEX-VALIDATION]", $('#new_question_regex').val().trim());
        li_card_html = li_card_html.replaceAll("[COLUMN-NAME]", $('#new_column_name').val().trim());
        li_card_html = li_card_html.replaceAll("[ZIP-CODE]", $('#new_zip_code').val().trim());
        li_card_html = li_card_html.replaceAll("[DISTANCE]", $('#new_distance').val().trim());
        li_card_html = li_card_html.replaceAll("[FILE-EXTENTIONS]", $('#new_file_extetions').val().trim());
        new_que_type_key = 'text';
        if($('#new_question_type_id').val() && findWithAttr(question_type_list, 'id', parseInt($('#new_question_type_id').val())) != -1){
            new_que_type_key = question_type_list[findWithAttr(question_type_list, 'id', parseInt($('#new_question_type_id').val()))].question_type_name;
        }
        li_card_html = li_card_html.replaceAll("[QUESTION-TYPE-TEXT]", new_que_type_key);

        $(".questions_list_ul").append(li_card_html);
        setTimeout(() => {
            $('.li_que_' + temp_question_id +' .edit_question_type_id, .li_que_' + temp_question_id +' .edit_parent_next_column').select2({
                minimumResultsForSearch : -1
            });
            $('.li_que_' + temp_question_id +' .select2').css('width', '100%');
            $('.li_que_' + temp_question_id +' .edit_question_type_id').val($('#new_question_type_id').val()).trigger('change');
            $('.li_que_' + temp_question_id +' .edit_input_delay').val($('#new_input_delay').val().trim());
            $('.li_que_' + temp_question_id +' .edit_parent_next_column').val($('.new_parent_next_column').val()).trigger('change');

            if ($('input[name=new_is_critical]').is(':checked')) {
                $('.li_que_' + temp_question_id + ' .edit_is_critical').prop('checked', true);
            }
            if ($('input[name=new_is_neutral]').is(':checked')) {
                $('.li_que_' + temp_question_id + ' .edit_is_neutral').prop('checked', true);
            }
            if (is_new_que_choice_question == true) {
                $('.li_que_' + temp_question_id + ' .edit_question_error_message_box, .li_que_' + temp_question_id + ' .edit_question_response_text_box').addClass('d-none');
                $('.li_que_' + temp_question_id + ' .edit_choice_input_box').removeClass('d-none');
                $('.li_que_' + temp_question_id + ' .edit_multichoice_input_box').addClass('d-none');
                $('.li_que_' + temp_question_id + ' .edit_parent_next_column_box').addClass('d-none');
                $('.li_que_' + temp_question_id + ' .edit_parent_next_column').val('-1').trigger('change');
                //$('.li_que_' + temp_question_id + ' .edit_question_type_id').attr('disabled', true);

                if ($crr_que_type == 'choice') {
                    $('.li_que_' + temp_question_id + ' .edit-add-more-choice-button').attr('data-question-type', 'choice');
                }else{
                    $('.li_que_' + temp_question_id + ' .edit-add-more-choice-button').attr('data-question-type', 'number');
                }

                question_options.forEach(element => {
                    //console.log('element', element);
                    addMoreAsnwerToChoices('li_que_' + temp_question_id, element, 'pending_choice_answer', $crr_que_type);
                });
            }else if (is_new_que_multichoice_question == true) {
                $('.li_que_' + temp_question_id + ' .edit_question_error_message_box, .li_que_' + temp_question_id + ' .edit_question_response_text_box').addClass('d-none');
                $('.li_que_' + temp_question_id + ' .edit_choice_input_box').addClass('d-none');
                $('.li_que_' + temp_question_id + ' .edit_multichoice_input_box').removeClass('d-none');
                $('.li_que_' + temp_question_id + ' .edit_parent_next_column_box').removeClass('d-none');
                $('.li_que_' + temp_question_id + ' .edit_parent_next_column').val('-1').trigger('change');
                //$('.li_que_' + temp_question_id + ' .edit_question_type_id').attr('disabled', true);
                question_options.forEach(element => {
                    //console.log('element', element);
                    addMoreAsnwerToMultiChoiceChoices('li_que_' + temp_question_id, element);
                });
            }else{
                //console.log('otehr');
                $('.li_que_' + temp_question_id + ' .edit_question_error_message_box', '.li_que_' + temp_question_id + ' .edit_question_response_text_box').removeClass('d-none');
                $('.li_que_' + temp_question_id + ' .edit_choice_input_box').addClass('d-none');

                if(new_que_type_key == 'zip'){
                    $('.li_que_' + temp_question_id + ' .new_zip_code_box').removeClass('d-none');
                    $('.li_que_' + temp_question_id + ' .new_distance_box').removeClass('d-none');
                }else{
                    $('.li_que_' + temp_question_id + ' .new_zip_code_box').addClass('d-none');
                    $('.li_que_' + temp_question_id + ' .new_distance_box').addClass('d-none');
                }
            }

            if($('#new_column_name').val().trim().length > 0){
                addNewOptionToChoiceQuestions(temp_question_id, $('#new_column_name').val().trim());
            }
            resetNewQuestionForm();
            alertify.success('Question Added to Draft Mode.');
            if(is_save_details_button_click_pending && is_save_details_button_click_pending == true){
                is_save_details_button_click_pending = false;
                $('.btn-save-chatbot-info').click();
            }
        }, 100);
        return true;
    });

    function checkAndReloadClickedUrl(clicked_current_url) {
        //console.log(clicked_current_url, is_details_changes);
        if (is_details_changes == true && is_exit_modal_shown == false) {
            is_exit_modal_shown = true;
            bootbox.confirm({
                closeButton: false,
                message: "@lang('boilerplate::chatbot.edit.confirmDiscardChanges')",
                buttons: {
                    cancel: {
                        label: 'Ok',
                        className: 'btn-default'
                    },
                    confirm: {
                        label: 'Save & Exit',
                        className: 'btn-primary'
                    }
                },
                callback: function (result) {
                    //console.log('popup resule -> ', result);
                    if(is_esc_button_pressed == true){
                        is_esc_button_pressed= false;
                        is_exit_modal_shown = false;
                        window.last_clicked_current_url = '';
                        return;
                    }
                    if (result == true){
                        $('.btn-save-chatbot-info').click();
                        window.last_clicked_current_url = clicked_current_url;
                        is_details_changes = false;
                        is_exit_modal_shown = false;
                        return;
                    }
                    //console.log('redrect called');
                    window.location.href = clicked_current_url;
                }
            });
        }else if(is_exit_modal_shown == false && is_details_changes == false){
            //console.log('called else');
            window.location.href = clicked_current_url;
        }
    }

    function findWithAttr(array, attr, value) {
        for(var i = 0; i < array.length; i += 1) {
            if(array[i][attr] === value) {
                return i;
            }
        }
        return -1;
    }

    function resetNewQuestionForm() {
        $('#new_question_text').val('');
        $('#new_question_regex').val('');
        $('#new_question_error_text').val('');
        $('#new_question_response_text').val('');
        $('#new_column_name').val('');
        $('#new_zip_code').val('');
        $('#new_distance').val('');
        $('#new_input_delay').val('0');
        $('input[name=new_is_critical]').prop('checked', false);
        $('input[name=new_is_neutral]').prop('checked', false);
        $('#new_question_type_id').val('{{ $textQuestionIndex }}').trigger('change');
        $('.new-questions-list-container .choice_answers_list .pending_choice_answer').remove();
        $('.new-questions-list-container .multichoice_answers_list .pending_choice_answer').remove();
        $('.new_parent_next_column').val('-1').trigger('change');
    }

    function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    function addNewOptionToChoiceQuestions(que_id, col_name){
        $(".choice_answer_next_coumn, .n_next_column, .new_parent_next_column, .edit_parent_next_column").each(function() {
            //console.log($(this), que_id, col_name);
            $(this).append($('<option>', {value: que_id, text: col_name}));
        });
    }

    function removeOptionsFromNextQuestionColumn(que_id){
        $(".choice_answer_next_coumn, .n_next_column, .new_parent_next_column, .edit_parent_next_column").each(function() {
            //console.log($(this), 'removing option -> ' + que_id);
            $(this).find("option[value='"+ que_id +"']").remove();
        });
    }

    function addMoreAsnwerToMultiChoiceChoices(parent_class_name, data = {}, replace_li_class_name  = 'pending_choice_answer'){
        temp_html = $('.generate_multichoice_option_html').html();
        temp_html = temp_html.replaceAll('[LI-CLASS-NAME]', replace_li_class_name);
        temp_html = temp_html.replaceAll('[CHOICE-CLASS]', 'choice_answer_weight');
        $('.' + parent_class_name + ' .multichoice_answers_list').append(temp_html);
        $('.' + parent_class_name + ' .multichoice_answers_list .temp_html_choice  .choice_answer_weight').select2({
            minimumResultsForSearch : -1
        });
        $('.' + parent_class_name + ' .multichoice_answers_list .temp_html_choice .select2').css('width', '100%');
        //console.log(parent_class_name, typeof(data) == 'object', Object.keys(data).length);
        if (typeof(data) == 'object' && Object.keys(data).length > 0) {
            //console.log('data is not empty', data);
            //$('.' + parent_class_name + ' .multichoice_answers_list .pending_choice_answer').remove();
            $('.' + parent_class_name + ' .multichoice_answers_list .temp_html_choice .choice_answer_input-box').val(data.answer_text);
            $('.' + parent_class_name + ' .multichoice_answers_list .temp_html_choice .choice_answer_weight').val(data.answer_weight).trigger('change');
            //console.log('updated data');
        }
        $('.' + parent_class_name + ' .multichoice_answers_list .temp_html_choice .choice_answer_input-box').focus();
        $('.' + parent_class_name + ' .multichoice_answers_list .temp_html_choice').removeClass('temp_html_choice');
    }


    $(document).on('click', '.new_create_next_question_column', function (e) {
        e.preventDefault();
        var temp_modal_html = $('.generated_create_next_que_modal_html').html();

        temp_question_id = makeid(6);
        temp_modal_html = temp_modal_html.replaceAll("[CLASS-NAME]", 'pending_save_question');
        temp_modal_html = temp_modal_html.replaceAll("[QUESTION-ID]", temp_question_id);

        $('body').append(temp_modal_html);
        $("#modalEditQuestionData_" + temp_question_id).modal("toggle");
        /* $('#modalEditQuestionData_' + temp_question_id + ' .edit_question_type_id ').select2({
            minimumResultsForSearch : -1
        });
        $('#modalEditQuestionData_' + temp_question_id + ' .edit_question_type_id .select2').css('width', '100%'); */
        last_next_que_modal_zindex = last_next_que_modal_zindex + 30;
        $("#modalEditQuestionData_" + temp_question_id).css('z-index', last_next_que_modal_zindex);
    });

    $(document).on('click', '.new-add-more-choice-button, .edit-add-more-choice-button', function (e) {
        e.preventDefault();
        //console.log($(this).attr('data-container-class'), {}, $(this).attr('data-choice-class') ,$(this).attr('data-question-type'));
        addMoreAsnwerToChoices($(this).attr('data-container-class'), {}, $(this).attr('data-choice-class') ,$(this).attr('data-question-type'));
    });

    function addMoreAsnwerToChoices(parent_class_name, data = {}, replace_li_class_name  = 'pending_choice_answer', crr_que_type = ''){
        if (replace_li_class_name == 'pending_choice_answer') {
            placeholder_temp_option = 'new_';
        }else{
            placeholder_temp_option = 'edit_';
        }
        //console.log(crr_que_type, placeholder_temp_option);
        temp_html = $('.generate_choice_option_html').html();
        temp_html = temp_html.replaceAll('[PLACEHOLDER-CLASS]', placeholder_temp_option);
        temp_html = temp_html.replaceAll('[LI-CLASS-NAME]', replace_li_class_name);
        temp_html = temp_html.replaceAll('[CHOICE-CLASS]', 'choice_answer_weight');
        temp_html = temp_html.replaceAll('[CHOICE-NEXT-COLUMN-CLASS]', 'choice_answer_next_coumn');
        $('.' + parent_class_name + ' .choice_answers_list').append(temp_html);
        $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .choice_answer_weight');
        $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice  .choice_answer_weight,.choice_answers_list .temp_html_choice .choice_answer_next_coumn').select2({
            minimumResultsForSearch : -1
        });
        $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .select2').css('width', '100%');

        if(crr_que_type == 'choice'){
            //console.log('current que type --> choice');
            $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .' + placeholder_temp_option + 'number_options_first_box').addClass('d-none');
            $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .' + placeholder_temp_option + 'header_number_value_second_box').addClass('d-none');
            $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .' + placeholder_temp_option + 'choice_options_first_box').removeClass('d-none');
            $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .' + placeholder_temp_option + 'header_choice_value_first_box').removeClass('d-none');
        }else if(crr_que_type == 'number'){
            /* console.log('current que type --> number');
            console.log($('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .' + placeholder_temp_option + 'number_options_first_box').length);
            console.log($('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .' + placeholder_temp_option + 'header_number_value_second_box').length);
            console.log($('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .' + placeholder_temp_option + 'choice_options_first_box').length);
            console.log($('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .' + placeholder_temp_option + 'header_choice_value_first_box').length); */
            $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .' + placeholder_temp_option + 'number_options_first_box').removeClass('d-none');
            $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .' + placeholder_temp_option + 'header_number_value_second_box').removeClass('d-none');
            $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .' + placeholder_temp_option + 'choice_options_first_box').addClass('d-none');
            $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .' + placeholder_temp_option + 'header_choice_value_first_box').addClass('d-none');
        }

        //console.log(parent_class_name, typeof(data) == 'object', Object.keys(data).length);
        if (typeof(data) == 'object' && Object.keys(data).length > 0) {
            //console.log('data is not empty', data);
            //$('.' + parent_class_name + ' .choice_answers_list .pending_choice_answer').remove();
            if(crr_que_type == 'choice'){
                $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .choice_answer_input-box').val(data.answer_text);
            }else if(crr_que_type == 'number'){
                splitted_answer_text  = data.answer_text.split("-");
                if (splitted_answer_text.length > 1) {
                    $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .number_end_range').val(splitted_answer_text[1]);
                }
                $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .number_start_range').val(splitted_answer_text[0]);
            }

            $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .choice_answer_weight').val(data.answer_weight).trigger('change');
            if (!data.answer_next_question || data.answer_next_question.length <= 0) {
                data.answer_next_question = '-1';
            }
            $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .choice_answer_next_coumn').val(data.answer_next_question).trigger('change');;

            //console.log('updated data');
        }
        if(crr_que_type == 'choice'){
            //console.log('focus - chocue');
            $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .choice_answer_input-box').focus();
        }else if(crr_que_type == 'number'){
            //console.log('focus - number');
            $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice .number_start_range').focus();
        }
        $('.' + parent_class_name + ' .choice_answers_list .temp_html_choice').removeClass('temp_html_choice');
    }

    var ctrlKeyDown = false;
    $(document).ready(function(){
        $(document).on("keydown", keydown);
        $(document).on("keyup", keyup);
        /* $(document).on('keydown',function(e) {
            console.log('down', e.which);
        });
        $(document).on('keyup',function(e) {
            console.log('up', e.which);
        }); */
    });

    function keydown(e) {
        if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
            // Pressing F5 or Ctrl+R
            e.preventDefault();
            //console.log('refresh called');
            checkAndReloadClickedUrl(window.location.href);
            return false;
        } else if ((e.which || e.keyCode) == 17) {
            // Pressing  only Ctrl
            ctrlKeyDown = true;
        }else if ((e.which || e.keyCode) == 27) {
            // Pressing  only Ctrl
            if (is_exit_modal_shown == true) {
                e.preventDefault();
                is_esc_button_pressed = true;
            }
        }
    };

    function keyup(e){
        // Key up Ctrl
        if ((e.which || e.keyCode) == 17){
            ctrlKeyDown = false;
        }
    };

    $(function () { $(document).tooltip({ content: function () { return $(this).prop('title'); } }); });

</script>
