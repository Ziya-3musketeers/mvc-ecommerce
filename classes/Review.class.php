<?php

class Review{
  private $usernaOG;
  private $rating;
  private $feedback;

  function __construct($usernaOG, $rating, $feedback)
  {
    $this->usernaOG = $usernaOG;
    $this->rating = $rating;
    $this->feedback = $feedback;
  }

  public function getUsernaOG() { return $this->usernaOG; }
  public function getRating() { return $this->rating / 5 * 100; }
  public function getFeedback() { return $this->feedback; }
}