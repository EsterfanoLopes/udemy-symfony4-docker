<?php
/**
 * Created by PhpStorm.
 * User: esterfano
 * Date: 28/11/18
 * Time: 14:23
 */

namespace App\Tests\Security;

use App\Security\TokenGenerator;
use PHPUnit\Framework\TestCase;

class TokenGeneratorTest extends TestCase
{
    public function testTokenGeneration()
    {
        $tokenGen = new TokenGenerator();
        $token = $tokenGen->getRandomSecureToken(30);

        $this->assertEquals(30, strlen($token));
        $this->assertTrue(ctype_alnum($token), 'Token contains incorrect characters.');
    }
}