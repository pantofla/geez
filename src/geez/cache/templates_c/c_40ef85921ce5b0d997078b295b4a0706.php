<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 09:41:10 CDT */ ?>

<?php $this->config_load(ajaxcontact_lang_conf, null, null); ?>

<?php echo '
	<style type=\'text/css\' media=\'screen,projection\'>
	<!--
	fieldset { border:0;margin:0;padding:0; }
	label { display:block; }
	input.text,textarea { width:300px;font:12px/12px \'courier new\',courier,monospace;color:#333;padding:3px;margin:1px 0;border:1px solid #ccc; }
	input.submit { padding:2px 5px;font:bold 12px/12px verdana,arial,sans-serif; }
	-->
	</style>
'; ?>







	<h2><?php echo $this->_confs['PLIGG_Visual_ajaxcontact']; ?>
</h2>
<div class="content">&#928;&#945;&#961;&#945;&#954;&#945;&#955;&#959;&#973;&#956;&#949;, <?php echo $this->_confs['PLIGG_Visual_feedbackform']; ?>
<a href="http://www.geez.gr/faq.php/">FAQ</a>!	</div>


	
	
	<p id="loadBar" style="display:none;">
		<strong><?php echo $this->_confs['PLIGG_Ajax_Contact_Sending_Email']; ?>
</strong> <img src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/modules/ajaxcontact/img/loading.gif" alt="Loading..." title="Sending Email" align="absmiddle" />
		<br /><br />
	</p>
	<p id="emailSuccess" style="display:none;">
		<strong style="color:green;"><?php echo $this->_confs['PLIGG_Ajax_Contact_Sending_Email_Success']; ?>
</strong>
		<br /><br />
	</p>

	<div id="contactFormArea">
		<form action="<?php echo $this->_vars['ajaxcontact_path']; ?>
scripts/contact.php" method="post" id="cForm">
			<fieldset>
			<br />
				<?php echo $this->_confs['PLIGG_Ajax_Contact_Name']; ?>
:<br />
				<input class="text" type="text" size="25" name="posName" id="posName" /><br /><br />
				<?php echo $this->_confs['PLIGG_Ajax_Contact_Email']; ?>
:<br />
				<input class="text" type="text" size="25" name="posEmail" id="posEmail" /><br /><br />
				<?php echo $this->_confs['PLIGG_Ajax_Contact_Regarding']; ?>
:<br />
				<input class="text" type="text" size="25" name="posRegard" id="posRegard" /><br /><br />
				<?php echo $this->_confs['PLIGG_Ajax_Contact_Message']; ?>
:<br />
				<textarea cols="50" rows="5" name="posText" id="posText"></textarea><br /><br />
				<label for="selfCC">
					<input type="checkbox" name="selfCC" id="selfCC" value="send" /> <?php echo $this->_confs['PLIGG_Ajax_Contact_Send_CC']; ?>

				</label><br />
				<label>
					<input class="submit" type="submit" name="sendContactEmail" id="sendContactEmail" value="<?php echo $this->_confs['PLIGG_Ajax_Contact_Send_Email']; ?>
" />
				</label>
			</fieldset>
		</form>

	</div>


	