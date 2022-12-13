 <section class="boxchat">
     <div class="container p-x__0">
         <div class="wrapper">
             <div class="boxchat-head container">
                 <a href="">
                     <em class="ri-arrow-left-line"></em>
                     <span>Quay lại trang chủ</span>
                 </a>
                 <a class="btn-admin" href="{{ route('dashboard') }}" >
                     <i class="ri-home-8-line"></i>
                 </a>
             </div>
             <div class="boxchat-head-2 container"> <a href="" target="_blank" rel="noopener noreferrer">
                     <div class="icon-botchat">
                         <img src="{{ addVersionTo('chatbot/img/botchat.jpg') }}">
                     </div>
                     <div class="slogan">
                         <p>Trợ lý ảo BIDV </p>
                         <p>Online</p>
                     </div>
                 </a></div>
             <div class="boxchat-body container">
                 <div class="list-service" id="test">
                     @yield('messages')
                 </div>
             </div>
             <div class="boxchat-footer container">
                 <div class="service-plus"><em class="ri-menu-add-fill"></em></div>
                 <div class="service-chat">
                     <textarea rows="1" id="chatbox" placeholder="Nhập văn bản..."></textarea>
                 </div>
                 <div class="service-submit"> <em class="ri-send-plane-fill"></em></div>
             </div>
         </div>
     </div>
 </section>
