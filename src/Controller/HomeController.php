<?php

namespace Controller;

class HomeController {
    public function hello($sentences) {
      $orm = new \LightOrm_Test;
      $orm->hello('World');
    }
}
