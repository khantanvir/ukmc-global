<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course\CourseCategories;
use App\Models\Course\CourseLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Traits\Service;
Use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;

class CourseCategoryController extends Controller{
    use Service;

    public function course_categories($id=NULL){
        if(!Auth::check()){
            Session::flash('error','Login First! Create Campus!');
            return redirect('login');
        }
        //check as super admin
        if(Auth::user()->role != 'admin'){
            Session::flash('error','Login as Super Admin Then Create Campus!');
            return redirect('login');
        }
        $data['return_category_id'] = Session::get('category_id');
        $data['page_title'] = 'Course | Categories';
        $data['course'] = true;
        $data['course_categories'] = true;
        $data['categories'] = CourseCategories::orderBy('id','desc')->paginate(15);
        if($id){
            $data['category'] = CourseCategories::where('id',$id)->first();
        }
        Session::forget('category_id');
        return view('course/categories',$data);
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required',
        ]);
        $categoryId = $request->category_id;
        if($categoryId){
            $category = CourseCategories::where('id',$categoryId)->first();
        }else{
            $category = new CourseCategories();
        }
        $category->title = $request->title;
        $category->save();
        Session::put('category_id',$category->id);
        Session::flash('success',(!empty($categoryId))?'Category Upadted!':'Category Saved!');
        return redirect('course-categories');
    }
    public function category_status_change(Request $request){
        $category = CourseCategories::where('id',$request->category_id)->first();
        if(!$category){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Category Data Not Found! Server Error!'
            );
            return response()->json($data,200);
        }
        $msg = '';
        if($category->status==1){
            $update = CourseCategories::where('id',$category->id)->update(['status'=>$request->status]);
            $msg = 'Category Activated';
        }else{
            $update = CourseCategories::where('id',$category->id)->update(['status'=>$request->status]);
            $msg = 'Category Deactivated';
        }
        $data['result'] = array(
            'key'=>200,
            'val'=>$msg
        );
        return response()->json($data,200);
    }
    public function course_levels($id=NULL){
        if(!Auth::check()){
            Session::flash('error','Login First! Create Course Level!');
            return redirect('login');
        }
        //check as super admin
        if(Auth::user()->role != 'admin'){
            Session::flash('error','Login as Super Admin Then Create Course Level!');
            return redirect('login');
        }
        $data['return_level_id'] = Session::get('level_id');
        $data['page_title'] = 'Course | Level';
        $data['course'] = true;
        $data['course_levels'] = true;
        $data['levels'] = CourseLevel::orderBy('id','desc')->paginate(15);
        if($id){
            $data['level'] = CourseLevel::where('id',$id)->first();
        }
        Session::forget('level_id');
        return view('course/levels',$data);
    }
    public function level_store(Request $request){
        $request->validate([
            'title' => 'required',
        ]);
        $levelId = $request->level_id;
        if($levelId){
            $levelData = CourseLevel::where('id',$levelId)->first();
        }else{
            $levelData = new CourseLevel();
        }
        $levelData->title = $request->title;
        $levelData->save();
        Session::put('level_id',$levelData->id);
        Session::flash('success',(!empty($levelId))?'Course Level Upadted!':'Course Level Saved!');
        return redirect('course-levels');
    }
    public function level_status_change(Request $request){
        $level = CourseLevel::where('id',$request->level_id)->first();
        if(!$level){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Course Level Data Not Found! Server Error!'
            );
            return response()->json($data,200);
        }
        $msg = '';
        if($level->status==1){
            $update = CourseLevel::where('id',$level->id)->update(['status'=>$request->status]);
            $msg = 'Course Level Activated';
        }else{
            $update = CourseLevel::where('id',$level->id)->update(['status'=>$request->status]);
            $msg = 'Course Level Deactivated';
        }
        $data['result'] = array(
            'key'=>200,
            'val'=>$msg
        );
        return response()->json($data,200);
    }
}
