<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
/* 
| ------------------------------------------------------------------- 
|  Stripe API Configuration 
| ------------------------------------------------------------------- 
| 
| You will get the API keys from Developers panel of the Stripe account 
| Login to Stripe account (https://dashboard.stripe.com/) 
| and navigate to the Developers >> API keys page 
| 
|  stripe_api_key            string   Your Stripe API Secret key. 
|  stripe_publishable_key    string   Your Stripe API Publishable key. 
|  stripe_currency           string   Currency code. 
*/ 
$config['stripe_api_key']         = 'sk_test_51ItymFEtVTguXAiuH4eQUgkooZ782MNug9hDoLGeagKoyf4Ek2huHLQlkHhkzJWymfJMJc1jGu7qqEGUQw13mQQO00bTsy6paL'; 
$config['stripe_publishable_key'] = 'pk_test_51ItymFEtVTguXAiurkx4GXsAXMYsau8qbp40zKlvpY164Ssrb1cNLu7lpAwN0Lsbnn3gb1SbqIXOwL3rRayrbWDh00f7gpWXgw'; 
$config['stripe_currency']        = 'usd';