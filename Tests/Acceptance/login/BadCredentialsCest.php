<?php
namespace tests\acceptance\login;

use tests\acceptance\step\login\Actor;

class BadCredentialsCest
{

    public function tryToTest(Actor $I)
    {
        $I->wantTo('check login functions');
        $I->amOnPage('/neos/login');
        $I->waitForElement('#username');

        $I->wantTo('check empty credentials');
        $required = $I->executeInSelenium(function (\Facebook\WebDriver\Remote\RemoteWebDriver $webdriver) {
            return $webdriver->findElement(\WebDriverBy::cssSelector('#username'))->getAttribute('required');
        });
        $I->assertEquals('true', $required, '#username');

        $required = $I->executeInSelenium(function (\Facebook\WebDriver\Remote\RemoteWebDriver $webdriver) {
            return $webdriver->findElement(\WebDriverBy::cssSelector('#password'))->getAttribute('required');
        });
        $I->assertEquals('true', $required, '#password');

        $I->wantTo('use bad credentials');
        $I->fillField('#username', 'neos');
        $I->fillField('#password', 'thisisnot');
        $I->click('.neos-actions > button');
        $I->waitForElement('.neos-tooltip-inner');
        $I->see('The entered username or password was wrong');
    }
}
