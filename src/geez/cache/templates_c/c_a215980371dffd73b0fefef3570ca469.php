<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 09:56:09 CDT */ ?>

<tr>
	<td><img src="<?php echo $this->_vars['user_avatar']; ?>
" align="absmiddle" /> <a href="<?php echo $this->_vars['user_userlink']; ?>
"><?php echo $this->_vars['user_username']; ?>
</a></td>
	<td><?php echo $this->_vars['user_total_links']; ?>
</td>
	<?php if ($this->_vars['user_total_links'] > 0): ?>
		<td><?php echo $this->_vars['user_published_links']; ?>
&nbsp;(<?php echo $this->_vars['user_published_links_percent']; ?>
%)</td>
	<?php else: ?>
		<td><?php echo $this->_vars['user_published_links']; ?>
&nbsp;(-)</td>
	<?php endif; ?>
	<td><?php echo $this->_vars['user_total_comments']; ?>
</td>
	<td><?php echo $this->_vars['user_total_votes']; ?>
</td>
	<?php if ($this->_vars['user_total_votes'] > 0): ?>
		<td><?php echo $this->_vars['user_published_votes']; ?>
&nbsp;(<?php echo $this->_vars['user_published_votes_percent']; ?>
%)</td>
	<?php else: ?>
		<td><?php echo $this->_vars['user_published_votes']; ?>
&nbsp;(-)</td>
	<?php endif; ?>
	<td><?php echo $this->_vars['user_karma']; ?>
</td>
</tr>
