<?php
/**
* Card payment REDSYS virtual POS
*
* NOTICE OF LICENSE
*
* This product is licensed for one customer to use on one installation (test stores and multishop included).
* Site developer has the right to modify this module to suit their needs, but can not redistribute the module in
* whole or in part. Any other use of this module constitues a violation of the user agreement.
*
* DISCLAIMER
*
* NO WARRANTIES OF DATA SAFETY OR MODULE SECURITY
* ARE EXPRESSED OR IMPLIED. USE THIS MODULE IN ACCORDANCE
* WITH YOUR MERCHANT AGREEMENT, KNOWING THAT VIOLATIONS OF
* PCI COMPLIANCY OR A DATA BREACH CAN COST THOUSANDS OF DOLLARS
* IN FINES AND DAMAGE A STORES REPUTATION. USE AT YOUR OWN RISK.
*
*  @author    idnovate
*  @copyright 2023 idnovate
*  @license   See above
*/

class AdminRedsysTpvController extends ModuleAdminController
{
    protected $delete_mode;
    protected $_defaultOrderBy = 'position';
    protected $_defaultOrderWay = 'ASC';
    protected $can_add_tpv = true;
    protected $top_elements_in_list = 4;
    protected static $meaning_status = array();

    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'redsys_tpv';
        $this->className = 'RedsysTpv';
        $this->tabClassName = 'AdminRedsysTpv';
        $this->lang = true;
        $this->addRowAction('edit');
        $this->addRowAction('delete');
        $this->imageType = 'png';
        $this->_orderWay = $this->_defaultOrderWay;
        $this->taxes_included = (Configuration::get('PS_TAX') == '0' ? false : true);

        parent::__construct();

        $this->bulk_actions = array(
            'delete' => array(
                'text' => $this->l('Delete selected'),
                'confirm' => $this->l('Delete selected items?'),
                'icon' => 'icon-trash'
            )
        );
        $this->context = Context::getContext();
        $this->default_form_language = $this->context->language->id;

        $this->fieldImageSettings = array(
            'name' => 'logo',
            'dir' => 'tmp',
        );

        $this->position_identifier = 'position';

        $this->fields_list = array(
            'id_redsys_tpv' => array(
                'title' => $this->l('ID'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs'
            ),
            'logo' => array(
                'title' => $this->l('Payment image'),
                'image' => 'tmp',
                'orderby' => false,
                'search' => false,
                'align' => 'center',
            ),
            'name' => array(
                'title' => $this->l('Name'),
                'filter_key' => 'a!name'
            ),
            'number' => array(
                'title' => $this->l('Number')
            ),
            'terminal' => array(
                'title' => $this->l('Terminal')
            ),
            'currency' => array(
                'title' => $this->l('Currency'),
                'callback' => 'getCurrencies'
            ),
            'environment_real' => array(
                'title' => $this->l('Real Environment'),
                'align' => 'text-center',
                'callback' => 'printEnvironmentRealIcon',
                'orderby' => false,
                'filter_key' => 'a!environment_real'
            ),
            'clicktopay' => array(
                'title' => $this->l('Click to Pay'),
                'align' => 'text-center',
                'orderby' => false,
                'callback' => 'printClicktoPayIcon',
                'filter_key' => 'a!clicktopay'
            ),
            'position' => array(
                'title' => $this->l('Position'),
                'filter_key' => 'a!position',
                'align' => 'center',
                'class' => 'fixed-width-sm',
                'position' => 'position'
            ),
            'active' => array(
                'title' => $this->l('Enabled'),
                'align' => 'text-center',
                'active' => 'status',
                'type' => 'bool',
                'orderby' => false,
                'filter_key' => 'a!active'
            ),
        );

        $this->tpl_vars = array(
            'icon' => 'icon-AdminAdmin',
        );

        $this->context->smarty->assign($this->tpl_vars);

        if (Shop::isFeatureActive() && (Shop::getContext() == Shop::CONTEXT_ALL || Shop::getContext() == Shop::CONTEXT_GROUP)) {
            $this->can_add_tpv = false;
            unset($this->fields_list['position']);
        }

        if (Tools::isSubmit('submitFilterredsys_transaction') && (int)Tools::getValue('submitFilterredsys_transaction') == 0) {
            $this->action = 'reset_filters';
        }

        if (Tools::isSubmit('submitFilterredsys_refund') && (int)Tools::getValue('submitFilterredsys_refund') == 0) {
            $this->action = 'reset_filters';
        }

        if (Tools::isSubmit('submitFilterButtonredsys_transaction') && (int)Tools::getValue('submitFilterButtonredsys_transaction') == 0) {
            $this->action = 'reset_filters';
        }

        if (!Shop::isFeatureActive()) {
            $this->shopLinkType = '';
        } else {
            $this->shopLinkType = 'shop';
        }

        $redsys = new redsys();
        if (!$redsys->checkTable()) {
            $redsys->initSQLTpv();
        }
    }

    public function setMedia($isNewTheme = false)
    {
        $_path = _MODULE_DIR_.$this->module->name;
        $this->context->controller->addCSS($_path.'/views/css/redsys_admin.css');

        parent::setMedia($isNewTheme);
        $this->addJqueryPlugin(array('typewatch', 'fancybox', 'autocomplete'));

        $this->addJqueryUI('ui.button');
        $this->addJqueryUI('ui.sortable');
        $this->addJqueryUI('ui.droppable');

        $this->context->controller->addJS($_path.'/views/js/back.js');
        if (version_compare(_PS_VERSION_, '1.6', '>=')) {
            if ($this->display) {
                $this->context->controller->addJS($_path.'/views/js/tabs.js');
            }
        }
    }

    public function postProcess()
    {
        parent::postProcess();
    }

    public function initContent()
    {
        if ($this->action == 'select_delete') {
            $this->context->smarty->assign(array(
                'delete_form' => true,
                'url_delete' => htmlentities($_SERVER['REQUEST_URI']),
                'boxes' => $this->boxes,
            ));
        }

        if (!$this->can_add_tpv && !$this->display) {
            $this->informations[] = $this->l('You have to select a shop if you want to create a new TPV.');
        }

        $module = new Redsys();
        if ($this->action != 'new' && !Tools::isSubmit('updateredsystpv_configuration')) {
            if (Tools::isSubmit('submitRedsysModuleGlobalConfig')) {
                $form_values = $this->getGlobalConfigFormValues();
                foreach (array_keys($form_values) as $key) {
                    if ((version_compare(_PS_VERSION_, '1.6', '>=') ? Tools::strpos($key, '[]') > 0 : strpos($key, '[]') > 0)) {
                        $key = Tools::str_replace_once('[]', '', $key);
                        Configuration::updateValue($key, implode(';', Tools::getValue($key)));
                    } else {
                        Configuration::updateValue($key, Tools::getValue($key));
                    }
                }
                $this->content .= $module->displayConfirmation($this->l('Configuration saved successfully.'));
            }
        }

        if (!$this->display) {
            $this->content .= $this->renderGlobalConfigForm();
        }

        parent::initContent();

        if (!$this->display) {
            $redsys = new redsys();

            $this->content .= $this->context->smarty->fetch($this->module->getLocalPath().'/views/templates/admin/messages.tpl');

            $this->content .= $redsys->getTransactions(false, false);
            $this->content .= $redsys->getRefunds(false, false);
            $this->content .= $redsys->getIdentifiers();

            if (version_compare(_PS_VERSION_, '1.6', '>=')) {
                $this->context->smarty->assign(array(
                    'this_path'     => $this->module->getPathUri(),
                    'support_id'    => $redsys->addons_id_product,
                ));

                $available_iso_codes = array('en', 'es');
                $default_iso_code = 'en';
                $template_iso_suffix = in_array($this->context->language->iso_code, $available_iso_codes) ? $this->context->language->iso_code : $default_iso_code;
                $this->content .= $this->context->smarty->fetch($this->module->getLocalPath().'/views/templates/admin/company/information_'.$template_iso_suffix.'.tpl');
            }

            $this->context->smarty->assign(array(
                'content' => $this->content,
                'token' => $this->token,
            ));
        }
    }

    public function initToolbar()
    {
        parent::initToolbar();

        if (!$this->can_add_tpv) {
            unset($this->toolbar_btn['new']);
        } elseif (!$this->display) {
            $this->toolbar_btn['import'] = array(
                'href' => $this->context->link->getAdminLink('AdminImport', true).'&import_type=tpv',
                'desc' => $this->l('Import')
            );
        }
    }

    public function getList($id_lang, $orderBy = null, $orderWay = null, $start = 0, $limit = null, $id_lang_shop = null)
    {
        parent::getList($id_lang, $orderBy, $orderWay, $start, $limit, $id_lang_shop);
    }

    public function initToolbarTitle()
    {
        parent::initToolbarTitle();

        switch ($this->display) {
            case '':
            case 'list':
                array_pop($this->toolbar_title);
                $this->toolbar_title[] = $this->l('Manage Redsys Tpv');
                break;
            case 'view':
                if (($tpv = $this->loadObject(true)) && Validate::isLoadedObject($tpv)) {
                    array_pop($this->toolbar_title);
                    $this->toolbar_title[] = sprintf($this->l('TPV Information: %s'), $tpv->name.' - '.$tpv->number);
                }
                break;
            case 'add':
            case 'edit':
                array_pop($this->toolbar_title);
                if (($tpv = $this->loadObject(true)) && Validate::isLoadedObject($tpv)) {
                    $this->toolbar_title[] = sprintf($this->l('Editing TPV: %s'), $tpv->name.' - '.$tpv->number);
                } else {
                    $this->toolbar_title[] = $this->l('Creating a new TPV');
                }
                break;
        }
    }

    public function initPageHeaderToolbar()
    {
        parent::initPageHeaderToolbar();

        if (empty($this->display)) {
            $this->page_header_toolbar_btn['desc-module-back'] = array(
                'href' => 'index.php?controller=AdminModules&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back'),
                'icon' => 'process-icon-back'
            );
            $this->page_header_toolbar_btn['desc-module-new'] = array(
                'href' => 'index.php?controller='.$this->tabClassName.'&add'.$this->table.'&token='.Tools::getAdminTokenLite($this->tabClassName),
                'desc' => $this->l('New'),
                'icon' => 'process-icon-new'
            );
            $this->page_header_toolbar_btn['desc-module-translate'] = array(
                'href' => '#',
                'desc' => $this->l('Translate'),
                'modal_target' => '#moduleTradLangSelect',
                'icon' => 'process-icon-flag'
            );
        }

        if (!$this->can_add_tpv) {
            unset($this->page_header_toolbar_btn['desc-module-new']);
        }
    }

    public function initProcess()
    {
        parent::initProcess();

        if (Tools::isSubmit('changeClicktoPayVal') && $this->id_object) {
            if (isset($this->tabAccess['edit']) && $this->tabAccess['edit'] === '1' || version_compare(_PS_VERSION_, '1.7', '>=')) {
                $this->action = 'change_clicktopay_val';
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to edit this.');
            }
        } elseif (Tools::isSubmit('changeIupayVal') && $this->id_object) {
            if (isset($this->tabAccess['edit']) && $this->tabAccess['edit'] === '1' || version_compare(_PS_VERSION_, '1.7', '>=')) {
                $this->action = 'change_iupay_val';
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to edit this.');
            }
        } elseif (Tools::isSubmit('changeEnvironmentRealVal') && $this->id_object) {
            if (isset($this->tabAccess['edit']) && $this->tabAccess['edit'] === '1' || version_compare(_PS_VERSION_, '1.7', '>=')) {
                $this->action = 'change_environment_real_val';
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to edit this.');
            }
        }
    }

    public function renderList()
    {
        if ((Tools::isSubmit('delete'.$this->table)) && $this->tabAccess['delete'] === '1') {
            $this->tpl_list_vars = array(
                'delete_redsys_tpv' => true,
                'REQUEST_URI' => $_SERVER['REQUEST_URI'],
                'POST' => $_POST
            );
        }

        return parent::renderList();
    }

    public function renderForm()
    {
        if (!($tpv = $this->loadObject(true))) {
            return;
        }

        $types = $this->getTypes();
        $modes = $this->getModes();
        $price_options = $this->getOptions();

        $carriers = array();
        $zones = array();
        $countries = array();
        $suppliers = array();
        $manufacturers = array();
        $categories = array();
        $customers = array();
        $products = array();

        if (Shop::isFeatureActive()) {
            $currencies = Currency::getCurrenciesByIdShop($this->context->shop->id);
        } else {
            $currencies = Currency::getCurrencies();
        }

        if (version_compare(_PS_VERSION_, '1.7.6.0', '>=')) {
            foreach($currencies as &$currency) {
                if ($currency['numeric_iso_code'] == 0) {
                    $currency['iso_code_num'] = $this->module->getIsoCodeNumByIsoCode($currency['iso_code']);
                } else {
                    $currency['iso_code_num'] = $currency['numeric_iso_code'];
                }
                if (!$currency['name']) {
                    $currency['name'] = $currency['iso_code'];
                }
                unset($currency);
            }
        }

        $id_lang = (int)$this->context->language->id;
        $id_shop = (int)$this->context->shop->id;

        $carriers = array_merge($carriers, Carrier::getCarriers($id_lang, true, false, false, null, Carrier::ALL_CARRIERS));
        $countries = array_merge($countries, Country::getCountries((int)($id_lang)));
        $manufacturers = array_merge($manufacturers, Manufacturer::getManufacturers(false, (int)($id_lang), false));
        $zones = array_merge($zones, Zone::getZones());
        $suppliers = array_merge($suppliers, Supplier::getSuppliers(false, (int)($id_lang), false));
        $languages = Language::getLanguages(false, $id_shop);
        $groups = Group::getGroups($id_lang, true);

        $selected_categories = array();
        if ($tpv->categories != '') {
            if (json_decode($tpv->categories) !== false) {
                $selected_categories = json_decode($tpv->categories);
            } else {
                $selected_categories = explode(';', $tpv->categories);
            }
        }
        $image = _PS_TMP_IMG_DIR_.$tpv->id.'.'.$this->imageType;
        $image_url = ImageManager::thumbnail($image, $this->module->name.'_'.(int)$tpv->id.'.'.$this->imageType, 350, $this->imageType, true, true);
        $image_size = file_exists($image) ? filesize($image) / 1000 : false;

        $sca = array('0' => $this->l('No limit exception'), '1' => $this->l('100'), '2' => $this->l('250'));
        $list_sca = array();
        foreach ($sca as $key => $sca) {
            $list_sca[$key]['id'] = $key;
            $list_sca[$key]['value'] = $key;
            $list_sca[$key]['name'] = $sca;
        }

        $transactions = array('0' => $this->l('Authorization'), '1' => $this->l('Preauthorization'), '7' => $this->l('Authentication'));
        $list_transactions = array();
        foreach ($transactions as $key => $transaction) {
            $list_transactions[$key]['id'] = $key;
            $list_transactions[$key]['value'] = $key;
            $list_transactions[$key]['name'] = $transaction;
        }
        $payment_types = array('C' => $this->l('Card only'), 'z' => $this->l('Bizum'), ' ' => $this->l('All card methods'));

        $list_payment_types = array();
        foreach ($payment_types as $key => $payment_type) {
            $list_payment_types[$key]['id'] = $key;
            $list_payment_types[$key]['value'] = $key;
            $list_payment_types[$key]['name'] = $payment_type;
        }
        $sizes = array('100%' => 'col-md-12', '75%' => 'col-md-9', '50%' => 'col-md-6', '25%' => 'col-md-3');
        $list_sizes = array();
        foreach ($sizes as $key => $size) {
            $list_sizes[$key]['id'] = $size;
            $list_sizes[$key]['value'] = $size;
            $list_sizes[$key]['name'] = $key;
        }
        $integration_options = array($this->l('Redsys Redirection'), $this->l('Payment integrated - Width 100%'), $this->l('Payment integrated with Left Column'), $this->l('Payment integrated with Right Column'));
        $list_integration_options = array();
        foreach ($integration_options as $key => $integration_option) {
            $list_integration_options[$key]['id'] = $key;
            $list_integration_options[$key]['value'] = $key;
            $list_integration_options[$key]['name'] = $integration_option;
        }


        $this->multiple_fieldsets = true;
        $this->default_form_language = $this->context->language->id;

        $currency = new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));

        $this->fields_form[]['form'] = array(
            'legend' => array(
                'title' => $this->l('Redsys Virtual POS Configuration'),
                'icon' => 'icon-key'
            ),
            'input' => array(
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('Enabled'),
                    'name' => 'active',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Enable or disable this Virtual POS.')
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Payment type'),
                    'name' => 'payment_type',
                    'required' => false,
                    'col' => '6',
                    'class' => 'fixed-width-md',
                    'default_value' => $list_payment_types['C'],
                    'options' => array(
                        'query' => $list_payment_types,
                        'id' => 'value',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Select the payment type that you want to configure (Only card payment, card payment + Iupay or only Bizum payment method)')
                ),
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('Redsys Real Environment'),
                    'name' => 'environment_real',
                    'required' => true,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'environment_real_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'environment_real_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Enable or Disable Real Redsys Environment')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Name'),
                    'name' => 'name',
                    'required' => true,
                    'col' => '3',
                    'desc' => $this->l('Invalid characters:').' !&lt;&gt;,;?=+()@#"°{}_$%:'
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Number'),
                    'name' => 'number',
                    'required' => true,
                    'col' => '4',
                    'desc' => $this->l('Invalid characters:').' !&lt;&gt;,;?=+()@#"°{}_$%:'
                ),
                array(
                    'type' => 'text',
                    'prefix' => '<i class="icon-key"></i>',
                    'label' => $this->l('Encryption Key'),
                    'name' => 'encryption_key',
                    'col' => '5',
                    'required' => true,
                    'autocomplete' => false,
                    'desc' => $this->l('Encryption Key HMAC SHA256 32 characters')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Terminal'),
                    'name' => 'terminal',
                    'col' => '3',
                    'required' => true,
                    'autocomplete' => false,
                    'desc' => $this->l('Virtual POS terminal')
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Transaction Type'),
                    'name' => 'transaction_type',
                    'required' => true,
                    'col' => '5',
                    'default_value' => $list_transactions[1],
                    'class' => 'fixed-width-md',
                    'options' => array(
                        'query' => $list_transactions,
                        'id' => 'id',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Type of the transaction, Authorization -> usual real time transaction, Preauthorization -> Money blocked without charge and waiting for the confirmation of Preauthorization')
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Currency'),
                    'name' => 'currency',
                    'required' => true,
                    'col' => '4',
                    'default_value' => (int)$currency->id,
                    'class' => 'fixed-width-md',
                    'options' => array(
                        'query' => $currencies, //Currency::getCurrencies(),
                        'id' => 'iso_code_num',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Virtual POS currency')
                ),
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('Send SCA information (PSD2 compliance)'),
                    'name' => 'security_options',
                    'required' => true,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'security_options_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'security_options_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Enable to send the SCA information, required to compliance the new PSD2 European regulation')
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Exception SCA amount'),
                    'name' => 'excep_sca',
                    'required' => false,
                    'col' => '5',
                    'default_value' => $list_sca[0],
                    'class' => 'fixed-width-md',
                    'options' => array(
                        'query' => $list_sca,
                        'id' => 'id',
                        'name' => 'name'
                    ),
                    'desc' => sprintf($this->l('Enable if you want to set the amount to avoid the SCA authentication in orders with total lower than this amount (in %s)'), $currency->sign),
                ),
                array(
                    'type' => 'hidden',
                    'name' => 'position'
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'type' => 'submit',
            ),
        );

        $this->fields_form[]['form'] = array(
            'legend' => array(
                'title' => $this->l('Advanced Payment'),
                'icon' => 'icon-credit-card'
            ),
            'input' => array(
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('Advanced payment'),
                    'name' => 'advanced_payment',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'advanced_payment_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'advanced_payment_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Advanced payment')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Advanced payment percentage'),
                    'name' => 'advanced_percentage',
                    'col' => '1',
                    'class' => 'toggle_advanced_payment',
                    'suffix' => '%',
                    'desc' => $this->l('Advanced payment percentage')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Advanced payment text'),
                    'name' => 'advanced_payment_text',
                    'lang' => true,
                    'col' => 4,
                    'class' => 'toggle_advanced_payment',
                    'desc' => $this->l('Text to show in the advanced payment (in the Backoffice orders and the invoices with advanced payment)')
                ),
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('New state with Advance Payment orders'),
                    'name' => 'advanced_payment_state',
                    'required' => false,
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'advanced_payment_state_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'advanced_payment_state_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Assign new state with Advance Payment orders')
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'type' => 'submit',
            ),
        );

        $this->fields_form[]['form'] = array(
            'legend' => array(
                'title' => $this->l('Discounts and Fees'),
                'icon' => 'icon-link'
            ),
            'input' => array(
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('Enable Fee/Discount amount'),
                    'name' => 'fee_discount',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'fee_discount_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'fee_discount_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Enable Fee/Discount amount')
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Mode'),
                    'name' => 'mode',
                    'col' => '5',
                    'class' => 'toggle_fee_discount',
                    'options' => array(
                        'query' => $modes,
                        'id' => 'id',
                        'name' => 'name',
                        'default' => array(
                            'value' => '',
                            'label' => $this->l('-- Choose --')
                        )
                    ),
                    'desc' => $this->l('Select if you want to configure a Fee or a Discount'),
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Type'),
                    'name' => 'type',
                    'col' => '5',
                    'class' => 'toggle_fee_discount',
                    'options' => array(
                        'query' => $types,
                        'id' => 'id',
                        'name' => 'name',
                        'default' => array(
                            'value' => '',
                            'label' => $this->l('-- Choose --')
                        )
                    ),
                    'desc' => $this->l('Select the type that of Fee/Discount that you want to apply, Fix, Percentage or Fix + Percentage'),
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Order total percentage calculation'),
                    'name' => 'order_total',
                    'col' => '5',
                    'class' => 'toggle_fee_discount',
                    'options' => array(
                        'query' => $price_options,
                        'id' => 'id',
                        'name' => 'name',
                        'default' => array(
                            'value' => '',
                            'label' => $this->l('-- Choose --')
                        )
                    ),
                    'desc' => $this->l('Select the price from where you want to calculate the percentage of Fee/Discount'),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Fix'),
                    'name' => 'fix',
                    'class' => 'toggle_fee_discount',
                    'col' => '3',
                    'suffix' => $currency->sign,
                    'desc' => sprintf($this->l('Fee/Discount amount (%s)'), ($this->taxes_included) ? $this->l('taxes included') : $this->l('without taxes')),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Percentage'),
                    'name' => 'percentage',
                    'col' => '3',
                    'class' => 'toggle_fee_discount',
                    'suffix' => '%',
                    'desc' => $this->l('Percentage amount of Fee/Discount'),
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Tax rule'),
                    'name' => 'id_tax_rule',
                    'col' => '3',
                    'class' => 'toggle_fee_discount',
                    'options' => array(
                        'query' => array_merge(array(
                            array(
                                'id_tax_rules_group' => 0, 'name' => $this->l('Without taxes')
                            )
                        ), TaxRulesGroup::getTaxRulesGroups()),
                        'id' => 'id_tax_rules_group',
                        'name' => 'name',
                    ),
                    'desc' => $this->l('Select the tax rule to apply to the fee/discount. You can also select Without Taxes')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Minimum discount/fee to apply'),
                    'name' => 'minimum_amount',
                    'col' => '5',
                    'suffix' => $currency->sign,
                    'class' => 'toggle_fee_discount',
                    'default' => '0',
                    'desc' => $this->l('Set a minimum discount/fee to apply. If this value is 0 there\'s no minimum'),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Maximum discount/fee to apply'),
                    'name' => 'maximum_amount',
                    'col' => '5',
                    'suffix' => $currency->sign,
                    'class' => 'toggle_fee_discount',
                    'default' => '0',
                    'desc' => $this->l('Set a maximum result discount/fee to apply. If this value is 0 there\'s no maximum'),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Order total minimum to apply the discount/fee'),
                    'name' => 'min_order_amount',
                    'col' => '5',
                    'suffix' => $currency->sign,
                    'class' => 'toggle_fee_discount',
                    'default' => '0',
                    'desc' => $this->l('Select order total minimum to apply the discount/fee. For example: Appy the rule to the orders above 10'),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Order total maximum to apply the discount/fee'),
                    'name' => 'max_order_amount',
                    'col' => '5',
                    'suffix' => $currency->sign,
                    'class' => 'toggle_fee_discount',
                    'default' => '0',
                    'desc' => $this->l('Select order total maximum to apply the discount/fee. For example: Appy the discount/fee to the orders below 200'),
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'type' => 'submit',
            ),
        );


        $this->fields_form[]['form'] = array(
            'legend' => array(
                'title' => $this->l('Filter settings'),
                'icon' => 'icon-cogs'
            ),
            'input' => array(
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('Strict filter evaluation'),
                    'name' => 'strict_filters',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'strict_filters_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'strict_filters_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Disable if you want to evaluate the filters like: If one is true, the payment method is displayed')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Minimum amount'),
                    'name' => 'min_amount',
                    'lang' => false,
                    'col' => '3',
                    'suffix' => $currency->sign,
                    'default_value' => 0,
                    'desc' => $this->l('Minimum amount to activate this Virtual POS (value 0 means no minimum amount)')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Maximum amount'),
                    'name' => 'max_amount',
                    'lang' => false,
                    'col' => '3',
                    'suffix' => $currency->sign,
                    'default_value' => 0,
                    'desc' => $this->l('Maximum amount to activate this Virtual POS (value 0 means no maximum amount)')
                ),
                array(
                   'type'  => 'categories',
                   'label' => $this->l('Select Category(s)'),
                   'multiple' => true,
                   'name'  => 'categories',
                   'col' => '7',
                   'tree'  => array(
                        'id' => 'id_category',
                        'use_checkbox' => true,
                        'selected_categories' => $selected_categories,
                        ),
                    'desc' => $this->l('Select the Category(es) where the rule will be applied. If you don\'t select any value, the rule will be applied to all Categories'),
                ),
                array(
                    'type' => 'swap-custom',
                    'label' => $this->l('Select Customer group(s)'),
                    'name' => 'groups[]',
                    'class' => 'switch-customers',
                    'multiple' => true,
                    'search' => true,
                    'required' => false,
                    'col' => '7',
                    'options' => array(
                        'query' => $groups,
                        'id' => 'id_group',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Select the Customer Group(s) where the rule will be applied. If you don\'t select any value, the rule will be applied to all Groups'),
                ),
                array(
                    'type' => 'swap-custom',
                    'label' => $this->l('Carrier(s) allowed'),
                    'name' => 'carriers[]',
                    'multiple' => true,
                    'required' => false,
                    'search' => true,
                    'col' => '7',
                    'class' => 'switch-carriers',
                    'options' => array(
                        'query' => $carriers,
                        'id' => 'id_reference',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Carrier(s) with this payment option enabled')
                ),
                array(
                    'type' => 'swap-custom',
                        'label' => $this->l('Manufacturer(s) allowed'),
                    'name' => 'manufacturers[]',
                    'class' => 'switch_manufacturers',
                    'multiple' => true,
                    'search' => true,
                    'required' => false,
                    'col' => '7',
                    'options' => array(
                        'query' => $manufacturers,
                        'id' => 'id_manufacturer',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Manufacturer(s) with this payment option enabled')
                ),
                array(
                    'type' => 'swap-custom',
                    'label' => $this->l('Select Supplier(s)'),
                    'name' => 'suppliers[]',
                    'class' => 'switch-suppliers',
                    'multiple' => true,
                    'search' => true,
                    'required' => false,
                    'col' => '7',
                    'options' => array(
                        'query' => $suppliers,
                        'id' => 'id_supplier',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Select the Supplier(s) where the rule will be applied. If you don\'t select any value, the rule will be applied to all Suppliers'),
                ),
                array(
                    'type' => 'swap-custom',
                    'label' => $this->l('Currency(es)'),
                    'name' => 'currencies[]',
                    'class' => 'switch-currencies',
                    'multiple' => true,
                    'search' => true,
                    'required' => false,
                    'col' => '7',
                    'options' => array(
                        'query' => $currencies,
                        'id' => 'id_currency',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Currency(es) to apply this configuration'),
                ),
                array(
                    'type' => 'swap-custom',
                    'label' => $this->l('Select Language(s)'),
                    'name' => 'languages[]',
                    'class' => 'switch-languages',
                    'multiple' => true,
                    'search' => true,
                    'required' => false,
                    'col' => '7',
                    'options' => array(
                        'query' => $languages,
                        'id' => 'id_lang',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Select the Language(s) where the rule will be applied. If you don\'t select any value, the rule will be applied to all Languages'),
                ),
                array(
                    'type' => 'swap-custom',
                    'label' => $this->l('Country(s) allowed'),
                    'name' => 'countries[]',
                    'multiple' => true,
                    'search' => true,
                    'required' => false,
                    'col' => '7',
                    'class' => 'switch-countries',
                    'options' => array(
                        'query' => $countries,
                        'id' => 'id_country',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Country(s) with this payment option enabled')
                ),
                array(
                    'type' => 'swap-custom',
                    'label' => $this->l('Zone(s) allowed'),
                    'name' => 'zones[]',
                    'multiple' => true,
                    'search' => true,
                    'required' => false,
                    'col' => '7',
                    'class' => 'switch-zones',
                    'options' => array(
                        'query' => $zones,
                        'id' => 'id_zone',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Zone(s) with this payment option enabled')
                ),

            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'type' => 'submit',
            ),
        );

        $render_form_prcust = array();

        if (Configuration::get('REDSYS_USE_PRODUCTS')) {
            $render_form_prcust[] =
                array(
                    'type' => 'select',
                    'label' => $this->l('Select Product(s)'),
                    'name' => 'products[]',
                    'class' => 'multiple_select',
                    'multiple' => true,
                    'search' => true,
                    'required' => false,
                    'col' => '7',
                    'options' => array(
                        'query' => $products,
                        'id' => 'id_product',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Select the Product(s) where the rule will be applied. If you don\'t select any value, the rule will be applied to all Products'),
                );
        }

        if (Configuration::get('REDSYS_USE_CUSTOMERS')) {
            $render_form_prcust[] =
                array(
                    'type' => 'select',
                    'label' => $this->l('Select Customer(s)'),
                    'name' => 'customers[]',
                    'class' => 'multiple_select',
                    'multiple' => true,
                    'search' => true,
                    'required' => false,
                    'col' => '7',
                    'options' => array(
                        'query' => $customers,
                        'id' => 'id_customer',
                        'name' => 'email'
                    ),
                    'desc' => $this->l('Select the Customer(s) where the rule will be applied. If you don\'t select any value, the rule will be applied to all Customers'),
                );
        }

        foreach ($render_form_prcust as $f) {
            array_unshift($this->fields_form[3]['form']['input'], $f);
        }

        $this->fields_form[]['form'] = array(
            'legend' => array(
                'title' => $this->l('Design settings'),
                'icon' => 'icon-magic'
            ),
            'input' => array(
                array(
                    'type' => 'file',
                    'label' => $this->l('Payment image'),
                    'name' => 'logo',
                    'image' => $image_url ? $image_url : false,
                    'size' => $image_size,
                    'display_image' => true,
                    'col' => 6,
                    'desc' => $this->l('Upload a payment image for your Checkout page.')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Text in checkout'),
                    'name' => 'payment_text',
                    'lang' => true,
                    'col' => 4,
                    'desc' => $this->l('Text to show in Checkout Redsys payment method')
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Payment size'),
                    'name' => 'payment_size',
                    'required' => false,
                    'col' => '2',
                    'class' => 'fixed-width-md',
                    'default_value' => $list_sizes['100%'],
                    'options' => array(
                        'query' => $list_sizes,
                        'id' => 'value',
                        'name' => 'name'
                    )
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'type' => 'submit',
            ),
        );

        $this->fields_form[]['form'] = array(
            'legend' => array(
                'title' => $this->l('Payment and Configuration settings'),
                'icon' => 'icon-user'
            ),
            'input' => array(
                array(
                    'type' => 'select',
                    'label' => $this->l('Payment integrated in your store'),
                    'name' => 'integration',
                    'required' => false,
                    'col' => '3',
                    'default_value' => $list_integration_options[1],
                    'options' => array(
                        'query' => $list_integration_options,
                        'id' => 'value',
                        'name' => 'name'
                    ),
                    'desc' => $this->l('Select if you want to redirect to Redsys or display the payment gateway inside of your store with an iFrame')
                ),
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('Click to Pay'),
                    'name' => 'clicktopay',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'clicktopay_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'clicktopay_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Use Click to Pay in your Virtual POS')
                ),
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('Display advanced summary'),
                    'name' => 'advanced_summary',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'advanced_summary_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'advanced_summary_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Enable it if you like to show an advanced summary when the payment is OK and it returns to your store.')
                ),
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('SNI compatibility'),
                    'name' => 'ssl',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'ssl_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'ssl_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Are you using SSL in your Store? If the answer is "YES" active this option please')
                ),
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('If payment Redsys fails create the Order'),
                    'name' => 'payment_error',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'payment_error_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'payment_error_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Active this option if you want to create the Order with status "Payment Error" if the payment fails in Redsys')
                ),
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('Create the order before the payment'),
                    'name' => 'create_order',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'create_order_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'create_order_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Active this option if you want to create the Order before the payment process with the Status "Awaiting Payment" and when the payment is done, the Status change to "Payment Accepted"')
                ),
                array(
                    'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                    'label' => $this->l('Enable translation in payment process'),
                    'name' => 'enable_translation',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enable_translation_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'enable_translation_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'desc' => $this->l('Active this option if you want to show the Redsys payment process in the store language selected')
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'type' => 'submit',
            ),
        );

        if ($tpv->id) {
            $this->fields_value = array(
                'groups[]' => explode(';', $tpv->groups),
                'zones[]' => explode(';', $tpv->zones),
                'countries[]' => explode(';', $tpv->countries),
                'manufacturers[]' => explode(';', $tpv->manufacturers),
                'suppliers[]' => explode(';', $tpv->suppliers),
                'currencies[]' => explode(';', $tpv->currencies),
                'languages[]' => explode(';', $tpv->languages),
                'carriers[]' => explode(';', $tpv->carriers),
                'products[]' => explode(';', $tpv->products),
                'customers[]' => explode(';', $tpv->customers),
            );

            if (version_compare(_PS_VERSION_, '1.6', '<')) {
                $this->fields_value['categories[]'] = explode(';', $tpv->categories);
            }
        } else {
            //Initialize empty values
            $this->fields_value['groups[]'] = array();
            $this->fields_value['currencies[]'] = array();
            $this->fields_value['suppliers[]'] = array();
            $this->fields_value['manufacturers[]'] = array();
            $this->fields_value['categories[]'] = array();
            $this->fields_value['languages[]'] = array();
            $this->fields_value['currencies[]'] = array();
            $this->fields_value['carriers[]'] = array();
        }

        $this->content .= parent::renderForm();
        return;
    }

    protected function renderGlobalConfigForm()
    {
        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->module = new Redsys();
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);
        $helper->identifier = $this->identifier;
        $helper->currentIndex = self::$currentIndex;
        $helper->submit_action = 'submitRedsysModuleGlobalConfig';
        $helper->token = Tools::getAdminTokenLite($this->tabClassName);
        $helper->tpl_vars = array(
            'fields_value' => $this->getGlobalConfigFormValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getGlobalConfigForm()));
    }

    protected function getGlobalConfigForm()
    {
        $form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Global settings'),
                    'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'col' => 5,
                        'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                        'name' => 'REDSYS_USE_PRODUCTS',
                        'label' => $this->l('Enable products filter'),
                        'class' => 't',
                        'default_value' => true,
                        'desc' => (version_compare(_PS_VERSION_, '1.6', '<')) ? $this->l('Enable if you need to create configuration rules using the products filter') : '',
                        'hint' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? $this->l('Enable if you need to create configuration rules using the products filter') : '',
                        'values' => array(
                            array(
                                'id' => 'REDSYS_USE_PRODUCTS_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'REDSYS_USE_PRODUCTS_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'col' => 5,
                        'type' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'switch' : 'radio',
                        'name' => 'REDSYS_USE_CUSTOMERS',
                        'label' => $this->l('Enable customers filter'),
                        'class' => 't',
                        'default_value' => true,
                        'desc' => (version_compare(_PS_VERSION_, '1.6', '<')) ? $this->l('Enable if you need to create configuration rules using the customers filter') : '',
                        'hint' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? $this->l('Enable if you need to create configuration rules using the customers filter') : '',
                        'values' => array(
                            array(
                                'id' => 'REDSYS_USE_CUSTOMERS_on',
                                'value' => true,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'REDSYS_USE_CUSTOMERS_off',
                                'value' => false,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'type' => 'submit',
                    'class' => (version_compare(_PS_VERSION_, '1.6', '>=')) ? 'btn btn-default pull-right' : 'button big',
                    'name' => 'submitRedsysModuleGlobalConfig',
                ),
            ),
        );

        return $form;
    }

    protected function getGlobalConfigFormValues()
    {
        return array(
            'REDSYS_USE_PRODUCTS' => Configuration::get('REDSYS_USE_PRODUCTS'),
            'REDSYS_USE_CUSTOMERS' => Configuration::get('REDSYS_USE_CUSTOMERS'),
        );
    }


    public function renderView()
    {
        return parent::renderView();
    }
    public function processDelete()
    {
        parent::processDelete();
    }

    protected function processBulkDelete()
    {
        parent::processBulkDelete();
    }

    public function processAdd()
    {
        if (Tools::getValue('submitFormAjax')) {
            $this->redirect_after = false;
        }

        if ($this->_formValidations()) {
            $redsys_tpv = new RedsysTpv();
            $_POST['carriers'] = (!Tools::isSubmit('carriers')) ? '' : implode(';', Tools::getValue('carriers'));
            $_POST['countries'] = (!Tools::isSubmit('countries')) ? '' : implode(';', Tools::getValue('countries'));
            $_POST['zones'] = (!Tools::isSubmit('zones')) ? '' : implode(';', Tools::getValue('zones'));
            $_POST['manufacturers'] = (!Tools::isSubmit('manufacturers')) ? '' : implode(';', Tools::getValue('manufacturers'));
            $_POST['suppliers'] = (!Tools::isSubmit('suppliers')) ? '' : implode(';', Tools::getValue('suppliers'));
            $_POST['customers'] = (!Tools::isSubmit('customers')) ? '' : implode(';', Tools::getValue('customers'));
            $_POST['languages'] = (!Tools::isSubmit('languages')) ? '' : implode(';', Tools::getValue('languages'));
            $_POST['currencies'] = (!Tools::isSubmit('currencies')) ? '' : implode(';', Tools::getValue('currencies'));
            if (Tools::isSubmit('categories')) {
                $cats = Tools::getValue('categories');
                $_POST['categories'] = json_encode($cats);
            } else {
                $_POST['categories'] = 'all';
            }
            $_POST['position'] = $redsys_tpv->getHigherPosition() + 1;
        } else {
            $this->errors[] = Tools::displayError('An error occurred while trying to save add the new hosted TPV').'
                <b>'.$this->table.'</b> '.Tools::displayError('(cannot load object)');
        }

        return parent::processAdd();
    }

    public function processUpdate()
    {
        if (Validate::isLoadedObject($this->object)) {
            $this->_formValidations();
            if ($this->object) {
                $tpv = new RedsysTpv((int)$this->object->id);
            }
            if (Validate::isLoadedObject($tpv)) {
                $_POST['groups'] = (!Tools::getValue('groups')) ? '' : implode(';', Tools::getValue('groups'));
                $_POST['carriers'] = (!Tools::isSubmit('carriers')) ? '' : implode(';', Tools::getValue('carriers'));
                $_POST['countries'] = (!Tools::isSubmit('countries')) ? '' : implode(';', Tools::getValue('countries'));
                $_POST['zones'] = (!Tools::isSubmit('zones')) ? '' : implode(';', Tools::getValue('zones'));
                $_POST['manufacturers'] = (!Tools::isSubmit('manufacturers')) ? '' : implode(';', Tools::getValue('manufacturers'));
                $_POST['suppliers'] = (!Tools::isSubmit('suppliers')) ? '' : implode(';', Tools::getValue('suppliers'));
                $_POST['customers'] = (!Tools::isSubmit('customers')) ? '' : implode(';', Tools::getValue('customers'));
                $_POST['languages'] = (!Tools::isSubmit('languages')) ? '' : implode(';', Tools::getValue('languages'));
                $_POST['currencies'] = (!Tools::isSubmit('currencies')) ? '' : implode(';', Tools::getValue('currencies'));
                if (Tools::isSubmit('categories')) {
                    $cats = Tools::getValue('categories');
                    $_POST['categories'] = json_encode($cats);
                } else {
                    $_POST['categories'] = 'all';
                }
            }
        } else {
            $this->errors[] = Tools::displayError('An error occurred while loading the object.').'
                <b>'.$this->table.'</b> '.Tools::displayError('(cannot load object)');
        }
        parent::processUpdate();
    }

    protected function afterAdd($object)
    {
        $id_redsys_tpv = Tools::getValue('id_redsys_tpv');
        $this->afterUpdate($object, $id_redsys_tpv);
        return true;
    }

    protected function afterUpdate($object, $id_redsys_tpv = false)
    {
        if ($id_redsys_tpv) {
            $tpvconf = new RedsysTpv((int)$id_redsys_tpv);
        } else {
            $tpvconf = new RedsysTpv((int)$object->id);
        }

        if (Validate::isLoadedObject($tpvconf)) {
            $tpvconf->save();
        }
        return true;
    }

    private function _formValidations()
    {
        if (trim(Tools::getValue('name')) == '') {
            $this->validateRules();
            $this->errors[] = Tools::displayError($this->l('Field "Name" can not be empty.'));
            $this->display = 'edit';
        } else {
            return true;
        }
    }

    public function processSave()
    {
        return parent::processSave();
    }

    public function processChangeClicktoPayVal()
    {
        $tpv = new RedsysTpv($this->id_object);
        if (!Validate::isLoadedObject($tpv)) {
            $this->errors[] = Tools::displayError('An error occurred while updating Virtual POS information.');
        }
        $tpv->clicktopay = $tpv->clicktopay ? 0 : 1;
        if (!$tpv->update()) {
            $this->errors[] = Tools::displayError('An error occurred while updating Virtual POS information.');
        }
        Tools::redirectAdmin(self::$currentIndex.'&token='.$this->token);
    }

    public function processChangeIupayVal()
    {
        $tpv = new RedsysTpv($this->id_object);
        if (!Validate::isLoadedObject($tpv)) {
            $this->errors[] = Tools::displayError('An error occurred while updating Virtual POS information.');
        }
        $tpv->iupay = $tpv->iupay ? 0 : 1;
        if (!$tpv->update()) {
            $this->errors[] = Tools::displayError('An error occurred while updating customer information.');
        }
        Tools::redirectAdmin(self::$currentIndex.'&token='.$this->token);
    }

    public function processChangeEnvironmentRealVal()
    {
        $tpv = new RedsysTpv($this->id_object);
        if (!Validate::isLoadedObject($tpv)) {
            $this->errors[] = Tools::displayError('An error occurred while updating Virtual POS information.');
        }
        $tpv->environment_real = $tpv->environment_real ? 0 : 1;
        if (!$tpv->update()) {
            $this->errors[] = Tools::displayError('An error occurred while updating customer information.');
        }
        Tools::redirectAdmin(self::$currentIndex.'&token='.$this->token);
    }

    public function printClicktoPayIcon($value, $tpv)
    {
        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            return '<a class="list-action-enable '.($value ? 'action-enabled' : 'action-disabled').'" href="index.php?'.htmlspecialchars('tab=AdminRedsysTpv&id_redsys_tpv='.(int)$tpv['id_redsys_tpv'].'&changeClicktoPayVal&token='.Tools::getAdminTokenLite('AdminRedsysTpv')).'">
                '.($value ? '<img src="../img/admin/enabled.gif">' : '<img src="../img/admin/disabled.gif">').
            '</a>';
        } else {
            return '<a class="list-action-enable '.($value ? 'action-enabled' : 'action-disabled').'" href="index.php?'.htmlspecialchars('tab=AdminRedsysTpv&id_redsys_tpv='.(int)$tpv['id_redsys_tpv'].'&changeClicktoPayVal&token='.Tools::getAdminTokenLite('AdminRedsysTpv')).'">
                '.($value ? '<i class="icon-check"></i>' : '<i class="icon-remove"></i>').
            '</a>';
        }
    }

    public function printIupayIcon($value, $tpv)
    {
        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            return '<a class="list-action-enable '.($value ? 'action-enabled' : 'action-disabled').'" href="index.php?'.htmlspecialchars('tab=AdminRedsysTpv&id_redsys_tpv='.(int)$tpv['id_redsys_tpv'].'&changeIupayVal&token='.Tools::getAdminTokenLite('AdminRedsysTpv')).'">
                '.($value ? '<img src="../img/admin/enabled.gif">' : '<img src="../img/admin/disabled.gif">').
            '</a>';
        } else {
            return '<a class="list-action-enable '.($value ? 'action-enabled' : 'action-disabled').'" href="index.php?'.htmlspecialchars('tab=AdminRedsysTpv&id_redsys_tpv='.(int)$tpv['id_redsys_tpv'].'&changeIupayVal&token='.Tools::getAdminTokenLite('AdminRedsysTpv')).'">
                '.($value ? '<i class="icon-check"></i>' : '<i class="icon-remove"></i>').
            '</a>';
        }
    }

    public function printEnvironmentRealIcon($value, $tpv)
    {
        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            return '<a class="list-action-enable '.($value ? 'action-enabled' : 'action-disabled').'" href="index.php?'.htmlspecialchars('tab=AdminRedsysTpv&id_redsys_tpv='.(int)$tpv['id_redsys_tpv'].'&changeEnvironmentRealVal&token='.Tools::getAdminTokenLite('AdminRedsysTpv')).'">
                '.($value ? '<img src="../img/admin/enabled.gif">' : '<img src="../img/admin/disabled.gif">').
            '</a>';
        } else {
            return '<a class="list-action-enable '.($value ? 'action-enabled' : 'action-disabled').'" href="index.php?'.htmlspecialchars('tab=AdminRedsysTpv&id_redsys_tpv='.(int)$tpv['id_redsys_tpv'].'&changeEnvironmentRealVal&token='.Tools::getAdminTokenLite('AdminRedsysTpv')).'">
                '.($value ? '<i class="icon-check"></i>' : '<i class="icon-remove"></i>').
            '</a>';
        }
    }

    protected function afterImageUpload()
    {
        $res = true;

        /* Generate image with differents size */
        if (($id_tpv = (int)Tools::getValue('id_redsys_tpv')) && isset($_FILES) && count($_FILES) && file_exists(_PS_TMP_IMG_DIR_.$id_tpv.'.'.$this->imageType)) {
            $current_logo_file = _PS_TMP_IMG_DIR_.'redsys_tpv_mini_'.$id_tpv.'_'.$this->context->shop->id.'.'.$this->imageType;
            if ($res && file_exists($current_logo_file)) {
                unlink($current_logo_file);
            }
            ImageManager::thumbnail(_PS_TMP_IMG_DIR_.$id_tpv.'.'.$this->imageType, $this->module->name.'_'.$id_tpv.'.'.$this->imageType, 350, $this->imageType, true, true);
        }
        if (!$res) {
            $this->errors[] = Tools::displayError('Unable to resize one or more of your pictures.');
        }
        return $res;
    }

    public function displayDeleteLink($token = null, $id, $name = null)
    {
        $tpl = $this->createTemplate('helpers/list/list_action_delete.tpl');

        $tpl->assign(array(
            'href' => self::$currentIndex.'&'.$this->identifier.'='.$id.'&delete'.$this->table.'&token='.($token != null ? $token : $this->token),
            'confirm' => $this->l('Delete the selected item?').$name,
            'action' => $this->l('Delete'),
            'id' => $id,
        ));
        return $tpl->fetch();
    }

    public function getCarriers($ids_carriers)
    {
        if ($ids_carriers === '') {
            return $this->l('All');
        }
        $carriers = array();
        $carriers_array = explode(';', $ids_carriers);
        foreach ($carriers_array as $key => $carrier) {
            if ($key == $this->top_elements_in_list) {
                $carriers[] = $this->l('...and more');
                break;
            }
            $carrier = new Carrier($carrier, $this->context->language->id);
            $carriers[] = $carrier->name;
        }
        return implode('<br />', $carriers);
    }

    public function getCurrencies($ids_currencies)
    {
        $redsys = new Redsys();

        if ($ids_currencies === '') {
            return $this->l('All');
        }
        $currencies = array();
        $currencies_array = explode(';', $ids_currencies);
        foreach ($currencies_array as $key => $currency) {
            if ($key == $this->top_elements_in_list) {
                $currencies[] = $this->l('...and more');
                break;
            }
            $currency = new Currency($redsys->getIdByIsoCodeNum($currency, $this->context->shop->id));
            $currencies[] = $currency->iso_code;
        }
        return implode('<br />', $currencies);
    }

    public function getCountries($ids_countries)
    {
        if ($ids_countries === '') {
            return $this->l('All');
        }
        $countries = array();
        $countries_array = explode(';', $ids_countries);
        foreach ($countries_array as $key => $country) {
            if ($key == $this->top_elements_in_list) {
                $countries[] = $this->l('...and more');
                break;
            }
            $country = new Country($country, $this->context->language->id);
            $countries[] = $country->name;
        }
        return implode('<br />', $countries);
    }

    public function getZones($ids_zones)
    {
        if ($ids_zones === '') {
            return $this->l('All');
        }
        $zones = array();
        $zones_array = explode(';', $ids_zones);
        foreach ($zones_array as $key => $zone) {
            if ($key == $this->top_elements_in_list) {
                $zones[] = $this->l('...and more');
                break;
            }
            $zone = new Zone($zone, $this->context->language->id);
            $zones[] = $zone->name;
        }
        return implode('<br />', $zones);
    }

    public static function printGoToCustomerButton($id_customer)
    {
        $customer = new Customer($id_customer);
        if ($customer->id) {
            $tpl = Context::getContext()->smarty->createTemplate('helpers/list/list_action_view.tpl');
            $tpl->assign(array(
                'href' => Context::getContext()->link->getAdminLink('AdminCustomers').'&viewcustomer&id_customer='.(int)$id_customer,
                'action' => $id_customer.' - '.$customer->firstname.' '.$customer->lastname,
                'id' => $id_customer,
            ));

            return $tpl->fetch();
        } else {
            return $id_customer;
        }
    }

    public function printGoToOrderButton($id_order)
    {
        if ($id_order > 0) {
            $tpl = Context::getContext()->smarty->createTemplate('helpers/list/list_action_view.tpl');
            $tpl->assign(array(
                'href' => Context::getContext()->link->getAdminLink('AdminOrders').'&id_order='.(int)$id_order.'&vieworder',
                'action' => $id_order,
                'id' => $id_order,
            ));
            return $tpl->fetch();
        } else {
            return $this->l('No order');
        }
    }

    private function _createTemplate($tpl_name)
    {
        if ($this->override_folder) {
            if ($this->context->controller instanceof ModuleAdminController) {
                $override_tpl_path = $this->context->controller->getTemplatePath().$tpl_name;
            } elseif ($this->module) {
                $override_tpl_path = _PS_MODULE_DIR_.$this->module->name.'/views/templates/admin/'.$tpl_name;
            } else {
                if (file_exists($this->context->smarty->getTemplateDir(1).DIRECTORY_SEPARATOR.$this->override_folder.$this->base_folder.$tpl_name)) {
                    $override_tpl_path = $this->context->smarty->getTemplateDir(1).DIRECTORY_SEPARATOR.$this->override_folder.$this->base_folder.$tpl_name;
                } elseif (file_exists($this->context->smarty->getTemplateDir(0).DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.$this->override_folder.$this->base_folder.$tpl_name)) {
                    $override_tpl_path = $this->context->smarty->getTemplateDir(0).'controllers'.DIRECTORY_SEPARATOR.$this->override_folder.$this->base_folder.$tpl_name;
                }
            }
        } else if ($this->module) {
            $override_tpl_path = _PS_MODULE_DIR_.$this->module->name.'/views/templates/admin/'.$tpl_name;
        }
        if (isset($override_tpl_path) && file_exists($override_tpl_path)) {
            return $this->context->smarty->createTemplate($override_tpl_path, $this->context->smarty);
        } else {
            return $this->context->smarty->createTemplate($tpl_name, $this->context->smarty);
        }
    }

    private function _setFilters()
    {
        $this->_filters = array(
            'filter_position' => (string)Tools::getValue($this->module->name.'Filter_position'),
        );
    }

    public function getResponseDescription($value, $transaction)
    {
        $redsys = new Redsys();
        $description = $redsys->l('OK');
        if ((int)$value > 99) {
            $description = $redsys->getResponseDescription($value);
        } elseif ($transaction['transaction_type'] == '1') {
            $description = $this->l('Preauthorization OK');
        } elseif ($transaction['transaction_type'] == '7') {
            $description = $this->l('Authentication OK');
        }
        $context = Context::getContext();
        $context->smarty->assign(array(
            'value' => $value,
            'description' => $description
        ));
        return $context->smarty->fetch(_PS_MODULE_DIR_.'redsys/views/templates/admin/response_description_tooltip.tpl');
    }

    public function getTransactionTypeName($value)
    {
        switch ($value) {
            case '0':
                return $this->l('Authorization');
                break;
            case '1':
                return $this->l('Preauthorization');
                break;
            case '7':
                return $this->l('Authentication');
                break;
            default:
                return $this->l('Authorization');
                break;
        }
    }

    public function getTPVName($id_tpv)
    {
        $tpv = new RedsysTpv($id_tpv);

        if (Validate::isLoadedObject($tpv))
            return $tpv->name;
        else {
            return $this->l('No TPV with id: ').$id_tpv;
        }
    }

    public function getExpiryDateFormatted($expiry_date)
    {
        $redsys = new Redsys();
        return $redsys->formatExpiryDate($expiry_date);
    }

    public function getCurrencyName($id_currency)
    {
        $redsys = new Redsys();
        $currency = new Currency($redsys->getIdByIsoCodeNum($id_currency, $this->context->shop->id));
        return $currency->iso_code;
    }

    public function ajaxProcessUpdatePositions()
    {
        $way = (int)(Tools::getValue('way'));
        $id_tpv = (int)(Tools::getValue('id'));
        $positions = Tools::getValue($this->table);

        foreach ($positions as $position => $value) {
            $pos = explode('_', $value);

            if (isset($pos[2]) && (int)$pos[2] === $id_tpv) {
                if ($redsystpv = new RedsysTpv((int)$pos[2])) {
                    if (isset($position) && $redsystpv->updatePosition($way, $position)) {
                        echo 'ok position '.(int)$position.' for tpv '.(int)$pos[1].'\r\n';
                    } else {
                        echo '{"hasError" : true, "errors" : "Can not update tpv '.(int)$id_tpv.' to position '.(int)$position.' "}';
                    }
                } else {
                    echo '{"hasError" : true, "errors" : "This tpv ('.(int)$id_tpv.') can not be loaded"}';
                }

                break;
            }
        }
    }

    protected function getTypes()
    {
        $types = array($this->l('Fix'), $this->l('Percentage'), $this->l('Fix + Percentage'));

        $list_types = array();
        foreach ($types as $key => $type) {
            $list_types[$key]['id'] = $key;
            $list_types[$key]['value'] = $key;
            $list_types[$key]['name'] = $type;
        }
        return $list_types;
    }

    protected function getModes()
    {
        $modes = array($this->l('Fee'), $this->l('Discount'));

        $list_modes = array();
        foreach ($modes as $key => $mode) {
            $list_modes[$key]['id'] = $key;
            $list_modes[$key]['value'] = $key;
            $list_modes[$key]['name'] = $mode;
        }
        return $list_modes;
    }

    public function getOptions()
    {
        $price_options = array($this->l('Order Total without taxes'), $this->l('Order Total with taxes'));

        $list_price_options = array();
        foreach ($price_options as $key => $mode) {
            $list_price_options[$key]['id'] = $key;
            $list_price_options[$key]['value'] = $key;
            $list_price_options[$key]['name'] = $mode;
        }
        return $list_price_options;
    }

    protected function getProductsLite($id_lang, $only_active = false, $front = false, Context $context = null)
    {
        if (!$context)
            $context = Context::getContext();

        $sql = 'SELECT p.`id_product`, CONCAT(p.`reference`, " - ", pl.`name`) as name FROM `'._DB_PREFIX_.'product` p
                '.Shop::addSqlAssociation('product', 'p').'
                LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` '.Shop::addSqlRestrictionOnLang('pl').')
                WHERE pl.`id_lang` = '.(int)$id_lang.
                    ($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '').
                    ($only_active ? ' AND product_shop.`active` = 1' : '');

        $rq = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        return ($rq);
    }
}