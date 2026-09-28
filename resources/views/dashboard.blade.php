 
 @extends('layouts.master')
@section('title')
Dashboard
@endsection
 @section('content')

 <div class="content-area">
      <div class="row dashboard-metrics-row">
        <div class="column-full col-md-3 card-style">
          <!-- Stat Card -->
          <div class="stat-card">
            <div class="stat-details">
              <span class="stat-label open-work-orders-text">
                Open Work Orders
              </span>
              <span class="stat-value"> 47 </span>
              <p class="display-flex font-weight-bold stat-trend-gap from-yesterday-text">
                <svg aria-hidden="true" fill="currentColor" height="12" viewbox="0 0 24 24" width="12"
                  xmlns="http://www.width-triple.org/2000/svg">
                  <path d="M24 22h-24l12-20z"></path>
                </svg>
                3 from yesterday
              </p>
            </div>
          </div>
        </div>
        <div class="column-full col-md-3 card-style">
          <!-- Stat Card -->
          <div class="stat-card">
            <div class="stat-details">
              <span class="stat-label open-work-orders-text">
                Active Technicians
              </span>
              <span class="stat-value"> 12 </span>
              <p class="display-flex font-weight-bold stat-trend-gap from-yesterday-text">
                <svg aria-hidden="true" fill="currentColor" height="10" viewbox="0 0 24 24" width="10"
                  xmlns="http://www.width-triple.org/2000/svg">
                  <circle cx="12" cy="12" r="12"></circle>
                </svg>
                9 on-site now
              </p>
            </div>
          </div>
        </div>
        <div class="column-full col-md-3 card-style">
          <!-- Stat Card -->
          <div class="stat-card">
            <div class="stat-details">
              <span class="stat-label open-work-orders-text">
                Completed Today
              </span>
              <span class="stat-value"> 8 </span>
              <p class="display-flex font-weight-bold stat-trend-gap from-yesterday-text">
                <svg aria-hidden="true" fill="currentColor" height="12" viewbox="0 0 24 24" width="12"
                  xmlns="http://www.width-triple.org/2000/svg">
                  <path d="M24 22h-24l12-20z"></path>
                </svg>
                On track
              </p>
            </div>
          </div>
        </div>
        <div class="column-full col-md-3 card-style">
          <!-- Stat Card -->
          <div class="stat-card">
            <div class="stat-details">
              <span class="stat-label open-work-orders-text">
                Pending Invoices
              </span>
              <span class="stat-value font-weight-bold text-warning-amber">
                $24,180
              </span>
              <p class="overdue-text">5 overdue</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="column-full col-lg-8 column-full col-md-8">
          <div class="panel overflow-hidden territory-mapactiveurgentsched-text">
            <div class="panel-header">
              <h2 class="panel-title font-weight-bold territory-map-text">
                Territory Map
              </h2>
              <div class="map-legend super-admin-users-text">
                <div class="legend-item">
                  <span class="legend-dot legend-dot-success"> </span>
                  Active
                </div>
                <div class="legend-item">
                  <span class="legend-dot legend-dot-danger"> </span>
                  Urgent
                </div>
                <div class="legend-item">
                  <span class="legend-dot legend-item-span"> </span>
                  Scheduled
                </div>
              </div>
            </div>
            <div class="map-container">
              <img alt="Service Area Map" class="map-img map-container-img"
                src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&amp;auto=format&amp;fit=crop&amp;w=1200&amp;q=80" />
            </div>
          </div>
          <div class="panel payment-termsnet-days-bank-text">
            <div class="territory-mapactiveurgentsched-text-alt">
              <h2 class="panel-title font-weight-bold territory-map-text">
                Technician Status
              </h2>
            </div>
            <div class="technicianstatuscurrent-josecondary-text">
              <div class="table-responsive">
                <table class="table table-custom table-hover audit-logs-text">
                  <thead>
                    <tr>
                      <th class="font-weight-bold table-th-padding technician-text">
                        Technician
                      </th>
                      <th class="font-weight-bold table-th-padding technician-text">
                        STATUS
                      </th>
                      <th class="font-weight-bold table-th-padding technician-text">
                        Current Job
                      </th>
                      <th class="font-weight-bold table-th-padding technician-text">
                        ETA
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="table-td-padding display-flex-i">
                        Marcus Rivera
                      </td>
                      <td class="table-td-padding">
                        <span class="badge-status green badge-status-inline">
                          On Site
                        </span>
                      </td>
                      <td class="table-td-padding">
                        <span> WO-2847 — Acme HVAC </span>
                      </td>
                      <td class="table-td-padding display-flex-i">—</td>
                    </tr>
                    <tr>
                      <td class="table-td-padding display-flex-i">
                        Diana Lopez
                      </td>
                      <td class="table-td-padding">
                        <span class="badge-status yellow badge-status-inline">
                          En Route
                        </span>
                      </td>
                      <td class="table-td-padding display-flex-i">
                        WO-2851 — TechStart
                      </td>
                      <td class="table-td-padding display-flex-i">12 min</td>
                    </tr>
                    <tr>
                      <td class="table-td-padding display-flex-i">
                        Jake Thornton
                      </td>
                      <td class="table-td-padding">
                        <span class="badge-status blue badge-status-inline">
                          Scheduled
                        </span>
                      </td>
                      <td class="table-td-padding display-flex-i">
                        WO-2853 — Park Hotel
                      </td>
                      <td class="table-td-padding display-flex-i">2:00 PM</td>
                    </tr>
                    <tr>
                      <td class="table-td-padding display-flex-i">
                        Amy Chen
                      </td>
                      <td class="table-td-padding">
                        <span class="badge-status green badge-status-inline">
                          On Site
                        </span>
                      </td>
                      <td class="table-td-padding display-flex-i">
                        WO-2840 — City Hall
                      </td>
                      <td class="table-td-padding display-flex-i">—</td>
                    </tr>
                    <tr>
                      <td class="table-td-padding display-flex-i">
                        Ravi Sharma
                      </td>
                      <td class="table-td-padding">
                        <span class="badge-status red badge-status-inline">
                          Overdue
                        </span>
                      </td>
                      <td class="table-td-padding display-flex-i">
                        WO-2838 — Metro Bldg
                      </td>
                      <td class="table-td-padding display-flex-i">
                        45 min late
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="column-full col-lg-4 column-full column-third">
          <div class="panel recent-activitywo-marked-text">
            <div class="panel-header">
              <h2 class="panel-title font-weight-bold territory-map-text">
                Recent Activity
              </h2>
            </div>
            <div class="tech-list">
              <a class="tech-item wo-marked-completediana-l-action" href="technicians.html">
                <div class="display-flex sidebar-div">
                  <div class="tech-avatar avatar-bg-success-pale display-flex-div">
                    <svg aria-hidden="true" fill="none" height="16" width="16">
                      <g clip-path="url(#a)" stroke="#16a34a" stroke-width="1.3">
                        <path d="M15 7v1a7 7 0 1 1-4-6"></path>
                        <path d="M15 3 8 9 6 7"></path>
                      </g>
                      <defs>
                        <clippath id="a">
                          <path d="M0 0h16v16H0z" fill="#fff"></path>
                        </clippath>
                      </defs>
                    </svg>
                  </div>
                  <div>
                    <div class="wt-medium notifications-text">
                      WO-2843 marked complete
                    </div>
                    <div class="diana-lopez-h-ago-text">
                      Diana Lopez · 2h ago
                    </div>
                  </div>
                </div>
              </a>
              <a class="tech-item wo-marked-completediana-l-action" href="technicians.html">
                <div class="display-flex sidebar-div">
                  <div class="tech-avatar avatar-bg-primary-light display-flex-div">
                    <svg aria-hidden="true" fill="none" height="16" width="16">
                      <path d="M10 1H4a1 1 0 0 0-1 2v10a1 1 0 0 0 1 2h8a1 1 0 0 0 2-2V5z" stroke="#2563eb"
                        stroke-width="1.3"></path>
                      <path d="M10 1v4h4" stroke="#2563eb" stroke-width="1.3"></path>
                    </svg>
                  </div>
                  <div>
                    <div class="wt-medium notifications-text">
                      WO-2847 created
                    </div>
                    <div class="diana-lopez-h-ago-text">
                      Sarah Kim · 3h ago
                    </div>
                  </div>
                </div>
              </a>
              <a class="tech-item wo-marked-completediana-l-action" href="technicians.html">
                <div class="display-flex sidebar-div">
                  <div class="tech-avatar avatar-bg-success-light display-flex-div">
                    <svg aria-hidden="true" fill="none" height="16" width="16">
                      <g clip-path="url(#a)" stroke="#059669" stroke-width="1.3">
                        <path d="M14 3H2L1 4v8l1 1h12l2-1V4zM1 7h15"></path>
                      </g>
                      <defs>
                        <clippath id="a">
                          <path d="M0 0h16v16H0z" fill="#fff"></path>
                        </clippath>
                      </defs>
                    </svg>
                  </div>
                  <div>
                    <div class="wt-medium notifications-text">
                      INV-10039 paid — $1,240
                    </div>
                    <div class="diana-lopez-h-ago-text">System · 4h ago</div>
                  </div>
                </div>
              </a>
              <a class="tech-item wo-marked-completediana-l-action" href="technicians.html">
                <div class="display-flex sidebar-div">
                  <div class="tech-avatar avatar-bg-danger-light display-flex-div">
                    <svg aria-hidden="true" fill="none" height="16" width="16">
                      <g clip-path="url(#a)" stroke="#dc2626" stroke-width="1.3">
                        <path d="m7 3-5 9a1 1 0 0 0 1 2h11a1 1 0 0 0 1-2l-5-9a1 1 0 0 0-3 0Zm1 3v3m0 2"></path>
                      </g>
                      <defs>
                        <clippath id="a">
                          <path d="M0 0h16v16H0z" fill="#fff"></path>
                        </clippath>
                      </defs>
                    </svg>
                  </div>
                  <div>
                    <div class="wt-medium notifications-text">
                      Urgent WO-2850 flagged
                    </div>
                    <div class="diana-lopez-h-ago-text">
                      Jake Thornton · 5h ago
                    </div>
                  </div>
                </div>
              </a>
              <a class="tech-item wo-marked-completediana-l-action" href="technicians.html">
                <div class="display-flex sidebar-div">
                  <div class="tech-avatar avatar-bg-slate-light display-flex-div">
                    <svg aria-hidden="true" fill="none" height="16" width="16">
                      <g clip-path="url(#a)" stroke="#64748b" stroke-width="1.3">
                        <path d="M11 14v-1l-3-3H4l-3 3v1m5-7a3 3 0 1 0 0-5 3 3 0 0 0 0 5Zm6 0 1 2 3-3"></path>
                      </g>
                      <defs>
                        <clippath id="a">
                          <path d="M0 0h16v16H0z" fill="#fff"></path>
                        </clippath>
                      </defs>
                    </svg>
                  </div>
                  <div>
                    <div class="wt-medium notifications-text">
                      Amy Chen checked in to WO-2840
                    </div>
                    <div class="diana-lopez-h-ago-text">
                      Amy Chen · 6h ago
                    </div>
                  </div>
                </div>
              </a>
              <a class="tech-item wo-marked-completediana-l-action" href="technicians.html">
                <div class="display-flex sidebar-div">
                  <div class="tech-avatar avatar-bg-purple-light display-flex-div">
                    <svg aria-hidden="true" fill="none" height="16" width="16">
                      <path d="M14 10v3l-1 1H4a1 1 0 0 1-2-1v-3m3-3 3 3 4-3m-4 3V2" stroke="#9333ea" stroke-width="1.3">
                      </path>
                    </svg>
                  </div>
                  <div>
                    <div class="wt-medium notifications-text">
                      12 work orders imported from iVerticle
                    </div>
                    <div class="diana-lopez-h-ago-text">System · 8h ago</div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endsection