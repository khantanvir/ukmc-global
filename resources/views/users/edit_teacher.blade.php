@extends('adminpanel')
@section('admin')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="secondary-nav">
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
                                        <li class="breadcrumb-item"><a href="#">Teacher</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Teacher</li>
                                    </ol>
                                </nav>

                            </div>
                        </div>
                    </header>
                </div>
            </div>
            <form method="post" action="{{ URL::to('edit-teacher-data-post') }}" enctype="multipart/form-data">
                @csrf
                <div id="card_1" class="col-lg-12 layout-spacing layout-top-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="row mb-4">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <div class="d-flex align-items-start justify-content-between">
                                        <h4>Teacher Information</h4><a href="{{ URL::to('user-list') }}" class="btn btn-info btn-rounded mb-2 mr-4 inline-flex items-center"> User
                                                List <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3">
                                                    </circle>
                                                </svg></a>
                                    </div><br>
                                </div>
                                <div class="col">
                                    <input type="hidden" value="{{ $teacher_data->id }}" name="user_id" />
                                    <div class="form-group mb-4"><label for="exampleFormControlInput1">Teacher for
                                            Campus</label><select name="campus_id" class="form-control">
                                            <option value="">Select a Campus</option>
                                            @forelse ($locations as $campus)
                                            <option {{ (!empty($teacher_data->teacher->campus_id) && $teacher_data->teacher->campus_id==$campus->id)?'selected':'' }} value="{{ $campus->id }}">{{ $campus->title }}</option>
                                            @empty
                                            <option value="">No Data</option>
                                            @endforelse
                                        </select>
                                        @if ($errors->has('campus_id'))
                                            <span class="text-danger">{{ $errors->first('campus_id') }}</span>
                                        @endif
                                        <!---->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-4"><label for="exampleFormControlInput1">Teacher
                                            Name</label>
                                            <input name="teacher_name" value="{{ (!empty($teacher_data->teacher->teacher_name))?$teacher_data->teacher->teacher_name:old('teacher_name') }}" type="text" class="form-control">
                                            @if ($errors->has('teacher_name'))
                                                <span class="text-danger">{{ $errors->first('teacher_name') }}</span>
                                            @endif
                                        <!---->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-4"><label for="exampleFormControlInput1">Teacher
                                            Phone</label>
                                            <input name="teacher_phone" value="{{ (!empty($teacher_data->teacher->teacher_phone))?$teacher_data->teacher->teacher_phone:old('teacher_phone') }}" type="text" class="form-control">
                                            @if ($errors->has('teacher_phone'))
                                                <span class="text-danger">{{ $errors->first('teacher_phone') }}</span>
                                            @endif
                                        <!---->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-4"><label for="exampleFormControlInput1">Teacher
                                            Email</label>
                                            <input name="teacher_email" value="{{ (!empty($teacher_data->teacher->teacher_email))?$teacher_data->teacher->teacher_email:old('teacher_email') }}" type="email" class="form-control">
                                            @if ($errors->has('teacher_email'))
                                                <span class="text-danger">{{ $errors->first('teacher_email') }}</span>
                                            @endif
                                        <!---->
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-group mb-4"><label for="exampleFormControlInput1">Alternative Person
                                            Contact</label>
                                            <input name="teacher_alternative_contact" value="{{ (!empty($teacher_data->teacher->teacher_alternative_contact))?$teacher_data->teacher->teacher_alternative_contact:old('teacher_alternative_contact') }}" type="text" class="form-control">
                                            @if ($errors->has('teacher_alternative_contact'))
                                                <span class="text-danger">{{ $errors->first('teacher_alternative_contact') }}</span>
                                            @endif
                                        <!---->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-4"><label for="exampleFormControlInput1">National ID or
                                            Passport</label>
                                            <input name="teacher_nid_or_passport" value="{{ (!empty($teacher_data->teacher->teacher_nid_or_passport))?$teacher_data->teacher->teacher_nid_or_passport:old('teacher_nid_or_passport') }}" type="text" class="form-control">
                                            @if ($errors->has('teacher_nid_or_passport'))
                                                <span class="text-danger">{{ $errors->first('teacher_nid_or_passport') }}</span>
                                            @endif
                                        <!---->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-4"><label
                                            for="exampleFormControlInput1">Nationality</label>
                                            <input name="nationality" value="{{ (!empty($teacher_data->teacher->nationality))?$teacher_data->teacher->nationality:old('nationality') }}" type="text" class="form-control">
                                            @if ($errors->has('nationality'))
                                                <span class="text-danger">{{ $errors->first('nationality') }}</span>
                                            @endif
                                        <!---->
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-group mb-4"><label
                                            for="exampleFormControlInput1">Country</label>
                                            <select name="country" class="form-control">
                                            <option value="">Select Country</option>
                                            @forelse ($countries as $country)
                                            <option {{ (!empty($teacher_data->teacher->country) && $teacher_data->teacher->country==$country)?'selected':'' }} value="{{ $country }}">{{ $country }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                        @if ($errors->has('country'))
                                            <span class="text-danger">{{ $errors->first('country') }}</span>
                                        @endif
                                        <!---->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-4"><label for="exampleFormControlInput1">State</label>
                                        <input name="state" value="{{ (!empty($teacher_data->teacher->state))?$teacher_data->teacher->state:old('state') }}" type="text" class="form-control">
                                        @if ($errors->has('state'))
                                            <span class="text-danger">{{ $errors->first('state') }}</span>
                                        @endif
                                        <!---->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-4"><label for="exampleFormControlInput1">City</label>
                                        <input name="city" value="{{ (!empty($teacher_data->teacher->city))?$teacher_data->teacher->city:old('city') }}" type="text" class="form-control">
                                        @if ($errors->has('city'))
                                            <span class="text-danger">{{ $errors->first('city') }}</span>
                                        @endif
                                        <!---->
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-4">
                                <div class="col col-md-8">
                                    <div class="form-group mb-4"><label for="exampleFormControlTextarea1">Address in
                                            Details</label>
                                        <textarea name="address" id="exampleFormControlTextarea1" class="form-control" rows="1" spellcheck="false">{{ (!empty($teacher_data->teacher->address))?$teacher_data->teacher->address:old('address') }}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                        <!---->
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <div class="row d-flex align-items-center">
                                        <div class="col col-md-8">
                                            <div class="form-group mb-4"><label>Upload Officer Photo</label><label
                                                    class="custom-file-container__custom-file">
                                                    <input type="file" name="photo" class="form-control-file" accept="image/*">
                                                    </label>
                                                <div class="custom-file-container__image-preview">
                                                    <img src="{{ asset($teacher_data->photo) }}" height="100px" width="100px" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-4">
                                            <!---->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="card_1" class="col-lg-12 layout-spacing layout-top-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="row mb-4">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Teacher Login Information</h4><br>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-4"><label for="personName">Person Name</label>
                                        <input name="name" value="{{ (!empty($teacher_data->name))?$teacher_data->name:old('name') }}" id="personName" type="text" class="form-control">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                        <!---->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-4"><label for="email">Email</label>
                                        <input disabled value="{{ (!empty($teacher_data->email))?$teacher_data->email:old('email') }}" type="email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <div class="row">
                                        <div class="col"><button type="button"
                                                class="btn btn-warning mr-2 me-2">Cancel</button><button type="submit"
                                                class="btn btn-primary mr-2"><span>Submit</span></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
