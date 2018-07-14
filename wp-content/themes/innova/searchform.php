<form method="get" id="search_form" class="searchbox-wrapper cf" action="<?php echo home_url(); ?>">
<input class="text" type="text"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;"  name="s" id="s" placeholder="<?php _e('Search here...','innova') ?>" required="required" />
<button type="submit"><?php _e('Search','innova'); ?></button>
</form>
