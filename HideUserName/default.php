<?php if (!defined('APPLICATION')) exit();

// Define the plugin:
$PluginInfo['HideUserName'] = array(
   'Name' => 'HideUserName',
   'Description' => 'Hide user name for some purpuse.',
   'Version' => '0.1',
   'Author' => "Xiaoli Wang",
   'AuthorEmail' => 'zagorot@gmail.com',
   'AuthorUrl' => 'http://nsnq.org',
   'MobileFriendly' => TRUE
);

class HideUserNamePlugin extends Gdn_Plugin {
   public function Setup() {
      // No setup required.
   }
   
   public static function hideEmailPostfix($email) {
     $username = $email;
     if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/" , $email))
     {
       list($username,$domain)=split('@',$email);
     }
     return $username."@***";
   }

}

if (!function_exists('UserAnchor')) {
	function UserAnchor($User, $CssClass = '') {
		$username = HideUserNamePlugin::hideEmailPostfix($User->Name);
		return '<a href="'.Url('/profile/'.$User->UserID.'/'.urlencode($username)).'"'.$CssClass.'>'.$username.'</a>';
	}
}