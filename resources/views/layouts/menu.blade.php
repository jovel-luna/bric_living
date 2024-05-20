<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3">
        <div class="text-center">
          @if(getSettings('portal-logo'))
            <img src="{{ url(getSettings('portal-logo')) }}" class="img-circle s-user-image" alt="User Image">
          @else
            <img src="{{ URL::to('/') }}/img/default-img.png" class="img-circle s-user-image" alt="User Image">
          @endif
          {{-- @if(Auth::user()->profile_image != null)
              <img src="{{ url(Auth::user()->profile_image) }}" class="img-circle s-user-image" alt="User Image">
            @else
              <img src="{{ URL::to('/') }}/img/default-img.png" class="img-circle s-user-image" alt="User Image">
          @endif --}}
        </div>
        <div class="text-center">
          <!-- <p class="s-user-role">
            @foreach (role_list() as $roles)
                @if(Auth::user()->role_id == $roles->id)
                  {{$roles->role}}
                @endif
            @endforeach
          </p>
          <p class="s-user-name">{{ Auth::user()->first_name .' '. Auth::user()->middle_name .' '. Auth::user()->last_name}}</p> -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
              <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-stats" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M19 13v-1h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h2.5"></path>
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2"></path>
                    <path d="M13 22l3 -3l2 2l4 -4"></path>
                    <path d="M19 17h3v3"></path>
                </svg>
              </span>
              <p>Property Info</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon">
                <span class="nav-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-up" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.641 0 1.212 .302 1.578 .771"></path>
                    <path d="M20.136 11.136l-8.136 -8.136l-9 9h2v7a2 2 0 0 0 2 2h6.344"></path>
                    <path d="M19 22v-6"></path>
                    <path d="M22 19l-3 -3l-3 3"></path>
                </svg>
              </i>
              <p>New Property <i class="fas fa-angle-left right"></i> </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{ route('property.create') }}" class="nav-link {{ (request()->is('property/create')) ? 'active' : '' }}">
                  <i class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>                  </i>
                  <p>Internal Property</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('get.property-external') }}" class="nav-link {{ (request()->is('property/external')) ? 'active' : '' }}">
                  <i class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  </i>
                  <p>External Property</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('location.index') }}" class="nav-link {{ (request()->is('property/external')) ? 'active' : '' }}">
                  <i class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  </i>
                  <p>Property Locations</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('entity.index') }}" class="nav-link {{ (request()->is('entity')) || (request()->is('entity/create')) || (request()->is('import-entities')) ? 'active' : '' }}">
              <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-check" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2"></path>
                    <path d="M19 13.488v-1.488h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h4.525"></path>
                    <path d="M15 19l2 2l4 -4"></path>
                </svg>
              </span>
              <p>Entity</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('acquisition.index') }}" class="nav-link {{ (request()->is('acquisition')) ? 'active' : '' }}">
              <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart-handshake" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
                    <path d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25"></path>
                    <path d="M12.5 15.5l2 2"></path>
                    <path d="M15 13l2 2"></path>
                </svg>
              </span>
              <p>Acquisition</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('development.index') }}" class="nav-link {{ (request()->is('development')) ? 'active' : '' }}">
              <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-exclamation" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M21 12l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h8"></path>
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 1.857 1.257"></path>
                    <path d="M19 16v3"></path>
                    <path d="M19 22v.01"></path>
                </svg>
              </span>
              <p>Development</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('operation.index') }}" class="nav-link {{ (request()->is('operation')) ? 'active' : '' }}">
              <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-cog" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h1.6"></path>
                    <path d="M20 11l-8 -8l-9 9h2v7a2 2 0 0 0 2 2h4.159"></path>
                    <path d="M18 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M18 14.5v1.5"></path>
                    <path d="M18 20v1.5"></path>
                    <path d="M21.032 16.25l-1.299 .75"></path>
                    <path d="M16.27 19l-1.3 .75"></path>
                    <path d="M14.97 16.25l1.3 .75"></path>
                    <path d="M19.733 19l1.3 .75"></path>
                </svg>
              </span>
              <p>Operations</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-down" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M19 12h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h5.5"></path>
                  <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2"></path>
                  <path d="M19 16v6"></path>
                  <path d="M22 19l-3 3l-3 -3"></path>
                </svg>
              </i>
              <p> Lettings <i class="fas fa-angle-left right"></i> </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{ route('letting.index') }}" class="nav-link {{ (request()->is('letting')) ? 'active' : '' }}">
                  <i class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-down" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M19 12h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h5.5"></path>
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2"></path>
                        <path d="M19 16v6"></path>
                        <path d="M22 19l-3 3l-3 -3"></path>
                    </svg>
                  </i>
                  <p>Lettings Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link {{ (request()->is('lettings/contract-info')) ? 'active' : '' }}">
                  <i class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-ribbon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M16 15h5v7l-2.5 -1.5l-2.5 1.5z"></path>
                      <path d="M20 11l-8 -8l-9 9h2v7a2 2 0 0 0 2 2h5"></path>
                      <path d="M9 21v-6a2 2 0 0 1 2 -2h1.5"></path>
                    </svg>
                  </i>
                  <p>Contract Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('lettings.history') }}" class="nav-link {{ (request()->is('lettings/history')) ? 'active' : '' }}">
                  <i class="nav-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-history" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 8l0 4l2 2"></path>
                    <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5"></path>
                  </svg>
                  </i>
                  <p>History</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('finance.index') }}" class="nav-link {{ (request()->is('finance')) ? 'active' : '' }}">
              <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-pound" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M17 18.5a6 6 0 0 1 -5 0a6 6 0 0 0 -5 .5a3 3 0 0 0 2 -2.5v-7.5a4 4 0 0 1 7.45 -2m-2.55 6h-7"></path>
                </svg>
              </span>
              <p>Finance</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('report.index') }}" class="nav-link {{ (request()->is('report')) ? 'active' : '' }}">
              <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-spreadsheet" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                  <path d="M8 11h8v7h-8z"></path>
                  <path d="M8 15h8"></path>
                  <path d="M11 11v7"></path>
                </svg>
              </span>
              <p>Reports</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('setting.index') }}" class="nav-link {{ (request()->is('setting')) ? 'active' : '' }}">
              <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                </svg>
              </span>
              <p>Settings</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>