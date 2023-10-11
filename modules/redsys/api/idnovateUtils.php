<?php
/**
 * Card payment REDSYS virtual POS.
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

class IdnovateUtils
{
    public static function encrypt($encrypt)
    {
        $key = Tools::substr(bin2hex(_COOKIE_IV_ . _COOKIE_KEY_), 0, 64);
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key = pack('H*', $key);
        $mac = hash_hmac('sha256', $encrypt, Tools::substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt . $mac, MCRYPT_MODE_CBC, $iv);
        $encoded = base64_encode($passcrypt) . '|' . base64_encode($iv);
        return $encoded;
    }

    public static function decrypt($decrypt)
    {
        $key = Tools::substr(bin2hex(_COOKIE_IV_ . _COOKIE_KEY_), 0, 64);
        $decrypt = explode('|', $decrypt . '|');
        $decoded = base64_decode($decrypt[0]);
        $iv = base64_decode($decrypt[1]);
        if (strlen($iv) !== mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)) {
            return false;
        }
        $key = pack('H*', $key);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
        $mac = Tools::substr($decrypted, -64);
        $decrypted = Tools::substr($decrypted, 0, -64);
        $calcmac = hash_hmac('sha256', $decrypted, Tools::substr(bin2hex($key), -32));
        if ($calcmac !== $mac) {
            return false;
        }
        $decrypted = Tools::unSerialize($decrypted);
        return $decrypted;
    }
}
