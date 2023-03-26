  @if (!empty(@$config_nav_bar['child_category']) && $config_nav_bar['status_category'] === true)
      <div class="nav-item dropdown">
          <a href="#" class="nav-link"
              data-toggle="dropdown">{{ @$config_nav_bar['name_category'] }} <i
                  class="fa fa-angle-down float-right mt-1"></i></a>
          <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
              @foreach ($config_nav_bar['child_category'] as $drop_item)
                  @if (@$drop_item['status_category'] === true)
                      <a href="{{ @$drop_item['router_category'] }}"
                          class="dropdown-item">{{ @$drop_item['name_category'] }}</a>
                  @endif
              @endforeach
          </div>
      </div>
  @elseif(@$config_nav_bar['status_category'] === true)
      <a href="{{ @$config_nav_bar['router_category'] }}" class="nav-item nav-link">{{ @$config_nav_bar['name_category'] }}</a>
  @endif
