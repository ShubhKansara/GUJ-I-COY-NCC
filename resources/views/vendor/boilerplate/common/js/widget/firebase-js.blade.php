<script type="text/javascript">
    var firebaseConfig = {
        apiKey: "AIzaSyB5zPtpjK8RUpK_IrIvie8QKp7f8kGK3K0",
        authDomain: "eva-extrahourz.firebaseapp.com",
        projectId: "eva-extrahourz",
        storageBucket: "eva-extrahourz.appspot.com",
        messagingSenderId: "709092181120",
        appId: "1:709092181120:web:a618fb5774c7ad52a35265",
        measurementId: "G-FMMEGPF9FV"
    };

    firebase.initializeApp(firebaseConfig);

    $( document ).ready(function() {
        render();
    });

    function render() {
        window.recaptchaVerifier= new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'size': 'invisible',
            'callback': function(response) {
                // reCAPTCHA solved, allow signInWithPhoneNumber.
                //onSignInSubmit();
                console.log('sign in captcha verified - invisible mode');
            }
        });
        recaptchaVerifier.render();
    }

    function tsndcd(otpMobileNumber) {
        $('.btn-save-question-answer').attr('disabled', true);
        firebase.auth().signInWithPhoneNumber(otpMobileNumber, window.recaptchaVerifier).then(function (confirmationResult) {
            window.confirmationResult=confirmationResult;
            coderesult = confirmationResult;
            //console.log(coderesult);
            console.log("Message Sent Successfully.");
            $('.btn-save-question-answer').attr('disabled', false);
            $('.question_box_container_' + current_sequence_number).parent().removeClass('d-none');
        }).catch(function (error) {
            let errorMessage = 'I am unable to send verification code to this number. Please enter another number or refresh chat.';

            /* let firebaseErrors = {
                'auth/user-not-found': 'There is no existing user record corresponding to the provided identifier.',
                'auth/email-already-in-use': 'The email address is already in use',
                'auth/invalid-phone-number': "The provided value for the phoneNumber is invalid. It must be a non-empty E.164 standard compliant identifier string."
            };
            if(error.code && firebaseErrors[error.code]){
                errorMessage = firebaseErrors[error.code];
            } */

            console.log('OTP send error', error.code);
            console.log(error);
            showErrorMessageToWidget(errorMessage, getCurrentTimeString(), false);
            $('.user-phone-action-answer-button-container').removeClass('d-none');
            $('.user-action-answer-input-container').addClass('d-none');
        });

    }

    function tverf(user_input_code) {
        coderesult.confirm(user_input_code).then(function (result) {
            is_show_user_message = is_send_sms_to_user = false;
            console.log('Code verified Successfully');
            $('.user-action-input-text-area').val(user_input_code).focus();
            $('.btn-save-question-answer').attr('disabled', false).click();
        }).catch(function (error) {
            showErrorMessageToWidget(otp_error_message, getCurrentTimeString());
            console.log(otp_error_message, error);
        });
    }
</script>
