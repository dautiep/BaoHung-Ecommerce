const ROUTE_SUBMIT_QUESITION = getDataScript('routerSubmitQuestion');
const ROUTE_BOT = getDataScript('routeBot');
const ROUTER_USER = getDataScript('routeSendMessageUser');
const ID_INPUT_BOT = '#chatbox';
const ID_INPUT_QUESITION = '#user_message';
const ID_INPUT_EMAIL = '#user_email';
const ID_INPUT_PHONE = '#user_phone';
const ID_BOT_UI = '#test';
const BTN_SHOW_SERVICE = '.service-plus';
const BTN_GET_SERVICE = '.get_service';
const BTN_SUBMIT_QUESTION = '.service-submit';
const BTN_USER_SUBMIT = '#user_submit';
const TYPE_METHOD = 'POST';

function getDataScript(elemt) {
    var script = document.querySelector('script[data-id][data-name="bot_extenstion"]');
    var data = script.getAttribute(`data-${elemt}`);
    return data;
};
function request(url, data, type, callback) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `${url}`,
        data: data,
        type: type,
        success: function (res) {
            callback(res);
        },
        error: function (res) {
            console.log('error'); // when error is returned
        }
    });
}

function handleScrollBottom() {
    var div = document.getElementById('test');
    div.scrollIntoView({
        block: "end",
        behavior: "smooth",
        inline: "nearest"
    });
}

function handleClickCallBot() {
    $(document).on('click', BTN_SHOW_SERVICE, function (e) {
        e.preventDefault();
        requestCallBot();
    });
}

function handleCallAction() {
    $(document).on('click', BTN_GET_SERVICE, function (e) {
        e.preventDefault();
        request(ROUTE_BOT, {
            id: $(this).data('service'),
            action: 'callBotById',
            next: $(this).data('next')
        }, TYPE_METHOD, function (res) {
            appendContentBlock(res);
        });
    });
}

function appendContentBlock(content) {
    // load animation
    $(ID_BOT_UI).append(content);
    handleScrollBottom();
}

function requestCallBot() {
    request(ROUTE_BOT, {
        action: 'callBot'
    }, TYPE_METHOD, function (res) {
        appendContentBlock(res);
    });
}

function handleSubmitQuestion() {
    $(document).on('click', BTN_USER_SUBMIT, function (e) {
        e.preventDefault();
        let data = {
            email: $(ID_INPUT_EMAIL).val(),
            phone: $(ID_INPUT_PHONE).val(),
            message: $(ID_INPUT_QUESITION).val()
        };
        request(ROUTE_SUBMIT_QUESITION, data, TYPE_METHOD, function (res) {
            notify(res);
            handleHideModal();
        });
    });
}


function handleInputQuestion() {
    $(document).on('click', BTN_SUBMIT_QUESTION, function (e) {
        e.preventDefault();
        let messages = $(ID_INPUT_BOT).val();
        if (messages == '') {
            notify('Vui lòng nhập câu hỏi');
            return;
        }
        $(ID_INPUT_QUESITION).val(messages);
        request(ROUTER_USER, {
            message: messages
        }, TYPE_METHOD, function (res) {
            appendContentBlock(res);
            $(ID_INPUT_BOT).val('');
            handleShowModal();
        });
    });
}

function handleHideModal() {
    let modal = $('#modalMessenger');
    modal.hide();
}

function handleShowModal() {
    let modal = $('#modalMessenger');
    modal.fadeIn(500);
}

function notify(message) {
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
        onClick: function () { } // Callback after click
    }).showToast();

}

function init() {
    requestCallBot();  // init request call bot
    handleCallAction(); // assign handle click button call action click axios
    handleInputQuestion(); // assign handle submit input message user
    handleClickCallBot(); // assign event call event click plus bot
    handleSubmitQuestion(); // assign event submit form question

}
$(document).ready(function () {
    init();
});
