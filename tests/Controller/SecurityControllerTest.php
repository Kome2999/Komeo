<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginPageDisplaysLoginForm()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Login'); // Assuming you have an h1 element with "Login" on your login page
        $this->assertCount(1, $crawler->filter('form[name="login_form"]')); // Assuming you have a login form with the name "login_form"
    }

    public function testSuccessfulLoginRedirectsToCorrectPage()
    {
        $client = static::createClient();
        $client->request('POST', '/login', ['_username' => 'testuser', '_password' => 'testpassword']);

        $this->assertResponseRedirects('/homepage'); // Replace '/homepage' with the correct URL for the homepage
    }

    public function testFailedLoginShowsErrorMessage()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/login', ['_username' => 'invaliduser', '_password' => 'invalidpassword']);

        $this->assertResponseStatusCodeSame(200);
        $this->assertSelectorTextContains('.alert-danger', 'Invalid credentials.'); // Assuming you show an error message with class "alert-danger" for failed logins
    }
}
