<?php /* Smarty version Smarty-3.1.11, created on 2012-09-11 12:37:14
         compiled from "/home/bato/workspace/github/bedita/bedita-app/views/elements/export.tpl" */ ?>
<?php /*%%SmartyHeaderCode:323649900504f145add6839-11126328%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bdfbe0da96d8c00da4f5795fdc1ba4aaa7060dd7' => 
    array (
      0 => '/home/bato/workspace/github/bedita/bedita-app/views/elements/export.tpl',
      1 => 1346861103,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '323649900504f145add6839-11126328',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'object' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_504f145ae175c0_38021474',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_504f145ae175c0_38021474')) {function content_504f145ae175c0_38021474($_smarty_tpl) {?><?php if (!is_callable('smarty_block_bedev')) include '/home/bato/workspace/github/bedita/bedita-app/vendors/_smartyPlugins/block.bedev.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('bedev', array()); $_block_repeat=true; echo smarty_block_bedev(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php if (!empty($_smarty_tpl->tpl_vars['object']->value)){?>

<ul class="menuleft insidecol">
	<li>
		<a href="javascript:void(0)" onclick="$('#export').slideToggle();">Export</a>
		<ul id="export" style="display:none;">
			<li><a href="">xml</a></li>
			<li><a href="">rtf</a></li>
			<li><a href="">PDF</a></li>
			<li><a href="">xhtml</a></li>
		</ul>
	
	</li>
</ul>

<?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_bedev(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }} ?>