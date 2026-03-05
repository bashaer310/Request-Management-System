
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('requests.index') }}">
            <i class="fas fa-project-diagram"></i> Sahab ERP
        </a>

        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Requests -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('requests.index') }}">
                        <i class="fas fa-list"></i> الطلبات
                    </a>
                </li>

                <!-- Notifications with Badge -->
                <li class="nav-item position-relative">
                    <a class="nav-link" href="{{ route('notifications.index') }}">
                        <i class="fas fa-bell"></i> الإشعارات
                    </a>
                </li>

                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') ?? '#' }}">
                                <i class="fas fa-user"></i> الملف الشخصي
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>