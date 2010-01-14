<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:36 CDT */ ?>


	<li><?php if ($this->_vars['Voting_Method'] == 1): ?><span class="sidebar-vote-number"><a href="<?php echo $this->_vars['story_url']; ?>
"><?php echo $this->_vars['link_shakebox_votes']; ?>
</a></span><?php endif; ?>
	<span class="sidebar-article"><a href="<?php echo $this->_vars['story_url']; ?>
" class="switchurl"><?php echo $this->_vars['title_short']; ?>
</a></span></li>
