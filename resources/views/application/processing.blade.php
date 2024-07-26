@extends('adminpanel')
@section('admin')
<div class="modal fade inputForm-modal" id="inputFormModal" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header" id="inputFormModalLabel">
            <h5 class="modal-title"><b>Change Field List</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="mt-0">
            <div id="change-field-data-form">
                <div class="modal-body">
                    <div id="change-field-data">

                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <div class="row secondary-nav">
            <div class="breadcrumbs-container" data-page-heading="Analytics">
                <header class="header navbar navbar-expand-sm">
                    <a href="javascript:void(0);" class="btn-toggle sidebarCollapse" data-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-menu">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </a>
                    <div class="d-flex breadcrumb-content">
                        <div class="page-header">
                            <div class="page-title">
                            </div>
                            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Application</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Application Processing</li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                </header>
            </div>
        </div>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <div class="row">
                        <div class="col col-md-6 mb-4">

                            <h5 class="pb-2">Personal Information <a href="{{ URL::to('application-create/'.$application_info->id) }}" class="btn btn-info btn-rounded mb-2 mr-4 inline-flex"> Edit Basic Info <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 icon custom-edit-icon"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a></h5>
                            <div class="table-responsive">
                                <table class="table-bordered mb-4 table">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{ (!empty($application_info->name))?$application_info->name:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>{{ (!empty($application_info->phone))?$application_info->phone:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ (!empty($application_info->email))?$application_info->email:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td>{{ (!empty($application_info->gender))?$application_info->gender:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nationality</td>
                                            <td>{{ (!empty($application_info->nationality))?$application_info->nationality:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date of Birth</td>
                                            <td>{{ (!empty($application_info->date_of_birth))?date('d/m/Y',strtotime($application_info->date_of_birth)):'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>NI Number</td>
                                            <td>{{ (!empty($application_info->ni_number))?$application_info->ni_number:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Living Country</td>
                                            <td>{{ (!empty($application_info->current_country))?$application_info->current_country:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Living State</td>
                                            <td>{{ (!empty($application_info->current_state))?$application_info->current_state:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Living City</td>
                                            <td>{{ (!empty($application_info->current_city))?$application_info->current_city:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Zip Code</td>
                                            <td>{{ (!empty($application_info->current_postal_code))?$application_info->current_postal_code:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Living Address Details</td>
                                            <td>{{ (!empty($application_info->current_address_line_2))?$application_info->current_address_line_2:'' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card no-outer-spacing no-border-custom" theme-mode-data="false">
                                    <div class="card-header">
                                        <section class="mb-0 mt-0">
                                            <div role="menu" class="" data-toggle="">Lead Notes</div>
                                        </section>
                                    </div>
                                    <div id="" class="" aria-labelledby="headingTwo2" data-parent="#withoutSpacing">
                                        <div id="note-data">
                                            @if(count($application_info->notes) > 0)
                                                @foreach ($application_info->notes as $note)
                                                <div class="row col-md-12 mt-3" id="">
                                                    <div style="margin-left:7px;" class="media custom-media-img">
                                                        <div style="margin-left: 2px;" class="ml-2">
                                                            <img alt="avatar" src="{{ asset($note->user->photo) }}" class="img-fluid rounded-circle" style="width: 50px; margin-right: 5px;">
                                                        </div>
                                                        <div class="media-body"><h6 class="tx-inverse">{{ (!empty($note->user->name))?$note->user->name:'' }}<a onclick="deleteMainNote({{ $note->id }})" style="float:right; color:#b30b39;" href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></h6><p class="mg-b-0">{{ (!empty($note->note))?$note->note:'' }}</p>
                                                            <small class="text-left"> Created : {{ date('F d Y H:i:s',strtotime($note->created_at)) }}</small><br>
                                                            @if($note->is_view==2)
                                                            <small style="color: green;" class="text-left"> Is View By Agent : Yes</small>
                                                            @else
                                                            <small style="color: green;" class="text-left"> Is View By Agent : No</small>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div><hr>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="card-body custom-card-body">
                                            <div class="row">
                                                <form class="form-group" method="post" id="note-formid">
                                                    <div class="col-12 p-0">
                                                        <div class="form-group lead-drawer-form">
                                                            <label for="exampleFormControlInput1">Note:</label>
                                                            <input type="hidden" value="{{ (!empty($application_info->id))?$application_info->id:'' }}" name="note_application_id" id="note_application_id" />
                                                            <textarea name="application_note" id="application_note" class="form-control" rows="2"></textarea>
                                                            <!---->
                                                        </div>
                                                        <div class="mt-2 form-group lead-drawer-form">
                                                            <label for="exampleFormControlInput1">Is View By Agent:</label>
                                                            <select name="is_view" id="is_view" class="form-control">
                                                                <option value="1">No</option>
                                                                <option value="2">Yes</option>
                                                            </select>
                                                            <!---->
                                                        </div>
                                                        <button id="btn-note-submit" class="mt-2 btn badge badge-info btn-sm _effect--ripple waves-effect waves-light" >Save</button>
                                                    </div>
                                                    <hr>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="card no-outer-spacing no-border-custom">
                                <div class="card-header">
                                    <section class="mb-0 mt-0">
                                        <h5>Follow up (English Assesment or Other)</h5>
                                    </section>
                                </div>
                                <div id="" class="" aria-labelledby="headingTwo2" data-parent="#withoutSpacing">
                                    <div id="followupnote-data">
                                        @if(count($application_info->followups) > 0)
                                            @foreach ($application_info->followups as $note)
                                            <div class="row col-md-12 mt-3" id="">
                                                <div style="margin-left:7px;" class="media custom-media-img">
                                                    <div style="margin-left: 2px;" class="ml-2">
                                                        <img alt="avatar" src="{{ asset($note->user->photo) }}" class="img-fluid rounded-circle" style="width: 50px; margin-right: 5px;">
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="tx-inverse">{{ (!empty($note->user->name))?$note->user->name:'' }}
                                                            <a onclick="deleteFollowupNote({{ $note->id }})" style="float:right; color:#b30b39;" href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                                            @if($note->is_follow_up_done==1)
                                                            <a onclick="isFollowupComplete({{ $note->id }})" style="float:right; color:#1f6b08; margin-right:5px;" href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Complete" aria-label="Complete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></a>
                                                            @else
                                                            <a onclick="isFollowupComplete({{ $note->id }})" style="float:right; color:#ada310; margin-right:5px;" href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Pending" aria-label="Pending"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></a>
                                                            @endif
                                                        </h6>
                                                        <p class="mg-b-0">{{ (!empty($note->follow_up))?$note->follow_up:'' }}</p>
                                                        <small class="text-left"> Followup Date : <span class="badge badge-warning">{{ date('F d Y H:i:s',strtotime($note->follow_up_date_time)) }}</span></small><br>
                                                        <small class="text-left"> Created : {{ date('F d Y H:i:s',strtotime($note->created_at)) }}</small></div>
                                                </div>
                                            </div><hr>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="card-body custom-card-body">
                                        <form id="followup-form" method="post">
                                            <div class="col col-md-12 p-0">
                                                <div class="form-group lead-drawer-form">
                                                    <input type="hidden" value="{{ (!empty($application_info->id))?$application_info->id:'' }}" name="followup_application_id" id="followup_application_id" />
                                                    <textarea name="application_followup" id="application_followup" class="form-control" rows="2"></textarea>
                                                </div><br>
                                                <div class="col col-md-12 p-0">
                                                    <input name="followup_date" id="followup_date" type="datetime-local" class="form-control" />
                                                </div>
                                                <button id="btn-followup-submit" class="btn badge badge-info btn-sm _effect--ripple waves-effect waves-light" >Save</button>
                                            </div>
                                            <hr>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-6 mb-4">
                            <h5 class="pb-2">Admission Information <a href="{{ URL::to('application/'.$application_info->id.'/details') }}" class="btn btn-info btn-rounded mb-2 mr-4 inline-flex">Show Full Information <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 icon custom-edit-icon"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a></h5>
                            <div class="table-responsive">
                                <table class="table-bordered mb-4 table">
                                    <tbody>
                                        <tr>
                                            <td>Check Eligibility</td>
                                            <td>{{ (!empty($check_eligible->is_eligible))?$check_eligible->is_eligible:'Not Specified' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Application Type</td>
                                            <td>{{ ($application_info->is_academic==1)?'Academic':'Non-academic' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Campus/University</td>
                                            <td>{{ (!empty($application_info->campus->campus_name))?$application_info->campus->campus_name:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Course Category</td>
                                            <td>{{ (!empty($application_info->course->category->title))?$application_info->course->category->title:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Course Level</td>
                                            <td>{{ (!empty($application_info->course->course_level->title))?$application_info->course->course_level->title:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Current Course</td>
                                            <td>{{ (!empty($application_info->course->course_name))?$application_info->course->course_name:'' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Course Fee</td>
                                            <td>
                                                <span>Local: {{ (!empty($application_info->course->course_fee))?$application_info->course->course_fee:'' }}</span><br>
                                                <span>International: {{ (!empty($application_info->course->international_course_fee))?$application_info->course->international_course_fee:'' }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Course Duration</td>
                                            <td>
                                                {{ (!empty($application_info->course->course_duration))?$application_info->course->course_duration:'' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Intake Year</td>
                                            <td>{{ (!empty($application_info->intake))? date('F y',strtotime($application_info->intake)):'' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @if(Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='adminManager')
                            <div class="card no-outer-spacing no-border-custom">
                                <div class="card-header">
                                    <section class="mb-0 mt-0">
                                        <h5>Change Status</h5>
                                    </section>
                                </div>
                                <div id="" class="" aria-labelledby="headingTwo2" data-parent="#withoutSpacing">
                                    <div class="row">
                                        <div style="margin: 5px;" class="col-10">
                                            <div class="form-group mb-2"><label for="exampleFormControlInput1">Select Status</label>
                                                @if(count($application_status_list) > 0)
                                                <select data-id="{{ (!empty($application_info->id))?$application_info->id:'' }}" data-action="{{ URL::to('application-status-change') }}" name="status" id="status" class="application-status-change form-control" onchange="offerFuncCalled()">
                                                    <option value="">--Select One--</option>
                                                    @foreach ($application_status_list as $status)
                                                    <option {{ ($application_info->status==$status->id)?'selected':'' }} value="{{ $status->id }}">{{ $status->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if(!empty($application_info->conditional_offer_text) && $application_info->status==9)
                                                <div id="offer-box" class="mt-2">
                                                    <textarea id="offer_letter_text" name="offer_letter_text" class="form-control">{{ $application_info->conditional_offer_text }}</textarea>
                                                </div>
                                                @else
                                                <div id="offer-box" style="display: none;" class="mt-2">
                                                    <textarea id="offer_letter_text" name="offer_letter_text" class="form-control"></textarea>
                                                </div>
                                                @endif
                                                <button id="status-confirmed" onclick="application_status_change()" id="btn-followup-submit" class="btn badge badge-info btn-sm _effect--ripple waves-effect waves-light mt-1">Confirm</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            @endif
                            @if(Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer')
                            <div class="card no-outer-spacing no-border-custom">
                                <div class="card-header">
                                    <section class="mb-0 mt-0">
                                        <h5>Change Interview Status</h5>
                                    </section>
                                </div>
                                <div id="" class="" aria-labelledby="headingTwo2" data-parent="#withoutSpacing">
                                    <div class="row">
                                        <div style="margin: 5px;" class="col-10">
                                            <div class="form-group mb-2"><label for="exampleFormControlInput1">Select Status</label>
                                                @if(count($interview_status_list) > 0)
                                                <select data-id="{{ (!empty($application_info->id))?$application_info->id:'' }}" data-action="{{ URL::to('interview-status-change') }}" name="status" class="interview-status-change form-control">
                                                    <option value="">--Select One--</option>
                                                    @foreach ($interview_status_list as $status)
                                                    <option {{ ($application_info->interview_status==$status->id)?'selected':'' }} value="{{ $status->id }}">{{ $status->title }}</option>
                                                    @endforeach
                                                </select>
                                                <button id="interview-status-confirmed" onclick="interview_status_change()" id="btn-followup-submit" class="btn badge badge-info btn-sm _effect--ripple waves-effect waves-light">Confirm</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            @endif
                            <div class="card no-outer-spacing no-border-custom">
                                <div class="card-header">
                                    <section class="mb-0 mt-0">
                                        <div role="menu" class="" data-toggle="">Meeting / Interview</div>
                                    </section>
                                </div>
                                <div id="" class="" aria-labelledby="headingTwo2" data-parent="#withoutSpacing">
                                    @if(Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer' || Auth::user()->role=='adminManager')
                                    <div id="meetingnote-data">
                                        @if(count($application_info->meetings) > 0)
                                            @foreach ($application_info->meetings as $note)
                                            <div class="row col-md-12 mt-3" id="">
                                                <div style="margin-left:7px;" class="media custom-media-img">
                                                    <div style="margin-left: 2px;" class="ml-2">
                                                        <img alt="avatar" src="{{ asset($note->user->photo) }}" class="img-fluid rounded-circle" style="width: 50px; margin-right: 5px;">
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="tx-inverse">{{ (!empty($note->user->name))?$note->user->name:'' }}
                                                            @if(Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer')
                                                                @if (Auth::user()->id==$note->user_id || Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer')
                                                                <a onclick="deleteMeetingNote({{ $note->id }})" style="float:right; color:#b30b39;" href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                                                @endif
                                                                @if($note->is_meeting_done==1)
                                                                <a onclick="isMeetingComplete({{ $note->id }})" style="float:right; color:#1f6b08; margin-right:5px;" href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Complete" aria-label="Complete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></a>
                                                                @else
                                                                <a onclick="isMeetingComplete({{ $note->id }})" style="float:right; color:#ada310; margin-right:5px;" href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Pending" aria-label="Pending"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></a>
                                                                @endif
                                                            @endif
                                                            <a href="{{ URL::to('meeting/'.$note->id.'/details') }}" style="float:right; margin-right:5px;" class="badge badge-pill bg-info">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye text-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                            </a>
                                                        </h6>
                                                        <p class="mg-b-0">{{ (!empty($note->meeting_notes))?$note->meeting_notes:'' }}</p>
                                                        <small class="text-left"> Meeting Date : <span class="badge badge-warning">{{ date('F d Y H:i:s',strtotime($note->meeting_date_time)) }}</span></small><br>
                                                        <small class="text-left"> Created : {{ date('F d Y H:i:s',strtotime($note->created_at)) }}</small></div>
                                                </div>
                                            </div><hr>
                                            @endforeach
                                        @endif
                                    </div>
                                    @endif
                                    @if(Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer')
                                    <div class="card-body custom-card-body">
                                        <form enctype="multipart/form-data" id="meeting-form" method="post">
                                            <div class="col col-md-12 p-0">
                                                <div class="form-group lead-drawer-form">

                                                    <input type="hidden" value="{{ URL::to('application-meeting-note-post') }}" id="meeting_url" />
                                                    <input type="hidden" value="{{ (!empty($application_info->id))?$application_info->id:'' }}" id="meeting_application_id" />
                                                    <textarea name="application_meeting" id="application_meeting" class="form-control" rows="2"></textarea>
                                                </div><br>
                                                <div class="col col-md-12 p-0">
                                                    <input name="meeting_date" id="meeting_date" type="datetime-local" class="form-control" />
                                                </div><br>
                                                <div class="col col-md-12 p-0">
                                                    <input name="meeting_doc" id="meeting_doc" type="file" class="form-control" />
                                                </div>
                                                <button id="btn-meeting-submit" class="btn badge badge-info btn-sm _effect--ripple waves-effect waves-light" >Save</button>
                                            </div>
                                            <hr>
                                        </form>

                                    </div>
                                    @endif
                                </div>
                            </div><br>
                            <div class="card no-outer-spacing no-border-custom">
                                <div class="card-header">
                                    <section class="mb-0 mt-0">
                                        <h5>Check Eligibility</h5>
                                    </section>
                                </div>
                                <div id="" class="" aria-labelledby="headingTwo2" data-parent="#withoutSpacing">

                                    <div class="card-body custom-card-body">
                                        <form id="eligible-form" method="post">
                                            <div class="col col-md-12 p-0">
                                                <div class="form-group lead-drawer-form">
                                                    <input type="hidden" value="{{ URL::to('check-eligible-data-post') }}" name="eligible_url" id="eligible_url" />
                                                    <input type="hidden" value="{{ (!empty($application_info->id))?$application_info->id:'' }}" name="eligible_application_id" id="eligible_application_id" />
                                                    <input type="hidden" value="{{ (!empty($check_eligible->id))?$check_eligible->id:'' }}" name="eligible_id" id="eligible_id" />
                                                    <input placeholder="Officer Name" name="officer_name" id="officer_name" value="{{ (!empty($check_eligible->officer_name))?$check_eligible->officer_name:'' }}" class="form-control" rows="2" />
                                                </div><br>
                                                <div class="col col-md-12 p-0">
                                                    <input placeholder="CRN" value="{{ (!empty($check_eligible->crn))?$check_eligible->crn:'' }}" name="crn" id="crn" type="text" class="form-control" />
                                                </div><br>
                                                <div class="col col-md-12 p-0">
                                                    <select class="form-control" name="is_eligible" id="is_eligible">
                                                        <option value="">--Select One--</option>
                                                        <option {{ (!empty($check_eligible->is_eligible) && $check_eligible->is_eligible=="Eligible")?'selected':'' }} value="Eligible">Eligible</option>
                                                        <option {{ (!empty($check_eligible->is_eligible) && $check_eligible->is_eligible=="Not Eligible")?'selected':'' }} value="Not Eligible">Not Eligible</option>
                                                    </select>
                                                </div><br>
                                                <div class="col col-md-12 p-0">
                                                    <textarea placeholder="Notes" class="form-control" name="eligible_notes" id="eligible_notes">{{ (!empty($check_eligible->notes))?$check_eligible->notes:'' }}</textarea>
                                                </div>
                                                <button id="btn-eligible-submit" class="mt-2 btn badge badge-info btn-sm _effect--ripple waves-effect waves-light" >Update</button>
                                            </div>
                                            <hr>
                                        </form>

                                    </div>
                                </div>
                            </div><br>
                        </div>
                        <div class="col col-md-12 mb-4">
                            <h5 class="pb-2">Application Document <a href="{{ URL::to('application-create/'.$application_info->id.'/step-2') }}" class="btn btn-info btn-rounded mb-2 mr-4 inline-flex"> Edit Document <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 icon custom-edit-icon"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a></h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Filename</th>
                                            <th scope="col">Uploaded on</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($application_info->applicationDocuments as $doc)
                                        <tr>
                                            <td>{{ (!empty($doc->title))?$doc->title:$doc->document_type }}</td>
                                            <td>
                                                @if(!empty($doc->create_date))
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                                <span class="table-inner-text">{{ date('F d Y',strtotime($doc->create_date)) }}</span>
                                                @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                                <span class="table-inner-text">{{ date('F d Y',strtotime($doc->created_at)) }}</span>
                                                @endif

                                            </td>
                                            <td>
                                                <a target="_blank" href="{{ asset($doc->doc) }}"><span class="badge badge-light-success">Preview</span></a>
                                                @if(Auth::user()->role=='admin')
                                                    <a onclick="if(confirm('Are you sure to Delete this Application Document?')) location.href='{{ URL::to('delete-application-document/'.$doc->id) }}'; return false;" href="javascript:void(0)" class="">
                                                        <span class="badge badge-pill badge-danger custom-btn-branch me-1">
                                                            <svg style="color: rgb(245, 229, 229);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2  delete-multiple"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                        </span>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>No Data Found</tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col col-md-12 mb-4">
                            <div class="row">
                                <h5>Application SOP</h5>
                                <form method="post" action="#" class="form">
                                    @csrf
                                    <div class="row">
                                        <div class="col form-group mb-4">
                                            <textarea name="sop_data" class="form-control" rows="12">{{ (!empty($application_info->sop->sop_data))?$application_info->sop->sop_data:'' }}</textarea>
                                        </div>
                                    </div>
                                    @if(Auth::user()->role=='adminManager' || Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer')
                                        @if(!empty($application_info->sop->id))
                                            <a href="{{ URL::to('sop-plagiarism-check-from-processing/'.$application_info->sop->id) }}" class="btn btn-danger btn-nxt">SOP Plagiarism Check</a>
                                        @else
                                            <a href="{{ URL::to('application-create/'.$application_info->id.'/step-2') }}" class="btn btn-primary btn-nxt">Write SOP First Then Check</a>
                                        @endif
                                    @endif
                                </form>
                                @if(Auth::user()->role=='adminManager' || Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer')
                                <hr>
                                <h5>SOP Plagiarism Result</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Total Queries</td>
                                        <td>Plag Percent</td>
                                        <td>Paraphrase Percent</td>
                                        <td>Unique Percent</td>
                                    </tr>
                                    <tr>
                                        <td>{{ (!empty($application_info->sop->total_queries))?$application_info->sop->total_queries:'0' }}</td>
                                        <td>{{ (!empty($application_info->sop->plag_percent))?$application_info->sop->plag_percent.'%':'0%' }}</td>
                                        <td>{{ (!empty($application_info->sop->paraphrase_percent))?$application_info->sop->paraphrase_percent.'%':'0%' }}</td>
                                        <td>{{ (!empty($application_info->sop->unique_percent))?$application_info->sop->unique_percent.'%':'0% Unique' }}</td>
                                    </tr>

                                </table>
                                @endif
                            </div>
                        </div>
                        <div class="col col-md-12 mb-4">
                            <div class="row">
                                <h5>Application Activities</h5>
                                @if(Auth::user()->role=='adminManager' || Auth::user()->role=='admin' || Auth::user()->role=='manager' || Auth::user()->role=='interviewer')
                                <div class="row table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Title</td>
                                        <td>Description</td>

                                    </tr>
                                    @forelse ($activities as $row)
                                    <tr>
                                        <td>
                                            {{ $row->title }}
                                        </td>
                                        <td>
                                            <img src="{{ asset($row->creator_image) }}" class="img-fluid me-2" alt="avatar" style="height: 40px; width: 40px; border-radius: 50%;" />
                                            <p>{{ $row->creator_name }}</p>
                                            {!! $row->description !!}
                                            <p>{{ date('F d Y H:i:s',strtotime($row->created_at)) }}</p>
                                            @if (!empty($row->basic_info))
                                            <p>
                                                <a onclick="get_notification_data('{{ $row->id }}')" data-bs-toggle="modal" data-bs-target="#inputFormModal" class="btn badge badge-danger btn-sm _effect--ripple waves-effect waves-light" href="javascript://">View Details</a>
                                            </p>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                       <tr><td>No Data Found!</td></tr>
                                    @endforelse
                                </table>
                                </div>
                                @endif
                            </div>
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
    .custom-media-margin{
        margin: 9px !important;
    }
</style>
@stop
