<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

interface ValidatorInterface
{
    public function validate($value);
}
