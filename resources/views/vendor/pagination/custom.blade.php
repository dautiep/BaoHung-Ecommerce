@if ($paginator->hasPages())
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="dataTables_paginate paging_full_numbers">
                <ul class="pagination mt-3">
                    @if ($paginator->onFirstPage())
                        <li class="paginate_button page-item first disabled">
                            <a href="javascript:;" class="page-link"><i class="fa fa-angle-double-left"></i></a>
                        </li>
                        <li class="paginate_button page-item previous disabled" >
                            <a href="javascript:;" class="page-link"><i class="fa fa-angle-left"></i></a>
                        </li>
                    @else
                        <li class="paginate_button page-item first">
                            <a href="{{ $paginator->url(1) }}"   class="page-link"><i class="fa fa-angle-double-left"></i></a>
                        </li>
                        <li class="paginate_button page-item previous" >
                            <a href="{{ $paginator->previousPageUrl() }}" class="page-link"><i class="fa fa-angle-left"></i></a>
                        </li>
                    @endif

                    @foreach ($elements as $k => $element)
                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif

                        @php $k = 1; @endphp
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($k > 4)
                                    @break
                                @endif
                                @if ($paginator->lastPage() > 4)
                                    @if ($paginator->currentPage() == 3 || $paginator->currentPage() <= $paginator->lastPage() - 2)
                                        @if ($page <= $paginator->currentPage() - 2)
                                            @continue
                                        @else
                                            @php $k++; @endphp
                                        @endif
                                    @endif

                                    @if ($paginator->currentPage() > $paginator->lastPage() - 2)
                                        @if ($paginator->currentPage() == $paginator->lastPage())
                                            @if ($page < $paginator->currentPage() - 3 && $page >= 1)
                                                @continue
                                            @else
                                                @php $k++; @endphp
                                            @endif
                                        @else
                                            @if ($page < $paginator->currentPage() - 2 && $page >= 1)
                                                @continue
                                            @else
                                                @php $k++; @endphp
                                            @endif
                                        @endif
                                    @endif
                                @else
                                    @php $k++; @endphp
                                @endif
                                <li class="paginate_button page-item {{ ($paginator->currentPage() == $page) ? ' active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <li class="paginate_button page-item next">
                            <a href="{{ $paginator->nextPageUrl() }}" class="page-link"><i class="fa fa-angle-right"></i></a>
                        </li>
                        <li class="paginate_button page-item last">
                            <a href="{{$paginator->url($paginator->lastPage())}}" class="page-link"><i class="fa fa-angle-double-right"></i></a>
                        </li>
                    @else
                        <li class="paginate_button page-item next disabled">
                            <a href="javascript:;" class="page-link"><i class="fa fa-angle-right"></i></a>
                        </li>
                        <li class="paginate_button page-item last disabled">
                            <a href="javascript:;" class="page-link"><i class="fa fa-angle-double-right"></i></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif
