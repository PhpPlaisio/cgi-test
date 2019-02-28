<?php
declare(strict_types=1);

namespace SetBased\Abc\Cgi\Test;

use PHPUnit\Framework\TestCase;
use SetBased\Abc\Abc;
use SetBased\Abc\Exception\InvalidUrlException;

/**
 * Abstract parent class for testing concrete implementations of the Cgi interface.
 *
 * Unit tests for putLeader must be implemented in concrete classes.
 */
abstract class CgiTest extends TestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for both getManFloat and getOptFloat.
   *
   * @param string $method The method to be tested.
   */
  public function baseGetFloat1(string $method): void
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
  public function baseGetFloat2(string $method): void
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
  public function baseGetId1(string $method): void
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
  public function baseGetId2(string $method): void
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
  public function baseGetInt1(string $method): void
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
  public function baseGetInt2(string $method): void
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
  public function baseGetString1(string $method): void
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
   * Returns test cases for method putBool.
   *
   * @return array
   */
  public function casesPutBool(): array
  {
    $cases = [];

    // Test cases for true.
    $cases[] = ['variable'  => 'foo',
                'value'     => true,
                'mandatory' => false,
                'expected'  => '/foo/1'];

    $cases[] = ['variable'  => 'foo',
                'value'     => true,
                'mandatory' => true,
                'expected'  => '/foo/1'];

    // Test cases for false.
    $cases[] = ['variable'  => 'foo',
                'value'     => false,
                'mandatory' => true,
                'expected'  => '/foo/0'];

    $cases[] = ['variable'  => 'foo',
                'value'     => false,
                'mandatory' => false,
                'expected'  => ''];

    // Test cases for null.
    $cases[] = ['variable'  => 'foo',
                'value'     => null,
                'mandatory' => false,
                'expected'  => ''];

    $cases[] = ['variable'  => 'foo',
                'value'     => null,
                'mandatory' => true,
                'expected'  => ''];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Retuns test cases for method putUrl.
   *
   * @return array
   */
  public function casesPutFloat(): array
  {
    return [['variable' => 'foo',
             'value'    => null,
             'expected' => ''],
            ['variable' => 'foo',
             'value'    => 0.0,
             'expected' => '/foo/0'],
            ['variable' => 'foo',
             'value'    => 123.45,
             'expected' => '/foo/123.45']];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns test cases for method putId.
   *
   * @return array
   */
  public function casesPutId(): array
  {
    return [['variable' => 'foo',
             'value'    => null,
             'label'    => 'foo',
             'expected' => ''],
            ['variable' => 'foo',
             'value'    => 0,
             'label'    => 'foo',
             'expected' => '/foo/'.Abc::$abc::obfuscate(0, 'foo')],
            ['variable' => 'foo',
             'value'    => 123,
             'label'    => 'foo',
             'expected' => '/foo/'.Abc::$abc::obfuscate(123, 'foo')]];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns test cases for method putInt.
   *
   * @return array
   */
  public function casesPutInt(): array
  {
    return [['variable' => 'foo',
             'value'    => null,
             'expected' => ''],
            ['variable' => 'foo',
             'value'    => 0,
             'expected' => '/foo/0'],
            ['variable' => 'foo',
             'value'    => 123456,
             'expected' => '/foo/123456']];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns test cases for method putString.
   *
   * @return array
   */
  public function casesPutSlug(): array
  {
    return [['value'    => null,
             'expected' => ''],
            ['value'    => 'Perché l\'erba è verde?',
             'expected' => '/perche-l-erba-e-verde.html']];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns test cases for method putString.
   *
   * @return array
   */
  public function casesPutString(): array
  {
    return $this->casesPutUrl();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns test cases for method putUrl.
   *
   * @return array
   */
  public function casesPutUrl(): array
  {
    return [['variable' => 'foo',
             'value'    => null,
             'expected' => ''],  // Test for empty string.
            ['variable' => 'foo',
             'value'    => '',
             'expected' => ''],  // Test for empty string.
            ['variable' => 'foo',
             'value'    => 'bar',
             'expected' => '/foo/bar'],  // Test for normal string.
            ['variable' => 'foo',
             'value'    => '/',
             'expected' => '/foo/%2F'],  // Test for special characters.
            ['variable' => 'foo',
             'value'    => 'https://www.setbased.nl/',
             'expected' => '/foo/https%3A%2F%2Fwww.setbased.nl%2F']];  // Test for special characters.
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns invalid test cases for method getManUrl.
   *
   * @return array
   */
  public function invalidCasesGetManUrl(): array
  {
    $cases = $this->invalidCasesGetOptUrl();

    // Empty CGI variable: key exists but value is null.
    $cases[] = ['variable'      => 'foo',
                'value'         => null,
                'default'       => null,
                'forceRelative' => true,
                'unset'         => false];

    // Empty CGI variable: key exists but value is empty string.
    $cases[] = ['variable'      => 'foo',
                'value'         => '',
                'default'       => null,
                'forceRelative' => true,
                'unset'         => null];

    // Empty CGI variable: key does not exists.
    $cases[] = ['variable'      => 'foo',
                'value'         => null,
                'default'       => null,
                'forceRelative' => true,
                'unset'         => true];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Retutns invalid test cases for method getOptUrl.
   *
   * @return array
   */
  public function invalidCasesGetOptUrl(): array
  {
    $cases = [];

    // Absolute URL and relative URL is forced.
    $cases[] = ['variable'      => 'foo',
                'value'         => 'https://www.setbased.nl/',
                'default'       => null,
                'forceRelative' => true,
                'unset'         => null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManBool.
   */
  public function testGetManBool1(): void
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
   */
  public function testGetManBool2(): void
  {
    $_GET['foo'] = 'hello, world';

    $this->expectException(InvalidUrlException::class);
    Abc::$cgi->getManBool('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case empty value.
   */
  public function testGetManBool3()
  {
    $_GET['foo'] = '';

    $this->expectException(InvalidUrlException::class);
    Abc::$cgi->getManBool('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case missing value.
   */
  public function testGetManBool4()
  {
    unset($_GET['foo']);

    $this->expectException(InvalidUrlException::class);
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
   */
  public function testGetManFloat2()
  {
    $this->expectException(InvalidUrlException::class);
    $this->baseGetFloat2('getManFloat');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   */
  public function testGetManFloat3()
  {
    $_GET['foo'] = '';

    $this->expectException(InvalidUrlException::class);
    Abc::$cgi->getManFloat('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   */
  public function testGetManFloat4()
  {
    unset($_GET['foo']);

    $this->expectException(InvalidUrlException::class);
    Abc::$cgi->getManFloat('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   */
  public function testGetManFloat5()
  {
    $_GET['foo'] = 'qwerty';

    $this->expectException(InvalidUrlException::class);
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
   */
  public function testGetManId2()
  {
    $this->expectException(\Exception::class);
    $this->baseGetId2('getManId');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManId.
   */
  public function testGetManId3()
  {
    $_GET['foo'] = '';

    $this->expectException(\Exception::class);
    Abc::$cgi->getManId('foo', 'bar');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManId.
   */
  public function testGetManId4()
  {
    unset($_GET['foo']);

    $this->expectException(\Exception::class);
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
   */
  public function testGetManInt2()
  {
    $this->expectException(InvalidUrlException::class);
    $this->baseGetInt2('getManInt');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   */
  public function testGetManInt3()
  {
    $_GET['foo'] = '';

    $this->expectException(InvalidUrlException::class);
    Abc::$cgi->getManInt('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   */
  public function testGetManInt4()
  {
    unset($_GET['foo']);

    $this->expectException(InvalidUrlException::class);
    Abc::$cgi->getManInt('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   */
  public function testGetManInt5()
  {
    $_GET['foo'] = 'qwerty';

    $this->expectException(InvalidUrlException::class);
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
   */
  public function testGetManString2()
  {
    $_GET['foo'] = '';

    $this->expectException(InvalidUrlException::class);
    Abc::$cgi->getManString('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case empty value.
   */
  public function testGetManString3()
  {
    $_GET['foo'] = null;

    $this->expectException(InvalidUrlException::class);
    Abc::$cgi->getManString('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case empty value.
   */
  public function testGetManString4()
  {
    unset($_GET['foo']);

    $this->expectException(InvalidUrlException::class);
    Abc::$cgi->getManString('foo');
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
   */
  public function testGetOptBool2()
  {
    $_GET['foo'] = 'hello, world';

    $this->expectException(InvalidUrlException::class);
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
   */
  public function testGetOptFloat2()
  {
    $this->expectException(InvalidUrlException::class);
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
   */
  public function testGetOptId2()
  {
    $this->expectException(\Exception::class);
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
   */
  public function testGetOptInt2()
  {
    $this->expectException(InvalidUrlException::class);
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
   * Valid test cases for getManUrl.
   *
   * @param string      $variable      The name of the CGI variable.
   * @param string|null $value         The value of the CGI variable.
   * @param string|null $default       The default value.
   * @param bool        $forceRelative The force relative flag.
   * @param bool|null   $unset         If true the CGI variable will be unset.
   *
   * @dataProvider invalidCasesGetManUrl
   */
  public function testInvalidGetManUrl(string $variable,
                                       ?string $value,
                                       ?string $default,
                                       bool $forceRelative,
                                       ?bool $unset)
  {
    if ($unset)
    {
      unset($_GET[$variable]);
    }
    else
    {
      $_GET[$variable] = $value;
    }

    $this->expectException(InvalidUrlException::class);
    Abc::$cgi->getManUrl($variable, $default, $forceRelative);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Valid test cases for getOptUrl.
   *
   * @param string      $variable      The name of the CGI variable.
   * @param string|null $value         The value of the CGI variable.
   * @param string|null $default       The default value.
   * @param bool        $forceRelative The force relative flag.
   * @param bool|null   $unset         If true the CGI variable will be unset.
   *
   * @dataProvider invalidCasesGetOptUrl
   */
  public function testInvalidGetOptUrl(string $variable,
                                       ?string $value,
                                       ?string $default,
                                       bool $forceRelative,
                                       ?bool $unset)
  {
    if ($unset)
    {
      unset($_GET[$variable]);
    }
    else
    {
      $_GET[$variable] = $value;
    }

    $this->expectException(InvalidUrlException::class);
    Abc::$cgi->getOptUrl($variable, $default, $forceRelative);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for putCgiBool.
   *
   * @param string    $variable  The name of the CGI variable.
   * @param bool|null $value     The value of the CGI variable.
   * @param bool      $mandatory The mandatory flag.
   * @param string    $expected  The expected result.
   *
   * @dataProvider casesPutBool
   */
  public function testPutBool(string $variable, ?bool $value, bool $mandatory, string $expected): void
  {
    $part = Abc::$cgi->putBool($variable, $value, $mandatory);
    self::assertSame($expected, $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * test cases for putCgiFloat.
   *
   * @param string     $variable The name of the CGI variable.
   * @param float|null $value    The value of the CGI variable.
   * @param string     $expected The expected result.
   *
   * @dataProvider casesPutFloat
   */
  public function testPutFloat(string $variable, ?float $value, string $expected): void
  {
    $part = Abc::$cgi->putFloat($variable, $value);
    self::assertSame($expected, $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for putId.
   *
   * @param string      $variable The name of the CGI variable.
   * @param int|null    $value    The value of the CGI variable.
   * @param string|null $label    The alias for the column holding database ID.
   * @param string      $expected The expected result.
   *
   * @dataProvider casesPutId
   */
  public function testPutId(string $variable, ?int $value, ?string $label, string $expected): void
  {
    $part = Abc::$cgi->putId($variable, $value, $label);
    self::assertSame($expected, $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for putInt.
   *
   * @param string   $variable The name of the CGI variable.
   * @param int|null $value    The value of the CGI variable.
   * @param string   $expected The expected result.
   *
   * @dataProvider casesPutInt
   */
  public function testPutInt(string $variable, ?int $value, string $expected): void
  {
    $part = Abc::$cgi->putInt($variable, $value);
    self::assertSame($expected, $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for putSlugName.
   *
   * @param string|null $value    The value of the CGI variable.
   * @param string      $expected The expected result.
   *
   * @dataProvider casesPutSlug
   */
  public function testPutSlugName(?string $value, string $expected): void
  {
    $part = Abc::$cgi->putSlugName($value);
    self::assertSame($expected, $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for putString.
   *
   * @param string      $variable The name of the CGI variable.
   * @param string|null $value    The value of the CGI variable.
   * @param string      $expected The expected result.
   *
   * @dataProvider casesPutString
   */
  public function testPutString(string $variable, ?string $value, string $expected): void
  {
    $part = Abc::$cgi->putUrl($variable, $value);
    self::assertSame($expected, $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for putUrl.
   *
   * @param string      $variable The name of the CGI variable.
   * @param string|null $value    The value of the CGI variable.
   * @param string      $expected The expected result.
   *
   * @dataProvider casesPutUrl
   */
  public function testPutUrl(string $variable, ?string $value, string $expected): void
  {
    $part = Abc::$cgi->putUrl($variable, $value);
    self::assertSame($expected, $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Valid test cases for getManUrl.
   *
   * @param string      $variable      The name of the CGI variable.
   * @param string|null $value         The value of the CGI variable.
   * @param string|null $default       The default value.
   * @param bool        $forceRelative The force relative flag.
   * @param string      $expected      The expected result.
   *
   * @dataProvider validCasesGetManUrl
   */
  public function testValidGetManUrl(string $variable,
                                     ?string $value,
                                     ?string $default,
                                     bool $forceRelative,
                                     string $expected)
  {
    $_GET[$variable] = $value;
    $url             = Abc::$cgi->getManUrl($variable, $default, $forceRelative);
    self::assertSame($expected, $url);

    if ($value===null)
    {
      unset($_GET[$variable]);
      $url = Abc::$cgi->getManUrl($variable, $default, $forceRelative);
      self::assertSame($expected, $url);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptUrl.
   *
   * @param string      $variable      The name of the CGI variable.
   * @param string|null $value         The value of the CGI variable.
   * @param string|null $default       The default value.
   * @param bool        $forceRelative The force relative flag.
   * @param string|null $expected      The expected result.
   *
   * @dataProvider validCasesGetOptUrl
   */
  public function testValidGetOptUrl(string $variable,
                                     ?string $value,
                                     ?string $default,
                                     bool $forceRelative,
                                     ?string $expected)
  {
    $_GET[$variable] = $value;
    $url             = Abc::$cgi->getOptUrl($variable, $default, $forceRelative);
    self::assertSame($expected, $url);

    if ($value===null)
    {
      unset($_GET[$variable]);
      $url = Abc::$cgi->getOptUrl($variable, $default, $forceRelative);
      self::assertSame($expected, $url);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Retutns valid test cases for method getManUrl.
   *
   * @return array
   */
  public function validCasesGetManUrl(): array
  {
    $cases = [];

    // Test for null with default.
    $cases[] = ['variable'      => 'foo',
                'value'         => null,
                'default'       => '/bar',
                'forceRelative' => true,
                'expected'      => '/bar'];

    // Tests for special characters.
    $cases[] = ['variable'      => 'foo',
                'value'         => '/',
                'default'       => null,
                'forceRelative' => true,
                'expected'      => '/'];

    $cases[] = ['variable'      => 'foo',
                'value'         => 'https://www.setbased.nl/',
                'default'       => null,
                'forceRelative' => false,
                'expected'      => 'https://www.setbased.nl/'];

    // Test for special characters with default.
    $cases[] = ['variable'      => 'foo',
                'value'         => '/',
                'default'       => 'spam',
                'forceRelative' => true,
                'expected'      => '/'];

    $cases[] = ['variable'      => 'foo',
                'value'         => 'https://www.setbased.nl/',
                'default'       => 'spam',
                'forceRelative' => false,
                'expected'      => 'https://www.setbased.nl/'];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns valid test cases for method getManUrl.
   *
   * @return array
   */
  public function validCasesGetOptUrl(): array
  {
    $cases = $this->validCasesGetManUrl();

    // Test for null.
    $cases[] = ['variable'      => 'foo',
                'value'         => null,
                'default'       => null,
                'forceRelative' => true,
                'expected'      => null];

    // Test for null with default.
    $cases[] = ['variable'      => 'foo',
                'value'         => null,
                'default'       => '/bar',
                'forceRelative' => true,
                'expected'      => '/bar'];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
