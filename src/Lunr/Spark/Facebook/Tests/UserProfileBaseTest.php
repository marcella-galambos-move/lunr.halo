<?php

/**
 * This file contains the UserProfileBaseTest class.
 *
 * PHP Version 5.4
 *
 * @package    Lunr\Spark\Facebook
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013-2014, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Lunr\Spark\Facebook\Tests;

use Lunr\Halo\PsrLoggerTestTrait;

/**
 * This class contains the tests for the Facebook UserProfile class.
 *
 * @covers Lunr\Spark\Facebook\UserProfile
 */
class UserProfileBaseTest extends UserProfileTest
{

    use PsrLoggerTestTrait;

    /**
     * Test that the CentralAuthenticationStore class is passed correctly.
     */
    public function testCasIsSetCorrectly()
    {
        $this->assertPropertySame('cas', $this->cas);
    }

    /**
     * Test that the Curl class is passed correctly.
     */
    public function testCurlIsSetCorrectly()
    {
        $this->assertPropertySame('curl', $this->curl);
    }

}

?>
