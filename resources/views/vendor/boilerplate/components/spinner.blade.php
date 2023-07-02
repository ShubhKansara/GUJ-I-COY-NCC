@stack('plugin-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/5.3.8/sweetalert2.css"/>
@stack('css')
<script src="https://cdn.jsdelivr.net/sweetalert2/5.3.8/sweetalert2.js"></script>
@push('js')
<script>
    const showLoading = function(message=null) {
        let text = "<b>Be patient.</b><br/>"
        text += (message && message.length>0) ?message : 'This might take a few moments to load.'
        swal({
            title: '',
            text:text,
            allowEscapeKey: false,
            allowOutsideClick: false,
            //timer: 4500,
            onOpen: () => {
                swal.showLoading();
            }
        })
    };
    function closeSwalWhilePageLoaded(){
        setTimeout(() => {
            swal.close();
        }, 500);
    }
</script>
@endpush