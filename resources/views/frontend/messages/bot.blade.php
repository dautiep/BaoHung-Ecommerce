      <ul class="service-wrap wrap-left">
          <li class="supporter">
              <img src="{{ asset('chatbot/img/70.png') }}">
              <p>Chào bạn. Mình là trợ lý ảo My Viettel. Mình có thể giúp gì cho bạn không?</p>
          </li>
          @for ($i = 0; $i < 5; $i++)
              <li><a href="javascript:void(0)" class="get_service" data-service="{{ $i }}"> <span> <img
                              src="{{ asset('chatbot/img/30.png') }}"></span><span>Lựa chọn
                          dịch vụ {{ $i }}</span></a></li>
          @endfor
      </ul>
