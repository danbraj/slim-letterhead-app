<?php

namespace App\Application\Service\Validator;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
  protected $errors;

  public function validate($request, array $rules)
  {
    foreach ($rules as $field => $rule) {
      try {
        $rule->setName(ucfirst($field))->assert($request->getParsedBody()[$field] ?? '');
      } catch (NestedValidationException $e) {
        $this->errors[$field] = $e->getMessages();
      }
    }
    // var_dump($this->errors);die;
    $_SESSION['errors'] = $this->errors;
    return $this;
  }

  public function failed()
  {
    return !empty($this->errors);
  }
}