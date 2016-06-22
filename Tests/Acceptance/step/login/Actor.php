<?php
namespace tests\acceptance\step\login;

class Actor extends \AcceptanceTester
{
    /**
     * Login as user "admin" with password "password".
     *
     * @return void
     */
    public function loginAsAdmin()
    {
        $I = $this;
        $I->login('admin', 'password');
    }

    /**
     * Login as user "editor" with password "passowrd".
     *
     * @return void
     */
    public function loginAsEditor()
    {
        $I = $this;
        $I->login('editor', 'password');
    }

    /**
     * Logout user by clicking logout button in toolbar
     *
     * @return void
     */
    public function logout()
    {
        $I = $this;
        $I->amGoingTo('step backend logout');
        $I->amGoingTo('logout');
        $I->click('#neos-user-actions > div > button');
        $I->click('Logout');
        $I->waitForElement('h1');
        $I->cantSeeElement('#neos-menu-button');
    }

    /**
     * Helper method for user login.
     *
     * @param string $username
     * @param string $password
     */
    protected function login($username, $password)
    {
        $I = $this;
        $I->amGoingTo('Step\Backend\Login username: ' . $username . ' password:' . $password);

        $I->amOnPage('/neos/login');
        $I->see('Login to Neos Demo Site');
        $I->wantTo('Login as admin user');
        $I->fillField('#username', $username);
        $I->fillField('#password', $password);
        $I->click('.neos-actions > button');
        $I->waitForElement('#neos-menu-button', 10);
        $I->see('Neos Demo Site');

        $I->seeInDatabase(
            'typo3_flow_security_account',
            [
                'accountidentifier' => $username
            ]
        );
    }
}
