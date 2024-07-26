@extends('adminpanel')
@section('admin')
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
                                    <li class="breadcrumb-item"><a href="#">Group</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Report</li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                </header>
            </div>
        </div>
        <h5 class="pt-3">Filter</h5>
        <div class="widget-content widget-content-area">
            <form method="get" action="">
                 <div class="row">
                     <div class="row mb-2">

                         <div class="col-4">
                            <select name="subject_id" id="subject_id" class="form-control" onchange="getIntakeData()">
                                <option value="">Select Subject</option>
                                @forelse ($subject_list as $clist)
                                <option {{ (!empty($get_subject_id) && $get_subject_id==$clist->id)?'selected':'' }} value="{{ (!empty($clist->id))?$clist->id:'' }}">{{ (!empty($clist->title))?$clist->title:'' }}</option>
                                @empty
                                @endforelse
                            </select>
                         </div>
                         <div class="col-4">
                            <select name="application_status" class="form-control">
                                <option value="">--Select Status--</option>
                                <option {{ (!empty($get_application_status) && $get_application_status==1)?'selected':'' }} value="1">Present</option>
                                <option {{ (!empty($get_application_status) && $get_application_status==2)?'selected':'' }} value="2">Absent</option>
                                <option {{ (!empty($get_application_status) && $get_application_status==3)?'selected':'' }} value="3">Authorised Absent</option>
                            </select>
                         </div>
                         <div class="col-2">
                            <input type="date" name="from_date" value="{{ (!empty($get_from_date))?$get_from_date:'' }}" class="form-control" />
                         </div>
                         <div class="col-2">
                            <input type="date" name="to_date" value="{{ (!empty($get_to_date))?$get_to_date:'' }}" class="form-control" />
                         </div>

                     </div>
                     <div class="row mb-2">
                        <div class="col-7">
                            <input type="text" placeholder="Enter ID, Email, Name, Phone..." name="title" value="{{ (!empty($get_title))?$get_title:'' }}" class="form-control" />
                        </div>
                        <div class="col-1">
                            <input type="submit" value="Filter" name="time" class="btn btn-warning">
                         </div>
                         <div class="col-1">
                            <a href="{{ URL::to('group-report/'.$group_info->id) }}" class="btn btn-danger">Reset</a>
                         </div>
                     </div>


                 </div>
            </form>
        </div>
        <h5 class="pt-3">All Group Here</h5>
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Group ID</th>
                                    <th>Title</th>
                                    <th>No Of Student</th>
                                    <th>Present Percent</th>
                                    <th>Absent Percent</th>
                                    <th>Leave Percent</th>
                                    <th>Is Complete</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @forelse ($list as $row)
                                @php
                                    $attendence_percent_count = App\Models\Course\CourseGroup::get_group_attend_percent($row->id);
                                @endphp
                                <tr>
                                    <td>{{ (!empty($row->id)?$row->id:'') }}</td>

                                    <td>
                                        <span>{{ (!empty($row->title))?$row->title:'' }}</span>
                                    </td>
                                    <td>
                                        <span>{{ (!empty($row->total_application_count))?$row->total_application_count:'' }}</span>
                                    </td>
                                    <td>
                                        {{ $attendence_percent_count['present_percentage'] }} %
                                    </td>
                                    <td>
                                        {{ $attendence_percent_count['absent_percentage'] }} %
                                    </td>
                                    <td>
                                        {{ $attendence_percent_count['leave_percentage'] }} %
                                    </td>
                                    <td>
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-text-toggle">
                                            <div class="input-checkbox">
                                                <span class="switch-chk-label label-left">Yes</span>
                                                <input {{ ($row->status==1)?'checked':'' }} data-action="{{ URL::to('group-data-status-change') }}" data-id="{{ $row->id }}" class="group-data-status-change1 switch-input" type="checkbox"
                                                                            role="switch" id="form-custom-switch-inner-text">
                                                <span class="switch-chk-label label-right">No</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a title="Make Group Attendence" href="{{ URL::to('attendence-group-details/'.$row->id) }}" class="badge badge-pill bg-primary">
                                            <svg style="color: white;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-down-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8.636 12.5a.5.5 0 0 1-.5.5H1.5A1.5 1.5 0 0 1 0 11.5v-10A1.5 1.5 0 0 1 1.5 0h10A1.5 1.5 0 0 1 13 1.5v6.636a.5.5 0 0 1-1 0V1.5a.5.5 0 0 0-.5-.5h-10a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h6.636a.5.5 0 0 1 .5.5z"/>
                                                <path fill-rule="evenodd" d="M16 15.5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1 0-1h3.793L6.146 6.854a.5.5 0 1 1 .708-.708L15 14.293V10.5a.5.5 0 0 1 1 0v5z"/>
                                            </svg>
                                        </a>
                                        <a title="Group Application List" href="{{ URL::to('get-application-by-group/'.$row->id) }}" class="badge badge-pill bg-warning">
                                            <svg style="color: white;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-files-alt" viewBox="0 0 16 16">
                                                <path d="M11 0H3a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2 2 2 0 0 0 2-2V4a2 2 0 0 0-2-2 2 2 0 0 0-2-2m2 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1zM2 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                            </svg>
                                        </a>
                                        <a title="Group Report" href="{{ URL::to('group-report/'.$row->id) }}" class="badge badge-pill bg-danger">
                                            <svg style="color:white;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stickies" viewBox="0 0 16 16">
                                                <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1z"/>
                                                <path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293z"/>
                                              </svg>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        No Data Found
                                    </tr>
                                @endforelse

                            </tbody> --}}
                        </table>
                        <div style="text-align: center;" class="pagination-custom_solid">
                            {{ $attend_list_data->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<script src="{{ asset('web/js/jquery.js') }}"></script>
<script>
    function getIntakeData(){
        var getId = $('#course_id').val();
        $.get('{{ URL::to('get-intake-data') }}/'+getId,function(data,status){
            if(data['result']['key']===200){
                console.log(data['result']['val']);
                $('#get_intake_data').html(data['result']['val']);
            }
        });
    }
</script>
<script>
    $(function(){
       $('.group-data-status-change1').change(function(){
           var status = $(this).prop('checked') == true ? 0 : 1;
           var group_id = $(this).data('id');
           var url = $(this).data('action');
               $.post(url,
               {
                   group_id: group_id,
                   status: status
               },
               function(data, status){
                   console.log(data);
                   if(data['result']['key']===101){
                       iziToast.show({
                           title: 'Info',
                           message: data['result']['val'],
                           position: 'topRight',
                           timeout: 8000,
                           color: 'red',
                           balloon: true,
                           close: true,
                           progressBarColor: 'yellow',
                       });
                       setTimeout(function () {
                           location.reload(true);
                       }, 2000);
                   }
                   if(data['result']['key']===200){
                       iziToast.show({
                           title: 'Info',
                           message: data['result']['val'],
                           position: 'topRight',
                           timeout: 8000,
                           color: 'green',
                           balloon: true,
                           close: true,
                           progressBarColor: 'yellow',
                       });

                   }
                   //alert("Data: " + data + "\nStatus: " + status);
               });

       });
   });
   </script>
@stop
