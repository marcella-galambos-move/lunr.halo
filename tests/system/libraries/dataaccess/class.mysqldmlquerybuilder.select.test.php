<?php

/**
 * This file contains the MySQLDMLQueryBuilderSelectTest class.
 *
 * PHP Version 5.3
 *
 * @category   Libraries
 * @package    DataAccess
 * @subpackage Tests
 * @author     M2Mobi <info@m2mobi.com>
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */

namespace Lunr\Libraries\DataAccess;

/**
 * This class contains the tests for the query parts necessary to build
 * select queries.
 *
 * @category   Libraries
 * @package    DataAccess
 * @subpackage Tests
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @covers     Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder
 */
class MySQLDMLQueryBuilderSelectTest extends MySQLDMLQueryBuilderTest
{

    /**
     * Test specifying the SELECT part of a query.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderQueryPartsTest::testInitialSelectNoEscapeNoHex
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderQueryPartsTest::testIncrementalSelectNoEscapeNoHex
     * @covers  Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select
     */
    public function testSelectNoEscape()
    {
        $property = $this->builder_reflection->getProperty('select');
        $property->setAccessible(TRUE);

        $this->builder->select('col', FALSE);

        $this->assertEquals('col', $property->getValue($this->builder));
    }

    /**
     * Test specifying the SELECT part of a query.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderQueryPartsTest::testInitialSelectEscapeNoHex
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderQueryPartsTest::testIncrementalSelectEscapeNoHex
     * @covers  Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select
     */
    public function testSelectEscape()
    {
        $property = $this->builder_reflection->getProperty('select');
        $property->setAccessible(TRUE);

        $this->builder->select('col');

        $this->assertEquals('`col`', $property->getValue($this->builder));
    }

    /**
     * Test fluid interface of the select method.
     *
     * @covers  Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select
     */
    public function testSelectReturnsSelfReference()
    {
        $return = $this->builder->select('col');

        $this->assertInstanceOf('Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder', $return);
        $this->assertSame($this->builder, $return);
    }

    /**
     * Test specifying the SELECT part of a query.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderQueryPartsTest::testInitialSelectNoEscapeHex
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderQueryPartsTest::testIncrementalSelectNoEscapeHex
     * @covers  Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select_hex
     */
    public function testSelectHexNoEscape()
    {
        $property = $this->builder_reflection->getProperty('select');
        $property->setAccessible(TRUE);

        $this->builder->select_hex('col', FALSE);

        $this->assertEquals('HEX(col) AS col', $property->getValue($this->builder));
    }

    /**
     * Test specifying the SELECT part of a query.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderQueryPartsTest::testInitialSelectEscapeHex
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderQueryPartsTest::testIncrementalSelectEscapeHex
     * @covers  Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select_hex
     */
    public function testSelectHexEscape()
    {
        $property = $this->builder_reflection->getProperty('select');
        $property->setAccessible(TRUE);

        $this->builder->select_hex('col');

        $this->assertEquals('HEX(`col`) AS `col`', $property->getValue($this->builder));
    }

    /**
     * Test fluid interface of the select_hex mathod.
     *
     * @covers  Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select_hex
     */
    public function testSelectHexReturnsSelfReference()
    {
        $return = $this->builder->select_hex('col');

        $this->assertInstanceOf('Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder', $return);
        $this->assertSame($this->builder, $return);
    }

    /**
     * Test specifying the SELECT part of a query.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderQueryPartsTest::testFrom
     * @covers  Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::from
     */
    public function testFrom()
    {
        $property = $this->builder_reflection->getProperty('from');
        $property->setAccessible(TRUE);

        $this->builder->from('table');

        $this->assertEquals('FROM `table`', $property->getValue($this->builder));
    }

    /**
     * Test fluid interface of the from method.
     *
     * @covers  Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::from
     */
    public function testFromReturnsSelfReference()
    {
        $return = $this->builder->select_hex('col');

        $this->assertInstanceOf('Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder', $return);
        $this->assertSame($this->builder, $return);
    }

    /**
     * Test that select modes for handling duplicate result entries are handled correctly.
     *
     * @param String $mode valid select mode for handling duplicate entries.
     *
     * @dataProvider selectModesDuplicatesProvider
     * @covers       Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select_mode
     */
    public function testSelectModeSetsDuplicatesCorrectly($mode)
    {
        $property = $this->builder_reflection->getProperty('select_mode');
        $property->setAccessible(TRUE);

        $this->builder->select_mode($mode);

        $modes = $property->getValue($this->builder);

        $this->assertEquals($mode, $modes['duplicates']);
    }

    /**
     * Test that select modes for handling the result cache are handled correctly.
     *
     * @param String $mode valid select mode for handling the cache.
     *
     * @dataProvider selectModesCacheProvider
     * @covers       Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select_mode
     */
    public function testSelectModeSetsCacheCorrectly($mode)
    {
        $property = $this->builder_reflection->getProperty('select_mode');
        $property->setAccessible(TRUE);

        $this->builder->select_mode($mode);

        $modes = $property->getValue($this->builder);

        $this->assertEquals($mode, $modes['cache']);
    }

    /**
     * Test that standard select modes are handled correctly.
     *
     * @param String $mode valid select modes.
     *
     * @dataProvider selectModesStandardProvider
     * @covers       Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select_mode
     */
    public function testSelectModeSetsStandardCorrectly($mode)
    {
        $property = $this->builder_reflection->getProperty('select_mode');
        $property->setAccessible(TRUE);

        $this->builder->select_mode($mode);

        $this->assertContains($mode, $property->getValue($this->builder));
    }

    /**
     * Test that unknown select modes are ignored.
     *
     * @covers Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select_mode
     */
    public function testSelectModeSetsIgnoresUnknownValues()
    {
        $property = $this->builder_reflection->getProperty('select_mode');
        $property->setAccessible(TRUE);

        $this->builder->select_mode('UNSUPPORTED');

        $value = $property->getValue($this->builder);

        $this->assertInternalType('array', $value);
        $this->assertEmpty($value);
    }

    /**
     * Test that there can be only one duplicate handling select mode set.
     *
     * @depends testSelectModeSetsDuplicatesCorrectly
     * @covers  Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select_mode
     */
    public function testSelectModeAllowsOnlyOneDuplicateStatement()
    {
        $property = $this->builder_reflection->getProperty('select_mode');
        $property->setAccessible(TRUE);

        $this->builder->select_mode('ALL');
        $this->builder->select_mode('DISTINCT');

        $modes = $property->getValue($this->builder);

        $this->assertEquals('DISTINCT', $modes['duplicates']);
        $this->assertNotContains('ALL', $modes);
    }

    /**
     * Test that there can be only one cache handling select mode set.
     *
     * @depends testSelectModeSetsCacheCorrectly
     * @covers  Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select_mode
     */
    public function testSelectModeAllowsOnlyOneCacheStatement()
    {
        $property = $this->builder_reflection->getProperty('select_mode');
        $property->setAccessible(TRUE);

        $this->builder->select_mode('SQL_NO_CACHE');
        $this->builder->select_mode('SQL_CACHE');

        $modes = $property->getValue($this->builder);

        $this->assertEquals('SQL_CACHE', $modes['cache']);
        $this->assertNotContains('SQL_NO_CACHE', $modes);
    }

    /**
     * Test fluid interface of the select_mode method.
     *
     * @covers  Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder::select_mode
     */
    public function testSelectModeReturnsSelfReference()
    {
        $return = $this->builder->select_mode('DISTINCT');

        $this->assertInstanceOf('Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder', $return);
        $this->assertSame($this->builder, $return);
    }

}

?>
