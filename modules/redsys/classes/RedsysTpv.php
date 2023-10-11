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

class RedsysTpv extends ObjectModel
{
    public $id;
    public $id_shop;
    public $environment_real;
    public $name;
    public $number;
    public $encryption_key;
    public $terminal;
    public $currency;
    public $payment_type;
    public $clicktopay;
    public $iupay;
    public $transaction_type;
    public $payment_size;
    public $integration;
    public $payment_text;
    public $min_amount;
    public $max_amount;
    public $carriers;
    public $groups;
    public $countries;
    public $zones;
    public $suppliers;
    public $categories;
    public $manufacturers;
    public $languages;
    public $currencies;
    public $filter_store;
    public $payment_error;
    public $create_order;
    public $enable_translation;
    public $ssl = true;
    public $active = true;
    public $date_add;
    public $date_upd;
    public $advanced_payment;
    public $advanced_percentage;
    public $advanced_payment_text;
    public $advanced_payment_state;
    public $fee_discount;
    public $mode;
    public $type;
    public $order_total;
    public $fix;
    public $percentage;
    public $minimum_amount;
    public $maximum_amount;
    public $min_order_amount;
    public $max_order_amount;
    public $advanced_summary;
    public $position;
    public $strict_filters;
    public $products;
    public $customers;
    public $products_excluded;
    public $customers_excluded;
    public $security_options;
    public $excep_sca;
    public $id_tax_rule;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'redsys_tpv',
        'primary' => 'id_redsys_tpv',
        'multilang' => true,
        'fields' => array(
            'name' =>                       array('type' => self::TYPE_STRING, 'required' => true),
            'number' =>                     array('type' => self::TYPE_STRING, 'required' => true, 'size' => 256),
            'encryption_key' =>             array('type' => self::TYPE_STRING, 'required' => true, 'size' => 32),
            'terminal' =>                   array('type' => self::TYPE_STRING, 'copy_post' => false),
            'environment_real' =>           array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'copy_post' => false),
            'currency' =>                   array('type' => self::TYPE_STRING, 'required' => true, 'size' => 32),
            'transaction_type' =>           array('type' => self::TYPE_INT, 'required' => true),
            'clicktopay' =>                 array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'copy_post' => false),
            'iupay' =>                      array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'copy_post' => false),
            'payment_type' =>               array('type' => self::TYPE_STRING),
            'payment_size' =>               array('type' => self::TYPE_STRING),
            'payment_text' =>               array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isAnything', 'size' => 256),
            'integration' =>                array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'copy_post' => false),
            'min_amount' =>                 array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
            'max_amount' =>                 array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
            'carriers' =>                   array('type' => self::TYPE_STRING),
            'groups' =>                     array('type' => self::TYPE_STRING),
            'countries' =>                  array('type' => self::TYPE_STRING),
            'zones' =>                      array('type' => self::TYPE_STRING),
            'suppliers' =>                  array('type' => self::TYPE_STRING),
            'categories' =>                 array('type' => self::TYPE_STRING),
            'manufacturers' =>              array('type' => self::TYPE_STRING),
            'languages' =>                  array('type' => self::TYPE_STRING),
            'currencies' =>                 array('type' => self::TYPE_STRING),
            'filter_store' =>               array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'copy_post' => false),
            'ssl' =>                        array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'copy_post' => false),
            'payment_error' =>              array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'copy_post' => false),
            'create_order' =>               array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'copy_post' => false),
            'enable_translation' =>         array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'copy_post' => false),
            'active' =>                     array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'copy_post' => false),
            'id_shop' =>                    array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'copy_post' => false),
            'date_add' =>                   array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false),
            'date_upd' =>                   array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false),
            'advanced_payment' =>           array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'copy_post' => false),
            'advanced_percentage' =>        array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice'),
            'advanced_payment_text' =>      array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isAnything', 'size' => 256),
            'advanced_payment_state' =>     array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'copy_post' => false),
            'position' =>                   array('type' => self::TYPE_INT),
            'fee_discount' =>               array('type' => self::TYPE_INT),
            'mode' =>                       array('type' => self::TYPE_INT),
            'type' =>                       array('type' => self::TYPE_INT),
            'order_total' =>                array('type' => self::TYPE_INT),
            'fix' =>                        array('type' => self::TYPE_FLOAT),
            'percentage' =>                 array('type' => self::TYPE_FLOAT),
            'minimum_amount' =>             array('type' => self::TYPE_FLOAT),
            'maximum_amount' =>             array('type' => self::TYPE_FLOAT),
            'min_order_amount' =>           array('type' => self::TYPE_FLOAT),
            'max_order_amount' =>           array('type' => self::TYPE_FLOAT),
            'advanced_summary' =>           array('type' => self::TYPE_INT),
            'strict_filters' =>             array('type' => self::TYPE_INT),
            'products' =>                   array('type' => self::TYPE_STRING),
            'customers' =>                  array('type' => self::TYPE_STRING),
            'security_options' =>           array('type' => self::TYPE_INT),
			'excep_sca' =>           		array('type' => self::TYPE_INT),
            'id_tax_rule' =>                array('type' => self::TYPE_INT),
        ),
    );

    public function __construct($id = null, $id_lang = null)
    {
        parent::__construct($id, $id_lang);
        $this->image_dir = _PS_IMG_DIR_.'redsys';
    }

    public function add($autodate = true, $null_values = true)
    {
        $this->id_shop = ($this->id_shop) ? $this->id_shop : Context::getContext()->shop->id;

        $success = parent::add($autodate, $null_values);
        return $success;
    }

    public function toggleStatus()
    {
        parent::toggleStatus();

        return Db::getInstance()->execute('
        UPDATE `'._DB_PREFIX_.bqSQL($this->def['table']).'`
        SET `date_upd` = NOW()
        WHERE `'.bqSQL($this->def['primary']).'` = '.(int)$this->id);
    }

    public function delete()
    {
        if (parent::delete()) {
            return $this->deleteImage();
        }
    }

    public function changeIupayOption()
    {
        $query = 'SELECT tpv.* FROM `'._DB_PREFIX_.'redsys_tpv` tpv WHERE iupay = 1';

        $tpvs = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);

        foreach ($tpvs as $tpv) {
            $t = new RedsysTpv($tpv['id_redsys_tpv']);
            $t->iupay = 0;
            $t->update();
            $t->payment_type = 'O';
            // todo LIMPIAR PAYMENT TEXT foreach languages
            // $tpv->payment_text[$id_lang] = '';
            $t->add();
        }
    }

    public static function getTpvs($id_shop = 0, $id_lang = false, $carrier = false, $country = false, $zone = false, $suppliers = false, $manufacturers = false, $products = false, $id_currency = 1)
    {
        $id_shop = Context::getContext()->shop->id;

        if (!$id_lang) {
            $id_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        }

        $array_tpvs_result = array();

        $query = 'SELECT tpv.*, tpvlang.`payment_text`
            FROM `'._DB_PREFIX_.'redsys_tpv` tpv
            '.Shop::addSqlAssociation('redsys_tpv', 'tpv').'
            LEFT JOIN `'._DB_PREFIX_.'redsys_tpv_lang` tpvlang ON (tpv.`id_redsys_tpv` = tpvlang.`id_redsys_tpv` AND tpvlang.`id_lang` = '.(int)$id_lang.')
            WHERE tpv.`active` = 1 ';
        $query .= $id_shop ? 'AND tpv.`id_shop` = '.(int)$id_shop : '';

        $query .= ' ORDER BY position';

        $tpvs = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
        if ($tpvs === false) {
            return false;
        }

        $id_customer = Context::getContext()->customer->id;
        $customer = new Customer($id_customer);
        $customer_groups = $customer->getGroupsStatic($id_customer);

        foreach ($tpvs as $tpv) {
            if ($tpv['groups'] == 'all') {
                $tpv['groups'] = '';
            }
            if ($tpv['currencies'] == 'all') {
                $tpv['currencies'] = '';
            }
            if ($tpv['languages'] == 'all') {
                $tpv['languages'] = '';
            }
            if ($tpv['carriers'] == 'all') {
                $tpv['carriers'] = '';
            }
            if ($tpv['countries'] == 'all') {
                $tpv['countries'] = '';
            }
            if ($tpv['zones'] == 'all') {
                $tpv['zones'] = '';
            }
            if ($tpv['suppliers'] == 'all') {
                $tpv['suppliers'] = '';
            }
            if ($tpv['categories'] == 'all') {
                $tpv['categories'] = '';
            }
            if ($tpv['manufacturers'] == 'all') {
                $tpv['manufacturers'] = '';
            }

            if ($id_shop == 0 || ($tpv['groups'] == '' && $tpv['customers'] == '' && $tpv['products'] == '' && $tpv['carriers'] == '' && $tpv['countries'] == '' && $tpv['zones'] == '' && $tpv['suppliers'] == '' && $tpv['currencies'] == '' && $tpv['languages'] == '' && $tpv['categories'] == '' && $tpv['manufacturers'] == '')) {
                $array_tpvs_result[] = $tpv;
                continue;
            }

            $filter_groups = true;
            $filter_customers = true;
            if ($tpv['groups'] !== '' && $tpv['customers'] == '') {
                $groups_array = explode(';', $tpv['groups']);
                foreach ($customer_groups as $group) {
                    if (!in_array($group, $groups_array)) {
                        $filter_groups = false;
                    } else {
                        $filter_groups = true;
                        break;
                    }
                }
                if (!$filter_groups) {
                    $filter_customers = false;
                }
            } else if ($tpv['groups'] == '' && $tpv['customers'] != '') {
                $customers_array = explode(';', $tpv['customers']);
                if (!in_array($id_customer, $customers_array)) {
                    $filter_customers = false;
                }
            } else if ($tpv['groups'] !== '' && $tpv['customers'] != '') {
                $groups_array = explode(';', $tpv['groups']);
                foreach ($customer_groups as $group) {
                    if (!in_array($group, $groups_array)) {
                        $filter_groups = false;
                    } else {
                        $filter_groups = true;
                    }
                }
                if (!$filter_groups) {
                    $customers_array = explode(';', $tpv['customers']);
                    if (!in_array($id_customer, $customers_array)) {
                        $filter_customers = false;
                    } else {
                        $filter_customers = true;
                    }
                } else {
                    $customers_array = explode(';', $tpv['customers']);
                    if (!in_array($id_customer, $customers_array)) {
                        $filter_customers = false;
                    }
                }
            }

            $filter_currencies = true;
            if ($tpv['currencies'] !== '') {
                $currencies_array = explode(';', $tpv['currencies']);
                if (!in_array($id_currency, $currencies_array)) {
                    $filter_currencies = false;
                    continue;
                }
            }

            $filter_languages = true;
            if ($tpv['languages'] !== '') {
                $languages_array = explode(';', $tpv['languages']);
                if (!in_array($id_lang, $languages_array)) {
                    $filter_languages = false;
                    continue;
                }
            }

            $filter_carriers = true;
            if ($tpv['carriers'] !== '') {
                $carriers_array = explode(';', $tpv['carriers']);
                if (!in_array($carrier, $carriers_array)) {
                    $filter_carriers = false;
                    continue;
                }
            }
            $filter_countries = true;
            if ($tpv['countries'] !== '') {
                $countries_array = explode(';', $tpv['countries']);
                if (!in_array($country->id, $countries_array)) {
                    $filter_countries = false;
                    continue;
                }
            }
            $filter_zones = true;
            if ($tpv['zones'] !== '') {
                $zones_array = explode(';', $tpv['zones']);
                if (!in_array($zone, $zones_array)) {
                    $filter_zones = false;
                    continue;
                }
            }

            $filter_categories = true;
            $filter_products = true;
            if ($tpv['categories'] !== '' && $tpv['products'] == '') {
                if (@unserialize($tpv['categories']) !== false) {
                    $categories_array = unserialize($tpv['categories']);
                } else {
                    $categories_array = explode(';', $tpv['categories']);
                }

                if (!$tpv['strict_filters']) {
                    $filter_categories = false;
                    foreach ($products as $product) {
                        $categories = Product::getProductCategories($product['id_product']);
                        foreach ($categories as $category) {
                            if (in_array($category, $categories_array)) {
                                $filter_categories = true;
                                break;
                            }
                        }
                        if ($filter_categories) {
                            break;
                        }
                    }
                    if (!$filter_categories) {
                        continue;
                    }
                } else {
                    $filter_categories = true;
                    foreach ($products as $product) {
                        $categories = Product::getProductCategories($product['id_product']);
                        $result = array_intersect($categories, $categories_array);
                        if (count($result) == 0) {
                            $filter_categories = false;
                        }
                    }
                    if (!$filter_categories) {
                        continue;
                    }
                }
            } else if ($tpv['categories'] == '' && $tpv['products'] != '') {
                $products_array = explode(';', $tpv['products']);
                foreach ($products as $product) {
                    if (!in_array($product['id_product'], $products_array)) {
                        $filter_products = false;
                        $filter_categories = true;
                        break;
                    }
                }
            } else if ($tpv['categories'] !== '' && $tpv['products'] != '') {
                foreach ($categories as $category) {
                    if (!in_array($category, $categories_array)) {
                        $filter_categories = false;
                    } else {
                        $filter_categories = true;
                        break;
                    }
                }
                if ($filter_categories) {
                    foreach ($products as $product) {
	                    if (!in_array($product['id_product'], $products_array)) {
							$filter_products = false;
	                        break;
	                    }
                	}
				}
            }

            $filter_manufacturers = true;
            if ($tpv['manufacturers'] !== '') {
                $filter_manufacturers = false;
                $manufacturers_array = explode(';', $tpv['manufacturers']);
                foreach ($manufacturers as $manufacturer) {
                    if (in_array($manufacturer, $manufacturers_array)) {
                        $filter_manufacturers = true;
                        break;
                    }
                }
                if (!$filter_manufacturers) {
                    continue;
                }
            }

            $filter_suppliers = true;
            if ($tpv['suppliers'] !== '') {
                $filter_suppliers = false;
                $suppliers_array = explode(';', $tpv['suppliers']);
                foreach ($suppliers as $supplier) {
                    if (in_array($supplier, $suppliers_array)) {
                        $filter_suppliers = true;
                        break;
                    }
                }
                if (!$filter_suppliers) {
                    continue;
                }
            }

            if ($filter_products && $filter_customers && $filter_groups && $filter_carriers && $filter_countries && $filter_zones && $filter_suppliers && $filter_currencies && $filter_languages && $filter_categories && $filter_manufacturers) {
                $array_tpvs_result[] = $tpv;
            }
        }

        if (count($array_tpvs_result) > 0) {
            return $array_tpvs_result;
        } else {
            return false;
        }
    }

    public function updatePosition($way, $position)
    {
        if (!$res = Db::getInstance()->executeS(
            'SELECT `id_redsys_tpv`, `position`
            FROM `'._DB_PREFIX_.'redsys_tpv`
            ORDER BY `position` ASC'
        )) {
            return false;
        }

        foreach ($res as $tpv) {
            if ((int)$tpv['id_redsys_tpv'] == (int)$this->id) {
                $moved_tpv = $tpv;
            }
        }

        if (!isset($moved_tpv) || !isset($moved_tpv)) {
            return false;
        }

        return (Db::getInstance()->execute('
            UPDATE `'._DB_PREFIX_.'redsys_tpv`
            SET `position`= `position` '.($way ? '- 1' : '+ 1').'
            WHERE `position`
            '.($way
                ? '> '.(int)$moved_tpv['position'].' AND `position` <= '.(int)$position
                : '< '.(int)$moved_tpv['position'].' AND `position` >= '.(int)$position))
        && Db::getInstance()->execute('
            UPDATE `'._DB_PREFIX_.'redsys_tpv`
            SET `position` = '.(int)$position.'
            WHERE `id_redsys_tpv` = '.(int)$moved_tpv['id_redsys_tpv']));
    }

    public static function getHigherPosition()
    {
        $sql = 'SELECT MAX(`position`)
                FROM `'._DB_PREFIX_.'redsys_tpv`';

        $position = DB::getInstance()->getValue($sql);
        return (is_numeric($position)) ? $position : -1;
    }

    public function maskCardNumber($cardNumber)
    {
        if (Tools::strlen($cardNumber)<= 4) {
            return $cardNumber;
        }
        return str_pad(Tools::substr($cardNumber, -4, 4), Tools::strlen($cardNumber), "*", STR_PAD_LEFT);
    }

    protected function sanitizeString($string)
    {
        $string = str_replace("'", "\\'", $string);
        $patterns = array ('/ +/','/[<>]/');
        $replace = array (' ', '_');
        return preg_replace($patterns, $replace, trim($string));
    }

    public function generate3DS2()
    {
        $customer = Context::getContext()->customer;
        $cart = Context::getContext()->cart;
        $shippingInfo = $cart->id_address_delivery ? new Address($cart->id_address_delivery) : null;
        $billingInfo = new Address($cart->id_address_invoice);
        $isLoggedIn = !boolval($customer->is_guest);

        if (!$isLoggedIn) {
            $chAccAgeInd = "01";
        }
        else {
            $accountCreated = intval( (strtotime("now") - strtotime($customer->date_add)) / 60);
            $nDays  = intval($accountCreated/1440);

            $dt = new DateTime($customer->date_upd);
            $chAccDate = $dt->format('Ymd');

            if ($accountCreated < 20) {
                $chAccAgeInd        = "02";
            } elseif ($nDays < 30) {
                $chAccAgeInd        = "03";
            } elseif ($nDays >= 30 && $nDays <= 60) {
                $chAccAgeInd        = "04";
            } else {
                $chAccAgeInd = "05";
            }
        }

        if ($isLoggedIn) {
            $dt = new DateTime($customer->date_upd);
            $chAccChange = $dt->format('Ymd');
            $accountModified = intval( (strtotime("now") - strtotime($customer->date_upd)) / 60);
            $nDays = intval($accountModified/1440);
            if ($accountModified < 20) {
                $chAccChangeInd = "01";
            } elseif ($nDays < 30) {
                $chAccChangeInd = "02";
            } elseif ($nDays >= 30 && $nDays <= 60) {
                $chAccChangeInd = "03";
            } else {
                $chAccChangeInd = "04";
            }
        }

        if ($isLoggedIn) {
            $customerId = $customer->id;
            $fechaBase = strtotime("-6 month");
            $dt = new DateTime("@$fechaBase");
            $query = Db::getInstance()->executeS('SELECT COUNT(*) x FROM `'._DB_PREFIX_.'orders` o LEFT JOIN `'._DB_PREFIX_.'order_detail` od ON o.id_order = od.id_order WHERE o.valid = 1 AND o.`id_customer` = '.intval($customerId).' AND o.`date_add` > "'.$dt->format('Y-m-d H:i:s').'";');
            $nbPurchaseAccount = $query[0]['x'];
        }

        if ($isLoggedIn) {
            $customerId = $customer->id;
            $fechaBase = strtotime("-1 day");
            $dt = new DateTime("@$fechaBase");
            $query = Db::getInstance()->executeS('SELECT COUNT(*) x FROM `'._DB_PREFIX_.'orders` o LEFT JOIN `'._DB_PREFIX_.'order_detail` od ON o.id_order = od.id_order WHERE o.valid = 1 AND o.`id_customer` = '.intval($customerId).' AND o.`date_add` > "'.$dt->format('Y-m-d H:i:s').'";');
            $txnActivityDay = $query[0]['x'];
        }

        if ($isLoggedIn) {
            $customerId = $customer->id;
            $fechaBase = strtotime("-1 year");
            $dt = new DateTime("@$fechaBase");
            $query = Db::getInstance()->executeS('SELECT COUNT(*) x FROM `'._DB_PREFIX_.'orders` o LEFT JOIN `'._DB_PREFIX_.'order_detail` od ON o.id_order = od.id_order WHERE o.valid = 1 AND o.`id_customer` = '.intval($customerId).' AND o.`date_add` > "'.$dt->format('Y-m-d H:i:s').'";');
            $txnActivityYear = $query[0]['x'];
        }

        if ($shippingInfo) {
            $shippingAddress1 = $this->sanitizeString($shippingInfo->address1);
            $shippingAddress2 = $this->sanitizeString($shippingInfo->address2);
            $shippingPostcode = $this->sanitizeString($shippingInfo->postcode);
            $shippingCity = $this->sanitizeString($shippingInfo->city);
            $shippingCountry = $this->sanitizeString($shippingInfo->id_country);
            $sql = "SELECT o.date_add FROM "._DB_PREFIX_."orders o, "._DB_PREFIX_."address a WHERE a.id_address = o.id_address_delivery AND o.valid = '1' AND a.address1 = '". $shippingAddress1 ."' AND a.address2 = '". $shippingAddress2 . "' AND a.postcode = '" . $shippingPostcode . "' AND a.city = '" . $shippingCity . "' AND a.id_country = '" . $shippingCountry . "' ORDER BY o.date_add;";

            $query = Db::getInstance()->executeS($sql);

            if (count($query) != 0) {
                $queryResult = $query[0]['date_add'];
                $dt = new DateTime($queryResult);
                $shipAddressUsage = $dt->format('Ymd');

                $duringTransaction = intval( (strtotime("now") - strtotime($queryResult))/60);
                $nDays = intval($duringTransaction/1440);
                if ($nDays < 30) {
                    $shipAddressUsageInd = "02";
                } elseif ($nDays >= 30 && $nDays <= 60) {
                    $shipAddressUsageInd = "03";
                } else {
                    $shipAddressUsageInd = "04";
                }
            } else {
                $fechaBase = strtotime("now");
                $dt = new DateTime("@$fechaBase");
                $shipAddressUsage = $dt->format('Ymd');
                $shipAddressUsageInd = "01";
            }
        }

        if ($shippingInfo) {
            if (($shippingInfo->address1 == $billingInfo->address1) && ($shippingInfo->address2 == $billingInfo->address2) && ($shippingInfo->city == $billingInfo->city) && ($shippingInfo->postcode == $billingInfo->postcode)
                && ($shippingInfo->country == $billingInfo->country)) {
                $addrMatch = "Y";
            } else {
                $addrMatch = "N";
            }
        } else {
            $addrMatch = "N";
        }

        $billAddrCity = $billingInfo->city;
        $billAddrLine1 = $billingInfo->address1;
        $billAddrLine2 = $billingInfo->address2;
        $billAddrPostCode = $billingInfo->postcode;
        $email = $customer->email;

        $homePhone = isset($billingInfo->phone) ? array("subscriber" => $billingInfo->phone) : null;
        $mobilePhone = isset($billingInfo->mobile_phone) ? array("subscriber" => $billingInfo->mobile_phone) : null;

        if ($shippingInfo) {
            $shipAddrCity = $shippingInfo->city;
            $shipAddrLine1 = $shippingInfo->address1;
            $shipAddrLine2 = $shippingInfo->address2;
            $shipAddrPostCode = $shippingInfo->postcode;
        }

        $acctInfo = array(
            'chAccAgeInd' => $chAccAgeInd
        );

        if ($shippingInfo) {
            $acctInfo['shipAddressUsage'] = $shipAddressUsage;
            $acctInfo['shipAddressUsageInd'] = $shipAddressUsageInd;
        }
        if ($isLoggedIn) {
            $acctInfo['chAccDate'] = $chAccDate;
            $acctInfo['chAccChange'] = $chAccChange;
            $acctInfo['chAccChangeInd'] = $chAccChangeInd;
            $acctInfo['nbPurchaseAccount'] = $nbPurchaseAccount;
            $acctInfo['txnActivityDay'] = $txnActivityDay;
            $acctInfo['txnActivityYear'] = $txnActivityYear;
        }

        $Ds_Merchant_EMV3DS = array(
            'addrMatch' => $addrMatch,
            'billAddrCity' => $billAddrCity,
            'billAddrLine1' => $billAddrLine1,
            'billAddrPostCode' => $billAddrPostCode,
            'Email' => $email,
            'homePhone' => $homePhone,
            'acctInfo' => $acctInfo
        );

        if ($billAddrLine2) {
            $Ds_Merchant_EMV3DS['billAddrLine2'] = $billAddrLine2;
        }

        if ($mobilePhone) {
            $Ds_Merchant_EMV3DS['mobilePhone'] = $mobilePhone;
        }

        if ($shippingInfo) {
            $Ds_Merchant_EMV3DS['shipAddrCity'] = $shipAddrCity;
            $Ds_Merchant_EMV3DS['shipAddrLine1'] = $shipAddrLine1;
            $Ds_Merchant_EMV3DS['shipAddrPostCode'] = $shipAddrPostCode;
            if ($shipAddrLine2) {
                $Ds_Merchant_EMV3DS['shipAddrLine2'] = $shipAddrLine2;
            }
        }

        $Ds_Merchant_EMV3DS = json_encode($Ds_Merchant_EMV3DS);
        return $Ds_Merchant_EMV3DS;
    }

    public static function generate3DS2_v2()
    {
        $context = Context::getContext();

        $customer                   = $context->customer;
        $cart                       = $context->cart;
        $shippingInfo               = $cart->id_address_delivery ? new Address($cart->id_address_delivery) : null;
        $billingInfo                = new Address($cart->id_address_invoice);
        $isLoggedIn                 = !boolval($customer->is_guest);

        if (!$isLoggedIn) {
            $chAccAgeInd            = "01";
        }
        else {
            $accountCreated         = intval( (strtotime("now") - strtotime($customer->date_add))/60 );
            $nDays                  = intval($accountCreated/1440);

            $dt                     = new DateTime($customer->date_upd);
            $chAccDate              = $dt->format('Ymd');

            if ($accountCreated < 20) {
                $chAccAgeInd        = "02";
            }
            elseif ($nDays < 30) {
                $chAccAgeInd        = "03";
            }
            elseif ($nDays >= 30 && $nDays <= 60) {
                $chAccAgeInd        = "04";
            }
            else {
                $chAccAgeInd        = "05";
            }
        }

        if ($isLoggedIn) {
            $dt                     = new DateTime($customer->date_upd);
            $chAccChange            = $dt->format('Ymd');
            $accountModified        = intval( (strtotime("now") - strtotime($customer->date_upd))/60 );
            $nDays                  = intval($accountModified/1440);
            if($accountModified < 20) {
                $chAccChangeInd     = "01";
            }
            elseif ($nDays < 30) {
                $chAccChangeInd     = "02";
            }
            elseif ($nDays >= 30 && $nDays <= 60) {
                $chAccChangeInd     = "03";
            }
            else {
                $chAccChangeInd     = "04";
            }
        }

        if ($isLoggedIn) {
            $customerId             = pSQL($customer->id);
            $fechaBase              = strtotime("-6 month");
            $dt                     = new DateTime("@$fechaBase");
            $query                  = Db::getInstance()->executeS('SELECT COUNT(*) x FROM `'._DB_PREFIX_.'orders` o LEFT JOIN `'._DB_PREFIX_.'order_detail` od ON o.id_order = od.id_order WHERE o.valid = 1 AND o.`id_customer` = '.intval($customerId).' AND o.`date_add` > "'.$dt->format('Y-m-d H:i:s').'";');
            $nbPurchaseAccount      = $query[0]['x'];
        }

        if ($isLoggedIn) {
            $customerId             = pSQL($customer->id);
            $fechaBase              = strtotime("-1 day");
            $dt                     = new DateTime("@$fechaBase");
            $query                  = Db::getInstance()->executeS('SELECT COUNT(*) x FROM `'._DB_PREFIX_.'orders` o LEFT JOIN `'._DB_PREFIX_.'order_detail` od ON o.id_order = od.id_order WHERE o.valid = 1 AND o.`id_customer` = '.intval($customerId).' AND o.`date_add` > "'.$dt->format('Y-m-d H:i:s').'";');
            $txnActivityDay         = $query[0]['x'];
        }

        if ($isLoggedIn) {
            $customerId             = pSQL($customer->id);
            $fechaBase              = strtotime("-1 year");
            $dt                     = new DateTime("@$fechaBase");
            $query                  = Db::getInstance()->executeS('SELECT COUNT(*) x FROM `'._DB_PREFIX_.'orders` o LEFT JOIN `'._DB_PREFIX_.'order_detail` od ON o.id_order = od.id_order WHERE o.valid = 1 AND o.`id_customer` = '.intval($customerId).' AND o.`date_add` > "'.$dt->format('Y-m-d H:i:s').'";');
            $txnActivityYear        = $query[0]['x'];
        }

        if ($shippingInfo) {
            $shippingAddress1       = pSQL($shippingInfo->address1);
            $shippingAddress2       = pSQL($shippingInfo->address2);
            $shippingPostcode       = pSQL($shippingInfo->postcode);
            $shippingCity           = pSQL($shippingInfo->city);
            $shippingCountry        = pSQL($shippingInfo->id_country);

            $query                  = Db::getInstance()->executeS("SELECT o.date_add FROM "._DB_PREFIX_."orders o, "._DB_PREFIX_."address a WHERE a.id_address = o.id_address_delivery AND o.valid = '1' AND a.address1 = '". $shippingAddress1 ."' AND a.address2 = '". $shippingAddress2 . "' AND a.postcode = '" . $shippingPostcode . "' AND a.city = '" . $shippingCity . "' AND a.id_country = '" . $shippingCountry . "' ORDER BY o.date_add;" );
            if (count($query) != 0) {
                $queryResult        = $query[0]['date_add'];
                $dt                 = new DateTime($queryResult);
                $shipAddressUsage   = $dt->format('Ymd');

                $duringTransaction  = intval( (strtotime("now") - strtotime($queryResult))/60 );
                $nDays              = intval($duringTransaction/1440);
                if ($nDays < 30) {
                    $shipAddressUsageInd = "02";
                }
                elseif ($nDays >= 30 && $nDays <= 60) {
                    $shipAddressUsageInd = "03";
                }
                else {
                    $shipAddressUsageInd = "04";
                }
            }
            else {
                $fechaBase              = strtotime("now");
                $dt                     = new DateTime("@$fechaBase");
                $shipAddressUsage       = $dt->format('Ymd');
                $shipAddressUsageInd    = "01";
            }
        }

        if ($shippingInfo) {
            if (
                ($shippingInfo->address1 == $billingInfo->address1)
                &&
                ($shippingInfo->address2 == $billingInfo->address2)
                &&
                ($shippingInfo->city == $billingInfo->city)
                &&
                ($shippingInfo->postcode == $billingInfo->postcode)
                &&
                ($shippingInfo->country == $billingInfo->country)
            ) {
                $addrMatch          = "Y";
            }
            else {
                $addrMatch          = "N";
            }
        }
        else {
            $addrMatch              = "N";
        }

        $billAddrCity               = $billingInfo->city;
        $billAddrLine1              = $billingInfo->address1;
        $billAddrLine2              = $billingInfo->address2;
        $billAddrPostCode           = $billingInfo->postcode;
        $Email                      = $customer->email;

        $homePhone                  = $billingInfo->phone ? array("subscriber"=>$billingInfo->phone, "cc" => "34") : null;

        $mobilePhone                = isset($billingInfo->mobile_phone) ? array("subscriber" => $billingInfo->mobile_phone, "cc" => "34") : null;

        if ($shippingInfo) {
            $shipAddrCity           = $shippingInfo->city;
            $shipAddrLine1          = $shippingInfo->address1;
            $shipAddrLine2          = $shippingInfo->address2;
            $shipAddrPostCode       = $shippingInfo->postcode;

        }

        $acctInfo                       = array(
            'chAccAgeInd'               => $chAccAgeInd
        );
        if ($shippingInfo) {
            $acctInfo['shipAddressUsage']       = strval($shipAddressUsage);
            $acctInfo['shipAddressUsageInd']    = strval($shipAddressUsageInd);
        }
        if ($isLoggedIn) {
            $acctInfo['chAccDate']          = strval($chAccDate);
            $acctInfo['chAccChange']        = strval($chAccChange);
            $acctInfo['chAccChangeInd']     = strval($chAccChangeInd);
            $acctInfo['nbPurchaseAccount']  = strval($nbPurchaseAccount);
            $acctInfo['txnActivityDay']     = strval($txnActivityDay);
            $acctInfo['txnActivityYear']    = strval($txnActivityYear);
        }

        $Ds_Merchant_EMV3DS         = array(
            'addrMatch'             => $addrMatch,
            'billAddrCity'          => $billAddrCity,
            'billAddrLine1'         => $billAddrLine1,
            'billAddrPostCode'      => $billAddrPostCode,
            'email'                 => $Email,
            'acctInfo'              => $acctInfo
        );
        if ($homePhone) {
            $Ds_Merchant_EMV3DS['homePhone']    = $homePhone;
        }
        if ($billAddrLine2) {
            $Ds_Merchant_EMV3DS['billAddrLine2']    = $billAddrLine2;
        }
        if ($mobilePhone) {
            $Ds_Merchant_EMV3DS['mobilePhone']      = $mobilePhone;
        }
        if ($shippingInfo) {
            $Ds_Merchant_EMV3DS['shipAddrCity']     = $shipAddrCity;
            $Ds_Merchant_EMV3DS['shipAddrLine1']    = $shipAddrLine1;
            $Ds_Merchant_EMV3DS['shipAddrPostCode'] = $shipAddrPostCode;

            if ($shipAddrLine2) {
                $Ds_Merchant_EMV3DS['shipAddrLine2']    = $shipAddrLine2;
            }
        }

        $Ds_Merchant_EMV3DS         = RedsysTpv::removeEmptyValues($Ds_Merchant_EMV3DS);
        $Ds_Merchant_EMV3DS         = json_encode($Ds_Merchant_EMV3DS);

        return $Ds_Merchant_EMV3DS;
    }

    public static function removeEmptyValues($array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = RedsysTpv::removeEmptyValues($array[$key]);
            }

            if (is_null($array[$key])) {
                unset($array[$key]);
            }
        }
        return $array;
    }
}
