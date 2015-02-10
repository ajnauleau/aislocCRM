<?php
/*****/
/*
Written by: Aziz S. Hussain
Email: azizsaleh@gmail.com
Website: www.azizsaleh.com
Produced under GPL License
*/
/*****/


/*
Email address scraper based on a URL.
*/      

class scraper
{
	// URL that stores first URL to start
	var $startURL;
	
	// List of allowed page extensions
	var $allowedExtensions = array('.css','.xml','.rss','.ico','.js','.gif','.jpg','.jpeg','.png','.bmp','.wmv'
		,'.avi','.mp3','.flash','.swf','.css');
	
	// Which URL to scrape
	var $useURL;
	
	// Start path, for links that are relative
	var $startPath;
	
	// Set start path
	function setStartPath($path = NULL){
		if($path != NULL)
		{
			$this->startPath = $path;
		} else {
			$temp = explode('/',$this->startURL);
			$this->startPath = $temp[0].'//'.$temp[2];
		}
	}
	
	// Add the start URL
	function startURL($theURL){
		// Set start URL
		$this->startURL = $theURL;
	}
	
	// Function to get URL contents
	function getContents($url)
	{
		$ch = curl_init(); // initialize curl handle
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
		curl_setopt($ch, CURLOPT_AUTOREFERER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,7);
		curl_setopt($ch, CURLOPT_REFERER, 'http://'.$this->useURL);
		curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
		curl_setopt($ch, CURLOPT_TIMEOUT, 50); // times out after 50s
		curl_setopt($ch, CURLOPT_POST, 0); // set POST method
		$buffer = curl_exec($ch); // run the whole process
		curl_close($ch); 
		return $buffer;
	}
	
	// Actually do the URLS
	function startScraping()
	{
		// Get page content
		$pageContent = $this->getContents($this->startURL);
		echo 'Scraping URL: '.$this->startURL.PHP_EOL;
		
		// Get list of all emails on page
		preg_match_all('/([\w+\.]*\w+@[\w+\.]*\w+[\w+\-\w+]*\.\w+)/is',$pageContent,$results);
		// Add the email to the email list array
		$insertCount=0;
		foreach($results[1] as $curEmail)
		{
			$insert = mysql_query("INSERT INTO `emaillist` (`emailadd`) VALUES ('$curEmail')");
			if($insert){$insertCount++;}
		}
		
		echo 'Emails found: '.number_format($insertCount).PHP_EOL;
		
		// Mark the page done
		$insert = mysql_query("INSERT INTO `finishedurls` (`urlname`) VALUES ('".$this->startURL."')");
		
		// Get list of new page URLS is emails were found on previous page
		preg_match_all('/href="([^"]+)"/Umis',$pageContent,$results);
		$currentList = $this->cleanListURLs($results[1]);
		
		$insertURLCount=0;
		// Add the list to the array
		foreach($currentList as $curURL)
		{
			$insert = mysql_query("INSERT INTO `workingurls` (`urlname`) VALUES ('$curURL')");
			if($insert){$insertURLCount++;}
		}
		
		echo 'URLs found: '.number_format($insertURLCount).PHP_EOL;

		$getURL = mysql_fetch_assoc(mysql_query("SELECT `urlname` FROM `workingurls` ORDER BY RAND() LIMIT 1"));
		$remove = mysql_query("DELETE FROM `workingurls` WHERE `urlname`='$getURL[urlname]' LIMIT 1");
		
		// Get the new page ready
		$this->startURL = $getURL['urlname'];
		$this->setStartPath();
		
		// If no more pages, return
		if($this->startURL == NULL){ return;}
		// Clean vars
		unset($results,$pageContent);
		// If more pages, loop again
		$this->startScraping();
	}
	
	// Function to clean input URLS
	function cleanListURLs($linkList)
	{	
		foreach($linkList as $sub => $url)
		{
			// Check if only 1 character - there must exist at least / character
			if(strlen($url) <= 1){unset($linkList[$sub]);}
			// Check for any javascript
			if(eregi('javascript',$url)){unset($linkList[$sub]);}
			// Check for invalid extensions
			str_replace($this->allowedExtensions,'',$url,$count);
			if($count > 0){ unset($linkList[$sub]);}
			// If URL starts with #, ignore
			if(substr($url,0,1) == '#'){unset($linkList[$sub]);}
			
			// If everything is OK and path is relative, add starting path
			if(substr($url,0,1) == '/' || substr($url,0,1) == '?' || substr($url,0,1) == '='){
				$linkList[$sub] = $this->startPath.$url;
			}
		}
		return $linkList;
	}
	
}
?>