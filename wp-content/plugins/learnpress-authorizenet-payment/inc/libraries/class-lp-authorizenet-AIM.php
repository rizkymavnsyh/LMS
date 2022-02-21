<?php
/**
 * Easily interact with the Authorize.Net AIM API.
 *
 *
 * Example Authorize and Capture Transaction against the Sandbox:
 * <code>
 * <?php require_once 'AuthorizeNet.php'
 * $sale = new AuthorizeNetAIM;
 * $sale->setFields(
 *     array(
 *    'amount' => '4.99',
 *    'card_num' => '411111111111111',
 *    'exp_date' => '0515'
 *    )
 * );
 * $response = $sale->authorizeAndCapture();
 * if ($response->approved) {
 *     echo "Sale successful!"; } else {
 *     echo $response->error_message;
 * }
 * ?>
 * </code>
 *
 * Note: To send requests to the live gateway, either define this:
 * define("AUTHORIZENET_SANDBOX", false);
 *   -- OR --
 * $sale = new AuthorizeNetAIM;
 * $sale->setSandbox(false);
 *
 * @package    AuthorizeNet
 * @subpackage AuthorizeNetAIM
 * @link       http://www.authorize.net/support/AIM_guide.pdf AIM Guide
 */
if(!class_exists('AuthorizeNetResponse')){
	require_once LP_ADDON_AUTHORIZENET_PATH.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'libraries'.DIRECTORY_SEPARATOR.'shared'.DIRECTORY_SEPARATOR.'AuthorizeNetResponse.php';
}
if(!class_exists('AuthorizeNetRequest')){
	require_once LP_ADDON_AUTHORIZENET_PATH.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'libraries'.DIRECTORY_SEPARATOR.'shared'.DIRECTORY_SEPARATOR.'AuthorizeNetRequest.php';
}
if(!class_exists('AuthorizeNetAIM')){
	require_once LP_ADDON_AUTHORIZENET_PATH.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'libraries'.DIRECTORY_SEPARATOR.'AuthorizeNetAIM.php';
}
/**
 * Builds and sends an overwrite AuthorizeNet AIM Request.
 *
 * @package    AuthorizeNet
 * @subpackage AuthorizeNetAIM
 */
class LearnPressAuthorizeNetAIM extends AuthorizeNetAIM
{
	public function __construct($api_login_id = false, $transaction_key = false)
	{
		$this->_api_login = ($api_login_id ? $api_login_id : (defined('AUTHORIZENET_API_LOGIN_ID') ? AUTHORIZENET_API_LOGIN_ID : ""));
		$this->_transaction_key = ($transaction_key ? $transaction_key : (defined('AUTHORIZENET_TRANSACTION_KEY') ? AUTHORIZENET_TRANSACTION_KEY : ""));
		$this->_sandbox = (defined('AUTHORIZENET_SANDBOX') ? AUTHORIZENET_SANDBOX : true);
	}
}