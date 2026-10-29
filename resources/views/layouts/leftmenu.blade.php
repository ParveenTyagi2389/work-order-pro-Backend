  <input class="display-none" id="sidebar-toggle" type="checkbox" />
  <!-- SIDEBAR NAVIGATION -->
  <aside class="sidebar" id="sidebarMenu" tabindex="-1">
    <div class="sidebar-header sidebar-div">
      <img alt="Logo" class="brand-text" src="{{ asset('images/work-order.svg') }}" />
      <label aria-label="Close" class="btn-close display-md-none cursor-pointer sidebar-header-label"
        for="sidebar-toggle">
      </label>
    </div>
    <!-- NAVIGATION MENU -->
    <nav class="nav-menu">
      <a class="nav-item {{ request()->routeIs('dashboard', 'dashboard.*') ? 'active' : '' }}"
        href="{{ route('dashboard') }}">
        <svg aria-hidden="true" fill="none" height="20" viewBox="0 0 20 20" width="20">
          <path d="M8 3H3v5h5zm10 0h-6v5h6zM8 12H3v6h5zm10 0h-6v6h6z"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.7">
          </path>
        </svg>
        Dashboard
      </a>
      <a class="nav-item {{ request()->routeIs('work-orders.*') ? 'active' : '' }}" href="{{ route('work-orders.index') }}">

        <svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M5.625 3.125H4.375C4.04348 3.125 3.72554 3.2567 3.49112 3.49112C3.2567 3.72554 3.125 4.04348 3.125 4.375V11.875C3.125 12.2065 3.2567 12.5245 3.49112 12.7589C3.72554 12.9933 4.04348 13.125 4.375 13.125H10.625C10.9565 13.125 11.2745 12.9933 11.5089 12.7589C11.7433 12.5245 11.875 12.2065 11.875 11.875V4.375C11.875 4.04348 11.7433 3.72554 11.5089 3.49112C11.2745 3.2567 10.9565 3.125 10.625 3.125H9.375" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M8.75 1.875H6.25C5.90482 1.875 5.625 2.15482 5.625 2.5V3.75C5.625 4.09518 5.90482 4.375 6.25 4.375H8.75C9.09518 4.375 9.375 4.09518 9.375 3.75V2.5C9.375 2.15482 9.09518 1.875 8.75 1.875Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M5.625 7.5H9.375" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M5.625 10H8.125" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        Work Orders
      </a>

      <a class="nav-item {{ request()->routeIs('bill-to.*') ? 'active' : '' }}" href="{{ route('bill-to.index') }}">

        <svg aria-hidden="true" fill="none" height="20" viewbox="0 0 20 20" width="20">
          <path d="M12 2H5L3 3v14l2 1h10l2-1V7z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="1.7"></path>
          <path d="M12 2v5h5m-4 4H7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="1.7"></path>
        </svg>
        Billing Accounts
      </a>
     <a class="nav-item {{ request()->routeIs('invoices.*') ? 'active' : '' }}" href="{{ route('invoices.index') }}">

        <svg aria-hidden="true" fill="none" height="20" viewbox="0 0 20 20" width="20">
          <path d="M12 2H5L3 3v14l2 1h10l2-1V7z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="1.7"></path>
          <path d="M12 2v5h5m-4 4H7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="1.7"></path>
        </svg>
        Invoices
      </a>
      <a class="nav-item {{ request()->routeIs('technicians.*') ? 'active' : '' }}" href="{{ route('technicians.index') }}">
        <img alt="" src="/images/technician.svg" />
        Technicians
      </a>
       <a class="nav-item {{ request()->routeIs('technician-payroll.*') ? 'active' : '' }}" href="{{ route('technician-payroll.index') }}">
        <img alt="" src="/images/technician.svg" />
        Technicians payroll
      </a>
      <a class="nav-item {{ request()->routeIs('customer-types.*') ? 'active' : '' }}" href="{{ route('customer-types.index') }}">
        <svg aria-hidden="true" fill="none" height="20" viewbox="0 0 20 20" width="20">
          <path d="M14 18v-2l-3-3H4l-3 3v2m6-9a3 3 0 1 0 0-7 3 3 0 0 0 0 7m12 9v-2l-2-3M13 3a3 3 0 0 1 0 6"
            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"></path>
        </svg>
        Customer Types
      </a>
      <a class="nav-item {{ request()->routeIs('sites.*') ? 'active' : '' }}" href="{{ route('sites.index') }}">
        <svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M7.5 0.5C4.64828 0.5 2.32833 2.81995 2.32833 5.67166C2.32833 6.61047 2.74937 7.62016 2.76701 7.66276C2.903 7.98553 3.17132 8.48687 3.3648 8.78075L6.91073 14.1535C7.05584 14.3738 7.27062 14.5 7.5 14.5C7.72938 14.5 7.94415 14.3738 8.08926 14.1538L11.6355 8.78075C11.8293 8.48687 12.0973 7.98553 12.2333 7.66276C12.2509 7.62047 12.6717 6.61078 12.6717 5.67166C12.6717 2.81995 10.3517 0.5 7.5 0.5ZM11.6723 7.42668C11.5509 7.71599 11.3012 8.18236 11.1275 8.44581L7.58122 13.8189C7.51126 13.925 7.48905 13.925 7.41908 13.8189L3.87284 8.44581C3.69913 8.18236 3.44937 7.71569 3.32799 7.42638C3.32282 7.41391 2.93677 6.48453 2.93677 5.67166C2.93677 3.1555 4.98383 1.10843 7.5 1.10843C10.0162 1.10843 12.0632 3.1555 12.0632 5.67166C12.0632 6.48575 11.6763 7.41756 11.6723 7.42668Z" fill="currentColor" stroke="currentColor" stroke-width="0.5" />
          <path d="M7.5 2.93404C5.99018 2.93404 4.76206 4.16246 4.76206 5.67198C4.76206 7.18149 5.99018 8.40992 7.5 8.40992C9.00982 8.40992 10.2379 7.18149 10.2379 5.67198C10.2379 4.16246 9.00982 2.93404 7.5 2.93404ZM7.5 7.80148C6.32603 7.80148 5.37049 6.84625 5.37049 5.67198C5.37049 4.4977 6.32603 3.54247 7.5 3.54247C8.67397 3.54247 9.62951 4.4977 9.62951 5.67198C9.62951 6.84625 8.67397 7.80148 7.5 7.80148Z" fill="currentColor" stroke="currentColor" stroke-width="0.5" />
        </svg>
        Sites
      </a>
      <a class="nav-item {{ request()->routeIs('job-pictures.*') ? 'active' : '' }}" href="{{ route('job-pictures.index') }}">
      <svg aria-hidden="true" fill="none" height="20" viewbox="0 0 20 20" width="20">
          <path d="M14 18v-2l-3-3H4l-3 3v2m6-9a3 3 0 1 0 0-7 3 3 0 0 0 0 7m12 9v-2l-2-3M13 3a3 3 0 0 1 0 6"
            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"></path>
        </svg>
        Job Pictures
      </a>
      <a class="nav-item {{ request()->routeIs('store-pictures.*') ? 'active' : '' }}" href="{{ route('store-pictures.index') }}">
       <svg aria-hidden="true" fill="none" height="20" viewbox="0 0 20 20" width="20">
          <path d="M14 18v-2l-3-3H4l-3 3v2m6-9a3 3 0 1 0 0-7 3 3 0 0 0 0 7m12 9v-2l-2-3M13 3a3 3 0 0 1 0 6"
            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"></path>
        </svg>
        Store Pictures
      </a>
      
      @php
          $isJobManagementActive = request()->routeIs(
              'job-codes.*',
              'colors.*',
              'shapes.*',
              'parts.*',
              'job-parts.*',
              'job-flat-rates.*',
              'job-billables.*',
              'job-reimbursements.*'
          );
      @endphp

      <div class="dropdown">

          {{-- Job Management parent menu --}}
          <a class="nav-item dropdown-toggle {{ $isJobManagementActive ? 'active' : '' }}"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="{{ $isJobManagementActive ? 'true' : 'false' }}">

              <svg xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <rect x="3" y="7" width="18" height="13" rx="2" />
                  <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                  <path d="M3 12h18" />
                  <path d="M10 12v2h4v-2" />
              </svg>

              Job Management
          </a>

          {{-- Submenu --}}
          <ul class="dropdown-menu drop-menu {{ $isJobManagementActive ? 'show' : '' }}">

              {{-- Job Codes --}}
              <li>
                  <a class="nav-item dropdown-item {{ request()->routeIs('job-codes.*') ? 'active' : '' }}"
                    href="{{ route('job-codes.index') }}">
                      <svg aria-hidden="true" fill="none" height="20"
                          viewBox="0 0 20 20" width="20">
                          <g stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2">
                              <path d="M10 2H3L2 3v7l7 8h3l6-6V9z" />
                          </g>
                          <circle cx="6" cy="6" r="1" fill="currentColor" />
                      </svg>
                      Job Codes
                  </a>
              </li>

              {{-- Colors --}}
              <li>
                  <a class="nav-item dropdown-item {{ request()->routeIs('colors.*') ? 'active' : '' }}"
                    href="{{ route('colors.index') }}">
                      <svg aria-hidden="true" fill="none" height="20"
                          width="20" viewBox="0 0 20 20">
                          <path d="M10 2a8 8 0 1 0 0 16h1.2a2 2 0 0 0 1.5-3.3
                                  1.5 1.5 0 0 1 1.1-2.5H15a3 3 0 0 0 3-3
                                  7.5 7.5 0 0 0-8-7.2Z"
                                stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" />
                          <circle cx="6.5" cy="9" r="1" fill="currentColor" />
                          <circle cx="9" cy="5.5" r="1" fill="currentColor" />
                          <circle cx="13" cy="6.5" r="1" fill="currentColor" />
                          <circle cx="15" cy="9.5" r="1" fill="currentColor" />
                      </svg>
                      Colors
                  </a>
              </li>

              {{-- Shapes --}}
              <li>
                  <a class="nav-item dropdown-item {{ request()->routeIs('shapes.*') ? 'active' : '' }}"
                    href="{{ route('shapes.index') }}">
                      <svg aria-hidden="true" fill="none" height="20"
                          width="20" viewBox="0 0 20 20">
                          <circle cx="5" cy="5" r="3"
                                  stroke="currentColor" stroke-width="1.7" />
                          <rect x="11" y="2" width="6" height="6" rx="1"
                                stroke="currentColor" stroke-width="1.7" />
                          <path d="M10 18 5.5 10h9L10 18Z"
                                stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                      Shapes
                  </a>
              </li>

              {{-- Parts --}}
              <li>
                  <a class="nav-item dropdown-item {{ request()->routeIs('parts.*') ? 'active' : '' }}"
                    href="{{ route('parts.index') }}">
                      <svg aria-hidden="true" fill="none" height="20"
                          viewBox="0 0 20 20" width="20">
                          <path d="M17 6H3L2 8v8l1 2h14l1-2V8zm-4 0V4l-1-1H8L7 4v2"
                                stroke="currentColor" stroke-width="1.3" />
                      </svg>
                      Parts
                  </a>
              </li>

              {{-- Job Parts --}}
              <li>
                  <a class="nav-item dropdown-item {{ request()->routeIs('job-parts.*') ? 'active' : '' }}"
                    href="{{ route('job-parts.index') }}">
                      <svg aria-hidden="true" fill="none" height="20"
                          viewBox="0 0 20 20" width="20">
                          <path d="M17 6H3L2 8v8l1 2h14l1-2V8zm-4 0V4l-1-1H8L7 4v2"
                                stroke="currentColor" stroke-width="1.3" />
                      </svg>
                      Job Parts
                  </a>
              </li>

              {{-- Job Flat Rates --}}
              <li>
                  <a class="nav-item dropdown-item {{ request()->routeIs('job-flat-rates.*') ? 'active' : '' }}"
                    href="{{ route('job-flat-rates.index') }}">
                      <svg aria-hidden="true" fill="none" height="20"
                          viewBox="0 0 20 20" width="20">
                          <path d="M17 6H3L2 8v8l1 2h14l1-2V8zm-4 0V4l-1-1H8L7 4v2"
                                stroke="currentColor" stroke-width="1.3" />
                      </svg>
                      Job Flat Rates
                  </a>
              </li>

              <li>
                  <a class="nav-item dropdown-item {{ request()->routeIs('job-billables.*') ? 'active' : '' }}"
                    href="{{ route('job-billables.index') }}">
                      <svg aria-hidden="true" fill="none" height="20"
                          viewBox="0 0 20 20" width="20">
                          <path d="M17 6H3L2 8v8l1 2h14l1-2V8zm-4 0V4l-1-1H8L7 4v2"
                                stroke="currentColor" stroke-width="1.3" />
                      </svg>
                      Job Billables
                  </a>
              </li>

              <li>
                  <a class="nav-item dropdown-item {{ request()->routeIs('job-reimbursements.*') ? 'active' : '' }}"
                    href="{{ route('job-reimbursements.index') }}">
                      <svg aria-hidden="true" fill="none" height="20"
                          viewBox="0 0 20 20" width="20">
                          <path d="M17 6H3L2 8v8l1 2h14l1-2V8zm-4 0V4l-1-1H8L7 4v2"
                                stroke="currentColor" stroke-width="1.3" />
                      </svg>
                      Job Reimbursements
                  </a>
              </li>
             

          </ul>
      </div>
      

     
      {{--

      <a class="nav-item" href="access-level.html">
        <svg aria-hidden="true" fill="none" height="20" viewbox="0 0 20 20" width="20">
          <path d="M16 9H4l-1 2v6l1 1h12l2-1v-6zM6 9V6a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="1.3"></path>
        </svg>
        Access Level
      </a>
      <a class="nav-item" href="audit-logs.html">
        <svg aria-hidden="true" fill="none" height="20" viewbox="0 0 20 20" width="20">
          <path d="M10 18s7-3 7-8V4l-7-2-7 2v6c0 5 7 8 7 8Z" stroke="currentColor" stroke-width="1.3"></path>
        </svg>
        Audit Logs
      </a> --}}
    </nav>
    <div class="sidebar-footer">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="nav-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                          this.closest('form').submit();">
          <svg aria-hidden="true" fill="none" height="20" viewbox="0 0 20 20" width="20">
            <path d="M8 18H4l-1-2V4l1-1h4m5 11 5-4-5-4m5 4H8" stroke="currentColor" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="1.7"></path>
          </svg>
          Logout
        </a>
      </form>

    </div>
  </aside>