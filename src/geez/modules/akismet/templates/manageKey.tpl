In order to use this module you must have a WordPress key (even if you don't use WordPress.com). More information is available at <a href="http://faq.wordpress.com/2005/10/19/api-key/" target="_blank">WordPress.com</a><br /><br />

<form method="get" action="module.php">
	<input type="hidden" name="module" value="akismet">
	<input type="hidden" name="view" value="updateKey">
	Wordpress API Key: <input type="text" name="key" value="{$wordpress_key}">
	<input type = "submit" value="Update Key">
</form>
