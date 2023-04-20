<?php
/* Smarty version 4.2.1, created on 2023-04-20 19:01:16
  from 'C:\wamp64\www\prestashop\themes\bodegaselparaguas\templates\page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_64416fdceed963_19541835',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eddd507c94cd192f5c5f9873961aa9d7b650fe2a' => 
    array (
      0 => 'C:\\wamp64\\www\\prestashop\\themes\\bodegaselparaguas\\templates\\page.tpl',
      1 => 1680971150,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64416fdceed963_19541835 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_801969364416fdcee2c99_96902751', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_110868076864416fdcee4463_32511986 extends Smarty_Internal_Block
{
public $callsChild = 'true';
public $hide = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <header class="page-header">
          <h1><?php 
$_smarty_tpl->inheritance->callChild($_smarty_tpl, $this);
?>
</h1>
        </header>
      <?php
}
}
/* {/block 'page_title'} */
/* {block 'page_header_container'} */
class Block_50797841964416fdcee36a8_85201023 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_110868076864416fdcee4463_32511986', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_88559965164416fdcee8aa5_24634478 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_95574263764416fdcee9961_88694357 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_65612658264416fdcee7f85_82741948 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_88559965164416fdcee8aa5_24634478', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_95574263764416fdcee9961_88694357', 'page_content', $this->tplIndex);
?>

      </div>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_182214944564416fdceebce2_53321268 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_27148263164416fdceeb1e6_50253578 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_182214944564416fdceebce2_53321268', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_801969364416fdcee2c99_96902751 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_801969364416fdcee2c99_96902751',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_50797841964416fdcee36a8_85201023',
  ),
  'page_title' => 
  array (
    0 => 'Block_110868076864416fdcee4463_32511986',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_65612658264416fdcee7f85_82741948',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_88559965164416fdcee8aa5_24634478',
  ),
  'page_content' => 
  array (
    0 => 'Block_95574263764416fdcee9961_88694357',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_27148263164416fdceeb1e6_50253578',
  ),
  'page_footer' => 
  array (
    0 => 'Block_182214944564416fdceebce2_53321268',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_50797841964416fdcee36a8_85201023', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_65612658264416fdcee7f85_82741948', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_27148263164416fdceeb1e6_50253578', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
