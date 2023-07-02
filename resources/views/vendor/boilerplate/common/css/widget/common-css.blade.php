<style>
    html {-webkit-text-size-adjust: 100%; -webkit-tap-highlight-color: rgba(0,0,0,0); font-family: sans-serif; line-height: 1.15; }
    .content-wrapper {height: 100%;background-color: #f4f6f9;color: #212529; font-family: 'Open Sans',Source Sans Pro,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol; font-size: 1rem; font-weight: 400; line-height: 1.5; margin: 0; text-align: left;}
    .content-wrapper>.content {padding: 0 0.5rem;}
    .btn-primary { background-color: #6610f2; border-color: #6610f2; }
    .btn-primary.focus, .btn-primary:focus, .btn-primary:hover { background-color: #6610f2c9; border-color: #6610f2c9; color: #fff; }
    .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle { background-color: #6610f2c9; border-color: #6610f2c9; color: #fff; }
    .btn-primary.disabled, .btn-primary:disabled { color: #fff; background-color: #6610f2c9; border-color: #6610f2c9; }
    .question-text{max-width:90%;background-color: white; background-clip: padding-box; border: 1px solid #ced4da; border-radius: 0.2rem; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;word-break: break-all; width: fit-content;border:unset;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;box-shadow: rgb(0 0 0 / 10%) 0px 4px 15px 0px, rgb(0 0 0 / 25%) 0px 1px 2px 0px, rgb(255 193 7 / 60%) 0px 2px 0px 0px inset;    color: rgb(0, 0, 0);border-radius: 4px;padding: 10px;}
    .user_action_area {display: flex;justify-content: space-between;border-top:1px solid #ced4da;background: white;border: 1px solid rgba(0,0,0,.125);}
    .chatbot-formbuton-container {margin: auto;width: 14%!important;margin: 0;}
    .chatbot-formbuton-container .btn-group{height: 100%;width: 100%;}
    .pl0{padding-left: 0;}.pr0{padding-right: 0;}
    .user-action-input-text-area{border: unset; outline: none;margin: 0!important;}
    .btn-save-question-answer{border-radius: 30px; padding: 0.375rem 0.6rem;border-radius: 0;}
    textarea:focus{box-shadow: none!important;}
    textarea.form-control{margin: 5px 0;}
    /* Hide scrollbar for Chrome, Safari and Opera */
    #question_list::-webkit-scrollbar, .scroll-container::-webkit-scrollbar {display: none;}
    #question_list{-ms-overflow-style: none;  /* IE and Edge */scrollbar-width: none;  /* Firefox */}
    /* Hide scrollbar for IE, Edge and Firefox */
    .scroll-container {background:#f5fafe; margin: 0 10px 0 5px; -ms-overflow-style: none;  /* IE and Edge */scrollbar-width: none;  /* Firefox */}
    .user-chat-time-div,.chatbot-time-div{font-size: 60%; font-size: 0.7rem;}
    textarea:placeholder-shown {font-style: italic;}
    #question_list ul, #question_list .data-container, html, body{scroll-behavior: smooth}
    .choice_answer_label{cursor: pointer;margin-top: 0!important;margin-bottom: 0;}
    .choice_ans_box{display: block; margin-bottom: 0;}

    .lds-ellipsis{display:inline-block;position:relative;width:70px;padding: unset;}
    .lds-ellipsis div{position:absolute;width:10px;top:-10px;height:10px;border-radius:50%;background:#6610f2c9;animation-timing-function:cubic-bezier(0,1,1,0)}
    .lds-ellipsis div:nth-child(1){left:8px;animation:lds-ellipsis1 .4s infinite}
    .lds-ellipsis div:nth-child(2){left:8px;animation:lds-ellipsis2 .4s infinite}
    .lds-ellipsis div:nth-child(3){left:32px;animation:lds-ellipsis2 .4s infinite}
    .lds-ellipsis div:nth-child(4){left:56px;animation:lds-ellipsis3 .4s infinite}
    @keyframes lds-ellipsis1 {
        0%{transform:scale(0)}
        100%{transform:scale(1)}
    }
    @keyframes lds-ellipsis3 {
        0%{transform:scale(1)}
        100%{transform:scale(0)}
    }
    @keyframes lds-ellipsis2 {
        0%{transform:translate(0,0)}
        100%{transform:translate(24px,0)}
    }

    .float-left-box{float: left;width: 100%}
    .question-text, .current_question_text{word-break: break-word}
    .question-text{word-break: break-word;white-space: pre-line;}
    .bot-icon{width: 100%;max-width: 55px;}
    .left-bot-icon{margin-left: 5px;}
    .user-bot-icon{max-width: 45px;;}
    .bg-white .bot-icon, .bg-white img{max-width: 50px!important;}
    .main-card-container{background: #f5fafe;background:#f2f3f9;border:1px solid rgba(0,0,0,.125);border-radius: 20px 20px 0px 0px;}
    .main-card-container .card-header{border-radius:20px;box-shadow: 0px 2px 4px #ccc;padding: 0.2rem 1.25rem}
    .header-title-box h5{font-size: 1.3rem}
    .btn-save-question-answer .fa {font-size: 1.9rem;}
    .single-btn-anwer-container{
        width: 100%!important;
        /* text-align: right!important;
        padding: 0!important; */
    }
    .single-btn-anwer-container .btn-group{width: auto;}
    .single-btn-anwer-container .btn-group .btn-primary{border-radius: 0.25rem;padding: 0.375rem 1.2rem;}
    .single-btn-anwer-container .btn-group .btn-primary span{height: 100%;vertical-align: top;}
    .chatbot-time-div-box{/* width: 84%; */ text-align: left;}
    .header-title-box .bot-icon{max-width: 60px;}
    .main-card-container .lds-ellipsis div{background:#0000007d}
    .bot_image_box{flex: 0 0 58px!important;max-width: 100%!important;}
    input[type=checkbox], input[type=radio]{width: 18px; height: 18px; vertical-align: sub;}
    #question_list .data-container li .col-md-12:first-child{
        padding-left: 10px;
    }
    .user-action-answer-button-container {padding: 0.65rem 1rem !important;}
    .main-card-container{height: 98%;}
    @if(isset($_REQUEST['preview']) && $_REQUEST['preview'] == 1)
        .user-form-box{width:50%!important;position:unset!important;float:unset!important;margin-right:auto!important;}
        .user-form-box .scroll-container{height: 60vh!important;max-height: 60vh!important}
        .user-form-box .first-form-row{float: unset!important}
        @media(max-width: 786px){
            .user-form-box{width:100%!important}
            .user-form-box .first-form-row{margin-right: 0;}
        }
    @else
        .user-form-box{margin-right:0!important}
        .first-form-row{padding-left: 0;padding-right: 0;margin:0;}
        .first-form-row .col:first-child{padding-left: 5px;padding-right: 5px;}
    @endif

    .thank_you_note_message{white-space:initial;}
    .thank_you_note_message p{margin-bottom:0;}
    .thank_you_note_message p img{
        display: none;
    }
</style>

<style>
 .chat-online {
     color: #34ce57
}
 .content_main{
     display: flex;
     justify-content: flex-end;
     overflow-x: hidden;
}
.content_main .card {
    width: 50%;
    background: #f2f3f9;
    border-top-left-radius: 18px;
    border-top-right-radius: 0;
    border-bottom-left-radius: 18px;
        height: 100vh;
}
 .chat-offline {
     color: #e4606d
}
 .wrap_row{
     max-width: 70%;
     width: 100%;
     margin-left: 24px;
}
 .bg-white {
     background: #fff;
     width: 100%;
     padding: 8px 15px 10px 15px;
     border-radius: 6px;
     box-shadow: 0 0 5px #746e6e;
     position: relative;
     color:inherit;
     max-width: 70%;
     width: auto;
     border-color:gainsboro;
}
 .wrap_right {
     max-width: 73%;
     width: 100%;
     margin-right: 24px;
}
 .bg-yellow {
     /* background: #ffe141; */
     background: #6610f2;
     /* width: 85%; */
     padding: 10px;
     border-radius: 6px;
     box-shadow: 0 0 5px #746e6e;
     position: relative;
}
.bg-white:before{
    content: '';
  width: 0;
  height: 0;
  border-top: 8px solid transparent;
  border-bottom: 8px solid transparent;
  border-left: 8px solid #fff;
   position: absolute;
    right: -8px;
    top: 9px;
    z-index: 9;
}
.bg-white:after{
    content: '';
  width: 0;
  height: 0;
  border-top: 8px solid transparent;
  border-bottom: 8px solid transparent;
  border-left: 8px solid #ccc;
   position: absolute;
    right: -11px;
    top: 9px;
}
.bg-yellow:before {
    content: '';
    width: 0;
    height: 0;
    border-top: 8px solid transparent;
    border-bottom: 8px solid transparent;
    /* border-right: 8px solid #ffe141; */
    border-right: 8px solid #6610f2;
    position: absolute;
    left: -7px;
    top: 9px;
    z-index: 9;
}
.bg-yellow:after {
    content: '';
    width: 0;
    height: 0;
    border-top: 8px solid transparent;
    border-bottom: 8px solid transparent;
    border-right: 8px solid #ccc;
    position: absolute;
    left: -9px;
    top: 9px;
}
 .eve_icn,.user_icn{
     width: 50px;
     height: 50px;
     border-radius: 100%;
}
}
 .time {
     text-align: right;
     font-size: 14px;
     text-transform: uppercase;
     margin-top: 4px;
     color: #050606;
}
 .time.left{
     text-align: left;
}
 .chat-messages {
     display: flex;
     flex-direction: column;
     height: calc(100vh - 118px);
     overflow-y: scroll;
     background: #f2f3f9;
}
 .chat-message-left, .chat-message-right {
     display: flex;
     flex-shrink: 0
}
 .main_eve {
     position: absolute;
     top: 5px;
     left: 20px;
}
 .date_sec p {
     border-bottom: 3px dotted #ccc;
     width: 70%;
     margin: 0 auto;
     display: inline-block;
     line-height: 0px;
}
 .chat-message-right {
     flex-direction: row-reverse;
     margin-left: auto
}
.header_sec {
    position: relative;
    border-radius: 20px;
    background: #fff;
    padding: 16px 20px;
    text-align: center;
    box-shadow: 0px 2px 4px #ccc;
}
 .hdr_contnt h4 {
     margin-bottom: 8px;
     font-weight: 400;
}
 img.icn_minus {
     position: absolute;
     right: 20px;
     top: 10px;
}
 .send_msg_box input {
     border-radius: 0;
     background: #fff;
     padding: 12px 74px 12px 12px;
     font-size: 17px;
     width: 100%;
     border: none;
     box-shadow: 2px 0px 5px #ccc;
}
 .copy_riht .typing {
     text-align: left;
     padding: 5px 25px;
     font-size: 14px;
     color: #8d8d8b;
     margin-top: 0;
     margin-bottom: 10px;
}
 .send_msg_box button {
     background-color: #ffe141;
     position: absolute;
     right: 0;
     border: none;
     padding: 12px 13px;
}
 .send_msg_box button img{
     width: 28px;
}
 .copy_riht p{
     margin: 10px 0px 0px 0px;
     text-align: center;
     font-size: 12px;
}
 .copy_riht p span{
     color:#9db7d0;
}
 .date_sec{
     margin: 30px 8px;
     text-align: center;
}
 .date_sec span{
     background: #939393;
     color: #ccc;
     padding: 8px 14px;
     border-radius: 20px;
}
.copy_riht {
    background: #f2f3f9;
    border-bottom-left-radius: 18px;
}
.time {
    text-align: right;
}

.chat-messages::-webkit-scrollbar {
  width: 10px;
}

/* Track */
.chat-messages::-webkit-scrollbar-track {
  background: #f2f3f9;
}

/* Handle */
.chat-messages::-webkit-scrollbar-thumb {
  background: #f2f3f9;
}

/* Handle on hover */
.chat-messages::-webkit-scrollbar-thumb:hover {
  background: #555;
}


@media screen and (min-width: 320px) and (max-width: 767px){
    .content_main .card {
        width: 100%;
    }
    .wrap_row {
        max-width: 65%;
    }
    .main_eve {
        position: absolute;
        top: 11px;
        left: 7px;
    }
    .main_eve img{
        width: 57px;
    }
    .hdr_contnt h4 {
        font-size: 14px;
    }
}

@media screen and (min-width: 768px){
    .content_main .card {
        width: 50%;
    }
}
    .col-sm-2 {
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }
    .col-md-12 {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .col-sm-10 {
        -ms-flex: 0 0 83.333333%;
        flex: 0 0 83.333333%;
        max-width: 83.333333%;
    }
    .col-sm-9 {
        -ms-flex: 0 0 75%;
        flex: 0 0 75%;
        max-width: 75%;
    }
    .col-sm-1 {
        -ms-flex: 0 0 8.333333%;
        flex: 0 0 8.333333%;
        max-width: 8.333333%;
    }
</style>
