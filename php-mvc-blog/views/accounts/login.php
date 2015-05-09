<div class="col-md-12">
    <div class="col-md-4">
    </div>
    <div class="well well-lg col-md-4">
        <form class="form-horizontal" name="registerForm" method="POST"
              action="/accounts/login">
            <fieldset>
                <div class="row">
                    <legend class="col-md-10">Login</legend>
                </div>
                <div class="form-group">
                    <label for="username" class="col-lg-3 control-label">Username:</label>

                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-lg-3 control-label">Password:</label>

                    <div class="col-lg-6">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <input class="btn btn-primary" type="submit" value="Login"/>
                        <a class="btn btn-default" href="/accounts/register">Register</a>
                        <a class="btn btn-default" href="/">Cancel</a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
