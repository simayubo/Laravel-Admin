<nav class="navbar-default navbar-static-side " style="background: #2f4050; position: fixed;z-index: 2001;height: 100%;overflow-x: hidden; overflow-y: auto;" role="navigation">
    <div class="sidebar-collapse" id="xxx">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::guard('admin')->user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Welcome !</span> </span> </a>

                </div>
                <div class="logo-element">
                    Admin CP
                </div>
            </li>
            <li class="{{ active_class(if_uri_pattern(['admin']),'active') }}"><a href="{{ url('admin') }}"><i class="fa fa-th-large"></i> 控制台</a></li>
            @foreach($sidebarMenus as $item)
                {{--@permission(($item['slug']))--}}
                @if(!empty($item['child']))
                <li class="{{ active_class(if_uri_pattern(explode(',',$item['heightlight_url']))) }}">
                    @if(empty($item['child']))
                        <a href="{{ url($item['url']) }}"><i class="{{ $item['icon'] }}"></i> <span class="nav-label">{{ $item['name'] }}</span>  </a>
                        @else
                    <a href="{{ url($item['url']) }}"><i class="{{ $item['icon'] }}"></i> <span class="nav-label">{{ $item['name'] }}</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level {{ active_class(if_uri_pattern([$item['heightlight_url']]),'block','none') }}">
                        @foreach($item['child'] as $_item)
                            @permission(($_item['slug']))
                            <li class="{{ active_class(if_uri_pattern([$_item['heightlight_url']]),'active') }}"><a href="{{ url($_item['url']) }}">{{ $_item['name'] }}</a></li>
                            @endpermission
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endif
                {{--@endpermission--}}
             @endforeach
        </ul>
    </div>
</nav>
