<nav id="sidebar">

    <div class="navbar-nav theme-brand flex-row  text-center">
        <div class="nav-logo">
            {{-- <div class="nav-item theme-logo">
                <a href="">
                </a>
            </div> --}}
            <img src="{{ asset('logo/samara.png') }}" class="m-25" alt="">
            {{-- <div class="nav-item theme-text">
                <a href="" class="nav-link"> SAMARA </a>
            </div> --}}
        </div>
        <div class="nav-item sidebar-toggle">
            <div class="btn-toggle sidebarCollapse">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevrons-left">
                    <polyline points="11 17 6 12 11 7"></polyline>
                    <polyline points="18 17 13 12 18 7"></polyline>
                </svg>
            </div>
        </div>
    </div>

    <div class="profile-info">
        <div class="user-info">
            <div class="profile-img">
                <img src="{{ asset('assets/src/assets/img/profile-30.png') }}" alt="avatar">
            </div>
            <div class="profile-content">
                <h6 class="">{{ Auth::user()->name }}</h6>
                <p class="">
                    {{ Auth::user()->roles->first()->name }}
                </p>
            </div>
        </div>
    </div>

    {{-- <div class="shadow-bottom"></div> --}}
    <ul class="list-unstyled menu-categories" id="accordionExample">

        <li class="menu {{ $active == 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('dashboard.admin') }}" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span>Dashboard</span>
                </div>
            </a>
        </li>

        @can('role-list')
            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg><span>MENU ROLES PERMISSIONS</span></div>
            </li>

            <li class="menu {{ $active == 'roles' ? 'active' : '' }}">
                <a href="{{ route('dashboard.roles.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="user-check"></i>
                        <span>Roles</span>
                    </div>
                </a>
            </li>
        @endcan

        @can('user-list')
            <li class="menu menu-heading">
                <div class="heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>MENU USER</span>
                </div>
            </li>
            <li class="menu {{ $active == 'users' ? 'active' : '' }}">
                <a href="{{ route('dashboard.users.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="users"></i>
                        <span>Users</span>
                    </div>
                </a>
            </li>
        @endcan

        <li class="menu menu-heading">
            <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-minus">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg><span>MENU REIMBURSE LIST</span></div>
        </li>

        @can('category-tahun-list')
            <li class="menu {{ $active == 'category-tahun' ? 'active' : '' }}">
                <a href="{{ route('dashboard.category-tahun.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="list"></i>
                        <span>Category Tahun</span>
                    </div>
                </a>
            </li>
        @endcan

        @can('rembes-list')
            <li class="menu {{ $active == 'rembes' ? 'active' : '' }}">
                <a href="{{ route('dashboard.rembes.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="credit-card"></i>
                        <span>Data Reimburse</span>
                    </div>
                </a>
            </li>
        @endcan

        @can('submission-approved-list')
            <li class="menu {{ $active == 'submission-approved' ? 'active' : '' }}">
                <a href="{{ route('dashboard.submission-approved.index') }}" aria-expanded="false"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="check-circle"></i>
                        <span> Approved</span>
                    </div>
                    <span class="notification-badge" id="pending-sidebar-count">0</span>
                </a>
            </li>
        @endcan
        @can('submission-success-list')
            <li class="menu {{ $active == 'submission-success' ? 'active' : '' }}">
                <a href="{{ route('dashboard.submission-success.index') }}" aria-expanded="false"
                    class="dropdown-toggle">
                    <div class="">
                        <i data-feather="check-square"></i>
                        <span>Resolved</span>
                    </div>
                    <span class="notification-badge" id="approved-sidebar-count">0</span>
                </a>
            </li>
        @endcan


        {{-- <li class="menu {{ $active == 'report-rembes' ? 'active' : '' }}">
            <a href="{{ url('#') }}" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <i data-feather="file-text"></i>
                    <span>Report</span>
                </div>
            </a>
        </li>

        <li class="menu {{ $active == 'report-rembes' ? 'active' : '' }}">
            <a href="{{ url('#') }}" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <i data-feather="hard-drive"></i>
                    <span>History</span>
                </div>
            </a>
        </li>


        <li class="menu menu-heading">
            <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>MISCELLANEOUS</span>
            </div>
        </li>

        <li class="menu">
            <a href="#menuLevel1" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-list">
                        <line x1="8" y1="6" x2="21" y2="6"></line>
                        <line x1="8" y1="12" x2="21" y2="12"></line>
                        <line x1="8" y1="18" x2="21" y2="18"></line>
                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                    <span>Item Level</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="menuLevel1" data-bs-parent="#accordionExample">
                <li>
                    <a href="javascript:void(0);"> Item Level 1a </a>
                </li>
                <li>
                    <a href="javascript:void(0);"> Item Level 1b </a>
                </li>

                <li>
                    <a href="#level-three" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle collapsed"> Item Level 1c <svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg> </a>
                    <ul class="collapse list-unstyled sub-submenu" id="level-three" data-bs-parent="#pages">
                        <li>
                            <a href="javascript:void(0);"> Item Level 2a </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"> Item Level 2b </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"> Item Level 2c </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="menu">
            <a href="javascript:void(0);" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-list">
                        <line x1="8" y1="6" x2="21" y2="6"></line>
                        <line x1="8" y1="12" x2="21" y2="12"></line>
                        <line x1="8" y1="18" x2="21" y2="18"></line>
                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                    <span>Item Label</span>
                    <span class="badge badge-primary sidebar-label"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-message-circle badge-icon">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg> New</span>
                </div>
            </a>
        </li> --}}


    </ul>

</nav>

<style>
    .dropdown-toggle {
        position: relative;
        display: flex;
        align-items: center;
    }

    .notification-badge {
        margin-left: 10px;
        /* Jarak antara notifikasi dan ikon lainnya */
        background-color: red;
        /* Warna latar belakang notifikasi */
        color: white;
        /* Warna teks notifikasi */
        padding: 5px 10px;
        border-radius: 50%;
        /* Untuk membuat notifikasi menjadi bulat */
        font-size: 12px;
    }
</style>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function updatePendingSidebarCount() {
        $.ajax({
            url: '{{ route('dashboard.getPendingCount') }}',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var pendingCount = response.pendingCount;
                $('#pending-sidebar-count').text(pendingCount);
            },
            error: function(error) {
                console.error('Error fetching pending count:', error);
            }
        });
    }

    // Panggil fungsi updatePendingCount saat halaman dimuat
    $(document).ready(function() {
        updatePendingSidebarCount();
    });
</script>


<script>
    function updateApprovedSubmissionCount() {
        $.ajax({
            url: '{{ route('dashboard.getApprovedCount') }}',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var approvedCount = response.approvedCount;
                $('#approved-sidebar-count').text(approvedCount);
            },
            error: function(error) {
                console.error('Error fetching pending count:', error);
            }
        });
    }

    // Panggil fungsi updatePendingCount saat halaman dimuat
    $(document).ready(function() {
        updateApprovedSubmissionCount();
    });
</script>
