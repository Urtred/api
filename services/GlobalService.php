<?php  

class GlobalService extends Service
{

    public static function load() {
        $class = get_class();
        return new $class;
    }

	# Soap #######################################################################################################################
	##############################################################################################################################

	public function getSoap($soapUrl, $xml) {
		$headers = [
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: ".$soapUrl, 
            "Content-length: ".strlen($xml),
        ];

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $soapUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch); 
        curl_close($ch);

        return $response;
	}
}

?>
