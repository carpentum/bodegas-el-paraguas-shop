<?php
/* Smarty version 4.2.1, created on 2023-04-18 10:37:57
  from 'C:\wamp64\www\prestashop\modules\ps_checkout\views\templates\hook\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_643e56e5d36843_74026928',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f489d52ce01b3d28fbd7f3a45ccdb305ad7c0c18' => 
    array (
      0 => 'C:\\wamp64\\www\\prestashop\\modules\\ps_checkout\\views\\templates\\hook\\header.tpl',
      1 => 1680971087,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_643e56e5d36843_74026928 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contentToPrefetch']->value, 'content');
$_smarty_tpl->tpl_vars['content']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['content']->value) {
$_smarty_tpl->tpl_vars['content']->do_else = false;
?>
  <link rel="prefetch" href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['content']->value['link'],'javascript','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" as="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['content']->value['type'], ENT_QUOTES, 'UTF-8');?>
">
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
