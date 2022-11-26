@extends('frontend.layout.layout')
@section('messages')
@endsection
@section('scripts')
    <script>
        const routeSubmitForm = "{{ route('sendQuestionUser') }}";
        const routeAction = "{{ route('bot') }}";
        const routeUser = "{{ route('sendMessageUser') }}";
        const btnCallService = '.service-plus';
        const botId = '#test';
        const btnService = '.get_service';
        const btnSendMessage = '.service-submit';
        const contentChatBox = '#chatbox';
        const user_message = '#user_message';
        const user_submit = '#user_submit';
        const user_email = '#user_email';
        const user_phone = '#user_phone';


        function request(url, data, type, callback) {
            $.ajax({
                url: `${url}`,
                data: data,
                type: type,
                success: function(res) {
                    callback(res);
                },
                error: function(res) {
                    console.log('error');
                }
            });
        }

        function scrollBottom() {
            var div = document.getElementById('test');
            div.scrollIntoView({
                block: "end",
                behavior: "smooth",
                inline: "nearest"
            });
        }

        function loadNewService() {
            $(document).on('click', btnCallService, function(e) {
                e.preventDefault();
                loadServiceInit();
            });
        }

        function loadActionClickService() {
            $(document).on('click', btnService, function(e) {
                e.preventDefault();
                let serviceId = $(this).data('service');
                request(routeAction, {
                    Id: serviceId,
                    action: 'getServiceById'
                }, 'GET', function(res) {
                    appendView(res);
                });
            });
        }

        function appendView(content) {
            $(botId).append(content);
            scrollBottom();
        }

        function loadServiceInit() {
            request(routeAction, {
                action: 'callBot'
            }, 'GET', function(res) {
                appendView(res);
            });
        }

        function submitForm() {
            $(document).on('click', user_submit, function(e) {
                e.preventDefault();
                let data = {
                    email: $(user_email).val(),
                    phone: $(user_phone).val(),
                    message: $(user_message).val()
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                request(routeSubmitForm, data, 'POST', function(res) {
                    showMessage(res);
                });
            });
        }


        function sendMessageUser() {
            $(document).on('click', btnSendMessage, function(e) {
                e.preventDefault();
                let messages = $(contentChatBox).val();
                if (messages == '') {
                    showMessage('Vui lòng nhập câu hỏi');
                    return;
                }
                $(user_message).val(messages);
                request(routeUser, {
                    message: messages
                }, 'GET', function(res) {
                    appendView(res);
                });
            });
        }

        function showModalUser() {
            let modal = $('#modalMessenger');

            modal.fadeIn(500);

        }

        function showMessage(message) {
            Toastify({
                text: message,
                duration: 5000,
                destination: "https://github.com/apvarun/toastify-js",
                newWindow: true,
                close: true,
                //avatar: 'https://dummyimage.com/50x50/000/fff',
                offset: {
                    y: 120
                },
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00524e, #00b09b)",
                },
                onClick: function() {} // Callback after click
            }).showToast();

        }

        function init() {
            loadServiceInit();
            loadActionClickService();
            sendMessageUser();
        }
        $(document).ready(function() {
            init();
            loadNewService();
            submitForm();
        });
    </script>
@endsection
