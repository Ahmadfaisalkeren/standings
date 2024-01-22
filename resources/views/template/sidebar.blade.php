<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('club.index') }}" class="nav-link {{ Request::routeIs('club.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Club Data
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('score.index') }}" class="nav-link {{ Request::routeIs('score.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                    Match Result
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('standing.index')}}" class="nav-link {{ Request::routeIs('standing.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                    Standings
                </p>
            </a>
        </li>
    </ul>
</nav>

