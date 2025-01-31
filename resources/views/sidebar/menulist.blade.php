<nav id="sidebar">

    <div class="navbar-nav theme-brand flex-row  text-center">
        <div class="nav-logo">
            <div class="nav-item theme-logo">
                <a href="#">
                    <img src="{{ asset('backend/images/company_logo/dummy-logo.jpg') }}" class="navbar-logo" alt="logo">
                </a>
            </div>
            <div class="nav-item theme-text">
                <a href="#" class="nav-link"> MyMac </a>
            </div>
        </div>
        <div class="nav-item sidebar-toggle">
            <div class="btn-toggle sidebarCollapse">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
            </div>
        </div>
    </div>
    <div class="shadow-bottom"></div>
    @if(Auth::check())
    <ul class="list-unstyled menu-categories" id="accordionExample" >
        @if(Auth::check() && Auth::user()->role=='adminManager' || Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer')
        <li class="menu {{ (!empty($dashboard) && $dashboard==true)?'active':'' }}">
            <a href="{{ URL::to('/') }}" data-bs-toggle="" aria-expanded="true" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    <span>Dashboard</span>
                </div>
            </a>
        </li>
        @endif

        @if(Auth::check() && Auth::user()->role=='adminManager' || Auth::user()->role=='admin' || Auth::user()->role=='interviewer' || Auth::user()->role=='manager' || Auth::user()->role=='student' || Auth::user()->role=='agent' || Auth::user()->role=='subAgent')
        <li class="menu {{ (!empty($application) && $application==true)?'active':'' }}">
            <a href="#datatables1" data-bs-toggle="collapse" aria-expanded="{{ (!empty($application) && $application==true)?'true':'false' }}" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <span>Application</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="{{ (!empty($application) && $application==true)?'collapse show':'collapse' }} submenu list-unstyled" id="datatables1" data-bs-parent="#accordionExample">
                <li class="{{ (!empty($application_add) && $application_add==true)?'active':'' }}">
                    <a href="{{ URL::to('application-create') }}"> New Application</a>
                </li>

                @if(Auth::check() && Auth::user()->role=='student')
                <li class="{{ (!empty($student_portal) && $student_portal==true)?'active':'' }}">
                    <a href="{{ URL::to('student-portal') }}"> My Application</a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='adminManager')
                <li class="{{ (!empty($my_application_list) && $my_application_list==true)?'active':'' }}">
                    <a href="{{ URL::to('my-applications') }}"> My Application</a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='manager')
                <li class="{{ (!empty($my_assigned_application_list) && $my_assigned_application_list==true)?'active':'' }}">
                    <a href="{{ URL::to('my-assigned-applications') }}"> My Application</a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='subAgent')
                <li class="{{ (!empty($sub_agent_application) && $sub_agent_application==true)?'active':'' }}">
                    <a href="{{ URL::to('sub-agent-applications') }}">My Applications</a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='agent')
                <li class="{{ (!empty($incomplete_application_all) && $incomplete_application_all==true)?'active':'' }}">
                    <a href="{{ URL::to('incomplete-applications') }}">Incomplete Applications </a>
                </li>
                <li class="{{ (!empty($application_all) && $application_all==true)?'active':'' }}">
                    <a href="{{ URL::to('agent-applications') }}"> Agent Applications </a>
                </li>
                @endif

                @if(Auth::check() && Auth::user()->role=='interviewer')
                <li class="{{ (!empty($interviewer_application_list) && $interviewer_application_list==true)?'active':'' }}">
                    <a href="{{ URL::to('interviewer-applications') }}"> My Applications </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='manager')
                <li class="{{ (!empty($application_all) && $application_all==true)?'active':'' }}">
                    <a href="{{ URL::to('all-application') }}"> All Application </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='adminManager' || Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer')
                <li class="{{ (!empty($interview_list) && $interview_list==true)?'active':'' }}">
                    <a href="{{ URL::to('interview-list') }}"> Interview Schedule </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='manager' || Auth::user()->role=='interviewer' || Auth::user()->role=='adminManager' || Auth::user()->role=='admin')
                <li class="{{ (!empty($offer_request_list) && $offer_request_list==true)?'active':'' }}">
                    <a href="{{ URL::to('offer-request-list') }}"> Offer Request</a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='manager')
                <li class="{{ (!empty($application_status) && $application_status==true)?'active':'' }}">
                    <a href="{{ URL::to('all-application-status') }}"> Application Status </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='interviewer')
                <li class="{{ (!empty($application_interview_status) && $application_interview_status==true)?'active':'' }}">
                    <a href="{{ URL::to('all-interview-status') }}"> Interview Status </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer' || Auth::user()->role=='adminManager')
                <li class="{{ (!empty($application_intake) && $application_intake==true)?'active':'' }}">
                    <a href="{{ URL::to('application-intake-list') }}"> Application Intakes</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role=='adminManager' || Auth::user()->role=='admin' || Auth::user()->role=='interviewer')
        <li class="menu {{ (!empty($campus) && $campus==true)?'active':'' }}">
            <a href="#datatables2" data-bs-toggle="collapse" aria-expanded="{{ (!empty($campus) && $campus==true)?'true':'false' }}" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                    <span>Campus</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="{{ (!empty($campus) && $campus==true)?'collapse show':'collapse' }} submenu list-unstyled" id="datatables2" data-bs-parent="#accordionExample">
                @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='manager')
                <li class="{{ (!empty($campus_add) && $campus_add==true)?'active':'' }}">
                    <a href="{{ URL::to('campus-create') }}"> Add Campus</a>
                </li>
                @endif
                @if(Auth::check())
                <li class="{{ (!empty($campus_all) && $campus_all==true)?'active':'' }}">
                    <a href="{{ URL::to('all-campus') }}"> All Campus </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='manager')
                <li class="{{ (!empty($campus_archive) && $campus_archive==true)?'active':'' }}">
                    <a href="{{ URL::to('archived-campus') }}"> Archive Campus </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='manager')
                <li class="{{ (!empty($university) && $university==true)?'active':'' }}">
                    <a href="{{ URL::to('universities') }}"> Universities </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role=='agent' || Auth::user()->role=='adminManager' || Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer' || Auth::user()->role=='subAgent')
        <li class="menu {{ (!empty($course) && $course==true)?'active':'' }}">
            <a href="#datatables3" data-bs-toggle="collapse" aria-expanded="{{ (!empty($course) && $course==true)?'true':'false' }}" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                    <span>Courses</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="{{ (!empty($course) && $course==true)?'collapse show':'collapse' }} submenu list-unstyled" id="datatables3" data-bs-parent="#accordionExample">
                @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='adminManager' || Auth::user()->role=='manager')
                <li class="{{ (!empty($course_add) && $course_add==true)?'active':'' }}">
                    <a href="{{ URL::to('course-create') }}"> Add Course</a>
                </li>
                @endif

                <li class="{{ (!empty($course_all) && $course_all==true)?'active':'' }}">
                    <a href="{{ URL::to('all-course') }}"> All Course </a>
                </li>
                @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='adminManager' || Auth::user()->role=='manager')
                <li class="{{ (!empty($course_categories) && $course_categories==true)?'active':'' }}">
                    <a href="{{ URL::to('course-categories') }}"> Course Categories </a>
                </li>
                <li class="{{ (!empty($course_levels) && $course_levels==true)?'active':'' }}">
                    <a href="{{ URL::to('course-levels') }}"> Course Levels </a>
                </li>
                <li class="{{ (!empty($course_attendance) && $course_attendance==true)?'active':'' }}">
                    <a href="{{ URL::to('attendance-report') }}"> Attendance Report </a>
                </li>
                <li class="{{ (!empty($quick_attendance) && $quick_attendance==true)?'active':'' }}">
                    <a href="{{ URL::to('class/schedule/quick-attendence') }}">Quick Attendance</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role=='adminManager' || Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer')
        <!--<li class="menu {{ (!empty($attend) && $attend==true)?'active':'' }}">
            <a href="#datatables10" data-bs-toggle="collapse" aria-expanded="{{ (!empty($attend) && $attend==true)?'true':'false' }}" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                    <span>Attendence</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="{{ (!empty($attend) && $attend==true)?'collapse show':'collapse' }} submenu list-unstyled" id="datatables10" data-bs-parent="#accordionExample">
                @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='adminManager' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer')
                <li class="{{ (!empty($location_list) && $location_list==true)?'active':'' }}">
                    <a href="{{ URL::to('all-location') }}"> Locations </a>
                </li>
                <li class="{{ (!empty($teacher_list) && $teacher_list==true)?'active':'' }}">
                    <a href="{{ URL::to('teachers') }}"> Teachers </a>
                </li>
                <li class="{{ (!empty($attendence_groups) && $attendence_groups==true)?'active':'' }}">
                    <a href="{{ URL::to('attendence-groups') }}"> Attendence Groups</a>
                </li>
                <li class="{{ (!empty($attendence_overview) && $attendence_overview==true)?'active':'' }}">
                    <a href="{{ URL::to('attendence-overview') }}"> Attendence Overview</a>
                </li>
                <li class="{{ (!empty($course_all) && $course_all==true)?'active':'' }}">
                    <a href="{{ URL::to('all-course') }}"> All Course </a>
                </li>
                <li class="{{ (!empty($application_enrolled) && $application_enrolled==true)?'active':'' }}">
                    <a href="{{ URL::to('enrolled-students') }}"> Enrolled Students </a>
                </li>
                <li class="{{ (!empty($attendence_reports) && $attendence_reports==true)?'active':'' }}">
                    <a href="{{ URL::to('attendence-reports') }}"> Reports </a>
                </li>
                @endif
            </ul>
        </li>-->
        @endif
        @if(Auth::check() && Auth::user()->role=='agent' && Auth::user()->is_admin==1)
        <li class="menu {{ (!empty($agent_user) && $agent_user==true)?'active':'' }}">
            <a href="{{ URL::to('get-employee-by-agent') }}" data-bs-toggle="" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span>Users</span>
                </div>
            </a>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role=='admin')
        <li class="menu {{ (!empty($usermanagement) && $usermanagement==true)?'active':'' }}">
            <a href="{{ URL::to('user-list') }}" data-bs-toggle="" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span>Users</span>
                </div>
            </a>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role=='manager')
        <li class="menu {{ (!empty($usermanagement1) && $usermanagement1==true)?'active':'' }}">
            <a href="{{ URL::to('my-team-list') }}" data-bs-toggle="" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span>My Team</span>
                </div>
            </a>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='manager')
        <li class="menu {{ (!empty($agent_menu) && $agent_menu==true)?'active':'' }}">
            <a href="{{ URL::to('agents') }}" data-bs-toggle="" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>Agents</span>
                </div>
            </a>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='manager')
        <li class="menu {{ (!empty($studentmanagement) && $studentmanagement==true)?'active':'' }}">
            <a href="{{ URL::to('student-list') }}" data-bs-toggle="" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>Students</span>
                </div>
            </a>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role=='adminManager' || Auth::user()->role=='interviewer' || Auth::user()->role=='admin')
        <li class="menu {{ (!empty($task) && $task==true)?'active':'' }}">
            <a href="#menuLevel1" data-bs-toggle="collapse" aria-expanded="{{ (!empty($course) && $course==true)?'true':'false' }}" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                    <span>Task Management</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="{{ (!empty($task) && $task==true)?'collapse show':'collapse' }} submenu list-unstyled" id="menuLevel1" data-bs-parent="#accordionExample">
                @if(Auth::check() && Auth::user()->role=='admin')
                <li class="{{ (!empty($task_add) && $task_add==true)?'active':'' }}">
                    <a href="{{ URL::to('task-create') }}"> Create Task </a>
                </li>
                <li class="{{ (!empty($task_all) && $task_all==true)?'active':'' }}">
                    <a href="{{ URL::to('task-list') }}"> All Task </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role=='adminManager' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer')
                <li class="{{ (!empty($task_my) && $task_my==true)?'active':'' }}">
                    <a href="{{ URL::to('my-tasks') }}"> My Tasks </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role=='agent')
        <li class="menu {{ (!empty($agent_task) && $agent_task==true)?'active':'' }}">
            <a href="#menuLevel1" data-bs-toggle="collapse" aria-expanded="{{ (!empty($agent_task) && $agent_task==true)?'true':'false' }}" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                    <span>Task Management</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="{{ (!empty($agent_task) && $agent_task==true)?'collapse show':'collapse' }} submenu list-unstyled" id="menuLevel1" data-bs-parent="#accordionExample">
                @if(Auth::check() && Auth::user()->is_admin==1)
                <li class="{{ (!empty($agent_task_add) && $agent_task_add==true)?'active':'' }}">
                    <a href="{{ URL::to('agent-task-create') }}"> Create Task </a>
                </li>
                <li class="{{ (!empty($agent_task_all) && $agent_task_all==true)?'active':'' }}">
                    <a href="{{ URL::to('agent-task-list') }}"> All Task </a>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->is_admin==0)
                <li class="{{ (!empty($agent_task_my) && $agent_task_my==true)?'active':'' }}">
                    <a href="{{ URL::to('agent-my-tasks') }}"> My Tasks </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='manager')
        <li class="menu {{ (!empty($settings) && $settings==true)?'active':'' }}">
            <a href="#settings" data-bs-toggle="collapse" aria-expanded="{{ (!empty($settings) && $settings==true)?'true':'false' }}" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings "><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    <span>Settings</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="{{ (!empty($settings) && $settings==true)?'collapse show':'collapse' }} submenu list-unstyled" id="settings" data-bs-parent="#accordionExample">
                <li class="{{ (!empty($company_settings) && $company_settings==true)?'active':'' }}">
                    <a href="{{ URL::to('company-settings') }}"> Software Settings </a>
                </li>
                <li class="{{ (!empty($show_activities) && $show_activities==true)?'active':'' }}">
                    <a href="{{ URL::to('show-all-activity') }}"> Show All Activity </a>
                </li>
            </ul>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='staff')
        <li class="menu {{ (!empty($settings) && $settings==true)?'active':'' }}">
            <a href="#blog_menu" data-bs-toggle="collapse" aria-expanded="{{ (!empty($settings) && $settings==true)?'true':'false' }}" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pen-tool"><path d="M12 19l7-7 3 3-7 7-3-3z"></path><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path><path d="M2 2l7.586 7.586"></path><circle cx="11" cy="11" r="2"></circle></svg>
                    <span>Blogs</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="{{ (!empty($blog) && $blog==true)?'collapse show':'collapse' }} submenu list-unstyled" id="blog_menu" data-bs-parent="#accordionExample">
                <li class="{{ (!empty($add_blog) && $add_blog==true)?'active':'' }}">
                    <a href="{{ URL::to('create-blog') }}"> Create Blog </a>
                </li>
                <li class="{{ (!empty($blog_categories_menu) && $blog_categories_menu==true)?'active':'' }}">
                    <a href="{{ URL::to('blog-categories') }}"> Blog Categories </a>
                </li>
                <li class="{{ (!empty($blog_list_menu) && $blog_list_menu==true)?'active':'' }}">
                    <a href="{{ URL::to('list-blog') }}"> Blog List </a>
                </li>
            </ul>
        </li>
        @endif

    </ul>
    @endif

</nav>
