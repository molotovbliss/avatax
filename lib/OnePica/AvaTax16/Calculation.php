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
 * Class OnePica_AvaTax16_Calculation
 */
class OnePica_AvaTax16_Calculation extends OnePica_AvaTax16_ResourceAbstract
{
    /**
     * Create Calculation
     *
     * @param OnePica_AvaTax16_Document_Request $documentRequest
     * @return StdClass $data
     */
    public function createCalculation($documentRequest)
    {
        $postUrl = $this->_config->getBaseUrl() . self::CALCULATION_URL_PATH;
        $postData = $documentRequest->toArray();
        $curl = $this->_getCurlObjectWithHeaders();
        $curl->post($postUrl, $postData);
        $data = $curl->response;
        return $data;
    }

    /**
     * Get Calculation
     *
     * @param string $transactionType
     * @param string $documentCode
     * @return StdClass $data
     */
    public function getCalculation($transactionType, $documentCode)
    {
        $config = $this->getConfig();
        $getUrl = $config->getBaseUrl()
                . self::CALCULATION_URL_PATH
                . '/account/'
                . $config->getAccountId()
                . '/company/'
                . $config->getCompanyCode()
                . '/'
                . $transactionType
                . '/'
                . $documentCode;

        $curl = $this->_getCurlObjectWithHeaders();
        $curl->get($getUrl);
        $data = $curl->response;
        return $data;
    }

    /**
     * Get List Of Calculations
     *
     * @param string $transactionType
     * @param int $limit
     * @param string $startDate
     * @param string $endDate
     * @param string $startCode (not implemented)
     * @return StdClass|array $result
     */
    public function getListOfCalculations($transactionType, $limit = null, $startDate = null, $endDate = null,
        $startCode = null)
    {
        $config = $this->getConfig();
        $getUrl = $config->getBaseUrl()
                . self::CALCULATION_URL_PATH
                . '/account/'
                . $config->getAccountId()
                . '/company/'
                . $config->getCompanyCode()
                . '/'
                . $transactionType;
        $filterData = array(
            'limit' => $limit,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'startCode' => $startCode,
        );

        $curl = $this->_getCurlObjectWithHeaders();
        $curl->get($getUrl, $filterData);
        $data = $curl->response;

        $result = null;
        if (is_array($data)) {
            foreach ($data as $dataItem) {
                $calculationListItem = new OnePica_AvaTax16_Calculation_ListItemResponse();
                $result[] = $calculationListItem->fillData($dataItem);
            }
        }
        return $result;
    }
}