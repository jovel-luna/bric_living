<div class="card card-secondary shadow mb-0 p-0">
    <div class="card-header py-2">
        <h6 class="m-0 font-weight-bold">{{ __('User Account') }}</h6>
    </div>
    <div class="card-body">
        <form id="profile-info">
            @csrf 
            <div class="form-group row">
                <label for="first_name" class="col-md-2 col-form-label">First Name<span class="isRequired"> * </span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="middle_name" class="col-md-2 col-form-label">Middle Name</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ Auth::user()->middle_name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-md-2 col-form-label">Last Name<span class="isRequired"> * </span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-md-2 col-form-label">Username</label>
                <div class="col-md-10">
                    <input type="text" class="form-control is-disabled" id="username" name="username" value="{{ Auth::user()->username }}" readOnly>
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-md-2 col-form-label">Address</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-md-2 col-form-label">Phone</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-2 col-form-label">Email</label>
                <div class="col-md-10">
                    <input type="email" class="form-control is-disabled" id="email" name="email" value="{{ Auth::user()->email }}" readOnly>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-md-2 col-md-10">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card card-secondary shadow mb-0 p-0">
    <div class="card-header py-2">
        <h6 class="m-0 font-weight-bold">{{ __('Change Password') }}</h6>
    </div>
    <div class="card-body">
        <form id="profile-password">
            @csrf 
            <div class="form-group row">
                <label for="current_password" class="col-md-2 col-form-label">Current Password<span class="isRequired"> * </span></label>
                <div class="col-md-10 password-container">
                    <input type="password" class="form-control" id="current_password" name="current_password" value="{{ old('current_password') }}" placeholder="Current Password">
                    <i id="togglePassword" class="far fa-eye mr-1"></i>
                </div>
            </div>
            <div class="form-group row">
                <label for="new_password" class="col-md-2 col-form-label">New Password<span class="isRequired"> * </span></label>
                <div class="col-md-10 password-container">
                    <input type="password" class="form-control" id="new_password" name="new_password" value="{{ old('new_password') }}" placeholder="New Password">
                    <i id="togglePassword" class="far fa-eye mr-1"></i>
                </div>
            </div>
            <div class="form-group row">
                <label for="confirm_new_password" class="col-md-2 col-form-label">Confirm New Password<span class="isRequired"> * </span></label>
                <div class="col-md-10 password-container">
                    <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" value="{{ old('confirm_new_password') }}" placeholder="Confirm New Password">
                    <i id="togglePassword" class="far fa-eye mr-1"></i>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-md-2 col-md-10">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>