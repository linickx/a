
# Simple Oauth Twitter Example

http://www.linickx.com/3608/php-basic-twitter-oauth-example  

## Summary

The plan here was to create a template for users to "log in with twitter" for a web app. The example gets the tokens from twitter, stores them in a mysql DB and then sets some cookies for user authentication.

## Dir Structure

Using the default structure from [Openshift](http://openshift.redhat.com)

```
root  
 |  
 +-> libs  <- functions, libraries, etc  
 |  
 +-> php <- wwwroot, where index.php lives  
 |  
 +--> php/config.php <- mysql & twitter settings  

```

## App Flow

1. User lands on index.php, for the 1st time, no cookies are set and is given a "login with twitter" link
2. twitter.php redirects user to twitter.com to authorization / authentication
3. twitter.com returns tokens to twitter.php
4. twitter.php saves ^above^ tokens in mysql & sets authentication cookies
5. user is redirected back to index.php
6. user has cookie, include homepage.php which checks the cookies and shows the content if successful, if cookies have been tampered with they go back to index.php

## Credz

* @jv2222 for ez_sql
* @jrconlin for OAuthSimple
* Guido Schlabitz for the Oauth Example