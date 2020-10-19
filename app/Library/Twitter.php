<?php
namespace App\Library;

use Carbon\Carbon;

class TwitterRateLimitException extends \Exception {};

class Twitter
{
	private $codebird;

	public function __construct(\Codebird\Codebird $codebird)
	{
		$this->codebird = $codebird;
    }

	public function testeApiTwitter()
	{
		$response = (array)$this->codebird->account_settings();
		if ($response['httpstatus'] == 200)
		{
			return $response;
		}
		elseif (array_key_exists('errors', $response))
		{
			$errorMessages = '';
			foreach($response['errors'] as $error)
				$errorMessages .= '; ' . $error->message;

			throw new \Exception('Não foi possível autenticar. Twitter respondeu com: ' . trim($errorMessages, '; '));
		}
		elseif (array_key_exists('error', $response))
			throw new \Exception('Não foi possível autenticar. Twitter respondeu com: ' . $response['error']);
		else
			throw new \Exception('Não foi possível autenticar. O Twitter não respondeu com mais informações sobre o problema.');
    }
    	 

	public function postTweet($texto)
	{
		$tweet = $this->codebird->statuses_update('status=' . $texto);
		return $tweet;
	}

	public function timelineTerminal($count){
		$parametro = array('count' => $count);
		$dados = (array)$this->codebird->statuses_homeTimeline($parametro);
		unset($dados['httpstatus']);
		unset($dados['rate']);
		
	 	return $dados; 
	}
	
	

    


}