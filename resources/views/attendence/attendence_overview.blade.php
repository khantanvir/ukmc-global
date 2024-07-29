@extends('adminpanel')
@section('admin')
<style>
    .assignToBtn{
        color: #f7bd1a !important;
        margin-left: 14px;
        font-size: 15px !important;
    }
    .form-control{
        padding: 0.45rem 1rem !important;
        font-size: 13px !important;
    }
    .time-label {
        text-align: right !important;
        padding-right: 10px !important;
        font-weight: bold !important;
        background-color: transparent !important;
        border: none !important;
        font-size: 13px !important;
    }
    .schedule-table th, .schedule-table td {
        text-align: center;
        vertical-align: middle;
    }
    /* .schedule-table thead {
        background-color: #007bff;
        color: white;
    } */

    .badge-danger {
        display: block;
        margin-bottom: 5px;
    }
    .schedule-container {
        margin-top: 50px;
    }
    .time-th{
        border: none !important;
        width: 20px !important;
    }
</style>

<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <div class="secondary-nav">
            <div class="breadcrumbs-container" data-page-heading="Analytics">
                <header class="header navbar navbar-expand-sm">
                    <a href="javascript:void(0);" class="btn-toggle sidebarCollapse" data-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    </a>
                    <div class="d-flex breadcrumb-content">
                        <div class="page-header">
                            <div class="page-title">
                            </div>
                            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Teacher</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                </header>
            </div>
        </div>
        <h5 class="p-3">Attendence Overview</h5>
        <div class="widget-content widget-content-area">
            <form method="get" action="">
                 <div class="row mb-2">
                     <div class="col-2">
                        <select id="course_id" name="course_id" class="form-control" onchange="get_intake_data()">
                            <option value="">Select Course</option>
                            @forelse($course_list as $key => $courseRow)
                            <option value="{{ $courseRow->id ?? '' }}">{{ $courseRow->course_name ?? '' }}</option>
                            @empty

                            @endforelse

                        </select>
                     </div>
                     <div class="col-2">
                        <select id="intake_id" name="intake_id" class="form-control">
                            <option value="">Select Intake</option>
                        </select>
                     </div>
                     <div class="col-2">
                        <select id="assign_to_interviewer_user_id" name="assign_to_interviewer_user_id" class="form-control">
                            <option value="">Select Group</option>
                            <option value="">Group 1</option>
                        </select>
                     </div>
                     <div class="col-2">
                        <select id="assign_to_interviewer_user_id" name="assign_to_interviewer_user_id" class="form-control">
                            <option value="">Select Subject</option>
                            <option value="">Subject 1</option>
                        </select>
                     </div>
                     <div class="col-2">
                        <select id="assign_to_interviewer_user_id" name="assign_to_interviewer_user_id" class="form-control">
                            <option value="">Select Campus</option>
                            <option value="">Campus 1</option>
                        </select>
                     </div>
                     <div class="col-2">
                        <select id="assign_to_interviewer_user_id" name="assign_to_interviewer_user_id" class="form-control">
                            <option value="">Select Teacher</option>
                            <option value="">Teacher 1</option>
                        </select>
                     </div>

                 </div>
                 <div class="row">
                    <div class="col-2">
                        <input value="{{ $get_from_date ?? '' }}" name="from_date" type="date" class="form-control">
                    </div>
                    <div class="col-4">
                        <input value="{{ (!empty($get_name))?$get_name:'' }}" name="name" type="text" class="form-control" placeholder="Enter Schedue Title">
                    </div>
                    <div class="col-1">
                        <input type="submit" value="Filter" name="time" class="btn btn-warning">
                     </div>
                     <div class="col">
                        <a href="#" class="btn btn-danger">Reset</a>
                     </div>
                     <div class="col">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Create
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <li><a data-bs-toggle="modal" data-bs-target="#timeTableModal" class="dropdown-item" href="#">Create Timetable</a></li>
                                    <li><a data-bs-toggle="modal" data-bs-target="#groupModal" class="dropdown-item" href="#">Create Group</a></li>
                                </ul>
                            </div>
                        </div>
                     </div>
                 </div>
            </form>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="schedule-table">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="time-th"></th>
                                            @foreach ($date_list as $list)
                                                <th>
                                                    <span>{{ $list['weekday'] }}</span><br>
                                                    <span>{{ $list['date'] }}</span>
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($get_times as $time)
                                            <tr>
                                                <td class="time-label">{{ $time['key'] }}</td>
                                                @foreach ($date_list as $list)
                                                    <td>
                                                        @if (isset($scheduleData[$list['date']][$time['val']]))
                                                            @foreach ($scheduleData[$list['date']][$time['val']] as $key => $schedule)
                                                                <span class="badge badge-danger">
                                                                    {{ $schedule->title }} ({{ $schedule->time_from }} - {{ $schedule->time_to }})
                                                                </span><br>
                                                            @endforeach
                                                        @else
                                                            <span></span>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<script src="{{ asset('web/js/jquery.js') }}"></script>
<script>
    // Adjust time labels height based on table row height
    window.addEventListener('load', function() {
        const rows = document.querySelectorAll('.schedule-table tbody tr');
        const timeLabels = document.querySelectorAll('.time-labels .time-label');
        const rowHeight = rows[0].offsetHeight;

        // Adjust the height of time labels to match the row height
        timeLabels.forEach(label => {
            label.style.height = `${rowHeight}px`;
        });
    });
</script>
<script>
    function get_intake_data(){
        var getId = $('#course_id').val();
        $.get('{{ URL::to('get-intake-data-from-attendence') }}/'+getId,function(data,status){
            if(data['result']['key']===200){
                console.log(data['result']['val']);
                $('#intake_id').html(data['result']['val']);
            }
        });
    }
</script>
@stop
