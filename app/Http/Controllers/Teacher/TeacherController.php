<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Campus\Campus;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Teacher\TeacherCreateRequest;
use App\Http\Requests\Teacher\EditTeacherRequest;
use App\Models\Location\Location;
use App\Models\Teacher\Teacher;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;


class TeacherController extends Controller{
    use Service;
    public function teachers(Request $request){
        $data['page_title'] = 'Teacher | All';
        $data['attend'] = true;
        $data['teacher_list'] = true;
        $location = $request->get('location');
        $name = $request->get('name');
        Session::put('get_location',$location);
        Session::put('get_name',$name);
        $data['teachers'] = User::query()
        ->when($name, function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
        ->when($location, function (Builder $query) use ($location) {
            $query->whereHas('teacher.location', function (Builder $query) use ($location) {
                $query->where('campus_id', $location);
            });
        })
        ->with('teacher')
        ->where('role','teacher')
        ->orderBy('id','desc')
        ->paginate(15)
        ->appends([
            'name' => $name,
            'location' => $location,
        ]);
        $data['get_location'] = Session::get('get_location');
        $data['get_name'] = Session::get('get_name');
        $data['location_list'] = Location::where('status',0)->orderBy('id','desc')->get();
        return view('teacher.teacher',$data);
    }
    //create teacher function
    public function create_teacher(){
        if(!Auth::check()){
            Session::flash('error','Login First! Create Teacher!');
            return redirect('login');
        }
        $data['page_title'] = 'User | Create Teacher';
        $data['attend'] = true;
        $data['teacher_list'] = true;
        //$data['get_campuses'] = Campus::where('active',1)->get();
        $data['countries'] = Service::countries();
        $data['locations'] = Location::where('status',0)->get();
        return view('users/create_teacher',$data);
    }
    //create teacher
    public function create_teacher_post_data(TeacherCreateRequest $request){
        //first create user
        $first_name = "";
        $last_name = "";
        $user = new User();
        $user->name = $request->name;
        if($user->name){
            $array = explode(" ",$user->name);
            foreach($array as $key=>$row){
                if($key==0){
                    $first_name = $row;
                }
                if(!empty($row) && $key != 0){
                    $last_name .= $row.' ';
                }
            }
        }
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->role = 'teacher';
        $user->email = $request->email;
        $user->phone = $request->teacher_phone;
        //$user->slug = Str::slug($request->name,'-');
        //slug create
        $url_modify = Service::slug_create($request->name);
        $checkSlug = User::where('slug', 'LIKE', '%' . $url_modify . '%')->count();
        if ($checkSlug > 0) {
            $new_number = $checkSlug + 1;
            $new_slug = $url_modify . '-' . $new_number;
            $user->slug = $new_slug;
        } else {
            $user->slug = $url_modify;
        }
        //photo upload
        $photo = $request->photo;
        if ($request->hasFile('photo')) {
            $ext = $photo->getClientOriginalExtension();
            $filename = $photo->getClientOriginalName();
            $filename = Service::slug_create($filename).rand(1100, 99999).'.'.$ext;
            $image_resize = Image::make($photo->getRealPath());
            $image_resize->resize(200, 200);
            $upload_path = 'backend/images/users/teacher/';
            Service::createDirectory($upload_path);
            $image_resize->save(public_path('backend/images/users/teacher/'.$filename));
            $user->photo = 'backend/images/users/teacher/'.$filename;
        }
        $user->password = Hash::make($request->password);
        $user->save();
        //create admission officer now
        $teacher = new Teacher();
        $teacher->campus_id = $request->campus_id;
        $teacher->user_id = $user->id;
        $teacher->teacher_name = $request->teacher_name;
        $teacher->teacher_phone = $request->teacher_phone;
        $teacher->teacher_email = $request->teacher_email;
        $teacher->teacher_alternative_contact = $request->teacher_alternative_contact;
        $teacher->teacher_nid_or_passport = $request->teacher_nid_or_passport;
        $teacher->nationality = $request->nationality;
        $teacher->country = $request->country;
        $teacher->state = $request->state;
        $teacher->city = $request->city;
        $teacher->address = $request->address;
        $teacher->save();
        Session::put('saved_user_id',$user->id);
        Session::flash('success','Successfully Saved Teacher Information!');
        if(!empty(Session::get('current_url'))){
            return redirect(Session::get('current_url'));
        }else{
            return redirect('teachers');
        }
    }
    //edit teacher
    public function edit_teacher($slug=NULL){
        if(!Auth::check() && Auth::user()->role != 'admin'){
            Session::flash('error','Login First! Then Update Teacher Information!');
            return redirect('login');
        }
        $data['teacher_data'] = User::with(['teacher'])->where('slug',$slug)->first();
        //dd($data['teacher_data']);
        if(!$data['teacher_data']){
            Session::flash('error','Teacher Data Not Found! Server Error!');
            if(Session::get('current_url')){
                return redirect(Session::get('current_url'));
            }else{
                return redirect()->back();
            }
        }
        $data['page_title'] = 'User | Edit Teacher';
        $data['attend'] = true;
        $data['teacher_list'] = true;
        $data['countries'] = Service::countries();
        $data['locations'] = Location::where('status',0)->get();
        return view('users/edit_teacher',$data);
    }
    //teacher edit data post
    public function edit_teacher_data_post(EditTeacherRequest $request){
        //first create user
        $first_name = "";
        $last_name = "";
        $user = User::where('id',$request->user_id)->first();
        $user->name = $request->name;
        if($user->name){
            $array = explode(" ",$user->name);
            foreach($array as $key=>$row){
                if($key==0){
                    $first_name = $row;
                }
                if(!empty($row) && $key != 0){
                    $last_name .= $row.' ';
                }
            }
        }
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->phone = $request->teacher_phone;
        //photo upload
        $photo = $request->photo;
        if ($request->hasFile('photo')) {
            if (File::exists(public_path($user->photo))) {
                File::delete(public_path($user->photo));
            }
            $ext = $photo->getClientOriginalExtension();
            $filename = $photo->getClientOriginalName();
            $filename = Service::slug_create($filename).rand(1100, 99999).'.'.$ext;
            $image_resize = Image::make($photo->getRealPath());
            $image_resize->resize(200, 200);
            $upload_path = 'backend/images/users/teacher/';
            Service::createDirectory($upload_path);
            $image_resize->save(public_path('backend/images/users/teacher/'.$filename));
            $user->photo = 'backend/images/users/teacher/'.$filename;
        }
        $user->save();
        //create admission officer now
        $teacher = Teacher::where('user_id',$user->id)->first();
        $teacher->campus_id = $request->campus_id;
        $teacher->user_id = $user->id;
        $teacher->teacher_name = $request->teacher_name;
        $teacher->teacher_phone = $request->teacher_phone;
        $teacher->teacher_email = $request->teacher_email;
        $teacher->teacher_alternative_contact = $request->teacher_alternative_contact;
        $teacher->teacher_nid_or_passport = $request->teacher_nid_or_passport;
        $teacher->nationality = $request->nationality;
        $teacher->country = $request->country;
        $teacher->state = $request->state;
        $teacher->city = $request->city;
        $teacher->address = $request->address;
        $teacher->save();
        Session::put('saved_user_id',$user->id);
        Session::flash('success','Successfully Updated Teacher Information!');
        if(!empty(Session::get('current_url'))){
            return redirect(Session::get('current_url'));
        }else{
            return redirect('teachers');
        }
    }
    public function get_class_schedule_by_teacher($id=NULL){
        $data['page_title'] = 'Teacher | Calss Schedule List';
        $data['attend'] = true;
        $data['teacher_list'] = true;
        return view('teacher.teacher_class_schedule_list',$data);
    }
    public function add_location($id=NULL){
        $data['page_title'] = 'Location | Add';
        $data['attend'] = true;
        $data['all_location'] = true;
        $data['location_data'] = Location::where('id',$id)->first();
        return view('location.add',$data);
    }
    public function all_location(){
        $data['page_title'] = 'Location | All';
        $data['attend'] = true;
        $data['all_location'] = true;
        $data['location_list'] = Location::orderBy('id','desc')->paginate(15);
        return view('location.all',$data);
    }
    public function add_location_data_post(Request $request){
        $request->validate([
            'title'=>'required',
        ]);
        if(!empty($request->location_id)){
            $location = Location::where('id',$request->location_id)->first();
        }else{
            $location = new Location();
        }
        $location->title = $request->title;
        $location->description = $request->description;
        $location->save();
        Session::flash('success','Location Updated');
        return redirect('all-location');
    }
    public function change_location_status(Request $request){
        $locationData = Location::where('id',$request->location_id)->first();
        if(!$locationData){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Location Data Not Found! Server Error!'
            );
            return response()->json($data,200);
        }
        if($locationData->status==1){
            $update = Location::where('id',$locationData->id)->update(['status'=>0]);
        }else{
            $update = Location::where('id',$locationData->id)->update(['status'=>1]);
        }
        $data['result'] = array(
            'key'=>200,
            'val'=>'Status Changed Successfully!'
        );
        return response()->json($data,200);
    }

}
