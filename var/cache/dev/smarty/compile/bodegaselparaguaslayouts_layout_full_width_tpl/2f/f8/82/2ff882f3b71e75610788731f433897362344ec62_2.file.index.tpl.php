<?php
/* Smarty version 4.2.1, created on 2023-04-20 19:01:16
  from 'C:\wamp64\www\prestashop\themes\bodegaselparaguas\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_64416fdce3ff45_06314832',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ff882f3b71e75610788731f433897362344ec62' => 
    array (
      0 => 'C:\\wamp64\\www\\prestashop\\themes\\bodegaselparaguas\\templates\\index.tpl',
      1 => 1680971150,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64416fdce3ff45_06314832 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_179941028064416fdce3b603_57740424', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_201639165864416fdce3c066_59390145 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'hook_home'} */
class Block_69094034764416fdce3d974_52902390 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

          <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_175568456764416fdce3d045_29462656 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_69094034764416fdce3d974_52902390', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_179941028064416fdce3b603_57740424 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_179941028064416fdce3b603_57740424',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_201639165864416fdce3c066_59390145',
  ),
  'page_content' => 
  array (
    0 => 'Block_175568456764416fdce3d045_29462656',
  ),
  'hook_home' => 
  array (
    0 => 'Block_69094034764416fdce3d974_52902390',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_201639165864416fdce3c066_59390145', 'page_content_top', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_175568456764416fdce3d045_29462656', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
