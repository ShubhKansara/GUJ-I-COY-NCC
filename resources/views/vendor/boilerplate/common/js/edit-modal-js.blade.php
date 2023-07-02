<script>
    /*
            $(document).on('click', '.close_edit_que_box', function (e) {
                e.preventDefault();
                var question_id_box = $(this).attr('data-question-id');
                $(".li_que_"+ question_id_box + " .view_q_box").css('display', 'flex');;
                $(".li_que_"+ question_id_box + " .edit_q_box").css('display', 'none');;
            });
            $(document).on('click', '.button_edit_question', function (e) {
                e.preventDefault();
                var question_id_box = $(this).attr('data-question-id');
                var question_mode = $(this).attr('data-mode');

                if ((typeof(question_mode) != undefined || typeof(question_mode) != 'undefined') && question_mode == 'draft') {
                    console.log('edit called', question_id_box,question_mode, $(this).closest('li').attr('data-text'));
                    $("#modalEditQuestionData  .edit_question_text").val($(this).closest('li').attr('data-text'));
                    $("#modalEditQuestionData  #edit_question_error_message").val($(this).closest('li').attr('data-error-message'));
                    $("#modalEditQuestionData  #edit_question_regex").val($(this).closest('li').attr('data-regex'));
                    $("#modalEditQuestionData  #edit_question_response_text").val($(this).closest('li').attr('data-response-text'));
                    $("#modalEditQuestionData  #edit_question_type_id").val($(this).closest('li').attr('data-question-type-id')).change();
                    $('#modalCartUpdateEditQuestion').attr('data-mode', 'draft');
                    $('#modalCartUpdateEditQuestion').attr('data-question-id', question_id_box);
                    $("#modalEditQuestionData").modal("toggle");
                    return;
                }
                let route = "{{ config('app.url_prefix') }}" + "/admin/chatbots-questions/" + question_id_box ;
                $.ajax({
                    type: "GET",
                    url: route,
                    data: {_token: "{{ csrf_token() }}"},
                    success: function(data) {
                        if(data.success == false) {
                            alertify.error(data.message, 5, function(){  console.log('dismissed'); });
                            return;
                        }
                        $("#modalEditQuestionData  .edit_question_text").val(data.data.question_text);
                        $("#modalEditQuestionData  #edit_question_error_message").val(data.data.error_message);
                        $("#modalEditQuestionData  #edit_question_regex").val(data.data.regular_expression);
                        $("#modalEditQuestionData  #edit_question_response_text").val(data.data.response_text);
                        $("#modalEditQuestionData  #edit_question_type_id").val(data.data.question_type_id).change();
                        $('#modalCartUpdateEditQuestion').attr('data-question-id', data.data.id);
                        $('#modalCartUpdateEditQuestion').attr('data-mode', 'default');
                        $("#modalEditQuestionData").modal("toggle");
                    }
                });
                return true;
            });

            function updateQuestionDataAfterUpdated(question_id_box, data){
                $("#modalCartUpdateEditQuestion").text("Update").attr('disabled', false);
                $("#modalEditQuestionData .edit_q_box .edit_question_text").val('');
                $("#modalEditQuestionData .edit_q_box #edit_question_error_message").val('');
                $("#modalEditQuestionData .edit_q_box #edit_question_regex").val('');
                $("#modalEditQuestionData .edit_q_box #edit_question_response_text").val('');

                temp_question_text = data.question_text;
                $(".li_que_" +question_id_box + " .view_q_box .question_text_info_box").html(temp_question_text);

                new_que_type_key = 'text';
                if(data.question_type_id && findWithAttr(question_type_list, 'id', parseInt(data.question_type_id)) != -1){
                    new_que_type_key = question_type_list[findWithAttr(question_type_list, 'id', parseInt(data.question_type_id))].question_type_name;
                }
                $(".li_que_" +question_id_box + " .view_q_box .question-type-badge").text(new_que_type_key);
                $(".li_que_" +question_id_box).attr('data-question-type-id', data.question_type_id);
                $(".li_que_" +question_id_box).attr('data-text', data.question_text);
                $(".li_que_" +question_id_box).attr('data-error-message', data.error_message);
                $(".li_que_" +question_id_box).attr('data-response-text', data.response_text);
                $(".li_que_" +question_id_box).attr('data-regex', data.regular_expression);

                alertify.success(data.message);
                setTimeout(() => {
                    $("#modalEditQuestionData").modal("toggle");
                }, 500);
            }

            $(document).on('click', '#modalCartUpdateEditQuestion', function (e) {
                e.preventDefault();
                var question_id_box = $(this).attr('data-question-id');
                var que_mode = $(this).attr('data-mode');

                data = {};
                data.question_text = $("#modalEditQuestionData .edit_q_box .edit_question_text").val();
                data.error_message = $("#modalEditQuestionData .edit_q_box #edit_question_error_message").val();
                data.regular_expression = $("#modalEditQuestionData .edit_q_box #edit_question_regex").val();
                data.response_text = $("#modalEditQuestionData .edit_q_box #edit_question_response_text").val();
                data.question_type_id = $("#modalEditQuestionData .edit_q_box #edit_question_type_id").val();

                if (typeof(que_mode) != undefined && que_mode == 'draft') {
                    data.message = "Question details updated";
                    updateQuestionDataAfterUpdated(question_id_box, data);
                    return;
                }

                $("#modalCartUpdateEditQuestion").text("Please wait...").attr('disabled', true);
                $.ajax({
                    url: "{{ route('boilerplate.chatbots-questions.index') }}/" + question_id_box,
                    method: 'put',
                    data: data,
                    success: function(data) {
                        updateQuestionDataAfterUpdated(question_id_box, data.data);
                    },
                    error: function(xhr){
                        $("#modalCartUpdateEditQuestion").text("Update").attr('disabled', false);
                        let errorMessage = '';
                        if (typeof(xhr.responseJSON.errors) == 'undefined') {
                            errorMessage = xhr.responseJSON.message;
                        }else{
                            const values = Object.values(xhr.responseJSON.errors);
                            for(let index = 0; index < values.length; index++) {
                                errorMessage += values[index] + (index > 0 ? "<br/>" : '');
                            }
                        }
                        console.log(errorMessage);
                        alertify.error(errorMessage, 5, function(){  console.log('dismissed'); });
                    }
                });

            });
            function hideSection() {
                isEdit = false;
                editId = null;
                document.getElementById("formSiteCreation").reset();
            }

            function handleDelete(id) {
                let route = "{{ config('app.url_prefix') }}" + "/admin/chatbots-questions/" + id ;
                $.ajax({
                    type: "DELETE",
                    url: route,
                    data: {_token: "{{ csrf_token() }}"},
                    success: function(data) {
                        if(data.success == false) {
                            alertify.error(data.message, 5, function(){  console.log('dismissed'); });
                            return;
                        }else{
                            alertify.success(data.message);
                        }
                    }
                });
            }

            function handleEdit(id) {
                let route = "{{ config('app.url_prefix') }}" + "/admin/chatbots-questions/" + id ;
                editId = id;
                isEdit = true;
                $.ajax({
                    type: "GET",
                    url: route,
                    data: {_token: "{{ csrf_token() }}"},
                    success: function(data) {
                        console.log(data);
                        if(data.success == false) {
                            alertify.error(data.message, 5, function(){  console.log('dismissed'); });
                            return;
                        }
                        $("#modalEditQuestionData  .edit_question_text").val(data.data.question_text);
                        $("#modalEditQuestionData  #edit_question_error_message").val(data.data.error_message);
                        $("#modalEditQuestionData  #edit_question_regex").val(data.data.regular_expression);
                        $("#modalEditQuestionData  #edit_question_response_text").val(data.data.response_text);
                        $("#modalEditQuestionData  #edit_question_type_id").val(data.data.question_type_id).change();
                    }
                });
            }

            function handleView(id) {
                let route = url + "/" + id;
                $.ajax({
                    type: "GET",
                    url: route,
                    data: {_token: "{{ csrf_token() }}"},
                    success: function(data) {
                        if(data.success == false) {
                            alertify.error(data.message, 5, function(){  console.log('dismissed'); });
                            return;
                        }
                        generated_html = "";
                        prefix_keys = { id:"Site ID", name: 'Site Name', location: "Location", contact_name: "Engineer Name",
                                    contact_phone: "Engineer Number", remarks: "Remarks"};
                        for (var key in prefix_keys) {
                            var value = (data.data[key]) ? data.data[key] : '-';
                            generated_html += "<tr><td>" + prefix_keys[key] + "</td><td>" + value + "</td>";
                            $("#modalViewData tbody").html(generated_html);
                        }
                        t
                        //modalViewData
                    }
                });
            }
         */
</script>
