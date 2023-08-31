<section>
    <div class="height-100-vh bg-primary-trans">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    <img src="../assets/images/dashboard.png" class="logo-auth">
                    <div class="login-div">
                       <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="login" id="needs-validation" novalidate>  
                            <?=$csrf->input('login-token');?>

                            <div class="form-group">
                                <label>USERNAME</label>
                                <input class="form-control input-lg" placeholder="Username" name="manager_email" type="text" required>
                                <div class="invalid-feedback">This field is required</div>
                            </div>
                            <div class="form-group">
                                <label>PASSWORD</label>
                                <input class="form-control input-lg" placeholder="Password" name="manager_password" type="password" required>
                                <div class="invalid-feedback">This field is required</div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label>ENTER CAPTCHA</label>
                                    <input type="text" class="form-control" placeholder="Enter Captcha" name="captcha" required>
                                    <div class="invalid-feedback">This field is required</div>
                                </div>
                                <div class="form-group col-6">
                                    <label>Captcha Code</label>
                                    <img src="../controller/captcha.php" style="width: 100%; border-radius: 4px; height: 38px;">
                                </div>
                            </div>

                            <button class="btn btn-primary mt-2" type="submit" style="width: 100%">Enter</button>

                            <?php if( !empty($errors)): ?>

							<div class="alert alert-danger animated fadeIn alert-login" role="alert">
    
    						<?php echo $errors; ?>
    
							</div>
							
							<?php endif; ?>

                        </form>
                    </div>
                    <div class="copyright-text">
                    <span>All Rights Reserved</span><br>
                    <span>&copy; <?php echo date("Y"); ?> Wicombit</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>