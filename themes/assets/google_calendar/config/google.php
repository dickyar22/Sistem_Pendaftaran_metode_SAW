<?php
class Googleplus
{
    /**
     * Googleplus constructor.
     */
    public function __construct()
    {
        require "themes/assets/google_calendar/google-api-php/src/Google/autoload.php";
		require "themes/assets/google_calendar/config/calendar.php";
		require "themes/assets/google_calendar/config/config.php";
        $this->client = new Google_Client();
        $this->client->setApplicationName('Calendar Api');
        $this->client->setClientId($config['client_id']);
        $this->client->setClientSecret($config['client_secret']);
        $this->client->setRedirectUri($config['base_url'].'pages/content/visitor/add');
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
        $this->client->addScope('profile');

    }

    public function loginUrl()
    {

        return $this->client->createAuthUrl();

    }

    public function getAuthenticate()
    {

        return $this->client->authenticate();

    }

    public function getAccessToken()
    {

        return $this->client->getAccessToken();

    }

    public function setAccessToken()
    {

        return $this->client->setAccessToken();

    }

    public function revokeToken()
    {

        return $this->client->revokeToken();

    }

    public function client()
    {

        return $this->client;

    }

    public function getUser()
    {
		//echo var_dump($this->client); exit();
        $google_ouath = new Google_Service_Oauth2($this->client);
        return (object)$google_ouath->userinfo->get();

    }

    public function isAccessTokenExpired()
    {

        return $this->client->isAccessTokenExpired();

    }

}