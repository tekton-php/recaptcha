<?php namespace Tekton\Recaptcha;

class RecaptchaManager {

    function __construct() {
        $this->config = app('config');
        $this->api = app('api');
    }

    function response(array $data = []) {
        if (empty($data)) {
            if (isset($_POST['g-recaptcha-response'])) {
                return $_POST['g-recaptcha-response'];
            }
            elseif (isset($_GET['g-recaptcha-response'])) {
                return $_GET['g-recaptcha-response'];
            }
        }

        return (isset($data['g-recaptcha-response'])) ? $data['g-recaptcha-response'] : null;
    }

    function validate($ip, $response) {

        // Make sure Captcha is correct
        $result = $this->api->post('https://www.google.com/recaptcha/api/siteverify', array(
            'form_params' => array(
                'secret' => $this->config->get('recaptcha.secret_key'),
                'response' => $response,
                'remoteip' => $ip,
            ),
        ));

        $result = json_decode($result->getBody());

        // Validate response
        if ( ! isset($result->success) || ! $result->success) {
            return false;
        }
        else {
            return true;
        }
    }

    function widget($classes = []) {
        $classes = array_merge(['g-recaptcha'], $classes);
        return '<div class="'.implode(' ', $classes).'" data-sitekey="'.$this->config->get('recaptcha.public_key').'"></div>';
    }

    function display($classes = []) {
        echo $this->widget($classes);
    }

    function script() {
        return 'https://www.google.com/recaptcha/api.js';
    }
}
