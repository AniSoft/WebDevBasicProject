<div>
    <div class="col-lg-3">
        <div class="well bs-component">
            <form role="form-horizontal" method="POST" name="register">
                <fieldset>
                    <legend>Register</legend>
                    <div class="form-group">
                        <?php if (isset($this->fieldsErrors['username'])) : ?>
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong><?php echo $this->fieldsErrors['username']; ?></strong>
                            </div>
                        <?php endif; ?>
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username"
                               placeholder="Enter username"
                               value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <?php if (isset($this->fieldsErrors['firstName'])) : ?>
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong><?php echo $this->fieldsErrors['firstName']; ?></strong>
                            </div>
                        <?php endif; ?>
                        <label for="first-name">First name:</label>
                        <input type="text" class="form-control" id="first-name" name="firstName"
                               placeholder="Enter First name"
                               value="<?php echo isset($_POST['firstName']) ? $_POST['firstName'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <?php if (isset($this->fieldsErrors['lastName'])) : ?>
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong><?php echo $this->fieldsErrors['lastName']; ?></strong>
                            </div>
                        <?php endif; ?>
                        <label for="last-name">Last name:</label>
                        <input type="text" class="form-control" id="last-name" name="lastName"
                               placeholder="Enter Last name"
                               value="<?php echo isset($_POST['lastName']) ? $_POST['lastName'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <?php if (isset($this->fieldsErrors['email'])) : ?>
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong><?php echo $this->fieldsErrors['email']; ?></strong>
                            </div>
                        <?php endif; ?>
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="Enter email"
                               value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <?php if (isset($this->fieldsErrors['password'])) : ?>
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong><?php echo $this->fieldsErrors['password']; ?></strong>
                            </div>
                        <?php endif; ?>
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <?php if (isset($this->fieldsErrors['confirmPassword'])) : ?>
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong><?php echo $this->fieldsErrors['confirmPassword']; ?></strong>
                            </div>
                        <?php endif; ?>
                        <label for="confirm-password">Confirm password:</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirmPassword"
                               placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="submitted" value="1"/>
                        <button type="submit" class="btn btn-default">Register</button>
                        &nbsp;
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </div>
            </form>
        </div>
    </div>
</div>
