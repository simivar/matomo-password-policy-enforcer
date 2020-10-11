<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use PHPUnit\Framework\TestCase;
use Piwik\Plugins\PasswordPolicyEnforcer\Translator\TranslatorInterface;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\LowercaseLetterValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\MinimumLengthValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\NumberValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\PasswordValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\SpecialCharacterValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\UppercaseLetterValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException;

/**
 * @group PasswordPolicy
 * @group PasswordPolicyTest
 * @group PasswordValidator
 * @group Password
 * @group Plugins
 */
class PasswordValidatorTest extends TestCase
{
    /** @var PasswordValidator */
    private $passwordValidator;
    
    public function setUp(): void
    {
        $translator = $this->getMockBuilder(TranslatorInterface::class)
            ->setMethods(['translate'])
            ->getMock();

        $translator->method('translate')->willReturnArgument(0);

        $this->passwordValidator = new PasswordValidator($translator);
    }

    public function test_validate_notLongEnough(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('UsersManager_ExceptionInvalidPassword');

        $this->passwordValidator->addValidator(new MinimumLengthValidator());
        $this->passwordValidator->validate('test');
    }

    public function test_validate_notOneUppercaseLetter(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('PasswordPolicyEnforcer_ExceptionInvalidPasswordUppercaseLetterRequired');

        $this->passwordValidator->addValidator(new UppercaseLetterValidator());
        $this->passwordValidator->validate('sometestpassword');
    }

    public function test_validate_notOneLowercaseLetter(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('PasswordPolicyEnforcer_ExceptionInvalidPasswordLowercaseLetterRequired');

        $this->passwordValidator->addValidator(new LowercaseLetterValidator());
        $this->passwordValidator->validate('SOMETESTPASSWORD');
    }

    public function test_validate_notOneNumberLetter(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('PasswordPolicyEnforcer_ExceptionInvalidPasswordNumberRequired');

        $this->passwordValidator->addValidator(new NumberValidator());
        $this->passwordValidator->validate('someTestPassword');
    }

    public function test_validate_notOneSpecialCharacter(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('PasswordPolicyEnforcer_ExceptionInvalidPasswordSpecialCharacterRequired');

        $this->passwordValidator->addValidator(new SpecialCharacterValidator());
        $this->passwordValidator->validate('someTestPassword19');
    }

    public function test_validate_validPasswords(): void
    {
        $this->passwordValidator->addValidator(new MinimumLengthValidator());
        $this->passwordValidator->addValidator(new UppercaseLetterValidator());
        $this->passwordValidator->addValidator(new LowercaseLetterValidator());
        $this->passwordValidator->addValidator(new NumberValidator());
        $this->passwordValidator->addValidator(new SpecialCharacterValidator());

        $this->assertTrue($this->passwordValidator->validate('someTest{Password19'));
        $this->assertTrue($this->passwordValidator->validate('2%IVR4$Mw%8drTGJD!$IljgvFOr0@YWxRLb0QBt!G6Kf3'));
        $this->assertTrue($this->passwordValidator->validate('somTestPsswrd!0'));
    }

}
