<div class="row">
    <div class="well col-md-6 col-md-offset-3">
        <form class="form-horizontal" name="editProfileForm" method="POST">
            <fieldset>
                <div class="row">
                    <legend>Admin Edit Profile</legend>
                </div>
                <div class="form-group">
                    <label for="username" class="col-lg-3 control-label">Username :</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="username" value="<?= $this->userInfo['Username'] ?>" disabled>
                        <input type="text" name="username" value="<?= $this->userInfo['Username'] ?>" hidden>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fullName" class="col-lg-3 control-label">Full Name :</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="fullName" name="fullName" value="<?= $this->userInfo['FullName'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-3 control-label">Email :</label>
                    <div class="col-lg-6">
                        <input type="email" class="form-control" id="email" name="email" value="<?= $this->userInfo['Email'] ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"></label>
                    <div class="col-lg-9">
                        <div class="checkbox">
                            <?php if($this->userInfo['IsAdmin']) : ?>
                                <label>
                                    <input type="checkbox" name="isAdmin" value="1" checked> Admin
                                </label>
                            <?php else : ?>
                                <label>
                                    <input type="checkbox" name="isAdmin"  value="1"> Admin
                                </label>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <input class="btn btn-primary" type="submit" value="Update"/>
                        <a class="btn btn-default" href="/accounts/all">Cancel</a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
