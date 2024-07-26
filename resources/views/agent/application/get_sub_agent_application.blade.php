@extends('adminpanel')
@section('admin')
@if(Auth::user()->role=='agent')
<div class="modal fade inputForm-modal" id="assignToModal" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header" id="inputFormModalLabel">
            <h5 class="modal-title"><b>Assign To Admission Officer by Manager</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="mt-0">
            <form action="{{ URL::to('application-assign-to-other-sub-agent') }}" id="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Assign To User:</label>
                                <input type="hidden" name="assign_application_ids" id="assign_application_ids" />
                                <select name="assign_to_sub_agent_id" id="assign_to_sub_agent_id" class="form-select">
                                    <option value="" selected>Choose...</option>
                                    @foreach ($my_teams as $urow)
                                    @if($urow->id != $sub_agent_id)
                                        <option value="{{ $urow->id }}">{{ $urow->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('assign_to_sub_agent_id'))
                                    <span class="text-danger">{{ $errors->first('assign_to_sub_agent_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Cancel</a>
                    <button id="btn-note-submit" class="btn btn-primary mt-2 mb-2 btn-no-effect" >Submit</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
@endif
<div class="modal fade inputForm-modal" id="inputFormModal" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header" id="inputFormModalLabel">
            <h5 class="modal-title"><b>Notes</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="mt-0">
            <form action="{{ URL::to('make_application_note_by_agent') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Note:</label>
                                <input type="hidden" name="note_application_id" id="note_application_id" />
                                <textarea name="application_note" id="application_note" class="form-control" rows="2"></textarea>
                                @if ($errors->has('application_note'))
                                    <span class="text-danger">{{ $errors->first('application_note') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Cancel</a>
                    <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect" >Submit</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
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
                                    <li class="breadcrumb-item"><a href="#">Application</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All</li>
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
                       <div class="col-3">
                           <select id="campus" name="campus" class="form-control">
                               <option value="">--Campus--</option>
                               @if(count($campuses) > 0)
                               @foreach ($campuses as $campus1)
                               <option {{ (!empty($get_campus) && $get_campus==$campus1->id)?'selected':'' }} value="{{ $campus1->id }}">{{ $campus1->campus_name }}</option>
                               @endforeach
                               @endif
                           </select>
                        </div>


                        <div class="col-3">
                           <select id="status" name="status" class="form-control">
                               <option value="">Select Status</option>
                               @if(count($statuses) > 0)
                               @foreach ($statuses as $status)
                               <option {{ (!empty($get_status) && $get_status==$status->id)?'selected':'' }} value="{{ $status->id }}">{{ $status->title }}</option>
                               @endforeach
                               @endif
                           </select>
                        </div>
                        <div class="col-3">
                           <select id="interview_status" name="interview_status" class="form-control">
                               <option value="">Interview Status</option>
                               @if(count($interview_statuses) > 0)
                               @foreach ($interview_statuses as $istatus)
                               <option {{ (!empty($get_interview_status) && $get_interview_status==$istatus->id)?'selected':'' }} value="{{ $istatus->id }}">{{ $istatus->title }}</option>
                               @endforeach
                               @endif
                           </select>
                        </div>
                        <div class="col-3">
                            <select id="intake" name="intake" class="form-control">
                                <option value="">Select Intake</option>
                                @if(count($intakes) > 0)
                                @foreach ($intakes as $intake)
                                <option {{ (!empty($get_intake) && $get_intake==$intake)?'selected':'' }} value="{{ $intake }}">{{ date('F y',strtotime($intake)) }}</option>
                                @endforeach
                                @endif
                            </select>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <input value="{{ (!empty($get_from_date))?$get_from_date:'' }}" name="from_date" id="from_date" type="date" class="form-control" placeholder="From Date">
                        </div>
                        <div class="col-2">
                            <input value="{{ (!empty($get_to_date))?$get_to_date:'' }}" name="to_date" id="to_date" type="date" class="form-control" placeholder="To Date">
                        </div>
                        <div class="col-5">
                            <input value="{{ (!empty($search))?$search:'' }}" name="q" id="q" type="text" class="form-control" placeholder="Enter ID,Name,Email,Phone">
                        </div>
                        <div class="col-1">
                           <input type="submit" value="Filter" name="time" class="btn btn-warning">
                        </div>
                        <div class="col-1">
                           <a href="{{ URL::to('get-sub-agent-applications/'.$sub_agent_id) }}" class="btn btn-danger">Reset</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <h5 class="pt-3">All Application Here</h5>
        <div class="row layout-top-spacing">
            @if(Auth::user()->role=='agent')
                <a data-bs-toggle="modal" data-bs-target="#assignToModal" class="assignToDisplay assignToBtn dropdown-item" href="#">Transfer To Another Sub Agent</a>
            @endif
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Application ID</th>
                                    <th>Name</th>
                                    <th>Campus</th>
                                    <th>Create date</th>
                                    <th>Intake</th>
                                    <th>Make Note</th>
                                    <th>Application Status</th>
                                    <th>Interview Status</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($agent_applications as $row)
                                <tr class="{{ (!empty($get_application_id) && $get_application_id==$row->id)?'tr-bg':'' }}">
                                    <td>
                                        <div class="form-check form-check-primary">
                                            <input value="{{ (!empty($row->id)?$row->id:'') }}" class="assignto{{ $row->id }} form-check-input assign-to-adminmanager striped_child" type="checkbox">
                                        </div>
                                    </td>
                                    <td>{{ (!empty($row->id)?$row->id:'') }}</td>
                                    <td>
                                        <div class="media">
                                            <div class="avatar me-2">
                                                <img alt="avatar" src="{{ asset('web/avatar/user.png') }}" class="rounded-circle" />
                                            </div>
                                            <div class="media-body align-self-center">
                                                <h6 class="mb-0">{{ (!empty($row->name))?$row->name:'' }}</h6>
                                                <span>{{ (!empty($row->email))?$row->email:'' }}</span><br>
                                                <span>{{ (!empty($row->phone))?$row->phone:'' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ (!empty($row->campus->campus_name)?$row->campus->campus_name:'') }}</td>
                                    <td>{{ date('F d Y',strtotime($row->created_at)) }}</td>
                                    <td>
                                        {{ date('F Y',strtotime($row->intake)) }}
                                    </td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#inputFormModal" href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Write Note" onclick="writeNote({{ $row->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                    </td>
                                    <td>
                                        @if(!in_array(2,explode(",",$row->steps)))
                                        <span class="badge badge-warning">Document Missing</span>
                                        @elseif(!in_array(3,explode(",",$row->steps)))
                                        <span class="badge badge-warning">Application Not Submitted</span>
                                        @else
                                        <span class="badge badge-success">Application Submitted</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(count($interview_statuses) > 0)
                                            @foreach ($interview_statuses as $isrow)
                                                @if($row->interview_status==$isrow->id)
                                                <span class="shadow-none badge badge-success">{{ $isrow->title }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if (count($statuses) > 0)
                                            @foreach ($statuses as $srow)
                                                @if($row->status==$srow->id)
                                                <span class="shadow-none badge badge-danger">{{ $srow->title }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->application_status_id==1)
                                        <a href="{{ URL::to('agent-applications/'.$row->id.'/details') }}" class="badge badge-pill bg-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>
                                        @else
                                            @if(!in_array(2,explode(",",$row->steps)))
                                            <a href="{{ URL::to('application-create/'.$row->id.'/step-2') }}" class="badge badge-pill bg-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 text-white"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                            </a>
                                            @elseif(!in_array(3,explode(",",$row->steps)))
                                            <a href="{{ URL::to('application-create/'.$row->id.'/step-3') }}" class="badge badge-pill bg-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 text-white"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                            </a>
                                            @else

                                            @endif

                                        @endif
                                        <a title="Document Upload" href="{{ URL::to('application-create/'.$row->id.'/step-2') }}" class="badge badge-pill bg-warning">
                                            <svg style="color: white;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-diff" viewBox="0 0 16 16">
                                                <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4zm-2.5 6.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        No Data Found
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div style="text-align: center;" class="pagination-custom_solid">
                            {{ $agent_applications->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<style>
    .form-control{
        padding: 0.45rem 1rem !important;
    }
    .assignToBtn{
        color: #f7bd1a !important;
        margin-left: 14px;
        font-size: 15px !important;
    }
    .assignToDisplay{
        display: none;
    }
</style>
<script src="{{ asset('web/js/jquery.js') }}"></script>
<script>
    function writeNote(id){
        if(id===null){
            return false;
        }
        $('#note_application_id').val(id);
    }
</script>
@if($errors->has('application_note'))
<script>
    $(document).ready(function() {
        $('#inputFormModal').modal('show');
    });
</script>
@endif

@if(Auth::user()->role=='agent')
    <script>
        var selectedValues = [];
        $('.assign-to-adminmanager').on('change', function() {
        if ($(this).is(':checked')) {
            var value = $(this).val();
            selectedValues.push(value);
            $('.assignToDisplay').show();
            $('#assign_application_ids').val(selectedValues);
        } else {
            var valueIndex = selectedValues.indexOf($(this).val());
            if (valueIndex !== -1) {
                selectedValues.splice(valueIndex, 1);
            }
            if(selectedValues.length === 0){
                $('.assignToDisplay').hide();
            }
            $('#assign_application_ids').val(selectedValues);
        }

        var selectedValue = selectedValues.join(',');
        console.log(selectedValue);
        // Perform any further actions with the selected values
    });
    </script>
    @if($errors->has('assign_to_sub_agent_id'))
    <script>
        $(document).ready(function() {
            $('#assignToModal').modal('show');
        });
    </script>
    @endif
@endif
@stop
