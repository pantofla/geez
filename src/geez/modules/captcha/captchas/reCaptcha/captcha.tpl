{if isset($register_captcha_error)}<br /><span class="error">{$register_captcha_error}</span><br /><br />{/if}
<?php 
	require_once(captcha_captchas_path . '/reCaptcha/libs/recaptchalib.php');
	$publickey = get_misc_data('reCaptcha_pubkey'); // you got this from the signup page
	echo recaptcha_get_html($publickey);
?>
