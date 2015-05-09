<div class="row">
    <div class="well col-md-5 col-md-offset-1">
        <form class="form-horizontal" name="editProfileForm" method="POST" action="/accounts/edit">
            <fieldset>
                <div class="row">
                    <legend class="col-md-10">Edit Profile</legend>
                </div>
                <div class="form-group">
                    <label for="username" class="col-lg-3 control-label">Username</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $this->userInfo['Username'] ?>" disabled>
                        <input type="text" name="form" value="editProfile" hidden>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fullName" class="col-lg-3 control-label">Full Name</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="fullName" name="fullName" value="<?= $this->userInfo['FullName'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-3 control-label">Email</label>
                    <div class="col-lg-6">
                        <input type="email" class="form-control" id="email" name="email" value="<?= $this->userInfo['Email'] ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <input class="btn btn-primary" type="submit" value="Update"/>
                        <a class="btn btn-default" href="/">Cancel</a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <div class="well col-md-4 col-md-offset-1">
        <form class="form-horizontal" name="changePasswordForm" method="POST" action="/accounts/edit">
            <fieldset>
                <div class="row">
                    <legend class="col-md-10">Change Password</legend>
                </div>
                <div class="form-group">
                    <label for="inputOldPassword" class="col-lg-5 control-label">Old password</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="inputOldPassword" placeholder="Old Password"  name="password" required>
                        <input type="text" name="form" value="editPassword" hidden>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-lg-5 control-label">New password</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="inputPassword" placeholder="New Password" name="newPassword" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword_repeat" class="col-lg-5 control-label">Confirm password</label>
                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="inputPassword_repeat" placeholder="Confirm password" name="confirmPassword"  required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <input class="btn btn-primary" type="submit" value="Change Password"/>
                        <a class="btn btn-default" href="/">Cancel</a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
