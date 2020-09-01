<?php

namespace App\Application\Service\MailSender;

interface MailSenderInterface
{
  public function send(string $recipent, MailContent $mailContent);
}