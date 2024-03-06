@extends('layouts.app')

@section('styles')
<style>
    .required:after {
      content:" *";
      color: rgba(255, 0, 0, 0.549);
    }
  </style>
@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
        <!-- left column -->
        <form id="updateRegistrationForm">
            @csrf
            @method('PATCH')

            <input type="hidden" name="user_id" id="idInputBox" value="{{$data->user_id}}">

            <div class="row justify-content-center">
                <div class="col-md-5 mt-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">School Information</h3>
                        </div>

                        <div class="card-body">

                            <div class="form-group">
                                <label for="" class="form-label required">Name</label>
                                <input type="text" name="user_name" id="userNameInputBox" class="form-control" placeholder="Enter User Name" value="{{$data->user_name}}">
                                <p class="text-danger" id="userNameErrorMessage"></p>
                            </div>

                            <div class="form-group">
                                <label for="" class="required">Select User Type</label>
                                <select name="user_type" id="typeSelect" class="form-control">
                                    <option value="">Select User Type</option>
                                    <option value="student"  @if($data->user_type == 'student') selected @endif>Student</option>
                                    <option value="teacher" @if($data->user_type == 'teacher') selected @endif>Teacher</option>
                                </select>
                                <p class="text-danger" id="userTypeErrorMessage"></p>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label required">Select Grade</label>
                                <select name="grade_select" id="gradeSelect" class="form-control">
                                    <option value="" >Select Grade</option>

                                    @if(count($data->userGradeClasses) == 0)
                                        @foreach ($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->grade_name}}</option>
                                        @endforeach
                                    @else

                                        @foreach ($grades as $grade)
                                            @php
                                                $selected = '';
                                                if (!empty($data->userGradeClasses) && count($data->userGradeClasses) > 0) {
                                                    $selected = ($data->userGradeClasses[0]->grade_id == $grade->id) ? 'selected' : '';
                                                }
                                            @endphp
                                            <option value="{{$grade->id}}" {{$selected}}>{{$grade->grade_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <p class="text-danger mt-1" id="selectBoxError1"></p>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label required">Select Class</label>
                                <select name="class_select" id="classSelect" class="form-control">
                                    <option value="">Select Class</option>
                                </select>
                                <p class="text-danger mt-1" id="selectBoxError2"></p>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Admission Date</label>
                                <input type="date" name="admission_date" id="" value="{{$data->admission_date}}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 mt-5">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Other Informations</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="" class="form-label">Date Of Birth</label>
                                <input type="date" name="date_of_birth" value="{{$data->date_of_birth}}" id="" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="">Gender</label>
                                <select name="gender" id="genderSelect" class="form-control">
                                    <option value="">Select User Gender</option>
                                    <option value="male" @if($data->gender == 'male') selected @endif>Male</option>
                                    <option value="femal" @if($data->gender == 'female') selected @endif>Female</option>
                                </select>
                                <p class="text-danger" id="gradeIdErrorMessage"></p>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" value="{{$data->phone_number}}" id="phoneNumberInpuBox" class="form-control" placeholder="Enter Phone Number">
                                <p class="text-danger" id=""></p>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Address</label>
                                <textarea name="address" class="form-control" id="addressInputBox" placeholder="Enter Adress">{{$data->address}}</textarea>
                                {{-- <input type="text" name="user_name" id="nameInputBox" class="form-control" placeholder="Enter User Name"> --}}
                                <p class="text-danger" id=""></p>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">NRC</label>
                                {{-- <textarea name="address" id="" cols="30" rows="10" placeholder="Enter Adress"></textarea> --}}
                                <input type="text" name="nrc" value="{{$data->nrc}}" id="nrcInputBox" class="form-control" placeholder="Enter User NRC">
                                <p class="text-danger" id=""></p>
                            </div>

                            <div class="form-group student-fields">
                                <label for="fatherNameInputBox" class="form-label">Father Name</label>
                                <input type="text" name="father_name" value="{{$data->father_name}}" id="fatherNameInputBox" class="form-control" placeholder="Enter Father Name">
                                <p class="text-danger" id="fatherNameError"></p>
                            </div>
                            <div class="form-group student-fields">
                                <label for="motherNameInputBox" class="form-label">Mother Name</label>
                                <input type="text" name="mother_name" value="{{$data->mother_name}}" id="motherNameInputBox" class="form-control" placeholder="Enter Mother Name">
                                <p class="text-danger" id="motherNameError"></p>
                            </div>
                            <div class="form-group student-fields">
                                <label for="transferedSchoolInputBox" class="form-label">Transferred School</label>
                                <input type="text" name="former_school" value="{{$data->former_school}}" id="transferedSchoolInputBox" class="form-control" placeholder="Enter Former School">
                                <p class="text-danger" id="transferedSchoolError"></p>
                            </div>


                            <div class="">
                                <button type="submit" class="btn btn-info mr-2">Update</button>
                                <button type="button" id="cancelBtn" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection

@section('scripts')

<script>

    $(document).ready(function() {

        var initialGradeId = $('#gradeSelect').val();
        var initialClassId = "{{ $data->userGradeClasses->isEmpty() ? '' : $data->userGradeClasses[0]->class_id }}";
        updateClassOptions(initialGradeId, initialClassId);

        $('#gradeSelect').change(function() {
            var gradeId = $(this).val();
            updateClassOptions(gradeId, '');
        });

        function updateClassOptions(gradeId, selectedClassId) {
            $('#classSelect').empty();

            if (gradeId === '') {
                $('#classSelect').append($('<option>', {
                    value: '',
                    text: 'Select Class',
                }));
                return;
            }

            @foreach ($grades as $grade)
            if ('{{$grade->id}}' === gradeId) {
                @foreach ($grade->classes as $class)
                    // console.log({{$class->id}});

                var selected = selectedClassId == '{{$class->id}}';
                console.log(selectedClassId);
                $('#classSelect').append($('<option>', {
                    value: '{{$class->id}}',
                    text: '{{$class->class_name}}',
                    selected: selected
                }));
                @endforeach
            }
            @endforeach

            if ($('#classSelect option').length === 0) {
                $('#classSelect').append($('<option>', {
                    value: '',
                    text: 'No Classes in this grade'
                }));
            }
        }
    });

    $('#typeSelect').change(function() {
        var userType = $(this).val();
        if (userType === 'student') {
            $('.student-fields').show();
        } else {
            $('.student-fields').hide();
        }
    });

    $(document).ready(function() {
        var userTypeFromServer = "{{ $data->user_type }}";
        if (userTypeFromServer !== 'teacher') {
            $('.student-fields').show();
        } else {
            $('.student-fields').hide();
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#typeSelect').change(function() {
            var userType = $(this).val();
            if (userType === 'teacher') {
                $('#fatherNameInputBox').closest('.form-group').hide();
                $('#motherNameInputBox').closest('.form-group').hide();
                $('#transferedSchoolInputBox').closest('.form-group').hide();
            } else {
                $('#fatherNameInputBox').closest('.form-group').show();
                $('#motherNameInputBox').closest('.form-group').show();
                $('#transferedSchoolInputBox').closest('.form-group').show();
            }
        });



        function clearError() {
            $('#gradeSelect').removeClass('is-invalid');
            $('#selectBoxError1').text('');

            $('#classSelect').removeClass('is-invalid');
            $('#selectBoxError2').text('');
        }

        $('#gradeSelect').change(function() {
            clearError();
        });

        $('#cancelBtn').click(function() {
            window.location.href = '{{ route('users.index') }}';
        });

        $('#updateRegistrationForm').submit(function (e) {
            // alert('hello');
            e.preventDefault();

            var userId = $('#idInputBox').val();

            // console.log(classId);

            $.ajax({
                type: 'POST',
                url: '{{ route('users.update', ['user' => ':user']) }}'.replace(':user', userId),
                data: $(this).serialize(),
                success: function (response) {
                    if(response == 'success'){
                        window.location.href = '{{ route('users.index') }}';
                    }
                    },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var response = JSON.parse(xhr.responseText);
                        console.log(response);
                    let userNameErrorMessage = response.errors.user_name ? response.errors.user_name[0] : '';
                    let userTypeErrorMessage = response.errors.user_type ? response.errors.user_type[0] : '';
                    let gradeSelectErrorMessage = response.errors.grade_select ? response.errors.grade_select[0] : '';
                    let classSelectErrorMessage = response.errors.class_select ? response.errors.class_select[0] : '';

                    if (userNameErrorMessage) {
                        $('#userNameErrorMessage').html(userNameErrorMessage);
                        $('#userNameInputBox').addClass('is-invalid');
                    } else {
                        $('#userNameErrorMessage').html('');
                        $('#userNameInputBox').removeClass('is-invalid');
                    }


                    if (userTypeErrorMessage) {
                        $('#userTypeErrorMessage').html(userTypeErrorMessage);
                        $('#typeSelect').addClass('is-invalid');
                    } else {
                        $('#userTypeErrorMessage').html('');
                        $('#typeSelect').removeClass('is-invalid');
                    }

                    if(gradeSelectErrorMessage){
                        $('#selectBoxError1').html(gradeSelectErrorMessage);
                        $('#gradeSelect').addClass('is-invalid');
                    }else{
                        $('#selectBoxError1').html('');
                        $('#gradeSelect').removeClass('is-invalid');
                    }

                    if(classSelectErrorMessage){
                        $('#selectBoxError2').html(classSelectErrorMessage);
                        $('#classSelect').addClass('is-invalid');
                    }else{
                        $('#selectBoxError2').html('');
                        $('#classSelect').removeClass('is-invalid');
                    }

                },
                failure: function (response) {
                    console.log('faliure');
                }
            });
        });

        $('#classSelect').click(function() {
            var selectedGrade = $('#gradeSelect').val();
            if (selectedGrade === '') {
                $('#selectBoxError2').text('First select a grade');
            } else {
                $('#selectBoxError2').text('');
            }
        });

    });
</script>

@endsection