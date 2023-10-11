<?php
/**
* Card payment Redsys virtual POS

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
if (!defined('_CAN_LOAD_FILES_')) {
    exit;
}

if (!class_exists("RedsysAPI")) {
    include_once(dirname(__FILE__).'/api/apiRedsys.php');
}

if (!class_exists("idnovateUtils")) {
    include_once(dirname(__FILE__).'/api/idnovateUtils.php');
}

include_once(dirname(__FILE__).'/classes/RedsysTpv.php');

class Redsys extends PaymentModule
{
    const DEBUG_MODE = true;

    protected $_postErrors = array();
    protected $_success = false;
    protected $list_no_link = false;
    protected $_default_pagination = 10;
    public $url_test_ws = 'https://sis-t.redsys.es:25443/sis/services/SerClsWSEntrada';
    public $url_real_ws = 'https://sis.redsys.es/sis/services/SerClsWSEntrada';

    protected static $isoCodeNums = array(
            'AED' => '784', 'AFN' => '971', 'ALL' => '008', 'AMD' => '051', 'ANG' => '532', 'AOA' => '973', 'ARS' => '032', 'AUD' => '036', 'AWG' => '533', 'AZN' => '944', 'BAM' => '977', 'BBD' => '052', 'BDT' => '050', 'BGN' => '975',
            'BHD' => '048', 'BIF' => '108', 'BMD' => '060', 'BND' => '096', 'BOB' => '068', 'BOV' => '984', 'BRL' => '986', 'BSD' => '044', 'BTN' => '064', 'BWP' => '072', 'BYN' => '933', 'BZD' => '084', 'CAD' => '124', 'CDF' => '976',
            'CHE' => '947', 'CHF' => '756', 'CHW' => '948', 'CLF' => '990', 'CLP' => '152', 'CNY' => '156', 'COP' => '170', 'COU' => '970', 'CRC' => '188', 'CUC' => '931', 'CUP' => '192', 'CVE' => '132', 'CZK' => '203', 'DJF' => '262',
            'DKK' => '208', 'DOP' => '214', 'DZD' => '012', 'EGP' => '818', 'ERN' => '232', 'ETB' => '230', 'EUR' => '978', 'FJD' => '242', 'FKP' => '238', 'GBP' => '826', 'GEL' => '981', 'GHS' => '936', 'GIP' => '292', 'GMD' => '270',
            'GNF' => '324', 'GTQ' => '320', 'GYD' => '328', 'HKD' => '344', 'HNL' => '340', 'HRK' => '191', 'HTG' => '332', 'HUF' => '348', 'IDR' => '360', 'ILS' => '376', 'INR' => '356', 'IQD' => '368', 'IRR' => '364', 'ISK' => '352',
            'JMD' => '388', 'JOD' => '400', 'JPY' => '392', 'KES' => '404', 'KGS' => '417', 'KHR' => '116', 'KMF' => '174', 'KPW' => '408', 'KRW' => '410', 'KWD' => '414', 'KYD' => '136', 'KZT' => '398', 'LAK' => '418', 'LBP' => '422',
            'LKR' => '144', 'LRD' => '430', 'LSL' => '426', 'LYD' => '434', 'MAD' => '504', 'MDL' => '498', 'MGA' => '969', 'MKD' => '807', 'MMK' => '104', 'MNT' => '496', 'MOP' => '446', 'MRU' => '929', 'MUR' => '480', 'MVR' => '462',
            'MWK' => '454', 'MXN' => '484', 'MXV' => '979', 'MYR' => '458', 'MZN' => '943', 'NAD' => '516', 'NGN' => '566', 'NIO' => '558', 'NOK' => '578', 'NPR' => '524', 'NZD' => '554', 'OMR' => '512', 'PAB' => '590', 'PEN' => '604',
            'PGK' => '598', 'PHP' => '608', 'PKR' => '586', 'PLN' => '985', 'PYG' => '600', 'QAR' => '634', 'RON' => '946', 'RSD' => '941', 'RUB' => '643', 'RWF' => '646', 'SAR' => '682', 'SBD' => '090', 'SCR' => '690', 'SDG' => '938',
            'SEK' => '752', 'SGD' => '702', 'SHP' => '654', 'SLL' => '694', 'SOS' => '706', 'SRD' => '968', 'SSP' => '728', 'STN' => '930', 'SVC' => '222', 'SYP' => '760', 'SZL' => '748', 'THB' => '764', 'TJS' => '972', 'TMT' => '934',
            'TND' => '788', 'TOP' => '776', 'TRY' => '949', 'TTD' => '780', 'TWD' => '901', 'TZS' => '834', 'UAH' => '980', 'UGX' => '800', 'USD' => '840', 'USN' => '997', 'UYI' => '940', 'UYU' => '858', 'UYW' => '927', 'UZS' => '860',
            'VND' => '704', 'VUV' => '548', 'WST' => '882', 'XAF' => '950', 'XAG' => '961', 'XAU' => '959', 'XBA' => '955', 'XBB' => '956', 'XBC' => '957', 'XBD' => '958', 'XCD' => '951', 'XDR' => '960', 'XOF' => '952', 'XPD' => '964',
            'XPF' => '953', 'XPT' => '962', 'XSU' => '994', 'XTS' => '963', 'XUA' => '965', 'XXX' => '999', 'YER' => '886', 'ZAR' => '710', 'ZMW' => '967', 'ZWL' => '932',
        );

    public function __construct($id_lang = null)
    {
        $this->name = 'redsys';
        $this->tab = 'payments_gateways';
        $this->version = '4.0.5';
        $this->module_key = 'f60e7d4f99b68f0ebdcdefd210c9a73f';
        $this->author = 'idnovate';
        $this->addons_id_product = '6492';
        $this->module_path = $this->_path;
        $this->bootstrap = true;
        $this->imageType = 'png';
        $this->bizumDisplayName = $this->l('Bizum - Online payment');

        $this->tabs[] = array(
                'class_name' => 'AdminRedsysTpv',
                'name' => 'Admin TPV Redsys',
                'visible' => false
            );

        $this->tabs[] = array(
                'class_name' => 'AdminRedsysManagement',
                'name' => 'Redsys Management',
                'visible' => false
            );

        $this->tabs[] = array(
                'class_name' => 'AdminRefund',
                'name' => 'Admin TPV Redsys',
                'visible' => false
            );

        $this->tabClassName = 'AdminRedsysTpv';
        $this->tabClassNameManage = 'AdminRedsysManagement';

        parent::__construct();

        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            $this->displayName = $this->l('Card payment REDSYS Virtual POS', false, $id_lang);
        } else {
            $this->displayName = $this->l('Card payment REDSYS Virtual POS');
        }
        $this->description = $this->l('Multicommerce, multiterminal and multicurrency support for card payments with REDSYS platform');
        $this->confirmUninstall = $this->l('Are you sure you want to delete the module and the related data?');

        /* Backward compatibility */
        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            require(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php');
            $this->local_path = _PS_MODULE_DIR_.$this->name.'/';
        }

        // aditional controls (ship to pay active, default country disabled, mcrypt disabled
        $warnings = array();

        if (Module::isInstalled('shiptopay')) {
            $warnings[] = $this->l('You have installed the module Ship to Pay, remember that you have to configure our Redsys payment method with your delivery methods.');
        }

        if (!$this->context->country->active) {
            $warnings[] = $this->l('The default country configured in your Localization general options is not active, please active it in "LOCALIZATION - COUNTRIES"');
        }

        if (version_compare(phpversion(), '7', '<')) {
            if (!function_exists("mcrypt_encrypt")) {
                $warnings[] = $this->l('Your mcrypt library is disabled, please contact with your hosting and enable it.');
            }
        }

        if (version_compare(_PS_VERSION_, '1.7.6.0', '<')) {
            if (!$this->isZeroAnyIsoCodeCurrency()) {
                $warnings[] = $this->l('One of your Store currencies have an ISO Code Number 0, please check it to set the correct ISO Code Number.');
            }
        }

        if (version_compare(_PS_VERSION_, '1.6', '>=')) {
            if (Configuration::get('PS_DISABLE_NON_NATIVE_MODULE')) {
                $this->warning = $this->l('You have to disable the option: Disable non native PrestaShop modules at "ADVANCED PARAMETERS - PERFORMANCE"');
            }

            if (Configuration::get('PS_DISABLE_OVERRIDES')) {
                $this->warning = $this->l('You have to disable the option: Disable all overrides at "ADVANCED PARAMETERS - PERFORMANCE"');
            }
        }

        if (count($warnings) > 0) {
            $this->warning = implode(" - ", $warnings);
        }

        $this->setFilters();
    }

    public function copyOverrideFolder()
    {
        $version_override_folder = _PS_MODULE_DIR_.$this->name.'/override_'.Tools::substr(str_replace('.', '', _PS_VERSION_), 0, 2);
        $override_folder = _PS_MODULE_DIR_.$this->name.'/override';

        if (file_exists($override_folder) && is_dir($override_folder)) {
            $this->recursiveRmdir($override_folder);
        }

        if (is_dir($version_override_folder)) {
            $this->copyDir($version_override_folder, $override_folder);
        }

        return true;
    }

    protected function copyDir($src, $dst)
    {
        if (is_dir($src)) {
            $dir = opendir($src);
            @mkdir($dst);
            while (false !== ($file = readdir($dir))) {
                if (($file != '.') && ($file != '..')) {
                    if (is_dir($src.'/'.$file)) {
                        $this->copyDir($src.'/'.$file, $dst.'/'.$file);
                    } else {
                        copy($src.'/'.$file, $dst.'/'.$file);
                    }
                }
            }
            closedir($dir);
        }
    }

    public function recursiveRmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir"){
                        $this->recursiveRmdir($dir."/".$object);
                    }else{
                        unlink($dir."/".$object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    public function install($delete_params = true)
    {
        Configuration::updateValue('REDSYS_AWAITING_PAYMENT_REDSYS', $this->createOrderStateAwaiting(Configuration::get('REDSYS_AWAITING_PAYMENT_REDSYS')));
        Configuration::updateValue('REDSYS_ADVANCED_PAYMENT_STATE', $this->createOrderStateAdvancedPayment(Configuration::get('REDSYS_ADVANCED_PAYMENT_STATE')));
        Configuration::updateValue('REDSYS_AWAITING_CONFIRMATION', $this->createOrderStateAwaitingConfirmation(Configuration::get('REDSYS_AWAITING_CONFIRMATION')));
        Configuration::updateValue('REDSYS_CHECKING_REDSYS', $this->createOrderStateChecking(Configuration::get('REDSYS_CHECKING_REDSYS')));

        $this->copyOverrideFolder();

        if (!parent::install()
            || !$this->installTabs()
            || !$this->registerHook('displayHeader')
            || !$this->registerHook('payment')
            || !$this->registerHook('displayPaymentReturn')
            || !$this->registerHook('adminOrder')
            || !$this->registerHook('displayAdminOrder')
            || !$this->registerHook('actionAdminControllerSetMedia')
            || !$this->registerHook('displayOrderDetail')
            || !$this->registerHook('displayCustomerAccount')
            || !$this->registerHook('actionValidateOrder')
            || !$this->registerHook('displayPDFInvoice')

            || ($delete_params && (!Configuration::updateValue('REDSYS_ENVIRONMENT_REAL', '0')
                || !Configuration::updateValue('REDSYS_PAGO_ERROR', 1)
                || !Configuration::updateValue('REDSYS_CLICKTOPAY', 0)
                || !Configuration::updateValue('REDSYS_INTEGRATION', 0)
                || !Configuration::updateValue('REDSYS_IUPAY', 0)
                || !Configuration::updateValue('REDSYS_CREATE_ORDER', 0)
                || !Configuration::updateValue('REDSYS_SSL', 0)
                || !Configuration::updateValue('REDSYS_IDIOMAS_ESTADO', 0)
                || !Configuration::updateValue('REDSYS_ENCRYPTION_KEY', '')
                || !Configuration::updateValue('REDSYS_NAME', '')
                || !Configuration::updateValue('REDSYS_NUMBER', '')
                || !Configuration::updateValue('REDSYS_TERMINAL', '')
                || !Configuration::updateValue('REDSYS_CURRENCY', '')
                || !Configuration::updateValue('REDSYS_TRANSACTION_TYPE', 0)
                || !Configuration::updateValue('REDSYS_ACTIVE_REDSYS', 1)
                || !Configuration::updateValue('REDSYS_MIN_AMOUNT', 0)
                || !Configuration::updateValue('REDSYS_MAX_AMOUNT', 0)
                || !Configuration::updateValue('REDSYS_PAYMENT_TYPE', 'C')
                || !Configuration::updateValue('REDSYS_PAYMENT_TEXT', '')
                || !Configuration::updateValue('REDSYS_PAYMENT_SIZE', 'col-md-12')
                || !Configuration::updateValue('REDSYS_LOGO', '')
                || !$this->initSQLTransactions()
                || !$this->initSQLRefunds()
                || !$this->initSQLTpv()))) {
            return false;
        }

        if (version_compare(_PS_VERSION_, '1.7', '<') && version_compare(_PS_VERSION_, '1.4', '>')) {
            $this->registerHook('displayPaymentEU');
        }

        if (version_compare(_PS_VERSION_, '1.7', '>=')) {
            $this->registerHook('paymentOptions');
        }

        return true;
    }

    public function uninstall($delete_params = true)
    {
        if (parent::uninstall()
            && $this->uninstallTabs()
            && (!$delete_params ||
                ($this->uninstallSQL()
                    && Configuration::deleteByName('REDSYS_ENVIRONMENT_REAL')
                    && Configuration::deleteByName('REDSYS_NAME')
                    && Configuration::deleteByName('REDSYS_NUMBER')
                    && Configuration::deleteByName('REDSYS_ENCRYPTION_KEY')
                    && Configuration::deleteByName('REDSYS_TERMINAL')
                    && Configuration::deleteByName('REDSYS_TRANSACTION_TYPE')
                    && Configuration::deleteByName('REDSYS_CURRENCY')
                    && Configuration::deleteByName('REDSYS_CREATE_ORDER')
                    && Configuration::deleteByName('REDSYS_SSL')
                    && Configuration::deleteByName('REDSYS_ENABLE_TRANSLATION')
                    && Configuration::deleteByName('REDSYS_PAYMENT_ERROR')
                    && Configuration::deleteByName('REDSYS_ACTIVE_REDSYS')
                    && Configuration::deleteByName('REDSYS_INTEGRATION')
                    && Configuration::deleteByName('REDSYS_PAYMENT_SIZE')
                    && Configuration::deleteByName('REDSYS_PAYMENT_TYPE')
                    && Configuration::deleteByName('REDSYS_CLICKTOPAY')
                    && Configuration::deleteByName('REDSYS_IUPAY')
                    && Configuration::deleteByName('REDSYS_MIN_AMOUNT')
                    && Configuration::deleteByName('REDSYS_MAX_AMOUNT')
                    && Configuration::deleteByName('REDSYS_LOGO')
                    && Configuration::deleteByName('REDSYS_PAYMENT_SIZE')
                    && Configuration::deleteByName('REDSYS_PAYMENT_TEXT'))
                )) {
            return true;
        }
        return false;
    }

    public function getContent()
    {
        foreach ($this->tabs as $myTab) {
            $id_tab = Tab::getIdFromClassName($myTab['class_name']);
            if (!$id_tab) {
                $this->addTab($myTab);
            }
        }

        $output = '';
        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            if (!empty($_POST)) {
                if (Tools::isSubmit('submitRedsys')) {
                    $output .= $this->_postValidation();
                    $output .= $this->_postProcess();
                }
                if (Tools::isSubmit('delete_image_submit')) {
                    Configuration::updateValue('REDSYS_LOGO', '');
                    $output .= $this->_postProcess();
                }
            }
            return  $output .= $this->renderForm14();
        } else {
            return Tools::redirectAdmin('index.php?controller=' . $this->tabClassName . '&token=' . Tools::getAdminTokenLite($this->tabClassName));
        }
    }

    protected function renderForm14()
    {
        $output = '';

        $helper = new Helper();

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(),
            'languages' => Language::getLanguages(false),
            'id_language' => $this->context->language->id,
            'THEME_LANG_DIR' => _PS_IMG_.'l/',
            'this_path' => $this->_path
        );

        $output .= $helper->generateForm($this->getConfigForm(), $this->name);
        $this->context->smarty->assign('this_path', $this->_path);
        return $output;
    }

    protected function getConfigForm()
    {
        $fields = array();

        $transactions = array($this->l('Authorization'), $this->l('Preauthorization'));
        $list_transactions = array();
        foreach ($transactions as $key => $transaction) {
            $list_transactions[$key]['id'] = $key;
            $list_transactions[$key]['value'] = $key;
            $list_transactions[$key]['name'] = $transaction;
        }

        $sizes = array( '100%' => 'col-md-12', '75%' => 'col-md-9', '50%' => 'col-md-6', '25%' => 'col-md-3' );
        $list_sizes = array();
        foreach (array_keys($sizes) as $key) {
            $list_sizes[$key]['id'] = $key;
            $list_sizes[$key]['value'] = $key;
            $list_sizes[$key]['name'] = $key;
        }

        $payment_types = array('C' => $this->l('Card only'));
        $list_payment_types = array();
        foreach ($payment_types as $key => $payment_type) {
            $list_payment_types[$key]['id'] = $key;
            $list_payment_types[$key]['value'] = $key;
            $list_payment_types[$key]['name'] = $payment_type;
        }

        $integration_options = array($this->l('Redsys Redirection'), $this->l('Payment integrated'));
        $list_integration_options = array();
        foreach ($integration_options as $key => $integration_option) {
            $list_integration_options[$key]['id'] = $key;
            $list_integration_options[$key]['value'] = $key;
            $list_integration_options[$key]['name'] = $integration_option;
        }

        $currencies = Currency::getCurrencies();
        $list_currencies = array();
        foreach ($currencies as $key => $currency) {
            $list_currencies[$key]['id'] = $currency['iso_code_num'];
            $list_currencies[$key]['value'] = $currency['iso_code_num'];
            $list_currencies[$key]['name'] = $currency['name'];
        }

        $fields[]['form'] = array(
            'legend' => array(
                'title' => $this->l('Redsys Tpv'),
                'icon' => 'icon-key'
            ),
            'input' => array(
                array(
                    'type' => 'switch',
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
                    'hint' => $this->l('Enable or Disable Real Redsys Environment')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Name'),
                    'name' => 'name',
                    'required' => true,
                    'col' => '3',
                    'hint' => $this->l('Invalid characters:').' !&lt;&gt;,;?=+()@#"°{}_$%:'
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Number'),
                    'name' => 'number',
                    'required' => true,
                    'col' => '2',
                    'hint' => $this->l('Invalid characters:').' !&lt;&gt;,;?=+()@#"°{}_$%:'
                ),
                array(
                    'type' => 'text',
                    'prefix' => '<i class="icon-key"></i>',
                    'label' => $this->l('Encryption Key'),
                    'name' => 'encryption_key',
                    'col' => '4',
                    'class' => 'encrypt',
                    'required' => true,
                    'autocomplete' => false,
                    'hint' => 'Encryption Key HMAC SHA256 32 characters'
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Terminal'),
                    'name' => 'terminal',
                    'col' => '1',
                    'required' => true,
                    'autocomplete' => false,
                    'hint' => 'Virtual POS terminal'
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Transaction Type'),
                    'name' => 'transaction_type',
                    'required' => true,
                    'col' => '4',
                    'class' => 'fixed-width-md',
                    'options' => array(
                        'query' => $list_transactions,
                        'id' => 'id',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Currency'),
                    'name' => 'currency',
                    'required' => true,
                    'col' => '4',
                    'class' => 'fixed-width-md',
                    'options' => array(
                        'query' => $list_currencies,
                        'id' => 'id',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Payment type'),
                    'name' => 'payment_type',
                    'required' => true,
                    'col' => '2',
                    'class' => 'fixed-width-md',
                    'default_value' => $list_payment_types['C'],
                    'options' => array(
                        'query' => $list_payment_types,
                        'id' => 'name',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'switch',
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
                    'hint' => $this->l('Use Click to Pay in your Virtual POS')
                ),
                array(
                    'type' => 'file',
                    'label' => $this->l('Payment image'),
                    'name' => 'logo',
                    'display_image' => true,
                    'col' => 6,
                    'hint' => $this->l('Upload a payment image for your Checkout page.')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Text in checkout'),
                    'name' => 'payment_text',
                    'lang' => true,
                    'col' => 4,
                    'hint' => $this->l('Text to show in Checkout Redsys payment method')
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Payment size'),
                    'name' => 'payment_size',
                    'required' => false,
                    'col' => '2',
                    'class' => 'fixed-width-md',
                    'options' => array(
                        'query' => $list_sizes,
                        'id' => 'name',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Payment integrated in your store'),
                    'name' => 'integration',
                    'required' => false,
                    'col' => '2',
                    'class' => 'fixed-width-md',
                    'options' => array(
                        'query' => $list_integration_options,
                        'id' => 'value',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Minimum amount'),
                    'name' => 'min_amount',
                    'lang' => false,
                    'col' => 1,
                    'hint' => $this->l('Minimum amount (by default Currency) to activate this Virtual POS (value 0 means no minimum amount)')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Maximum amount'),
                    'name' => 'max_amount',
                    'lang' => false,
                    'col' => 1,
                    'hint' => $this->l('Maximum amount (by default Currency) to activate this Virtual POS (value 0 means no maximum amount)')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Use SSL in the payment return'),
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
                    'hint' => $this->l('Are you using SSL in your Store? If the answer is "YES" active this option please')
                ),
                array(
                    'type' => 'switch',
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
                    'hint' => $this->l('Active this option if you want to create the Order with status "Payment Error" if the payment fails in Redsys')
                ),
                array(
                    'type' => 'switch',
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
                    'hint' => $this->l('Active this option if you want to create the Order before the payment process with the Status "Awaiting Payment" and when the payment is done, the Status change to "Payment Accepted"')
                ),
                array(
                    'type' => 'switch',
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
                    'hint' => $this->l('Active this option if you want to show the Redsys payment process in the store language selected')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Enabled'),
                    'name' => 'active_redsys',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'active_redsys_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'active_redsys_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                    'hint' => $this->l('Enable or disable this Virtual POS.')
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'type' => 'submit',
                'name' => 'submitRedsys',
            ),
        );

        return $fields;
    }

    protected function getConfigFormValues()
    {
        $fields = array();
        $fields = array_merge($this->getConfigValues(), $this->getLangConfigValues());

        return $fields;
    }

    protected function getLangConfigValues()
    {
        $fields = array();

        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            $fields['payment_text'][$lang['id_lang']] = Tools::getValue('payment_text_'.$lang['id_lang'], Configuration::get('REDSYS_PAYMENT_TEXT', $lang['id_lang']));
        }

        return $fields;
    }

    protected function getConfigValues()
    {

        $fields = array();

        $fields['environment_real'] = Tools::getValue('environment_real', Configuration::get('REDSYS_ENVIRONMENT_REAL'));
        $fields['name'] = Tools::getValue('name', Configuration::get('REDSYS_NAME'));
        $fields['number'] = Tools::getValue('number', Configuration::get('REDSYS_NUMBER'));
        $fields['encryption_key'] = Tools::getValue('encryption_key', Configuration::get('REDSYS_ENCRYPTION_KEY'));
        $fields['terminal'] = Tools::getValue('terminal', Configuration::get('REDSYS_TERMINAL'));
        $fields['transaction_type'] = Tools::getValue('transaction_type', Configuration::get('REDSYS_TRANSACTION_TYPE'));
        $fields['currency'] = Tools::getValue('currency', Configuration::get('REDSYS_CURRENCY'));
        $fields['clicktopay'] = Tools::getValue('clicktopay', Configuration::get('REDSYS_CLICKTOPAY'));
        $fields['payment_size'] = Tools::getValue('payment_size', Configuration::get('REDSYS_PAYMENT_SIZE'));
        $fields['payment_type'] = Tools::getValue('payment_type', Configuration::get('REDSYS_PAYMENT_TYPE'));
        $fields['integration'] = Tools::getValue('integration', Configuration::get('REDSYS_INTEGRATION'));
        $fields['min_amount'] = Tools::getValue('min_amount', Configuration::get('REDSYS_MIN_AMOUNT'));
        $fields['max_amount'] = Tools::getValue('max_amount', Configuration::get('REDSYS_MAX_AMOUNT'));

        $fields['countries'] = Tools::getValue('countries', Configuration::get('REDSYS_COUNTRIES'));
        $fields['zones'] = Tools::getValue('zones', Configuration::get('REDSYS_ZONES'));
        $fields['carriers'] = Tools::getValue('carriers', Configuration::get('REDSYS_CARRIERS'));

        $fields['ssl'] = Tools::getValue('ssl', Configuration::get('REDSYS_SSL'));
        $fields['payment_error'] = Tools::getValue('payment_error', Configuration::get('REDSYS_PAYMENT_ERROR'));
        $fields['create_order'] = Tools::getValue('create_order', Configuration::get('REDSYS_CREATE_ORDER'));
        $fields['enable_translation'] = Tools::getValue('enable_translation', Configuration::get('REDSYS_ENABLE_TRANSLATION'));
        $fields['active_redsys'] = Tools::getValue('active_redsys', Configuration::get('REDSYS_ACTIVE_REDSYS'));
        $fields['logo'] =  Tools::getValue('logo', Configuration::get('REDSYS_LOGO'));

        return $fields;
    }

    protected function _postProcess()
    {
        $output = '';
        $errors = array();

        $this->setFilters();

        if (!empty($_FILES) && !empty($_FILES['logo']['name'])) {
            $upload_path = 'redsys/views/img/';
            $upload_dir = _PS_MODULE_DIR_.$upload_path;
            $upload_file = $upload_dir . basename($_FILES['logo']['name']);

            $protocol = $this->getProtocolUrl();

            $image_url = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/'.$upload_path.basename($_FILES['logo']['name']);
            move_uploaded_file($_FILES['logo']['tmp_name'], $upload_file);
            Configuration::updateValue('REDSYS_LOGO', $image_url);
        }

        if (!Tools::getValue('currency')) {
            $errors[] = $this->l('You have to provide a currency.');
        }

        if (!Tools::getValue('encryption_key') || Tools::strlen(Tools::getValue('encryption_key')) != 32) {
            $errors[] = $this->l('You have to provide the encryption key and its may have 32 chars.');
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $output .= $this->displayError($error);
            }
        } else {
            $fields = array_merge($this->getConfigValues(), $this->getLangConfigValues());
            foreach (array_keys($fields) as $key) {
                Configuration::updateValue('REDSYS_'.Tools::strtoupper($key), $fields[$key]);
            }

            $output .= $this->displayConfirmation($this->l('Configuration saved successfully.'));
        }
        return $output;
    }

    protected function _postValidation()
    {
        //Tab Module Configuration
        if (Tools::isSubmit('submitRedsys')) {
            //If any of the fields for commerce is not empty
            $commerce = ' 1 - ';
            if (Tools::getValue('moneda')
                || Tools::getValue('clave')
                || Tools::getValue('nombre')
                || Tools::getValue('codigo')
                || Tools::getValue('terminal')) {
                if (!Tools::getValue('moneda')) {
                    $this->_postErrors[] = $this->l('Commerce configuration').$commerce.$this->l('Currency is required');
                }
                if (!Tools::getValue('clave')) {
                    $this->_postErrors[] = $this->l('Commerce configuration').$commerce.$this->l('Secret Key encryption is required');
                }
                if (!Tools::getValue('nombre')) {
                    $this->_postErrors[] = $this->l('Commerce configuration').$commerce.$this->l('Commerce name is required');
                }
                if (!Tools::getValue('codigo')) {
                    $this->_postErrors[] = $this->l('Commerce configuration').$commerce.$this->l('Commerce number (FUC) is required');
                }
                if (!Tools::getValue('terminal')) {
                    $this->_postErrors[] = $this->l('Commerce configuration').$commerce.$this->l('Terminal number is required');
                }
            }
        }

        if (!count($this->_postErrors)) {
            $this->_success = true;
        }
    }

    public function hookDisplayHeader()
    {
        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            Tools::addCSS($this->_path.'views/css/redsys.css', 'all');
        } else {
            $this->context->controller->addCSS($this->_path.'views/css/redsys.css', 'all');
        }

        if (Tools::strtolower(Tools::getValue('controller')) == 'cards') {
            if (version_compare(_PS_VERSION_, '1.5', '<')) {
                Tools::addJS(array(
                    _PS_MODULE_DIR_.'redsys/views/js/front.js',
                ));
            } elseif (version_compare(_PS_VERSION_, '1.7', '<')) {
                $this->context->controller->addJS(array(
                    $this->_path.'views/js/front.js',
                ));
            }
        }
        $this->context->controller->addJS(($this->_path).'views/js/front17.js');
    }

    public function hookDisplayCustomerAccount($params)
    {
        if (isset($params['cookie']) && isset($params['cookie']->id_customer) && (int)$params['cookie']->id_customer > 0) {
            if ($this->getIdentifierFromIdCustomer($params['cookie']->id_customer)) {

                $this->context->smarty->assign(array(
                    'myaccount_ctrl' => $this->context->link->getModuleLink('redsys', 'cards', array(), true),
                    'credit_card_icon' => _MODULE_DIR_.$this->name.'/views/img/credit-card-icon.png'
                ));
                if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                    return $this->context->smarty->fetch($this->local_path.'views/templates/hook/my-account_17.tpl');
                } elseif (version_compare(_PS_VERSION_, '1.6', '>=')) {
                    return $this->context->smarty->fetch($this->local_path.'views/templates/hook/my-account.tpl');
                } else {
                    return $this->context->smarty->fetch($this->local_path.'views/templates/hook/my-account_15.tpl');
                }
            }
        }
    }

    public function installTabs()
    {
        if (version_compare(_PS_VERSION_, '1.7.1', '>=')) {
            return true;
        }

        foreach ($this->tabs as $myTab) {
            $this->addTab($myTab);
        }
        return true;
    }

    public function addTab($myTab)
    {
        $id_tab = Tab::getIdFromClassName($myTab['class_name']);
        if (!$id_tab) {
            $tab = new Tab();
            $tab->class_name = $myTab['class_name'];
            $tab->module = $this->name;

            if (isset($myTab['parent_class_name'])) {
                $tab->id_parent = Tab::getIdFromClassName($myTab['parent_class_name']);
            } else {
                $tab->id_parent = -1;
            }

            $languages = Language::getLanguages(false);
            foreach ($languages as $lang) {
                $tab->name[$lang['id_lang']] = $myTab['name'];
            }

            $tab->add();
        }
    }

    public function uninstallTabs()
    {
        if (version_compare(_PS_VERSION_, '1.7.1', '>=')) {
            return true;
        }

        foreach ($this->tabs as $myTab) {
            $idTab = Tab::getIdFromClassName($myTab['class_name']);
            if ($idTab) {
                $tab = new Tab($idTab);
                $tab->delete();
            }
        }

        return true;
    }

    public function hookDisplayPaymentEU($params)
    {
        if (!$this->active) {
            return false;
        }

        if ($this->hookPayment($params) == null) {
            return false;
        }

        $result = $this->hookPayment($params);
        if (is_array($result)) {
            return $result;
        }
        return false;
    }

    public function hookPaymentOptions($params)
    {
        $result = $this->hookPayment($params);
        if (is_array($result)) {
            return $result;
        }
        return array();
    }

    public function hookPayment($params)
    {
        $tpl = '';
        $cart = $params['cart'];

        $customer = new Customer($cart->id_customer);
        $link = new Link();
        $protocol = $this->getProtocolUrl();

        $order_total = $cart->getOrderTotal(true, 3);
        // if getordertotal is 0 not show the payment method
        if ($order_total == 0) {
            return;
        }

        $customer = new Customer($cart->id_customer);
        $link = new Link();
        $protocol = $this->getProtocolUrl();

        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            // Array config con los datos de configuración
            $config = Configuration::getMultiple(
                array(
                    'REDSYS_ENVIRONMENT_REAL',
                    'REDSYS_NAME',
                    'REDSYS_NUMBER',
                    'REDSYS_ENCRYPTION_KEY',
                    'REDSYS_TERMINAL',
                    'REDSYS_TRANSACTION_TYPE',
                    'REDSYS_CURRENCY',
                    'REDSYS_SSL',
                    'REDSYS_PAYMENT_ERROR',
                    'REDSYS_PAYMENT_TYPE',
                    'REDSYS_ENABLE_TRANSLATION',
                    'REDSYS_MINIMUM_AMOUNT_CUR',
                    'REDSYS_MIN_AMOUNT',
                    'REDSYS_MAXIMUM_AMOUNT_CUR',
                    'REDSYS_MAX_AMOUNT',
                    'REDSYS_LOGO',
                    'REDSYS_PAYMENT_SIZE',
                    'REDSYS_ACTIVE_REDSYS',
                    'REDSYS_INTEGRATION',
                    'REDSYS_CLICKTOPAY',
                    'REDSYS_IUPAY',
                    'REDSYS_AWAITING_PAYMENT_REDSYS',
                )
            );

            if ($config['REDSYS_ACTIVE_REDSYS'] == 0) {
                return;
            }

            $tpl .= $this->context->smarty->fetch(dirname(__FILE__).'/views/templates/hook/common.tpl');

            //Validate if order minimum amount is higher than defined
            $id_currency_to = new Currency(Currency::getIdByIsoCodeNum($config['REDSYS_CURRENCY']));
            $id_currency_from = new Currency((int)$cart->id_currency);

            if (!$this->isMinimumAmountRequired($cart, $id_currency_to, $id_currency_from, $config['REDSYS_MIN_AMOUNT'], $config['REDSYS_MAX_AMOUNT'])) {
                return;
            }

            $payment_image = $config['REDSYS_LOGO'];
            $identifiers = array();

            if ((isset($config['REDSYS_CLICKTOPAY'])) && ($config['REDSYS_CLICKTOPAY'] == 1) && isset($customer->id) && !empty($customer->id)) {
                // Click to Pay check if the customer made a purchase in the store

                $cards = array();
                $expiry_dates = array();

                $i = 0;

                $sql = 'SELECT * FROM '._DB_PREFIX_.'redsys_clicktopay WHERE id_customer = "'.pSQL($customer->id).'" GROUP BY expiry_date';

                if ($results = Db::getInstance()->ExecuteS($sql)) {
                    foreach ($results as $row) {
                        $identifiers[$i] = $row['identifier'];
                        $cards[$i] = $row['card_number'];
                        $expiry_dates[$i] = $this->formatExpiryDate($row['expiry_date']);
                        $i++;
                    }
                }
                $j = 0;

                if (count($identifiers) > 0) {
                    foreach ($identifiers as $identifier) {
                        $fecha_str = $expiry_dates[$j];
                        $fecha_caducidad = new DateTime($fecha_str);
                        $now = new DateTime();
                        if ($fecha_caducidad >= $now) {
                            $this->context->smarty->assign(array(
                                'identifier' => $identifier,
                                'card_number' => $cards[$j],
                                'expiry_date' => $fecha_caducidad->format('m-Y'),
                                'clicktopayMessage' => $this->l('Click to Pay. Agree if you are sure to make the payment with card information of your last purchase.'),
                                'clicktopay' => $config['REDSYS_CLICKTOPAY'],
                                'payment_link' => $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/payment.php',
                                'tpv_id' => 1,
                            ));
                            $tpl .= $this->context->smarty->fetch(dirname(__FILE__).'/views/templates/hook/method.tpl');

                            //$tpl .= $this->display(__FILE__.'views/templates/hook/method.tpl');
                        }
                        $j++;
                    }
                }
            }

            if ((isset($config['REDSYS_CLICKTOPAY'])) && ($config['REDSYS_CLICKTOPAY'] == 1) && count($identifiers) == 0) {
                $this->context->smarty->assign(array(
                    'clicktopayMessage' => $this->l('Click to Pay. Agree if you are sure to make the payment with card information of your last purchase.'),
                    'clicktopay' => $config['REDSYS_CLICKTOPAY'],
                    'redsys_payment_image' => $payment_image,
                    'payment_text' => Configuration::get('REDSYS_PAYMENT_TEXT', $cart->id_lang),
                    'payment_size' => $config['REDSYS_PAYMENT_SIZE'],
                    'module_path' => $this->_path,
                    'integration' => $config['REDSYS_INTEGRATION'],
                    'module_path'   => _MODULE_DIR_.$this->name.'/',
                    'tpv_id' => 1,
                ));
                $tpl .= $this->context->smarty->fetch(dirname(__FILE__).'/views/templates/hook/method.tpl');
                //$tpl .= $this->display(__FILE__.'views/templates/hook/method.tpl');
            }
            $this->context->smarty->assign(array(
                'redsys_payment_image' => $payment_image,
                'clicktopay' => 0,
                'payment_text' => Configuration::get('REDSYS_PAYMENT_TEXT', $cart->id_lang),
                'payment_size' => $config['REDSYS_PAYMENT_SIZE'],
                'module_path' => $this->_path,
                'integration' => $config['REDSYS_INTEGRATION'],
                'module_path'   => _MODULE_DIR_.$this->name.'/',
                'tpv_id' => 1,
            ));
            $tpl .= $this->context->smarty->fetch(dirname(__FILE__).'/views/templates/hook/method.tpl');
            //$tpl .= $this->display(__FILE__.'views/templates/hook/method.tpl');
        } else {
            $id_shop = $cart->id_shop;
            $id_lang = $cart->id_lang;

            $id_currency = $cart->id_currency;

            $carrier = new Carrier($cart->id_carrier);
            $carrier = $carrier->id_reference;
            $address = new Address($cart->id_address_delivery);
            $zone = 0;

            if ($address->id_country > 0) {
                $country = new Country($address->id_country);
            } else {
                $country = new Country();
            }

            if ($address->id_state > 0) {
                $zone = State::getIdZone($address->id_state);
            } else if ($country->id > 0) {
                $zone = $country->getIdZone($country->id);
            }

            $redsystpv = new redsystpv();

            $manufacturers = '';
            $suppliers = '';
            $products = $cart->getProducts();
            foreach ($products as $product) {
                $manufacturers .= $product['id_manufacturer'].';';
                $suppliers .= $product['id_supplier'].';';
            }
            $manufacturers = explode(';', trim($manufacturers, ';'));
            $manufacturers = array_unique($manufacturers, SORT_REGULAR);
            $suppliers = explode(';', trim($suppliers, ';'));
            $suppliers = array_unique($suppliers, SORT_REGULAR);

            $tpvs = $redsystpv->getTpvs($id_shop, $id_lang, $carrier, $country, $zone, $suppliers, $manufacturers, $products, $id_currency, $order_total);

            if (!$tpvs) {
                return false;
            }


            $payment_options = array();
            foreach ($tpvs as $t) {
                $tpv = new redsystpv($t['id_redsys_tpv']);
                //Validate if order minimum amount is higher than defined
                $id_currency_to = new Currency($this->getIdByIsoCodeNum($tpv->currency, (int)$id_shop));
                $id_currency_from = new Currency((int)$id_currency);

                $this_path_ssl = (Configuration::get('PS_SSL_ENABLED') ? 'https://' : 'http://').htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__;

                if ($this->isMinimumAmountRequired($cart, $id_currency_to, $id_currency_from, $tpv->min_amount, $tpv->max_amount)) {
                    /*$payment_image = $this_path_ssl.'modules/'.$this->name.'/views/img/tarjetas17.gif';
                    if (version_compare(_PS_VERSION_, '1.7','>=')) {
                        $payment_image = $this_path_ssl.'modules/'.$this->name.'/views/img/tarjetas17.gif';
                    }*/

                    $payment_image = '';
                    $cta_text = $this->l('Card payment 100% secure');
                    if ($tpv->payment_type == 'z') {
                        $cta_text = $this->bizumDisplayName;
                        if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                            $payment_image = $this_path_ssl.'modules/'.$this->name.'/views/img/bizum17.png';
                        } else {
                            $payment_image = $this_path_ssl.'modules/'.$this->name.'/views/img/bizum.png';
                        }
                    }

                    if (file_exists(_PS_TMP_IMG_DIR_.$this->name.'_'.$tpv->id.'.'.$this->imageType)) {
                        $payment_image = $this_path_ssl.'img/tmp/'.$this->name.'_'.$tpv->id.'.'.$this->imageType;
                    }

                    $module = $this->isModuleActive('prettyurls');
                    if ($module !== false) {
                        $payment_ctrl = $this_path_ssl.'index.php?fc=module&module='.$this->name.'&controller=payment&t='.$tpv->id.'&id_lang='.$this->context->language->id;
                    } else {
                        $payment_ctrl = $this->context->link->getModuleLink($this->name, 'payment', array('t' => $tpv->id), true);
                    }

                    if ($tpv->clicktopay) {
                        $payment_ctrl = $this->context->link->getModuleLink('redsys', 'payment', array('method' => 'clicktopay', 'tpv_id' => $tpv->id), true);
                    }

                    if ($tpv->payment_text[$id_lang] != '') {
                        $cta_text = $tpv->payment_text[$id_lang];
                    }

                    $fee_discount_text = '';
                    $fee_discount = $this->getFeeDiscount($tpv, $cart, $tpv->order_total, false);
                    $fee_discount_with_tax = $this->getFeeDiscount($tpv, $cart, $tpv->order_total, true);

                    $operation_symbol = '';
                    $redsys_text = "";
                    if ($fee_discount != 0) {
                        $fee_discount_text = ' (';
                        $fee_discount_text .= Tools::displayPrice(abs($fee_discount_with_tax), $id_currency_to, false);
                        if ($fee_discount > 0) {
                            $fee_discount_text .= " ".$this->l('of fee').". ";
                            $redsys_text = $this->l('Fee');
                            $operation_symbol = '+';
                        } else {
                            $fee_discount_text .= " ".$this->l('of discount').". ";
                            $redsys_text = $this->l('Discount');
                        }
                        $fee_discount_text .= Tools::displayPrice($order_total, $id_currency_to, false)." ".$operation_symbol." ".Tools::displayPrice($fee_discount_with_tax, $id_currency_to, false)." = ".Tools::displayPrice($order_total + $fee_discount_with_tax, $id_currency_to, false);
                        $fee_discount_text .= ')';
                    }

                    if (Configuration::get('AEUC_FEAT_ADV_PAYMENT_API') && Configuration::get('AEUC_FEAT_ADV_PAYMENT_API') == '1' && $this->isModuleActive('advancedeucompliance')) {
                        $action = $payment_ctrl;

                        $formHtml = '<form method="POST" action="'.$action.'">';
                        $formHtml .= '</form>';
                        return array(
                            'cta_text' => $cta_text,
                            'logo' => $payment_image,
                            'action' => $action,
                            'form' => $formHtml
                        );
                    } else {
                        if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                            if ($fee_discount_text != '') {
                                $cta_text .= '. '.$fee_discount_text;
                            }

                            $inputs = array();
                            if ($tpv->fee_discount) {
                                $inputs[] = array('type' => 'hidden', 'name' => 'redsys_id', 'value' => $tpv->id);
                                $inputs[] = array('type' => 'hidden', 'name' => 'redsys_base_'.$tpv->id, 'value' => Tools::displayPrice($order_total, $id_currency_to, false));
                                $inputs[] = array('type' => 'hidden', 'name' => 'redsys_order_total_with_taxes_'.$tpv->id, 'value' => Tools::displayPrice($order_total + $fee_discount_with_tax, $id_currency_to, false));
                                $inputs[] = array('type' => 'hidden', 'name' => 'redsys_fee_with_taxes_'.$tpv->id, 'value' => Tools::displayPrice($fee_discount_with_tax, $id_currency_to, false));
                                $inputs[] = array('type' => 'hidden', 'name' => 'redsys_text_'.$tpv->id, 'value' => $redsys_text);
                            }

                            $newOption = new PrestaShop\PrestaShop\Core\Payment\PaymentOption();
                            if ($payment_image == '') {
                                $newOption->setCallToActionText($cta_text)
                                            ->setModuleName($this->name)
                                            ->setInputs($inputs)
                                            ->setAction($payment_ctrl);
                            } else {
                                $newOption->setCallToActionText($cta_text)
                                            ->setLogo($payment_image)
                                            ->setModuleName($this->name)
                                            ->setInputs($inputs)
                                            ->setAction($payment_ctrl);
                            }
                            $payment_options[] = $newOption;
                        } else {
                            $this->context->smarty->assign(array(
                                'redsys_payment_image' => $payment_image,
                                'payment_text' => $cta_text,
                                'payment_size' => $tpv->payment_size,
                                'module_path' => $this->_path,
                                'integration' => $tpv->integration,
                                'clicktopay' => $tpv->clicktopay,
                                'module_path'   => _MODULE_DIR_.$this->name.'/',
                                'payment_ctrl' => $payment_ctrl,
                                'action' => $payment_ctrl,
                                'tpv_id' => $tpv->id,
                                'fee_discount_text' => $fee_discount_text,
                            ));

                            $tpl .= $this->context->smarty->fetch(dirname(__FILE__).'/views/templates/hook/method.tpl');
                            //$tpl .= $this->display(__FILE__.'views/templates/hook/method.tpl');
                        }
                    }
                }
            }

            $use_common = false;

            if (version_compare(_PS_VERSION_, '1.6.0.3', '>=') && version_compare(_PS_VERSION_, '1.7.1.2', '<=')) {
                $commonfile = '/views/templates/hook/common.tpl';
            } else {
                $commonfile = '/views/templates/hook/common17.tpl';
            }

            foreach ($tpvs as $t) {
                $tpv = new redsystpv($t['id_redsys_tpv']);
                $tplTemp = '';
                if (isset($tpv->clicktopay) && $tpv->clicktopay == 1 && isset($customer->id) && !empty($customer->id)) {
                    $use_common = true;
                    $identifiers = array();
                    $cards = array();
                    $expiry_dates = array();
                    $results = array();
                    $cofTxnids = array();

                    $sql = 'SELECT * FROM '._DB_PREFIX_.'redsys_clicktopay WHERE id_customer = '.pSQL($customer->id);
                    if ($results = Db::getInstance()->executeS($sql)) {
                        foreach ($results as $row) {
                            if ($row['id_tpv'] == 0 || $row['id_tpv'] == $tpv->id) {
                                $identifiers[] = $row['identifier'];
                                $cards[] = $row['card_number'];
                                $cofTxnids[] = $row['cofTxnid'];
                                $expiry_dates[] = $this->formatExpiryDate($row['expiry_date']);
                            }
                        }

                        $j = 0;
                        $payment_image = $this_path_ssl.'modules/'.$this->name.'/views/img/clicktopay.jpg';
                        foreach ($identifiers as $identifier) {
                            $fecha_str = $expiry_dates[$j];
                            $fecha_caducidad = new DateTime($fecha_str);
                            $now = new DateTime();
                            if ($fecha_caducidad >= $now) {
                                $payment_link = $this->context->link->getModuleLink($this->name, 'payment', array('method' => 'clicktopay', 'identifier' => $identifier, 'tpv_id' => $tpv->id), true);
                                $card_text = '';
                                if (isset($cards[$j]) and ($cards[$j] != '')) {
                                    $card_text = $cards[$j];
                                }
                                if (isset($fecha_caducidad) and $fecha_caducidad != null) {
                                    $expiry_text = $fecha_caducidad->format('m-Y');
                                }
                                $pay_text_click = $this->l('Pay with your Card').' '.$card_text.$this->l('with Expiry Date').' '.$expiry_text;
                                $this->context->smarty->assign(array(
                                        'redsys_payment_image' => $payment_image,
                                        'identifier' => $identifier,
                                        'clicktopay' => $tpv->clicktopay,
                                        'card_number' => $cards[$j],
                                        'expiry_date' => $expiry_text,
                                        'clicktopayMessage' => $this->l('Click to Pay. Agree if you are sure to make the payment with card information of your last purchase.'),
                                        'payment_link' => $payment_link,
                                        'tpv_id' => $tpv->id,
                                    ));

                                if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                                    //$linkPaymentCTP = $this->context->link->getModuleLink($this->name, 'payment', array('method' => 'clicktopay', 'identifier' => $identifier, 'tpv_id' => $tpv->id), true);
                                    $newOptionId = new PrestaShop\PrestaShop\Core\Payment\PaymentOption();
                                        $newOptionId->setCallToActionText($pay_text_click)
                                        ->setAction('javascript:confirmPopup(\''.$payment_link.'\')')
                                        ->setLogo($this_path_ssl.'modules/'.$this->name.'/views/img/clicktopay.jpg')
                                                        ->setAdditionalInformation($this->context->smarty->fetch('module:redsys'.$commonfile));
                                    $payment_options[] = $newOptionId;
                                } else {


                                    $tpl .= $this->context->smarty->fetch(dirname(__FILE__).'/views/templates/hook/method.tpl');
                                    //$tpl .= $this->display(__FILE__.'views/templates/hook/method.tpl');
                                }
                            }
                            $j++;
                        }
                    }
                }
            }

            if ($use_common && version_compare(_PS_VERSION_, '1.7', '<')) {
                $tpl .= $this->context->smarty->fetch(dirname(__FILE__).$commonfile);
            }

            if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                if (isset($payment_options) && !empty($payment_options)) {
                    return $payment_options;
                } else {
                    return;
                }
            }
        }
        return $tpl;
    }

    public function hookActionValidateOrder($params)
    {
        $cart = $params['cart'];
        $order = $params['order'];
        $controller = $this->context->controller;

        if ($order->module == $this->name) {
            $decimals = _PS_PRICE_COMPUTE_PRECISION_ > 2 ? 2 : _PS_PRICE_COMPUTE_PRECISION_;
            if (version_compare(_PS_VERSION_, '1.7.7', '>=')) {
                $decimals = Context::getContext()->getComputingPrecision() > 2 ? 2 : Context::getContext()->getComputingPrecision();
            }
            $fee_discount_no_tax = Context::getContext()->cookie->redsysfee_notax;
            $fee_discount = Context::getContext()->cookie->redsysfee;

            if (version_compare(_PS_VERSION_, '1.7.1', '>=')) {
                $id_order = Order::getIdByCartId($cart->id);
            } else {
                $id_order = Order::getOrderByCartId($cart->id);
            }
            $total_tax_incl = (float)Tools::ps_round($order->total_paid_tax_incl + $fee_discount, $decimals);
            $order->total_paid_tax_excl = (float)Tools::ps_round($order->total_paid_tax_excl + $fee_discount_no_tax, $decimals);
            $order->total_paid_tax_incl = $total_tax_incl;
            $order->total_paid = $total_tax_incl;
            $order->total_paid_real = $total_tax_incl;

            $order->update();

            // Update order_carrier
            $order = new Order((int)$id_order);

            //Update order_payment
            $payments = OrderPayment::getByOrderReference($order->reference);
            if (count($payments) > 0) {
                foreach ($payments as $key => $payment) {
                    $payment->amount = $order->total_paid_tax_incl;
                    $payment->update();
                }
            }
            //$id_order_state = _PS_OS_PAYMENT_;
        }
    }

    public function getFeeDiscount($tpv = false, $cart = 0, $order_total = false, $taxes = false)
    {
        $amount = 0;

        if ($tpv->fee_discount && $cart) {
            $total_cart = (float)$cart->getOrderTotal($order_total, 3);

            if ($tpv->max_order_amount > 0) {
                if ($total_cart > $tpv->max_order_amount) {
                    return 0;
                }
            }

            if ($tpv->min_order_amount > 0) {
                if ($total_cart < $tpv->min_order_amount) {
                    return 0;
                }
            }

            if ($tpv->type == 0) {
                $amount = (float)$tpv->fix;

            }

            if ($tpv->type == 1) {
                $amount = Tools::ps_round(((float)$tpv->percentage / 100) * $total_cart, 2);
            }

        }

        if ($tpv->maximum_amount > 0) {
            if ((float)$amount > (float)$tpv->maximum_amount) {
                $amount = (float)$tpv->maximum_amount;
            }
        }

        if ($tpv->minimum_amount > 0) {
            if ((float)$amount < (float)$tpv->minimum_amount) {
                $amount = (float)$tpv->minimum_amount;
            }
        }

        if ($taxes && $tpv->id_tax_rule) {
            if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_invoice') {
                $address_id = (int)$cart->id_address_invoice;
            } else {
                $address_id = (int)$cart->id_address_delivery;
            }
            if (!Address::addressExists($address_id)) {
                $address_id = null;
            }
            $address = Address::initialize($address_id, true);
            $tax_calculator = TaxManagerFactory::getManager($address, $tpv->id_tax_rule)->getTaxCalculator();
            $amount = $amount * (1 + (($tax_calculator->getTotalRate()) / 100));
        }

        if ($tpv->mode == 1) {
            $amount = $amount * -1;
        }

        return $amount;
    }

    public function hookPaymentReturn($params)
    {
        if (!$this->active) {
            return;
        }

        if (version_compare(_PS_VERSION_, '1.7', '>=')) {
            $this->context->controller->addJqueryPlugin('fancybox');
        }

        $customer = new Customer($params['cart']->id_customer);


        if (version_compare(_PS_VERSION_, '1.7', '<')) {
            $order = $params['objOrder'];
        } else {
            $order = $params['order'];
        }

        $cart = new Cart($order->id_cart);

        $carrier = new Carrier($order->id_carrier);
        $signObject = new RedsysAPI();

        $parameters = Tools::getValue("Ds_MerchantParameters");
        $ds_signature = Tools::getValue("Ds_Signature");

        $decodec = $signObject->decodeMerchantParameters($parameters);
        $decodec_array = json_decode($decodec, true);

        $identifier = '';
        if (isset($decodec_array['Ds_Merchant_Identifier'])) {
            $identifier = $decodec_array['Ds_Merchant_Identifier'];
        }

        $cofTxnid = '';
        if (isset($decodec_array['Ds_Merchant_Cof_Txnid'])) {
            $cofTxnid = $decodec_array['Ds_Merchant_Cof_Txnid'];
        }

        $expiry_date = '';
        if (isset($decodec_array['Ds_ExpiryDate'])) {
            $expiry_date_dt = new DateTime($this->formatExpiryDate($decodec_array['Ds_ExpiryDate']));
        }

        $card_number = '';
        if (isset($decodec_array['Ds_Card_Number'])) {
            $card_number = $decodec_array['Ds_Card_Number'];
        } else if (isset($decodec_array['Ds_CardNumber'])) {
            $card_number = $decodec_array['Ds_CardNumber'];
        }
        $protocol = $this->getProtocolUrl();
        $url_admin = $protocol.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);

        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            $redsysmanagement = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/controllers/front/ajax.php';
            $url_history = 'http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'history.php';
        } else {
            $redsysmanagement = $this->context->link->getModuleLink('redsys', 'ajax');
            $url_history = $this->context->link->getPageLink('history.php', false, null);
        }

        $merchant_data = $decodec_array['Ds_MerchantData'];

        $merchant_data_array = explode(';', str_replace('+', ' ', $merchant_data));
        if (count($merchant_data_array) < 3) {
            $merchant_data_array = explode('%3B', str_replace('+', ' ', $merchant_data));
        }

        $tpv = new RedsysTPV();

        if (is_array($merchant_data_array) && count($merchant_data_array) > 1) {
            $tpv = new RedsysTPV($merchant_data_array[1]);
        }

        $showpopup = false;
        if ($tpv->clicktopay && $tpv->payment_type != 'z' && !$this->checkIdentifierExists($identifier)) {
            $showpopup = true;
        }

        $use_tax = (int)Configuration::get('PS_TAX');
        $priceDisplay = Product::getTaxCalculationMethod((int)$customer->id);
        $expiry_date = '';
        if (isset($decodec_array['Ds_ExpiryDate'])) {
            $expiry_date = $decodec_array['Ds_ExpiryDate'];
        }

        $fee_discount = $this->getFeeDiscountFromOrderId($order->id);
        $currency = new Currency($order->id_currency);

        $total_paid_redsys = $decodec_array['Ds_Amount']/100;
        if (version_compare(_PS_VERSION_, '1.7', '<')) {
            $total_order = $params['total_to_pay'];
        } else {
            $total_order = $order->total_paid;
        }
        $advanced_payment = 0;
        $text_advanced_payment = '';

        if ($tpv->advanced_payment) {
            $text_advanced_payment = $this->l('Advanced Payment Redsys');
            if ($total_paid_redsys < $total_order && $tpv->advanced_payment) {
                $advanced_payment = 1;
                $text_advanced_payment = $tpv->advanced_payment_text[$order->id_lang] ? $tpv->advanced_payment_text[$order->id_lang] : $tpv->advanced_payment_text[Configuration::get('PS_LANG_DEFAULT')];
            }
        }

        if (version_compare(_PS_VERSION_, '1.7', '<')) {
            $currency = $params['currencyObj'];
        } else {
            $currency = new Currency($order->id_currency);
        }

        $extra_vars = array();
        if ($tpv->create_order == 1 || $tpv->advanced_payment) {
            if (Module::isEnabled('idxrecargoe')) {
                require_once(_PS_ROOT_DIR_.'/modules/idxrecargoe/classes/RecargoDeEquivalenciaDlx.php');
                $recargoDeEquivalenciaObject = new RecargoDeEquivalenciaDlx();
                if ($recargoDeEquivalenciaObject->hasCustomerSurcharge($cart->id_customer, true)) {
                    $recargo_equivalencia = 0;
                     $recargo_equivalencia_transporte = 0;
                     $recargo_total = 0;
                     $recargo_equivalencia = $recargoDeEquivalenciaObject->getEquivalenceSurchargeApplied($cart, 3, false, false);
                     $recargo_equivalencia_transporte = $recargoDeEquivalenciaObject->getEquivalenceSurchargeApplied($cart, 3, false, true);
                     $recargo_total = $recargo_equivalencia + $recargo_equivalencia_transporte;

                     $extra_vars['{recargo_equivalencia}'] = '<tr class="conf_body">
                            <td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;color:#333;padding:7px 0">
                                <table class="table" style="width:100%;border-collapse:collapse">
                                    <tr>
                                        <td width="10" style="color:#333;padding:0">&nbsp;</td>
                                        <td align="right" style="color:#333;padding:0">
                                            <font size="2" face="Open-sans, sans-serif" color="#555454">
                                                <strong>Recargo equivalencia total</strong>
                                            </font>
                                        </td>
                                        <td width="10" style="color:#333;padding:0">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                            <td bgcolor="#f8f8f8" colspan="4" style="border:1px solid #D6D4D4;color:#333;padding:7px 0">
                                <table class="table" style="width:100%;border-collapse:collapse">
                                    <tr>
                                        <td width="10" style="color:#333;padding:0">&nbsp;</td>
                                        <td align="right" style="color:#333;padding:0">
                                            <font size="2" face="Open-sans, sans-serif" color="#555454">
                                                '.Tools::displayPrice($recargo_total, $currency).'
                                            </font>
                                        </td>
                                        <td width="10" style="color:#333;padding:0">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>';
                } else {
                    $extra_vars['{recargo_equivalencia}'] = '';
                }
            }
            if ((int)$this->checkMailSent($order->id) == 0) {
                $this->sendConfirmationEmail($order->id, $extra_vars, $tpv, $total_paid_redsys);
            }
        }

        /* advanced summary information for the automatic redirection */
        $date = $decodec_array['Ds_Date'];
        $hour = $decodec_array['Ds_Hour'];
        $fuc = $decodec_array['Ds_MerchantCode'];
        $auth_code = $decodec_array['Ds_AuthorisationCode'];

        $datetime = urldecode($date . ' ' . $hour);

        $this->context->smarty->assign(array(
            'redsysmanagement' => $redsysmanagement,
            'url_history' => $url_history,
            'showpopup' => $showpopup,
            'expiry_date_not_formatted' => $expiry_date,
            'expiry_date' => isset($expiry_date_dt) ? $expiry_date_dt->format('m-Y') : '',
            'card_number' => $card_number,
            'id_customer' => $this->context->cart->id_customer,
            'identifier' => $identifier,
            'title_text' => $this->l('Would you like to save this card information?'),
            'email' => $customer->email,
            'order' => $order,
            'group_use_tax' => (Group::getPriceDisplayMethod($customer->id_default_group) == PS_TAX_INC),
            'discounts' => $order->getCartRules(),
            'products' => $order->getProducts(),
            'use_tax' => $use_tax,
            'carrier' => $carrier,
            'orderdetail' => _PS_MODULE_DIR_.$this->name.'/views/templates/hook/order-detail-redsys.tpl',
            'path' => $this->module_path,
            'total_paid' => Tools::displayPrice($total_order, $currency, false),
            'total_paid_redsys' => Tools::displayPrice($total_paid_redsys, $currency, false),
            'total_difference' => Tools::displayPrice($total_order - $total_paid_redsys, $currency, false),
            'text_advanced_payment' => $text_advanced_payment,
            'advanced_payment' => $advanced_payment,
            'id_order' => $order->reference,
            'fee_discount' => Tools::displayPrice($fee_discount, $currency, false),
            'advanced_summary' => $tpv->advanced_summary,
            'idTpv' => $tpv->id,
            'datetime' => $datetime,
            'fuc' => $fuc,
            'auth_code' => $auth_code,
            'tpv_name' => $tpv->name,
            'url' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://'.$_SERVER["HTTP_HOST"],
            'cofTxnid' => $cofTxnid
        ));

        if (version_compare(_PS_VERSION_, '1.7', '<')) {
            return $this->display(__FILE__, 'views/templates/hook/pago_correcto.tpl');
        } else {
            return $this->display(__FILE__, 'pago_correcto17.tpl');
        }
    }

    public function hookDisplayPDFInvoice($params)
    {
        $order_invoice = $params['object'];

        if (!($order_invoice instanceof OrderInvoice)) {
            return false;
        }

        $order = new Order((int)$order_invoice->id_order);
        $return = '';
        $fee_discount_no_tax = 0;
        $fee_discount = 0;
        if ($order->module == $this->name) {
            $transaction = $this->getTransactionFromIdCart($order->id_cart);
            $currency = new Currency($order->id_currency);
            $fee = 0;


            if (!empty($transaction) && $transaction['id_tpv']) {
                $tpv = new redsystpv($transaction['id_tpv']);
                $cart = new Cart($transaction['id_cart']);
                if ($tpv->fee_discount) {
                    $fee_discount_no_tax = $this->getFeeDiscount($tpv, $cart, $tpv->order_total, false);
                    $fee_discount = $this->getFeeDiscount($tpv, $cart, $tpv->order_total, true);
                }

                if ($fee_discount_no_tax != 0) {
                    if ($fee_discount_no_tax > 0) {
                        $note .= sprintf($this->l('Redsys Fee applied to the order: ').' '.Tools::displayPrice($fee_discount_no_tax, $currency, false). ' + '.Tools::displayPrice($fee_discount - $fee_discount_no_tax, $currency, false). $this->l('tax'));
                    } else {
                        $note .= sprintf($this->l('Redsys Discount applied to the order:').' '.Tools::displayPrice($fee, $currency, false));
                    }

                    if (Validate::isLoadedObject($order_invoice)) {
                        $order_invoice->note = $note;
                        $order_invoice->save();
                    }
                }
            }

        }
        return $return;
    }

    public function hookDisplayOrderDetail($params)
    {
        $output = '';
        $order = $params['order'];
        if (!($order instanceof Order)) {
            return;
        }
        $fee_discount = $this->getFeeDiscountFromOrderId($order->id);
        $currency = new Currency($order->id_currency);
        $return = '';

        if ($order->module == 'redsys' && $fee_discount != 0) {
            $currency = new Currency($order->id_currency);
            $this->context->smarty->assign(array(
                'fee_discount' => Tools::displayPrice($fee_discount, $currency, false),
                'fee_discount_text' => $fee_discount > 0 ? $this->l('Redsys Fee') : $this->l('Redsys Discount')
            ));
            $output = $this->context->smarty->fetch(_PS_MODULE_DIR_.$this->name.'/views/templates/admin/order_summary.tpl');
        }
        return $output;
    }

    public function hookActionAdminControllerSetMedia()
    {
        if (version_compare(_PS_VERSION_, '1.6', '>=')) {
            $this->context->controller->addJS($this->_path . 'views/js/back.js');
        }
    }

    public function hookOrderDetailDisplayed($params)
    {
        return $this->hookDisplayOrderDetail($params);
    }

    public function hookAdminOrder($params)
    {
        return $this->hookDisplayAdminOrder($params);
    }

    public function hookDisplayAdminOrder($params)
    {
        $output = '';

        $order = new Order($params['id_order']);

        $fee_discount = $this->getFeeDiscountFromOrderId($order->id);
        if ($fee_discount > 0) {
            if ($order->module == 'redsys' && $fee_discount != 0) {
                $currency = new Currency($order->id_currency);
                $this->context->smarty->assign(array(
                    'fee_discount' => Tools::displayPrice($fee_discount, $currency, false),
                    'fee_discount_text' => $fee_discount > 0 ? $this->l('Redsys Fee') : $this->l('Redsys Discount')
                ));
                $output = $this->context->smarty->fetch(_PS_MODULE_DIR_.$this->name.'/views/templates/admin/order_summary.tpl');
            }
        }

        $cart = new Cart($order->id_cart);
        $id_shop = 0;
        if (isset($cart->id_shop)) {
            $id_shop = $cart->id_shop;
        }

        // check if the order payment was done with our module
        if ($order->module == $this->name) {
            $price = $order->total_paid;

            $ok_payment = 0;
            $ds_order = 0;
            $id_currency = 0;
            $id_tpv = 0;

            // check if the order was refunded previously
            $query = 'SELECT * FROM `'.pSQL(_DB_PREFIX_.$this->name).'_refund`
                    WHERE `id_order` = '.pSQL($order->id);

            $refunds = Db::getInstance()->executeS($query);

            $amount_refunded = 0;

            if (count($refunds) > 0) {

                foreach ($refunds as $refund) {
                    $amount_refunded += $refund['amount_refunded'];
                }
            }

            if (version_compare(_PS_VERSION_, '1.5', '<')) {
                $query = '
                    SELECT * FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction`
                    WHERE `id_cart` = '.pSQL($cart->id);

                $transactions = Db::getInstance()->executeS($query);

                if (is_array($transactions) && count($transactions) > 0) {
                    $ok_payment = 1;
                    $ds_order = str_pad($transactions[0]['ds_order'], 12, '0', STR_PAD_LEFT);
                    $id_currency = $transactions[0]['id_currency'];
                    $id_tpv = 1;
                }
            } else {
                $query = '';
                if ($order->getOrderPaymentCollection()) {
                    $query = '
                            SELECT * FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction`
                            WHERE `id_order` = '.pSQL($order->id);
                    $transactions = Db::getInstance()->getRow($query);

/*                    if (empty($transactions)) {
                        $query = '
                            SELECT * FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction`
                            WHERE `ds_order` = '.$item->transaction_id.' && `id_cart` = '.$params['cart']->id;
                        $transactions = Db::getInstance()->getRow($query);
                    }*/

                    if (!empty($transactions)) {
                        $ok_payment = 1;
                        $ds_order = str_pad($transactions['ds_order'], 12, '0', STR_PAD_LEFT);
                        $id_currency = $transactions['id_currency'];
                        $id_tpv = $transactions['id_tpv'];
                    }
                }
            }
            $protocol = $this->getProtocolUrl();

            $url_admin = $protocol.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
            $url_refund_controller = '';

            if (version_compare(_PS_VERSION_, '1.5', '<')) {
                $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/controllers/admin/AdminRedsysManagementController.php?t='.$transaction['id_tpv'];
            } else if (version_compare(_PS_VERSION_, '1.6', '>')) {
                $url_refund_controller = $this->context->link->getAdminLink('AdminRedsysManagement');
            } else {
                $url_refund_controller = $url_admin.'/'.$this->context->link->getAdminLink('AdminRedsysManagement');
            }

            if (isset($ok_payment) && $ok_payment) {
                if (version_compare(_PS_VERSION_, '1.5', '<')) {
                    $this->context->smarty->assign(array(
                        'price' => $price,
                        'ok_payment' => $ok_payment,
                        'amount_refunded' => $amount_refunded,
                        'refunds' => $refunds,
                        'transactions' => $transactions,
                        'id_order' => $order->id,
                        'id_currency' => $id_currency,
                        'ds_order' => $ds_order,
                        'r_path' => $this->_path,
                        'displayName' => $this->name,
                        'refund_title' => $this->l('Refunds Management'),
                        'no_more_refunds_title' => $this->l('No more refunds are possible'),
                        'no_refunds_title' => $this->l('No refunds done'),
                        'total_refund_title' => $this->l('Total refund'),
                        'partial_refund_title' => $this->l('Partial refund'),
                        'ds_order_title' => $this->l('DS Order'),
                        'date_title' => $this->l('Date'),
                        'amount_refunded_title' => $this->l('Amount refunded'),
                        'do_refund_title' => $this->l('Refund the order'),
                        'id_tpv' => $id_tpv,
                        'refund_controller' => $url_refund_controller
                    ));
                    return $this->display(__FILE__, 'views/templates/hook/refunds14.tpl');
                } else {
                    $this->context->smarty->assign(array(
                        'price' => $price,
                        'ok_payment' => $ok_payment,
                        'amount_refunded' => $amount_refunded,
                        'refunds' => $refunds,
                        'transactions' => $transactions,
                        'id_order' => $order->id,
                        'id_tpv' => $id_tpv,
                        'id_currency' => $id_currency,
                        'ds_order' => $ds_order,
                        'r_path' => $this->_path,
                        'displayName' => $this->name,
                        'refund_controller' => $url_refund_controller
                    ));
                    include_once(_PS_MODULE_DIR_.'redsys/controllers/admin/AdminRedsysTpvController.php');
                    $_html_messages = $this->context->smarty->fetch(_PS_MODULE_DIR_.$this->name.'/views/templates/admin/messages.tpl');
                    $_html_transactions = '';
                    $_html_refunds = '';

                    if (Tab::checkTabRights(Tab::getIdFromClassName($this->tabClassNameManage))) {
                        $_html_transactions = $this->getTransactions($params, true);
                        $_html_refunds = $this->getRefunds($params, true);
                    }

                    return $_html_messages.$_html_transactions.$_html_refunds;
                }
            }
        }
        $this->context->smarty->assign(array(
            'default_form_language' => 1,
        ));
        return $output;
    }

    public function initSQLTpv()
    {
        Db::getInstance()->Execute('
        CREATE TABLE IF NOT EXISTS `'.pSQL(_DB_PREFIX_.$this->name).'_tpv` (
            `id_redsys_tpv` int(10) unsigned NOT NULL auto_increment,
            `name` VARCHAR(32) NOT NULL,
            `number` VARCHAR(32) NOT NULL,
            `terminal` int(8) unsigned NOT NULL,
            `currency` varchar(32) NOT NULL,
            `encryption_key` VARCHAR(32) NOT NULL,
            `environment_real` int(1) unsigned NOT NULL,
            `transaction_type` int(1) unsigned NOT NULL,
            `iupay` int(1) unsigned NOT NULL,
            `clicktopay` int(1) unsigned NOT NULL,
            `payment_type` VARCHAR(1),
            `payment_size` VARCHAR(32),
            `integration` int(1) unsigned,
            `min_amount` decimal(10,3) unsigned,
            `max_amount` decimal(10,3) unsigned,
            `carriers` TEXT NULL,
            `countries` TEXT NULL,
            `zones` TEXT NULL,
            `categories` TEXT NULL,
            `manufacturers` TEXT NULL,
            `suppliers` TEXT NULL,
            `languages` TEXT NULL,
            `currencies` TEXT NULL,
            `groups` TEXT NULL,
            `payment_error` int(1) unsigned,
            `create_order` int(1) unsigned,
            `ssl` int(1) unsigned,
            `enable_translation` int(1) unsigned,
            `active` int(1) unsigned NOT NULL,
            `id_shop` int(1) unsigned NOT NULL,
            `date_add` DATETIME,
            `date_upd` DATETIME,
            `advanced_payment` int(1) unsigned,
            `advanced_payment_state` int(1) unsigned,
            `advanced_percentage` decimal(10,3) unsigned,
            `fee_discount` int(1) unsigned,
            `mode` int(1) unsigned,
            `type` int(1) unsigned,
            `order_total` int(1) unsigned,
            `fix` decimal(10,3) unsigned,
            `percentage` decimal(10,3) unsigned,
            `minimum_amount` decimal(10,3) unsigned,
            `maximum_amount` decimal(10,3) unsigned,
            `min_order_amount` decimal(10,3) unsigned,
            `max_order_amount` decimal(10,3) unsigned,
            `advanced_summary` int(1) unsigned,
            `filter_store` int(1) unsigned DEFAULT "0",
            `position` int(10) unsigned,
            `strict_filters` int(1) unsigned DEFAULT "0",
            `customers` TEXT NULL,
            `products` TEXT NULL,
            `products_excluded` TEXT NULL,
            `customers_excluded` TEXT NULL,
            `security_options` int(1) unsigned DEFAULT "1",
            `excep_sca` int(4) unsigned NOT NULL,
            `id_tax_rule` int(4) unsigned NOT NULL,
        PRIMARY KEY (`id_redsys_tpv`),
        KEY `id_redsys_tpv` (`id_redsys_tpv`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;');


        Db::getInstance()->Execute('
        CREATE TABLE IF NOT EXISTS `'.pSQL(_DB_PREFIX_.$this->name).'_tpv_lang` (
            `id_redsys_tpv` int(10) unsigned NOT NULL,
            `id_lang` int(10) unsigned,
            `payment_text` varchar(256) NULL,
            `advanced_payment_text` varchar(256) NULL,
        PRIMARY KEY (`id_redsys_tpv`, `id_lang`),
        KEY `id_redsys_tpv` (`id_redsys_tpv`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;');

        Db::getInstance()->Execute('
        CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'redsys_clicktopay` (
            `id_operation` int(10) unsigned NOT NULL auto_increment,
            `identifier` VARCHAR(40) NOT NULL,
            `id_tpv` int(4) unsigned NOT NULL,
            `card_number` VARCHAR(20) NOT NULL,
            `id_customer` int(10) unsigned NOT NULL,
            `expiry_date` varchar (6) NOT NULL,
            `cofTxnid` VARCHAR(15),
            `id_shop` int(1) unsigned,
        PRIMARY KEY (`identifier`,`id_customer`),
        KEY `id_operation` (`id_operation`)
        ) ENGINE='._MYSQL_ENGINE_.'  DEFAULT CHARSET=utf8;');

       Db::getInstance()->Execute('
        CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'redsys_fee_discount` (
            `id` int(10) unsigned NOT NULL auto_increment,
            `id_order` int(10) unsigned NOT NULL,
            `redsys_fee_discount` decimal(10,3) DEFAULT "0.000",
        PRIMARY KEY (`id`,`id_order`),
        KEY `id_operation` (`id`)
        ) ENGINE='._MYSQL_ENGINE_.'  DEFAULT CHARSET=utf8;');

       return true;
    }

    protected function initSQLTransactions()
    {
        Db::getInstance()->Execute('
        CREATE TABLE IF NOT EXISTS `'.pSQL(_DB_PREFIX_.$this->name).'_transaction` (
            `id_transaction` int(10) unsigned NOT NULL auto_increment,
            `id_tpv` int(10) unsigned NOT NULL,
            `id_customer` int(10) unsigned NOT NULL,
            `id_cart` int(10) unsigned NOT NULL,
            `id_currency` varchar(32) not null,
            `transaction_type` int(1) unsigned NOT NULL,
            `id_order` int(10) unsigned NOT NULL,
            `id_shop` int(4) unsigned NOT NULL,
            `ds_order` VARCHAR(15) NOT NULL,
            `ds_response` varchar(4) NOT NULL,
            `ds_authorisationcode` VARCHAR(10) NOT NULL,
            `amount` VARCHAR(15) NOT NULL,
            `amount_total` varchar(15) NULL,
            `transaction_date` DATETIME,
            `mail_sent` int(1) unsigned NOT NULL,
        PRIMARY KEY (`id_transaction`,`id_cart`),
        KEY `id_transaction` (`id_transaction`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;');

        return true;
    }

    protected function initSQLRefunds()
    {
        Db::getInstance()->Execute('
        CREATE TABLE IF NOT EXISTS `'.pSQL(_DB_PREFIX_.$this->name).'_refund` (
            `id_refund` int(10) unsigned NOT NULL auto_increment,
            `id_shop` int(4) unsigned NOT NULL,
            `id_tpv` int(10) unsigned NOT NULL,
            `id_order` int(10) unsigned NOT NULL,
            `id_customer` int(10) unsigned NOT NULL,
            `ds_currency` varchar(32) NOT NULL,
            `ds_order` VARCHAR(15) NOT NULL,
            `id_transaction` int(10) unsigned NOT NULL,
            `ds_response` varchar(4) NOT NULL,
            `ds_authorisationcode` VARCHAR(10) NOT NULL,
            `amount_refunded` VARCHAR(15) NOT NULL,
            `refund_date` DATETIME,
        PRIMARY KEY (`id_refund`,`id_order`),
        KEY `id_refund` (`id_refund`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;');

        return true;

    }

    protected function uninstallSQL()
    {
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `'.pSQL(_DB_PREFIX_.$this->name).'_tpv`');
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `'.pSQL(_DB_PREFIX_.$this->name).'_tpv_lang`');
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'redsys_clicktopay`');

        try {
            Db::getInstance()->Execute('CREATE TABLE IF NOT EXISTS `'.pSQL(_DB_PREFIX_.$this->name).'_transaction'.time().'` AS SELECT * FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction`');
        } catch (Exception $e) {

        }
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `'.pSQL(_DB_PREFIX_.$this->name).'_transaction`');
        try {
            Db::getInstance()->Execute('CREATE TABLE IF NOT EXISTS `'.pSQL(_DB_PREFIX_.$this->name).'_refund'.time().'` AS SELECT * FROM `'.pSQL(_DB_PREFIX_.$this->name).'_refund`');
        } catch (Exception $e) {

        }
        Db::getInstance()->Execute('DROP TABLE IF EXISTS `'.pSQL(_DB_PREFIX_.$this->name).'_refund`');
        return true;
    }

    protected function isMinimumAmountRequired($cart, $id_currency_to, $id_currency_from, $min_amount, $max_amount)
    {
        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            $order_amount = Tools::convertPrice($cart->getOrderTotal(true, Cart::BOTH), $id_currency_from, $id_currency_to);
        } else {
            $order_amount = Tools::convertPriceFull($cart->getOrderTotal(true, Cart::BOTH), $id_currency_from, $id_currency_to);
        }

        if ($order_amount < $min_amount) {
            return false;
        } elseif ($order_amount > $max_amount && $max_amount > 0) {
            return false;
        }

        return true;
    }

    protected function checkMailSent($id_order)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('SELECT t.`mail_sent` FROM `'._DB_PREFIX_.'redsys_transaction` t WHERE t.`id_order` = '.(int)$id_order.';');
    }

    protected function updateMailSentStatus($id_order)
    {
        $sql = 'UPDATE `'._DB_PREFIX_.'redsys_transaction` set mail_sent = 1 WHERE `id_order` = '.(int)$id_order;
        Db::getInstance()->execute($sql);
    }

    public function getFeeDiscountFromOrderId($id_order)
    {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('SELECT r.`redsys_fee_discount` FROM `'._DB_PREFIX_.'redsys_fee_discount` r WHERE r.`id_order` = '.(int)$id_order.';');
    }

    public function setFeeDiscountFromOrderId($id_order, $fee_discount)
    {
        $sql = 'INSERT INTO `'._DB_PREFIX_.'redsys_fee_discount` (id_order, redsys_fee_discount) VALUES ('.(int)$id_order.','.pSQL($fee_discount).')';
        Db::getInstance()->execute($sql);
    }

    public function getIdentifiers($params = false)
    {
        $list_identifiers = $this->getListIdentifiers($params);

        $fields_list = array(
                'id_operation' => array(
                        'title' => $this->l('Id Operation'),
                        'type' => 'text',
                        'align' => 'center',
                ),
                'id_customer' => array(
                        'title' => $this->l('Customer'),
                        'type' => 'text',
                        'align' => 'center',
                        'callback' => 'printGoToCustomerButton',
                        'callback_object' => $this
                ),
                'identifier' => array(
                        'title' => $this->l('Identifier'),
                        'type' => 'text',
                        'align' => 'center',
                ),
                'card_number' => array(
                        'title' => $this->l('Card Number'),
                        'type' => 'text',
                        'align' => 'center',
                ),
                'expiry_date' => array(
                        'title' => $this->l('Expiry date'),
                        'type' => 'text',
                        'callback' => 'getExpiryDate',
                        'align' => 'center',
                        'callback_object' => $this
                ),
        );

        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            $list = '<table class="table tableDnD" cellspacing="0" cellpadding="0"><tr>';
            foreach ($fields_list as $key => $field) {
                $list .= '<th>'.$field['title'].'</th>';
            }
            $list .= '</tr>';

            foreach ($list_identifiers as $identifier) {
                $list .= '<tr>';
                foreach ($fields_list as $key => $field) {
                    $list .= '<td>'.$identifier[$key].'</td>';
                }

                $list .= '</tr>';
            }

            $list .= '</table>';
        } else {
            $helper_list = new HelperList();
            $helper_list->module = $this;
            $helper_list->title = $this->l('Identifier Customer list (Click to Pay)');
            $helper_list->shopLinkType = '';
            $helper_list->no_link = true;
            $helper_list->show_toolbar = true;
            $helper_list->simple_header = (version_compare(_PS_VERSION_, '1.6', '<')) ? true : false;
            $helper_list->identifier = 'id_operation';
            $helper_list->actions = array('deleteidentifier');
            $helper_list->table = $this->name.'_clicktopay';
            $helper_list->list_id = $helper_list->table;
            $helper_list->currentIndex = $this->context->link->getAdminLink($this->tabClassName, false).'&configure='.$this->name;
            $helper_list->token = Tools::getAdminTokenLite($this->tabClassName);
            // This is needed for displayEnableLink to avoid code duplication
            $this->_helperlist = $helper_list;
            $helper_list->listTotal = count($list_identifiers);
            $helper_list->tpl_vars['icon'] = 'icon-AdminParentCustomer';
            if (version_compare(_PS_VERSION_, '1.6.0.14', '>')) {
                $helper_list->_default_pagination = $this->_default_pagination;
                $helper_list->_pagination = array(10);
            }

            /* Paginate the result */
            $page = ($page = Tools::getValue('submitFilter'.$helper_list->table)) ? $page : 1;
            $pagination = ($pagination = Tools::getValue($helper_list->table.'_pagination')) ? $pagination : $this->_default_pagination;
            $list_identifiers = $this->paginate($list_identifiers, $page, $pagination);

            $generated_list = $helper_list->generateList($list_identifiers, $fields_list);
        }

        return $generated_list;
    }



    public function getTransactions($params = false, $ordersPage = false)
    {
        $list_transactions = $this->getListTransactions($params);
        foreach ($list_transactions as $trans) {
            if ($trans['id_order'] == 0 && $trans['ds_response'] == 0) {
                $id_cart = $trans['id_cart'];
                $order = $this->getOrderByCart($id_cart);
                $id_order = $order['id_order'];
                $query_update = '
                        UPDATE `'.pSQL(_DB_PREFIX_.$this->name).'_transaction`
                        SET `id_order` = "'. $id_order .'"
                        WHERE `id_cart` = '.$id_cart;
                Db::getInstance()->execute($query_update);
            }
        }

        if ($ordersPage) {
            $fields_list = array(
                    'id_transaction' => array(
                            'title' => $this->l('Transaction Id'),
                            'type' => 'text',
                            'align' => 'center',
                    ),
                    'id_tpv' => array(
                            'title' => $this->l('Virtual POS'),
                            'type' => 'text',
                            'align' => 'center',
                            'callback' => 'getTPVName',
                            'callback_object' => $this
                    ),
                    'amount_total' => array(
                            'title' => $this->l('Amount Total Order'),
                            'type' => 'price',
                            'align' => 'center',
                    ),
                    'amount_refunded' => array(
                            'title' => $this->l('Refunded'),
                            'type' => 'price',
                            'align' => 'center',
                    ),
                    'ds_order' => array(
                            'title' => $this->l('DS Order'),
                            'type' => 'text',
                            'align' => 'center',
                            'callback_object' => $this
                    ),
                    'ds_authorisationcode' => array(
                            'title' => $this->l('DS Auth. Code'),
                            'type' => 'text',
                            'align' => 'center',
                            'callback_object' => $this
                    ),
                    'transaction_type' => array(
                            'title' => $this->l('Transaction type'),
                            'type' => 'text',
                            'align' => 'center',
                            'callback' => 'getTransactionTypeName',
                            'callback_object' => $this,
                            'badge_success' => true,
                            'badge_warning' => true,
                            'badge_danger' => true,
                            'class' => 'badge_cancel'
                    ),
                    'ds_response' => array(
                            'title' => $this->l('Response'),
                            'type' => 'text',
                            'align' => 'center',
                            'callback' => 'getResponseDescription',
                            'callback_object' => $this,
                            'badge_success' => true,
                            'badge_warning' => true,
                            'badge_danger' => true,
                            'class' => 'badge_cancel text-center',
                    ),
                    'transaction_date' => array(
                            'title' => $this->l('Date'),
                            'type' => 'datetime',
                            'align' => 'center',
                    ),
            );
        } else {
            $fields_list = array(
                    'id_transaction' => array(
                            'title' => $this->l('Transaction Id'),
                            'type' => 'text',
                            'align' => 'center',
                    ),
                    'id_order' => array(
                            'title' => $this->l('Id Order'),
                            'type' => 'text',
                            'align' => 'center',
                            'callback' => 'printGoToOrderButton',
                            'callback_object' => $this
                    ),
                    'id_tpv' => array(
                            'title' => $this->l('Virtual POS'),
                            'type' => 'text',
                            'align' => 'center',
                            'callback' => 'getTPVName',
                            'callback_object' => $this
                    ),
                    'id_customer' => array(
                            'title' => $this->l('Customer'),
                            'type' => 'text',
                            'align' => 'center',
                            'callback' => 'printGoToCustomerButton',
                            'callback_object' => $this
                    ),
                    'amount' => array(
                            'title' => $this->l('Total currency'),
                            'align' => 'center',
                            'type' => 'price',
                            'callback' => 'showPriceWithSymbol',
                            'callback_object' => $this
                    ),
                    'amount_total' => array(
                            'title' => $this->l('Total EUR'),
                            'type' => 'price',
                            'align' => 'center',
                    ),
                    'amount_refunded' => array(
                            'title' => $this->l('Refunded'),
                            'type' => 'price',
                            'align' => 'center',
                    ),
                    'id_currency' => array(
                            'title' => $this->l('Currency'),
                            'type' => 'text',
                            'align' => 'center',
                            'callback' => 'getCurrencyName',
                            'callback_object' => $this
                    ),
                    'transaction_type' => array(
                            'title' => $this->l('Transaction type'),
                            'type' => 'text',
                            'align' => 'center',
                            'callback' => 'getTransactionTypeName',
                            'callback_object' => $this,
                            'badge_success' => true,
                            'badge_warning' => true,
                            'badge_danger' => true,
                            'class' => 'badge_cancel'
                    ),
                    'ds_response' => array(
                            'title' => $this->l('Response'),
                            'type' => 'text',
                            'align' => 'center',
                            'callback' => 'getResponseDescription',
                            'callback_object' => $this,
                            'badge_success' => true,
                            'badge_warning' => true,
                            'badge_danger' => true,
                            'class' => 'badge_cancel text-center',
                    ),
                    'transaction_date' => array(
                            'title' => $this->l('Date'),
                            'type' => 'datetime',
                            'align' => 'center',
                    ),
            );
        }

        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            $list = '<table class="table tableDnD" cellspacing="0" cellpadding="0"><tr>';
            foreach ($fields_list as $key => $field) {
                $list .= '<th>'.$field['title'].'</th>';
            }
            $list .= '</tr>';

            foreach ($list_transactions as $transaction) {
                $list .= '<tr>';
                foreach ($fields_list as $key => $field) {
                    $list .= '<td>'.$transaction[$key].'</td>';
                }

                $list .= '</tr>';
            }

            $list .= '</table>';
        } else {
            $helper_list = new HelperList();
            $helper_list->module = $this;
            $helper_list->title = $this->l('Transactions list');
            $helper_list->shopLinkType = '';
            $helper_list->no_link = true;
            $helper_list->show_toolbar = true;
            $helper_list->simple_header = (version_compare(_PS_VERSION_, '1.6', '<') || $ordersPage) ? true : false;
            
            if (version_compare(_PS_VERSION_, '1.7.7', '>=') && isset($params['id_order']) && $params['id_order'] > 0) {
                $helper_list->simple_header = true;
            }

            $helper_list->identifier = 'id_transaction';

            if (version_compare(_PS_VERSION_, '1.7.6.1', '>=')) {
                $helper_list->table = 'transaction';
            } else {
                $helper_list->table = $this->name.'_transaction';
            }

            if ($ordersPage) {
                $helper_list->actions = array('partialconfirm', 'cancel', 'partialrefund', 'refund');
                $helper_list->token = Tools::getAdminTokenLite('AdminOrders');
            } else {
                $helper_list->token = Tools::getAdminTokenLite($this->tabClassName);
                $helper_list->actions = array('vieworder', 'partialconfirm', 'cancel', 'partialrefund', 'refund', 'deletetransaction');
            }

            $helper_list->list_id = $helper_list->table;
            $helper_list->currentIndex = $this->context->link->getAdminLink($this->tabClassName, false).'&configure='.$this->name;
            // This is needed for displayEnableLink to avoid code duplication
            $this->_helperlist = $helper_list;
            $helper_list->listTotal = count($list_transactions);
            $helper_list->tpl_vars['icon'] = 'icon-money';
            if (version_compare(_PS_VERSION_, '1.6.0.14', '>')) {
                $helper_list->_default_pagination = $this->_default_pagination;
                $helper_list->_pagination = array(10);
            }

            /* Paginate the result */
            $page = ($page = Tools::getValue('submitFilter'.$helper_list->table)) ? $page : 1;
            $pagination = ($pagination = Tools::getValue($helper_list->table.'_pagination')) ? $pagination : $this->_default_pagination;
            $list_transactions = $this->paginate($list_transactions, $page, $pagination);
            $generated_list = $helper_list->generateList($list_transactions, $fields_list);
        }

        return $generated_list;
    }

    public function getOrderIdFromTransactionId($id_transaction, $all = false)
    {
        $query = '
            SELECT id_order, id_cart FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction`
            WHERE `id_transaction` = '.(int)$id_transaction;
        $result = Db::getInstance()->getRow($query);
        if (!$all) {
            return $result['id_order'];
        } else {
            return $result;
        }
    }

    public function deleteIdentifier($id_operation)
    {
        $query = '
            DELETE FROM `'.pSQL(_DB_PREFIX_.$this->name).'_clicktopay`
            WHERE `id_operation` = '.pSQL($id_operation).';';
        if (Db::getInstance()->execute($query)) {
            return true;
        }
        return false;
    }

    public function deleteIdentifierByIdentifier($identifier)
    {
        $query = '
            DELETE FROM `'.pSQL(_DB_PREFIX_.$this->name).'_clicktopay`
            WHERE `identifier` = "'.pSQL(base64_decode($identifier)).'";';
        if (Db::getInstance()->execute($query)) {
            return true;
        }
        return false;
    }

    public function checkIdentifierExists($identifier)
    {
        $query = '
            SELECT identifier FROM `'.pSQL(_DB_PREFIX_.$this->name).'_clicktopay`
            WHERE `identifier` = "'.pSQL($identifier).'"';
        $result = Db::getInstance()->getRow($query);

        if (isset($result['identifier']) && !empty($result['identifier'])) {
            return true;
        }
        return false;
    }

    public function insertClicktoPay($identifier, $id_customer, $expiry_date, $card_number, $id_tpv, $cofTxnid = 0)
    {
        $sql = "INSERT INTO `"._DB_PREFIX_."redsys_clicktopay` (`identifier`, `id_tpv`, `card_number`, `id_customer`, `expiry_date`, `cofTxnid`, `id_shop`)
            VALUES ('".pSQL($identifier)."', '".pSQL($id_tpv)."', '".pSQL($card_number)."', '".pSQL($id_customer)."', '".pSQL($expiry_date)."', '".pSQL($cofTxnid)."', '".pSQL(Context::getContext()->shop->id)."')";
        return Db::getInstance()->Execute($sql);
    }

    public function deleteTransactionByTransactionId($id_transaction)
    {
        $query = '
            DELETE FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction`
            WHERE `id_transaction` = '.pSQL($id_transaction).';';
        if (Db::getInstance()->execute($query)) {
            return true;
        }
        return false;
    }

    public function getTransactionFromIdCart($id_cart)
    {
        $query = '
            SELECT * FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction`
            WHERE `id_cart` = '.(int)$id_cart;
        return Db::getInstance()->getRow($query);
    }

    public function getTransactionFromIdOrder($id_order)
    {
        $query = '
            SELECT * FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction`
            WHERE `id_order` = '.(int)$id_order.' AND `ds_response` = 0 AND `ds_authorisationcode` IS NOT NULL ORDER BY id_transaction DESC ';

        return Db::getInstance()->getRow($query);
    }

    public function getTransactionFromDsOrder($ds_order)
    {
        $query = '
            SELECT * FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction`
            WHERE `ds_order` = "'.pSQL($ds_order).'"';
        return Db::getInstance()->getRow($query);
    }

    public function getIdentifierFromId($id_operation)
    {
        $query = '
            SELECT * FROM `'.pSQL(_DB_PREFIX_.$this->name).'_clicktopay`
            WHERE `id_operation` = '.(int)$id_operation;
        return Db::getInstance()->getRow($query);
    }

    public function getIdentifierFromIdCustomer($id_customer)
    {
        $query = '
            SELECT * FROM `'.pSQL(_DB_PREFIX_.$this->name).'_clicktopay`
            WHERE `id_customer` = '.(int)$id_customer;
        return Db::getInstance()->getRow($query);
    }

    public function getTransactionFromIdTransaction($id_transaction)
    {
        $query = '
            SELECT * FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction`
            WHERE `id_transaction` = '.(int)$id_transaction;
        return Db::getInstance()->getRow($query);
    }

    private function getAmountRefundedFromTransactionId($id_transaction)
    {
        $sql = 'SELECT (SELECT SUM(amount_refunded) FROM `'.pSQL(_DB_PREFIX_.$this->name).'_refund` r WHERE r.id_order = t.id_order) AS amount_refunded, `id_shop`
                    FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction` t
                    WHERE `id_shop` = '.(int)$this->context->shop->id.'
                    AND `id_transaction` = '.(int)$id_transaction.'
                    ORDER BY transaction_date DESC;';
        return (float)Db::getInstance()->getValue($sql);
    }

    private function isTransactionRefundable($id_transaction)
    {
        $sql = 'SELECT `amount`, (SELECT SUM(amount_refunded) FROM `'.pSQL(_DB_PREFIX_.$this->name).'_refund` r WHERE r.id_order = t.id_order) AS amount_refunded, `ds_response`
                    FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction` t
                    WHERE `id_shop` = '.(int)$this->context->shop->id.'
                    AND `id_transaction` = '.(int)$id_transaction.';';
        $result = Db::getInstance()->getRow($sql);
        if ((number_format($result['amount'], 2) > number_format($result['amount_refunded'], 2)) && ((int)$result['ds_response'] <= 99 || (int)$result['ds_response'] == 900)) {
            return true;
        }
        return false;
    }

    private function isTransactionConfirmable($id_transaction)
    {
        $sql = 'SELECT `transaction_type`, `ds_response`
                    FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction` t
                    WHERE `id_shop` = '.(int)$this->context->shop->id.'
                    AND `id_transaction` = '.(int)$id_transaction.';';
        $result = Db::getInstance()->getRow($sql);
        if (($result['transaction_type'] == '1' || $result['transaction_type'] == '7') && $result['ds_response'] != '1000') {
            return true;
        }
        return false;
    }

    private function isTransactionDeletable($id_transaction)
    {
        $sql = 'SELECT `ds_response`
                FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction` t
                WHERE `id_shop` = '.(int)$this->context->shop->id.'
                AND `id_transaction` = '.(int)$id_transaction.';';
        $result = Db::getInstance()->getRow($sql);
        if ((int)$result['ds_response'] > 99 && (int)$result['ds_response'] != 400 && (int)$result['ds_response'] != 900 && (int)$result['ds_response'] != 1000) {
            return true;
        }
        return false;
    }

    public function displayViewOrderLink($token, $id)
    {
        $protocol = $this->getProtocolUrl();

        $result = $this->getOrderIdFromTransactionId($id, true);

        if ((int)$result['id_order'] > 0) {
            if (version_compare(_PS_VERSION_, '1.6', '<')) {
                $token = Tools::getAdminTokenLite('Order');
                $url_orders_controller = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'index.php?controller=AdminOrders&vieworder&id_order='.$result['id_order'].'&vieworders&token='.$token;
            } else {
                $url_orders_controller = $this->context->link->getAdminLink('AdminOrders');
            }
            $this->context->smarty->assign(array(
                'href' => $url_orders_controller.'&vieworder&id_order='.$result['id_order'].'&vieworders',
                'action' => $this->l('View order')
            ));
        } elseif ((int)$result['id_order'] == 0) {
            if (version_compare(_PS_VERSION_, '1.6', '<')) {
                $token = Tools::getAdminTokenLite('Cart');
                $url_carts_controller = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'index.php?controller=AdminCarts&viewcart&id_cart='.$result['id_cart'].'&viewcarts&token='.$token;
            } else {
                $url_carts_controller = $this->context->link->getAdminLink('AdminCarts').'&viewcart&id_cart='.$result['id_cart'].'&viewcarts';
            }
            $this->context->smarty->assign(array(
                'href' => $url_carts_controller,
                'action' => $this->l('View cart'),
                'token' => $token
            ));
        }
        return $this->context->smarty->fetch('helpers/list/list_action_view.tpl');
    }

    public function displayViewOrderFromRefundLink($token, $id)
    {
        $id_order = $this->getOrderIdFromRefundId($id);
        $this->context->smarty->assign(array(
            'href' => $this->context->link->getAdminLink('AdminOrders').'&vieworder&id_order='.$id_order.'&vieworders',
            'action' => $this->l('View order'),
            'token' => $token
        ));

        return $this->context->smarty->fetch('helpers/list/list_action_view.tpl');
    }

    public function displayRefundLink($token, $id)
    {
        /*if (!Context::getContext()->employee->isSuperAdmin()) {
            return;
        }*/

        if ($this->isTransactionConfirmable($id)) {
            return;
        }
        $protocol = $this->getProtocolUrl();

        $id_order = $this->getOrderIdFromTransactionId($id);
        if ($id_order == null) {
            return false;
        }
        $order = new Order($id_order);
        $transaction = $this->getTransactionFromIdOrder($id_order);
        if (empty($transaction) || !$transaction['id_tpv'] || $transaction['id_tpv'] == '' || !$order->id) {
            return;
        }
        if (!$this->isTransactionRefundable($id)) {
            return;
        }
        $amount_refunded = $this->getAmountRefundedFromTransactionId($transaction['id_transaction']);
        if ($amount_refunded > 0) {
            return false;
        }
        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            $redsysmanagement = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/controllers/admin/AdminRedsysManagementController.php?t='.$transaction['id_tpv'];
        } else {
            $redsysmanagement = $this->context->link->getAdminLink('AdminRedsysManagement');
        }
        $currency = new Currency($this->getIdByIsoCodeNum($transaction['id_currency'], (int)Context::getContext()->shop->id));

        $tpl = $this->context->smarty->createTemplate(_PS_ROOT_DIR_.'/modules/redsys/views/templates/admin/redsys_tpv/helpers/list/list_action_refund.tpl');

        $tpl->assign(array(
            'redsysmanagement' => $redsysmanagement.'&origin=module',
            'id_order' => $id_order,
            'id_t' => $id,
            'id_tpv' => $transaction['id_tpv'],
            'amount' => Tools::displayPrice($transaction['amount_total'], $currency),
            'href' => '#form-redsys_tpv',
            'token' => Tools::getAdminToken((string)$this->tabClassName),
            'action' => $this->l('Total refund'),
            'token_2' => $token
        ));
        return $tpl->fetch();
    }

    public function displayPartialRefundLink($token, $id)
    {
        /*if (!Context::getContext()->employee->isSuperAdmin()) {
            return;
        }*/

        $protocol = $this->getProtocolUrl();
        $id_order = $this->getOrderIdFromTransactionId($id);
        if ($id_order == null) {
            return false;
        }
        $order = new Order($id_order);
        $transaction = $this->getTransactionFromIdOrder($id_order);
        if (empty($transaction) || !$transaction['id_tpv'] || $transaction['id_tpv'] == '' || !$order->id) {
            return;
        }
        if (!$this->isTransactionRefundable($id)) {
            return;
        }
        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            $redsysmanagement = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/controllers/admin/AdminRedsysManagementController.php?t='.$transaction['id_tpv'];
        } else {
            $redsysmanagement = $this->context->link->getAdminLink('AdminRedsysManagement');
        }

        $currency = new Currency($this->getIdByIsoCodeNum($transaction['id_currency'], (int)Context::getContext()->shop->id));


        $amount_refunded = $this->getAmountRefundedFromTransactionId($transaction['id_transaction']);
        $tpl = $this->context->smarty->createTemplate(_PS_ROOT_DIR_.'/modules/redsys/views/templates/admin/redsys_tpv/helpers/list/list_action_partial_refund.tpl');
        $tpl->assign(array(
            'redsysmanagement' => $redsysmanagement.'&origin=module',
            'id_order' => $id_order,
            'id_t' => $id,
            'id_tpv' => $transaction['id_tpv'],
            'amount' => Tools::displayPrice($transaction['amount'], $currency),
            'max' => $order->total_paid,
            'amount_refunded' => $amount_refunded,
            'href' => '#form-redsys_tpv',
            'token' => Tools::getAdminToken((string)$this->tabClassName),
            'action' => $this->l('Partial refund'),
            'token_2' => $token
        ));
        return $tpl->fetch();
    }

    public function displayPartialConfirmLink($token, $id)
    {
        $protocol = $this->getProtocolUrl();
        $id_order = $this->getOrderIdFromTransactionId($id);
        if ($id_order == null) {
            return false;
        }
        $order = new Order($id_order);
        $transaction = $this->getTransactionFromIdOrder($id_order);

        if (empty($transaction) || !$transaction['id_tpv'] || $transaction['id_tpv'] == '' || !$order->id) {
            return;
        }
        if (!$this->isTransactionConfirmable($id)) {
            return;
        }
        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            $redsysmanagement = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/controllers/admin/AdminRedsysManagementController.php?t='.$transaction['id_tpv'];
        } else {
            $redsysmanagement = $this->context->link->getAdminLink('AdminRedsysManagement');
        }
        $currency = new Currency($this->getIdByIsoCodeNum($transaction['id_currency'], (int)Context::getContext()->shop->id));

        $tpl = $this->context->smarty->createTemplate(_PS_ROOT_DIR_.'/modules/redsys/views/templates/admin/redsys_tpv/helpers/list/list_action_partial_confirm.tpl');

        $tpl->assign(array(
            'redsysmanagement' => $redsysmanagement.'&origin=module',
            'id_order' => $id_order,
            'id_t' => $id,
            'id_tpv' => $transaction['id_tpv'],
            'amount' => Tools::displayPrice($transaction['amount'], $currency),
            //'amount' => Tools::displayPrice($order->total_paid, $currency),
            //'max' => number_format($order->total_paid, 2),
            'max' => number_format($transaction['amount'], 2),
            'href' => '#form-redsys_tpv',
            'token' => Tools::getAdminToken($this->tabClassName),
            'action' => $this->l('Confirm transaction'),
            'method' => $transaction['transaction_type'] == 1 ? 'confirm' : 'confirm_authentication',
            'token_2' => $token
        ));
        return $tpl->fetch();
    }

    public function displayCancelLink($token, $id)
    {
        $protocol = $this->getProtocolUrl();
        $id_order = $this->getOrderIdFromTransactionId($id);
        if ($id_order == null) {
            return false;
        }
        $order = new Order($id_order);
        $transaction = $this->getTransactionFromIdOrder($id_order);
        if (empty($transaction) || !$transaction['id_tpv'] || $transaction['id_tpv'] == '' || !$order->id) {
            return;
        }
        if (!$this->isTransactionConfirmable($id)) {
            return;
        }
        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            $redsysmanagement = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/controllers/admin/AdminRedsysManagementController.php?t='.$transaction['id_tpv'];
        } else {
            $redsysmanagement = $this->context->link->getAdminLink('AdminRedsysManagement');
        }
        $currency = new Currency($this->getIdByIsoCodeNum($transaction['id_currency'], (int)Context::getContext()->shop->id));

        $tpl = $this->context->smarty->createTemplate(_PS_ROOT_DIR_.'/modules/redsys/views/templates/admin/redsys_tpv/helpers/list/list_action_cancel.tpl');

        $tpl->assign(array(
            'redsysmanagement' => $redsysmanagement.'&origin=module',
            'id_order' => $id_order,
            'id_t' => $id,
            'id_tpv' => $transaction['id_tpv'],
            'amount' => Tools::displayPrice($order->total_paid, $currency),
            'max' => number_format($order->total_paid, 2),
            'href' => '#form-redsys_tpv',
            'token' => Tools::getAdminToken($this->tabClassName),
            'action' => $this->l('Cancel transaction'),
            'token_2' => $token
        ));
        return $tpl->fetch();
    }

    public function displayDeleteTransactionLink($token, $id)
    {
        $protocol = $this->getProtocolUrl();
        $transaction = $this->getTransactionFromIdTransaction($id);
        if (empty($transaction) || !$transaction['id_tpv'] || $transaction['id_tpv'] == '') {
            return;
        }
        if (!$this->isTransactionDeletable($id)) {
            return;
        }
        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            $redsysmanagement = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/controllers/admin/AdminRedsysManagementController.php?t='.$transaction['id_tpv'];
        } else {
            $redsysmanagement = $this->context->link->getAdminLink('AdminRedsysManagement');
        }

        $tpl = $this->context->smarty->createTemplate(_PS_ROOT_DIR_.'/modules/redsys/views/templates/admin/redsys_tpv/helpers/list/list_action_delete_transaction.tpl');

        $tpl->assign(array(
            'redsysmanagement' => $redsysmanagement.'&origin=module',
            'id_t' => $id,
            'href' => '#form-redsys_tpv',
            'token' => Tools::getAdminToken($this->tabClassName),
            'action' => $this->l('Delete transaction'),
            'token_2' => $token
        ));
        return $tpl->fetch();
    }

    public function displayDeleteIdentifierLink($token, $id)
    {
        $protocol = $this->getProtocolUrl();
        $identifier = $this->getIdentifierFromId($id);
        if (empty($identifier)) {
            return;
        }

        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            $redsysmanagement = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/controllers/admin/AdminRedsysManagementController.php?t='.$transaction['id_tpv'];
        } else {
            $redsysmanagement = $this->context->link->getAdminLink('AdminRedsysManagement');
        }

        $tpl = $this->context->smarty->createTemplate(_PS_ROOT_DIR_.'/modules/redsys/views/templates/admin/redsys_tpv/helpers/list/list_action_delete_identifier.tpl');

        $tpl->assign(array(
            'redsysmanagement' => $redsysmanagement.'&origin=module',
            'id_t' => $id,
            'identifier' => $identifier['identifier'],
            'expiry_date' => $identifier['expiry_date'],
            'customer' => $identifier['id_customer'],
            'href' => '#form-redsys_tpv',
            'token' => Tools::getAdminToken($this->tabClassName),
            'action' => $this->l('Delete identifier'),
            'token_2' => $token
        ));
        return $tpl->fetch();
    }

    public function getRefunds($params = false, $ordersPage = false)
    {
        $list_refunds = $this->getListRefunds($params);

        $fields_list = array(
                'id_refund' => array(
                        'title' => $this->l('Refund Id'),
                        'type' => 'text',
                ),
                'id_tpv' => array(
                        'title' => $this->l('Id Virtual POS'),
                        'type' => 'text',
                ),
                'id_order' => array(
                        'title' => $this->l('Order Id'),
                        'type' => 'text',
                ),
                'amount_refunded' => array(
                        'title' => $this->l('Amount Refunded'),
                        'type' => 'price',
                ),
                'ds_response' => array(
                        'title' => $this->l('Response'),
                        'type' => 'text',
                ),
                'ds_currency' => array(
                        'title' => $this->l('Currency'),
                        'type' => 'text',
                        'callback' => 'getCurrencyName',
                        'callback_object' => $this
                ),
                'refund_date' => array(
                        'title' => $this->l('Date'),
                        'type' => 'datetime',
                ),
        );

        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            $list = '<table class="table tableDnD" cellspacing="0" cellpadding="0"><tr>';
            foreach ($fields_list as $key => $field) {
                $list .= '<th>'.$field['title'].'</th>';
            }
            $list .= '</tr>';

            foreach ($list_refunds as $refund) {
                $list .= '<tr>';
                foreach ($fields_list as $key => $field) {
                    $list .= '<td>'.$refund[$key].'</td>';
                }
                $list .= '</tr>';
            }

            $list .= '</table>';
        } else {
            $helper_list = new HelperList();
            $helper_list->module = $this;
            $helper_list->title = $this->l('Refunds list');
            $helper_list->shopLinkType = '';
            $helper_list->no_link = true;
            $helper_list->show_toolbar = true;
            $helper_list->simple_header = (version_compare(_PS_VERSION_, '1.6', '<') || $ordersPage) ? true : false;

            $helper_list->identifier = 'id_refund';
            $helper_list->table = $this->name.'_refund';
            $helper_list->currentIndex = $this->context->link->getAdminLink($this->tabClassName, false).'&configure='.$this->name;
            $helper_list->token = Tools::getAdminTokenLite($this->tabClassName);

            if ($ordersPage) {
                $helper_list->token = Tools::getAdminTokenLite('AdminOrders');
            }

            $helper_list->tpl_vars['icon'] = 'icon-money';
            // This is needed for displayEnableLink to avoid code duplication
            $this->_helperlist = $helper_list;
            $helper_list->listTotal = count($list_refunds);

            if (version_compare(_PS_VERSION_, '1.6.0.14', '>')) {
                $helper_list->_default_pagination = $this->_default_pagination;
                $helper_list->_pagination = array(10);
            }
            /* Paginate the result */

            $page = ($page = Tools::getValue('submitFilter'.$helper_list->table)) ? $page : 1;
            $pagination = ($pagination = Tools::getValue($helper_list->table.'_pagination')) ? $pagination : $this->_default_pagination;
            $list_refunds = $this->paginate($list_refunds, $page, $pagination);

            $generated_list = $helper_list->generateList($list_refunds, $fields_list);
        }

        return $generated_list;
    }

    private function getListTransactions($params = false)
    {
        $_filters = '';
        $_order = '`transaction_date` DESC';
        if ((Tools::isSubmit('submitFiltertransaction') && (int)Tools::getValue('submitFiltertransaction') > 0) || (Tools::isSubmit('submitFilterredsys_transaction') && (int)Tools::getValue('submitFilterredsys_transaction') > 0)) {
            if (!empty($this->_filters)) {
                foreach ($this->_filters as $_field => $_value) {
                    if (!is_array($_value)) {
                        if ($_value != '') {
                            $_filters .= ' AND '.str_replace('filter_', '', $_field).' = "'.pSQL($_value).'"';
                        }
                    } else {
                        if ($_value[0] != '' && $_field == 'filter_transaction_date_from') {
                            $_filters .= ' AND `transaction_date` >= "'.pSQL($_value[0]).'"';
                        } elseif ($_value[1] != '' && $_field == 'filter_transaction_date_to') {
                            $_filters .= ' AND `transaction_date` <= DATE_ADD("'.pSQL($_value[1]).'", INTERVAL 1 DAY)';
                        }
                    }
                }
            }
        }

        if ($params) {
            $_filters .= ' AND `id_order` = '.(int)$params['id_order'];
        }
        if (Tools::isSubmit('redsys_transactionOrderby') && Tools::getValue('redsys_transactionOrderway')) {
            $_order = '`'.Tools::getValue('redsys_transactionOrderby').'` '.Tools::getValue('redsys_transactionOrderway');
        }

         $sql = 'SELECT `id_transaction`, `id_tpv`, `id_customer`, `id_cart`, `id_order`, `id_currency`, `ds_order`, `amount`, `amount_total`, `ds_response`, `ds_authorisationcode`, `transaction_date`,
                  `transaction_type`, IF((`transaction_type` = "0" AND `ds_response` <= 99) OR (`transaction_type` IN ("0", "2", "8") AND `ds_response` IN (400, 900, 0000)), 1, 0) badge_success,
                  IF(`transaction_type` = "1" OR `transaction_type` = "7" AND `ds_response` <= 99, 1, 0) badge_warning, IF(`ds_response` = 1000, 1, 0) badge_cancel,
                  IF(`ds_response` > 99 AND `ds_response` NOT IN (400, 900, 1000), 1, 0) badge_danger,
                  (SELECT COALESCE(SUM(amount_refunded), 0) FROM `'.pSQL(_DB_PREFIX_.$this->name).'_refund` r WHERE r.id_order = t.id_order) AS amount_refunded, `id_shop`
                FROM `'.pSQL(_DB_PREFIX_.$this->name).'_transaction` t
                WHERE (t.`id_shop` = '.(int)$this->context->shop->id. ' OR t.`id_shop` = 0)'.
                        $_filters.'
                ORDER BY '.pSQL($_order);

        return Db::getInstance()->executeS($sql);
    }

    private function getListRefunds($params = false)
    {
        $_filters = '';
        $_order = '`refund_date` DESC';
        if (Tools::isSubmit('submitFilterredsys_refund') && (int)Tools::getValue('submitFilterredsys_refund') > 0) {
            foreach ($this->_filters as $_field => $_value) {
                if (!is_array($_value)) {
                    if ($_value != '') {
                        $_filters .= ' AND '.str_replace('filter_', '', $_field).' = "'.pSQL($_value).'"';
                    }
                } else {
                    if ($_value[0] != '' && $_field == 'filter_refund_date_from') {
                        $_filters .= ' AND `refund_date` >= "'.pSQL($_value[0]).'"';
                    } elseif ($_value[1] != '' && $_field == 'filter_refund_date_to') {
                        $_filters .= ' AND `refund_date` <= DATE_ADD("'.pSQL($_value[1]).'", INTERVAL 1 DAY)';
                    }
                }
            }
        }
        if ($params) {
            $_filters .= ' AND `id_order` = '.(int)$params['id_order'];
        }
        if (Tools::isSubmit('redsys_refundOrderby') && Tools::getValue('redsys_refundOrderway')) {
            $_order = '`'.Tools::getValue('redsys_refundOrderby').'` '.Tools::getValue('redsys_refundOrderway');
        }
        $sql = 'SELECT `id_refund`, `id_tpv`, `id_transaction`, `id_order`, `ds_currency`, `ds_order`, `ds_response`, `ds_authorisationcode`, `amount_refunded`, `refund_date`,
                  IF(`ds_response` IN ("0900", "0400"), 1, 0) badge_success, IF(`ds_response` NOT IN ("0900", "0400"), 1, 0) badge_danger
                FROM `'.pSQL(_DB_PREFIX_.$this->name).'_refund` r
                WHERE (r.`id_shop` = '.(int)$this->context->shop->id. ' OR r.`id_shop` = 0)'.
                        $_filters.'
                ORDER BY '.pSQL($_order);

        return Db::getInstance()->executeS($sql);
    }

    private function getListIdentifiers($params = false)
    {
        $_filters = '';
        if (Tools::isSubmit('submitFilterredsys_clicktopay') && (int)Tools::getValue('submitFilterredsys_clicktopay') > 0) {
            if (!empty($this->_filters)) {
                foreach ($this->_filters as $_field => $_value) {
                    if (!is_array($_value)) {
                        if ($_value != '') {
                            $_filters .= ' AND '.str_replace('filter_', '', $_field).' = "'.pSQL($_value).'"';
                        }
                    }
                }
            }
        }

        if (Tools::isSubmit('redsys_transactionOrderby') && Tools::getValue('redsys_transactionOrderway')) {
            $_order = '`'.Tools::getValue('redsys_transactionOrderby').'` '.Tools::getValue('redsys_transactionOrderway');
        }

        $sql = 'SELECT `id_operation`, `identifier`, `card_number`, `id_customer`, `expiry_date`
                FROM `'.pSQL(_DB_PREFIX_.$this->name).'_clicktopay` c
                WHERE (c.`id_shop` = '.(int)$this->context->shop->id. ' OR c.`id_shop` = 0)'.
                        $_filters;

        return Db::getInstance()->executeS($sql);
    }

    public function execPayment($cart, $method = null)
    {
        $redsys = new redsys();

        $config = Configuration::getMultiple(
            array(
                'REDSYS_ENVIRONMENT_REAL',
                'REDSYS_NAME',
                'REDSYS_NUMBER',
                'REDSYS_ENCRYPTION_KEY',
                'REDSYS_TERMINAL',
                'REDSYS_TRANSACTION_TYPE',
                'REDSYS_CURRENCY',
                'REDSYS_SSL',
                'REDSYS_PAYMENT_TYPE',
                'REDSYS_PAYMENT_ERROR',
                'REDSYS_ENABLE_TRANSLATION',
                'REDSYS_MINIMUM_AMOUNT_CUR',
                'REDSYS_MIN_AMOUNT',
                'REDSYS_MAXIMUM_AMOUNT_CUR',
                'REDSYS_MAX_AMOUNT',
                'REDSYS_LOGO',
                'REDSYS_PAYMENT_SIZE',
                'REDSYS_CREATE_ORDER',
                'REDSYS_ACTIVE_REDSYS',
                'REDSYS_INTEGRATION',
                'REDSYS_CLICKTOPAY',
                'REDSYS_IUPAY',
                'REDSYS_AWAITING_PAYMENT_REDSYS',
            )
        );

        $link = new Link();

        // order number is composed by the last 8 digits of the id_cart and a timestamp in mmss
        $merchant_order = str_pad($cart->id, 8, '0', STR_PAD_LEFT).date('is');

        $protocol = $redsys->getProtocolUrl();

        //$store_url = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/respuesta_tpv.php';
        $store_url = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/respuesta_tpv.php';

        $products = $cart->getProducts();

        $id_cart = (int)$cart->id;

        $str_products = '';
        foreach ($products as $product) {
            $str_products .= $product['quantity'].' '.$product['name'].', ';
        }
        //Remove last ', '
        $str_products = preg_replace("/[^A-Za-z0-9 ]/", '', Tools::substr($str_products, 0, -2));

        $customer = new Customer((int)$cart->id_customer);

        $integration = $config['REDSYS_INTEGRATION'];

        if ($integration == 0) {
            if (version_compare(_PS_VERSION_, '1.6', '<')) {
                $url_ok = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'order-confirmation.php?key='.$cart->secure_key.'&id_cart='.$id_cart.'&id_module='.(int)$redsys->id.'&id_order='.(int)$merchant_order;
                $url_ko = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/pago_error.php';
            } else {
                $values = array(
                    'key' => $cart->secure_key,
                    'id_module' => (int)$redsys->id,
                    'id_cart' => (int)$id_cart,
                    'id_order' => (int)$merchant_order
                );
                $url_ok = $link->getModuleLink('redsys', 'okpayment', $values, true);
                $url_ko = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'index.php?fc=module&module=redsys&controller=errorpayment';
            }
        } else {
            if (version_compare(_PS_VERSION_, '1.6', '<')) {
                $url_ok = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/okpayment.php?key='.$cart->secure_key.'&id_cart='.$id_cart.'&id_module='.(int)$redsys->id.'&id_order='.(int)$merchant_order;
                $url_ko = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/redsys/errorpayment.php';
            } else {
                $values = array(
                    'key' => $cart->secure_key,
                    'id_module' => (int)$redsys->id,
                    'id_cart' => (int)$id_cart,
                    'id_order' => (int)$merchant_order
                );
                $url_ok = $link->getModuleLink('redsys', 'okpayment', $values, true);
                $url_ko = $protocol.$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'index.php?fc=module&module=redsys&controller=errorpayment';
            }
        }

        $merchant_amount_noconvert = number_format($cart->getOrderTotal(true, 3), 2, '.', '');

        // initialize merchant_amount
        $merchant_amount = 0;

        $id_currency_from_value = (int)$cart->id_currency;
        $id_currency_merchant_value = new Currency($this->getIdByIsoCodeNum((int)$config['REDSYS_CURRENCY'], (int)$id_shop));

        if ($id_currency_from_value != $id_currency_merchant_value) {
            $currency_from = new Currency($id_currency_from_value);
            $currency_to = new Currency($id_currency_merchant_value);

            if (version_compare(_PS_VERSION_, '1.5', '<')) {
                $merchant_amount = number_format(Tools::convertPrice($cart->getOrderTotal(true, 3), $currency_from, $currency_to), 2, '.', '');
            } else {
                $merchant_amount = number_format(Tools::convertPriceFull($cart->getOrderTotal(true, 3), $currency_from, $currency_to), 2, '.', '');
            }
        } else {
            $merchant_amount = $merchant_amount_noconvert;
        }

        $merchant_amount = str_replace('.', '', $merchant_amount);
        $merchant_amount = $merchant_amount;

        $merchant_language = '001';

        if ($config['REDSYS_ENABLE_TRANSLATION'] == 1) {
            $ps_language = new Language((int)$cart->id_lang);
            $ps_language_iso_code = $ps_language->iso_code;

            switch ($ps_language_iso_code) {
                case 'es':
                    $merchant_language = '001';
                    break;
                case 'en':
                    $merchant_language = '002';
                    break;
                case 'ca':
                    $merchant_language = '003';
                    break;
                case 'fr':
                    $merchant_language = '004';
                    break;
                case 'de':
                    $merchant_language = '005';
                    break;
                case 'nl':
                    $merchant_language = '006';
                    break;
                case 'it':
                    $merchant_language = '007';
                    break;
                case 'sv':
                    $merchant_language = '008';
                    break;
                case 'pt':
                    $merchant_language = '009';
                    break;
                case 'pl':
                    $merchant_language = '011';
                    break;
                case 'gl':
                    $merchant_language = '012';
                    break;
                case 'eu':
                    $merchant_language = '013';
                    break;
                default:
                    $merchant_language = '002';
            }
        } else {
            $merchant_language = '0';
        }

        $signObject = new RedsysAPI();
        $signObject->setParameter("DS_MERCHANT_AMOUNT", $merchant_amount);
        $signObject->setParameter("DS_MERCHANT_ORDER", (string)$merchant_order);
        $signObject->setParameter("DS_MERCHANT_MERCHANTCODE", $config['REDSYS_NUMBER']);
        $signObject->setParameter("DS_MERCHANT_CURRENCY", $config['REDSYS_CURRENCY']);
        $signObject->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $config['REDSYS_TRANSACTION_TYPE']);
        $signObject->setParameter("DS_MERCHANT_TERMINAL", $config['REDSYS_TERMINAL']);
        $signObject->setParameter("DS_MERCHANT_MERCHANTURL", $store_url);
        $signObject->setParameter("DS_MERCHANT_URLOK", $url_ok);
        $signObject->setParameter("DS_MERCHANT_URLKO", $url_ko);
        $signObject->setParameter("Ds_Merchant_ConsumerLanguage", $merchant_language);
        $signObject->setParameter("Ds_Merchant_ProductDescription", $str_products);
        $signObject->setParameter("Ds_Merchant_Titular", $customer->firstname.' '.$customer->lastname);
        $signObject->setParameter("Ds_Merchant_MerchantData", $merchant_amount_noconvert);
        $signObject->setParameter("Ds_Merchant_MerchantName", $config['REDSYS_NAME']);
        $signObject->setParameter("Ds_Merchant_Module", $redsys->name);

        $version = "HMAC_SHA256_V1";

        $merchant_url = 'https://sis.redsys.es/sis/realizarPago/utf-8';
        $encryption_key = $config['REDSYS_ENCRYPTION_KEY'];

        if ($config['REDSYS_ENVIRONMENT_REAL'] == 0) {
            $merchant_url = 'https://sis-t.redsys.es:25443/sis/realizarPago/utf-8';
            //$encryption_key = "sq7HjrUOBfKmC576ILgskD5srU870gJ7";
        }

        $merchant_order = Tools::substr($merchant_order, 0, 8);
        if ($config['REDSYS_CREATE_ORDER'] == 1) {
            $redsys->validateOrder($merchant_order, $config['REDSYS_AWAITING_PAYMENT_REDSYS'], $merchant_amount/100, $redsys->displayName, null, null, null, false, $cart->secure_key);
        }

        if ($method == 'clicktopay') {
            $signObject->setParameter("Ds_Merchant_PayMethods", $config["REDSYS_PAYMENT_TYPE"]);

            if ($identifier = Tools::getValue('identifier')) {
                $signObject->setParameter("Ds_Merchant_Identifier", $identifier);
            } else {
                $signObject->setParameter("Ds_Merchant_Identifier", 'REQUIRED');
            }
            $paramsBase64 = $signObject->createMerchantParameters();
            $signatureMac = $signObject->createMerchantSignature($encryption_key, false, false);

            $this->context->smarty->assign(array(
                'urltpv' => $merchant_url,
                'signatureVersion' => $version,
                'parameter' => $paramsBase64,
                'signature' => $signatureMac,
                'integration' => $config['REDSYS_INTEGRATION'],
                'tpv_id' => 1
            ));
            echo $this->context->smarty->fetch(_PS_MODULE_DIR_.'redsys/views/templates/front/payment.tpl');
        } else {
            $signObject->setParameter("Ds_Merchant_PayMethods", $config["REDSYS_PAYMENT_TYPE"]);
            $paramsBase64 = $signObject->createMerchantParameters();
            $signatureMac = $signObject->createMerchantSignature($encryption_key, false, false);

            $this->context->smarty->assign(array(
                'urltpv' => $merchant_url,
                'signatureVersion' => $version,
                'parameter' => $paramsBase64,
                'signature' => $signatureMac,
                'integration' => $config['REDSYS_INTEGRATION'],
                'tpv_id' => 1
            ));
            echo $this->context->smarty->fetch(_PS_MODULE_DIR_.'redsys/views/templates/front/payment.tpl');
        }
        die;
    }

    public function getIdByIsoCodeNum($isoCodeNum, $shopId = null)
    {
        if (version_compare(_PS_VERSION_, '1.7.6.0', '>=')) {
            $shopId = $shopId ?: Context::getContext()->shop->id;
            $sql = (new DbQuery())
                ->select('c.id_currency')
                ->from('currency', 'c')
                ->innerJoin('currency_shop', 'cs', 'c.`id_currency` = cs.`id_currency`')
                ->where('`numeric_iso_code` = ' . (int) $isoCodeNum)
                ->where('cs.`id_shop` = ' . (int) $shopId)
                ->where('c.`deleted` = 0')
                ->where('c.`active` = 1');
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
            if (empty($result) && $isoCodeNum > 0) {
                $isoCode = $this->getIsoCodeByIsoCodeNum($isoCodeNum);
                if ($isoCode) {
                    return $this->getIdByIsoCode($isoCode);
                } else {
                    return 0;
                }
            }
            return $result;
        } elseif (version_compare(_PS_VERSION_, '1.7', '>=')) {
            $currencies = Tools::getCldr(Context::getContext())->getAllCurrencies();
            foreach ($currencies as $key => $currency) {
                if ($currency['iso_code'] == $isoCodeNum) {
                    return Currency::getIdByIsoCode($currency['code'], $shopId);
                }
            }
        } else {
            return Currency::getIdByIsoCodeNum($isoCodeNum, $shopId);
        }
        return '--';
    }

    public function getIdByIsoCode($isoCode, $shopId = null)
    {
        $shopId = $shopId ?: Context::getContext()->shop->id;
        $sql = (new DbQuery())
            ->select('c.id_currency')
            ->from('currency', 'c')
            ->innerJoin('currency_shop', 'cs', 'c.`id_currency` = cs.`id_currency`')
            ->where('`iso_code` = \'' . $isoCode . '\'')
            ->where('cs.`id_shop` = ' . (int) $shopId)
            ->where('c.`deleted` = 0')
            ->where('c.`active` = 1');
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
    }

    public static function getNameByIsoCodeNum($isocodenum, $id_shop = 0)
    {
        if (version_compare(_PS_VERSION_, '1.7', '>=')) {
            $currencies = Tools::getCldr(Context::getContext())->getAllCurrencies();
            foreach ($currencies as $key => $currency) {
                if ($currency['iso_code'] == $isocodenum) {
                    return $currency['name'];
                }
            }
        } else {
            $query = '
                    SELECT *
                    FROM `'._DB_PREFIX_.'currency`
                    WHERE `deleted` = 0 AND `iso_code_num` = '.pSQL($isocodenum);

            if (version_compare(_PS_VERSION_, '1.5', '>=') && Shop::isFeatureActive() && $id_shop > 0) {
                $query = '
                    SELECT *
                    FROM `'._DB_PREFIX_.'currency` c, `'._DB_PREFIX_.'currency_shop` cs
                    WHERE `deleted` = 0
                    AND cs.id_currency = c.id_currency
                    AND cs.id_shop = \''.pSQL($id_shop).'\'
                    AND `iso_code_num` = '.pSQL($isocodenum);
            }

            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($query);

            if (is_array($result)) {
                return $result['name'];
            } else {
                return '';
            }
        }
    }

    protected function daysInMonth($month, $year)
    {
        // calculate number of days in a month
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

    public function formatExpiryDate($expiry_date)
    {
        $caducidad_str = '';
        if ($expiry_date != '') {
            $year = '20'.Tools::substr($expiry_date, 0, 2);
            $month = Tools::substr($expiry_date, 2);
            $days = $this->daysInMonth($month, $year);
            $caducidad_str = $year.'/'.$month.'/'.$days;

        }
        return $caducidad_str;
    }

    protected function getTpvByDsOrderId($ds_order_id)
    {
        $sql = 'SELECT `id_tpv`
                FROM `'._DB_PREFIX_.$this->name.'_transaction`
                WHERE ds_order = "'.pSQL($ds_order_id).'"';
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
        return $result;
    }

    protected function getTpvByOrderId($order_id)
    {
        $sql = 'SELECT `id_tpv`
                FROM `'._DB_PREFIX_.$this->name.'_transaction`
                WHERE id_order = "'.pSQL($order_id).'"';
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
        return $result;
    }

    public static function getOrderByCart($id_cart)
    {
        $sql = 'SELECT `id_order`, `reference`
                FROM `'._DB_PREFIX_.'orders`
                WHERE id_cart = '.pSQL($id_cart);

        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            $sql = 'SELECT `id_order`
                    FROM `'._DB_PREFIX_.'orders`
                    WHERE id_cart = '.pSQL($id_cart);
        }

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);

        return $result;
    }

    public function createOrderStateChecking()
    {
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));

        $name_en = "Redsys - Checking payment";
        $name_es = "Redsys - Revisar pago";

        $translations = array();
        $translations['en'] = $name_en;
        $translations['es'] = $name_es;

        if (Configuration::get('REDSYS_CHECKING_REDSYS')) {
            $orderState = new OrderState(Configuration::get('REDSYS_CHECKING_REDSYS'), $lang->id);
        } else {
            $orderState = new OrderState();
        }

        $orderState->template = 'payment';
        $orderState->name = array();
        $languages = Language::getLanguages(true);
        foreach ($languages as $lang) {
            $orderState->name[$lang['id_lang']] = isset($translations[$lang['iso_code']]) ? $translations[$lang['iso_code']] : $translations['en'];
        }

        $orderState->send_email = 1;
        $orderState->invoice = 0;
        $orderState->color = "#01B887";
        $orderState->unremovable = false;
        $orderState->logable = 1;
        $orderState->paid = 1;

        $orderState->save();
        copy(_PS_MODULE_DIR_.$this->name.'/logo.gif', _PS_IMG_DIR_.'os/'.$orderState->id.'.gif');
        return $orderState->id;
    }

    public function createOrderStateAwaiting()
    {
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));

        $name_en = "Redsys - Awaiting Payment";
        $name_es = "Redsys - Esperando pago";

        $translations = array();
        $translations['en'] = $name_en;
        $translations['es'] = $name_es;

        if (Configuration::get('REDSYS_AWAITING_PAYMENT_REDSYS')) {
            $orderState = new OrderState(Configuration::get('REDSYS_AWAITING_PAYMENT_REDSYS'), $lang->id);
        } else {
            $orderState = new OrderState();
        }

        $orderState->name = array();
        $languages = Language::getLanguages(true);
        foreach ($languages as $lang) {
            $orderState->name[$lang['id_lang']] = isset($translations[$lang['iso_code']]) ? $translations[$lang['iso_code']] : $translations['en'];
        }

        $orderState->send_email = 0;
        $orderState->invoice = 0;
        $orderState->color = "#f8dbec";
        $orderState->unremovable = false;
        $orderState->logable = 0;

        $orderState->save();
        copy(_PS_MODULE_DIR_.$this->name.'/logo.gif', _PS_IMG_DIR_.'os/'.$orderState->id.'.gif');
        return $orderState->id;
    }

    public function createOrderStateAdvancedPayment()
    {
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));

        $translations = array();
        $translations['en'] = 'Redsys - Advanced Payment';
        $translations['es'] = 'Redsys - Pago por adelantado';

        if (Configuration::get('REDSYS_ADVANCED_PAYMENT_STATE')) {
            $orderState = new OrderState(Configuration::get('REDSYS_ADVANCED_PAYMENT_STATE'), $lang->id);
        } else {
            $orderState = new OrderState();
        }

        $orderState->template = 'payment';
        $orderState->name = array();
        $languages = Language::getLanguages(true);
        foreach ($languages as $lang) {
            $orderState->name[$lang['id_lang']] = isset($translations[$lang['iso_code']]) ? $translations[$lang['iso_code']] : $translations['en'];
        }

        $orderState->send_email = 1;
        $orderState->invoice = 1;
        $orderState->pdf_invoice = 1;
        $orderState->color = "#32CD32";
        $orderState->unremovable = false;
        $orderState->logable = 1;
        $orderState->paid = 1;
        $orderState->save();

        copy(_PS_MODULE_DIR_.$this->name.'/logo.gif', _PS_IMG_DIR_.'os/'.$orderState->id.'.gif');
        return $orderState->id;
    }

    public function createOrderStateAwaitingConfirmation()
    {
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));

        $name_en = "Redsys - Awaiting Confirmation";
        $name_es = "Redsys - Esperando confirmación";

        $translations = array();
        $translations['en'] = $name_en;
        $translations['es'] = $name_es;

        if (Configuration::get('REDSYS_AWAITING_CONFIRMATION')) {
            $orderState = new OrderState(Configuration::get('REDSYS_AWAITING_CONFIRMATION'), $lang->id);
        } else {
            $orderState = new OrderState();
        }

        $orderState->name = array();
        $languages = Language::getLanguages(true);
        foreach ($languages as $lang) {
            $orderState->name[$lang['id_lang']] = isset($translations[$lang['iso_code']]) ? $translations[$lang['iso_code']] : $translations['en'];
        }

        $orderState->send_email = 0;
        $orderState->invoice = 0;
        $orderState->color = "#f8dbec";
        $orderState->unremovable = false;
        $orderState->logable = 0;
        $orderState->pdf_invoice = 0;
        $orderState->paid = 1;

        $orderState->save();
        copy(_PS_MODULE_DIR_.$this->name.'/logo.gif', _PS_IMG_DIR_.'os/'.$orderState->id.'.gif');
        return $orderState->id;
    }

    public function getProtocol($tpv = false)
    {
        $protocol = 'http://';

        if (isset($tpv->ssl) and $tpv->ssl == '1') {
            $protocol = 'https://';
        }
        return $protocol;
    }

    public function getProtocolUrl()
    {
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        } else {
            $protocol = 'http';
        }

        return $protocol . "://";
    }

    public function paginate($array_elements, $page = 1, $pagination = 5)
    {
        if (count($array_elements) > $pagination) {
            $array_elements = array_slice($array_elements, $pagination * ($page - 1), $pagination);
        }

        return $array_elements;
    }

    public function isZeroAnyIsoCodeCurrency()
    {
        $return = true;

        $currencies = Currency::getCurrencies();
        foreach ($currencies as $currency) {
            if ($currency['iso_code_num'] == 0) {
                $return = false;
                break;
            }
        }

        return $return;
    }

    public function isModuleActive($name_module, $function_exist = false)
    {
        if (Module::isInstalled($name_module)) {
            $module = Module::getInstanceByName($name_module);
            if (Validate::isLoadedObject($module) && $module->active) {
                if ($function_exist) {
                    if (method_exists($module, $function_exist)) {
                        return $module;
                    } else {
                        return false;
                    }
                }
                return $module;
            }
        }
        return false;
    }

    public static function getCartByOrderReference($reference)
    {
        $sql = "SELECT `id_cart` FROM `"._DB_PREFIX_."redsys_transaction` WHERE `ds_order` = '".pSQL($reference)."'";
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);

        $cart = false;

        if (is_array($result) && count($result) > 0) {
            $cart = new Cart((int)$result['id_cart']);
        }

        return $cart;
    }


    public function validateOrderFinal(
        $id_cart,
        $id_order_state,
        $amount_paid,
        $payment_method = 'Unknown',
        $message = null,
        $extra_vars = [],
        $currency_special = null,
        $dont_touch_amount = false,
        $secure_key = false,
        Shop $shop = null
    ) {
        if (self::DEBUG_MODE) {
            PrestaShopLogger::addLog('PaymentModule::validateOrder - Function called', 1, null, 'Cart', (int) $id_cart, true);
        }

        $decimals = _PS_PRICE_COMPUTE_PRECISION_ > 2 ? 2 : _PS_PRICE_COMPUTE_PRECISION_;
        if (version_compare(_PS_VERSION_, '1.7.7', '>=')) {
            $decimals = Context::getContext()->getComputingPrecision() > 2 ? 2 : Context::getContext()->getComputingPrecision();
        }

        if (!isset($this->context)) {
            $this->context = Context::getContext();
        }
        $this->context->cart = new Cart((int) $id_cart);
        $this->context->customer = new Customer((int) $this->context->cart->id_customer);
        // The tax cart is loaded before the customer so re-cache the tax calculation method
        $this->context->cart->setTaxCalculationMethod();

        if (version_compare(_PS_VERSION_, '1.7.7.3', '>=')) {
            $this->context->language = $this->context->cart->getAssociatedLanguage();
        } else {
            $this->context->language = new Language((int) $this->context->cart->id_lang);
        }

        $this->context->shop = ($shop ? $shop : new Shop((int) $this->context->cart->id_shop));
        ShopUrl::resetMainDomainCache();
        $id_currency = $currency_special ? (int) $currency_special : (int) $this->context->cart->id_currency;
        $this->context->currency = new Currency((int) $id_currency, null, (int) $this->context->shop->id);
        if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery') {
            $context_country = $this->context->country;
        }

        $order_status = new OrderState((int) $id_order_state, (int) $this->context->language->id);
        if (!Validate::isLoadedObject($order_status)) {
            PrestaShopLogger::addLog('PaymentModule::validateOrder - Order Status cannot be loaded', 3, null, 'Cart', (int) $id_cart, true);

            throw new PrestaShopException('Can\'t load Order status');
        }

        if (!$this->active) {
            PrestaShopLogger::addLog('PaymentModule::validateOrder - Module is not active', 3, null, 'Cart', (int) $id_cart, true);
            die(Tools::displayError());
        }

        // Does order already exists ?
        if (Validate::isLoadedObject($this->context->cart) && $this->context->cart->OrderExists() == false) {
            if ($secure_key !== false && $secure_key != $this->context->cart->secure_key) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Secure key does not match', 3, null, 'Cart', (int) $id_cart, true);
                die(Tools::displayError());
            }

            // For each package, generate an order
            $delivery_option_list = $this->context->cart->getDeliveryOptionList();
            $package_list = $this->context->cart->getPackageList();
            $cart_delivery_option = $this->context->cart->getDeliveryOption();

            // If some delivery options are not defined, or not valid, use the first valid option
            foreach ($delivery_option_list as $id_address => $package) {
                if (!isset($cart_delivery_option[$id_address]) || !array_key_exists($cart_delivery_option[$id_address], $package)) {
                    foreach ($package as $key => $val) {
                        $cart_delivery_option[$id_address] = $key;

                        break;
                    }
                }
            }

            $order_list = [];
            $order_detail_list = [];

            do {
                $reference = Order::generateReference();
            } while (Order::getByReference($reference)->count());

            $this->currentOrderReference = $reference;

            $cart_total_paid = (float) Tools::ps_round(
                (float) $this->context->cart->getOrderTotal(true, Cart::BOTH),
                $decimals
            );

            foreach ($cart_delivery_option as $id_address => $key_carriers) {
                foreach ($delivery_option_list[$id_address][$key_carriers]['carrier_list'] as $id_carrier => $data) {
                    foreach ($data['package_list'] as $id_package) {
                        // Rewrite the id_warehouse
                        $package_list[$id_address][$id_package]['id_warehouse'] = (int) $this->context->cart->getPackageIdWarehouse($package_list[$id_address][$id_package], (int) $id_carrier);
                        $package_list[$id_address][$id_package]['id_carrier'] = $id_carrier;
                    }
                }
            }
            // Make sure CartRule caches are empty
            CartRule::cleanCache();
            $cart_rules = $this->context->cart->getCartRules();
            foreach ($cart_rules as $cart_rule) {
                if (($rule = new CartRule((int) $cart_rule['obj']->id)) && Validate::isLoadedObject($rule)) {
                    if ($error = $rule->checkValidity($this->context, true, true)) {
                        $this->context->cart->removeCartRule((int) $rule->id);
                        if (isset($this->context->cookie, $this->context->cookie->id_customer) && $this->context->cookie->id_customer && !empty($rule->code)) {
                            Tools::redirect('index.php?controller=order&submitAddDiscount=1&discount_name=' . urlencode($rule->code));
                        } else {
                            $rule_name = isset($rule->name[(int) $this->context->cart->id_lang]) ? $rule->name[(int) $this->context->cart->id_lang] : $rule->code;
                            $error = $this->trans('The cart rule named "%1s" (ID %2s) used in this cart is not valid and has been withdrawn from cart', [$rule_name, (int) $rule->id], 'Admin.Payment.Notification');
                            PrestaShopLogger::addLog($error, 3, '0000002', 'Cart', (int) $this->context->cart->id);
                        }
                    }
                }
            }

            // Amount paid by customer is not the right one -> Status = payment error
            // We don't use the following condition to avoid the float precision issues : http://www.php.net/manual/en/language.types.float.php
            // if ($order->total_paid != $order->total_paid_real)
            // We use number_format in order to compare two string
            /*if ($order_status->logable && number_format($cart_total_paid, $decimals)) != number_format($amount_paid, _PS_PRICE_COMPUTE_PRECISION_)) {
                $id_order_state = Configuration::get('PS_OS_ERROR');
            }*/

            foreach ($package_list as $id_address => $packageByAddress) {
                foreach ($packageByAddress as $id_package => $package) {
                    $orderData = $this->createOrderFromCart(
                        $this->context->cart,
                        $this->context->currency,
                        $package['product_list'],
                        $id_address,
                        $this->context,
                        $reference,
                        $secure_key,
                        $payment_method,
                        $this->name,
                        $dont_touch_amount,
                        $amount_paid,
                        $package_list[$id_address][$id_package]['id_warehouse'],
                        $cart_total_paid,
                        self::DEBUG_MODE,
                        $order_status,
                        $id_order_state,
                        isset($package['id_carrier']) ? $package['id_carrier'] : null
                    );
                    $order = $orderData['order'];
                    $order_list[] = $order;
                    $order_detail_list[] = $orderData['orderDetail'];
                }
            }

            // The country can only change if the address used for the calculation is the delivery address, and if multi-shipping is activated
            if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery') {
                $this->context->country = $context_country;
            }

            if (!$this->context->country->active) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Country is not active', 3, null, 'Cart', (int) $id_cart, true);

                throw new PrestaShopException('The order address country is not active.');
            }

            if (self::DEBUG_MODE) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Payment is about to be added', 1, null, 'Cart', (int) $id_cart, true);
            }

            // Register Payment only if the order status validate the order
            if ($order_status->logable) {
                // $order is the last order loop in the foreach
                // The method addOrderPayment of the class Order make a create a paymentOrder
                // linked to the order reference and not to the order id
                if (isset($extra_vars['transaction_id'])) {
                    $transaction_id = $extra_vars['transaction_id'];
                } else {
                    $transaction_id = null;
                }

                if (!isset($order) || !$order->addOrderPayment($amount_paid, null, $transaction_id)) {
                    PrestaShopLogger::addLog('PaymentModule::validateOrder - Cannot save Order Payment', 3, null, 'Cart', (int) $id_cart, true);

                    throw new PrestaShopException('Can\'t save Order Payment');
                }
            }

            // Next !
            $only_one_gift = false;
            $products = $this->context->cart->getProducts();

            // Make sure CartRule caches are empty
            CartRule::cleanCache();
            foreach ($order_detail_list as $key => $order_detail) {
                /** @var OrderDetail $order_detail */
                $order = $order_list[$key];
                if (isset($order->id)) {
                    if (!$secure_key) {
                        $message .= '<br />' . $this->trans('Warning: the secure key is empty, check your payment account before validation', [], 'Admin.Payment.Notification');
                    }
                    // Optional message to attach to this order
                    if (!empty($message)) {
                        $msg = new Message();
                        $message = strip_tags($message, '<br>');
                        if (Validate::isCleanHtml($message)) {
                            if (self::DEBUG_MODE) {
                                PrestaShopLogger::addLog('PaymentModule::validateOrder - Message is about to be added', 1, null, 'Cart', (int) $id_cart, true);
                            }
                            $msg->message = $message;
                            $msg->id_cart = (int) $id_cart;
                            $msg->id_customer = (int) ($order->id_customer);
                            $msg->id_order = (int) $order->id;
                            $msg->private = 1;
                            $msg->add();
                        }
                    }

                    // Insert new Order detail list using cart for the current order
                    //$orderDetail = new OrderDetail(null, null, $this->context);
                    //$orderDetail->createList($order, $this->context->cart, $id_order_state);

                    // Construct order detail table for the email
                    $products_list = '';
                    $virtual_product = true;

                    $product_var_tpl_list = [];
                    foreach ($order->product_list as $product) {
                        $price = Product::getPriceStatic((int) $product['id_product'], false, ($product['id_product_attribute'] ? (int) $product['id_product_attribute'] : null), 6, null, false, true, $product['cart_quantity'], false, (int) $order->id_customer, (int) $order->id_cart, (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')}, $specific_price, true, true, null, true, $product['id_customization']);
                        $price_wt = Product::getPriceStatic((int) $product['id_product'], true, ($product['id_product_attribute'] ? (int) $product['id_product_attribute'] : null), 2, null, false, true, $product['cart_quantity'], false, (int) $order->id_customer, (int) $order->id_cart, (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')}, $specific_price, true, true, null, true, $product['id_customization']);

                        $product_price = Product::getTaxCalculationMethod() == PS_TAX_EXC ? Tools::ps_round($price, $decimals) : $price_wt;

                        $product_var_tpl = [
                            'id_product' => $product['id_product'],
                            'id_product_attribute' => $product['id_product_attribute'],
                            'reference' => $product['reference'],
                            'name' => $product['name'] . (isset($product['attributes']) ? ' - ' . $product['attributes'] : ''),
                            'price' => Tools::displayPrice($product_price * $product['quantity'], $this->context->currency, false),
                            'quantity' => $product['quantity'],
                            'customization' => [],
                        ];

                        if (isset($product['price']) && $product['price']) {
                            $product_var_tpl['unit_price'] = Tools::displayPrice($product_price, $this->context->currency, false);
                            $product_var_tpl['unit_price_full'] = Tools::displayPrice($product_price, $this->context->currency, false)
                                . ' ' . $product['unity'];
                        } else {
                            $product_var_tpl['unit_price'] = $product_var_tpl['unit_price_full'] = '';
                        }

                        $customized_datas = Product::getAllCustomizedDatas((int) $order->id_cart, null, true, null, (int) $product['id_customization']);
                        if (isset($customized_datas[$product['id_product']][$product['id_product_attribute']])) {
                            $product_var_tpl['customization'] = [];
                            foreach ($customized_datas[$product['id_product']][$product['id_product_attribute']][$order->id_address_delivery] as $customization) {
                                $customization_text = '';
                                if (isset($customization['datas'][Product::CUSTOMIZE_TEXTFIELD])) {
                                    foreach ($customization['datas'][Product::CUSTOMIZE_TEXTFIELD] as $text) {
                                        $customization_text .= '<strong>' . $text['name'] . '</strong>: ' . $text['value'] . '<br />';
                                    }
                                }

                                if (isset($customization['datas'][Product::CUSTOMIZE_FILE])) {
                                    $customization_text .= $this->trans('%d image(s)', [count($customization['datas'][Product::CUSTOMIZE_FILE])], 'Admin.Payment.Notification') . '<br />';
                                }

                                $customization_quantity = (int) $customization['quantity'];

                                $product_var_tpl['customization'][] = [
                                    'customization_text' => $customization_text,
                                    'customization_quantity' => $customization_quantity,
                                    'quantity' => Tools::displayPrice($customization_quantity * $product_price, $this->context->currency, false),
                                ];
                            }
                        }

                        $product_var_tpl_list[] = $product_var_tpl;
                        // Check if is not a virtual product for the displaying of shipping
                        if (!$product['is_virtual']) {
                            $virtual_product &= false;
                        }
                    } // end foreach ($products)

                    $product_list_txt = '';
                    $product_list_html = '';
                    if (count($product_var_tpl_list) > 0) {
                        $product_list_txt = $this->getEmailTemplateContent('order_conf_product_list.txt', Mail::TYPE_TEXT, $product_var_tpl_list);
                        $product_list_html = $this->getEmailTemplateContent('order_conf_product_list.tpl', Mail::TYPE_HTML, $product_var_tpl_list);
                    }

                    $total_reduction_value_ti = 0;
                    $total_reduction_value_tex = 0;

                    $cart_rules_list = $this->createOrderCartRules(
                        $order,
                        $this->context->cart,
                        $order_list,
                        $total_reduction_value_ti,
                        $total_reduction_value_tex,
                        $id_order_state
                    );

                    $cart_rules_list_txt = '';
                    $cart_rules_list_html = '';
                    if (count($cart_rules_list) > 0) {
                        $cart_rules_list_txt = $this->getEmailTemplateContent('order_conf_cart_rules.txt', Mail::TYPE_TEXT, $cart_rules_list);
                        $cart_rules_list_html = $this->getEmailTemplateContent('order_conf_cart_rules.tpl', Mail::TYPE_HTML, $cart_rules_list);
                    }

                    // Specify order id for message
                    $old_message = Message::getMessageByCartId((int) $this->context->cart->id);
                    if ($old_message && !$old_message['private']) {
                        $update_message = new Message((int) $old_message['id_message']);
                        $update_message->id_order = (int) $order->id;
                        $update_message->update();

                        // Add this message in the customer thread
                        $customer_thread = new CustomerThread();
                        $customer_thread->id_contact = 0;
                        $customer_thread->id_customer = (int) $order->id_customer;
                        $customer_thread->id_shop = (int) $this->context->shop->id;
                        $customer_thread->id_order = (int) $order->id;
                        $customer_thread->id_lang = (int) $this->context->language->id;
                        $customer_thread->email = $this->context->customer->email;
                        $customer_thread->status = 'open';
                        $customer_thread->token = Tools::passwdGen(12);
                        $customer_thread->add();

                        $customer_message = new CustomerMessage();
                        $customer_message->id_customer_thread = $customer_thread->id;
                        $customer_message->id_employee = 0;
                        $customer_message->message = $update_message->message;
                        $customer_message->private = 0;

                        if (!$customer_message->add()) {
                            $this->errors[] = $this->trans('An error occurred while saving message', [], 'Admin.Payment.Notification');
                        }
                    }

                    if (self::DEBUG_MODE) {
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - Hook validateOrder is about to be called', 1, null, 'Cart', (int) $id_cart, true);
                    }

                    // Hook validate order
                    Hook::exec('actionValidateOrder', [
                        'cart' => $this->context->cart,
                        'order' => $order,
                        'customer' => $this->context->customer,
                        'currency' => $this->context->currency,
                        'orderStatus' => $order_status,
                    ]);

                    foreach ($this->context->cart->getProducts() as $product) {
                        if ($order_status->logable) {
                            ProductSale::addProductSale((int) $product['id_product'], (int) $product['cart_quantity']);
                        }
                    }

                    if (self::DEBUG_MODE) {
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - Order Status is about to be added', 1, null, 'Cart', (int) $id_cart, true);
                    }
                    // Set the order status
                    $new_history = new OrderHistory();
                    $new_history->id_order = (int) $order->id;

                    $new_history->changeIdOrderState((int) $id_order_state, $order, true);
                    $new_history->addWithemail(true, $extra_vars);
                    // Switch to back order if needed
                    if (Configuration::get('PS_STOCK_MANAGEMENT') &&
                            ($order_detail->getStockState() ||
                            $order_detail->product_quantity_in_stock < 0)) {
                        $history = new OrderHistory();
                        $history->id_order = (int) $order->id;
                        $history->changeIdOrderState(Configuration::get($order->hasBeenPaid() ? 'PS_OS_OUTOFSTOCK_PAID' : 'PS_OS_OUTOFSTOCK_UNPAID'), $order, true);
                        $history->addWithemail();
                    }
                    unset($order_detail);
                    // Order is reloaded because the status just changed
                    $order = new Order((int) $order->id);
                    // Send an e-mail to customer (one order = one email)
                    if ($id_order_state != Configuration::get('PS_OS_ERROR') && $id_order_state != Configuration::get('PS_OS_CANCELED') && $this->context->customer->id) {
                        $invoice = new Address((int) $order->id_address_invoice);
                        $delivery = new Address((int) $order->id_address_delivery);
                        $delivery_state = $delivery->id_state ? new State((int) $delivery->id_state) : false;
                        $invoice_state = $invoice->id_state ? new State((int) $invoice->id_state) : false;
                        $carrier = $order->id_carrier ? new Carrier($order->id_carrier) : false;
                        $orderLanguage = new Language((int) $order->id_lang);

                        // Join PDF invoice
                        if ((int) Configuration::get('PS_INVOICE') && $order_status->invoice && $order->invoice_number) {
                            $currentLanguage = $this->context->language;
                            $this->context->language = $orderLanguage;
                            $this->context->getTranslator()->setLocale($orderLanguage->locale);
                            $order_invoice_list = $order->getInvoicesCollection();
                            Hook::exec('actionPDFInvoiceRender', ['order_invoice_list' => $order_invoice_list]);
                            $pdf = new PDF($order_invoice_list, PDF::TEMPLATE_INVOICE, $this->context->smarty);
                            $file_attachement['content'] = $pdf->render(false);
                            $file_attachement['name'] = Configuration::get('PS_INVOICE_PREFIX', (int) $order->id_lang, null, $order->id_shop) . sprintf('%06d', $order->invoice_number) . '.pdf';
                            $file_attachement['mime'] = 'application/pdf';
                            $this->context->language = $currentLanguage;
                            $this->context->getTranslator()->setLocale($currentLanguage->locale);
                        } else {
                            $file_attachement = null;
                        }

                        if (self::DEBUG_MODE) {
                            PrestaShopLogger::addLog('PaymentModule::validateOrder - Mail is about to be sent', 1, null, 'Cart', (int) $id_cart, true);
                        }

                        if (Validate::isEmail($this->context->customer->email)) {
                            $data = [
                                '{firstname}' => $this->context->customer->firstname,
                                '{lastname}' => $this->context->customer->lastname,
                                '{email}' => $this->context->customer->email,
                                '{delivery_block_txt}' => $this->_getFormatedAddress($delivery, AddressFormat::FORMAT_NEW_LINE),
                                '{invoice_block_txt}' => $this->_getFormatedAddress($invoice, AddressFormat::FORMAT_NEW_LINE),
                                '{delivery_block_html}' => $this->_getFormatedAddress($delivery, '<br />', [
                                    'firstname' => '<span style="font-weight:bold;">%s</span>',
                                    'lastname' => '<span style="font-weight:bold;">%s</span>',
                                ]),
                                '{invoice_block_html}' => $this->_getFormatedAddress($invoice, '<br />', [
                                    'firstname' => '<span style="font-weight:bold;">%s</span>',
                                    'lastname' => '<span style="font-weight:bold;">%s</span>',
                                ]),
                                '{delivery_company}' => $delivery->company,
                                '{delivery_firstname}' => $delivery->firstname,
                                '{delivery_lastname}' => $delivery->lastname,
                                '{delivery_address1}' => $delivery->address1,
                                '{delivery_address2}' => $delivery->address2,
                                '{delivery_city}' => $delivery->city,
                                '{delivery_postal_code}' => $delivery->postcode,
                                '{delivery_country}' => $delivery->country,
                                '{delivery_state}' => $delivery->id_state ? $delivery_state->name : '',
                                '{delivery_phone}' => ($delivery->phone) ? $delivery->phone : $delivery->phone_mobile,
                                '{delivery_other}' => $delivery->other,
                                '{invoice_company}' => $invoice->company,
                                '{invoice_vat_number}' => $invoice->vat_number,
                                '{invoice_firstname}' => $invoice->firstname,
                                '{invoice_lastname}' => $invoice->lastname,
                                '{invoice_address2}' => $invoice->address2,
                                '{invoice_address1}' => $invoice->address1,
                                '{invoice_city}' => $invoice->city,
                                '{invoice_postal_code}' => $invoice->postcode,
                                '{invoice_country}' => $invoice->country,
                                '{invoice_state}' => $invoice->id_state ? $invoice_state->name : '',
                                '{invoice_phone}' => ($invoice->phone) ? $invoice->phone : $invoice->phone_mobile,
                                '{invoice_other}' => $invoice->other,
                                '{order_name}' => $order->getUniqReference(),
                                '{id_order}' => $order->id,
                                '{date}' => Tools::displayDate(date('Y-m-d H:i:s'), null, 1),
                                '{carrier}' => ($virtual_product || !isset($carrier->name)) ? $this->trans('No carrier', [], 'Admin.Payment.Notification') : $carrier->name,
                                '{payment}' => Tools::substr($order->payment, 0, 255) . ($order->hasBeenPaid() ? '' : '&nbsp;' . $this->trans('(waiting for validation)', [], 'Emails.Body')),
                                '{products}' => $product_list_html,
                                '{products_txt}' => $product_list_txt,
                                '{discounts}' => $cart_rules_list_html,
                                '{discounts_txt}' => $cart_rules_list_txt,
                                '{total_paid}' => Tools::displayPrice($order->total_paid, $this->context->currency, false),
                                '{total_products}' => Tools::displayPrice(Product::getTaxCalculationMethod() == PS_TAX_EXC ? $order->total_products : $order->total_products_wt, $this->context->currency, false),
                                '{total_discounts}' => Tools::displayPrice($order->total_discounts, $this->context->currency, false),
                                '{total_shipping}' => Tools::displayPrice($order->total_shipping, $this->context->currency, false),
                                '{total_wrapping}' => Tools::displayPrice($order->total_wrapping, $this->context->currency, false),
                                '{total_tax_paid}' => Tools::displayPrice(($order->total_products_wt - $order->total_products) + ($order->total_shipping_tax_incl - $order->total_shipping_tax_excl), $this->context->currency, false),
                            ];
                            if (is_array($extra_vars)) {
                                $data = array_merge($data, $extra_vars);
                            }
                          
                            Mail::Send(
                                (int) $order->id_lang,
                                'order_conf',
                                $this->context->getTranslator()->trans(
                                    'Order confirmation',
                                    [],
                                    'Emails.Subject',
                                    $orderLanguage->locale
                                ),
                                $data,
                                $this->context->customer->email,
                                $this->context->customer->firstname . ' ' . $this->context->customer->lastname,
                                null,
                                null,
                                $file_attachement,
                                null,
                                _PS_MAIL_DIR_,
                                false,
                                (int) $order->id_shop
                            );
                        }
                    }

                    // updates stock in shops
                    if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')) {
                        $product_list = $order->getProducts();
                        foreach ($product_list as $product) {
                            // if the available quantities depends on the physical stock
                            if (StockAvailable::dependsOnStock($product['product_id'])) {
                                // synchronizes
                                StockAvailable::synchronize($product['product_id'], $order->id_shop);
                            }
                        }
                    }
                    $order->updateOrderDetailTax();

                    // sync all stock
                    (new \PrestaShop\PrestaShop\Adapter\StockManager())->updatePhysicalProductQuantity(
                        (int) $order->id_shop,
                        (int) Configuration::get('PS_OS_ERROR'),
                        (int) Configuration::get('PS_OS_CANCELED'),
                        null,
                        (int) $order->id
                    );
                } else {
                    $error = $this->trans('Order creation failed', [], 'Admin.Payment.Notification');
                    PrestaShopLogger::addLog($error, 4, '0000002', 'Cart', (int) ($order->id_cart));
                    die(Tools::displayError($error));
                }
            } // End foreach $order_detail_list

            // Use the last order as currentOrder
            if (isset($order) && $order->id) {
                $this->currentOrder = (int) $order->id;
            }

            if (self::DEBUG_MODE) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - End of validateOrder', 1, null, 'Cart', (int) $id_cart, true);
            }

            return true;
        } else {
            $error = $this->trans('Cart cannot be loaded or an order has already been placed using this cart', [], 'Admin.Payment.Notification');
            PrestaShopLogger::addLog($error, 4, '0000001', 'Cart', (int) ($this->context->cart->id));
            die(Tools::displayError($error));
        }
    }


    public function validateOrderRedsys17($id_cart, $id_order_state, $amount_paid, $payment_method = 'Unknown', $message = null, $extra_vars = array(), $currency_special = null,
        $dont_touch_amount = false, $secure_key = false, Shop $shop = null, $tpv = null)
    {
        $fee_discount_amount_with_taxes = 0;
        $fee_discount_amount_without_taxes = 0;

        if (self::DEBUG_MODE) {
            PrestaShopLogger::addLog('PaymentModule::validateOrder - Function called', 1, null, 'Cart', (int) $id_cart, true);
        }

        if (!isset($this->context)) {
            $this->context = Context::getContext();
        }
        $this->context->cart = new Cart((int) $id_cart);
        $this->context->customer = new Customer((int) $this->context->cart->id_customer);
        // The tax cart is loaded before the customer so re-cache the tax calculation method
        $this->context->cart->setTaxCalculationMethod();

        $this->context->language = new Language((int) $this->context->cart->id_lang);
        $this->context->shop = ($shop ? $shop : new Shop((int) $this->context->cart->id_shop));
        ShopUrl::resetMainDomainCache();
        $id_currency = $currency_special ? (int) $currency_special : (int) $this->context->cart->id_currency;
        $this->context->currency = new Currency((int) $id_currency, null, (int) $this->context->shop->id);
        if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery') {
            $context_country = $this->context->country;
        }

        $order_status = new OrderState((int) $id_order_state, (int) $this->context->language->id);
        if (!Validate::isLoadedObject($order_status)) {
            PrestaShopLogger::addLog('PaymentModule::validateOrder - Order Status cannot be loaded', 3, null, 'Cart', (int) $id_cart, true);
            throw new PrestaShopException('Can\'t load Order status');
        }

        if (!$this->active) {
            PrestaShopLogger::addLog('PaymentModule::validateOrder - Module is not active', 3, null, 'Cart', (int) $id_cart, true);
            die(Tools::displayError());
        }

        // Does order already exists ?
        if (Validate::isLoadedObject($this->context->cart) && $this->context->cart->OrderExists() == false) {
            if ($secure_key !== false && $secure_key != $this->context->cart->secure_key) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Secure key does not match', 3, null, 'Cart', (int) $id_cart, true);
                die(Tools::displayError());
            }

            // For each package, generate an order
            $delivery_option_list = $this->context->cart->getDeliveryOptionList();
            $package_list = $this->context->cart->getPackageList();
            $cart_delivery_option = $this->context->cart->getDeliveryOption();

            // If some delivery options are not defined, or not valid, use the first valid option
            foreach ($delivery_option_list as $id_address => $package) {
                if (!isset($cart_delivery_option[$id_address]) || !array_key_exists($cart_delivery_option[$id_address], $package)) {
                    foreach ($package as $key => $val) {
                        $cart_delivery_option[$id_address] = $key;
                        break;
                    }
                }
            }

            $order_list = array();
            $order_detail_list = array();

            do {
                $reference = Order::generateReference();
            } while (Order::getByReference($reference)->count());

            $this->currentOrderReference = $reference;

            $cart_total_paid = (float) Tools::ps_round((float) $this->context->cart->getOrderTotal(true, Cart::BOTH), 2);

            foreach ($cart_delivery_option as $id_address => $key_carriers) {
                foreach ($delivery_option_list[$id_address][$key_carriers]['carrier_list'] as $id_carrier => $data) {
                    foreach ($data['package_list'] as $id_package) {
                        // Rewrite the id_warehouse
                        $package_list[$id_address][$id_package]['id_warehouse'] = (int) $this->context->cart->getPackageIdWarehouse($package_list[$id_address][$id_package], (int) $id_carrier);
                        $package_list[$id_address][$id_package]['id_carrier'] = $id_carrier;
                    }
                }
            }
            // Make sure CartRule caches are empty
            CartRule::cleanCache();
            $cart_rules = $this->context->cart->getCartRules();
            foreach ($cart_rules as $cart_rule) {
                if (($rule = new CartRule((int) $cart_rule['obj']->id)) && Validate::isLoadedObject($rule)) {
                    if ($error = $rule->checkValidity($this->context, true, true)) {
                        $this->context->cart->removeCartRule((int) $rule->id);
                        if (isset($this->context->cookie) && isset($this->context->cookie->id_customer) && $this->context->cookie->id_customer && !empty($rule->code)) {
                            Tools::redirect('index.php?controller=order&submitAddDiscount=1&discount_name=' . urlencode($rule->code));
                        } else {
                            $rule_name = isset($rule->name[(int) $this->context->cart->id_lang]) ? $rule->name[(int) $this->context->cart->id_lang] : $rule->code;
                            $error = $this->trans('The cart rule named "%1s" (ID %2s) used in this cart is not valid and has been withdrawn from cart', array($rule_name, (int) $rule->id), 'Admin.Payment.Notification');
                            PrestaShopLogger::addLog($error, 3, '0000002', 'Cart', (int) $this->context->cart->id);
                        }
                    }
                }
            }

            foreach ($package_list as $id_address => $packageByAddress) {
                foreach ($packageByAddress as $id_package => $package) {
                    /** @var Order $order */
                    $order = new Order();
                    $order->product_list = $package['product_list'];

                    if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery') {
                        $address = new Address((int) $id_address);
                        $this->context->country = new Country((int) $address->id_country, (int) $this->context->cart->id_lang);
                        if (!$this->context->country->active) {
                            throw new PrestaShopException('The delivery address country is not active.');
                        }
                    }

                    $carrier = null;
                    if (!$this->context->cart->isVirtualCart() && isset($package['id_carrier'])) {
                        $carrier = new Carrier((int) $package['id_carrier'], (int) $this->context->cart->id_lang);
                        $order->id_carrier = (int) $carrier->id;
                        $id_carrier = (int) $carrier->id;
                    } else {
                        $order->id_carrier = 0;
                        $id_carrier = 0;
                    }

                    $order->id_customer = (int) $this->context->cart->id_customer;
                    $order->id_address_invoice = (int) $this->context->cart->id_address_invoice;
                    $order->id_address_delivery = (int) $id_address;
                    $order->id_currency = $this->context->currency->id;
                    $order->id_lang = (int) $this->context->cart->id_lang;
                    $order->id_cart = (int) $this->context->cart->id;
                    $order->reference = $reference;
                    $order->id_shop = (int) $this->context->shop->id;
                    $order->id_shop_group = (int) $this->context->shop->id_shop_group;

                    $order->secure_key = ($secure_key ? pSQL($secure_key) : pSQL($this->context->customer->secure_key));

                    if ($order->secure_key == null) {
                        $order->secure_key == '';
                    }

                    $order_state_advanced = new OrderState((int)Configuration::get('REDSYS_ADVANCED_PAYMENT_STATE'), (int)Configuration::get('PS_LANG_DEFAULT'));

                    if ($tpv->advanced_payment && $order_state_advanced instanceof OrderState) {
                        $order->payment = $order_state_advanced->name;
                    } else {
                        $order->payment = $payment_method;
                    }

                    if (isset($this->name)) {
                        $order->module = $this->name;
                    }
                    $order->recyclable = $this->context->cart->recyclable;
                    $order->gift = (int) $this->context->cart->gift;
                    $order->gift_message = $this->context->cart->gift_message;
                    $order->mobile_theme = $this->context->cart->mobile_theme;
                    $order->conversion_rate = $this->context->currency->conversion_rate;
                    $amount_paid = !$dont_touch_amount ? Tools::ps_round((float) $amount_paid, 2) : $amount_paid;
                    $order->total_paid_real = 0;

                    $order->total_products = (float) $this->context->cart->getOrderTotal(false, Cart::ONLY_PRODUCTS, $order->product_list, $id_carrier);
                    $order->total_products_wt = (float) $this->context->cart->getOrderTotal(true, Cart::ONLY_PRODUCTS, $order->product_list, $id_carrier);
                    $order->total_discounts_tax_excl = (float) abs($this->context->cart->getOrderTotal(false, Cart::ONLY_DISCOUNTS, $order->product_list, $id_carrier));
                    $order->total_discounts_tax_incl = (float) abs($this->context->cart->getOrderTotal(true, Cart::ONLY_DISCOUNTS, $order->product_list, $id_carrier));


                    $order->total_shipping_tax_excl = (float) $this->context->cart->getPackageShippingCost((int) $id_carrier, false, null, $order->product_list);
                    $order->total_shipping_tax_incl = (float) $this->context->cart->getPackageShippingCost((int) $id_carrier, true, null, $order->product_list);
                    $order->total_shipping = $order->total_shipping_tax_incl;

                    if (!is_null($carrier) && Validate::isLoadedObject($carrier)) {
                        $order->carrier_tax_rate = $carrier->getTaxesRate(new Address((int) $this->context->cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')}));
                    }

                    $order->total_wrapping_tax_excl = (float) abs($this->context->cart->getOrderTotal(false, Cart::ONLY_WRAPPING, $order->product_list, $id_carrier));
                    $order->total_wrapping_tax_incl = (float) abs($this->context->cart->getOrderTotal(true, Cart::ONLY_WRAPPING, $order->product_list, $id_carrier));
                    $order->total_wrapping = $order->total_wrapping_tax_incl;

                    $order->total_paid_tax_excl = (float) Tools::ps_round((float) $this->context->cart->getOrderTotal(false, Cart::BOTH, $order->product_list, $id_carrier), _PS_PRICE_COMPUTE_PRECISION_);
                    $order->total_paid_tax_incl = (float) Tools::ps_round((float) $this->context->cart->getOrderTotal(true, Cart::BOTH, $order->product_list, $id_carrier), _PS_PRICE_COMPUTE_PRECISION_);

                    if ($tpv->fee_discount) {
                        $fee_discount_amount_with_taxes = $this->getFeeDiscount($tpv, $this->context->cart, true);
                        $fee_discount_amount_without_taxes = $this->getFeeDiscount($tpv, $this->context->cart, false);

                        if ($fee_discount_amount_with_taxes < 0 && $fee_discount_amount_without_taxes < 0) {
                            $order->total_discounts_tax_incl -= $fee_discount_amount_with_taxes;
                            $order->total_discounts_tax_excl -= $fee_discount_amount_without_taxes;
                        }
                        $order->total_paid_tax_incl += $fee_discount_amount_with_taxes;
                        $order->total_paid_tax_excl += $fee_discount_amount_without_taxes;
                    }
                    $order->total_discounts = $order->total_discounts_tax_incl;
                    $order->total_paid = $order->total_paid_tax_incl;

                    /*if ((int)$id_order_state != (int)Configuration::get('REDSYS_AWAITING_PAYMENT_REDSYS')) {
                        $order->total_paid_real = $order->total_paid;
                    }*/

                    $order->round_mode = Configuration::get('PS_PRICE_ROUND_MODE');
                    $order->round_type = Configuration::get('PS_ROUND_TYPE');

                    $order->invoice_date = '0000-00-00 00:00:00';
                    $order->delivery_date = '0000-00-00 00:00:00';

                    if (self::DEBUG_MODE) {
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - Order is about to be added', 1, null, 'Cart', (int) $id_cart, true);
                    }

                    // Creating order
                    $result = $order->add();

                    if (!$result) {
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - Order cannot be created', 3, null, 'Cart', (int) $id_cart, true);
                        throw new PrestaShopException('Can\'t save Order');
                    }

                    if ($tpv->fee_discount) {
                        $this->setFeeDiscountFromOrderId($order->id, $fee_discount_amount_with_taxes);
                    }

                    // Amount paid by customer is not the right one -> Status = payment error
                    // We don't use the following condition to avoid the float precision issues : http://www.php.net/manual/en/language.types.float.php
                    // if ($order->total_paid != $order->total_paid_real)
                    // We use number_format in order to compare two string
                    /*if ($order_status->logable && number_format($cart_total_paid, _PS_PRICE_COMPUTE_PRECISION_) != number_format($amount_paid, _PS_PRICE_COMPUTE_PRECISION_)) {
                        $id_order_state = Configuration::get('PS_OS_ERROR');
                    }*/

                    $order_list[] = $order;

                    if (self::DEBUG_MODE) {
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - OrderDetail is about to be added', 1, null, 'Cart', (int) $id_cart, true);
                    }

                    // Insert new Order detail list using cart for the current order
                    $order_detail = new OrderDetail(null, null, $this->context);
                    $order_detail->createList($order, $this->context->cart, $id_order_state, $order->product_list, 0, true, $package_list[$id_address][$id_package]['id_warehouse']);
                    $order_detail_list[] = $order_detail;

                    if (self::DEBUG_MODE) {
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - OrderCarrier is about to be added', 1, null, 'Cart', (int) $id_cart, true);
                    }

                    // Adding an entry in order_carrier table
                    if (!is_null($carrier)) {
                        $order_carrier = new OrderCarrier();
                        $order_carrier->id_order = (int) $order->id;
                        $order_carrier->id_carrier = (int) $id_carrier;
                        $order_carrier->weight = (float) $order->getTotalWeight();
                        $order_carrier->shipping_cost_tax_excl = (float) $order->total_shipping_tax_excl;
                        $order_carrier->shipping_cost_tax_incl = (float) $order->total_shipping_tax_incl;
                        $order_carrier->add();
                    }
                }
            }

            // The country can only change if the address used for the calculation is the delivery address, and if multi-shipping is activated
            if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery') {
                $this->context->country = $context_country;
            }

            if (!$this->context->country->active) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Country is not active', 3, null, 'Cart', (int) $id_cart, true);
                throw new PrestaShopException('The order address country is not active.');
            }

            if (self::DEBUG_MODE) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Payment is about to be added', 1, null, 'Cart', (int) $id_cart, true);
            }

            // Register Payment only if the order status validate the order
            if ($order_status->logable) {
                // $order is the last order loop in the foreach
                // The method addOrderPayment of the class Order make a create a paymentOrder
                // linked to the order reference and not to the order id
                if (isset($extra_vars['transaction_id'])) {
                    $transaction_id = $extra_vars['transaction_id'];
                } else {
                    $transaction_id = null;
                }

                if (!$order->addOrderPayment($amount_paid, null, $transaction_id)) {
                    PrestaShopLogger::addLog('PaymentModule::validateOrder - Cannot save Order Payment', 3, null, 'Cart', (int) $id_cart, true);
                    throw new PrestaShopException('Can\'t save Order Payment');
                }
            }

            // Next !
            $only_one_gift = false;
            $cart_rule_used = array();
            $products = $this->context->cart->getProducts();

            // Make sure CartRule caches are empty
            CartRule::cleanCache();
            foreach ($order_detail_list as $key => $order_detail) {
                /** @var OrderDetail $order_detail */
                $order = $order_list[$key];
                if (isset($order->id)) {
                    if (!$secure_key) {
                        $message .= '<br />' . $this->trans('Warning: the secure key is empty, check your payment account before validation', array(), 'Admin.Payment.Notification');
                    }
                    // Optional message to attach to this order
                    if (isset($message) & !empty($message)) {
                        $msg = new Message();
                        $message = strip_tags($message, '<br>');
                        if (Validate::isCleanHtml($message)) {
                            if (self::DEBUG_MODE) {
                                PrestaShopLogger::addLog('PaymentModule::validateOrder - Message is about to be added', 1, null, 'Cart', (int) $id_cart, true);
                            }
                            $msg->message = $message;
                            $msg->id_cart = (int) $id_cart;
                            $msg->id_customer = (int) ($order->id_customer);
                            $msg->id_order = (int) $order->id;
                            $msg->private = 1;
                            $msg->add();
                        }
                    }

                    // Insert new Order detail list using cart for the current order
                    //$orderDetail = new OrderDetail(null, null, $this->context);
                    //$orderDetail->createList($order, $this->context->cart, $id_order_state);

                    // Construct order detail table for the email
                    $products_list = '';
                    $virtual_product = true;

                    $product_var_tpl_list = array();
                    foreach ($order->product_list as $product) {
                        $price = Product::getPriceStatic((int) $product['id_product'], false, ($product['id_product_attribute'] ? (int) $product['id_product_attribute'] : null), 6, null, false, true, $product['cart_quantity'], false, (int) $order->id_customer, (int) $order->id_cart, (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')}, $specific_price, true, true, null, true, $product['id_customization']);
                        $price_wt = Product::getPriceStatic((int) $product['id_product'], true, ($product['id_product_attribute'] ? (int) $product['id_product_attribute'] : null), 2, null, false, true, $product['cart_quantity'], false, (int) $order->id_customer, (int) $order->id_cart, (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')}, $specific_price, true, true, null, true, $product['id_customization']);

                        $product_price = Product::getTaxCalculationMethod() == PS_TAX_EXC ? Tools::ps_round($price, 2) : $price_wt;

                        $product_var_tpl = array(
                            'id_product' => $product['id_product'],
                            'reference' => $product['reference'],
                            'name' => $product['name'] . (isset($product['attributes']) ? ' - ' . $product['attributes'] : ''),
                            'price' => Tools::displayPrice($product_price * $product['quantity'], $this->context->currency, false),
                            'quantity' => $product['quantity'],
                            'customization' => array(),
                        );

                        if (isset($product['price']) && $product['price']) {
                            $product_var_tpl['unit_price'] = Tools::displayPrice($product_price, $this->context->currency, false);
                            $product_var_tpl['unit_price_full'] = Tools::displayPrice($product_price, $this->context->currency, false)
                                . ' ' . $product['unity'];
                        } else {
                            $product_var_tpl['unit_price'] = $product_var_tpl['unit_price_full'] = '';
                        }

                        $customized_datas = Product::getAllCustomizedDatas((int) $order->id_cart, null, true, null, (int) $product['id_customization']);
                        if (isset($customized_datas[$product['id_product']][$product['id_product_attribute']])) {
                            $product_var_tpl['customization'] = array();
                            foreach ($customized_datas[$product['id_product']][$product['id_product_attribute']][$order->id_address_delivery] as $customization) {
                                $customization_text = '';
                                if (isset($customization['datas'][Product::CUSTOMIZE_TEXTFIELD])) {
                                    foreach ($customization['datas'][Product::CUSTOMIZE_TEXTFIELD] as $text) {
                                        $customization_text .= '<strong>' . $text['name'] . '</strong>: ' . $text['value'] . '<br />';
                                    }
                                }

                                if (isset($customization['datas'][Product::CUSTOMIZE_FILE])) {
                                    $customization_text .= $this->trans('%d image(s)', array(count($customization['datas'][Product::CUSTOMIZE_FILE])), 'Admin.Payment.Notification') . '<br />';
                                }

                                $customization_quantity = (int) $customization['quantity'];

                                $product_var_tpl['customization'][] = array(
                                    'customization_text' => $customization_text,
                                    'customization_quantity' => $customization_quantity,
                                    'quantity' => Tools::displayPrice($customization_quantity * $product_price, $this->context->currency, false),
                                );
                            }
                        }

                        $product_var_tpl_list[] = $product_var_tpl;
                        // Check if is not a virutal product for the displaying of shipping
                        if (!$product['is_virtual']) {
                            $virtual_product &= false;
                        }
                    } // end foreach ($products)

                    $product_list_txt = '';
                    $product_list_html = '';
                    if (count($product_var_tpl_list) > 0) {
                        $product_list_txt = $this->getEmailTemplateContentRedsys('order_conf_product_list.txt', Mail::TYPE_TEXT, $product_var_tpl_list);
                        $product_list_html = $this->getEmailTemplateContentRedsys('order_conf_product_list.tpl', Mail::TYPE_HTML, $product_var_tpl_list);
                    }

                    $cart_rules_list = array();
                    $total_reduction_value_ti = 0;
                    $total_reduction_value_tex = 0;
                    foreach ($cart_rules as $cart_rule) {
                        $package = array('id_carrier' => $order->id_carrier, 'id_address' => $order->id_address_delivery, 'products' => $order->product_list);
                        $values = array(
                            'tax_incl' => $cart_rule['obj']->getContextualValue(true, $this->context, CartRule::FILTER_ACTION_ALL_NOCAP, $package),
                            'tax_excl' => $cart_rule['obj']->getContextualValue(false, $this->context, CartRule::FILTER_ACTION_ALL_NOCAP, $package),
                        );

                        // If the reduction is not applicable to this order, then continue with the next one
                        if (!$values['tax_excl']) {
                            continue;
                        }

                        // IF
                        //  This is not multi-shipping
                        //  The value of the voucher is greater than the total of the order
                        //  Partial use is allowed
                        //  This is an "amount" reduction, not a reduction in % or a gift
                        // THEN
                        //  The voucher is cloned with a new value corresponding to the remainder
                        if (count($order_list) == 1 && $values['tax_incl'] > ($order->total_products_wt - $total_reduction_value_ti) && $cart_rule['obj']->partial_use == 1 && $cart_rule['obj']->reduction_amount > 0) {
                            // Create a new voucher from the original
                            $voucher = new CartRule((int) $cart_rule['obj']->id); // We need to instantiate the CartRule without lang parameter to allow saving it
                            unset($voucher->id);

                            // Set a new voucher code
                            $voucher->code = empty($voucher->code) ? Tools::substr(md5($order->id . '-' . $order->id_customer . '-' . $cart_rule['obj']->id), 0, 16) : $voucher->code . '-2';
                            if (preg_match('/\-([0-9]{1,2})\-([0-9]{1,2})$/', $voucher->code, $matches) && $matches[1] == $matches[2]) {
                                $voucher->code = preg_replace('/' . $matches[0] . '$/', '-' . (intval($matches[1]) + 1), $voucher->code);
                            }

                            // Set the new voucher value
                            if ($voucher->reduction_tax) {
                                $voucher->reduction_amount = ($total_reduction_value_ti + $values['tax_incl']) - $order->total_products_wt;

                                // Add total shipping amout only if reduction amount > total shipping
                                if ($voucher->free_shipping == 1 && $voucher->reduction_amount >= $order->total_shipping_tax_incl) {
                                    $voucher->reduction_amount -= $order->total_shipping_tax_incl;
                                }
                            } else {
                                $voucher->reduction_amount = ($total_reduction_value_tex + $values['tax_excl']) - $order->total_products;

                                // Add total shipping amout only if reduction amount > total shipping
                                if ($voucher->free_shipping == 1 && $voucher->reduction_amount >= $order->total_shipping_tax_excl) {
                                    $voucher->reduction_amount -= $order->total_shipping_tax_excl;
                                }
                            }
                            if ($voucher->reduction_amount <= 0) {
                                continue;
                            }

                            if ($this->context->customer->isGuest()) {
                                $voucher->id_customer = 0;
                            } else {
                                $voucher->id_customer = $order->id_customer;
                            }

                            $voucher->quantity = 1;
                            $voucher->reduction_currency = $order->id_currency;
                            $voucher->quantity_per_user = 1;
                            if ($voucher->add()) {
                                // If the voucher has conditions, they are now copied to the new voucher
                                CartRule::copyConditions($cart_rule['obj']->id, $voucher->id);
                                $orderLanguage = new Language((int) $order->id_lang);

                                $params = array(
                                    '{voucher_amount}' => Tools::displayPrice($voucher->reduction_amount, $this->context->currency, false),
                                    '{voucher_num}' => $voucher->code,
                                    '{firstname}' => $this->context->customer->firstname,
                                    '{lastname}' => $this->context->customer->lastname,
                                    '{id_order}' => $order->reference,
                                    '{order_name}' => $order->getUniqReference(),
                                );
                                Mail::Send(
                                    (int) $order->id_lang,
                                    'voucher',
                                    Context::getContext()->getTranslator()->trans(
                                        'New voucher for your order %s',
                                        array($order->reference),
                                        'Emails.Subject',
                                        $orderLanguage->locale
                                    ),
                                    $params,
                                    $this->context->customer->email,
                                    $this->context->customer->firstname . ' ' . $this->context->customer->lastname,
                                    null, null, null, null, _PS_MAIL_DIR_, false, (int) $order->id_shop
                                );
                            }

                            $values['tax_incl'] = $order->total_products_wt - $total_reduction_value_ti;
                            $values['tax_excl'] = $order->total_products - $total_reduction_value_tex;
                            if (1 == $voucher->free_shipping) {
                                $values['tax_incl'] += $order->total_shipping_tax_incl;
                                $values['tax_excl'] += $order->total_shipping_tax_excl;
                            }
                        }
                        $total_reduction_value_ti += $values['tax_incl'];
                        $total_reduction_value_tex += $values['tax_excl'];

                        $order->addCartRule($cart_rule['obj']->id, $cart_rule['obj']->name, $values, 0, $cart_rule['obj']->free_shipping);

                        if ($id_order_state != Configuration::get('PS_OS_ERROR') && $id_order_state != Configuration::get('PS_OS_CANCELED') && !in_array($cart_rule['obj']->id, $cart_rule_used)) {
                            $cart_rule_used[] = $cart_rule['obj']->id;

                            // Create a new instance of Cart Rule without id_lang, in order to update its quantity
                            $cart_rule_to_update = new CartRule((int) $cart_rule['obj']->id);
                            $cart_rule_to_update->quantity = max(0, $cart_rule_to_update->quantity - 1);
                            $cart_rule_to_update->update();
                        }

                        $cart_rules_list[] = array(
                            'voucher_name' => $cart_rule['obj']->name,
                            'voucher_reduction' => ($values['tax_incl'] != 0.00 ? '-' : '') . Tools::displayPrice($values['tax_incl'], $this->context->currency, false),
                        );
                    }

                    $cart_rules_list_txt = '';
                    $cart_rules_list_html = '';
                    if (count($cart_rules_list) > 0) {
                        $cart_rules_list_txt = $this->getEmailTemplateContentRedsys('order_conf_cart_rules.txt', Mail::TYPE_TEXT, $cart_rules_list);
                        $cart_rules_list_html = $this->getEmailTemplateContentRedsys('order_conf_cart_rules.tpl', Mail::TYPE_HTML, $cart_rules_list);
                    }

                    // Specify order id for message
                    $old_message = Message::getMessageByCartId((int) $this->context->cart->id);
                    if ($old_message && !$old_message['private']) {
                        $update_message = new Message((int) $old_message['id_message']);
                        $update_message->id_order = (int) $order->id;
                        $update_message->update();

                        // Add this message in the customer thread
                        $customer_thread = new CustomerThread();
                        $customer_thread->id_contact = 0;
                        $customer_thread->id_customer = (int) $order->id_customer;
                        $customer_thread->id_shop = (int) $this->context->shop->id;
                        $customer_thread->id_order = (int) $order->id;
                        $customer_thread->id_lang = (int) $this->context->language->id;
                        $customer_thread->email = $this->context->customer->email;
                        $customer_thread->status = 'open';
                        $customer_thread->token = Tools::passwdGen(12);
                        $customer_thread->add();

                        $customer_message = new CustomerMessage();
                        $customer_message->id_customer_thread = $customer_thread->id;
                        $customer_message->id_employee = 0;
                        $customer_message->message = $update_message->message;
                        $customer_message->private = 1;

                        if (!$customer_message->add()) {
                            $this->errors[] = $this->trans('An error occurred while saving message', array(), 'Admin.Payment.Notification');
                        }
                    }

                    if (self::DEBUG_MODE) {
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - Hook validateOrder is about to be called', 1, null, 'Cart', (int) $id_cart, true);
                    }

                    // Hook validate order
                    Hook::exec('actionValidateOrder', array(
                        'cart' => $this->context->cart,
                        'order' => $order,
                        'customer' => $this->context->customer,
                        'currency' => $this->context->currency,
                        'orderStatus' => $order_status,
                    ));

                    foreach ($this->context->cart->getProducts() as $product) {
                        if ($order_status->logable) {
                            ProductSale::addProductSale((int) $product['id_product'], (int) $product['cart_quantity']);
                        }
                    }

                    if (self::DEBUG_MODE) {
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - Order Status is about to be added', 1, null, 'Cart', (int) $id_cart, true);
                    }

                    // Set the order status
                    $new_history = new OrderHistory();
                    $new_history->id_order = (int) $order->id;
                    $new_history->changeIdOrderState((int) $id_order_state, $order, true, $tpv);
                    $new_history->addWithemail(true, $extra_vars);

                    // Switch to back order if needed
                    if (Configuration::get('PS_STOCK_MANAGEMENT') &&
                            ($order_detail->getStockState() ||
                            $order_detail->product_quantity_in_stock < 0)) {
                        $history = new OrderHistory();
                        $history->id_order = (int) $order->id;
                        $history->changeIdOrderState(Configuration::get($order->valid ? 'PS_OS_OUTOFSTOCK_PAID' : 'PS_OS_OUTOFSTOCK_UNPAID'), $order, true, $tpv);
                        $history->addWithemail();
                    }

                    unset($order_detail);

                    // Order is reloaded because the status just changed
                    $order = new Order((int) $order->id);

                    // Send an e-mail to customer (one order = one email)
                    if ($id_order_state != Configuration::get('PS_OS_ERROR') && $id_order_state != Configuration::get('PS_OS_CANCELED') && $this->context->customer->id) {
                        $invoice = new Address((int) $order->id_address_invoice);
                        $delivery = new Address((int) $order->id_address_delivery);
                        $delivery_state = $delivery->id_state ? new State((int) $delivery->id_state) : false;
                        $invoice_state = $invoice->id_state ? new State((int) $invoice->id_state) : false;

                        $data = array(
                        '{firstname}' => $this->context->customer->firstname,
                        '{lastname}' => $this->context->customer->lastname,
                        '{email}' => $this->context->customer->email,
                        '{delivery_block_txt}' => $this->_getFormatedAddress($delivery, "\n"),
                        '{invoice_block_txt}' => $this->_getFormatedAddress($invoice, "\n"),
                        '{delivery_block_html}' => $this->_getFormatedAddress($delivery, '<br />', array(
                            'firstname' => '<span style="font-weight:bold;">%s</span>',
                            'lastname' => '<span style="font-weight:bold;">%s</span>',
                        )),
                        '{invoice_block_html}' => $this->_getFormatedAddress($invoice, '<br />', array(
                                'firstname' => '<span style="font-weight:bold;">%s</span>',
                                'lastname' => '<span style="font-weight:bold;">%s</span>',
                        )),
                        '{delivery_company}' => $delivery->company,
                        '{delivery_firstname}' => $delivery->firstname,
                        '{delivery_lastname}' => $delivery->lastname,
                        '{delivery_address1}' => $delivery->address1,
                        '{delivery_address2}' => $delivery->address2,
                        '{delivery_city}' => $delivery->city,
                        '{delivery_postal_code}' => $delivery->postcode,
                        '{delivery_country}' => $delivery->country,
                        '{delivery_state}' => $delivery->id_state ? $delivery_state->name : '',
                        '{delivery_phone}' => ($delivery->phone) ? $delivery->phone : $delivery->phone_mobile,
                        '{delivery_other}' => $delivery->other,
                        '{invoice_company}' => $invoice->company,
                        '{invoice_vat_number}' => $invoice->vat_number,
                        '{invoice_firstname}' => $invoice->firstname,
                        '{invoice_lastname}' => $invoice->lastname,
                        '{invoice_address2}' => $invoice->address2,
                        '{invoice_address1}' => $invoice->address1,
                        '{invoice_city}' => $invoice->city,
                        '{invoice_postal_code}' => $invoice->postcode,
                        '{invoice_country}' => $invoice->country,
                        '{invoice_state}' => $invoice->id_state ? $invoice_state->name : '',
                        '{invoice_phone}' => ($invoice->phone) ? $invoice->phone : $invoice->phone_mobile,
                        '{invoice_other}' => $invoice->other,
                        '{order_name}' => $order->getUniqReference(),
                        '{date}' => Tools::displayDate(date('Y-m-d H:i:s'), null, 1),
                        '{carrier}' => ($virtual_product || !isset($carrier->name)) ? $this->trans('No carrier', array(), 'Admin.Payment.Notification') : $carrier->name,
                        '{payment}' => Tools::substr($order->payment, 0, 255),
                        '{products}' => $product_list_html,
                        '{products_txt}' => $product_list_txt,
                        '{discounts}' => $cart_rules_list_html,
                        '{discounts_txt}' => $cart_rules_list_txt,
                        '{total_paid}' => Tools::displayPrice($order->total_paid, $this->context->currency, false),
                        '{total_products}' => Tools::displayPrice(Product::getTaxCalculationMethod() == PS_TAX_EXC ? $order->total_products : $order->total_products_wt, $this->context->currency, false),
                        '{total_discounts}' => Tools::displayPrice($order->total_discounts, $this->context->currency, false),
                        '{total_shipping}' => Tools::displayPrice($order->total_shipping, $this->context->currency, false),
                        '{total_wrapping}' => Tools::displayPrice($order->total_wrapping, $this->context->currency, false),
                        '{total_tax_paid}' => Tools::displayPrice(($order->total_products_wt - $order->total_products) + ($order->total_shipping_tax_incl - $order->total_shipping_tax_excl), $this->context->currency, false), );

                        if (is_array($extra_vars)) {
                            $data = array_merge($data, $extra_vars);
                        }

                        // Join PDF invoice
                        if ((int) Configuration::get('PS_INVOICE') && $order_status->invoice && $order->invoice_number) {
                            $order_invoice_list = $order->getInvoicesCollection();
                            Hook::exec('actionPDFInvoiceRender', array('order_invoice_list' => $order_invoice_list));
                            $pdf = new PDF($order_invoice_list, PDF::TEMPLATE_INVOICE, $this->context->smarty);
                            $file_attachement['content'] = $pdf->render(false);
                            $file_attachement['name'] = Configuration::get('PS_INVOICE_PREFIX', (int) $order->id_lang, null, $order->id_shop) . sprintf('%06d', $order->invoice_number) . '.pdf';
                            $file_attachement['mime'] = 'application/pdf';

                            /* add Note to the invoice with the percentage paid by card and the rest that will be paid by hand */
                            $note = '';
                            if ($tpv->advanced_payment) {
                                $text_advanced_payment = $tpv->advanced_payment_text[$order->id_lang] ? $tpv->advanced_payment_text[$order->id_lang] : $tpv->advanced_payment_text[Configuration::get('PS_LANG_DEFAULT')];
                                $note = "Pagado: ".Tools::displayPrice($amount_paid, $this->context->currency, false);
                                $note .= "\n".$text_advanced_payment.": ".Tools::displayPrice($order->total_paid_tax_incl - $amount_paid)."\n";
                            }
                            if ($tpv->fee_discount) {
                                if ($fee_discount_amount_with_taxes > 0) {
                                    $note .= sprintf($this->l('Redsys Fee applied to the order:').' '.Tools::displayPrice($fee_discount_amount_with_taxes, $this->context->currency, false));
                                } else {
                                    $note .= sprintf($this->l('Redsys Discount applied to the order:').' '.Tools::displayPrice($fee_discount_amount_with_taxes, $this->context->currency, false));
                                }
                            }

                            $order_invoice = new OrderInvoice((int)$order->invoice_number);
                            if (Validate::isLoadedObject($order_invoice)) {
                                $order_invoice->note = $note;
                                $order_invoice->save();
                            } else {
                                $this->errors[] = $this->trans('The invoice for edit note was unable to load', array(), 'Admin.Payment.Notification');
                            }
                            /* ------------------------*/

                        } else {
                            $file_attachement = null;
                        }

                        if ((int)$id_order_state != (int)Configuration::get('REDSYS_AWAITING_PAYMENT_REDSYS')) {
                            if (Validate::isEmail($this->context->customer->email)) {
                                Mail::Send(
                                    (int)$order->id_lang,
                                    'order_conf',
                                    Context::getContext()->getTranslator()->trans(
                                        'Order confirmation',
                                        array(),
                                        'Emails.Subject',
                                        $orderLanguage->locale
                                    ),
                                    $data,
                                    $this->context->customer->email,
                                    $this->context->customer->firstname.' '.$this->context->customer->lastname,
                                    null,
                                    null,
                                    $file_attachement,
                                    null, _PS_MAIL_DIR_, false, (int)$order->id_shop
                                );
                            }
                        }

                        if (self::DEBUG_MODE) {
                            PrestaShopLogger::addLog('PaymentModule::validateOrder - Mail is about to be sent', 1, null, 'Cart', (int) $id_cart, true);
                        }

                        $orderLanguage = new Language((int) $order->id_lang);
                    }

                    // updates stock in shops
                    if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')) {
                        $product_list = $order->getProducts();
                        foreach ($product_list as $product) {
                            // if the available quantities depends on the physical stock
                            if (StockAvailable::dependsOnStock($product['product_id'])) {
                                // synchronizes
                                StockAvailable::synchronize($product['product_id'], $order->id_shop);
                            }
                        }
                    }

                    $order->updateOrderDetailTax();

                    // sync all stock
                    (new \PrestaShop\PrestaShop\Adapter\StockManager())->updatePhysicalProductQuantity(
                        (int) $order->id_shop,
                        (int) Configuration::get('PS_OS_ERROR'),
                        (int) Configuration::get('PS_OS_CANCELED'),
                        null,
                        (int) $order->id
                    );
                } else {
                    $error = $this->trans('Order creation failed', array(), 'Admin.Payment.Notification');
                    PrestaShopLogger::addLog($error, 4, '0000002', 'Cart', intval($order->id_cart));
                    die($error);
                }
            } // End foreach $order_detail_list

            // Use the last order as currentOrder
            if (isset($order) && $order->id) {
                $this->currentOrder = (int) $order->id;
            }

            if (self::DEBUG_MODE) {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - End of validateOrder', 1, null, 'Cart', (int) $id_cart, true);
            }

            return true;
        } else {
            $error = $this->trans('Cart cannot be loaded or an order has already been placed using this cart', array(), 'Admin.Payment.Notification');
            PrestaShopLogger::addLog($error, 4, '0000001', 'Cart', intval($this->context->cart->id));
            die($error);
        }
    }

    public function validateOrderRedsys15($id_cart, $id_order_state, $amount_paid, $payment_method = 'Unknown',
        $message = null, $extra_vars = array(), $currency_special = null, $dont_touch_amount = false,
        $secure_key = false, Shop $shop = null, $tpv = null)
    {
        $this->context->cart = new Cart($id_cart);
        $this->context->customer = new Customer($this->context->cart->id_customer);
        $this->context->language = new Language($this->context->cart->id_lang);
        $this->context->shop = ($shop ? $shop : new Shop($this->context->cart->id_shop));
        ShopUrl::resetMainDomainCache();

        $id_currency = $currency_special ? (int)$currency_special : (int)$this->context->cart->id_currency;
        $this->context->currency = new Currency($id_currency, null, $this->context->shop->id);
        if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery')
            $context_country = $this->context->country;

        $order_status = new OrderState((int)$id_order_state, (int)$this->context->language->id);
        if (!Validate::isLoadedObject($order_status))
            throw new PrestaShopException('Can\'t load Order state status');

        if (!$this->active)
            die(Tools::displayError());
        // Does order already exists ?
        if (Validate::isLoadedObject($this->context->cart) && $this->context->cart->OrderExists() == false)
        {
            if ($secure_key !== false && $secure_key != $this->context->cart->secure_key)
                die(Tools::displayError());

            // For each package, generate an order
            $delivery_option_list = $this->context->cart->getDeliveryOptionList();
            $package_list = $this->context->cart->getPackageList();
            $cart_delivery_option = $this->context->cart->getDeliveryOption();

            // If some delivery options are not defined, or not valid, use the first valid option
            foreach ($delivery_option_list as $id_address => $package)
                if (!isset($cart_delivery_option[$id_address]) || !array_key_exists($cart_delivery_option[$id_address], $package))
                    foreach ($package as $key => $val)
                    {
                        $cart_delivery_option[$id_address] = $key;
                        break;
                    }

            $order_list = array();
            $order_detail_list = array();
            $reference = Order::generateReference();
            $this->currentOrderReference = $reference;

            $order_creation_failed = false;
            $cart_total_paid = (float)Tools::ps_round((float)$this->context->cart->getOrderTotal(true, Cart::BOTH), 2);

            foreach ($cart_delivery_option as $id_address => $key_carriers)
                foreach ($delivery_option_list[$id_address][$key_carriers]['carrier_list'] as $id_carrier => $data)
                    foreach ($data['package_list'] as $id_package)
                    {
                        // Rewrite the id_warehouse
                        $package_list[$id_address][$id_package]['id_warehouse'] = (int)$this->context->cart->getPackageIdWarehouse($package_list[$id_address][$id_package], (int)$id_carrier);
                        $package_list[$id_address][$id_package]['id_carrier'] = $id_carrier;
                    }
            // Make sure CarRule caches are empty
            CartRule::cleanCache();

            $cart_rules = $this->context->cart->getCartRules();
            foreach ($cart_rules as $cart_rule)
            {
                if (($rule = new CartRule((int)$cart_rule['obj']->id)) && Validate::isLoadedObject($rule))
                {
                    if ($error = $rule->checkValidity($this->context, true, true))
                    {
                        $this->context->cart->removeCartRule((int)$rule->id);
                        if (isset($this->context->cookie) && isset($this->context->cookie->id_customer) && $this->context->cookie->id_customer)
                        {
                            if (Configuration::get('PS_ORDER_PROCESS_TYPE') == 1)
                                Tools::redirect('index.php?controller=order-opc&submitAddDiscount=1&discount_name='.urlencode($rule->code));
                            Tools::redirect('index.php?controller=order&submitAddDiscount=1&discount_name='.urlencode($rule->code));
                        }
                        else
                        {
                            $rule_name = isset($rule->name[(int)$this->context->cart->id_lang]) ? $rule->name[(int)$this->context->cart->id_lang] : $rule->code;
                            $error = Tools::displayError(sprintf('CartRule ID %1s (%2s) used in this cart is not valid and has been withdrawn from cart', (int)$rule->id, $rule_name));
                            PrestaShopLogger::addLog($error, 3, '0000002', 'Cart', (int)$this->context->cart->id);
                        }
                    }
                }
            }

            foreach ($package_list as $id_address => $packageByAddress)
                foreach ($packageByAddress as $id_package => $package)
                {
                    $order = new Order();
                    $order->product_list = $package['product_list'];

                    if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery')
                    {
                        $address = new Address($id_address);
                        $this->context->country = new Country($address->id_country, $this->context->cart->id_lang);
                    }

                    $carrier = null;
                    if (!$this->context->cart->isVirtualCart() && isset($package['id_carrier']))
                    {
                        $carrier = new Carrier($package['id_carrier'], $this->context->cart->id_lang);
                        $order->id_carrier = (int)$carrier->id;
                        $id_carrier = (int)$carrier->id;
                    }
                    else
                    {
                        $order->id_carrier = 0;
                        $id_carrier = 0;
                    }

                    $order->id_customer = (int)$this->context->cart->id_customer;
                    $order->id_address_invoice = (int)$this->context->cart->id_address_invoice;
                    $order->id_address_delivery = (int)$id_address;
                    $order->id_currency = $this->context->currency->id;
                    $order->id_lang = (int)$this->context->cart->id_lang;
                    $order->id_cart = (int)$this->context->cart->id;
                    $order->reference = $reference;
                    $order->id_shop = (int)$this->context->shop->id;
                    $order->id_shop_group = (int)$this->context->shop->id_shop_group;

                    /*$order->secure_key = ($secure_key ? pSQL($secure_key) : pSQL($this->context->customer->secure_key));
                    $order->payment = $payment_method;
                    if (isset($this->name))
                        $order->module = $this->name;*/

                    $order_state_advanced = new OrderState((int)Configuration::get('REDSYS_ADVANCED_PAYMENT_STATE'), (int)Configuration::get('PS_LANG_DEFAULT'));

                    if ($tpv->advanced_payment && $order_state_advanced instanceof OrderState) {
                        $order->payment = $order_state_advanced->name;
                    } else {
                        $order->payment = $payment_method;
                    }

                    if (isset($this->name)) {
                        $order->module = $this->name;
                    }

                    $order->recyclable = $this->context->cart->recyclable;
                    $order->gift = (int)$this->context->cart->gift;
                    $order->gift_message = $this->context->cart->gift_message;
                    $order->mobile_theme = $this->context->cart->mobile_theme;
                    $order->conversion_rate = $this->context->currency->conversion_rate;
                    $amount_paid = !$dont_touch_amount ? Tools::ps_round((float)$amount_paid, 2) : $amount_paid;
                    $order->total_paid_real = 0;

                    $order->total_products = (float)$this->context->cart->getOrderTotal(false, Cart::ONLY_PRODUCTS, $order->product_list, $id_carrier);
                    $order->total_products_wt = (float)$this->context->cart->getOrderTotal(true, Cart::ONLY_PRODUCTS, $order->product_list, $id_carrier);

                    $order->total_discounts_tax_excl = (float)abs($this->context->cart->getOrderTotal(false, Cart::ONLY_DISCOUNTS, $order->product_list, $id_carrier));
                    $order->total_discounts_tax_incl = (float)abs($this->context->cart->getOrderTotal(true, Cart::ONLY_DISCOUNTS, $order->product_list, $id_carrier));
                    $order->total_discounts = $order->total_discounts_tax_incl;

                    $order->total_shipping_tax_excl = (float)$this->context->cart->getPackageShippingCost((int)$id_carrier, false, null, $order->product_list);
                    $order->total_shipping_tax_incl = (float)$this->context->cart->getPackageShippingCost((int)$id_carrier, true, null, $order->product_list);
                    $order->total_shipping = $order->total_shipping_tax_incl;

                    if (!is_null($carrier) && Validate::isLoadedObject($carrier))
                        $order->carrier_tax_rate = $carrier->getTaxesRate(new Address($this->context->cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')}));

                    $order->total_wrapping_tax_excl = (float)abs($this->context->cart->getOrderTotal(false, Cart::ONLY_WRAPPING, $order->product_list, $id_carrier));
                    $order->total_wrapping_tax_incl = (float)abs($this->context->cart->getOrderTotal(true, Cart::ONLY_WRAPPING, $order->product_list, $id_carrier));
                    $order->total_wrapping = $order->total_wrapping_tax_incl;

                    $order->total_paid_tax_excl = (float)Tools::ps_round((float)$this->context->cart->getOrderTotal(false, Cart::BOTH, $order->product_list, $id_carrier), 2);
                    $order->total_paid_tax_incl = (float)Tools::ps_round((float)$this->context->cart->getOrderTotal(true, Cart::BOTH, $order->product_list, $id_carrier), 2);

/* calculate the fee or discount with Redsys */
                    if ($tpv->fee_discount) {
                        $fee_discount_amount = $this->getFeeDiscount($tpv, $this->context->cart, $tpv->order_total);
                        $order->total_paid_tax_incl = $order->total_paid_tax_incl + $fee_discount_amount;
                    }

                    if ((int)$id_order_state != (int)Configuration::get('REDSYS_AWAITING_PAYMENT_REDSYS')) {
                        $order->total_paid = $order->total_paid_tax_incl;
                        $order->total_paid_real = $order->total_paid;
                    } else {
                        $order->total_paid = 0;
                        $order->total_paid_real = $order->total_paid;
                    }

                    $order->invoice_date = '0000-00-00 00:00:00';
                    $order->delivery_date = '0000-00-00 00:00:00';
                    $order->secure_key = 0;

                    // Creating order
                    $result = $order->add();

                    if (!$result)
                        throw new PrestaShopException('Can\'t save Order');

                    if ($tpv->fee_discount) {
                        $this->setFeeDiscountFromOrderId($order->id, $fee_discount_amount);
                    }

                    // Amount paid by customer is not the right one -> Status = payment error
                    // We don't use the following condition to avoid the float precision issues : http://www.php.net/manual/en/language.types.float.php
                    // if ($order->total_paid != $order->total_paid_real)
                    // We use number_format in order to compare two string
                    if ($order_status->logable && number_format($cart_total_paid, 2) != number_format($amount_paid, 2))
                        $id_order_state = Configuration::get('PS_OS_ERROR');

                    $order_list[] = $order;

                    // Insert new Order detail list using cart for the current order
                    $order_detail = new OrderDetail(null, null, $this->context);
                    $order_detail->createList($order, $this->context->cart, $id_order_state, $order->product_list, 0, true, $package_list[$id_address][$id_package]['id_warehouse']);
                    $order_detail_list[] = $order_detail;

                    // Adding an entry in order_carrier table
                    if (!is_null($carrier))
                    {
                        $order_carrier = new OrderCarrier();
                        $order_carrier->id_order = (int)$order->id;
                        $order_carrier->id_carrier = (int)$id_carrier;
                        $order_carrier->weight = (float)$order->getTotalWeight();
                        $order_carrier->shipping_cost_tax_excl = (float)$order->total_shipping_tax_excl;
                        $order_carrier->shipping_cost_tax_incl = (float)$order->total_shipping_tax_incl;
                        $order_carrier->add();
                    }
                }

            // The country can only change if the address used for the calculation is the delivery address, and if multi-shipping is activated
            if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery')
                $this->context->country = $context_country;

            // Register Payment only if the order status validate the order
            if ($order_status->logable)
            {
                // $order is the last order loop in the foreach
                // The method addOrderPayment of the class Order make a create a paymentOrder
                //     linked to the order reference and not to the order id
                if (isset($extra_vars['transaction_id']))
                    $transaction_id = $extra_vars['transaction_id'];
                else
                    $transaction_id = null;

                if (!$order->addOrderPayment($amount_paid, null, $transaction_id))
                    throw new PrestaShopException('Can\'t save Order Payment');
            }

            // Next !
            $only_one_gift = false;
            $cart_rule_used = array();
            $products = $this->context->cart->getProducts();

            // Make sure CarRule caches are empty
            CartRule::cleanCache();

            foreach ($order_detail_list as $key => $order_detail)
            {
                $order = $order_list[$key];
                if (!$order_creation_failed && isset($order->id))
                {
                    if (!$secure_key)
                        $message .= '<br />'.Tools::displayError('Warning: the secure key is empty, check your payment account before validation');
                    // Optional message to attach to this order
                    if (isset($message) & !empty($message))
                    {
                        $msg = new Message();
                        $message = strip_tags($message, '<br>');
                        if (Validate::isCleanHtml($message))
                        {
                            $msg->message = $message;
                            $msg->id_order = intval($order->id);
                            $msg->private = 1;
                            $msg->add();
                        }
                    }

                    // Insert new Order detail list using cart for the current order
                    //$orderDetail = new OrderDetail(null, null, $this->context);
                    //$orderDetail->createList($order, $this->context->cart, $id_order_state);

                    // Construct order detail table for the email
                    $products_list = '';
                    $virtual_product = true;

                    foreach ($order->product_list as $key => $product)
                    {
                        $price = Product::getPriceStatic((int)$product['id_product'], false, ($product['id_product_attribute'] ? (int)$product['id_product_attribute'] : null), 6, null, false, true, $product['cart_quantity'], false, (int)$order->id_customer, (int)$order->id_cart, (int)$order->{Configuration::get('PS_TAX_ADDRESS_TYPE')});
                        $price_wt = Product::getPriceStatic((int)$product['id_product'], true, ($product['id_product_attribute'] ? (int)$product['id_product_attribute'] : null), 2, null, false, true, $product['cart_quantity'], false, (int)$order->id_customer, (int)$order->id_cart, (int)$order->{Configuration::get('PS_TAX_ADDRESS_TYPE')});

                        $customization_quantity = 0;
                        $customized_datas = Product::getAllCustomizedDatas((int)$order->id_cart);
                        if (isset($customized_datas[$product['id_product']][$product['id_product_attribute']]))
                        {
                            $customization_text = '';
                            foreach ($customized_datas[$product['id_product']][$product['id_product_attribute']][$order->id_address_delivery] as $customization)
                            {
                                if (isset($customization['datas'][Product::CUSTOMIZE_TEXTFIELD]))
                                    foreach ($customization['datas'][Product::CUSTOMIZE_TEXTFIELD] as $text)
                                        $customization_text .= $text['name'].': '.$text['value'].'<br />';

                                if (isset($customization['datas'][Product::CUSTOMIZE_FILE]))
                                    $customization_text .= sprintf(Tools::displayError('%d image(s)'), count($customization['datas'][Product::CUSTOMIZE_FILE])).'<br />';
                                $customization_text .= '---<br />';
                            }

                            $customization_text = Tools::rtrimString($customization_text, '---<br />');

                            $customization_quantity = (int)$product['customization_quantity'];
                            $products_list .=
                            '<tr style="background-color: '.($key % 2 ? '#DDE2E6' : '#EBECEE').';">
                                <td style="padding: 0.6em 0.4em;width: 15%;">'.$product['reference'].'</td>
                                <td style="padding: 0.6em 0.4em;width: 30%;"><strong>'.$product['name'].(isset($product['attributes']) ? ' - '.$product['attributes'] : '').' - '.Tools::displayError('Customized').(!empty($customization_text) ? ' - '.$customization_text : '').'</strong></td>
                                <td style="padding: 0.6em 0.4em; width: 20%;">'.Tools::displayPrice(Product::getTaxCalculationMethod() == PS_TAX_EXC ?  Tools::ps_round($price, 2) : $price_wt, $this->context->currency, false).'</td>
                                <td style="padding: 0.6em 0.4em; width: 15%;">'.$customization_quantity.'</td>
                                <td style="padding: 0.6em 0.4em; width: 20%;">'.Tools::displayPrice($customization_quantity * (Product::getTaxCalculationMethod() == PS_TAX_EXC ? Tools::ps_round($price, 2) : $price_wt), $this->context->currency, false).'</td>
                            </tr>';
                        }

                        if (!$customization_quantity || (int)$product['cart_quantity'] > $customization_quantity)
                            $products_list .=
                            '<tr style="background-color: '.($key % 2 ? '#DDE2E6' : '#EBECEE').';">
                                <td style="padding: 0.6em 0.4em;width: 15%;">'.$product['reference'].'</td>
                                <td style="padding: 0.6em 0.4em;width: 30%;"><strong>'.$product['name'].(isset($product['attributes']) ? ' - '.$product['attributes'] : '').'</strong></td>
                                <td style="padding: 0.6em 0.4em; width: 20%;">'.Tools::displayPrice(Product::getTaxCalculationMethod((int)$this->context->customer->id) == PS_TAX_EXC ? Tools::ps_round($price, 2) : $price_wt, $this->context->currency, false).'</td>
                                <td style="padding: 0.6em 0.4em; width: 15%;">'.((int)$product['cart_quantity'] - $customization_quantity).'</td>
                                <td style="padding: 0.6em 0.4em; width: 20%;">'.Tools::displayPrice(((int)$product['cart_quantity'] - $customization_quantity) * (Product::getTaxCalculationMethod() == PS_TAX_EXC ? Tools::ps_round($price, 2) : $price_wt), $this->context->currency, false).'</td>
                            </tr>';

                        // Check if is not a virutal product for the displaying of shipping
                        if (!$product['is_virtual'])
                            $virtual_product &= false;

                    } // end foreach ($products)

                    $cart_rules_list = '';
                    $total_reduction_value_ti = 0;
                    $total_reduction_value_tex = 0;
                    foreach ($cart_rules as $cart_rule)
                    {
                        $package = array('id_carrier' => $order->id_carrier, 'id_address' => $order->id_address_delivery, 'products' => $order->product_list);
                        $values = array(
                            'tax_incl' => $cart_rule['obj']->getContextualValue(true, $this->context, CartRule::FILTER_ACTION_ALL_NOCAP, $package),
                            'tax_excl' => $cart_rule['obj']->getContextualValue(false, $this->context, CartRule::FILTER_ACTION_ALL_NOCAP, $package)
                        );

                        // If the reduction is not applicable to this order, then continue with the next one
                        if (!$values['tax_excl'])
                            continue;

                        /* IF
                        ** - This is not multi-shipping
                        ** - The value of the voucher is greater than the total of the order
                        ** - Partial use is allowed
                        ** - This is an "amount" reduction, not a reduction in % or a gift
                        ** THEN
                        ** The voucher is cloned with a new value corresponding to the remainder
                        */

                        if (count($order_list) == 1 && $values['tax_incl'] > ($order->total_products_wt - $total_reduction_value_ti) && $cart_rule['obj']->partial_use == 1 && $cart_rule['obj']->reduction_amount > 0)
                        {
                            // Create a new voucher from the original
                            $voucher = new CartRule($cart_rule['obj']->id); // We need to instantiate the CartRule without lang parameter to allow saving it
                            unset($voucher->id);

                            // Set a new voucher code
                            $voucher->code = empty($voucher->code) ? Tools::substr(md5($order->id.'-'.$order->id_customer.'-'.$cart_rule['obj']->id), 0, 16) : $voucher->code.'-2';
                            if (preg_match('/\-([0-9]{1,2})\-([0-9]{1,2})$/', $voucher->code, $matches) && $matches[1] == $matches[2])
                                $voucher->code = preg_replace('/'.$matches[0].'$/', '-'.(intval($matches[1]) + 1), $voucher->code);

                            // Set the new voucher value
                            if ($voucher->reduction_tax)
                            {
                                $voucher->reduction_amount = $values['tax_incl'] - ($order->total_products_wt - $total_reduction_value_ti);

                                // Add total shipping amout only if reduction amount > total shipping
                                if ($voucher->free_shipping == 1 && $voucher->reduction_amount >= $order->total_shipping_tax_incl)
                                    $voucher->reduction_amount -= $order->total_shipping_tax_incl;
                            }
                            else
                            {
                                $voucher->reduction_amount = $values['tax_excl'] - ($order->total_products - $total_reduction_value_tex);

                                // Add total shipping amout only if reduction amount > total shipping
                                if ($voucher->free_shipping == 1 && $voucher->reduction_amount >= $order->total_shipping_tax_excl)
                                    $voucher->reduction_amount -= $order->total_shipping_tax_excl;
                            }

                            $voucher->id_customer = $order->id_customer;
                            $voucher->quantity = 1;
                            $voucher->quantity_per_user = 1;
                            $voucher->free_shipping = 0;
                            if ($voucher->add())
                            {
                                // If the voucher has conditions, they are now copied to the new voucher
                                CartRule::copyConditions($cart_rule['obj']->id, $voucher->id);

                                $params = array(
                                    '{voucher_amount}' => Tools::displayPrice($voucher->reduction_amount, $this->context->currency, false),
                                    '{voucher_num}' => $voucher->code,
                                    '{firstname}' => $this->context->customer->firstname,
                                    '{lastname}' => $this->context->customer->lastname,
                                    '{id_order}' => $order->reference,
                                    '{order_name}' => $order->getUniqReference()
                                );
                                Mail::Send(
                                    (int)$order->id_lang,
                                    'voucher',
                                    sprintf(Mail::l('New voucher regarding your order %s', (int)$order->id_lang), $order->reference),
                                    $params,
                                    $this->context->customer->email,
                                    $this->context->customer->firstname.' '.$this->context->customer->lastname,
                                    null, null, null, null, _PS_MAIL_DIR_, false, (int)$order->id_shop
                                );
                            }

                            $values['tax_incl'] -= $values['tax_incl'] - $order->total_products_wt;
                            $values['tax_excl'] -= $values['tax_excl'] - $order->total_products;

                        }
                        $total_reduction_value_ti += $values['tax_incl'];
                        $total_reduction_value_tex += $values['tax_excl'];

                        $order->addCartRule($cart_rule['obj']->id, $cart_rule['obj']->name, $values, 0, $cart_rule['obj']->free_shipping);

                        if ($id_order_state != Configuration::get('PS_OS_ERROR') && $id_order_state != Configuration::get('PS_OS_CANCELED') && !in_array($cart_rule['obj']->id, $cart_rule_used))
                        {
                            $cart_rule_used[] = $cart_rule['obj']->id;

                            // Create a new instance of Cart Rule without id_lang, in order to update its quantity
                            $cart_rule_to_update = new CartRule($cart_rule['obj']->id);
                            $cart_rule_to_update->quantity = max(0, $cart_rule_to_update->quantity - 1);
                            $cart_rule_to_update->update();
                        }

                        $cart_rules_list .= '
                        <tr>
                            <td colspan="4" style="padding:0.6em 0.4em;text-align:right">'.Tools::displayError('Voucher name:').' '.$cart_rule['obj']->name.'</td>
                            <td style="padding:0.6em 0.4em;text-align:right">'.($values['tax_incl'] != 0.00 ? '-' : '').Tools::displayPrice($values['tax_incl'], $this->context->currency, false).'</td>
                        </tr>';
                    }

                    // Specify order id for message
                    $old_message = Message::getMessageByCartId((int)$this->context->cart->id);
                    if ($old_message)
                    {
                        $update_message = new Message((int)$old_message['id_message']);
                        $update_message->id_order = (int)$order->id;
                        $update_message->update();

                        // Add this message in the customer thread
                        $customer_thread = new CustomerThread();
                        $customer_thread->id_contact = 0;
                        $customer_thread->id_customer = (int)$order->id_customer;
                        $customer_thread->id_shop = (int)$this->context->shop->id;
                        $customer_thread->id_order = (int)$order->id;
                        $customer_thread->id_lang = (int)$this->context->language->id;
                        $customer_thread->email = $this->context->customer->email;
                        $customer_thread->status = 'open';
                        $customer_thread->token = Tools::passwdGen(12);
                        $customer_thread->add();

                        $customer_message = new CustomerMessage();
                        $customer_message->id_customer_thread = $customer_thread->id;
                        $customer_message->id_employee = 0;
                        $customer_message->message = $update_message->message;
                        $customer_message->private = 0;

                        if (!$customer_message->add())
                            $this->errors[] = Tools::displayError('An error occurred while saving message');
                    }

                    // Hook validate order
                    Hook::exec('actionValidateOrder', array(
                        'cart' => $this->context->cart,
                        'order' => $order,
                        'customer' => $this->context->customer,
                        'currency' => $this->context->currency,
                        'orderStatus' => $order_status
                    ));

                    foreach ($this->context->cart->getProducts() as $product)
                        if ($order_status->logable)
                            ProductSale::addProductSale((int)$product['id_product'], (int)$product['cart_quantity']);

                    // Set the order state
                    $new_history = new OrderHistory();
                    $new_history->id_order = (int)$order->id;
                    //$new_history->changeIdOrderState((int)$id_order_state, $order, true);
                    $new_history->changeIdOrderState((int)$id_order_state, $order, true, $tpv);
                    $new_history->addWithemail(true, $extra_vars);

                    // Switch to back order if needed
                    if (Configuration::get('PS_STOCK_MANAGEMENT') && $order_detail->getStockState())
                    {
                        $history = new OrderHistory();
                        $history->id_order = (int)$order->id;
                        //$history->changeIdOrderState(Configuration::get('PS_OS_OUTOFSTOCK'), $order, true);
                        $history->changeIdOrderState(Configuration::get('PS_OS_OUTOFSTOCK'), $order, true, $tpv);
                        $history->addWithemail();
                    }

                    unset($order_detail);

                    // Order is reloaded because the status just changed
                    $order = new Order($order->id);

                    // Send an e-mail to customer (one order = one email)
                    if ($id_order_state != Configuration::get('PS_OS_ERROR') && $id_order_state != Configuration::get('PS_OS_CANCELED') && $this->context->customer->id)
                    {
                        $invoice = new Address($order->id_address_invoice);
                        $delivery = new Address($order->id_address_delivery);
                        $delivery_state = $delivery->id_state ? new State($delivery->id_state) : false;
                        $invoice_state = $invoice->id_state ? new State($invoice->id_state) : false;

                        $data = array(
                        '{firstname}' => $this->context->customer->firstname,
                        '{lastname}' => $this->context->customer->lastname,
                        '{email}' => $this->context->customer->email,
                        '{delivery_block_txt}' => $this->_getFormatedAddress($delivery, "\n"),
                        '{invoice_block_txt}' => $this->_getFormatedAddress($invoice, "\n"),
                        '{delivery_block_html}' => $this->_getFormatedAddress($delivery, '<br />', array(
                            'firstname' => '<span style="font-weight:bold;">%s</span>',
                            'lastname'  => '<span style="font-weight:bold;">%s</span>'
                        )),
                        '{invoice_block_html}' => $this->_getFormatedAddress($invoice, '<br />', array(
                                'firstname' => '<span style="font-weight:bold;">%s</span>',
                                'lastname'  => '<span style="font-weight:bold;">%s</span>'
                        )),
                        '{delivery_company}' => $delivery->company,
                        '{delivery_firstname}' => $delivery->firstname,
                        '{delivery_lastname}' => $delivery->lastname,
                        '{delivery_address1}' => $delivery->address1,
                        '{delivery_address2}' => $delivery->address2,
                        '{delivery_city}' => $delivery->city,
                        '{delivery_postal_code}' => $delivery->postcode,
                        '{delivery_country}' => $delivery->country,
                        '{delivery_state}' => $delivery->id_state ? $delivery_state->name : '',
                        '{delivery_phone}' => ($delivery->phone) ? $delivery->phone : $delivery->phone_mobile,
                        '{delivery_other}' => $delivery->other,
                        '{invoice_company}' => $invoice->company,
                        '{invoice_vat_number}' => $invoice->vat_number,
                        '{invoice_firstname}' => $invoice->firstname,
                        '{invoice_lastname}' => $invoice->lastname,
                        '{invoice_address2}' => $invoice->address2,
                        '{invoice_address1}' => $invoice->address1,
                        '{invoice_city}' => $invoice->city,
                        '{invoice_postal_code}' => $invoice->postcode,
                        '{invoice_country}' => $invoice->country,
                        '{invoice_state}' => $invoice->id_state ? $invoice_state->name : '',
                        '{invoice_phone}' => ($invoice->phone) ? $invoice->phone : $invoice->phone_mobile,
                        '{invoice_other}' => $invoice->other,
                        '{order_name}' => $order->getUniqReference(),
                        '{date}' => Tools::displayDate(date('Y-m-d H:i:s'),null , 1),
                        '{carrier}' => $virtual_product ? Tools::displayError('No carrier') : $carrier->name,
                        '{payment}' => Tools::substr($order->payment, 0, 32),
                        '{products}' => $this->formatProductAndVoucherForEmail($products_list),
                        '{discounts}' => $this->formatProductAndVoucherForEmail($cart_rules_list),
                        '{total_paid}' => Tools::displayPrice($order->total_paid, $this->context->currency, false),
                        '{total_products}' => Tools::displayPrice($order->total_paid - $order->total_shipping - $order->total_wrapping + $order->total_discounts, $this->context->currency, false),
                        '{total_discounts}' => Tools::displayPrice($order->total_discounts, $this->context->currency, false),
                        '{total_shipping}' => Tools::displayPrice($order->total_shipping, $this->context->currency, false),
                        '{total_wrapping}' => Tools::displayPrice($order->total_wrapping, $this->context->currency, false),
                        '{total_tax_paid}' => Tools::displayPrice(($order->total_products_wt - $order->total_products) + ($order->total_shipping_tax_incl - $order->total_shipping_tax_excl), $this->context->currency, false));

                        if (is_array($extra_vars))
                            $data = array_merge($data, $extra_vars);

                        // Join PDF invoice
                        if ((int)Configuration::get('PS_INVOICE') && $order_status->invoice && $order->invoice_number)
                        {
                            $pdf = new PDF($order->getInvoicesCollection(), PDF::TEMPLATE_INVOICE, $this->context->smarty);
                            $file_attachement['content'] = $pdf->render(false);
                            $file_attachement['name'] = Configuration::get('PS_INVOICE_PREFIX', (int)$order->id_lang, null, $order->id_shop).sprintf('%06d', $order->invoice_number).'.pdf';
                            $file_attachement['mime'] = 'application/pdf';

                            /* add Note to the invoice with the percentage paid by card and the rest that will be paid by hand */
                            $note = '';
                            if ($tpv->advanced_payment) {
                                $text_advanced_payment = $tpv->advanced_payment_text[$order->id_lang] ? $tpv->advanced_payment_text[$order->id_lang] : $tpv->advanced_payment_text[Configuration::get('PS_LANG_DEFAULT')];
                                $note = "Pagado: ".Tools::displayPrice($amount_paid, $this->context->currency, false);
                                $note .= "\n".$text_advanced_payment.": ".Tools::displayPrice($order->total_paid_tax_incl - $amount_paid)."\n";
                            }
                            if ($tpv->fee_discount) {
                                if ($fee_discount_amount > 0) {
                                    $note .= sprintf($this->l('Redsys Fee applied to the order:').' '.Tools::displayPrice($fee_discount_amount, $currency, false));
                                } else {
                                    $note .= sprintf($this->l('Redsys Discount applied to the order:').' '.Tools::displayPrice($fee_discount_amount, $currency, false));
                                }
                            }
                        }
                        else
                            $file_attachement = null;

                        if ((int)$id_order_state != (int)Configuration::get('REDSYS_AWAITING_PAYMENT_REDSYS')) {
                            if (Validate::isEmail($this->context->customer->email))
                                Mail::Send(
                                    (int)$order->id_lang,
                                    'order_conf',
                                    Mail::l('Order confirmation', (int)$order->id_lang),
                                    $data,
                                    $this->context->customer->email,
                                    $this->context->customer->firstname.' '.$this->context->customer->lastname,
                                    null,
                                    null,
                                    $file_attachement,
                                    null, _PS_MAIL_DIR_, false, (int)$order->id_shop
                                );
                        }
                    }

                    // updates stock in shops
                    if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT'))
                    {
                        $product_list = $order->getProducts();
                        foreach ($product_list as $product)
                        {
                            // if the available quantities depends on the physical stock
                            if (StockAvailable::dependsOnStock($product['product_id']))
                            {
                                // synchronizes
                                StockAvailable::synchronize($product['product_id'], $order->id_shop);
                            }
                        }
                    }
                }
                else
                {
                    $error = Tools::displayError('Order creation failed');
                    Logger::addLog($error, 4, '0000002', 'Cart', intval($order->id_cart));
                    die($error);
                }
            } // End foreach $order_detail_list
            // Use the last order as currentOrder
            $this->currentOrder = (int)$order->id;
            return true;
        }
        else
        {
            $error = Tools::displayError('Cart cannot be loaded or an order has already been placed using this cart');
            Logger::addLog($error, 4, '0000001', 'Cart', intval($this->context->cart->id));
            die($error);
        }
    }


    public function validateOrderRedsys($id_cart, $id_order_state, $amount_paid, $payment_method = 'Unknown',
        $message = null, $extra_vars = array(), $currency_special = null, $dont_touch_amount = false,
        $secure_key = false, Shop $shop = null, $tpv = null)
    {
        if (self::DEBUG_MODE)
            PrestaShopLogger::addLog('PaymentModule::validateOrder - Function called', 1, null, 'Cart', (int)$id_cart, true);

        $this->context->cart = new Cart($id_cart);
        $this->context->customer = new Customer($this->context->cart->id_customer);
        $this->context->language = new Language($this->context->cart->id_lang);
        $this->context->shop = ($shop ? $shop : new Shop($this->context->cart->id_shop));
        ShopUrl::resetMainDomainCache();

        $id_currency = $currency_special ? (int)$currency_special : (int)$this->context->cart->id_currency;
        $this->context->currency = new Currency($id_currency, null, $this->context->shop->id);
        if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery')
            $context_country = $this->context->country;

        $order_status = new OrderState((int)$id_order_state, (int)$this->context->language->id);
        if (!Validate::isLoadedObject($order_status))
        {
            PrestaShopLogger::addLog('PaymentModule::validateOrder - Order Status cannot be loaded', 3, null, 'Cart', (int)$id_cart, true);
            throw new PrestaShopException('Can\'t load Order status');
        }

        if (!$this->active)
        {
            PrestaShopLogger::addLog('PaymentModule::validateOrder - Module is not active', 3, null, 'Cart', (int)$id_cart, true);
            die(Tools::displayError());
        }

        // Does order already exists ?
        if (Validate::isLoadedObject($this->context->cart) && $this->context->cart->OrderExists() == false)
        {
            if ($secure_key !== false && $secure_key != $this->context->cart->secure_key)
            {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Secure key does not match', 3, null, 'Cart', (int)$id_cart, true);
                die(Tools::displayError());
            }

            // For each package, generate an order
            $delivery_option_list = $this->context->cart->getDeliveryOptionList();
            $package_list = $this->context->cart->getPackageList();
            $cart_delivery_option = $this->context->cart->getDeliveryOption();

            // If some delivery options are not defined, or not valid, use the first valid option
            foreach ($delivery_option_list as $id_address => $package)
                if (!isset($cart_delivery_option[$id_address]) || !array_key_exists($cart_delivery_option[$id_address], $package))
                    foreach ($package as $key => $val)
                    {
                        $cart_delivery_option[$id_address] = $key;
                        break;
                    }

            $order_list = array();
            $order_detail_list = array();

            do
            $reference = Order::generateReference();
            while (Order::getByReference($reference)->count());

            $this->currentOrderReference = $reference;

            $order_creation_failed = false;
            $cart_total_paid = (float)Tools::ps_round((float)$this->context->cart->getOrderTotal(true, Cart::BOTH), 2);

            foreach ($cart_delivery_option as $id_address => $key_carriers)
                foreach ($delivery_option_list[$id_address][$key_carriers]['carrier_list'] as $id_carrier => $data)
                    foreach ($data['package_list'] as $id_package)
                    {
                        // Rewrite the id_warehouse
                        $package_list[$id_address][$id_package]['id_warehouse'] = (int)$this->context->cart->getPackageIdWarehouse($package_list[$id_address][$id_package], (int)$id_carrier);
                        $package_list[$id_address][$id_package]['id_carrier'] = $id_carrier;
                    }
            // Make sure CarRule caches are empty
            CartRule::cleanCache();
            $cart_rules = $this->context->cart->getCartRules();
            foreach ($cart_rules as $cart_rule)
            {
                if (($rule = new CartRule((int)$cart_rule['obj']->id)) && Validate::isLoadedObject($rule))
                {
                    if ($error = $rule->checkValidity($this->context, true, true))
                    {
                        $this->context->cart->removeCartRule((int)$rule->id);
                        if (isset($this->context->cookie) && isset($this->context->cookie->id_customer) && $this->context->cookie->id_customer && !empty($rule->code))
                        {
                            if (Configuration::get('PS_ORDER_PROCESS_TYPE') == 1)
                                Tools::redirect('index.php?controller=order-opc&submitAddDiscount=1&discount_name='.urlencode($rule->code));
                            Tools::redirect('index.php?controller=order&submitAddDiscount=1&discount_name='.urlencode($rule->code));
                        }
                        else
                        {
                            $rule_name = isset($rule->name[(int)$this->context->cart->id_lang]) ? $rule->name[(int)$this->context->cart->id_lang] : $rule->code;
                            $error = Tools::displayError(sprintf('CartRule ID %1s (%2s) used in this cart is not valid and has been withdrawn from cart', (int)$rule->id, $rule_name));
                            PrestaShopLogger::addLog($error, 3, '0000002', 'Cart', (int)$this->context->cart->id);
                        }
                    }
                }
            }

            foreach ($package_list as $id_address => $packageByAddress)
                foreach ($packageByAddress as $id_package => $package)
                {
                    $order = new Order();
                    $order->product_list = $package['product_list'];

                    if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery')
                    {
                        $address = new Address($id_address);
                        $this->context->country = new Country($address->id_country, $this->context->cart->id_lang);
                        if (!$this->context->country->active)
                            throw new PrestaShopException('The delivery address country is not active.');
                    }

                    $carrier = null;
                    if (!$this->context->cart->isVirtualCart() && isset($package['id_carrier']))
                    {
                        $carrier = new Carrier($package['id_carrier'], $this->context->cart->id_lang);
                        $order->id_carrier = (int)$carrier->id;
                        $id_carrier = (int)$carrier->id;
                    }
                    else
                    {
                        $order->id_carrier = 0;
                        $id_carrier = 0;
                    }

                    $order->id_customer = (int)$this->context->cart->id_customer;
                    $order->id_address_invoice = (int)$this->context->cart->id_address_invoice;
                    $order->id_address_delivery = (int)$id_address;
                    $order->id_currency = $this->context->currency->id;
                    $order->id_lang = (int)$this->context->cart->id_lang;
                    $order->id_cart = (int)$this->context->cart->id;
                    $order->reference = $reference;
                    $order->id_shop = (int)$this->context->shop->id;
                    $order->id_shop_group = (int)$this->context->shop->id_shop_group;

                    $order->secure_key = ($secure_key ? pSQL($secure_key) : pSQL($this->context->customer->secure_key));
                    $order_state_advanced = new OrderState((int)Configuration::get('REDSYS_ADVANCED_PAYMENT_STATE'), (int)Configuration::get('PS_LANG_DEFAULT'));

                    if ($tpv->advanced_payment && $order_state_advanced instanceof OrderState) {
                        $order->payment = $order_state_advanced->name;
                    } else {
                        $order->payment = $payment_method;
                    }

                    if (isset($this->name)) {
                        $order->module = $this->name;
                    }

                    $order->recyclable = $this->context->cart->recyclable;
                    $order->gift = (int)$this->context->cart->gift;
                    $order->gift_message = $this->context->cart->gift_message;
                    $order->mobile_theme = $this->context->cart->mobile_theme;
                    $order->conversion_rate = $this->context->currency->conversion_rate;
                    $amount_paid = !$dont_touch_amount ? Tools::ps_round((float)$amount_paid, 2) : $amount_paid;
                    $order->total_paid_real = 0;

                    $order->total_products = (float)$this->context->cart->getOrderTotal(false, Cart::ONLY_PRODUCTS, $order->product_list, $id_carrier);
                    $order->total_products_wt = (float)$this->context->cart->getOrderTotal(true, Cart::ONLY_PRODUCTS, $order->product_list, $id_carrier);

                    $order->total_discounts_tax_excl = (float)abs($this->context->cart->getOrderTotal(false, Cart::ONLY_DISCOUNTS, $order->product_list, $id_carrier));
                    $order->total_discounts_tax_incl = (float)abs($this->context->cart->getOrderTotal(true, Cart::ONLY_DISCOUNTS, $order->product_list, $id_carrier));
                    $order->total_discounts = $order->total_discounts_tax_incl;

                    $order->total_shipping_tax_excl = (float)$this->context->cart->getPackageShippingCost((int)$id_carrier, false, null, $order->product_list);
                    $order->total_shipping_tax_incl = (float)$this->context->cart->getPackageShippingCost((int)$id_carrier, true, null, $order->product_list);
                    $order->total_shipping = $order->total_shipping_tax_incl;

                    if (!is_null($carrier) && Validate::isLoadedObject($carrier))
                        $order->carrier_tax_rate = $carrier->getTaxesRate(new Address($this->context->cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')}));

                    $order->total_wrapping_tax_excl = (float)abs($this->context->cart->getOrderTotal(false, Cart::ONLY_WRAPPING, $order->product_list, $id_carrier));
                    $order->total_wrapping_tax_incl = (float)abs($this->context->cart->getOrderTotal(true, Cart::ONLY_WRAPPING, $order->product_list, $id_carrier));
                    $order->total_wrapping = $order->total_wrapping_tax_incl;

                    $order->total_paid_tax_excl = (float)Tools::ps_round((float)$this->context->cart->getOrderTotal(false, Cart::BOTH, $order->product_list, $id_carrier), 2);
                    $order->total_paid_tax_incl = (float)Tools::ps_round((float)$this->context->cart->getOrderTotal(true, Cart::BOTH, $order->product_list, $id_carrier), 2);
                    $order->total_paid = $order->total_paid_tax_incl;

                    if ((int)$id_order_state != (int)Configuration::get('REDSYS_AWAITING_PAYMENT_REDSYS')) {
                        $order->total_paid_real = $order->total_paid;
                    }

                    $order->invoice_date = '0000-00-00 00:00:00';
                    $order->delivery_date = '0000-00-00 00:00:00';

                    if (self::DEBUG_MODE)
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - Order is about to be added', 1, null, 'Cart', (int)$id_cart, true);

                    // Creating order
                    $result = $order->add();

                    if (!$result)
                    {
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - Order cannot be created', 3, null, 'Cart', (int)$id_cart, true);
                        throw new PrestaShopException('Can\'t save Order');
                    }

                    if ($tpv->fee_discount && $fee_discount != 0) {
                        $this->setFeeDiscountFromOrderId($order->id, $fee_discount);
                    }
                    // Amount paid by customer is not the right one -> Status = payment error
                    // We don't use the following condition to avoid the float precision issues : http://www.php.net/manual/en/language.types.float.php
                    // if ($order->total_paid != $order->total_paid_real)
                    // We use number_format in order to compare two string
                    /*if ($order_status->logable && number_format($cart_total_paid, 2) != number_format($amount_paid, 2))
                        $id_order_state = Configuration::get('PS_OS_ERROR');*/

                    $order_list[] = $order;

                    if (self::DEBUG_MODE)
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - OrderDetail is about to be added', 1, null, 'Cart', (int)$id_cart, true);

                    // Insert new Order detail list using cart for the current order
                    $order_detail = new OrderDetail(null, null, $this->context);
                    $order_detail->createList($order, $this->context->cart, $id_order_state, $order->product_list, 0, true, $package_list[$id_address][$id_package]['id_warehouse']);
                    $order_detail_list[] = $order_detail;

                    if (self::DEBUG_MODE)
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - OrderCarrier is about to be added', 1, null, 'Cart', (int)$id_cart, true);

                    // Adding an entry in order_carrier table
                    if (!is_null($carrier))
                    {
                        $order_carrier = new OrderCarrier();
                        $order_carrier->id_order = (int)$order->id;
                        $order_carrier->id_carrier = (int)$id_carrier;
                        $order_carrier->weight = (float)$order->getTotalWeight();
                        $order_carrier->shipping_cost_tax_excl = (float)$order->total_shipping_tax_excl;
                        $order_carrier->shipping_cost_tax_incl = (float)$order->total_shipping_tax_incl;
                        $order_carrier->add();
                    }
                }

            // The country can only change if the address used for the calculation is the delivery address, and if multi-shipping is activated
            if (Configuration::get('PS_TAX_ADDRESS_TYPE') == 'id_address_delivery')
                $this->context->country = $context_country;

            if (!$this->context->country->active)
            {
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Country is not active', 3, null, 'Cart', (int)$id_cart, true);
                throw new PrestaShopException('The order address country is not active.');
            }

            if (self::DEBUG_MODE)
                PrestaShopLogger::addLog('PaymentModule::validateOrder - Payment is about to be added', 1, null, 'Cart', (int)$id_cart, true);

            // Register Payment only if the order status validate the order
            if ($order_status->logable)
            {
                // $order is the last order loop in the foreach
                // The method addOrderPayment of the class Order make a create a paymentOrder
                //     linked to the order reference and not to the order id
                if (isset($extra_vars['transaction_id']))
                    $transaction_id = $extra_vars['transaction_id'];
                else
                    $transaction_id = null;

                if (!$order->addOrderPayment($amount_paid, null, $transaction_id))
                {
                    PrestaShopLogger::addLog('PaymentModule::validateOrder - Cannot save Order Payment', 3, null, 'Cart', (int)$id_cart, true);
                    throw new PrestaShopException('Can\'t save Order Payment');
                }
            }

            // Next !
            $only_one_gift = false;
            $cart_rule_used = array();
            $products = $this->context->cart->getProducts();

            // Make sure CarRule caches are empty
            CartRule::cleanCache();
            foreach ($order_detail_list as $key => $order_detail)
            {
                $order = $order_list[$key];
                if (!$order_creation_failed && isset($order->id))
                {
                    if (!$secure_key)
                        $message .= '<br />'.Tools::displayError('Warning: the secure key is empty, check your payment account before validation');
                    // Optional message to attach to this order
                    if (isset($message) & !empty($message))
                    {
                        $msg = new Message();
                        $message = strip_tags($message, '<br>');
                        if (Validate::isCleanHtml($message))
                        {
                            if (self::DEBUG_MODE)
                                PrestaShopLogger::addLog('PaymentModule::validateOrder - Message is about to be added', 1, null, 'Cart', (int)$id_cart, true);
                            $msg->message = $message;
                            $msg->id_order = intval($order->id);
                            $msg->private = 1;
                            $msg->add();
                        }
                    }

                    // Insert new Order detail list using cart for the current order
                    //$orderDetail = new OrderDetail(null, null, $this->context);
                    //$orderDetail->createList($order, $this->context->cart, $id_order_state);

                    // Construct order detail table for the email
                    $products_list = '';
                    $virtual_product = true;

                    $product_var_tpl_list = array();
                    foreach ($order->product_list as $product)
                    {
                        $price = Product::getPriceStatic((int)$product['id_product'], false, ($product['id_product_attribute'] ? (int)$product['id_product_attribute'] : null), 6, null, false, true, $product['cart_quantity'], false, (int)$order->id_customer, (int)$order->id_cart, (int)$order->{Configuration::get('PS_TAX_ADDRESS_TYPE')});
                        $price_wt = Product::getPriceStatic((int)$product['id_product'], true, ($product['id_product_attribute'] ? (int)$product['id_product_attribute'] : null), 2, null, false, true, $product['cart_quantity'], false, (int)$order->id_customer, (int)$order->id_cart, (int)$order->{Configuration::get('PS_TAX_ADDRESS_TYPE')});

                        $product_price = Product::getTaxCalculationMethod() == PS_TAX_EXC ? Tools::ps_round($price, 2) : $price_wt;

                        $product_var_tpl = array(
                            'reference' => $product['reference'],
                            'name' => $product['name'].(isset($product['attributes']) ? ' - '.$product['attributes'] : ''),
                            'unit_price' => Tools::displayPrice($product_price, $this->context->currency, false),
                            'price' => Tools::displayPrice($product_price * $product['quantity'], $this->context->currency, false),
                            'quantity' => $product['quantity'],
                            'customization' => array()
                        );

                        $customized_datas = Product::getAllCustomizedDatas((int)$order->id_cart);
                        if (isset($customized_datas[$product['id_product']][$product['id_product_attribute']]))
                        {
                            $product_var_tpl['customization'] = array();
                            foreach ($customized_datas[$product['id_product']][$product['id_product_attribute']][$order->id_address_delivery] as $customization)
                            {
                                $customization_text = '';
                                if (isset($customization['datas'][Product::CUSTOMIZE_TEXTFIELD]))
                                    foreach ($customization['datas'][Product::CUSTOMIZE_TEXTFIELD] as $text)
                                        $customization_text .= $text['name'].': '.$text['value'].'<br />';

                                if (isset($customization['datas'][Product::CUSTOMIZE_FILE]))
                                    $customization_text .= sprintf(Tools::displayError('%d image(s)'), count($customization['datas'][Product::CUSTOMIZE_FILE])).'<br />';

                                $customization_quantity = (int)$product['customization_quantity'];

                                $product_var_tpl['customization'][] = array(
                                    'customization_text' => $customization_text,
                                    'customization_quantity' => $customization_quantity,
                                    'quantity' => Tools::displayPrice($customization_quantity * $product_price, $this->context->currency, false)
                                );
                            }
                        }

                        $product_var_tpl_list[] = $product_var_tpl;
                        // Check if is not a virutal product for the displaying of shipping
                        if (!$product['is_virtual'])
                            $virtual_product &= false;

                    } // end foreach ($products)

                    $product_list_txt = '';
                    $product_list_html = '';
                    if (count($product_var_tpl_list) > 0)
                    {
                        $product_list_txt = $this->getEmailTemplateContentRedsys('order_conf_product_list.txt', Mail::TYPE_TEXT, $product_var_tpl_list);
                        $product_list_html = $this->getEmailTemplateContentRedsys('order_conf_product_list.tpl', Mail::TYPE_HTML, $product_var_tpl_list);
                    }

                    $cart_rules_list = array();
                    $total_reduction_value_ti = 0;
                    $total_reduction_value_tex = 0;
                    foreach ($cart_rules as $cart_rule)
                    {
                        $package = array('id_carrier' => $order->id_carrier, 'id_address' => $order->id_address_delivery, 'products' => $order->product_list);
                        $values = array(
                            'tax_incl' => $cart_rule['obj']->getContextualValue(true, $this->context, CartRule::FILTER_ACTION_ALL_NOCAP, $package),
                            'tax_excl' => $cart_rule['obj']->getContextualValue(false, $this->context, CartRule::FILTER_ACTION_ALL_NOCAP, $package)
                        );

                        // If the reduction is not applicable to this order, then continue with the next one
                        if (!$values['tax_excl'])
                            continue;

                        /* IF
                        ** - This is not multi-shipping
                        ** - The value of the voucher is greater than the total of the order
                        ** - Partial use is allowed
                        ** - This is an "amount" reduction, not a reduction in % or a gift
                        ** THEN
                        ** The voucher is cloned with a new value corresponding to the remainder
                        */

                        if (count($order_list) == 1 && $values['tax_incl'] > ($order->total_products_wt - $total_reduction_value_ti) && $cart_rule['obj']->partial_use == 1 && $cart_rule['obj']->reduction_amount > 0)
                        {
                            // Create a new voucher from the original
                            $voucher = new CartRule($cart_rule['obj']->id); // We need to instantiate the CartRule without lang parameter to allow saving it
                            unset($voucher->id);

                            // Set a new voucher code
                            $voucher->code = empty($voucher->code) ? Tools::substr(md5($order->id.'-'.$order->id_customer.'-'.$cart_rule['obj']->id), 0, 16) : $voucher->code.'-2';
                            if (preg_match('/\-([0-9]{1,2})\-([0-9]{1,2})$/', $voucher->code, $matches) && $matches[1] == $matches[2])
                                $voucher->code = preg_replace('/'.$matches[0].'$/', '-'.(intval($matches[1]) + 1), $voucher->code);

                            // Set the new voucher value
                            if ($voucher->reduction_tax)
                            {
                                $voucher->reduction_amount = $values['tax_incl'] - ($order->total_products_wt - $total_reduction_value_ti);

                                // Add total shipping amout only if reduction amount > total shipping
                                if ($voucher->free_shipping == 1 && $voucher->reduction_amount >= $order->total_shipping_tax_incl)
                                    $voucher->reduction_amount -= $order->total_shipping_tax_incl;
                            }
                            else
                            {
                                $voucher->reduction_amount = $values['tax_excl'] - ($order->total_products - $total_reduction_value_tex);

                                // Add total shipping amout only if reduction amount > total shipping
                                if ($voucher->free_shipping == 1 && $voucher->reduction_amount >= $order->total_shipping_tax_excl)
                                    $voucher->reduction_amount -= $order->total_shipping_tax_excl;
                            }

                            $voucher->id_customer = $order->id_customer;
                            $voucher->quantity = 1;
                            $voucher->quantity_per_user = 1;
                            $voucher->free_shipping = 0;
                            if ($voucher->add())
                            {
                                // If the voucher has conditions, they are now copied to the new voucher
                                CartRule::copyConditions($cart_rule['obj']->id, $voucher->id);

                                $params = array(
                                    '{voucher_amount}' => Tools::displayPrice($voucher->reduction_amount, $this->context->currency, false),
                                    '{voucher_num}' => $voucher->code,
                                    '{firstname}' => $this->context->customer->firstname,
                                    '{lastname}' => $this->context->customer->lastname,
                                    '{id_order}' => $order->reference,
                                    '{order_name}' => $order->getUniqReference()
                                );
                                Mail::Send(
                                    (int)$order->id_lang,
                                    'voucher',
                                    sprintf(Mail::l('New voucher for your order %s', (int)$order->id_lang), $order->reference),
                                    $params,
                                    $this->context->customer->email,
                                    $this->context->customer->firstname.' '.$this->context->customer->lastname,
                                    null, null, null, null, _PS_MAIL_DIR_, false, (int)$order->id_shop
                                );
                            }

                            $values['tax_incl'] -= $values['tax_incl'] - $order->total_products_wt;
                            $values['tax_excl'] -= $values['tax_excl'] - $order->total_products;

                        }
                        $total_reduction_value_ti += $values['tax_incl'];
                        $total_reduction_value_tex += $values['tax_excl'];

                        $order->addCartRule($cart_rule['obj']->id, $cart_rule['obj']->name, $values, 0, $cart_rule['obj']->free_shipping);

                        if ($id_order_state != Configuration::get('PS_OS_ERROR') && $id_order_state != Configuration::get('PS_OS_CANCELED') && !in_array($cart_rule['obj']->id, $cart_rule_used))
                        {
                            $cart_rule_used[] = $cart_rule['obj']->id;

                            // Create a new instance of Cart Rule without id_lang, in order to update its quantity
                            $cart_rule_to_update = new CartRule($cart_rule['obj']->id);
                            $cart_rule_to_update->quantity = max(0, $cart_rule_to_update->quantity - 1);
                            $cart_rule_to_update->update();
                        }

                        $cart_rules_list[] = array(
                            'voucher_name' => $cart_rule['obj']->name,
                            'voucher_reduction' => ($values['tax_incl'] != 0.00 ? '-' : '').Tools::displayPrice($values['tax_incl'], $this->context->currency, false)
                        );
                    }

                    $cart_rules_list_txt = '';
                    $cart_rules_list_html = '';
                    if (count($cart_rules_list) > 0)
                    {
                        $cart_rules_list_txt = $this->getEmailTemplateContentRedsys('order_conf_cart_rules.txt', Mail::TYPE_TEXT, $cart_rules_list);
                        $cart_rules_list_html = $this->getEmailTemplateContentRedsys('order_conf_cart_rules.tpl', Mail::TYPE_HTML, $cart_rules_list);
                    }

                    // Specify order id for message
                    $old_message = Message::getMessageByCartId((int)$this->context->cart->id);
                    if ($old_message)
                    {
                        $update_message = new Message((int)$old_message['id_message']);
                        $update_message->id_order = (int)$order->id;
                        $update_message->update();

                        // Add this message in the customer thread
                        $customer_thread = new CustomerThread();
                        $customer_thread->id_contact = 0;
                        $customer_thread->id_customer = (int)$order->id_customer;
                        $customer_thread->id_shop = (int)$this->context->shop->id;
                        $customer_thread->id_order = (int)$order->id;
                        $customer_thread->id_lang = (int)$this->context->language->id;
                        $customer_thread->email = $this->context->customer->email;
                        $customer_thread->status = 'open';
                        $customer_thread->token = Tools::passwdGen(12);
                        $customer_thread->add();

                        $customer_message = new CustomerMessage();
                        $customer_message->id_customer_thread = $customer_thread->id;
                        $customer_message->id_employee = 0;
                        $customer_message->message = $update_message->message;
                        $customer_message->private = 0;

                        if (!$customer_message->add())
                            $this->errors[] = Tools::displayError('An error occurred while saving message');
                    }

                    if (self::DEBUG_MODE)
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - Hook validateOrder is about to be called', 1, null, 'Cart', (int)$id_cart, true);

                    // Hook validate order
                    Hook::exec('actionValidateOrder', array(
                        'cart' => $this->context->cart,
                        'order' => $order,
                        'customer' => $this->context->customer,
                        'currency' => $this->context->currency,
                        'orderStatus' => $order_status
                    ));

                    foreach ($this->context->cart->getProducts() as $product)
                        if ($order_status->logable)
                            ProductSale::addProductSale((int)$product['id_product'], (int)$product['cart_quantity']);

                    if (self::DEBUG_MODE)
                        PrestaShopLogger::addLog('PaymentModule::validateOrder - Order Status is about to be added', 1, null, 'Cart', (int)$id_cart, true);

                    // Set the order status
                    $new_history = new OrderHistory();
                    $new_history->id_order = (int)$order->id;
                    $new_history->changeIdOrderState((int)$id_order_state, $order, true, $tpv);
                    $new_history->addWithemail(true, $extra_vars);

                    // Switch to back order if needed
                    if (Configuration::get('PS_STOCK_MANAGEMENT') && $order_detail->getStockState())
                    {
                        $history = new OrderHistory();
                        $history->id_order = (int)$order->id;
                        $history->changeIdOrderState(Configuration::get('PS_OS_OUTOFSTOCK'), $order, true, $tpv);
                        $history->addWithemail();
                    }

                    unset($order_detail);

                    // Order is reloaded because the status just changed
                    $order = new Order($order->id);

                    // Send an e-mail to customer (one order = one email)
                    if ($id_order_state != Configuration::get('PS_OS_ERROR') && $id_order_state != Configuration::get('PS_OS_CANCELED') && $this->context->customer->id)
                    {
                        $invoice = new Address($order->id_address_invoice);
                        $delivery = new Address($order->id_address_delivery);
                        $delivery_state = $delivery->id_state ? new State($delivery->id_state) : false;
                        $invoice_state = $invoice->id_state ? new State($invoice->id_state) : false;

                        $data = array(
                        '{firstname}' => $this->context->customer->firstname,
                        '{lastname}' => $this->context->customer->lastname,
                        '{email}' => $this->context->customer->email,
                        '{delivery_block_txt}' => $this->_getFormatedAddress($delivery, "\n"),
                        '{invoice_block_txt}' => $this->_getFormatedAddress($invoice, "\n"),
                        '{delivery_block_html}' => $this->_getFormatedAddress($delivery, '<br />', array(
                            'firstname' => '<span style="font-weight:bold;">%s</span>',
                            'lastname'  => '<span style="font-weight:bold;">%s</span>'
                        )),
                        '{invoice_block_html}' => $this->_getFormatedAddress($invoice, '<br />', array(
                                'firstname' => '<span style="font-weight:bold;">%s</span>',
                                'lastname'  => '<span style="font-weight:bold;">%s</span>'
                        )),
                        '{delivery_company}' => $delivery->company,
                        '{delivery_firstname}' => $delivery->firstname,
                        '{delivery_lastname}' => $delivery->lastname,
                        '{delivery_address1}' => $delivery->address1,
                        '{delivery_address2}' => $delivery->address2,
                        '{delivery_city}' => $delivery->city,
                        '{delivery_postal_code}' => $delivery->postcode,
                        '{delivery_country}' => $delivery->country,
                        '{delivery_state}' => $delivery->id_state ? $delivery_state->name : '',
                        '{delivery_phone}' => ($delivery->phone) ? $delivery->phone : $delivery->phone_mobile,
                        '{delivery_other}' => $delivery->other,
                        '{invoice_company}' => $invoice->company,
                        '{invoice_vat_number}' => $invoice->vat_number,
                        '{invoice_firstname}' => $invoice->firstname,
                        '{invoice_lastname}' => $invoice->lastname,
                        '{invoice_address2}' => $invoice->address2,
                        '{invoice_address1}' => $invoice->address1,
                        '{invoice_city}' => $invoice->city,
                        '{invoice_postal_code}' => $invoice->postcode,
                        '{invoice_country}' => $invoice->country,
                        '{invoice_state}' => $invoice->id_state ? $invoice_state->name : '',
                        '{invoice_phone}' => ($invoice->phone) ? $invoice->phone : $invoice->phone_mobile,
                        '{invoice_other}' => $invoice->other,
                        '{order_name}' => $order->getUniqReference(),
                        '{date}' => Tools::displayDate(date('Y-m-d H:i:s'), null, 1),
                        '{carrier}' => ($virtual_product || !isset($carrier->name)) ? Tools::displayError('No carrier') : $carrier->name,
                        '{payment}' => Tools::substr($order->payment, 0, 32),
                        '{products}' => $product_list_html,
                        '{products_txt}' => $product_list_txt,
                        '{discounts}' => $cart_rules_list_html,
                        '{discounts_txt}' => $cart_rules_list_txt,
                        '{total_paid}' => Tools::displayPrice($order->total_paid, $this->context->currency, false),
                        '{total_products}' => Tools::displayPrice($order->total_paid - $order->total_shipping - $order->total_wrapping + $order->total_discounts, $this->context->currency, false),
                        '{total_discounts}' => Tools::displayPrice($order->total_discounts, $this->context->currency, false),
                        '{total_shipping}' => Tools::displayPrice($order->total_shipping, $this->context->currency, false),
                        '{total_wrapping}' => Tools::displayPrice($order->total_wrapping, $this->context->currency, false),
                        '{total_tax_paid}' => Tools::displayPrice(($order->total_products_wt - $order->total_products) + ($order->total_shipping_tax_incl - $order->total_shipping_tax_excl), $this->context->currency, false));

                        if (is_array($extra_vars))
                            $data = array_merge($data, $extra_vars);

                        // Join PDF invoice
                        if ((int)Configuration::get('PS_INVOICE') && $order_status->invoice && $order->invoice_number)
                        {
                            $pdf = new PDF($order->getInvoicesCollection(), PDF::TEMPLATE_INVOICE, $this->context->smarty);
                            $file_attachement['content'] = $pdf->render(false);
                            $file_attachement['name'] = Configuration::get('PS_INVOICE_PREFIX', (int)$order->id_lang, null, $order->id_shop).sprintf('%06d', $order->invoice_number).'.pdf';
                            $file_attachement['mime'] = 'application/pdf';

                            $note = '';
                            if ($tpv->advanced_payment) {
                                $text_advanced_payment = $tpv->advanced_payment_text[$order->id_lang] ? $tpv->advanced_payment_text[$order->id_lang] : $tpv->advanced_payment_text[Configuration::get('PS_LANG_DEFAULT')];
                                $note = "Pagado: ".Tools::displayPrice($amount_paid, $this->context->currency, false);
                                $note .= "\n".$text_advanced_payment.": ".Tools::displayPrice($order->total_paid_tax_incl - $amount_paid)."\n";
                            }
                            if ($tpv->fee_discount) {
                                if ($fee_discount_amount_with_taxes > 0) {
                                    $note .= sprintf($this->l('Redsys Fee applied to the order:').' '.Tools::displayPrice($fee_discount_amount_with_taxes, $currency, false));
                                } else {
                                    $note .= sprintf($this->l('Redsys Discount applied to the order:').' '.Tools::displayPrice($fee_discount_amount_with_taxes, $currency, false));
                                }
                            }
                            $order_invoice = new OrderInvoice((int)$order->invoice_number);
                            if (Validate::isLoadedObject($order_invoice)) {
                                $order_invoice->note = $note;
                                $order_invoice->save();
                            } else {
                                $this->errors[] = $this->trans('The invoice for edit note was unable to load', array(), 'Admin.Payment.Notification');
                            }
                        }
                        else
                            $file_attachement = null;



                        if (self::DEBUG_MODE)
                            PrestaShopLogger::addLog('PaymentModule::validateOrder - Mail is about to be sent', 1, null, 'Cart', (int)$id_cart, true);

                        if ((int)$id_order_state != (int)Configuration::get('REDSYS_AWAITING_PAYMENT_REDSYS')) {
                            if (Validate::isEmail($this->context->customer->email))
                                Mail::Send(
                                    (int)$order->id_lang,
                                    'order_conf',
                                    Mail::l('Order confirmation', (int)$order->id_lang)." Ref: ".$order->getUniqReference(),
                                    $data,
                                    $this->context->customer->email,
                                    $this->context->customer->firstname.' '.$this->context->customer->lastname,
                                    null,
                                    null,
                                    $file_attachement,
                                    null, _PS_MAIL_DIR_, false, (int)$order->id_shop
                                );
                        }
                    }

                    // updates stock in shops
                    if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT'))
                    {
                        $product_list = $order->getProducts();
                        foreach ($product_list as $product)
                        {
                            // if the available quantities depends on the physical stock
                            if (StockAvailable::dependsOnStock($product['product_id']))
                            {
                                // synchronizes
                                StockAvailable::synchronize($product['product_id'], $order->id_shop);
                            }
                        }
                    }
                }
                else
                {
                    $error = Tools::displayError('Order creation failed');
                    PrestaShopLogger::addLog($error, 4, '0000002', 'Cart', intval($order->id_cart));
                    die($error);
                }
            } // End foreach $order_detail_list
            // Use the last order as currentOrder
            $this->currentOrder = (int)$order->id;

            if (self::DEBUG_MODE)
                PrestaShopLogger::addLog('PaymentModule::validateOrder - End of validateOrder', 1, null, 'Cart', (int)$id_cart, true);

            return true;
        }
        else
        {
            $error = Tools::displayError('Cart cannot be loaded or an order has already been placed using this cart');
            PrestaShopLogger::addLog($error, 4, '0000001', 'Cart', intval($this->context->cart->id));
            die($error);
        }
    }

    public function checkTable()
    {
        $sql = '
                SELECT 1 FROM '.pSQL(_DB_PREFIX_.$this->name).'_tpv LIMIT 1';
        return $result = Db::getInstance()->ExecuteS($sql);
    }

    public function getErrorDescription($errorId)
    {
        $errorMessage = array(
            "SIS0007" => "Error al desmontar el XML de entrada",
            "SIS0008" => "Error falta Ds_Merchant_MerchantCode",
            "SIS0009" => "Error de formato en Ds_Merchant_MerchantCode",
            "SIS0010" => "Error falta Ds_Merchant_Terminal",
            "SIS0011" => "Error de formato en Ds_Merchant_Terminal",
            "SIS0014" => "Error de formato en Ds_Merchant_Order",
            "SIS0015" => "Error falta Ds_Merchant_Currency",
            "SIS0016" => "Error de formato en Ds_Merchant_Currency",
            "SIS0017" => "Error no se admiten operaciones en pesetas",
            "SIS0018" => "Error falta Ds_Merchant_Amount",
            "SIS0019" => "Error de formato en Ds_Merchant_Amount",
            "SIS0020" => "Error falta Ds_Merchant_MerchantSignature",
            "SIS0021" => "Error la Ds_Merchant_MerchantSignature viene vacía",
            "SIS0022" => "Error de formato en Ds_Merchant_TransactionType",
            "SIS0023" => "Error Ds_Merchant_TransactionType desconocido",
            "SIS0024" => "Error Ds_Merchant_ConsumerLanguage tiene mas de 3 posiciones",
            "SIS0025" => "Error de formato en Ds_Merchant_ConsumerLanguage",
            "SIS0026" => "Error No existe el comercio / terminal enviado",
            "SIS0027" => "Error Moneda enviada por el comercio es diferente a la que tiene asignada para ese terminal ",
            "SIS0028" => "Error Comercio / terminal está dado de baja",
            "SIS0030" => "Error en un pago con tarjeta ha llegado un tipo de operación que no es ni pago ni preautorización ",
            "SIS0031" => "Método de pago no definido",
            "SIS0033" => "Error en un pago con móvil ha llegado un tipo de operación que no es ni pago ni preautorización ",
            "SIS0034" => "Error de acceso a la Base de Datos",
            "SIS0037" => "El número de teléfono no es válido",
            "SIS0038" => "Error en java",
            "SIS0040" => "Error el comercio / terminal no tiene ningún método de pago asignado ",
            "SIS0041" => "Error en el cálculo de la HASH de datos del comercio.",
            "SIS0042" => "La firma enviada no es correcta",
            "SIS0043" => "Error al realizar la notificación on-line",
            "SIS0046" => "El bin de la tarjeta no está dado de alta",
            "SIS0051" => "Error número de pedido repetido",
            "SIS0054" => "Error no existe operación sobre la que realizar la devolución",
            "SIS0055" => "Error existe más de un pago con el mismo número de pedido",
            "SIS0056" => "La operación sobre la que se desea devolver no está autorizada",
            "SIS0057" => "El importe a devolver supera el permitido",
            "SIS0058" => "Inconsistencia de datos, en la validación de una confirmación",
            "SIS0059" => "Error no existe operación sobre la que realizar la confirmación",
            "SIS0060" => "Ya existe una confirmación asociada a la preautorización",
            "SIS0061" => "La preautorización sobre la que se desea confirmar no está autorizada ",
            "SIS0062" => "El importe a confirmar supera el permitido",
            "SIS0063" => "Error. Número de tarjeta no disponible",
            "SIS0064" => "Error. El número de tarjeta no puede tener más de 19 posiciones",
            "SIS0065" => "Error. El número de tarjeta no es numérico",
            "SIS0066" => "Error. Mes de caducidad no disponible",
            "SIS0067" => "Error. El mes de la caducidad no es numérico",
            "SIS0068" => "Error. El mes de la caducidad no es válido",
            "SIS0069" => "Error. Año de caducidad no disponible",
            "SIS0070" => "Error. El Año de la caducidad no es numérico",
            "SIS0071" => "Tarjeta caducada",
            "SIS0072" => "Operación no anulable",
            "SIS0074" => "Error falta Ds_Merchant_Order",
            "SIS0075" => "Error el Ds_Merchant_Order tiene menos de 4 posiciones o más de 12 ",
            "SIS0076" => "Error el Ds_Merchant_Order no tiene las cuatro primeras posiciones numéricas ",
            "SIS0077" => "Error el Ds_Merchant_Order no tiene las cuatro primeras posiciones numéricas. No se utiliza ",
            "SIS0078" => "Método de pago no disponible",
            "SIS0079" => "Error al realizar el pago con tarjeta",
            "SIS0081" => "La sesión es nueva, se han perdido los datos almacenados",
            "SIS0084" => "El valor de Ds_Merchant_Conciliation es nulo",
            "SIS0085" => "El valor de Ds_Merchant_Conciliation no es numérico",
            "SIS0086" => "El valor de Ds_Merchant_Conciliation no ocupa 6 posiciones",
            "SIS0089" => "El valor de Ds_Merchant_ExpiryDate no ocupa 4 posiciones",
            "SIS0092" => "El valor de Ds_Merchant_ExpiryDate es nulo",
            "SIS0093" => "Tarjeta no encontrada en la tabla de rangos",
            "SIS0094" => "La tarjeta no fue autenticada como 3D Secure",
            "SIS0097" => "Valor del campo Ds_Merchant_CComercio no válido",
            "SIS0098" => "Valor del campo Ds_Merchant_CVentana no válido",
            "SIS0112" => "Error El tipo de transacción especificado en Ds_Merchant_Transaction_Type no esta permitido ",
            "SIS0113" => "Excepción producida en el servlet de operaciones",
            "SIS0114" => "Error, se ha llamado con un GET en lugar de un POST",
            "SIS0115" => "Error no existe operación sobre la que realizar el pago de la cuota",
            "SIS0116" => "La operación sobre la que se desea pagar una cuota no es una operación válida ",
            "SIS0117" => "La operación sobre la que se desea pagar una cuota no está autorizada ",
            "SIS0118" => "Se ha excedido el importe total de las cuotas",
            "SIS0119" => "Valor del campo Ds_Merchant_DateFrecuency no válido",
            "SIS0120" => "Valor del campo Ds_Merchant_ChargeExpiryDate no válido",
            "SIS0121" => "Valor del campo Ds_Merchant_SumTotal no válido",
            "SIS0122" => "Valor del campo Ds_Merchant_DateFrecuency Ds_Merchant_SumTotal tiene formato incorrecto",
            "SIS0123" => "Se ha excedido la fecha tope para realizar transacciones",
            "SIS0124" => "No ha transcurrido la frecuencia mínima en un pago recurrente sucesivo",
            "SIS0132" => "La fecha de Confirmación de Autorización no puede superar en mas de 7 días a la de Preautorización.",
            "SIS0133" => "La fecha de Confirmación de Autenticación no puede superar en mas de 45 días a la de Autenticación Previa.",
            "SIS0139" => "Error el pago recurrente inicial está duplicado",
            "SIS0142" => "Tiempo excedido para el pago",
            "SIS0197" => "Error al obtener los datos de cesta de la compra en operación tipo pasarela",
            "SIS0198" => "Error el importe supera el límite permitido para el comercio",
            "SIS0199" => "Error el número de operaciones supera el límite permitido para el comercio ",
            "SIS0200" => "Error el importe acumulado supera el límite permitido para el comercio ",
            "SIS0214" => "El comercio no admite devoluciones",
            "SIS0216" => "Error Ds_Merchant_CVV2 tiene mas de 3 posiciones",
            "SIS0217" => "Error de formato en Ds_Merchant_CVV2",
            "SIS0218" => "El comercio no permite operaciones seguras por la entrada/operaciones ",
            "SIS0219" => "Error el número de operaciones de la tarjeta supera el límite",
            "SIS0220" => "Error el importe acumulado de la tarjeta supera el límite permitido para el comercio",
            "SIS0221" => "Error el CVV2 es obligatorio",
            "SIS0222" => "Ya existe una anulación asociada a la preautorización",
            "SIS0223" => "La preautorización que se desea anular no está autorizada",
            "SIS0224" => "El comercio no permite anulaciones por no tener firma ampliada",
            "SIS0225" => "Error no existe operación sobre la que realizar la anulación",
            "SIS0226" => "Inconsistencia de datos, en la validación de una anulación",
            "SIS0227" => "Valor del campo Ds_Merchant_TransactionDate no válido",
            "SIS0229" => "No existe el código de pago aplazado solicitado",
            "SIS0252" => "El comercio no permite el envío de tarjeta",
            "SIS0253" => "La tarjeta no cumple el check-digit",
            "SIS0254" => "El número de operaciones de la IP supera el límite permitido por el comercio ",
            "SIS0255" => "El importe acumulado por la IP supera el límite permitido por el comercio ",
            "SIS0256" => "El comercio no puede realizar preautorizaciones",
            "SIS0257" => "Esta tarjeta no permite operativa de preautorizaciones",
            "SIS0258" => "Inconsistencia de datos, en la validación de una confirmación",
            "SIS0261" => "Operación detenida por superar el control de restricciones en la entrada al SIS",
            "SIS0270" => "El comercio no puede realizar autorizaciones en diferido",
            "SIS0274" => "Tipo de operación desconocida o no permitida por esta entrada al SIS",
            "SIS0296" => "Error al validar los datos de la Operación de Tarjeta en Archivo Inicial",
            "SIS0298" => "El comercio no permite realizar operaciones de Tarjeta en Archivo",
            "SIS0319" => "El comercio no pertenece al grupo especificado en Ds_Merchant_Group",
            "SIS0321" => "La referencia indicada en Ds_Merchant_Identifier no está asociada al comercio",
            "SIS0322" => "Error de formato en Ds_Merchant_Group",
            "SIS0325" => "Se ha pedido no mostrar pantallas pero no se ha enviado ninguna referencia de tarjeta",
            "SIS0429" => "Error en la versión enviada por el comercio en el parámetro Ds_SignatureVersion",
            "SIS0432" => "Error FUC del comercio erróneo",
            "SIS0433" => "Error Terminal del comercio erróneo",
            "SIS0434" => "Error ausencia de número de pedido en la operación enviada por el comercio",
            "SIS0435" => "Error en el cálculo de la firma",
            "SIS0436" => "Error en la construcción del elemento padre <REQUEST>",
            "SIS0437" => "Error en la construcción del elemento <DS_SIGNATUREVERSION>",
            "SIS0438" => "Error en la construcción del elemento <DATOSENTRADA>",
            "SIS0439" => "Error en la construcción del elemento <DS_SIGNATURE>",
            "SIS0444" => "Error producido al acceder mediante un sistema de firma antiguo teniendo configurado el tipo de clave HMAC SHA256",
        );
        return isset($errorMessage[$errorId]) ? $errorMessage[$errorId] : $errorId;
    }

    public function getResponseDescription($value, $transaction)
    {
        $redsys = new Redsys();
        $description = $redsys->l('OK');
        if ((int)$value > 99) {
            $description = $redsys->getResponseDescriptionText($value);
        } elseif ($transaction['transaction_type'] == '1') {
            $description = $this->l('Preauthorization OK');
        } elseif ($transaction['transaction_type'] == '7') {
            $description = $this->l('Authentication OK');
        }
        $context = Context::getContext();
        $context->smarty->assign(array(
            'value' => str_pad($value, 4, '0', STR_PAD_LEFT),
            'description' => $description
        ));
        return $context->smarty->fetch(_PS_MODULE_DIR_.'redsys/views/templates/admin/response_description_tooltip.tpl');
    }

    public function getResponseDescriptionText($Ds_Response, $Ds_pay_method = '')
    {
        switch($Ds_Response) {
            case '101':
                return $this->l('Tarjeta caducada.');
            case '102':
                return $this->l('Tarjeta en excepcion transitoria o bajo sospecha de fraude.');
            case '104':
                return $this->l('Operacion no permitida para esa tarjeta o terminal.');
            case '106':
                return $this->l('Intentos de PIN excedidos.');
            case '116':
                return $this->l('Disponible insuficiente.');
            case '118':
                return $this->l('Tarjeta no registrada.');
            case '125':
                return $this->l('Tarjeta no efectiva.');
            case '129':
                return $this->l('Codigo de seguridad (CVV2/CVC2) incorrecto.');
            case '172':
                return $this->l('Tarjeta denegada, no repetir operación.');
            case '173':
                return $this->l('Tarjeta denegada, no repetir operación sin actualizar datos de la tarjeta.');
            case '174':
                return $this->l('Tarjeta denegada, no repetir antes de 72 horas.');
            case '180':
                return $this->l('Tarjeta ajena al servicio.');
            case '184':
                return $this->l('Error en la autenticacion del titular.');
            case '190':
                return $this->l('Denegacion sin especificar motivo.');
            case '191':
                return $this->l('Fecha de caducidad erronea.');
            case '201':
                return $this->l('Transacción denegada porque la fecha de caducidad de la tarjeta que se ha informado en el pago, es anterior a la actualmente vigente.');
            case '202':
                return $this->l('Tarjeta en excepcion transitoria o bajo sospecha de fraude con retirada de tarjeta.');
            case '204':
                return $this->l('Operación no permitida para ese tipo de tarjeta.');
            case '207':
                return $this->l('El banco emisor no permite una autorización automática. Es necesario contactar telefónicamente con su centro autorizador para obtener una aprobación manual.');
            case '208':
                return $this->l('Es erróneo el código CVV2/CVC2 informado por el comprador.');
            case '209':
                return $this->l('Tarjeta bloqueada por el banco emisor debido a que el titular le ha manifestado que le ha sido robada o perdida.');
            case '290':
                return $this->l('Transacción denegada por el banco emisor pero sin que este dé detalles acerca del motivo.');
            case '296':
                return $this->l('Error al validar los datos de la operación de tarjeta en archivo inicial.');
            case '298':
                return $this->l('El comercio no permite realizar operaciones de tarjeta en archivo.');
            case '321':
                return $this->l('La referencia indicada en DS_MERCHANT_IDENTIFIER no está asociada al comercio.');
            case '325':
                return $this->l('Se ha pedido no mostrar pantallas pero no se ha enviado ninguna referencia de tarjeta.');
            case '400':
                return $this->l('Transacción autorizada para anulaciones.');
            case '900':
                return $this->l('Transacción autorizada para devoluciones y confirmaciones.');
            case '904':
                return $this->l('Comercio no registrado en FUC.');
            case '909':
                return $this->l('Error de sistema.');
            case '913':
                return $this->l('Pedido repetido.');
            case '930':
                if ($Ds_pay_method == 'R') {
                    return $this->l('Realizado por Transferencia bancaria.');
                } else {
                    return $this->l('Realizado por Domiciliacion bancaria.');
                }
            case '944':
                return $this->l('Sesión Incorrecta.');
            case '950':
                return $this->l('Operación de devolución no permitida.');
            case '9064':
                return $this->l('Número de posiciones de la tarjeta incorrecto.');
            case '9078':
                return $this->l('No existe método de pago válido para esa tarjeta.');
            case '9093':
                return $this->l('Tarjeta no existente.');
            case '9094':
                return $this->l('Rechazo servidores internacionales.');
            case '9104':
                return $this->l('Comercio con "titular seguro" y titular sin clave de compra segura.');
            case '9218':
                return $this->l('El comercio no permite op. seguras por entrada /operaciones.');
            case '9253':
                return $this->l('Tarjeta no cumple el check-digit.');
            case '9256':
                return $this->l('El comercio no puede realizar preautorizaciones.');
            case '9257':
                return $this->l('Esta tarjeta no permite operativa de preautorizaciones.');
            case '9261':
            case '912':
            case '9912':
                return $this->l('Emisor no disponible.');
            case '9913':
                return $this->l('Error en la confirmación que el comercio envía al TPV Virtual (solo aplicable en la opción de sincronización SOAP).');
            case '9914':
                return $this->l('Confirmación "KO" del comercio (solo aplicable en la opción de sincronización SOAP).');
            case '9915':
                return $this->l('A petición del usuario se ha cancelado el pago.');
            case '9928':
                return $this->l('Anulación de autorización en diferido realizada por el SIS (proceso batch).');
            case '9929':
                return $this->l('Anulación de autorización en diferido realizada por el comercio.');
            case '9997':
                return $this->l('Se está procesando otra transacción en SIS con la misma tarjeta.');
            case '9998':
                return $this->l('Operación en proceso de solicitud de datos de tarjeta.');
            case '9999':
                return $this->l('Operación que ha sido redirigida al emisor a autenticar.');
            case '1000':
                return $this->l('Preautorización cancelada.');
            default:
                return $this->l('Transaccion denegada codigo: ') .$Ds_Response;
        }
    }

    public function getCustomerListIdentifiers($id_customer, $id_tpv = false, $active = true, $payment_tpl = false)
    {
        $sql = 'SELECT `id_operation`, `identifier`, `card_number`, `id_customer`, `expiry_date`
                FROM `'.pSQL(_DB_PREFIX_.$this->name).'_clicktopay` c
                WHERE id_customer = '.pSQL($id_customer);

        $result = Db::getInstance()->ExecuteS($sql);
        foreach ($result as $key => $card) {
            $expiry_date = $card['expiry_date'];
            $result[$key]['expiry_date'] = date('m/Y', strtotime(Tools::substr($expiry_date, 0, 2) . '-' . Tools::substr($expiry_date, 2, 4) . '-1'));
            if (Tools::substr($expiry_date, 0, 2) > date('y')) {
                $result[$key]['valid'] = '1';
            } elseif (Tools::substr($expiry_date, 0, 2) == date('y') && Tools::substr($expiry_date, 2, 4) >= date('m')) {
                $result[$key]['valid'] = '1';
            } else {
                $result[$key]['valid'] = '0';
            }
        }
        return $result;
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

    public function getExpiryDate($date)
    {
        return $this->formatExpiryDate($date);
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

    public function showPriceWithSymbol($value, $transaction)
    {
        $currency = array();
        if (!empty($transaction) && isset($transaction['id_cart'])) {
            $cart = new Cart($transaction['id_cart']);
            $currency = new Currency($cart->id_currency);
        }

        if (isset($currency->iso_code)) {
            try {
                if (version_compare(_PS_VERSION_, '1.7.6', '>=')) {
                    return $this->context->getCurrentLocale()->formatPrice($value, $currency->iso_code);
                } else {
                    return Tools::displayPrice($value, $currency);
                }
            } catch (Exception $e) {
                return $value;
            }
        }
        return $value;
    }

    public static function printGoToCustomerButton($id_customer)
    {
        $customer = new Customer($id_customer);
        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            return $id_customer.' - '.$customer->firstname.' '.$customer->lastname;
        }
        
        if ($customer->id) {
            $tpl = Context::getContext()->smarty->createTemplate('helpers/list/list_action_view.tpl');
            $_href = Context::getContext()->link->getAdminLink('AdminCustomers').'&viewcustomer&id_customer='.(int)$id_customer;
            if (version_compare(_PS_VERSION_, '1.7.6', '>=')) {
                $_href = Context::getContext()->link->getAdminLink('AdminCustomers', true, [], [
                    'viewcustomer' => 1,
                    'id_customer' => $id_customer,
                ]);
            }
            $tpl->assign(array(
                'href' => $_href,
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
        if (version_compare(_PS_VERSION_, '1.6', '<')) {
            return $id_order;
        }
        $tpl = Context::getContext()->smarty->createTemplate('helpers/list/list_action_view.tpl');
        $_href = Context::getContext()->link->getAdminLink('AdminOrders').'&id_order='.(int)$id_order.'&vieworder';
        if (version_compare(_PS_VERSION_, '1.7.7', '>=')) {
            $_href = Context::getContext()->link->getAdminLink('AdminOrders', true, [], [
                'vieworder' => 1,
                'id_order' => $id_order,
            ]);
        }
        $tpl->assign(array(
            'href' => $_href,
            'action' => $id_order,
            'id' => $id_order,
        ));
        return $tpl->fetch();
    }

    public function getCurrencyName($id_currency)
    {
        $redsys = new Redsys();
        $currency = new Currency($redsys->getIdByIsoCodeNum($id_currency, Context::getContext()->shop->id));
        return $currency->iso_code;
    }

    private function setFilters()
    {
        if (version_compare(_PS_VERSION_, '1.7.6.1', '>=')) {
            if (Tools::isSubmit('submitFiltertransaction') && (int)Tools::getValue('submitFiltertransaction') > 0) {
                $this->_filters = array(
                    'filter_id_cart' => (string)Tools::getValue('transactionFilter_id_cart'),
                    'filter_id_transaction' => (string)Tools::getValue('transactionFilter_id_transaction'),
                    'filter_id_tpv' => (string)Tools::getValue('transactionFilter_id_tpv'),
                    'filter_id_customer' => (string)Tools::getValue('transactionFilter_id_customer'),
                    'filter_id_order' => (string)Tools::getValue('transactionFilter_id_order'),
                    'filter_ds_order' => (string)Tools::getValue('transactionFilter_ds_order'),
                    'filter_id_currency' => (string)Tools::getValue('transactionFilter_id_currency'),
                    'filter_amount' => (string)Tools::getValue('transactionFilter_amount'),
                    'filter_amount_total' => (string)Tools::getValue('transactionFilter_amount_total'),
                    'filter_amount_refunded' => (string)Tools::getValue('transactionFilter_amount_refunded'),
                    'filter_ds_response' => (string)Tools::getValue('transactionFilter_ds_response'),
                    'filter_transaction_type' => (string)Tools::getValue('transactionFilter_transaction_type'),
                    'filter_transaction_date_from' => Tools::getValue('transactionFilter_transaction_date'),
                    'filter_transaction_date_to' => Tools::getValue('transactionFilter_transaction_date'),
                );
            }
        } else if (Tools::isSubmit('submitFilterredsys_transaction') && (int)Tools::getValue('submitFilterredsys_transaction') > 0) {
                $this->_filters = array(
                    'filter_id_cart' => (string)Tools::getValue($this->name . '_transactionFilter_id_cart'),
                    'filter_id_transaction' => (string)Tools::getValue($this->name . '_transactionFilter_id_transaction'),
                    'filter_id_tpv' => (string)Tools::getValue($this->name . '_transactionFilter_id_tpv'),
                    'filter_id_customer' => (string)Tools::getValue($this->name . '_transactionFilter_id_customer'),
                    'filter_id_order' => (string)Tools::getValue($this->name . '_transactionFilter_id_order'),
                    'filter_ds_order' => (string)Tools::getValue($this->name . '_transactionFilter_ds_order'),
                    'filter_id_currency' => (string)Tools::getValue($this->name . '_transactionFilter_id_currency'),
                    'filter_amount' => (string)Tools::getValue($this->name . '_transactionFilter_amount'),
                    'filter_amount_total' => (string)Tools::getValue($this->name . '_transactionFilter_amount_total'),
                    'filter_amount_refunded' => (string)Tools::getValue($this->name . '_transactionFilter_amount_refunded'),
                    'filter_ds_response' => (string)Tools::getValue($this->name . '_transactionFilter_ds_response'),
                    'filter_transaction_type' => (string)Tools::getValue($this->name . '_transactionFilter_transaction_type'),
                    'filter_transaction_date_from' => Tools::getValue($this->name . '_transactionFilter_transaction_date'),
                    'filter_transaction_date_to' => Tools::getValue($this->name . '_transactionFilter_transaction_date'),
                );
        }

        if (Tools::isSubmit('submitFilterredsys_refund') && (int)Tools::getValue('submitFilterredsys_refund') > 0) {
            $this->_filters = array(
                'filter_id_refund' => (string)Tools::getValue($this->name . '_refundFilter_id_refund'),
                'filter_id_tpv' => (string)Tools::getValue($this->name . '_refundFilter_id_tpv'),
                'filter_id_order' => (string)Tools::getValue($this->name . '_refundFilter_id_order'),
                'filter_amount_refunded' => (string)Tools::getValue($this->name . '_refundFilter_amount_refunded'),
                'filter_ds_response' => (string)Tools::getValue($this->name . '_refundFilter_ds_response'),
                'filter_ds_currency' => (string)Tools::getValue($this->name . '_refundFilter_ds_currency'),
                'filter_refund_date_from' => Tools::getValue($this->name . '_refundFilter_refund_date'),
                'filter_refund_date_to' => Tools::getValue($this->name . '_refundFilter_refund_date'),
            );
        }

        if (Tools::isSubmit('submitFilterredsys_clicktopay') && (int)Tools::getValue('submitFilterredsys_clicktopay') > 0) {
            $this->_filters = array(
                'filter_id_operation' => (string)Tools::getValue($this->name . '_clicktopayFilter_id_operation'),
                'filter_id_customer' => (string)Tools::getValue($this->name . '_clicktopayFilter_id_customer'),
                'filter_identifier' => (string)Tools::getValue($this->name . '_clicktopayFilter_identifier'),
                'filter_card_number' => (string)Tools::getValue($this->name . '_clicktopayFilter_card_number'),
                'filter_expiry_date' => (string)Tools::getValue($this->name . '_clicktopayFilter_expiry_date'),
            );
        }
    }

    protected function sendConfirmationEmail($id_order, $extra_vars, $tpv = false, $amount_paid = 0)
    {
        $order = new Order((int)$id_order);
        $customer = new Customer($order->id_customer);
        $cart = new Cart($order->id_cart);
        $currency = new Currency($order->id_currency);

        $invoice = new Address((int)$order->id_address_invoice);
        $delivery = new Address((int)$order->id_address_delivery);
        $delivery_state = $delivery->id_state ? new State((int)$delivery->id_state) : false;
        $invoice_state = $invoice->id_state ? new State((int)$invoice->id_state) : false;
        $carrier = new Carrier($order->id_carrier);
        $product_list = $order->getProducts();
        $carrierNameData = '';
        $virtual_product = true;
        $product_var_tpl_list = array();
        foreach ($product_list as $product) {
            if (!$product['is_virtual']) {
                $virtual_product &= false;
            }
            if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                $carrierNameData = ($virtual_product || !isset($carrier->name)) ? $this->trans('No carrier', array(), 'Admin.Payment.Notification') : $carrier->name;
            } else {
                $carrierNameData = ($virtual_product || !isset($carrier->name)) ? Tools::displayError('No carrier') : $carrier->name;
            }
            $price = Product::getPriceStatic((int) $product['id_product'], false, ($product['product_attribute_id'] ? (int) $product['product_attribute_id'] : null), 6, null, false, true, $product['product_quantity'], false, (int) $order->id_customer, (int) $order->id_cart, (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')}, $specific_price, true, true, null, true, $product['id_customization']);
            $price_wt = Product::getPriceStatic((int) $product['id_product'], true, ($product['product_attribute_id'] ? (int) $product['product_attribute_id'] : null), 2, null, false, true, $product['product_quantity'], false, (int) $order->id_customer, (int) $order->id_cart, (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')}, $specific_price, true, true, null, true, $product['id_customization']);

            $product_price = Product::getTaxCalculationMethod() == PS_TAX_EXC ? Tools::ps_round($price, 2) : $price_wt;

            $product_var_tpl = array(
                'id_product' => $product['product_id'],
                'reference' => $product['reference'],
                'name' => $product['product_name'],
                'price' => Tools::displayPrice($product_price * $product['product_quantity'], $currency, false),
                'quantity' => $product['product_quantity'],
                'customization' => array(),
            );

            if (isset($product['price']) && $product['price']) {
                $product_var_tpl['unit_price'] = Tools::displayPrice($product_price, $currency, false);
                $product_var_tpl['unit_price_full'] = Tools::displayPrice($product_price, $currency, false)
                    . ' ' . $product['unity'];
            } else {
                $product_var_tpl['unit_price'] = $product_var_tpl['unit_price_full'] = '';
            }

            $customized_datas = Product::getAllCustomizedDatas((int) $order->id_cart, null, true, null, (int) $product['id_customization']);
            if (isset($customized_datas[$product['id_product']][$product['product_attribute_id']])) {
                $product_var_tpl['customization'] = array();
                foreach ($customized_datas[$product['id_product']][$product['product_attribute_id']][$order->id_address_delivery] as $customization) {
                    $customization_text = '';
                    if (isset($customization['datas'][Product::CUSTOMIZE_TEXTFIELD])) {
                        foreach ($customization['datas'][Product::CUSTOMIZE_TEXTFIELD] as $text) {
                            $customization_text .= '<strong>' . $text['name'] . '</strong>: ' . $text['value'] . '<br />';
                        }
                    }

                    if (isset($customization['datas'][Product::CUSTOMIZE_FILE])) {
                        $customization_text .= $this->l('%d image(s)') . '<br />';
                    }

                    $customization_quantity = (int) $customization['quantity'];

                    $product_var_tpl['customization'][] = array(
                        'customization_text' => $customization_text,
                        'customization_quantity' => $customization_quantity,
                        'quantity' => Tools::displayPrice($customization_quantity * $product_price, $currency, false),
                    );
                }
            }

            $product_var_tpl_list[] = $product_var_tpl;
            // Check if is not a virutal product for the displaying of shipping
            if (!$product['is_virtual']) {
                $virtual_product &= false;
            }
        } // end foreach ($products)

        $product_list_txt = '';
        $product_list_html = '';
        if (count($product_var_tpl_list) > 0) {
            $product_list_txt = $this->getEmailTemplateContentRedsys('order_conf_product_list.txt', Mail::TYPE_TEXT, $product_var_tpl_list);
            $product_list_html = $this->getEmailTemplateContentRedsys('order_conf_product_list.tpl', Mail::TYPE_HTML, $product_var_tpl_list);
        }

        $cart_rules_order = $order->getCartRules();
        $cart_rules_list = array();
        foreach ($cart_rules_order as $cart_rule) {
            $cart_rules_list[] = array(
                'voucher_name' => $cart_rule['obj']->name,
                'voucher_reduction' => ($values['tax_incl'] != 0.00 ? '-' : '').Tools::displayPrice($values['tax_incl'], $currency, false)
            );
        }

        $cart_rules_list_txt = '';
        $cart_rules_list_html = '';
        if (isset($cart_rules_list) && count($cart_rules_list) > 0) {
            $cart_rules_list_txt = $this->getEmailTemplateContentRedsys('order_conf_cart_rules.txt', Mail::TYPE_TEXT, $cart_rules_list);
            $cart_rules_list_html = $this->getEmailTemplateContentRedsys('order_conf_cart_rules.tpl', Mail::TYPE_HTML, $cart_rules_list);
        }

        $data = array(
            '{firstname}' => $customer->firstname,
            '{lastname}' => $customer->lastname,
            '{email}' => $customer->email,
            '{delivery_block_txt}' => $this->_getFormatedAddress($delivery, "\n"),
            '{invoice_block_txt}' => $this->_getFormatedAddress($invoice, "\n"),
            '{delivery_block_html}' => $this->_getFormatedAddress($delivery, '<br />', array(
                'firstname'    => '<span style="font-weight:bold;">%s</span>',
                'lastname'    => '<span style="font-weight:bold;">%s</span>'
            )),
            '{invoice_block_html}' => $this->_getFormatedAddress($invoice, '<br />', array(
                    'firstname'    => '<span style="font-weight:bold;">%s</span>',
                    'lastname'    => '<span style="font-weight:bold;">%s</span>'
            )),
            '{delivery_company}' => $delivery->company,
            '{delivery_firstname}' => $delivery->firstname,
            '{delivery_lastname}' => $delivery->lastname,
            '{delivery_address1}' => $delivery->address1,
            '{delivery_address2}' => $delivery->address2,
            '{delivery_city}' => $delivery->city,
            '{delivery_postal_code}' => $delivery->postcode,
            '{delivery_country}' => $delivery->country,
            '{delivery_state}' => $delivery->id_state ? $delivery_state->name : '',
            '{delivery_phone}' => ($delivery->phone) ? $delivery->phone : $delivery->phone_mobile,
            '{delivery_other}' => $delivery->other,
            '{invoice_company}' => $invoice->company,
            '{invoice_vat_number}' => $invoice->vat_number,
            '{invoice_firstname}' => $invoice->firstname,
            '{invoice_lastname}' => $invoice->lastname,
            '{invoice_address2}' => $invoice->address2,
            '{invoice_address1}' => $invoice->address1,
            '{invoice_city}' => $invoice->city,
            '{invoice_postal_code}' => $invoice->postcode,
            '{invoice_country}' => $invoice->country,
            '{invoice_state}' => $invoice->id_state ? $invoice_state->name : '',
            '{invoice_phone}' => ($invoice->phone) ? $invoice->phone : $invoice->phone_mobile,
            '{invoice_other}' => $invoice->other,
            '{order_name}' => $order->getUniqReference(),
            '{date}' => Tools::displayDate(date('Y-m-d H:i:s'), null, 1),
            '{carrier}' => $carrierNameData,
            '{payment}' => Tools::substr($order->payment, 0, 255),
            '{products}' => $product_list_html,
            '{products_txt}' => $product_list_txt,
            '{discounts}' => $cart_rules_list_html,
            '{discounts_txt}' => $cart_rules_list_txt,
            '{total_paid}' => Tools::displayPrice($order->total_paid, $currency, false),
            '{total_products}' => Tools::displayPrice(Product::getTaxCalculationMethod() == PS_TAX_EXC ? $order->total_products : $order->total_products_wt, $currency, false),
            '{total_discounts}' => Tools::displayPrice($order->total_discounts, $currency, false),
            '{total_shipping}' => Tools::displayPrice($order->total_shipping, $currency, false),
            '{total_wrapping}' => Tools::displayPrice($order->total_wrapping, $currency, false),
            '{total_tax_paid}' => Tools::displayPrice(($order->total_products_wt - $order->total_products) + ($order->total_shipping_tax_incl - $order->total_shipping_tax_excl), $currency, false));

            if ($tpv->advanced_payment && $tpv->advanced_percentage > 0) {
                $data['{advanced_payment}'] = Tools::displayPrice($amount_paid, $currency, false);
            }

        if (is_array($extra_vars)) {
            $data = array_merge($data, $extra_vars);
        }
        $order_status = new OrderState((int)_PS_OS_PAYMENT_, (int) $this->context->language->id);
        // Join PDF invoice
        if ((int)Configuration::get('PS_INVOICE') && $order_status->invoice && $order->invoice_number) {
            $order_invoice_list = $order->getInvoicesCollection();
            Hook::exec('actionPDFInvoiceRender', array('order_invoice_list' => $order_invoice_list));
            $pdf = new PDF($order_invoice_list, PDF::TEMPLATE_INVOICE, $this->context->smarty);
            $file_attachement['content'] = $pdf->render(false);
            $file_attachement['name'] = Configuration::get('PS_INVOICE_PREFIX', (int)$order->id_lang, null, $order->id_shop).sprintf('%06d', $order->invoice_number).'.pdf';
            $file_attachement['mime'] = 'application/pdf';
        } else {
            $file_attachement = null;
        }

        $orderLanguage = new Language((int) $order->id_lang);
        if (Validate::isEmail($customer->email)) {
            $pathMail = _PS_MAIL_DIR_;
            $templateMailName = 'order_conf';
            if ($tpv->advanced_payment && $tpv->advanced_percentage > 0) {
                $pathMail = dirname(__FILE__) . '/mails/';
                $templateMailName = 'order_conf_'.Tools::substr(str_replace('.', '', _PS_VERSION_), 0, 2);
            }

            if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                $retMail = Mail::Send(
                    (int)$order->id_lang,
                    $templateMailName,
                    Context::getContext()->getTranslator()->trans(
                        'Order confirmation',
                        array(),
                        'Emails.Subject',
                        $orderLanguage->locale
                    ),
                    $data,
                    $customer->email,
                    $customer->firstname.' '.$customer->lastname,
                    null,
                    null,
                    $file_attachement,
                    null, $pathMail, false, (int)$order->id_shop
                );
                if ($retMail) {
                    /* update mail sent status in redsys_transaction table */
                    $this->updateMailSentStatus($order->id);
                }
            } else {
                $retMail = Mail::Send(
                    (int)$order->id_lang,
                    $templateMailName,
                    Mail::l('Order confirmation', (int)$order->id_lang),
                    $data,
                    $customer->email,
                    $customer->firstname.' '.$customer->lastname,
                    null,
                    null,
                    $file_attachement,
                    null, $pathMail, false, (int)$order->id_shop
                );
                if ($retMail) {
                    /* update mail sent status in redsys_transaction table */
                    $this->updateMailSentStatus($order->id);
                }

            }

        }
    }

    protected function getEmailTemplateContentRedsys($template_name, $mail_type, $var)
    {
        $email_configuration = Configuration::get('PS_MAIL_TYPE');

        if ($email_configuration != $mail_type && $email_configuration != Mail::TYPE_BOTH) {
            return '';
        }

        $theme_template_path = _PS_THEME_DIR_.'mails'.DIRECTORY_SEPARATOR.'es'.DIRECTORY_SEPARATOR.$template_name;
        $default_mail_template_path = _PS_MAIL_DIR_.'en'.DIRECTORY_SEPARATOR.$template_name;

        if (Tools::file_exists_cache($theme_template_path)) {
            $default_mail_template_path = $theme_template_path;
        }
        if (Tools::file_exists_cache($default_mail_template_path)) {
            $this->context->smarty->assign('list', $var);
            return $this->context->smarty->fetch($default_mail_template_path);
        }

        return '';
    }

    protected function _getFormatedAddress(Address $the_address, $line_sep, $fields_style = array())
    {
        return AddressFormat::generateAddress($the_address, array('avoid' => array()), $line_sep, ' ', $fields_style);
    }

    public static function getIsoCodeNumByIsoCode($isoCode)
    {
        if (isset(self::$isoCodeNums[$isoCode])) {
            return self::$isoCodeNums[$isoCode];
        }
        return 0;
    }

    public static function getIsoCodeByIsoCodeNum($isoCodeNum)
    {
        if (isset(self::$isoCodeNums)) {
            if ($isoCode = array_search($isoCodeNum, self::$isoCodeNums)) {
                return $isoCode;
            }
        }
        return 0;
    }

    public static function formatPrice($price, $currency = null, $no_utf8 = false, $context = null)
    {
        $context = $context ?: Context::getContext();
        $currency = $currency ?: $context->currency;
        if (is_int($currency)) {
            $currency = Currency::getCurrencyInstance($currency);
        }
        if (version_compare(_PS_VERSION_, '1.7.7', '>=')) {
            return Tools::getContextLocale($context)->formatPrice($price, $currency->iso_code);
        } else {
            return Tools::displayPrice($price, $currency, $no_utf8, $context);
        }
    }

    public static function getTransactionDetailsHtml($transaction, $feediscount = 0)
    {
        $context = Context::getContext();
        $context->smarty->assign(array(
            'redsys_transaction_id' => $transaction['id_transaction'],
            'redsys_datetime' => $transaction['transaction_date'],
            'redsys_feediscount' => $feediscount,
            'redsys_contact_url' => $context->link->getPageLink('contact', true, $context->language->id, array('id_order' => $transaction['id_order']))
        ));
        return $context->smarty->fetch(_PS_MODULE_DIR_.'redsys/views/templates/hook/transaction_details.tpl');
    }
}
