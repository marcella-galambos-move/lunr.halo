<?php

/**
 * This file contains the LunrBaseTestCaseReflectionTest class.
 *
 * SPDX-FileCopyrightText: Copyright 2018 M2mobi B.V., Amsterdam, The Netherlands
 * SPDX-FileCopyrightText: Copyright 2022 Move Agency Group B.V., Zwolle, The Netherlands
 * SPDX-License-Identifier: MIT
 */

namespace Lunr\Halo\Tests;

use ReflectionMethod;
use ReflectionProperty;

/**
 * This class contains the tests for the unit test base class.
 *
 * @covers Lunr\Halo\LunrBaseTestCase
 */
class LunrBaseTestCaseReflectionTest extends LunrBaseTestCaseTestCase
{

    /**
     * Test getReflectionMethod()
     *
     * @covers Lunr\Halo\LunrBaseTestCase::getReflectionMethod
     */
    public function testGetReflectionMethod(): void
    {
        $method = $this->getReflectionMethod('baz');

        $this->assertInstanceOf(ReflectionMethod::class, $method);
        $this->assertEquals('baz', $method->name);
    }

    /**
     * Test getReflectionProperty()
     *
     * @covers Lunr\Halo\LunrBaseTestCase::getReflectionProperty
     */
    public function testGetReflectionProperty(): void
    {
        $property = $this->getReflectionProperty('foo');

        $this->assertInstanceOf(ReflectionProperty::class, $property);
        $this->assertEquals('foo', $property->name);
    }

    /**
     * Test getReflectionPropertyValue()
     *
     * @covers Lunr\Halo\LunrBaseTestCase::getReflectionPropertyValue
     */
    public function testGetReflectionPropertyValue(): void
    {
        $value = $this->getReflectionPropertyValue('foo');

        $this->assertEquals('bar', $value);
    }

    /**
     * Test setReflectionPropertyValue()
     *
     * @covers Lunr\Halo\LunrBaseTestCase::setReflectionPropertyValue
     */
    public function testSetReflectionPropertyValue(): void
    {
        $this->setReflectionPropertyValue('foo', 'foo');

        $value = $this->getReflectionPropertyValue('foo');

        $this->assertEquals('foo', $value);
    }

}

?>
