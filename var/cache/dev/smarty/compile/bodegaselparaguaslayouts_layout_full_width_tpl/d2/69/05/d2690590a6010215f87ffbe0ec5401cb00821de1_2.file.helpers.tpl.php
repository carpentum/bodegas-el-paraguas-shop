<?php
/* Smarty version 4.2.1, created on 2023-04-26 10:28:42
  from 'C:\wamp64\www\prestashop\themes\bodegaselparaguas\templates\_partials\helpers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6448e0bacab483_37753758',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd2690590a6010215f87ffbe0ec5401cb00821de1' => 
    array (
      0 => 'C:\\wamp64\\www\\prestashop\\themes\\bodegaselparaguas\\templates\\_partials\\helpers.tpl',
      1 => 1680971150,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6448e0bacab483_37753758 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'renderLogo' => 
  array (
    'compiled_filepath' => 'C:\\wamp64\\www\\prestashop\\var\\cache\\dev\\smarty\\compile\\bodegaselparaguaslayouts_layout_full_width_tpl\\d2\\69\\05\\d2690590a6010215f87ffbe0ec5401cb00821de1_2.file.helpers.tpl.php',
    'uid' => 'd2690590a6010215f87ffbe0ec5401cb00821de1',
    'call_name' => 'smarty_template_function_renderLogo_8672565346448e0bac00ec2_58747963',
  ),
));
?> 

<?php }
/* smarty_template_function_renderLogo_8672565346448e0bac00ec2_58747963 */
if (!function_exists('smarty_template_function_renderLogo_8672565346448e0bac00ec2_58747963')) {
function smarty_template_function_renderLogo_8672565346448e0bac00ec2_58747963(Smarty_Internal_Template $_smarty_tpl,$params) {
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

  <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['index'], ENT_QUOTES, 'UTF-8');?>
">
    <img
      class="logo img-fluid"
      src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['logo_details']['src'], ENT_QUOTES, 'UTF-8');?>
"
      alt="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
"
      width="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['logo_details']['width'], ENT_QUOTES, 'UTF-8');?>
"
      height="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['logo_details']['height'], ENT_QUOTES, 'UTF-8');?>
">
  </a>
<?php
}}
/*/ smarty_template_function_renderLogo_8672565346448e0bac00ec2_58747963 */
}
