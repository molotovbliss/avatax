<?php
/**
 * OnePica
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to codemaster@onepica.com so we can send you a copy immediately.
 *
 * @category  OnePica
 * @package   OnePica_AvaTax
 * @copyright Copyright (c) 2015 One Pica, Inc. (http://www.onepica.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Class OnePica_AvaTax16_Transaction
 */
class OnePica_AvaTax16_Transaction extends OnePica_AvaTax16_ResourceAbstract
{
    /**
     * Url path for transactions
     */
    const TRANSACTION_URL_PATH = '/transactions';


    /**
     * Create Transaction
     *
     * @param OnePica_AvaTax16_Document_Request $documentRequest
     * @return StdClass $data
     */
    public function createTransaction($documentRequest)
    {
        $curl = $this->_getCurlObjectWithHeaders();
        $postUrl = $this->_config->getBaseUrl() . self::TRANSACTION_URL_PATH;
        $postData = $documentRequest->toArray();
        $curl->post($postUrl, $postData);
        $data = $curl->response;
        return $data;
    }
}
