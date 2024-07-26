@extends('adminpanel')
@section('admin')
@if(Auth::user()->role=='manager')
<div class="modal fade inputForm-modal" id="assignToModal" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header" id="inputFormModalLabel">
            <h5 class="modal-title"><b>Assign To Admission Officer by Manager</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="mt-0">
            <form action="{{ URL::to('application-assign-to') }}" id="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Assign To User:</label>
                                <input type="hidden" name="assign_application_ids" id="assign_application_ids" />
                                <select name="assign_to_user_id" id="assign_to_user_id" class="form-select">
                                    <option value="" selected>Choose...</option>
                                    @foreach ($my_teams as $urow)
                                    <option value="{{ $urow->id }}">{{ $urow->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('assign_to_user_id'))
                                    <span class="text-danger">{{ $errors->first('assign_to_user_id') }}</span>
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
@if(Auth::user()->role=='admin')
<div class="modal fade inputForm-modal" id="assignToModal1" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header" id="inputFormModalLabel">
            <h5 class="modal-title"><b>Assign To Admission Officer by Admin</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="mt-0">
            <form action="{{ URL::to('application-assign-to-manager') }}" id="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Assign To User:</label>
                                <input type="hidden" name="assign_application_ids" id="assign_application_ids" />
                                <select name="assign_to_manager_id" id="assign_to_manager_id" class="form-select">
                                    <option value="" selected>Choose...</option>
                                    @foreach ($admin_managers as $amrow)
                                    <option value="{{ $amrow->id }}">{{ $amrow->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('assign_to_manager_id'))
                                    <span class="text-danger">{{ $errors->first('assign_to_manager_id') }}</span>
                                @endif
                                <br>
                                <select name="assign_to_admission_manager_id" id="assign_to_admission_manager_id" class="assign-to-list form-select">
                                    <option value="" selected>Choose...</option>
                                    @foreach ($my_teams as $urow)
                                    <option value="{{ $urow->id }}">{{ $urow->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('assign_to_admission_manager_id'))
                                    <span class="text-danger">{{ $errors->first('assign_to_admission_manager_id') }}</span>
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
@if(Auth::user()->role=='admin' || Auth::user()->role=='manager')
<div class="modal fade inputForm-modal" id="assignToInterviewerModal" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header" id="inputFormModalLabel">
            <h5 class="modal-title"><b>Assign To Interviewer</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="mt-0">
            <form action="{{ URL::to('application_assign_to_interviewer') }}" id="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Assign To User:</label>
                                <input type="hidden" name="assign_interviewer_application_ids" id="assign_interviewer_application_ids" />
                                <select name="assign_to_interviewer_id" id="assign_to_interviewer_id" class="form-select">
                                    <option value="" selected>Choose...</option>
                                    @foreach ($interviewer_list as $iurow)
                                    <option value="{{ $iurow->id }}">{{ $iurow->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('assign_to_interviewer_id'))
                                    <span class="text-danger">{{ $errors->first('assign_to_interviewer_id') }}</span>
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
            <form id="note-formid" method="post">
                <div class="modal-body">
                    <div id="note-data">

                    </div>
                    <div class="form-group">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Note:</label>
                                <input type="hidden" name="note_application_id" id="note_application_id" />
                                <textarea name="application_note" id="application_note" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Is View By Agent</label>
                                <select name="is_view" id="is_view" class="form-control">
                                    <option value="1">No</option>
                                    <option value="2">Yes</option>
                                </select>
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
<div class="modal fade inputForm-modal" id="inputFormModal1" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header" id="inputFormModalLabel">
            <h5 class="modal-title"><b>Follow Up</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <form id="followup-form" method="post" action="#" class="mt-0">
            <div class="modal-body">
                <div id="followupnote-data">

                </div>
                <div class="form-group">
                    <div class="col">
                        <div class="form-group mb-4"><label for="exampleFormControlInput1">Note:</label>
                            <input type="hidden" name="followup_application_id" id="followup_application_id" />
                            <textarea name="application_followup" id="application_followup" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-4"><label for="exampleFormControlInput1">Followup Date:</label>
                            <input name="followup_date" id="followup_date" type="datetime-local" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Cancel</a>
                <button id="btn-followup-submit" class="btn btn-primary mt-2 mb-2 btn-no-effect">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>
<div class="modal fade inputForm-modal" id="inputFormModal2" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header" id="inputFormModalLabel">
            <h5 class="modal-title"><b>Meetings</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <form id="meeting-form" enctype="multipart/form-data" class="mt-0">
            <div class="modal-body">
                <div id="meetingnote-data">

                </div>
                <div class="form-group">
                    <div class="col">
                        <div class="form-group mb-4"><label for="exampleFormControlInput1">Note:</label>
                            <input type="hidden" value="{{ URL::to('application-meeting-note-post') }}" id="meeting_url" />
                            <input type="hidden" name="meeting_application_id" id="meeting_application_id" />
                            <textarea id="application_meeting" name="application_meeting" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-4"><label for="exampleFormControlInput1">Meeting Date:</label>
                            <input name="meeting_date" id="meeting_date" type="datetime-local" class="form-control" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-4"><label for="exampleFormControlInput1">Meeting Doc File:</label>
                            <input name="meeting_doc" id="meeting_doc" type="file" class="form-control" />
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Cancel</a>
                <button id="btn-meeting-submit" class="btn btn-primary mt-2 mb-2 btn-no-effect">Submit</button>
            </div>
        </form>
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
        <h5 class="pt-3">Filter :- <span style="color: #f84538; font-size: 14px;">{{ $application_list->total() }} Application found, Showing {{ $application_list->firstItem() }} - {{ $application_list->lastItem() }} of {{ $application_list->total() }} results</span></h5>
        <div class="widget-content widget-content-area">
            <form method="get" action="">
                 <div class="row">
                     <div class="row mb-2">
                        <div class="col-2">
                            <select id="campus" name="campus" class="form-control" onchange="getApplicationData()">
                                <option value="">--Campus--</option>
                                @if(count($campuses) > 0)
                                @foreach ($campuses as $campus1)
                                <option {{ (!empty($get_campus) && $get_campus==$campus1->id)?'selected':'' }} value="{{ $campus1->id }}">{{ $campus1->campus_name }}</option>
                                @endforeach
                                @endif
                            </select>
                         </div>
                         <div class="col-2">
                            <select id="agent" name="agent" class="form-control" onchange="getApplicationData()">
                                <option value="">Select Agent</option>
                                @if(count($agents) > 0)
                                @foreach ($agents as $agent)
                                <option {{ (!empty($get_agent) && $get_agent==$agent->id)?'selected':'' }} value="{{ $agent->id }}">{{ $agent->company_name }}</option>
                                @endforeach
                                @endif
                            </select>
                         </div>
                         <div class="col-2">
                            <select id="officer" name="officer" class="form-control" onchange="getApplicationData()">
                                <option value="">--Officer--</option>
                                @if(count($officers) > 0)
                                @foreach ($officers as $officer)
                                <option {{ (!empty($get_officer) && $get_officer==$officer->id)?'selected':'' }} value="{{ $officer->id }}">{{ $officer->name }}</option>
                                @endforeach
                                @endif
                            </select>
                         </div>

                         <div class="col-2">
                            <select id="status" name="status" class="form-control" onchange="getApplicationData()">
                                <option value="">Select Status</option>
                                @if(count($statuses) > 0)
                                @foreach ($statuses as $status)
                                <option {{ (!empty($get_status) && $get_status==$status->id)?'selected':'' }} value="{{ $status->id }}">{{ $status->title }}</option>
                                @endforeach
                                @endif
                            </select>
                         </div>
                         <div class="col-2">
                            <select id="interviewer" name="interviewer" class="form-control" onchange="getApplicationData()">
                                <option value="">--Interviewers--</option>
                                @if(count($interviewer_list) > 0)
                                @foreach ($interviewer_list as $itlist)
                                <option {{ (!empty($get_interviewer) && $get_interviewer==$itlist->id)?'selected':'' }} value="{{ $itlist->id }}">{{ $itlist->name }}</option>
                                @endforeach
                                @endif
                            </select>
                         </div>
                         <div class="col-2">
                            <select id="interview_status" name="interview_status" class="form-control" onchange="getApplicationData()">
                                <option value="">Interview Status</option>
                                @if(count($interview_statuses) > 0)
                                @foreach ($interview_statuses as $istatus)
                                <option {{ (!empty($get_interview_status) && $get_interview_status==$istatus->id)?'selected':'' }} value="{{ $istatus->id }}">{{ $istatus->title }}</option>
                                @endforeach
                                @endif
                            </select>
                         </div>
                     </div>
                     <div class="row mb-2">
                        <div class="col-2">
                            <select id="intake" name="intake" class="form-control" onchange="getApplicationData()">
                                <option value="">Select Intake</option>
                                @if(count($intakes) > 0)
                                @foreach ($intakes as $intake)
                                <option {{ (!empty($get_intake) && $get_intake==$intake)?'selected':'' }} value="{{ $intake }}">{{ date('F y',strtotime($intake)) }}</option>
                                @endforeach
                                @endif
                            </select>
                         </div>
                         <div class="col-2">
                             <input value="{{ (!empty($get_from_date))?$get_from_date:'' }}" name="from_date" id="from_date" type="date" class="form-control" placeholder="From Date" onchange="getApplicationData()">
                         </div>
                         <div class="col-2">
                             <input value="{{ (!empty($get_to_date))?$get_to_date:'' }}" name="to_date" id="to_date" type="date" class="form-control" placeholder="To Date" onchange="getApplicationData()">
                         </div>
                         <div class="col-3">
                            <select id="level_of_education" name="level_of_education" class="form-control" onchange="getApplicationData()">
                                <option value="">Level Of Education</option>
                                <option {{ (!empty($get_level_of_education) && $get_level_of_education==1)?'selected':'' }} value="1">Academic Route</option>
                                <option {{ (!empty($get_level_of_education) && $get_level_of_education==2)?'selected':'' }} value="2">Non-Academic Route</option>
                            </select>
                         </div>
                         <div class="col">
                            <select id="course_id" name="course_id" class="form-control" onchange="getApplicationData()">
                                <option value="">Course</option>
                                @if(count($courses_list) > 0)
                                @foreach ($courses_list as $courseRow)
                                <option {{ (!empty($get_course_id) && $get_course_id==$courseRow->id)?'selected':'' }} value="{{ $courseRow->id }}">{{ $courseRow->course_name }}</option>
                                @endforeach
                                @endif
                            </select>
                         </div>
                         <div class="col">
                            <select id="gender" name="gender" class="form-control" onchange="getApplicationData()">
                                <option value="">Gender</option>
                                @if(count($gender) > 0)
                                @foreach ($gender as $row)
                                <option {{ (!empty($get_gender) && $get_gender==$row['id'])?'selected':'' }} value="{{ $row['id'] }}">{{ $row['val'] }}</option>
                                @endforeach
                                @endif
                            </select>
                         </div>

                     </div>
                     <div class="row">
                        <div class="col-2">
                            <select id="ethnic_origin" name="ethnic_origin" class="form-control" onchange="getApplicationData()">
                                <option value="">Ethnic Origin</option>
                                @if(count($ethnic_origins) > 0)
                                @foreach ($ethnic_origins as $origin)
                                <option {{ (!empty($get_ethnic_origin) && $get_ethnic_origin==$origin)?'selected':'' }} value="{{ $origin }}">{{ $origin }}</option>
                                @endforeach
                                @endif
                            </select>
                         </div>
                        <div class="col">
                            <select name="nationality" id="nationality" class="form-control" onchange="getApplicationData()">
                                <option value="">Choose...</option>
                                <option {{ (!empty($get_nationality) && $get_nationality=='UK National')?'selected':'' }} value="UK National">UK National</option>
                                <option {{ (!empty($get_nationality) && $get_nationality=='Other')?'selected':'' }} value="Other">Other Nationality</option>
                            </select>
                         </div>
                         <div class="col">
                            <select name="other_nationality" id="other_nationality" class="form-control" onchange="getApplicationData()">
                                <option value="">Choose...</option>
                                @if(!empty($get_nationality) && $get_nationality=='Other')
                                    @if(count($nationalities) > 0)
                                        @foreach ($nationalities as $nrow)
                                        <option {{ (!empty($get_other_nationality) && $get_other_nationality==$nrow)?'selected':'' }} value="{{ $nrow }}">{{ $nrow }}</option>
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                         </div>
                         <div class="col-2">
                            <select name="disability" id="disability" class="form-control" onchange="getApplicationData()">
                                <option value="">Disability</option>
                                <option {{ (!empty($get_disability) && $get_disability=='yes')?'selected':'' }} value="yes">Yes</option>
                                <option {{ (!empty($get_disability) && $get_disability=='no')?'selected':'' }} value="no">No</option>
                            </select>
                         </div>
                         <div class="col">
                            <select name="eligibility" id="eligibility" class="form-control" onchange="getApplicationData()">
                                <option value="">Eligible</option>
                                <option {{ (!empty($get_eligibility) && $get_eligibility=="Eligible")?'selected':'' }} value="Eligible">Eligible</option>
                                <option {{ (!empty($get_eligibility) && $get_eligibility=="Not Eligible")?'selected':'' }} value="Not Eligible">Not Eligible</option>
                            </select>
                         </div>
                        <div class="col-3">
                            <input value="{{ (!empty($search))?$search:'' }}" name="q" id="q" type="text" class="form-control" placeholder="Enter ID,Name,Email,Phone">
                        </div>
                        <div class="col">
                           <input type="submit" value="Filter" name="time" class="btn btn-warning">
                        </div>
                        <div class="col">
                           <a href="{{ URL::to('reset-application-search') }}" class="btn btn-danger">Reset</a>
                        </div>
                     </div>

                 </div>
            </form>
        </div>

        <h5 class="pt-3">All Application Here</h5>

        <div class="row layout-top-spacing">
            @if(Auth::user()->role=='manager')
            <a data-bs-toggle="modal" data-bs-target="#assignToModal" class="assignToDisplay assignToBtn dropdown-item" href="#">Assign To</a>
            @endif
            @if(Auth::user()->role=='admin')
            <a data-bs-toggle="modal" data-bs-target="#assignToModal1" class="assignToDisplay1 assignToBtn1 dropdown-item" href="#">Assign To</a>
            @endif

            @if(Auth::user()->role=='manager' || Auth::user()->role=='admin')
            <a data-bs-toggle="modal" data-bs-target="#assignToInterviewerModal" class="assignToDisplay2 assignToBtn2 dropdown-item" href="#">Assign To Interviewer</a>
            @endif

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="checkbox-area" scope="col">

                                    </th>
                                    <th>Application ID</th>
                                    <th>Title</th>
                                    <th>First Name</th>
                                    <th>Surname</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Level Of Education</th>
                                    <th>Nationality</th>
                                    @if(!empty($get_other_nationality) && $get_other_nationality=='Other')
                                    <th>Other Nationality</th>
                                    @endif
                                    <th>Disability</th>
                                    <th>Campus</th>
                                    <th>Course</th>
                                    <th>Create date</th>
                                    <th>Follow Up</th>
                                    <th>Intake</th>
                                    <th>Assign</th>
                                    <th>Interviewer</th>
                                    <th>Interview Status</th>
                                    <th>Status</th>
                                    <th>Application Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($application_list as $row)
                                <tr>
                                    <td>
                                        @if($row->admission_officer_id == 0)
                                        <div class="form-check form-check-primary">
                                            <input value="{{ (!empty($row->id)?$row->id:'') }}" class="assignto{{ $row->id }} form-check-input assign-to-adminmanager striped_child" type="checkbox">
                                        </div>
                                        @endif
                                    </td>
                                    <td>{{ (!empty($row->id)?$row->id:'') }}</td>
                                    <td><h6 class="mb-0">{{ (!empty($row->title))?$row->title:'' }}</h6></td>
                                    <td><h6 class="mb-0">{{ (!empty($row->first_name))?$row->first_name:'' }}</h6></td>
                                    <td><h6 class="mb-0">{{ (!empty($row->last_name))?$row->last_name:'' }}</h6></td>
                                    <td>
                                        <span>{{ (!empty($row->gender))?$row->gender :'' }} </span>
                                    </td>
                                    <td>
                                        <span>{{ (!empty($row->email))?$row->email:'' }}</span>
                                    </td>
                                    <td>
                                        <span>{{ (!empty($row->phone))?$row->phone:'' }}</span>
                                    </td>

                                    <td>
                                        @if($row->is_academic==1)
                                        <span>Academic</span>
                                        @else
                                        <span>Non-Academic</span>
                                        @endif
                                    </td>
                                    <td>{{ (!empty($row->nationality))?$row->nationality :'' }}</td>
                                    @if(!empty($get_other_nationality) && $get_other_nationality=='Other')
                                        <td>{{ (!empty($row->other_nationality))?$row->other_nationality :'' }}</td>
                                    @endif
                                    <td>{{ (!empty($row->step2Data->disabilities))?$row->step2Data->disabilities :'' }}</td>
                                    <td>{{ (!empty($row->campus->campus_name)?$row->campus->campus_name:'') }}</td>
                                    <td>{{ (!empty($row->course->course_name)?$row->course->course_name:'') }}</td>
                                    <td>{{ date('F d Y',strtotime($row->created_at)) }}</td>
                                    <td>
                                        @if(Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->id==$row->admission_officer_id)
                                        <div class="is-action{{ $row->id }} dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink6" style="">
                                                <a data-bs-toggle="modal" data-bs-target="#inputFormModal" class="dropdown-item" onclick="get_application_notes({{ $row->id }})" href="#">Notes</a>
                                                <a data-bs-toggle="modal" data-bs-target="#inputFormModal1" class="dropdown-item" onclick="get_application_followups({{ $row->id }})" href="javascript:void(0);">Follow Up</a>
                                                <a data-bs-toggle="modal" data-bs-target="#inputFormModal2" class="dropdown-item" onclick="get_application_meetings({{ $row->id }})" href="javascript:void(0);">Meeting</a>
                                            </div>
                                        </div>
                                        @else
                                        <div class="is-action-data is-action{{ $row->id }} dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink6" style="">
                                                <a data-bs-toggle="modal" data-bs-target="#inputFormModal" class="dropdown-item" href="#">Notes</a>
                                                <a data-bs-toggle="modal" data-bs-target="#inputFormModal1" class="dropdown-item" href="javascript:void(0);">Follow Up</a>
                                                <a data-bs-toggle="modal" data-bs-target="#inputFormModal2" class="dropdown-item" href="javascript:void(0);">Meeting</a>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        {{ date('F Y',strtotime($row->intake)) }}
                                    </td>

                                    <td>
                                        @if(Auth::user()->role=='adminManager')
                                            @if($row->admission_officer_id==0 || $row->admission_officer_id==Auth::user()->id)
                                            <div
                                                class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-text-toggle">
                                                <div class="input-checkbox">
                                                    <span class="switch-chk-label label-left">On</span>
                                                    <input {{ ($row->admission_officer_id==Auth::user()->id)?'checked':'' }} data-action="{{ URL::to('application/assign-to-me') }}" data-id="{{ $row->id }}" class="assign-to-me-status switch-input" type="checkbox"
                                                                                role="switch" id="form-custom-switch-inner-text">
                                                    <span class="switch-chk-label label-right">Off</span>
                                                </div>
                                            </div>
                                            @else
                                            <span>
                                                {{ (!empty($row->assign->name))?$row->assign->name:'' }}
                                            </span>
                                            @endif
                                        @endif
                                        @if(Auth::user()->role=='admin')
                                        <span>
                                            {{ (!empty($row->assign->name))?$row->assign->name:'' }}
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->interviewer_id > 0)
                                        <span>
                                            {{ (!empty($row->interviewer->name))?$row->interviewer->name:'' }}
                                        </span>
                                        @else
                                        <div class="form-check form-check-primary">
                                            <input value="{{ (!empty($row->id)?$row->id:'') }}" class="assigntointerviewer{{ $row->id }} assign-to-interviewer form-check-input striped_child" type="checkbox">
                                        </div>
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
                                        @if(!in_array(2,explode(",",$row->steps)))
                                        <span class="badge badge-warning">Document Missing</span>
                                        @elseif(!in_array(3,explode(",",$row->steps)))
                                        <span class="badge badge-warning">Application Not Submitted</span>
                                        @else
                                        <span class="badge badge-success">Application Ready</span>
                                        @endif
                                    </td>
                                    <td class="flex space-x-2">
                                        @if($row->application_status_id==1)
                                        <a href="{{ URL::to('application/'.$row->id.'/details') }}" class="badge badge-pill bg-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>
                                        @else
                                            @if(!in_array(2,explode(",",$row->steps)))
                                            <a href="{{ URL::to('application-create/'.$row->id.'/step-2') }}" class="badge badge-pill bg-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 text-white"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                            </a>
                                            @elseif(!in_array(3,explode(",",$row->steps)))
                                            <a href="{{ URL::to('application-create/'.$row->id.'/step-3') }}" class="badge badge-pill bg-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 text-white"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                            </a>
                                            @else

                                            @endif

                                        @endif
                                        @if(Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->id==$row->admission_officer_id)
                                        <span>
                                            @if($row->application_status_id==1)
                                            <a href="{{ URL::to('application/'.$row->id.'/processing') }}" class="badge badge-pill bg-secondary">
                                                <svg style="color: white;" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.75 5H8.25C7.55964 5 7 5.58763 7 6.3125V19L12 15.5L17 19V6.3125C17 5.58763 16.4404 5 15.75 5Z" stroke="#464455" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </a>
                                            <a href="{{ URL::to('application-create/'.$row->id) }}" class="badge badge-pill bg-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 text-white"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                            </a>

                                            @endif
                                        </span>
                                        @else
                                        <span class="action-spn{{ $row->id }} is-action-data">

                                            <a href="{{ URL::to('application-create/'.$row->id) }}" class="badge badge-pill bg-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 text-white"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                            </a>
                                        </span>
                                        @endif

                                        @if(Auth::user()->role=='admin')
                                        <a onclick="if(confirm('Are you sure to Delete this Application?')) location.href='{{ URL::to('delete-application/'.$row->id) }}'; return false;" href="javascript:void(0)" class="">
                                            <span class="badge badge-pill badge-danger custom-btn-branch me-1">
                                                <svg style="color: rgb(245, 229, 229);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2  delete-multiple"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </span>
                                        </a>
                                        @endif
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
                            {{ $application_list->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<style>
    .is-action-data{
        display: none;
    }
    .is-action-data-show{
        display: block;
    }
    .error{
        color: #a90606 !important;
    }
    .assignToDisplay{
        display: none;
    }
    .assignToDisplay1{
        display: none;
    }
    .assignToDisplay2{
        display: none;
    }
    .assignToBtn{
        color: #f7bd1a !important;
        margin-left: 14px;
        font-size: 15px !important;
    }
    .assignToBtn1{
        color: #f7bd1a !important;
        margin-left: 14px;
        font-size: 15px !important;
    }
    .assignToBtn2{
        color: #f7bd1a !important;
        margin-left: 14px;
        font-size: 15px !important;
    }
    .form-control{
        padding: 0.45rem 1rem !important;
        font-size: 13px !important;
    }
</style>
<script src="{{ asset('web/js/jquery.js') }}"></script>
@if(Auth::user()->role=='manager' || Auth::user()->role=='admin')
    <script>
        var selectedValues = [];
        $('.assign-to-interviewer').on('change', function() {
        if ($(this).is(':checked')) {
            var value = $(this).val();
            selectedValues.push(value);
            $('.assignToDisplay2').show();
            $('#assign_interviewer_application_ids').val(selectedValues);
        } else {
            var valueIndex = selectedValues.indexOf($(this).val());
            if (valueIndex !== -1) {
                selectedValues.splice(valueIndex, 1);
            }
            if(selectedValues.length === 0){
                $('.assignToDisplay2').hide();
            }
            $('#assign_interviewer_application_ids').val(selectedValues);
        }

        var selectedValue = selectedValues.join(',');
        console.log(selectedValue);
        // Perform any further actions with the selected values
    });
    </script>
    @if($errors->has('assign_to_interviewer_id'))
    <script>
        $(document).ready(function() {
            $('#assignToInterviewerModal').modal('show');
        });
    </script>
    @endif
@endif
@if(Auth::user()->role=='manager')
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
    @if($errors->has('assign_to_user_id'))
    <script>
        $(document).ready(function() {
            $('#assignToModal').modal('show');
        });
    </script>
    @endif
@endif

@if(Auth::user()->role=='admin')
    <script>
        var selectedValues = [];
        $('.assign-to-adminmanager').on('change', function() {
        if ($(this).is(':checked')) {
            var value = $(this).val();
            selectedValues.push(value);
            $('.assignToDisplay1').show();
            $('#assign_application_ids').val(selectedValues);
        } else {
            var valueIndex = selectedValues.indexOf($(this).val());
            if (valueIndex !== -1) {
                selectedValues.splice(valueIndex, 1);
            }
            if(selectedValues.length === 0){
                $('.assignToDisplay1').hide();
            }
            $('#assign_application_ids').val(selectedValues);
        }

        var selectedValue = selectedValues.join(',');
        console.log(selectedValue);
        // Perform any further actions with the selected values
    });
    </script>
    @if($errors->has('assign_to_admission_manager_id') || $errors->has('assign_to_manager_id'))
    <script>
        $(document).ready(function() {
            $('#assignToModal1').modal('show');
        });
    </script>
    @endif
    <script>
        function getAdmissionOfficer(){
            var getId = $('#assign_to_manager_id').val();
            $.get('{{ URL::to('get-admission-officer-by-manager') }}/'+getId,function(data,status){
                if(data['result']['key']===200){
                    console.log(data['result']['val']);
                    $('#assign_to_admission_manager_id').html(data['result']['val']);
                }
            });
        }
    </script>
@endif

@stop
