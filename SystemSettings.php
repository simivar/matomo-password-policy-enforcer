<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer;

use Piwik\Piwik;
use Piwik\Settings\Setting;
use Piwik\Settings\FieldConfig;
use Piwik\Validators\NumberRange;
use Piwik\Plugins\UsersManager\UsersManager;

/**
 * Defines Settings for UserCountry.
 */
class SystemSettings extends \Piwik\Settings\Plugin\SystemSettings
{
    /** @var Setting */
    public $minLength;
    
    /** @var Setting */
    public $isOneUppercaseLetterRequired;
    
    /** @var Setting */
    public $isOneLowercaseLetterRequired;
    
    /** @var Setting */
    public $isOneNumberRequired;
    
    /** @var Setting */
    public $isOneSpecialCharacterRequired;
    
    protected function init()
    {
        $this->title = Piwik::translate('PasswordPolicyEnforcer_PasswordPolicyConfiguration');
        
        $this->minLength = $this->createMinLengthSetting();
        $this->isOneUppercaseLetterRequired = $this->createRequireOneUppercaseLetterSetting();
        $this->isOneLowercaseLetterRequired = $this->createRequireOneLowercaseLetterSetting();
        $this->isOneNumberRequired = $this->createRequireOneNumberSetting();
        $this->isOneSpecialCharacterRequired = $this->createRequireOneSpecialCharacterSetting();
    }
    
    private function createMinLengthSetting()
    {
        return $this->makeSetting('minLength', UsersManager::PASSWORD_MIN_LENGTH, FieldConfig::TYPE_INT, function (FieldConfig $field) {
            $field->title = Piwik::translate('PasswordPolicyEnforcer_PasswordPolicyMinLengthSetting');
            $field->uiControl = FieldConfig::UI_CONTROL_TEXT;
            $field->description = Piwik::translate('PasswordPolicyEnforcer_PasswordPolicyMinLengthSettingDescription', [UsersManager::PASSWORD_MIN_LENGTH]);
            $field->validators[] = new NumberRange(UsersManager::PASSWORD_MIN_LENGTH, UsersManager::PASSWORD_MAX_LENGTH);
        });
    }
    
    private function createRequireOneUppercaseLetterSetting()
    {
        return $this->makeSetting('requireOneUppercaseLetter', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
            $field->title = Piwik::translate('PasswordPolicyEnforcer_PasswordPolicyOneUppercaseLetterSetting');
            $field->uiControl = FieldConfig::UI_CONTROL_CHECKBOX;
            $field->description = Piwik::translate('PasswordPolicyEnforcer_PasswordPolicyOneUppercaseLetterSettingDescription');
        });
    }
    
    private function createRequireOneLowercaseLetterSetting()
    {
        return $this->makeSetting('requireOneLowercaseLetter', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
            $field->title = Piwik::translate('PasswordPolicyEnforcer_PasswordPolicyOneLowercaseLetterSetting');
            $field->uiControl = FieldConfig::UI_CONTROL_CHECKBOX;
            $field->description = Piwik::translate('PasswordPolicyEnforcer_PasswordPolicyOneLowercaseLetterSettingDescription');
        });
    }
    
    private function createRequireOneNumberSetting()
    {
        return $this->makeSetting('requireOneNumber', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
            $field->title = Piwik::translate('PasswordPolicyEnforcer_PasswordPolicyOneNumberSetting');
            $field->uiControl = FieldConfig::UI_CONTROL_CHECKBOX;
            $field->description = Piwik::translate('PasswordPolicyEnforcer_PasswordPolicyOneNumberSettingDescription');
        });
    }
    
    private function createRequireOneSpecialCharacterSetting()
    {
        return $this->makeSetting('requireOneSpecialCharacter', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
            $field->title = Piwik::translate('PasswordPolicyEnforcer_PasswordPolicyOneSpecialCharacterSetting');
            $field->uiControl = FieldConfig::UI_CONTROL_CHECKBOX;
            $field->description = Piwik::translate('PasswordPolicyEnforcer_PasswordPolicyOneSpecialCharacterSettingDescription');
        });
    }
    
}
