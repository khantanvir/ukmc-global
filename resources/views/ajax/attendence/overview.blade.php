<div class="modal fade inputForm-modal" id="timeTableModal" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header" id="inputFormModalLabel">
            <h5 class="modal-title"><b>Create Timetable</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <form method="post" action="#" class="mt-0">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Course</label>
                                <select id="intake" name="intake" class="form-control">
                                    <option value="">Select Course</option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Intake</label>
                                <input type="hidden" name="interviewer_user_id" value="" id="interviewer_user_id" />
                                <select id="course_id" name="course_id" class="form-control">
                                    <option value="">Select Intake</option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Group</label>
                                <select id="intake" name="intake" class="form-control">
                                    <option value="">Select Group</option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Subject</label>
                                <input type="hidden" name="interviewer_user_id" value="" id="interviewer_user_id" />
                                <select id="course_id" name="course_id" class="form-control">
                                    <option value="">Select Subject</option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Module No</label>
                                <select id="intake" name="intake" class="form-control">
                                    <option value="">Select Module</option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Location</label>
                                <input type="hidden" name="interviewer_user_id" value="" id="interviewer_user_id" />
                                <select id="course_id" name="course_id" class="form-control">
                                    <option value="">Select Location</option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Stuff</label>
                                <select id="intake" name="intake" class="form-control">
                                    <option value="">Select Stuff</option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Date</label>
                                <input class="form-control" type="datetime-local" name="interviewer_user_id" value="" id="interviewer_user_id" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">Start Time</label>
                                <input class="form-control" type="time" name="interviewer_user_id" value="" id="interviewer_user_id" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4"><label for="exampleFormControlInput1">End Time</label>
                                <input class="form-control" type="time" name="interviewer_user_id" value="" id="interviewer_user_id" />
                            </div>
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
<div class="modal fade inputForm-modal" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header" id="inputFormModalLabel">
            <h5 class="modal-title"><b>Create Group</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <form method="post" action="#" class="mt-0">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <div class="col">
                        <div class="form-group mb-4"><label for="exampleFormControlInput1">Course</label>
                            <input type="hidden" name="interviewer_user_id" value="" id="interviewer_user_id" />
                            <select id="course_id" name="course_id" class="form-control">
                                <option value="">Select Course</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group mb-4"><label for="exampleFormControlInput1">Intake</label>
                            <select id="intake" name="intake" class="form-control">
                                <option value="">Select Intake</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group mb-4"><label for="exampleFormControlInput1">Group Name</label>
                            <input type="text" name="group_name" class="form-control" />
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

