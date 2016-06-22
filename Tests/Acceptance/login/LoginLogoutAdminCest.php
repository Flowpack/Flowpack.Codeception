<?php
namespace tests\acceptance\login;

use tests\acceptance\step\login\Actor;

class LoginLogoutAdminCest
{
    public function tryToTest(Actor $I)
    {
        $I->loginAsAdmin();
        $I->logout();
    }
}
