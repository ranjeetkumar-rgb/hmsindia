
<div class="login-box">

        <div class="logo">

            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/IndiaIVFClinic_logo.png" /></a>

        </div>

            <div class="card">
            <div class="body">
                <form action="" class="login-form"  method="post">
                     <input type="hidden" class="form-control" name="login" value="login">
                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="msg">Sign in to start your account</div>

                    <div class="input-group">

                        <span class="input-group-addon">

                            <i class="material-icons">person</i>

                        </span>

                        <div class="form-line">

                            <input type="text" class="form-control" value="<?php if(isset($_COOKIE['femail'])){echo $_COOKIE['femail'];} else {echo "";} ?>" name="email" placeholder="Username" required autofocus>

                        </div>

                    </div>

                    <div class="input-group">

                        <span class="input-group-addon">

                            <i class="material-icons">lock</i>

                        </span>

                        <div class="form-line">

                            <input type="password" class="form-control" value="<?php if(isset($_COOKIE['lpsswrd'])){echo $_COOKIE['lpsswrd'];} else {echo "";} ?>" name="password" placeholder="Password" required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-7">

                            <input type="checkbox" name="rememberme" id="rememberme" <?php if(isset($_COOKIE['rememberme'])){echo "checked='checked'";} else {echo "";} ?> class="filled-in chk-col-pink">

                            <label for="rememberme">Remember Me</label>

                        </div>

                        <div class="col-xs-5 text-right">

                            <!--<a href="<?php echo site_url()?>forgot_password">Forgot password?</a>-->

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12">

                            <input type="submit" id="submit" class="btn btn-block btn-success waves-effect" value="Submit">

                        </div>

                    </div>

                </form>    

                <div class="row">

                        <div class="col-xs-12">

                            <p><a href="<?php echo base_url('doctor-login');?>">Login as doctor</a></p>

                        </div>

                    </div>

               </div>

        </div>

    </div>