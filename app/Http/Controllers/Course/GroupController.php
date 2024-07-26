<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Course\CourseCreateRequest;
use App\Http\Requests\Course\CourseEditRequest;
use App\Models\Agent\Company;
use App\Models\Application\Application;
use App\Models\Application\ApplicationIntake;
use App\Models\Application\ApplicationStatus;
use App\Models\Campus\Campus;
use App\Models\Course\AttendenceConfirmation;
use App\Models\Course\AttendNote;
use App\Models\Course\AuthorisedAbsent;
use App\Models\Course\ClassSchedule;
use App\Models\Course\Course;
use App\Models\Course\CourseAdditional;
use Illuminate\Support\Facades\Session;
use App\Traits\Service;
Use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use App\Models\Course\CourseCategories;
use App\Models\Course\CourseIntake;
use App\Models\Course\CourseLevel;
use App\Models\Course\CourseSubject;
use App\Models\Course\SubjectSchedule;
use App\Models\User;
use  Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Laravel\Scout\Searchable;
use MeiliSearch\Client;
use Illuminate\Support\Str;
use App\Models\Course\CourseGroup;
use App\Models\Course\JoinGroup;
use Carbon\Carbon;

class GroupController extends Controller
{
    use Service;
    public function create_course_group($id=NULL,$edit=NULL,$group_id=NULL){
        $data['page_title'] = 'Course | Group';
        $data['intake_id'] = $id;
        $data['course'] = true;
        if(!empty($group_id)){
            $data['group_data'] = CourseGroup::where('id',$group_id)->first();
        }
        return view('course/group/create',$data);
    }
    public function course_intake_group_list($id=NULL){
        $data['page_title'] = 'Course | Intake Group List';
        $data['course_intake_id'] = $id;
        $getIntake = CourseIntake::where('id',$id)->first();
        $data['groups'] = CourseGroup::where('course_intake_id',$id)->orderBy('id','desc')->paginate(15);
        $data['course'] = true;
        $data['course_id'] = $getIntake->course_id;
        return view('course/group/list',$data);
    }
    public function group_data_post(Request $request){
        $request->validate([
            'title'=>'required',
        ]);
        $getIntake = CourseIntake::where('id',$request->intake_id)->first();
        if($request->group_id){
            $group = CourseGroup::where('id',$request->group_id)->first();
        }else{
            $group = new CourseGroup();
        }
        $group->title = $request->title;
        $group->course_intake_id = $request->intake_id;
        $group->intake = (!empty($getIntake->intake_date))?$getIntake->intake_date:'';
        $group->save();
        Session::flash('success','Group Data Updated!');
        return redirect('course-intake-group-list/'.$getIntake->id);
    }
    public function group_status_change(Request $request){
        $courseGroup = CourseGroup::where('id',$request->group_id)->first();
        if(!$courseGroup){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Course Group Data Not Found! Server Error!'
            );
            return response()->json($data,200);
        }
        $msg = '';
        if($courseGroup->status==1){
            $courseGroup->status = 0;
            $courseGroup->save();
            $msg = 'Course Group Activated';
        }else{
            $courseGroup->status = 1;
            $courseGroup->save();
            $msg = 'Course Group Deactivated';
        }
        $data['result'] = array(
            'key'=>200,
            'val'=>$msg
        );
        return response()->json($data,200);
    }
    //join group
    public function join_group(Request $request){
        $request->validate([
            'group_id'=>'required',
            'assign_application_ids'=>'required'
        ]);
        $ids = $request->assign_application_ids;
        $arrayIds = explode(",",$ids);
        foreach($arrayIds as $row){
            $join = new JoinGroup();
            $join->application_id = $row;
            $join->group_id = $request->group_id;
            $join->save();
        }
        Session::flash('success',count($arrayIds) . 'Applicaton Assigned On This Group!');
        return redirect()->back();
    }
    //attendence group
    public function attendence_groups(Request $request){
        $data['page_title'] = 'Attendence | Group List';
        $data['attend'] = true;
        $data['attendence_groups'] = true;
        $get_course_id = $request->course_id;
        $get_intake_id = $request->intake_id;
        Session::put('get_course_id',$get_course_id);
        Session::put('get_intake_id',$get_intake_id);
        if($get_course_id){
            $data['intake_list'] = CourseIntake::where('course_id',$get_course_id)->get();
        }else{
            $data['intake_list'] = [];
        }
        $data['list'] = CourseGroup::query()
        ->withCount(['total_application'])
        ->when($get_intake_id, function ($query, $get_intake_id) {
            return $query->where('course_intake_id',$get_intake_id);
        })
        ->orderBy('id','desc')
        ->paginate(15)
        ->appends([
            'intake_id' => $get_intake_id,
            'course_id' => $get_course_id,
        ]);
        $data['course_list'] = Course::where('status',1)->get();
        $data['get_course_id'] = Session::get('get_course_id');
        $data['get_intake_id'] = Session::get('get_intake_id');
        //dd($data['list']);

        return view('group/group_list',$data);
    }
    //get intake data
    public function get_intake_data($id=NULL){
        $intakes = CourseIntake::where('course_id',$id)->get();
        $select = '';
        $select .= '<option value="">Select Intake</option>';
        foreach($intakes as $row){
            $select .= '<option value="'.$row->id.'">'.$row->title.'</option>';
        }
        $data['result'] = array(
            'key'=>200,
            'val'=>$select
        );
        return response()->json($data,200);
    }
    //group is complete status change
    public function group_data_status_change(Request $request){
        $groupData = CourseGroup::where('id',$request->group_id)->first();
        if(!$groupData){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Group Data Not Found! Server Error!'
            );
            return response()->json($data,200);
        }
        $msg = '';
        if($groupData->status==1){
            $groupData->status = 0;
            $groupData->save();
            $msg = 'Group Roll Back';
        }else{
            $groupData->status = 1;
            $groupData->save();
            $msg = 'Group Attendence Task Complete';
        }
        $data['result'] = array(
            'key'=>200,
            'val'=>$msg
        );
        return response()->json($data,200);
    }
    //attendence group details
    public function attendence_group_details($id=NULL){
        $data['group_data'] = CourseGroup::where('id',$id)->first();
        if(!$data['group_data']){
            Session::flash('error','Group Data Not Found! Server Error');
            return redirect()->back();
        }
        $data['get_intake_info'] = CourseIntake::where('id',$data['group_data']->course_intake_id)->first();
        $data['course_data'] = Course::with(['course_subjects'])->where('id',$data['get_intake_info']->course_id)->first();
        $data['current_date'] = Carbon::now()->format('l');
        $data['today_schedules'] = SubjectSchedule::with(['course','subject'])->where('course_id',$data['course_data']->id)->where('schedule_date',$data['current_date'])->get();
        $data['class_schedule_list'] = ClassSchedule::with(['subject_schedule'])->where('group_id',$data['group_data']->id)->orderBy('id','desc')->paginate(15);

        //dd($data['today_schedules']);
        return view('group/details',$data);
    }
    //make class schedules
    public function make_class_schedules(Request $request){
        $group_data = CourseGroup::where('id',$request->group_id)->first();
        if(!$group_data){
            Session::flash('error','Group Data Not Found! Server Error!');
            return redirect()->back();
        }
        $subject_schedule_data = SubjectSchedule::where('id',$request->subject_schedule_id)->first();
        if(!$subject_schedule_data){
            Session::flash('error','Subject Schedule Data Not Found! Server Error!');
            return redirect()->back();
        }
        $schedule = new ClassSchedule();
        $schedule->course_id = $subject_schedule_data->course_id;
        $schedule->subject_id = $subject_schedule_data->subject_id;
        $schedule->subject_schedule_id = $subject_schedule_data->id;
        $schedule->title = $subject_schedule_data->title;
        $schedule->schedule_date = date('Y-m-d',time());
        $schedule->time_from = $subject_schedule_data->time_from;
        $schedule->time_to = $subject_schedule_data->time_to;
        $slug = Str::slug($subject_schedule_data->title,'-');
        $schedule->slug = $slug.Service::randomString();
        $schedule->intake_id = $group_data->course_intake_id;
        $schedule->intake_date = $group_data->intake;
        $schedule->group_id = $group_data->id;
        $schedule->save();
        Session::flash('success','Successfully Make Class Schedule For Attendence!');
        return redirect()->back();
    }
    //group is done status change
    public function group_is_done_status_change(Request $request){
        $classSchedule = ClassSchedule::where('id',$request->class_schedule_id)->first();
        if(!$classSchedule){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Class Schedule Data Not Found! Server Error!'
            );
            return response()->json($data,200);
        }
        //get group applicant

        $msg = '';
        if($classSchedule->is_done==1){
            $classSchedule->is_done = 0;
            $classSchedule->save();
            $msg = 'Class Schedule Roll Back Again';
        }else{
            $classSchedule->is_done = 1;
            $classSchedule->save();
            $msg = 'Class Schedule Task Complete';
            $getGroupApplicants = JoinGroup::where('group_id',$classSchedule->group_id)->get();
            if(!empty($getGroupApplicants)){
                $ids = array();
                $getAttendList = AttendenceConfirmation::where('class_schedule_id',$classSchedule->id)->get();
                if(!empty($getAttendList)){
                    foreach($getAttendList as $row){
                        $ids[] = $row->application_id;
                    }
                }
                foreach($getGroupApplicants as $applicant){
                    if(!in_array($applicant->application_id,$ids)){
                        $checkAbsent = AuthorisedAbsent::where('application_id', $applicant->application_id)->whereDate('to_date', '>', Carbon::now())->where('status',0)->orderBy('id', 'desc')->first();
                        $confirmation = new AttendenceConfirmation();
                        $confirmation->class_schedule_id = $classSchedule->id;
                        $confirmation->course_group_id = $classSchedule->group_id;
                        $confirmation->application_id = $applicant->application_id;
                        $confirmation->course_id = $classSchedule->course_id;
                        $confirmation->intake_id = $classSchedule->intake_id;
                        $confirmation->subject_id = $classSchedule->subject_id;
                        $confirmation->intake_date = $classSchedule->intake_date;
                        $confirmation->application_status = (!empty($checkAbsent))?3:2;
                        $confirmation->status = 0;
                        $confirmation->save();
                    }
                }
            }
        }
        $data['result'] = array(
            'key'=>200,
            'val'=>$msg
        );
        return response()->json($data,200);
    }
    //group attendence
    public function group_attendence($id=NULL){
        $data['page_title'] = 'Group | Attendance';
        $data['course'] = true;
        $getSchedule = ClassSchedule::where('id',$id)->first();
        if(!$getSchedule){
            Session::flash('error','Schedule Data Not Found!');
            return redirect()->back();
        }
        $data['schedule_id'] = $id;
        $data['group_id'] = $getSchedule->group_id;

        $data['applicants'] = JoinGroup::with(['application_data'])->where('group_id',$getSchedule->group_id)->paginate(30);
        //$data['applicants'] = Application::with(['applicant_attendence'])->where('course_id',$getSchedule->course_id)->where('intake',$getSchedule->intake_date)->where('status',11)->paginate(50);
        //dd($data['applicants']);
        $data['current_date'] = Carbon::now();
        return view('course/subject/attendence',$data);
    }
    //get application by group
    public function get_application_by_group(Request $request, $id=NULL){
        $data['page_title'] = 'Group | Attendance';
        $data['attendence'] = true;
        $data['get_group_info'] = CourseGroup::where('id',$id)->first();
        if(!$data['get_group_info']){
            Session::flash('error','Group Data Not Found!');
            return redirect()->back();
        }
        $data['get_group_list'] = CourseGroup::withCount(['total_application'])->where('id','!=',$data['get_group_info']->id)->where('course_intake_id',$data['get_group_info']->course_intake_id)->where('status',0)->get();
        $get_title = $request->title;
        Session::put('get_title',$get_title);
        $data['application_list'] = JoinGroup::query()
        ->with(['application_data','group'])
        ->when($get_title, function ($query, $get_title) {
            return $query->whereHas('application_data', function ($subquery) use ($get_title) {
                $subquery->where('name', 'like', '%' . $get_title . '%')
                    ->orWhere('email', 'like', '%' . $get_title . '%')
                    ->orWhere('id', 'like', '%' . $get_title . '%')
                    ->orWhere('phone', 'like', '%' . $get_title . '%');
            });
        })
        ->where('group_id',$id)
        ->paginate(50);

        $data['group_id'] = $id;
        $data['get_title'] = Session::get('get_title');
        $data['aa_application_id'] = Session::get('aa_application_id');
        $data['current_date'] = date('Y-m-d H:i:s',time());
        //dd($data['current_date']);
        //dd($data['application_list']);
        return view('course/group/application_list',$data);
    }
    //move to another group
    public function move_to_another_group(Request $request){
        $request->validate([
            'group_id'=>'required',
            'assign_application_ids'=>'required',
        ]);
        $getGroup = CourseGroup::where('id',$request->group_id)->first();
        if(!$getGroup){
            Session::flash('error','Group data Not Found!');
            return redirect()->back();
        }
        $ids = $request->assign_application_ids;
        $array_ids = explode(",",$ids);
        foreach($array_ids as $row){
            $getJoinInfo = JoinGroup::where('application_id',$row)->update(['group_id'=>$getGroup->id]);
        }
        Session::flash('success','Successfully Moved To Another Group!');
        return redirect()->back();
    }
    //all course
    public function create_authorised_absent(Request $request){
        $request->validate([
            'from_date'=>'required',
            'to_date'=>'required',
            'reason'=>'required',
        ]);
        $absent = new AuthorisedAbsent();
        $absent->application_id = $request->aa_application_id;
        $absent->from_date = Carbon::parse($request->from_date);
        $absent->to_date = Carbon::parse($request->to_date);
        $absent->reason = $request->reason;
        //course module pdf
        $file = $request->file;
        if ($request->hasFile('file')) {
            $ext = $file->getClientOriginalExtension();
            $doc_file_name = $file->getClientOriginalName();
            $doc_file_name = Service::slug_create($doc_file_name).rand(11, 99).'.'.$ext;
            $upload_path1 = 'backend/images/course/module/attendence/';
            Service::createDirectory($upload_path1);
            $request->file('file')->move(public_path('backend/images/course/module/attendence/'), $doc_file_name);
            $absent->file = $upload_path1.$doc_file_name;
        }
        $absent->save();
        Session::flash('success','Authorised Absent Created');
        Session::put('aa_application_id',$absent->application_id);
        return redirect()->back();
    }
    //get attend list of student
    public function get_attend_list_of_student(Request $request, $application_id=NULL){
        $get_application_status = $request->application_status;
        $data['attend_list'] = AttendenceConfirmation::query()
        ->with(['application','group','class_schedule','course','subject'])
        ->when($get_application_status, function ($query, $get_application_status) {
            return $query->where('application_status',$get_application_status);
        })
        ->where('application_id',$application_id)
        ->orderBy('id','desc')
        ->paginate(50);

        $data['absent_list'] = AuthorisedAbsent::where('application_id',$application_id)->orderBy('id','desc')->get();
        $data['attend'] = true;
        $data['get_application_status'] = Session::get('get_application_status');

        return view('course/group/attend_list_of_student',$data);
    }
    //authorised absent force complete
    public function authorised_absent_status_change(Request $request){
        $groupData = AuthorisedAbsent::where('id',$request->absent_id)->first();
        if(!$groupData){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Data Not Found! Server Error!'
            );
            return response()->json($data,200);
        }
        $msg = '';
        if($groupData->status==1){
            $groupData->status = 0;
            $groupData->save();
            $msg = 'Roll Back';
        }else{
            $groupData->status = 1;
            $groupData->save();
            $msg = 'Force To Complete';
        }
        $data['result'] = array(
            'key'=>200,
            'val'=>$msg
        );
        return response()->json($data,200);
    }
    //get group report
    public function group_report($group_id=NULL,Request $request){
        $data['attend'] = true;
        $data['page_title'] = 'Group Report';
        $get_application_status = $request->application_status;
        $get_from_date = $request->from_date;
        $get_to_date = $request->to_date;
        $get_subject_id = $request->subject_id;
        $get_title = $request->title;
        Session::put('get_from_date',$get_from_date);
        Session::put('get_to_date',$get_to_date);
        Session::put('get_subject_id',$get_subject_id);
        Session::put('get_title',$get_title);
        Session::put('get_application_status',$get_application_status);
        $data['group_info'] = CourseGroup::with(['intake_data'])->where('id',$group_id)->first();
        if(!$data['group_info']){
            Session::flash('error','Group Data Not Found!');
            return redirect()->back();
        }
        $course_id = $data['group_info']->intake_data->course_id;
        $data['subject_list'] = CourseSubject::where('course_id',$course_id)->get();
        $data['attend_list_data'] = AttendenceConfirmation::query()
        ->when($get_title, function ($query, $get_title) {
            return $query->whereHas('application', function ($subquery) use ($get_title) {
                $subquery->where('name', 'like', '%' . $get_title . '%')
                    ->orWhere('email', 'like', '%' . $get_title . '%')
                    ->orWhere('id', 'like', '%' . $get_title . '%')
                    ->orWhere('phone', 'like', '%' . $get_title . '%');
            });
        })
        ->when($get_subject_id, function ($query, $get_subject_id) {
            return $query->where('subject_id',$get_subject_id);
        })
        ->when($get_application_status, function ($query, $get_application_status) {
            return $query->where('application_status',$get_application_status);
        })
        ->when($get_from_date && $get_to_date, function (Builder $query) use ($get_from_date, $get_to_date) {
            return $query->whereBetween('created_at', [$get_from_date, $get_to_date]);
        })
        ->where('course_group_id',$data['group_info']->id)
        ->orderBy('id','desc')
        ->paginate(30)
        ->appends([
            'from_date' => $get_from_date,
            'to_date' => $get_to_date,
            'application_status' => $get_application_status,
            'subject_id' => $get_subject_id,
            'title' => $get_title,
        ]);

        $data['get_title'] = Session::get('get_title');
        $data['get_from_date'] = Session::get('get_from_date');
        $data['get_to_date'] = Session::get('get_to_date');
        $data['get_application_status'] = Session::get('get_application_status');
        $data['get_subject_id'] = Session::get('get_subject_id');
        return view('group/group_report',$data);
    }
    public function attendence_overview(){
        $data['page_title'] = 'Teacher | Calss Schedule List';
        $data['attend'] = true;
        $data['attendence_overview'] = true;
        return view('attendence.attendence_overview',$data);
    }
    public function attendence_reports(){
        $data['page_title'] = 'Attendence | Reports';
        $data['attend'] = true;
        $data['attendence_reports'] = true;
        return view('attendence.report',$data);
    }
    public function attendence_report_filter(Request $request){
        $data['page_title'] = 'Attendence | Reports';
        $data['attend'] = true;
        $data['attendence_reports'] = true;
        $data['get_from_date'] = $request->from_date;
        $data['get_to_date'] = $request->to_date;
        return view('attendence.report',$data);
    }
}
