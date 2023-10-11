<?php
/**
* Redsys Virtual Pos card payment

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

include 'json.php';
include 'hmac.php';

if (!defined('PHP_VERSION_ID')) {
    $version = explode('.', PHP_VERSION);
    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}

class RedsysAPI
{
    var $vars_pay = array();

	function setParameter($key, $value){
		$this->vars_pay[$key]=$value;
	}
	function getParameter($key){
		return $this->vars_pay[$key];
	}

	function json_decode4($data){
        $json = new Services_JSON();
        return $json->decode($data);
    }

	function json_encode4($data){
        $json = new Services_JSON();
        return $json->encode($data);
    }

	function encrypt_3DES($message, $key){
		$bytes = array(0,0,0,0,0,0,0,0);
		$iv = implode(array_map("chr", $bytes));

		if (phpversion() < '7') {
			$ciphertext = mcrypt_encrypt(MCRYPT_3DES, $key, $message, MCRYPT_MODE_CBC, $iv);
			return $ciphertext;
		} else {
			$long = ceil(strlen($message) / 16) * 16;
			$ciphertext = substr(openssl_encrypt($message . str_repeat("\0", $long - strlen($message)), 'des-ede3-cbc', $key, OPENSSL_RAW_DATA, $iv), 0, $long);
			return $ciphertext;
		}
	}

	function base64_url_encode($input){
		return strtr(base64_encode($input), '+/', '-_');
	}

	function encodeBase64($data){
		$data = base64_encode($data);
		return $data;
	}

	function base64_url_decode($input){
		return base64_decode(strtr($input, '-_', '+/'));
	}

	function decodeBase64($data){
		$data = base64_decode($data);
		return $data;
	}

	function mac256($ent,$key){
		if (PHP_VERSION_ID < 50102) {
			$res = hash_hmac4('sha256', $ent, $key, true);
		} else {
			$res = hash_hmac('sha256', $ent, $key, true);
		}
		return $res;
	}

	function arrayToJson(){
		if (phpversion() < 50200) {
			$json = $this->json_encode4($this->vars_pay);
		} else {
			$json = json_encode($this->vars_pay);
		}
		return $json;
	}

	function createMerchantParameters() {
		$json = $this->arrayToJson();
		return $this->encodeBase64($json);
	}

	function createMerchantSignature($key, $ent = false, $order = false) {
		$key = $this->decodeBase64($key);
		if (!$ent) {
			$ent = $this->createMerchantParameters();
		}
		if (!$order) {
			$key = $this->encrypt_3DES($this->getOrder(), $key);
		} else {
			$key = $this->encrypt_3DES($order, $key);
		}
		$res = $this->mac256($ent, $key);
		return $this->encodeBase64($res);
	}


	function createMerchantSignatureIPN($key, $datos){
		$key = $this->decodeBase64($key);
		$decodec = $this->base64_url_decode($datos);
		$this->stringToArray($decodec);
		$key = $this->encrypt_3DES($this->getDSOrder(), $key);
		$res = $this->mac256($datos, $key);
		return $this->base64_url_encode($res);
	}

	function getOrder(){
		$idOrder = "";
		if (empty($this->vars_pay['DS_MERCHANT_ORDER'])){
			$idOrder = $this->vars_pay['Ds_Merchant_Order'];
		} else {
			$idOrder = $this->vars_pay['DS_MERCHANT_ORDER'];
		}
		return $idOrder;
	}

	function getDSOrder(){
		$dsOrder = "";
		if (empty($this->vars_pay['Ds_Order'])){
			$dsOrder = $this->vars_pay['DS_ORDER'];
		} else {
			$dsOrder = $this->vars_pay['Ds_Order'];
		}
		return $dsOrder;
	}

	function stringToArray($decode) {
		if (PHP_VERSION_ID < 50200) {
			$this->vars_pay = $this->json_decode4($decode);
		} else {
			$this->vars_pay = json_decode($decode, true);
		}
	}

	function decodeMerchantParameters($data) {
		return $this->base64_url_decode($data);
	}

	function createMerchantDSSignatureNotif($key, $datos){
		$key = $this->decodeBase64($key);
		$decodec = $this->base64_url_decode($datos);
		$this->stringToArray($decodec);
		$key = $this->encrypt_3DES($this->getDSOrder(), $key);
		$res = $this->mac256($datos, $key);
		return $this->base64_url_encode($res);
	}
}

?>