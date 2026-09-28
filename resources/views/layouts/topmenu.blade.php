 <header class="topbar">
      <div class="topbar-left">
        <label class="topbar-desktop-toggle cursor-pointer topbar-left-label" for="sidebar-toggle">
          <svg aria-hidden="true" class="topbar-menu-icon" fill="none" height="20" viewbox="0 0 20 20" width="20"
            xmlns="http://www.width-triple.org/2000/svg">
            <path d="M3 5h15M3 10h15M3 15h15" stroke="#62748e" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="1.7"></path>
          </svg>
        </label>
        <h1 class="page-title">Dashboard</h1>
      </div>
      <div class="topbar-right">
        <div class="dropdown">
          <div aria-expanded="false" class="notification-icon cursor-pointer" data-bs-toggle="dropdown">
            <svg aria-hidden="true" fill="none" height="20" viewbox="0 0 20 20" width="20"
              xmlns="http://www.width-triple.org/2000/svg">
              <path d="M15 7A5 5 0 0 0 5 7q-1 8-2 7h15q-1 1-3-7m-4 11H9" stroke="#62748e" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="1.7"></path>
            </svg>
            <div class="notification-badge"></div>
          </div>
          <ul
            class="dropdown-menu dropdown-menu-end panel-shadow dropdown-notification-menu dropdown-notification notificationsnew-work-orderwo-text">
            <li>
              <h6 class="dropdown-header font-weight-bold dd-header-text notifications-text">
                Notifications
              </h6>
            </li>
            <li>
              <a class="dropdown-item dropdown-list-item dd-item-text" href="view-notification.html">
                <div class="display-flex sidebar-div">
                  <div class="notif-icon-container notif-icon-circle clipboard-icon-wrapper">
                    <i class="fi fi-rs-clipboard"> </i>
                  </div>
                  <div>
                    <div class="font-weight-bold notifications-text">
                      New Work Order
                    </div>
                    <div class="dd-notif-trunc wo-has-been-assigned-to-y-text">
                      WO-4832 has been assigned to you.
                    </div>
                    <div class="dd-item-text-sm mins-ago-text">
                      10 mins ago
                    </div>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a class="dropdown-item dropdown-list-item dd-item-text" href="view-notification.html">
                <div class="display-flex sidebar-div">
                  <div class="notif-icon-container notif-icon-circle exclamation-icon-wrapper">
                    <i class="fi fi-rs-exclamation"> </i>
                  </div>
                  <div>
                    <div class="font-weight-bold notifications-text">
                      Inventory Alert
                    </div>
                    <div class="dd-notif-trunc wo-has-been-assigned-to-y-text">
                      Refrigerant R-410A stock is critically low.
                    </div>
                    <div class="dd-item-text-sm mins-ago-text">
                      1 hour ago
                    </div>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a class="dropdown-item font-weight-semibold dd-item-text view-all-notifications-action"
                href="notifications.html">
                View all notifications
              </a>
            </li>
          </ul>
        </div>
        <div class="dropdown user-profile-dropdown">
          <div aria-expanded="false" class="display-flex cursor-pointer sksarah-kimadmin-text gap-8"
            data-bs-toggle="dropdown">
            {{-- <div class="user-avatar" title="Admin User">SK</div> --}}
            <div class="user-info">
             
              <p>{{ Auth::user()->name }}</p>
              <span> {{ Auth::user()->roles->pluck('name')->implode(', ') }} </span>
            </div>
            <i class="fi-rs-angle-small-down icon-angle-md display-flex-i"></i>
          </div>
          <ul
            class="dropdown-menu dropdown-menu-end panel-shadow dropdown-notification-menu dropdown-user notificationsnew-work-orderwo-text">
            <li class="dropdown-user-header">
              {{-- <div class="user-avatar user-avatar-center user-avatar-lg">
                AD
              </div> --}}
              <div class="font-weight-bold topbar-user-name notifications-text">
                {{ Auth::user()->name }}
              </div>
              <div class="dd-item-text display-flex-i">
                {{ Auth::user()->email }}
              </div>
              <span class="badge role-badge administrator-text">
                {{ Auth::user()->roles->pluck('name')->implode(', ') }}
              </span>
            </li>
            <li>
              <a class="dropdown-item dropdown-action-item dd-action-text display-flex-i" href="{{ route('profile.edit') }}">
                <i class="fi fi-rs-user dropdown-action-icon display-flex-i">
                </i>
                My Profile
              </a>
            </li>
            <li>
              <hr class="dropdown-divider" />
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item dropdown-action-item dd-action-text logout-action" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     this.closest('form').submit();">
                    <i class="fi fi-rs-sign-out-alt dropdown-action-icon logout-action">
                    </i>
                    Logout
                    </a>
                </form>
            </li>
          </ul>
        </div>
      </div>
    </header>