  @if (!empty(@$categories['child_category']) && $categories['status_category'] === true)
      <div class="nav-item dropdown">
          <a href="#" class="nav-link"
              data-toggle="dropdown">{{ @$categories['name_category'] }} <i
                  class="fa fa-angle-down float-right mt-1"></i></a>
          <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
              @foreach ($categories['child_category'] as $drop_item)
                  @if (@$drop_item['status_category'] === true)
                      <a href="{{ @$drop_item['router_category'] }}"
                          class="dropdown-item">{{ @$drop_item['name_category'] }}</a>
                  @endif
              @endforeach
          </div>
      </div>
  @elseif(@$categories['status_category'] === true)
      <a href="{{ @$categories['router_category'] }}" class="nav-item nav-link">{{ @$categories['name_category'] }}</a>
  @endif
