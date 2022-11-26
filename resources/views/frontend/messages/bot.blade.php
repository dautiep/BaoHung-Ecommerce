      <ul class="service-wrap wrap-left">
          @if (@$message)
              <li class="supporter">
                  <div class="content-img">
                      <img src="{{ asset('chatbot/img/70.png') }}">
                  </div>
                  <div class="content-bot">{!! $message !!}</div>
              </li>
          @endif
          @if (@$data)
              {{-- src="{{ asset('chatbot/img/30.png') }}" --}}
              @foreach (@$data as $item)
                  <li><a href="javascript:void(0)" class="get_service" data-service="{{ $item->id }}"
                          data-next="{{ @$next }}"> <span> <img></span><span>{{ $item->name }}</span></a>
                  </li>
              @endforeach
          @endif
      </ul>
