<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo eps_language_dir(); ?>" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php'); ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
  <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js'); ?>"></script>
  
  <link href="https://connecthabesha.com/oc-content/plugins/sms/css/user.css?v=20241120043313" rel="stylesheet" type="text/css" />
    
  <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/7.1.1/css/intlTelInput.css" rel="stylesheet" type="text/css" />
    
  <script type="text/javascript" src="https://connecthabesha.com/oc-content/plugins/sms/js/user.js?v=20241120043313"></script>
    
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/7.1.1/js/intlTelInput.min.js"></script>
</head>

<body id="user-login" class="pre-account login">
  <?php UserForm::js_validation(); ?>
  <?php osc_current_web_theme_path('header.php'); ?>

  <section class="container">
    <div class="box">
      <h1><?php _e('Sign-in to your account', 'epsilon'); ?></h1>

      <?php if(function_exists('fl_call_after_install') || function_exists('gc_login_button') || function_exists('fjl_login_button')) { ?>
        <div class="social">
          <?php if(function_exists('fl_call_after_install') && facebook_login_link() !== false) { ?>
            <a class="facebook" href="<?php echo facebook_login_link(); ?>" title="<?php echo osc_esc_html(__('Login with Facebook', 'epsilon')); ?>">
              <i class="fab fa-facebook"></i>
              <span><?php _e('Login with Facebook', 'epsilon'); ?></span>
            </a>
          <?php } ?>

          <?php if(function_exists('ggl_login_link') && ggl_login_link() !== false) { ?>
            <a class="google" href="<?php echo ggl_login_link(); ?>" title="<?php echo osc_esc_html(__('Sign in with Google', 'epsilon')); ?>">
              <i class="fab fa-google"></i>
              <span><?php _e('Sign in with Google', 'epsilon'); ?></span>
            </a>
          <?php } ?>
          
          <?php if(function_exists('fjl_login_button')) { ?>
            <a target="_top" href="javascript:void(0);" class="facebook fl-button fjl-button" onclick="fjlCheckLoginState();" title="<?php echo osc_esc_html(__('Connect with Facebook', 'epsilon')); ?>">
              <i class="fab fa-facebook-square"></i>
              <span><?php _e('Continue with Facebook', 'epsilon'); ?></span>
            </a>
          <?php } ?>
        </div>
      <?php } ?>

      <a class="alt-action" href="<?php echo osc_register_account_url(); ?>"><?php _e('No account yet? Register a new account', 'epsilon'); ?> &#8594;</a>

      <form action="<?php echo osc_base_url(true); ?>" method="post" >
        <input type="hidden" name="page" value="login" />
        <input type="hidden" name="action" value="login_post" />
        
        <?php osc_run_hook('user_pre_login_form'); ?>

        <div class="row " id="semail">
          <?php /*<label for="email"><?php _e('E-mail', 'epsilon'); ?></label>*/?>
          <span class="input-box" style="margin-bottom:0px;">
              <?php UserForm::email_login_text(); ?>
          </span>
          <a href="javascript:void()" style="margin-top:2px;margin-bottom:15px;font-size:14px;float:right" id="choose_mobile">Use phone number</a>
        </div>
        
        <div class="row " id="sphone">
          <?php /*<label for="email"><?php _e('phone', 'epsilon'); ?></label>*/?>
          <span class="input-box" style="margin-bottom:0px;">
              <input id="phone" type="text" name="phone" value="" placeholder="phone" style="width:100%" >
          </span>
          <a href="javascript:void()" style="margin-top:2px;margin-bottom:15px;font-size:14px;float:right" id="choose_email">Use email address</a>
        </div>

        <div class="row">
          <?php /*<label for="password"><?php _e('Password', 'epsilon'); ?></label>*/ ?>
          <span class="input-box">
            <?php UserForm::password_login_text(); ?>
            <a href="#" class="toggle-pass" title="<?php echo osc_esc_html(__('Show/hide password', 'epsilon')); ?>"><i class="fa fa-eye-slash"></i></a>
          </span>
        </div>

        <div class="input-box-check">
          <?php UserForm::rememberme_login_checkbox();?>
          <label for="remember"><?php _e('Remember me', 'epsilon'); ?></label>
        </div>

        <div class="user-reg-hook"><?php osc_run_hook('user_login_form'); ?></div>

        <div class="row fr">
        </div>
        
        <?php eps_show_recaptcha('login'); ?>

        <button type="submit" class="btn"><?php _e('Log in', 'epsilon');?></button>

        <a class="alt-action2" href="<?php echo osc_recover_user_password_url(); ?>"><?php _e('I forgot my password', 'epsilon'); ?></a>
      </form>
    </div>
  </section>

  <?php osc_current_web_theme_path('footer.php'); ?>
  
  <script>
      $(document).ready(function() {
          var exclude = "us";
          var xclude = localStorage.getItem('excludedCounty');
          var initialCounty = localStorage.getItem('initialCounty'); 
          //localStorage.setItem('excludedCounty', xclude);
          
        $('#phone').intlTelInput({
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/7.1.1/lib/libphonenumber/build/utils.js",
            initialCountry: initialCounty,
            autoFormat: true,
            nationalMode: false,
        });


        var errorMap = [ "Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];


        $('body').on('change keyup load', $('#phone'), function() {
          $('#phone').removeClass("error"); 
          $('.sms-validation').hide(0).text('');

          $('.intl-tel-input').each(function() {
            if(!$(this).find('.sms-validation').length) {
              $(this).append('<em class="sms-validation"></em>');
            } 
          });


          if ($('#phone').val()) {
            if ($('#phone').intlTelInput('isValidNumber')) {
              $('#phone').removeClass("error").addClass('valid');
              $('.sms-validation').hide(0).text('');

            } else {
              $('#phone').addClass('error').removeClass('valid');
              var errorCode = $('#phone').intlTelInput('getValidationError');

              if(errorCode != -99) {
                $('.sms-validation').show(0).text(errorMap[errorCode]);
              }
            }
          }
        });

        $('#phone').prop('required', true);
        
        setTimeout(function() {
            $('.country-list .country').each(function() {
                const countryCode = $(this).data('country-code');
                
                if (xclude.includes(countryCode)) {
                    $(this).remove();
                } 
            });
        }, 2000); 
    
      });
      
    $(document).ready(function(){
        $('#phone').attr('name', '');
        $('#phone').removeAttr('required');
        $('#choose_mobile').on('click', function () {
            $('#email').removeAttr('required');
            $('#sphone').show();
            $('#semail').hide();
            $('#phone').attr('name', 'email');
           
            $('#phone').attr('required', true);
        });
        $('#choose_email').on('click', function () {
            $('#sphone').hide();
            $('#semail').show();
            $('#phone').attr('name', '');
            $('#email').attr('name', 'email');
            $('#phone').removeAttr('required');
            $('#email').attr('required', true);
        });
        $('#sphone').hide();
        $("#email").attr("placeholder", "Email");
        $("#password").attr("placeholder", "password");
    });
</script>
    
<?php osc_current_admin_theme_path('parts/footer.php'); ?>
</body>
</html>