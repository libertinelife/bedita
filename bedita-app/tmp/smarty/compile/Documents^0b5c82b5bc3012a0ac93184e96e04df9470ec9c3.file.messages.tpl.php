<?php /* Smarty version Smarty-3.1.12, created on 2012-09-26 16:37:44
         compiled from "/home/bato/workspace/github/bedita/bedita-app/views/elements/messages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:451917397504dfd9ce4cb45-41961092%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b5c82b5bc3012a0ac93184e96e04df9470ec9c3' => 
    array (
      0 => '/home/bato/workspace/github/bedita/bedita-app/views/elements/messages.tpl',
      1 => 1347894656,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '451917397504dfd9ce4cb45-41961092',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_504dfd9cef83a9_43772412',
  'variables' => 
  array (
    'session' => 0,
    'conf' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_504dfd9cef83a9_43772412')) {function content_504dfd9cef83a9_43772412($_smarty_tpl) {?><script type="text/javascript" charset="utf-8">
$(document).ready ( function ()  { 
<?php if (($_smarty_tpl->tpl_vars['session']->value->check('Message.info'))){?>
	$("#messagesDiv").triggerMessage("info", <?php echo $_smarty_tpl->tpl_vars['conf']->value->msgPause;?>
);
<?php }?>
<?php if (($_smarty_tpl->tpl_vars['session']->value->check('Message.warn'))){?>
	$("#messagesDiv").triggerMessage("warn", <?php echo $_smarty_tpl->tpl_vars['conf']->value->msgPause;?>
);
<?php }?>	
<?php if (($_smarty_tpl->tpl_vars['session']->value->check('Message.error'))){?>
	$("#messagesDiv").triggerMessage("error");
<?php }?>

});
</script>

<div id="messagesDiv">

	<?php if ($_smarty_tpl->tpl_vars['session']->value->check('Message.info')){?>
		<?php echo $_smarty_tpl->tpl_vars['session']->value->flash('info');?>

	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['session']->value->check('Message.warn')){?>
		<?php echo $_smarty_tpl->tpl_vars['session']->value->flash('warn');?>

	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['session']->value->check('Message.error')){?>
		<?php echo $_smarty_tpl->tpl_vars['session']->value->flash('error');?>

	<?php }?>
	
</div><?php }} ?>