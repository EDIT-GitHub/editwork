<?php
/*
* Class Uni_Coworking_Theme_Mailchimp_Universal
*
*/

class Uni_Coworking_Theme_Mailchimp_Universal {

	public $version = '0.1.0';
    public $mailchimp_ajax = null;

    private $api_key = null;
    private $dc_uri = null;
    private $list_id = null;

	/**
	 * Constructor
	 */
	public function __construct( $sApiKey = '', $sListId = '' ) {
		$this->includes();
        $this->set_api_data( $sApiKey, $sListId );
	}

	/**
	 * set_api_data()
	 */
	public function set_api_data( $sApiKey = '', $sListId = '' ) {

        if ( !empty($sApiKey) && $sApiKey != null ) {
            $this->api_key = $sApiKey;
            $aApiKey = explode('-', $this->api_key);
            $this->dc_uri = 'https://' . $aApiKey[1] . '.api.mailchimp.com/3.0';
        } else {
            $this->api_key = '';
            $this->dc_uri = '';
        }

        if ( !empty($sListId) && $sListId != null ) {
            $this->list_id = $sListId;
        } else {
            $this->list_id = '';
        }

	}

	/**
	 *  Includes
	 */
    private function includes() {
    }


	/**
	 * ajax_url()
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php' );
	}

	/**
	 *  call_lists()  TODO!
     *
     *  $sMethod : GET, POST
     *  $aArgs : {array}
	 */
    public function call_lists( $sCallName = 'lists', $sMethod, $aArgs = array() ) {

        $aResult = $this->_r();

        $sUrl = $this->dc_uri . '/' . $sCallName;

        // TODO https://us10.api.mailchimp.com/schema/3.0/Lists/Instance.json

            $aBody = array(
	                    "name" => "",
	                    "contact" => array(
		                    "company" => "",
		                    "address1" => "",
		                    "address2" => "",
		                    "city" => "",
		                    "state" => "",
		                    "zip" => "",
		                    "country" => "",
		                    "phone" => ""
	                    ),
	                    "permission_reminder" => "",
	                    "use_archive_bar" => "",
	                    "campaign_defaults" => array(
	    	                "from_name" => "",
		                    "from_email" => "",
		                    "subject" => "",
		                    "language" => ""
	                    ),
	                    "notify_on_subscribe" => "",
	                    "notify_on_unsubscribe" => "",
	                    "email_type_option" => "",
	                    "visibility" => ""
                    );

            $aJsonEncodedBody = json_encode($aBody);

            $aResponse = wp_remote_request( $sUrl,
                array(
	                'method' => $sMethod,
	                'timeout' => 45,
	                'redirection' => 5,
	                'httpversion' => '1.0',
	                'blocking' => true,
	                'headers' => array(
                        'Content-Type' => 'application/json',
                        'Authorization' => 'apikey '.$this->api_key
                    ),
	                'body' => $aJsonEncodedBody,
	                'cookies' => array()
                )
            );

            if ( is_wp_error( $aResponse ) ) {
                $ErrorMsg = $aResponse->get_error_message();
                $aResult['status']      = 'error';
                $aResult['message']     = $ErrorMsg;
            } else {
                $sBodyResponse = wp_remote_retrieve_body($aResponse);
                $aBodyResponse = json_decode($sBodyResponse);
                if ( $aResponse['response']['code'] == '200' ) {
                    $aResult['status']      = 'success';
                    $aResult['response']     = $aBodyResponse;
                } else if ( $aResponse['response']['code'] == '400' ) {
                    $aResult['response']     = $aBodyResponse;
                }
            }



    }

	/**
	 *  call_lists_interest_categories()
     *
     *  $sMethod : GET, POST
     *  $aArgs : {array}
	 */
    public function call_lists_interest_categories( $sCallName = 'lists/interest-categories', $sMethod, $aArgs = array() ) {

        $aResult = $this->_r();

        $aCallName = explode('/', $sCallName);

        $sUrl = $this->dc_uri . '/' . $aCallName[0] . '/' . $this->list_id . '/' . $aCallName[1] . '/';

        if ( $sMethod == 'POST' ) {

            // https://us9.api.mailchimp.com/schema/3.0/Lists/InterestCategories/Instance.json

            $aBody = array(
	                "title" => $aArgs['title'],              // required, {string}
	                "display_order" => 1,                    // {integer}
	                "type" => $aArgs['type']                 // required, {string}, ( "checkboxes", "dropdown", "radio", "hidden" )
                );

            $aJsonEncodedBody = json_encode($aBody);

            $aResponse = wp_remote_request( $sUrl,
                array(
	                'method' => $sMethod,
	                'timeout' => 45,
	                'redirection' => 5,
	                'httpversion' => '1.0',
	                'blocking' => true,
	                'headers' => array(
                        'Content-Type' => 'application/json',
                        'Authorization' => 'apikey '.$this->api_key
                    ),
	                'body' => $aJsonEncodedBody,
	                'cookies' => array()
                )
            );

            if ( is_wp_error( $aResponse ) ) {
                $ErrorMsg = $aResponse->get_error_message();
                $aResult['status']      = 'error';
                $aResult['message']     = $ErrorMsg;
            } else {
                $sBodyResponse = wp_remote_retrieve_body($aResponse);
                $aBodyResponse = json_decode($sBodyResponse);
                if ( $aResponse['response']['code'] == '200' ) {
                    $aResult['status']      = 'success';
                    $aResult['response']     = $aBodyResponse;
                } else if ( $aResponse['response']['code'] == '400' ) {
                    $aResult['response']     = $aBodyResponse;
                }
            }

        } else if ( $sMethod == 'GET' ) {

            $aBody = array();

            $aJsonEncodedBody = json_encode($aBody);

            $aResponse = wp_remote_request( $sUrl,
                array(
	                'method' => $sMethod,
	                'timeout' => 45,
	                'redirection' => 5,
	                'httpversion' => '1.0',
	                'blocking' => true,
	                'headers' => array(
                        'Content-Type' => 'application/json',
                        'Authorization' => 'apikey '.$this->api_key
                    ),
	                'body' => $aJsonEncodedBody,
	                'cookies' => array()
                )
            );

            if ( is_wp_error( $aResponse ) ) {
                $ErrorMsg = $aResponse->get_error_message();
                $aResult['status']      = 'error';
                $aResult['message']     = $ErrorMsg;
            } else {
                $sBodyResponse = wp_remote_retrieve_body($aResponse);
                $aBodyResponse = json_decode($sBodyResponse);
                if ( $aResponse['response']['code'] == '200' ) {
                    $aResult['status']      = 'success';
                    $aResult['response']     = $aBodyResponse;
                } else if ( $aResponse['response']['code'] == '400' ) {
                    $aResult['response']     = $aBodyResponse;
                }
            }

        }

        return $aResult;

    }

	/**
	 *  call_lists_members()
     *
     *  $sMethod : GET, POST, PATCH or DELETE
     *  $aArgs : {array}
	 */
    public function call_lists_members( $sCallName = 'lists/members', $sMethod, $aArgs = array() ) {

        $aResult = $this->_r();

        $aCallName = explode('/', $sCallName);

        $sUrl = $this->dc_uri . '/' . $aCallName[0] . '/' . $this->list_id . '/' . $aCallName[1] . '/';

        if ( $sMethod == 'POST' && !empty($aArgs['email_address']) && !empty($aArgs['status']) ) {

            // https://us9.api.mailchimp.com/schema/3.0/Lists/Members/Instance.json

            $aBody = array(
                    "email_address" => $aArgs['email_address'],     // required {string}
	                "email_type" => ( !empty($aArgs['email_type']) ) ? $aArgs['email_type'] : 'text',           // {string} 'html' or 'text'
	                "status" => $aArgs['status'],                   // required, {string} ('subscribed', 'unsubscribed', 'cleaned', or 'pending')
	                "merge_fields" => ( !empty($aArgs['merge_fields']) ) ? $aArgs['merge_fields'] : new stdClass(),       // {array/object} (FNAME, LNAME etc)
	                "interests" => ( !empty($aArgs['interests']) ) ? $aArgs['interests'] : new stdClass(),             // {array/object}
	                "language" => ( !empty($aArgs['language']) ) ? $aArgs['language'] : '',               // {string} 'de' etc
	                "vip" => false                                  // {boolean}
                );

            $aJsonEncodedBody = json_encode($aBody);

            $aResponse = wp_remote_request( $sUrl,
                array(
	                'method' => $sMethod,
	                'timeout' => 45,
	                'redirection' => 5,
	                'httpversion' => '1.0',
	                'blocking' => true,
	                'headers' => array(
                        'Content-Type' => 'application/json',
                        'Authorization' => 'apikey '.$this->api_key
                    ),
	                'body' => $aJsonEncodedBody,
	                'cookies' => array()
                )
            );
           
            if ( is_wp_error( $aResponse ) ) {
                $ErrorMsg = $aResponse->get_error_message();
                $aResult['status']      = 'error';
                $aResult['message']     = $ErrorMsg;
            } else {
                $sBodyResponse = wp_remote_retrieve_body($aResponse);
                $aBodyResponse = json_decode($sBodyResponse);
                if ( $aResponse['response']['code'] == '200' ) {
                    $aResult['status']      = 'success';
                    $aResult['response']     = $aBodyResponse;
                } else if ( $aResponse['response']['code'] == '400' ) {
                    $aResult['response']     = $aBodyResponse;
                }
            }

        }

        return $aResult;

    }

    protected function _r() {
        $aResult = array(
		    'status' 	=> 'error',
			'message' 	=> esc_html__('Error!', 'coworking'),
            'response'	=> '',
			'redirect'	=> ''
		);
        return $aResult;
    }

}


function Uni_Coworking_Theme_Mailchimp_Universal( $sApiKey = '', $sListId = '' ) {
	return new Uni_Coworking_Theme_Mailchimp_Universal( $sApiKey, $sListId );
}
?>