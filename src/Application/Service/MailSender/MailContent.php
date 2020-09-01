<?php

namespace App\Application\Service\MailSender;

class MailContent
{
  private $heading;
  private $body;
  private $altBody;
  private $attachments;
 
  public function __construct(string $heading, string $body, string $altBody, array $attachments = [])
  {
    $this->heading = $heading;
    $this->body = $body;
    $this->altBody = $altBody;
    $this->attachments = $attachments;
  }

  public function getHeading(): string
  {
    return $this->heading;
  }

  public function getBody() : string
  {
    return $this->body;
  }

  public function getAltBody() : string
  {
    return $this->altBody;
  }

  public function getAttachments() : array
  {
    return $this->attachments;
  }
};