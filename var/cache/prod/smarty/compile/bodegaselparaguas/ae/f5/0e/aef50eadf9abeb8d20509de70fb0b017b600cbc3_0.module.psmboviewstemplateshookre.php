<?php
/* Smarty version 4.2.1, created on 2023-04-18 10:32:36
  from 'module:psmboviewstemplateshookre' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_643e55a484ffd8_30033838',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aef50eadf9abeb8d20509de70fb0b017b600cbc3' => 
    array (
      0 => 'module:psmboviewstemplateshookre',
      1 => 1680971083,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_643e55a484ffd8_30033838 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
  if (typeof window.mboCdc == undefined || typeof window.mboCdc == "undefined") {
    if (typeof renderCdcError === 'function') {
      window.$(document).ready(function() {
        renderCdcError($('#cdc-explore-themes-catalog'));
      });
    }
  } else {
    const renderExploreThemesCatalog = window.mboCdc.renderExploreThemeCatalog

    const exploreThemesCatalogContext = <?php echo $_smarty_tpl->tpl_vars['shop_context']->value;?>
;

    renderExploreThemesCatalog(exploreThemesCatalogContext, '#cdc-explore-themes-catalog')
  }
<?php echo '</script'; ?>
>

<div id="cdc-explore-themes-catalog" class="col-lg-3 col-md-4 col-sm-6 theme-card-container cdc-container" data-error-path="<?php echo $_smarty_tpl->tpl_vars['cdcErrorUrl']->value;?>
"></div>

<?php }
}
