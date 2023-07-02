<div class="modal fade" id="modalEditQuestionData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <h5 class="modal-title d-block" id="myModalLabel"><i class="fa fa-cog mr-2"></i> Edit a Question</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <!--Body-->
        <div class="modal-body">
            <table class="table table-hover mt-4" id="selectedModalData">
            <tbody>
                <div class="row mt-2 mr-0 edit_q_box">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                @component('boilerplate::select2', ['name' => 'edit_question_type_id', 'id' => 'edit_question_type_id',
                                    'label' => 'boilerplate::chatbot.create_question_type', 'minimum-results-for-search' => '-1'])
                                    @foreach ($questionTypes as $indx => $type)
                                        @php
                                            if(!in_array($type->key_name, array('text', 'name', 'file')) ){
                                                continue;
                                            }
                                        @endphp
                                        <option value="{{ $type['id'] }}" @if($type['key_name'] == 'text') selected @endif  > {{ $type['question_type_name'] }}</option>
                                    @endforeach
                                @endcomponent
                            </div>
                            <div class="mt-3 col-md-6 edit_question_text_box">
                                <label for="edit_question_text">Enter your question here</label>
                                <textarea class="form-control edit_question_text" rows="3" cols="40" placeholder="Enter Your Question Here" name="edit_question_text"></textarea>
                                <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_error_message')</small>
                            </div>
                            <div class="mt-3 col-md-6 edit_question_error_message_box">
                                <label for="edit_question_error_message">Question Error Message</label>
                                <textarea id="edit_question_error_message" class="form-control mt-1" rows="2" cols="40" name="edit_question_error_message"></textarea>
                                <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_error_message')</small>
                            </div>
                            <div class="mt-3 col-md-6 edit_question_regex_box d-none">
                                <label for="edit_question_regex">Question Validation Regex</label>
                                <textarea id="edit_question_regex" class="form-control mt-1" rows="2" cols="40" name="edit_question_regex"></textarea>
                                <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_regular_expression')</small>
                            </div>
                            <div class="mt-3 col-md-6 edit_question_response_text_box">
                                <label for="edit_question_response_text">Response Text</label>
                                <textarea id="edit_question_response_text" class="form-control mt-1" rows="2" cols="40" name="edit_question_response_text"></textarea>
                                <small class="form-text text-muted">@lang('boilerplate::chatbot.create_question_response_text')</small>
                            </div>
                        </div>
                    </div>
                </div>
            </tbody>
            </table>

        </div>
        <!--Footer-->
        <div class="modal-footer">
            <button type="button" class="btn btn-reverse" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" id="modalCartUpdateEditQuestion">Update</button>
        </div>
        </div>
    </div>
</div>
