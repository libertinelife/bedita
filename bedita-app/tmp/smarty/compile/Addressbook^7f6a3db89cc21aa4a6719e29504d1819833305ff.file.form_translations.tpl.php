<?php /* Smarty version Smarty-3.1.11, created on 2012-09-11 10:27:14
         compiled from "/home/bato/workspace/github/bedita/bedita-app/views/elements/form_translations.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1185356469504ef5e2a78498-54249268%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f6a3db89cc21aa4a6719e29504d1819833305ff' => 
    array (
      0 => '/home/bato/workspace/github/bedita/bedita-app/views/elements/form_translations.tpl',
      1 => 1347273764,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1185356469504ef5e2a78498-54249268',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'moduleList' => 0,
    'object' => 0,
    'html' => 0,
    'k' => 0,
    'conf' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_504ef5e2b895c8_98326979',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_504ef5e2b895c8_98326979')) {function content_504ef5e2b895c8_98326979($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/bato/workspace/github/bedita/bedita-app/vendors/_smartyPlugins/block.t.php';
?><?php if (isset($_smarty_tpl->tpl_vars['moduleList']->value['translations'])){?>
<div class="tab"><h2><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Translations<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h2></div>
<fieldset id="translations">

<?php if (!empty($_smarty_tpl->tpl_vars['object']->value['LangText']['status'])){?>
<table class="indexlist bordered">	
<tr>
	<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lang<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
title<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
</tr>
<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['object']->value['LangText']['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
<tr>
	<td><a href="<?php echo $_smarty_tpl->tpl_vars['html']->value->url('/translations/view/');?>
<?php echo $_smarty_tpl->tpl_vars['object']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['conf']->value->langOptions[$_smarty_tpl->tpl_vars['k']->value];?>
</a></td>
	<td><a href="<?php echo $_smarty_tpl->tpl_vars['html']->value->url('/translations/view/');?>
<?php echo $_smarty_tpl->tpl_vars['object']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['object']->value['LangText']['title'][$_smarty_tpl->tpl_vars['k']->value])===null||$tmp==='' ? '' : $tmp);?>
</a></td>
	<td><a href="<?php echo $_smarty_tpl->tpl_vars['html']->value->url('/translations/view/');?>
<?php echo $_smarty_tpl->tpl_vars['object']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a></td>
</tr>
<?php } ?>
</table>
<?php }else{ ?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
No translations found<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>

<br />
<?php if ($_smarty_tpl->tpl_vars['moduleList']->value['translations']['flag']&$_smarty_tpl->tpl_vars['conf']->value->BEDITA_PERMS_MODIFY){?>
<input type="button" value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
create new translation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="javascript:document.location='<?php echo $_smarty_tpl->tpl_vars['html']->value->url('/translations/view/');?>
<?php echo $_smarty_tpl->tpl_vars['object']->value['id'];?>
';"/>
<?php }?>

</fieldset>
<?php }?>
<?php }} ?>