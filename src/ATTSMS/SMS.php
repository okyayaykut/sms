<?php

namespace ATTSMS;

class SMS
{

    //the username for service
    private static $username;

    //the password for service
    private static $password;

    //the shared header of the text messages
    private static $header;



    /**
     * @param $username -username given from the provider
     * @return bool true if function works.
     */
    public static function setUsername ($username) {
        self::$username = $username;
        return true;
    }

    /**
     * @return string returns username set.
     */
    public static function getUsername () {
        return self::$username;
    }

    /**
     * @param $password -password given from the provider
     * @return bool true if function works.
     */
    public static function setPassword ($password) {
        self::$password = $password;
        return true;
    }

    /**
     * @return string returns password set.
     */
    public static function getPassword () {
        return self::$password;
    }

    /**
     * @param $header -one of the headers in the account available (ask provider)
     * @return bool true if function works.
     */
    public static function setHeader ($header) {
        self::$header = $header;
        return true;
    }

    /**
     * @return string returns password set.
     */
    public static function getHeader () {
        return self::$header;
    }

    /**
     * To set all in one line.
     * @param $username -username given from the provider
     * @param $password -password given from the provider
     * @param $header -one of the headers in the account available (ask provider)
     * @return bool true if function works.
     */
    public static function setConfig ($username, $password, $header) {
        self::$username = $username;
        self::$password = $password;
        self::$header = $header;
        return true;
    }

    /**
     * @return array returns username, password, header set in an array of strings.
     */
    public static function getConfig () {
        return array(self::$username, self::$password, self::$header);
    }

    /**
     * @param $address -site address to make the call
     * @param $xml -XML $xml to send to API service.
     * @return mixed export of the curl result.
     */
    public static function sendRequest($address, $send_xml)
    {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $address);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$send_xml);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);
		$result = curl_exec($ch);

        return $result;
    }

    /**
     * @param $number -number to send sms
     * @param $message -message to send
     * @return mixed export of the curl result.
     */
    public static function sendSms($number, $message)
    {
        $username   = self::$username;
        $password   = self::$password;
        $header     = self::$header;

        $xml = <<<EOS
                    <request>
                            <authentication>
                                    <username>{$username}</username>
                                    <password>{$password}</password>
                            </authentication>
                            <order>
                                <sender>{$header}</sender>
                                <sendDateTime></sendDateTime>
                                <message>
                                    <text><![CDATA[{$message}]]></text>
                                    <receipents>
                                        <number>{$number}</number>
                                    </receipents>
                                </message>
                            </order>
                    </request>
EOS;
        $result = self::sendRequest('http://api.iletimerkezi.com/v1/send-sms', $xml);

        return var_export($result, 1);
    }

}
