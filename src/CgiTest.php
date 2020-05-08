<?php
declare(strict_types=1);

namespace Plaisio\Cgi\Test;

use PHPUnit\Framework\TestCase;
use Plaisio\Exception\InvalidUrlException;
use Plaisio\Kernel\Nub;

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
    $value       = Nub::$nub->cgi->$method('foo', 123.45);
    self::assertSame(123.45, $value);

    unset($_GET['foo']);
    $value = Nub::$nub->cgi->$method('foo', 123.45);
    self::assertSame(123.45, $value);

    // Test with value.
    $_GET['foo'] = 3.14;
    $value       = Nub::$nub->cgi->$method('foo');
    self::assertSame(3.14, $value);

    $_GET['foo'] = '3.14';
    $value       = Nub::$nub->cgi->$method('foo');
    self::assertSame(3.14, $value);

    $_GET['foo'] = 2.71;
    $value       = Nub::$nub->cgi->$method('foo', 123.45);
    self::assertSame(2.71, $value);

    $_GET['foo'] = '2.71';
    $value       = Nub::$nub->cgi->$method('foo', 123.45);
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
    Nub::$nub->cgi->$method('foo');
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
    $value       = Nub::$nub->cgi->$method('foo', 'bar', 123);
    self::assertSame(123, $value);

    unset($_GET['foo']);
    $value = Nub::$nub->cgi->$method('foo', 'bar', 123);
    self::assertSame(123, $value);

    // Test with value.
    $_GET['foo'] = Nub::$nub->obfuscate(3, 'bar');
    $value       = Nub::$nub->cgi->$method('foo', 'bar');
    self::assertSame(3, $value);

    $_GET['foo'] = Nub::$nub->obfuscate(2, 'bar');
    $value       = Nub::$nub->cgi->$method('foo', 'bar', 123);
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
    Nub::$nub->cgi->$method('foo', 'bar');
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
    $value       = Nub::$nub->cgi->$method('foo', 123);
    self::assertSame(123, $value);

    unset($_GET['foo']);
    $value = Nub::$nub->cgi->$method('foo', 123);
    self::assertSame(123, $value);

    // Test with value.
    $_GET['foo'] = 3;
    $value       = Nub::$nub->cgi->$method('foo');
    self::assertSame(3, $value);

    $_GET['foo'] = '3';
    $value       = Nub::$nub->cgi->$method('foo');
    self::assertSame(3, $value);

    $_GET['foo'] = 2;
    $value       = Nub::$nub->cgi->$method('foo', 123);
    self::assertSame(2, $value);

    $_GET['foo'] = '2';
    $value       = Nub::$nub->cgi->$method('foo', 123);
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
    Nub::$nub->cgi->$method('foo');
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
   * Returns test cases for method putUrl.
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
             'expected' => '/foo/'.Nub::$nub->obfuscate(0, 'foo')],
            ['variable' => 'foo',
             'value'    => 123,
             'label'    => 'foo',
             'expected' => '/foo/'.Nub::$nub->obfuscate(123, 'foo')]];
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
  public function invalidCasesGetManString(): array
  {
    $cases = $this->invalidCasesGetOptString();

    // Empty values.
    $cases[] = ['variable' => 'foo',
                'value'    => '',
                'unset'    => null];

    $cases[] = ['variable' => 'foo',
                'value'    => null,
                'unset'    => false];

    $cases[] = ['variable' => 'foo',
                'value'    => null,
                'unset'    => true];

    return $cases;
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
   * Returns invalid test cases for method getOptUrl.
   *
   * @return array
   */
  public function invalidCasesGetOptString(): array
  {
    $cases = [];

    // A resource can not be casted to a string.
    $cases[] = ['variable' => 'foo',
                'value'    => fopen('php://stdin', 'r'),
                'unset'    => null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns invalid test cases for method getOptUrl.
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
    $value       = Nub::$nub->cgi->getManBool('foo');
    self::assertSame(true, $value);

    $_GET['foo'] = null;
    $value       = Nub::$nub->cgi->getManBool('foo', true);
    self::assertSame(true, $value);

    unset($_GET['foo']);
    $value = Nub::$nub->cgi->getManBool('foo', true);
    self::assertSame(true, $value);

    // Tests for false.
    $_GET['foo'] = '0';
    $value       = Nub::$nub->cgi->getManBool('foo');
    self::assertSame(false, $value);

    $_GET['foo'] = null;
    $value       = Nub::$nub->cgi->getManBool('foo', false);
    self::assertSame(false, $value);

    unset($_GET['foo']);
    $value = Nub::$nub->cgi->getManBool('foo', false);
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
    Nub::$nub->cgi->getManBool('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case empty value.
   */
  public function testGetManBool3(): void
  {
    $_GET['foo'] = '';

    $this->expectException(InvalidUrlException::class);
    Nub::$nub->cgi->getManBool('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case missing value.
   */
  public function testGetManBool4(): void
  {
    unset($_GET['foo']);

    $this->expectException(InvalidUrlException::class);
    Nub::$nub->cgi->getManBool('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   */
  public function testGetManFloat1(): void
  {
    $this->baseGetFloat1('getManFloat');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   */
  public function testGetManFloat2(): void
  {
    $this->expectException(InvalidUrlException::class);
    $this->baseGetFloat2('getManFloat');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   */
  public function testGetManFloat3(): void
  {
    $_GET['foo'] = '';

    $this->expectException(InvalidUrlException::class);
    Nub::$nub->cgi->getManFloat('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   */
  public function testGetManFloat4(): void
  {
    unset($_GET['foo']);

    $this->expectException(InvalidUrlException::class);
    Nub::$nub->cgi->getManFloat('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManFloat.
   */
  public function testGetManFloat5(): void
  {
    $_GET['foo'] = 'qwerty';

    $this->expectException(InvalidUrlException::class);
    Nub::$nub->cgi->getManFloat('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManId.
   */
  public function testGetManId1(): void
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
  public function testGetManId3(): void
  {
    $_GET['foo'] = '';

    $this->expectException(\Exception::class);
    Nub::$nub->cgi->getManId('foo', 'bar');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManId.
   */
  public function testGetManId4(): void
  {
    unset($_GET['foo']);

    $this->expectException(\Exception::class);
    Nub::$nub->cgi->getManId('foo', 'bar');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   */
  public function testGetManInt1(): void
  {
    $this->baseGetInt1('getManInt');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   */
  public function testGetManInt2(): void
  {
    $this->expectException(InvalidUrlException::class);
    $this->baseGetInt2('getManInt');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   */
  public function testGetManInt3(): void
  {
    $_GET['foo'] = '';

    $this->expectException(InvalidUrlException::class);
    Nub::$nub->cgi->getManInt('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   */
  public function testGetManInt4(): void
  {
    unset($_GET['foo']);

    $this->expectException(InvalidUrlException::class);
    Nub::$nub->cgi->getManInt('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getManInt.
   */
  public function testGetManInt5(): void
  {
    $_GET['foo'] = 'qwerty';

    $this->expectException(InvalidUrlException::class);
    Nub::$nub->cgi->getManInt('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptBool.
   */
  public function testGetOptBool1(): void
  {
    // Tests for true.
    $_GET['foo'] = '1';
    $value       = Nub::$nub->cgi->getOptBool('foo');
    self::assertSame(true, $value);

    $_GET['foo'] = null;
    $value       = Nub::$nub->cgi->getOptBool('foo', true);
    self::assertSame(true, $value);

    unset($_GET['foo']);
    $value = Nub::$nub->cgi->getOptBool('foo', true);
    self::assertSame(true, $value);

    // Tests for false.
    $_GET['foo'] = '0';
    $value       = Nub::$nub->cgi->getOptBool('foo');
    self::assertSame(false, $value);

    $_GET['foo'] = null;
    $value       = Nub::$nub->cgi->getOptBool('foo', false);
    self::assertSame(false, $value);

    unset($_GET['foo']);
    $value = Nub::$nub->cgi->getOptBool('foo', false);
    self::assertSame(false, $value);

    // Tests for null.
    $_GET['foo'] = null;
    $value       = Nub::$nub->cgi->getOptBool('foo');
    self::assertNull($value);

    unset($_GET['foo']);
    $value = Nub::$nub->cgi->getOptBool('foo');
    self::assertNull($value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case none boolean value.
   */
  public function testGetOptBool2(): void
  {
    $_GET['foo'] = 'hello, world';

    $this->expectException(InvalidUrlException::class);
    Nub::$nub->cgi->getOptBool('foo');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptFloat.
   */
  public function testGetOptFloat1(): void
  {
    $this->baseGetFloat1('getOptFloat');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptFloat.
   */
  public function testGetOptFloat2(): void
  {
    $this->expectException(InvalidUrlException::class);
    $this->baseGetFloat2('getOptFloat');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptId.
   */
  public function testGetOptId1(): void
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
  public function testGetOptInt1(): void
  {
    $this->baseGetInt1('getOptInt');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test cases for getOptInt.
   */
  public function testGetOptInt2(): void
  {
    $this->expectException(InvalidUrlException::class);
    $this->baseGetInt2('getOptInt');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Invalid test cases for getManString.
   *
   * @param string    $variable The name of the CGI variable.
   * @param mixed     $value    The value of the CGI variable.
   * @param bool|null $unset    If true the CGI variable will be unset.
   *
   * @dataProvider invalidCasesGetManString
   */
  public function testInvalidGetManString(string $variable, $value, ?bool $unset): void
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
    Nub::$nub->cgi->getManString($variable);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Invalid test cases for getManUrl.
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
                                       ?bool $unset): void
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
    Nub::$nub->cgi->getManUrl($variable, $default, $forceRelative);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Invalid test cases for getOptString.
   *
   * @param string    $variable The name of the CGI variable.
   * @param mixed     $value    The value of the CGI variable.
   * @param bool|null $unset    If true the CGI variable will be unset.
   *
   * @dataProvider invalidCasesGetOptString
   */
  public function testInvalidGetOptString(string $variable, $value, ?bool $unset): void
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
    Nub::$nub->cgi->getOptString($variable);
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
                                       ?bool $unset): void
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
    Nub::$nub->cgi->getOptUrl($variable, $default, $forceRelative);
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
    $part = Nub::$nub->cgi->putBool($variable, $value, $mandatory);
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
    $part = Nub::$nub->cgi->putFloat($variable, $value);
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
    $part = Nub::$nub->cgi->putId($variable, $value, $label);
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
    $part = Nub::$nub->cgi->putInt($variable, $value);
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
    $part = Nub::$nub->cgi->putSlugName($value);
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
    $part = Nub::$nub->cgi->putUrl($variable, $value);
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
    $part = Nub::$nub->cgi->putUrl($variable, $value);
    self::assertSame($expected, $part);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Valid test cases for getManString.
   *
   * @param string      $variable The name of the CGI variable.
   * @param string|null $value    The value of the CGI variable.
   * @param string|null $default  The default value.
   * @param string      $expected The expected result.
   *
   * @dataProvider validCasesGetManString
   */
  public function testValidGetManString(string $variable,
                                        ?string $value,
                                        ?string $default,
                                        string $expected): void
  {
    $_GET[$variable] = $value;
    $url             = Nub::$nub->cgi->getManString($variable, $default);
    self::assertSame($expected, $url);

    if ($value===null)
    {
      unset($_GET[$variable]);
      $url = Nub::$nub->cgi->getManString($variable, $default);
      self::assertSame($expected, $url);
    }
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
                                     string $expected): void
  {
    $_GET[$variable] = $value;
    $url             = Nub::$nub->cgi->getManUrl($variable, $default, $forceRelative);
    self::assertSame($expected, $url);

    if ($value===null)
    {
      unset($_GET[$variable]);
      $url = Nub::$nub->cgi->getManUrl($variable, $default, $forceRelative);
      self::assertSame($expected, $url);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Valid test cases for getOptString.
   *
   * @param string      $variable The name of the CGI variable.
   * @param string|null $value    The value of the CGI variable.
   * @param string|null $default  The default value.
   * @param string      $expected The expected result.
   *
   * @dataProvider validCasesGetOptString
   */
  public function testValidGetOptString(string $variable,
                                        ?string $value,
                                        ?string $default,
                                        ?string $expected): void
  {
    $_GET[$variable] = $value;
    $url             = Nub::$nub->cgi->getOptString($variable, $default);
    self::assertSame($expected, $url);

    if ($value===null)
    {
      unset($_GET[$variable]);
      $url = Nub::$nub->cgi->getOptString($variable, $default);
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
                                     ?string $expected): void
  {
    $_GET[$variable] = $value;
    $url             = Nub::$nub->cgi->getOptUrl($variable, $default, $forceRelative);
    self::assertSame($expected, $url);

    if ($value===null)
    {
      unset($_GET[$variable]);
      $url = Nub::$nub->cgi->getOptUrl($variable, $default, $forceRelative);
      self::assertSame($expected, $url);
    }
  }
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns valid test cases for method getManString.
   *
   * @return array
   */
  public function validCasesGetManString(): array
  {
    $cases = [];

    // Test for null with default.
    $cases[] = ['variable' => 'foo',
                'value'    => null,
                'default'  => 'bar',
                'expected' => 'bar'];

    // Test for empty string with default.
    $cases[] = ['variable' => 'foo',
                'value'    => '',
                'default'  => 'bar',
                'expected' => 'bar'];

    // Test for normal string.
    $cases[] = ['variable' => 'foo',
                'value'    => 'bar',
                'default'  => null,
                'expected' => 'bar'];

    // Test for normal string with default.
    $cases[] = ['variable' => 'foo',
                'value'    => 'bar',
                'default'  => 'eggs',
                'expected' => 'bar'];

    // Test for special characters.
    $cases[] = ['variable' => 'foo',
                'value'    => '/',
                'default'  => null,
                'expected' => '/'];

    $cases[] = ['variable' => 'foo',
                'value'    => 'https://www.setbased.nl/',
                'default'  => null,
                'expected' => 'https://www.setbased.nl/'];

    // Test for special characters with default.
    $cases[] = ['variable' => 'foo',
                'value'    => '/',
                'default'  => 'spam',
                'expected' => '/'];

    $cases[] = ['variable' => 'foo',
                'value'    => 'https://www.setbased.nl/',
                'default'  => 'spam',
                'expected' => 'https://www.setbased.nl/'];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns valid test cases for method getManUrl.
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
   * Returns valid test cases for method getOptString.
   *
   * @return array
   */
  public function validCasesGetOptString(): array
  {
    $cases = $this->validCasesGetManString();

    // Test for null.
    $cases[] = ['variable' => 'foo',
                'value'    => null,
                'default'  => null,
                'expected' => null];

    // Test for empty string.
    $cases[] = ['variable' => 'foo',
                'value'    => '',
                'default'  => null,
                'expected' => null];

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
