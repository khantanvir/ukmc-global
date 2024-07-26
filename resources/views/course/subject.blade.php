@extends('adminpanel')
@section('admin')
<div class="modal fade inputForm-modal" id="assignToModal" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header" id="inputFormModalLabel">
            <h5 class="modal-title"><b>Copy Subject From Another Intake</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="mt-0">
            <form action="{{ URL::to('transfer-subject-from-another-intake') }}" id="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Select Another Intake:</label>
                                <input type="hidden" name="current_intake" id="current_intake" />
                                <select name="another_intake" id="another_intake" class="form-select">
                                    <option value="" selected>Choose...</option>
                                </select>
                                @if ($errors->has('another_intake'))
                                    <span class="text-danger">{{ $errors->first('another_intake') }}</span>
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
                                    <li class="breadcrumb-item"><a href="#">Course</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Course Subject</li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                </header>
            </div>
        </div>
        <h5 class="p-3">Course Subject List</h5>
        <div class="widget-content widget-content-area">
            <form method="post" action="{{ URL::to('course/subject/data-post') }}" enctype="multipart/form-data">
                @csrf
                 <div class="row mb-3">
                     <div class="col-3">
                         <input type="hidden" name="subject_id" value="{{ (!empty($subject_id))?$subject_id:'' }}" />
                         <input type="hidden" id="course_id" name="course_id" value="{{ (!empty($course_id))?$course_id:'' }}" />
                         <input type="text" name="title" value="{{ (!empty($subject_data->title))?$subject_data->title:'' }}" class="form-control" placeholder="Subject Title">
                         @if($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                         @endif
                     </div>
                     <div class="col-4">
                         <textarea name="description" placeholder="Description Here" class="form-control">{{ (!empty($subject_data->description))?$subject_data->description:'' }}</textarea>
                     </div>
                     <div class="col-3">
                        <input type="text" name="duration" value="{{ (!empty($subject_data->duration))?$subject_data->duration:'' }}" class="form-control" placeholder="Duration eg. 300 hours">
                        @if($errors->has('duration'))
                            <span class="text-danger">{{ $errors->first('duration') }}</span>
                         @endif
                    </div>
                     <div class="col">
                        <input type="submit" class="btn btn-primary">
                     </div>
                 </div>
            </form>
            <!--<div class="col-md-12">
                <a onclick="get_another_intake_data()" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#assignToModal" href="#">Copy From Previous Intake</a>
            </div>-->
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <table id="zero-config" class="table dt-table-hover text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th class="no-content">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subjects as $row)
                            <tr class="">
                                <td>{{ (!empty($row->id))?$row->id:'' }}</td>
                                <td>{{ (!empty($row->title))?$row->title:'' }}</td>
                                <td>{{ (!empty($row->description))?$row->description:'' }}</td>
                                <td>{{ (!empty($row->duration))?$row->duration:'' }}</td>
                                <td>
                                    <div class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-text-toggle">
                                        <div class="input-checkbox">
                                            <span class="switch-chk-label label-left">On</span>
                                            <input {{ ($row->status==0)?'checked':'' }} data-action="{{ URL::to('course/subject-intake-status') }}" data-id="{{ $row->id }}" class="subject-status-change switch-input" type="checkbox"
                                                    role="switch" id="form-custom-switch-inner-text">
                                            <span class="switch-chk-label label-right">Off</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ URL::to('course/subject/'.$row->course_id.'/'.'edit/'.$row->id) }}" class="badge badge-pill bg-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 text-white"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                    </a>
                                    <a href="{{ URL::to('subject/schedule/'.$row->id) }}" class="badge badge-pill bg-warning">
                                        <svg style="color: white;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-down-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8.636 12.5a.5.5 0 0 1-.5.5H1.5A1.5 1.5 0 0 1 0 11.5v-10A1.5 1.5 0 0 1 1.5 0h10A1.5 1.5 0 0 1 13 1.5v6.636a.5.5 0 0 1-1 0V1.5a.5.5 0 0 0-.5-.5h-10a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h6.636a.5.5 0 0 1 .5.5z"/>
                                            <path fill-rule="evenodd" d="M16 15.5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1 0-1h3.793L6.146 6.854a.5.5 0 1 1 .708-.708L15 14.293V10.5a.5.5 0 0 1 1 0v5z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
<script src="{{ asset('web/js/jquery.js') }}"></script>
<script>
    $(function(){
       $('.subject-status-change').change(function(){
           var status = $(this).prop('checked') == true ? 0 : 1;
           var subject_id = $(this).data('id');
           var url = $(this).data('action');
               $.post(url,
               {
                   subject_id: subject_id,
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
   <script>
        function get_another_intake_data(){
            var intake_id = $('#intake_id').val();
            $('#current_intake').val(intake_id);
				$.get("{{ URL::to('get-intake-list') }}/"+intake_id,function(data,status){
					if(data['result']['key']===101){
						alert(data['result']['val']);
					}
					if(data['result']['key']===200){
						console.log(data['result']['val']);
						$('#another_intake').html(data['result']['val']);
					}
				});
        }
   </script>
   @if($errors->has('assign_to_admission_manager_id') || $errors->has('assign_to_manager_id'))
   <script>
       $(document).ready(function() {
           $('#assignToModal1').modal('show');
       });
   </script>
   @endif
@stop
