<?php

namespace App\Http;

class Flash{


  public function create($title,$message,$level, $key = null)
  {
    session()->flash('flash_message', [
      'title' => $title,
      'message' => $message,
      'level' => $level,
      'key' => $key
    ]);
  }
  public function info($title, $message)
  {
    $this->create($title, $message, 'info');
  }
  public function success($title, $message)
  {
    $this->create($title, $message, 'success');
  }

  public function error($title, $message)
  {
    $this->create($title, $message, 'error');
  }

  public function overlay($title, $message)
  {
    $this->create($title, $message, 'success', 'overlay');
  }

}
