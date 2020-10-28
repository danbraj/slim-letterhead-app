<?php

namespace App\Application\Service\PdfBuilder;

class PdfContent
{
  private $layout;
  private $styles;
  private $title;
  private $header;
  private $content;
  private $signatures;

  public function __construct($layout, $styles, $title, $header, $content, $signatures)
  {
    $this->layout = $layout;
    $this->styles = $styles;
    $this->title = $title;
    $this->header = $header;
    $this->content = $content;
    $this->signatures = $signatures;
  }

  public function generateHtml()
  {
    $signatures = '<div class="signatures">';
    for ($i=0; $i < count($this->signatures); $i++) { 
      $signatures .= '<div class="signature">' . ($this->signatures[$i]->facsimile != null ? '<img class="signature__facsimile" src="/uploads/' . $this->signatures[$i]->facsimile . '" alt="">' : null) . '<h2 class="signature__name">' . $this->signatures[$i]->person . '</h2>' . ($this->signatures[$i]->title != null ? '<p class="signature__title">' . $this->signatures[$i]->title . '</p>' : null) . '</div>';
    }
    $signatures .= '</div>';

    $html = $this->inputData($this->layout, [
      '[TITLE]' => $this->title,
      '[HEADER]' => $this->header,
      '[CONTENT]' => $this->content,
      '[STYLES]' => $this->styles,
      '[SIGNATURES]' => $signatures
    ]);
    return $html;
  }

  private function inputData($text, $fields = [])
  {
    preg_match_all( '/\[[A-Z]+[A-Z0-9_]+\]/', $text, $matches );
    if( isset( $matches[0] ) && count( $matches[0] ) > 0 ){
      foreach( $matches[0] as $key => $val ){
        $text = str_replace( $val, ( isset( $fields[$val] ) ? $fields[$val] : '' ), $text ); 
      }
    }
    return $text;
  }
}