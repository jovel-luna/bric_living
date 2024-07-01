@extends('layouts.app', ['pageSlug' => 'setting'])

@section('content')
    <div class="content-header">
        <section class="content">
            <div class="container-fluid">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Settings</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Settings</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        @if (Auth::check())
                                            @if (checkRole() == 'Admin')
                                                <div class="text-center mb-1">
                                                    <form action="{{ route('update.system-logo') }}" method="post"
                                                        id="system-form" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="system-logo">
                                                            <div id="logo-edit" class="image-content mx-auto"
                                                                style=" width: 100px; height: 100px; position: relative; ">
                                                                @if (Auth::user()->profile_image != null)
                                                                    <img id="logo-img"
                                                                        class="logo-img img-fluid img-circle"
                                                                        src="{{ url(getSettings('portal-logo')) }}"
                                                                        alt="System Logo">
                                                                @else
                                                                    <img id="logo-img"
                                                                        class="logo-img img-fluid img-circle"
                                                                        src="{{ URL::to('/') }}/img/default-img.png"
                                                                        alt="System Logo">
                                                                @endif
                                                                <span class="logo-edit-text">Update</span>
                                                            </div>
                                                            <input id="logo" type="file" name="system_logo"
                                                                class="update-logo" style="display: none;">
                                                        </div>
                                                    </form>
                                                </div>
                                                <h3 class="system-name text-center">{{ getSettings('portal-title') }}<a
                                                        href="#" type="button" id="edit-system-name"><i
                                                            class="edit icon fa-regular fa-pen-to-square fa-xs ml-1"
                                                            style="color: #c3c3c3;"></i><i
                                                            class="fa-solid fa-pen-line"></i></a></h3>
                                            @else
                                                <div class="text-center mb-1">
                                                    <form
                                                        action="{{ route('update.user-profile-image', Auth::user()->id) }}"
                                                        method="post" id="profile-form" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="profile-image">
                                                            <div id="profile-edit" class="image-content mx-auto"
                                                                style=" width: 100px; height: 100px; position: relative; ">
                                                                @if (Auth::user()->profile_image != null)
                                                                    <img id="profile-user-img"
                                                                        class="profile-user-img img-fluid img-circle"
                                                                        src="{{ url(Auth::user()->profile_image) }}"
                                                                        alt="User profile picture">
                                                                @else
                                                                    <img id="profile-user-img"
                                                                        class="profile-user-img img-fluid img-circle"
                                                                        src="{{ URL::to('/') }}/img/default-img.png"
                                                                        alt="User profile picture">
                                                                @endif
                                                                <span class="profile-edit-text">Update</span>
                                                            </div>
                                                            <input id="profile" type="file" name="profile_image"
                                                                class="add-image" style="display: none;">
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#settings"
                                                    data-toggle="tab">Settings</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#account"
                                                    data-toggle="tab">Logged-in User</a></li>
                                            @if (Auth::user()->role_id == 1)
                                                <li class="nav-item"><a class="nav-link" href="#users"
                                                        data-toggle="tab">Registered Users</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#activity"
                                                        data-toggle="tab">Activity Logs</a></li>
                                            @endif
                                            <!-- <li class="nav-item"><a class="nav-link" href="#registration" data-toggle="tab">Registration</a></li> -->
                                        </ul>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="settings">
                                                @include('layouts.defaults.comming-soon')
                                            </div>
                                            <div class="tab-pane" id="account">
                                                @include('setting.user-details')
                                            </div>
                                            @if (Auth::user()->role_id == 1)
                                                <div class="tab-pane" id="users">
                                                    @include('setting.user-accounts')
                                                </div>
                                                <div class="tab-pane" id="activity">
                                                    @include('setting.activity')
                                                </div>
                                            @endif
                                            <!-- <div class="tab-pane" id="registration">
                                                <div class="card card-secondary shadow mb-4 p-0">
                                                    <div class="card-header py-2">
                                                        <h6 class="m-0 font-weight-bold">{{ __('Comming Soon') }}</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            Registration Comming Soon
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '#togglePassword', function(e) {
                    const type = $(this).closest('.password-container').find('input').attr('type') ===
                        'password' ? 'text' : 'password';
                    $(this).closest('.password-container').find('input').attr('type', type);
                    this.classList.toggle('fa-eye-slash');
                    this.classList.toggle('fa-eye');
                });

                // User Accounts Table
                $('#user-account-table').DataTable({
                    language: {
                        processing: 'Loading. Please wait...',
                        search: "_INPUT_",
                        searchPlaceholder: "Search",
                        lengthMenu: "_MENU_"
                    },
                    processing: false,
                    serverSide: true,
                    bPaginate: false,
                    order: [],
                    ajax: {
                        url: "{{ route('setting.index') }}",
                        type: "GET",
                        beforeSend: function() {
                            $('.loading-container').show();
                        }
                    },
                    columns: [{
                            data: 'name',
                            name: 'name',
                            orderable: true,
                            render: function(data, type, row) {
                                return row.first_name + ' ' + (row.middle_name != null ? row
                                    .middle_name : '') + ' ' + row.last_name;
                            }
                        },
                        {
                            data: 'username',
                            name: 'username',
                            orderable: true
                        },
                        {
                            data: 'email',
                            name: 'email',
                            orderable: true
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: true,
                            render: function(data, type, row) {
                                return row.status == 1 ? '<span style="color: #008000;">Active</span>' :
                                    '<span style="color: #ff0000;">Not Active</span>';
                            }
                        },
                        {
                            data: 'role',
                            name: 'role',
                            orderable: true
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return '<div class="action-btn account-action has-divider d-flex justify-content-center">' +
                                    '<a href="#" data-id="' + row.id +
                                    '" id="edit-text-btn" class="edit" title="Edit"><i class="edit icon fa-regular fa-pen-to-square" style="color: #000000;"></i></a>' +
                                    '<a href="#" data-id="' + row.id +
                                    '" id="access-text-btn" class="access" title="Reset Password"><i class="view icon fa-solid fa-user-lock"></i></a>' +
                                    '<a href="#" data-id="' + row.id +
                                    '" id="access-text-btn" class="access" title="Access"><i class="info icon fa-solid fa-key"></i></a>' +
                                    '<a href="/delete-user/' + row.id + '" data-id="' + row.id +
                                    '" id="remove-btn" class="delete" title="Delete"><i class="delete icon fa-solid fa-trash"></i></a>' +
                                    '</div>';
                            }
                        },
                    ]
                });
                setTimeout(function() {
                    $('.loading-container').hide();
                }, 1000);
                $('table#user-account-table thead tr th').on('click', function() {
                    setTimeout(function() {
                        $('.loading-container').hide();
                    }, 1500);
                });
                //  Activity Log
                $('#activity-table').DataTable({
                    language: {
                        processing: 'Loading. Please wait...',
                        search: "_INPUT_",
                        searchPlaceholder: "Search",
                        lengthMenu: "_MENU_"
                    },
                    processing: false,
                    serverSide: true,
                    bPaginate: false,
                    order: [],
                    ajax: {
                        url: "{{ route('get.activity') }}",
                        type: "GET",
                        beforeSend: function() {
                            $('.loading-container').show();
                        }
                    },
                    columns: [{
                            data: 'user_name',
                            name: 'user_name',
                            orderable: false
                        },
                        {
                            data: 'role',
                            name: 'role',
                            orderable: false
                        },
                        {
                            data: 'description',
                            name: 'description',
                            orderable: false
                        },
                        {
                            data: 'location',
                            name: 'location',
                            orderable: false,
                           
                        },
                        {
                            data: 'date_and_time',
                            name: 'date_and_time',
                            orderable: false,
                            render: function(data, type, row) {
                                return moment(row.created_at).format('MMMM D, YYYY - h:mm:ss a');
                            },
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            render: function(data, type, row) {
                                return '<div class="action-btn d-flex gap-1 justify-content-center"><a href="'+baseUrl+'/'+'getActivityLogs/details/'+row.id+'" id="view-txt-btn" class="view" title="View"><i class="fa-regular fa-eye" style="color: #005eff;"></i></a></div>';
                            },
                        },
                    ]
                });
                setTimeout(function() {
                    $('.loading-container').hide();
                }, 1000);
                $('table#activity-table thead tr th').on('click', function() {
                    setTimeout(function() {
                        $('.loading-container').hide();
                    }, 1500);
                });

                $(".dataTables_length").addClass('d-none');
                $(".dataTables_filter").addClass('d-none');
                $(".dataTables_info").addClass('d-none');

                $('#profile-edit').on('click', function() {
                    $('#profile').trigger("click");
                });

                $("#profile").change(function() {
                    $('#profile-form').submit();
                });

                $("#profile-form").submit(function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('update.user-profile-image', Auth::user()->id) }}",
                        method: 'POST',
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: 'JSON',
                        data: new FormData(this),
                        success: function(response) {
                            if (response['data'] === 'Success') {
                                $('#profile-user-img').attr('src', response['profile']);
                                $('.s-user-image').attr('src', response['profile']);
                                Swal.fire({
                                    title: 'Success',
                                    text: "Profile Image Successfully Updated!",
                                    icon: 'success',
                                });
                            }
                        }
                    });
                });

                $.validator.setDefaults({
                    submitHandler: function(e) {

                        const fData = $(e).serializeArray();
                        let formData = {};
                        fData.forEach((value, key) => {
                            formData[value['name']] = value['value'];
                        });
                        switch (e.id) {
                            case 'profile-info':
                                $.ajax({
                                    url: "{{ route('update.user-info', Auth::user()->id) }}",
                                    method: 'post',
                                    data: {
                                        formData: formData,
                                    },
                                    success: function(response) {
                                        if (response['data'] === 'Success') {
                                            $('.s-user-name, .profile-username, .h-user-name')
                                                .text($('#first_name').val() + ' ' + $(
                                                    '#middle_name').val() + ' ' + $(
                                                    '#last_name').val());
                                            Toast.fire({
                                                icon: 'success',
                                                title: 'Account Info successfully updated!'
                                            });
                                        }
                                    }
                                });
                                break;
                            case 'profile-password':
                                $.ajax({
                                    url: "{{ route('update.user-password', Auth::user()->id) }}",
                                    method: 'post',
                                    data: formData,
                                    success: function(response) {
                                        if (response['data'] === 'Success') {
                                            Toast.fire({
                                                icon: 'success',
                                                title: 'Password updated!'
                                            });
                                        } else {
                                            Toast.fire({
                                                icon: 'warning',
                                                title: 'The current password is incorrect!'
                                            });
                                        }
                                    }
                                });
                                break;
                        }
                        return false;
                    }
                });
                $.validator.addMethod("notEqualTo", function(value, element, param) {
                    return this.optional(element) || value !== $(param).val();
                }, "Please choose a different value.");
                $('#profile-info').validate({
                    rules: {
                        first_name: {
                            required: true,
                        },
                        middle_name: {
                            required: false,
                        },
                        last_name: {
                            required: true
                        },
                        username: {
                            required: true
                        },
                        address: {
                            required: false
                        },
                        phone: {
                            required: false
                        },
                        email: {
                            required: true,
                            email: true
                        },
                    },
                    messages: {
                        first_name: {
                            required: "Please enter first name",
                        },
                        last_name: {
                            required: "Please enter last name",
                        },
                        username: {
                            required: "Please enter username",
                        },
                        email: {
                            required: "Please enter your email address.",
                            email: "Please enter a valid email address."
                        },
                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group div').append(error);
                        // Swal.fire({
                        //     title: 'Please fill out all required fields',
                        //     confirmButtonText: 'Continue',
                        //     icon: 'warning',
                        // });
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });
                $('#profile-password').validate({
                    rules: {
                        current_password: {
                            required: true,
                            minlength: 8 // Set your minimum password length
                        },
                        new_password: {
                            required: true,
                            minlength: 8,
                            notEqualTo: "#current_password" // Ensure new password is not the same as current password
                        },
                        confirm_new_password: {
                            required: true,
                            equalTo: "#new_password" // Ensure confirm password matches new password
                        }
                    },
                    messages: {
                        current_password: {
                            required: "Please enter your current password.",
                            minlength: "Current password must be at least {0} characters long."
                        },
                        new_password: {
                            required: "Please enter a new password.",
                            minlength: "New password must be at least {0} characters long.",
                            notEqualTo: "New password must be different from the current password."
                        },
                        confirm_new_password: {
                            required: "Please confirm your new password.",
                            equalTo: "Passwords do not match."
                        }
                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group div').append(error);
                        // Swal.fire({
                        //     title: 'Please fill out all required fields',
                        //     confirmButtonText: 'Continue',
                        //     icon: 'warning',
                        // });
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });


                // -------------------------------------------------------

                $('#logo-edit').on('click', function() {
                    $('#logo').trigger("click");
                });

                $("#logo").change(function() {
                    $('#system-form').submit();
                });

                $("#system-form").submit(function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('update.system-logo') }}",
                        method: 'POST',
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: 'JSON',
                        data: new FormData(this),
                        success: function(response) {
                            console.log("🚀 ~ file: index.blade.php:435 ~ $ ~ response:", response)
                            if (response['data'] === 'Success') {
                                $('#logo-img').attr('src', response['logo']);
                                $('.s-user-image').attr('src', response['logo']);
                                Swal.fire({
                                    title: 'Success',
                                    text: "System Logo Successfully Updated!",
                                    icon: 'success',
                                });
                            }
                        }
                    });
                });
                
            });
        </script>
    @endpush
@endsection
