<?php
if( !is_user_logged_in() ) :
$elements = gillion_option( 'header_elements' ); ?>

    <div id="login-register" style="display: none;">
        <div class="sh-login-popup-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-target="#viens" data-toggle="tab">Login</a>
                </li>
                <li>
                    <a data-target="#divi" data-toggle="tab">Register</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="viens">

                <div class="sh-login-popup-content sh-login-popup-content-login">
                    <?php wp_login_form(); ?>
                </div>

            </div>
            <div class="tab-pane" id="divi">

                <div class="sh-login-popup-content">
                    <?php if ( !get_option( 'users_can_register' ) )  : ?>

                        <p id="reg_passmail"><?php esc_html_e( 'Registration is closed.', 'gillion' ); ?></p>

                    <?php else : ?>
                        <?php if ( is_multisite() ) : ?>
                            <form id="registerform" method="post" action="<?php echo wp_registration_url(); ?>" novalidate="novalidate">
                            	<p id="reg_passmail"><?php esc_html_e( 'Registration confirmation will be emailed to you.', 'gillion' ); ?></p>
                            	<p class="submit">
                                    <input id="signupblog2" type="hidden" name="signup_for" value="user">
                                    <input type="submit" name="submit" id="wp-submit2" class="button button-primary button-large" value="Start Registration">
                                </p>
                            </form>
                        <?php else : ?>
                            <form name="registerform" id="registerform" action="<?php echo wp_registration_url(); ?>" method="post" novalidate="novalidate">
                            	<p>
                            		<label for="user_login"><?php esc_html_e( 'Username', 'gillion' ); ?></label>
                            		<input type="text" name="user_login" id="user_login2" class="input" value="" size="20" required>
                            	</p>
                            	<p>
                            		<label for="user_email"><?php esc_html_e( 'Email', 'gillion' ); ?></label>
                            		<input type="email" name="user_email" id="user_email2" class="input" value="" size="25" required>
                            	</p>
                            	<p id="reg_passmail"><?php esc_html_e( 'Registration confirmation will be emailed to you.', 'gillion' ); ?></p>
                            	<input type="hidden" name="redirect_to" value="">
                            	<p class="submit">
                                    <input type="submit" name="wp-submit" id="wp-submit2" class="button button-primary button-large" value="Register">
                                </p>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>
