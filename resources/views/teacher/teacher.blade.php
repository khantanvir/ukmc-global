
@extends('adminpanel')
@section('admin')
<div class="modal fade inputForm-modal" id="inputFormModal1" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header" id="inputFormModalLabel">
            <h5 class="modal-title"><b>Transfer Application To Interviewer</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <form method="post" action="#" class="mt-0">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <div class="col">
                        <div class="form-group mb-4"><label for="exampleFormControlInput1">Role</label>
                            <input type="hidden" name="interviewer_user_id" value="" id="interviewer_user_id" />
                            {{-- <select id="assign_to_interviewer_user_id" name="assign_to_interviewer_user_id" class="form-control">
                                <option value="">Select Interviewer</option>
                                @foreach ($interviewer_list as $irow)
                                    <option value="{{ $irow->id }}">{{ $irow->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('assign_to_interviewer_user_id'))
                                <span class="text-danger">{{ $errors->first('assign_to_interviewer_user_id') }}</span>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-light-danger mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Cancel</a>
                <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect" data-bs-dismiss="modal">Confirm</button>
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
                                    <li class="breadcrumb-item"><a href="#">Teacher</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                </header>
            </div>
        </div>
        <h5 class="p-3">Teacher List</h5>
        <div class="widget-content widget-content-area">
            <form method="get" action="">
                 <div class="row mb-4">
                    <div class="col-3">
                        <select class="form-control" name="location" id="location">
                            <option value="">--Select Location--</option>
                            @forelse($location_list as $key => $value)
                            <option {{ (!empty($get_location) && $get_location==$value->id)?'selected':'' }} value="{{ $value->id }}">{{ $value->title }}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>
                     <div class="col-4">
                         <input value="{{ (!empty($get_name))?$get_name:'' }}" name="name" type="text" class="form-control" placeholder="Enter Name">
                     </div>
                     <div class="col-1">
                        <input type="submit" class="btn btn-warning">
                     </div>
                     <div class="col">
                        <a href="{{ url('teachers') }}" class="btn btn-danger">Reset</a>
                     </div>
                     <div class="col">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <li><a class="dropdown-item" href="{{ URL::to('create-teacher') }}">Create Teacher</a></li>
                                </ul>
                            </div>
                        </div>
                     </div>
                 </div>
            </form>
        </div>
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Total Assigned Class</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($teachers as $key => $row)
                                <tr class="">
                                    <td>{{ $row->name ?? '' }}</td>
                                    <td>{{ $row->email ?? '' }}</td>
                                    <td>{{ $row->phone ?? '' }}</td>
                                    <td>Teacher</td>
                                    <td>0</td>
                                    <td class="text-center">
                                        <div class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-text-toggle">
                                            <div class="input-checkbox">
                                                <span class="switch-chk-label label-left">On</span>
                                                <input {{ ($row->active==1)?'checked':'' }} data-action="{{ URL::to('user-status-chnage') }}" data-id="{{ $row->id }}" class="user-status-chnage switch-input" type="checkbox"
                                                    role="switch" id="form-custom-switch-inner-text">
                                                <span class="switch-chk-label label-right">Off</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ URL::to('edit-teacher/'.$row->slug) }}" class="badge badge-pill bg-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 text-white"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                        </a>
                                        <a href="{{ url('get-class-schedule-by-teacher') }}" title="view all class schedule" class="badge badge-pill bg-danger">
                                            <svg style="color: white;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                                                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                        <div style="text-align: center;" class="pagination-custom_solid">

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<script src="{{ asset('web/js/jquery.js') }}"></script>
<script>
    function getInterviewerData(id){
        if(id===null){
            return false;
        }
        $('#interviewer_user_id').val(id);
    }
    function getAdmissionOfficer(){
        var manager_id = $('#manager_id').val();
        $.get('{{ URL::to('get-admission-officer-by-manager') }}/'+manager_id,function(data,status){
            if(data['result']['key']===200){
                console.log(data['result']['val']);
                $('#admission_officer_id').html(data['result']['val']);
            }
        });
    }
    function getAdmissionOfficerList(id){
        $('#from_admission_officer_id').val(id);
    }
    function change_password(id){
        $('#change_password_user_id').val(id);
    }
</script>
@if($errors->has('assign_to_interviewer_user_id'))
    <script>
        $(document).ready(function() {
            $('#inputFormModal1').modal('show');
        });
    </script>
@endif
@if($errors->has('manager_id') || $errors->has('admission_officer_id'))
    <script>
        $(document).ready(function() {
            $('#inputFormModal2').modal('show');
        });
    </script>
@endif
@if($errors->has('password_confirmation') || $errors->has('password_confirmation'))
    <script>
        $(document).ready(function() {
            $('#inputFormModal5').modal('show');
        });
    </script>
@endif
@stop
