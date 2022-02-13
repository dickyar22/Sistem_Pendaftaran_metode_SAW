<?php
//session_start();
class Googlecalendar
{

    public function __construct()
    {
        //parent::__construct();
	    //require "config/config.php";
		require "themes/assets/google_calendar/config/google.php";
		$this->googleplus = new Googleplus();
        $this->calendar = new Google_Service_Calendar($this->googleplus->client());

    }

    public function gc(){
        return $this->googleplus;
    }
	
    public function isLogin()
    {
		if(!empty($_SESSION['google_calendar_access_token'])){
        	$token = $_SESSION['google_calendar_access_token'];
		} else { $token = ""; }
        if ($token) {
            $this->googleplus->client->setAccessToken($token);
        }
        if ($this->googleplus->isAccessTokenExpired()) {
            return false;
        }
        return $token;

    }


    public function loginUrl()
    {
        return $this->googleplus->loginUrl();
    }


    public function login($code)
    {
        $login = $this->googleplus->client->authenticate($code);
        if ($login) {
            $token = $this->googleplus->client->getAccessToken();
            $_SESSION['google_calendar_access_token'] = $token;
            return true;
        }
    }


    public function getUserInfo()
    {
        return $this->googleplus->getUser();
    }


    public function getEvents($calendarId = 'primary', $timeMin = false, $timeMax = false, $maxResults = 10)
    {
        if (!$timeMin) {
            $timeMin = date("c", strtotime(date('Y-m-d ').' 00:00:00'));
        } else {
            $timeMin = date("c", strtotime($timeMin));
        }
        if (!$timeMax) {
            $timeMax = date("c", strtotime(date('Y-m-d ').' 23:59:59'));
        } else {
            $timeMax = date("c", strtotime($timeMax));
        }

        $optParams = array(
            'maxResults'   => $maxResults,
            'orderBy'      => 'startTime',
            'singleEvents' => true,
            'timeMin'      => $timeMin,
            'timeMax'      => $timeMax,
            'timeZone'     => 'Asia/Jakarta',

        );

        //$results = $this->googlecalendar->calendar->events->listEvents($calendarId, $optParams);
		$results = $this->calendar->events->listEvents($calendarId, $optParams);
		//echo json_encode($results); exit();
        $data = array();

        foreach ($results->getItems() as $item) {
            //$start = date('d-m-Y H:i', strtotime($item->getStart()->dateTime));
			//$start = date('d/m/Y H:i', strtotime($item->getStart()->dateTime));
            array_push(
                $data,
                array(

                    'id'          => $item->getId(),
                    'summary'     => $item->getSummary(),
                    'description' => $item->getDescription(),
                    'creator'     => $item->getCreator(),
                    'start'       => substr(str_replace("T"," ",$item->getStart()->dateTime),0,19),
                    'end'         => substr(str_replace("T"," ",$item->getEnd()->dateTime),0,19),
                    //'start2'      => $item->getStart()->dateTime,
                    //'end2'        => $item->getEnd()->dateTime,
                )
            );
        }
        return $data;
    }


    public function addEvent($calendarId = 'primary', $data)
    {
        //date format is => 2016-06-18T17:00:00+07:00
        $event = new Google_Service_Calendar_Event(
            array(
                'summary'     => $data['summary'],
                'description' => $data['description'],
                'start'       => array(
                    'dateTime' => $data['start'],
                    'timeZone' => 'Asia/Jakarta',
                ),
                'end'         => array(
                    'dateTime' => $data['end'],
                    'timeZone' => 'Asia/Jakarta',
                ),
                /*'attendees'   => array(
                    array('email' => 'omerkamcili@gmail.com'),
                ),*/
            )
        );
        return $this->calendar->events->insert($calendarId, $event);
        //return $event;
    }
    public function delEvent($calendarId = 'primary', $eventId)
    {
        return $this->calendar->events->delete($calendarId, $eventId);
    }
}