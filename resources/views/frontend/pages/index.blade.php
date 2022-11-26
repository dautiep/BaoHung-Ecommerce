@extends('frontend.layout.layout')
@section('messages')
@endsection
@section('scripts')
    <script async src="{{ asset('chatbot/js/bot.js') }}" data-id="bot_extenstion" data-name="bot_extenstion"
        data-routerSubmitQuestion="{{ route('sendQuestionUser') }}" data-routeBot="{{ route('bot') }}"
        data-routeSendMessageUser="{{ route('sendMessageUser') }}"></script>
@endsection
