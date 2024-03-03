<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link @if(request()->is('dashboard')) active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
      <li class="nav-item">
        <a href="{{route('agents.index')}}" class="nav-link @if(request()->is('dashboard/agents')) active @endif">
            <i class="nav-icon fas fa-user-tie"></i>
          <p>
            Agents
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('clients.index')}}" class="nav-link @if(request()->is('dashboard/clients')) active @endif">
            <i class="nav-icon fas fa-users"></i>
          <p>
            Clients
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('sales.index')}}" class="nav-link @if(request()->is('dashboard/sales')) active @endif">
          <i class="nav-icon fas fa-user-friends"></i>
          <p>
            Sales
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('logout')}}" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>
            Logout
          </p>
        </a>
      </li>
    </ul>
  </nav>
