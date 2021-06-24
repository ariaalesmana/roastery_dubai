<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <center><img src="{{ asset('techone/images/' . $style->logo) }}" height="40" width="120"></center>
    </a>
    @if(!Auth::guest())
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown d-md-down-none">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="icon-bell"></i>
                @if(get_vendor_notification(Auth::user())['total'] > '0')
                    <span class="badge badge-pill badge-danger">{{ get_vendor_notification(Auth::user())['total'] }}</span>
                @else
                    <span class="badge badge-pill"></span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xl">
                <div class="dropdown-header text-center">
                    @if(get_vendor_notification(Auth::user())['total'] > 0)
                        <strong>Anda mempunyai {{ get_vendor_notification(Auth::user())['total'] }} notifikasi baru</strong>
                    @else
                        <strong>Tidak ada notifikasi</strong>
                    @endif
                </div>
                @foreach(get_vendor_notification(Auth::user())['notification'] as $n)
                    <a class="dropdown-item" href="#" @if($n->isread == 0) style="background: rgba(255, 0, 0, 0.1)" @else style="background-color:white" @endif>
                        <div class="message">
                            <div>
                                <small class="text-muted">{{ $n->user->first_name }} {{ $n->user->last_name }}</small>
                                <small class="text-muted float-right mt-1">{{ date('d-M-Y', strtotime($n->updated_at)) }}</small>
                            </div>
                            <div class="text-truncate font-weight-bold">
                                <span class="fa fa-exclamation text-danger"></span> {{ $n->title }}
                            </div>
                            <div class="small text-muted text-truncate">No Order {{ $n->order_number }}</div>
                            <div class="small text-muted text-truncate">{{ $n->message }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="img-avatar" src="{{ asset('images/user.png') }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>{{ Auth::user()->email }}</strong>
                </div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
            </div>
        </li>
    </ul>
    @endif
</header>