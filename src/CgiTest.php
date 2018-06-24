<?php

namespace SetBased\Abc\Cgi\Test;

use PHPUnit\Framework\TestCase;
use SetBased\Abc\Abc;

/**
 * Abstract parent class for testing concrete implementations of the Cgi interface.
 *
 * Unit tests for putLeader must be implemented in concrete classes.
 */
abstract class CgiTest extends TestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   *Test cases for both getManFloat and getOptFloat.
   *
   * @param string $method The method to be tested.
   */
  public function baseGetFloat1($method)
  {
    // Test for null with default.
    $_GET['foo'] = null;
    $value       = Abc::$cgi->$method('foo', 123.45);
    self::assertSame(123.45, $value);

    unset($_GET['foo']);
    $value = Abc::$cgi->$method('foo', 123.45);
    self::assertSame(123.45, $value);

    // Test with value.
    $_GET['foo'] = 3.14;
    $value       = Abc::$cgi->$method('foo');
    self::assertSame(3.14, $value);

    $_GET['foo'] = '3.14';
    $value       = Abc::$cgi->$method('foo');
    self::assertSame(3.14, $value);

    $_GET['foo'] = 2.71;
    $value       = Abc::$cgi->$method('foo', 123.45);
    self::assertSame(2.71, $value);

    $_GET['foo'] = '2.71';
    $value       = Abc::$cgi->$method('foo', 123.45);
    self::assertSame(2.71, $value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   *Test cases for both getManFloat and getOptFloat.
   *
   * @param string $method The method to be tested.
   */
  public function baseGetFloat2($method)
  {
    $_GET['foo'] = 'hello';
    Abc::$cgi->$method('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   *Test cases for both getManId and getOptId.
   *
   * @param string $method The method to be tested.
   */
  public function baseGetId1($method)
  {
    // Test for null with default.
    $_GET['foo'] = null;
    $value       = Abc::$cgi->$method('foo', 'bar', 123);
    self::assertSame(123, $value);

    unset($_GET['foo']);
    $value = Abc::$cgi->$method('foo', 'bar', 123);
    self::assertSame(123, $value);

    // Test with value.
    $_GET['foo'] = Abc::$abc::obfuscate(3, 'bar');
    $value       = Abc::$cgi->$method('foo', 'bar');
    self::assertSame(3, $value);

    $_GET['foo'] = Abc::$abc::obfuscate(2, 'bar');
    $value       = Abc::$cgi->$method('foo', 'bar', 123);
    self::assertSame(2, $value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   *Test cases for both getManInt and getOptInt.
   *
   * @param string $method The method to be tested.
   */
  public function baseGetId2($method)
  {
    $_GET['foo'] = 'hello';
    Abc::$cgi->$method('foo', 'bar');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   *Test cases for both getManInt and getOptint.
   *
   * @param string $method The method to be tested.
   */
  public function baseGetInt1($method)
  {
    // Test for null with default.
    $_GET['foo'] = null;
    $value       = Abc::$cgi->$method('foo', 123);
    self::assertSame(123, $value);

    unset($_GET['foo']);
    $value = Abc::$cgi->$method('foo', 123);
    self::assertSame(123, $value);

    // Test with value.
    $_GET['foo'] = 3;
    $value       = Abc::$cgi->$method('foo');
    self::assertSame(3, $value);

    $_GET['foo'] = '3';
    $value       = Abc::$cgi->$method('foo');
    self::assertSame(3, $value);

    $_GET['foo'] = 2;
    $value       = Abc::$cgi->$method('foo', 123);
    self::assertSame(2, $value);

    $_GET['foo'] = '2';
    $value       = Abc::$cgi->$method('foo', 123);
    self::assertSame(2, $value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   *Test cases for both getManInt and getOptInt.
   *
   * @param string $method The method to be tested.
   */
  public function baseGetInt2($method)
  {
    $_GET['foo'] = 'hello';
    Abc::$cgi->$method('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for both getManString and getOptString.
   *
   * @param string $method The method to be tested.
   */
  public function baseGetString1($method)
  {
    // Test for null with default.
    $_GET['foo'] = null;
    $value       = Abc::$cgi->$method('foo', 'bar');
    self::assertSame('bar', $value);

    unset($_GET['foo']);
    $value = Abc::$cgi->$method('foo', 'bar');
    self::assertSame('bar', $value);

    // Test for empty string with default.
    $_GET['foo'] = '';
    $value       = Abc::$cgi->$method('foo', 'bar');
    self::assertSame('bar', $value);

    // Test for normal string.
    $_GET['foo'] = 'bar';
    $value       = Abc::$cgi->$method('foo');
    self::assertSame('bar', $value);

    // Test for normal string with default.
    $_GET['foo'] = 'bar';
    $value       = Abc::$cgi->$method('foo', 'eggs');
    self::assertSame('bar', $value);

    // Test for special characters.
    $_GET['foo'] = '/';
    $value       = Abc::$cgi->$method('foo');
    self::assertSame('/', $value);

    $_GET['foo'] = 'https://www.setbased.nl/';
    $value       = Abc::$cgi->$method('foo');
    self::assertSame('https://www.setbased.nl/', $value);

    // Test for special characters with default.
    $_GET['foo'] = '/';
    $value       = Abc::$cgi->$method('foo', 'spam');
    self::assertSame('/', $value);

    $_GET['foo'] = 'https://www.setbased.nl/';
    $value       = Abc::$cgi->$method('foo', 'spam');
    self::assertSame('https://www.setbased.nl/', $value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   *Test cases for both getManUrl and getOptUrl.
   *
   * @param string $method The method to be tested.
   */
  public function baseGetUrl1($method)
  {
    // Test for null with default.
    $_GET['foo'] = null;
    $value       = Abc::$cgi->$method('foo', '/bar');
    self::assertSame('/bar', $value);

    unset($_GET['foo']);
    $value = Abc::$cgi->$method('foo', '/bar');
    self::assertSame('/bar', $value);

    // Test for special characters.
    $_GET['foo'] = '/';
    $value       = Abc::$cgi->$method('foo');
    self::assertSame('/', $value);

    $_GET['foo'] = 'https://www.setbased.nl/';
    $value       = Abc::$cgi->$method('foo', null, false);
    self::assertSame('https://www.setbased.nl/', $value);

    // Test for special characters with default.
    $_GET['foo'] = '/';
    $value       = Abc::$cgi->$method('foo', 'spam');
    self::assertSame('/', $value);

    $_GET['foo'] = 'https://www.setbased.nl/';
    $value       = Abc::$cgi->$method('foo', 'spam', false);
    self::assertSame('https://www.setbased.nl/', $value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   *Test cases for both getManUrl and getOptUrl.
   *
   * @param string $method The method to be tested.
   */
  public function baseGetUrl2($method)
  {
    $_GET['foo'] = 'https://www.setbased.nl/';
    Abc::$cgi->$method('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManBool.
   */
  public function testGetManBool1()
  {
    // Tests for true.
    $_GET['foo'] = '1';
    $value       = Abc::$cgi->getManBool('foo');
    self::assertSame(true, $value);

    $_GET['foo'] = null;
    $value       = Abc::$cgi->getManBool('foo', true);
    self::assertSame(true, $value);

    unset($_GET['foo']);
    $value = Abc::$cgi->getManBool('foo', true);
    self::assertSame(true, $value);

    // Tests for false.
    $_GET['foo'] = '0';
    $value       = Abc::$cgi->getManBool('foo');
    self::assertSame(false, $value);

    $_GET['foo'] = null;
    $value       = Abc::$cgi->getManBool('foo', false);
    self::assertSame(false, $value);

    unset($_GET['foo']);
    $value = Abc::$cgi->getManBool('foo', false);
    self::assertSame(false, $value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case none boolean value.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManBool2()
  {
    $_GET['foo'] = 'hello, world';
    Abc::$cgi->getManBool('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case empty value.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManBool3()
  {
    $_GET['foo'] = '';
    Abc::$cgi->getManBool('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case missing value.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManBool4()
  {
    unset($_GET['foo']);
    Abc::$cgi->getManBool('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   */
  public function testGetManFloat1()
  {
    $this->baseGetFloat1('getManFloat');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManFloat2()
  {
    $this->baseGetFloat2('getManFloat');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManFloat3()
  {
    $_GET['foo'] = '';
    Abc::$cgi->getManFloat('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManFloat4()
  {
    unset($_GET['foo']);
    Abc::$cgi->getManFloat('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManFloat5()
  {
    $_GET['foo'] = 'qwerty';
    Abc::$cgi->getManFloat('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManId.
   */
  public function testGetManId1()
  {
    $this->baseGetId1('getManId');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManId.
   *
   * @expectedException \Exception
   */
  public function testGetManId2()
  {
    $this->baseGetId2('getManId');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManId.
   *
   * @expectedException \Exception
   */
  public function testGetManId3()
  {
    $_GET['foo'] = '';
    Abc::$cgi->getManId('foo', 'bar');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManId.
   *
   * @expectedException \Exception
   */
  public function testGetManId4()
  {
    unset($_GET['foo']);
    Abc::$cgi->getManId('foo', 'bar');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   */
  public function testGetManInt1()
  {
    $this->baseGetInt1('getManInt');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManInt2()
  {
    $this->baseGetInt2('getManInt');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManInt3()
  {
    $_GET['foo'] = '';
    Abc::$cgi->getManInt('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManInt4()
  {
    unset($_GET['foo']);
    Abc::$cgi->getManInt('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManInt5()
  {
    $_GET['foo'] = 'qwerty';
    Abc::$cgi->getManInt('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManString.
   */
  public function testGetManString()
  {
    $this->baseGetString1('getManString');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case empty value.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManString2()
  {
    $_GET['foo'] = '';
    Abc::$cgi->getManString('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case empty value.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManString3()
  {
    $_GET['foo'] = null;
    Abc::$cgi->getManString('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case empty value.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManString4()
  {
    unset($_GET['foo']);
    Abc::$cgi->getManString('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManUrl.
   */
  public function testGetManUrl1()
  {
    $this->baseGetUrl1('getManUrl');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManUrl.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManUrl2()
  {
    $this->baseGetUrl2('getManUrl');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case empty value.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManUrl3()
  {
    $_GET['foo'] = '';
    Abc::$cgi->getManUrl('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case missing value.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetManUrl4()
  {
    unset($_GET['foo']);
    Abc::$cgi->getManUrl('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptBool.
   */
  public function testGetOptBool1()
  {
    // Tests for true.
    $_GET['foo'] = '1';
    $value       = Abc::$cgi->getOptBool('foo');
    self::assertSame(true, $value);

    $_GET['foo'] = null;
    $value       = Abc::$cgi->getOptBool('foo', true);
    self::assertSame(true, $value);

    unset($_GET['foo']);
    $value = Abc::$cgi->getOptBool('foo', true);
    self::assertSame(true, $value);

    // Tests for false.
    $_GET['foo'] = '0';
    $value       = Abc::$cgi->getOptBool('foo');
    self::assertSame(false, $value);

    $_GET['foo'] = null;
    $value       = Abc::$cgi->getOptBool('foo', false);
    self::assertSame(false, $value);

    unset($_GET['foo']);
    $value = Abc::$cgi->getOptBool('foo', false);
    self::assertSame(false, $value);

    // Tests for null.
    $_GET['foo'] = null;
    $value       = Abc::$cgi->getOptBool('foo');
    self::assertNull($value);

    unset($_GET['foo']);
    $value = Abc::$cgi->getOptBool('foo');
    self::assertNull($value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case none boolean value.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetOptBool2()
  {
    $_GET['foo'] = 'hello, world';
    Abc::$cgi->getOptBool('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptFloat.
   */
  public function testGetOptFloat1()
  {
    $this->baseGetFloat1('getOptFloat');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptFloat.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetOptFloat2()
  {
    $this->baseGetFloat2('getOptFloat');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptId.
   */
  public function testGetOptId1()
  {
    $this->baseGetId1('getOptId');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptId.
   *
   * @expectedException \Exception
   */
  public function testGetOptId2()
  {
    $this->baseGetId2('getOptId');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptInt.
   */
  public function testGetOptInt1()
  {
    $this->baseGetInt1('getOptInt');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptInt.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetOptInt2()
  {
    $this->baseGetInt2('getOptInt');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptString.
   */
  public function testGetOptString1()
  {
    $this->baseGetString1('getOptString');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptString.
   */
  public function testGetOptString2()
  {
    // Test for null.
    $_GET['foo'] = null;
    $value       = Abc::$cgi->getOptString('foo');
    self::assertNull($value);

    unset($_GET['foo']);
    $value = Abc::$cgi->getOptString('foo');
    self::assertNull($value);

    // Test for empty string.
    $_GET['foo'] = '';
    $value       = Abc::$cgi->getOptString('foo');
    self::assertNull($value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptUrl.
   */
  public function testGetOptUrl1()
  {
    $this->baseGetUrl1('getOptUrl');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptUrl.
   *
   * @expectedException \SetBased\Abc\Exception\InvalidUrlException
   */
  public function testGetOptUrl2()
  {
    $this->baseGetUrl2('getOptUrl');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptUrl.
   */
  public function testGetOptUrl3()
  {
    // Test for null.
    $_GET['foo'] = null;
    $value       = Abc::$cgi->getOptUrl('foo');
    self::assertNull($value);

    unset($_GET['foo']);
    $value = Abc::$cgi->getOptUrl('foo');
    self::assertNull($value);

    // Test for null with default.
    $_GET['foo'] = null;
    $value       = Abc::$cgi->getOptUrl('foo', '/bar');
    self::assertSame('/bar', $value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for putCgiBool.
   */
  public function testPutBool1()
  {
    // Tests for true.
    $part = Abc::$cgi->putBool('foo', true);
    self::assertSame('/foo/1', $part);

    // Tests for false.
    $part = Abc::$cgi->putBool('foo', false);
    self::assertSame('/foo/0', $part);

    $part = Abc::$cgi->putBool('foo', null);
    self::assertSame('', $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * test cases for putCgiFloat.
   */
  public function testPutFloat1()
  {
    // Tests for true.
    $part = Abc::$cgi->putFloat('foo', 123.45);
    self::assertSame('/foo/123.45', $part);

    // Tests for false.
    $part = Abc::$cgi->putFloat('foo', false);
    self::assertSame('/foo/0', $part);

    $part = Abc::$cgi->putFloat('foo', null);
    self::assertSame('', $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for putString.
   */
  public function testPutId()
  {
    // Test for null.
    $part = Abc::$cgi->putId('foo', null, 'foo');
    self::assertSame('', $part);

    // Test for normal string.
    $part = Abc::$cgi->putId('foo', 123, 'foo');
    self::assertSame('/foo/'.Abc::$abc::obfuscate(123, 'foo'), $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for putInt.
   */
  public function testPutInt()
  {
    // Test for null.
    $part = Abc::$cgi->putInt('foo', null);
    self::assertSame('', $part);

    // Test for normal int.
    $part = Abc::$cgi->putInt('foo', 123456);
    self::assertSame('/foo/123456', $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for putSlugName.
   */
  public function testPutSlugName1()
  {
    $part = Abc::$cgi->putSlugName('Perché l\'erba è verde?');
    self::assertSame('/perche-l-erba-e-verde.html', $part);

    $part = Abc::$cgi->putSlugName(null);
    self::assertSame('', $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for putString.
   */
  public function testPutString1()
  {
    // Test for null.
    $part = Abc::$cgi->putString('foo', null);
    self::assertSame('', $part);

    // Test for empty string.
    $part = Abc::$cgi->putString('foo', '');
    self::assertSame('', $part);

    // Test for normal string.
    $part = Abc::$cgi->putString('foo', 'bar');
    self::assertSame('/foo/bar', $part);

    // Test for special characters.
    $part = Abc::$cgi->putString('foo', '/');
    self::assertSame('/foo/%2F', $part);

    // Test for special characters.
    $part = Abc::$cgi->putString('foo', 'https://www.setbased.nl/');
    self::assertSame('/foo/https%3A%2F%2Fwww.setbased.nl%2F', $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for putUrl.
   */
  public function testPutUrl()
  {
    // Test for null.
    $part = Abc::$cgi->putUrl('foo', null);
    self::assertSame('', $part);

    // Test for empty string.
    $part = Abc::$cgi->putUrl('foo', '');
    self::assertSame('', $part);

    // Test for normal string.
    $part = Abc::$cgi->putUrl('foo', 'bar');
    self::assertSame('/foo/bar', $part);

    // Test for special characters.
    $part = Abc::$cgi->putUrl('foo', '/');
    self::assertSame('/foo/%2F', $part);

    // Test for special characters.
    $part = Abc::$cgi->putUrl('foo', 'https://www.setbased.nl/');
    self::assertSame('/foo/https%3A%2F%2Fwww.setbased.nl%2F', $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
