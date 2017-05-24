<?php
function get_client_language($availableLanguages, $default='en'){
	
	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			
		$langs=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);

		//start going through each one
		foreach ($langs as $value){
	
			$choice=substr($value,0,2);
			if(in_array($choice, $availableLanguages)){
				return $choice;
				
			}
			
		}
	} 
	return $default;
}

    public function loadTimeline($user, $max = 20){ 
        $this->twitURL .= 'statuses/user_timeline.xml?screen_name='.$user.'&count='.$max; 
        $ch        = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $this->twitURL); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $this->xml = curl_exec($ch); 
        return $this; 
    } 
    public function getTweets(){ 
        $this->twitterArr = $this->getTimelineArray(); 
        $tweets = array(); 
        foreach($this->twitterArr->status as $status){ 
            $tweets[$status->created_at->__toString()] = $status->text->__toString(); 
        } 
        return $tweets; 
    } 
    public function getTimelineArray(){ 
        return simplexml_load_string($this->xml); 
    } 
    public function formatTweet($tweet){ 
        $tweet = preg_replace("/(http(.+?))( |$)/","$1$3", $tweet); 
        $tweet = preg_replace("/#(.+?)(\h|\W|$)/", "#$1$2", $tweet); 
        $tweet = preg_replace("/@(.+?)(\h|\W|$)/", "@$1$2", $tweet); 
        return $tweet; 
    } 
}
?>