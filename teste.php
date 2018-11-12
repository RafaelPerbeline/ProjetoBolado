<?php
  $data = new DateTime('2011-09-11');
  print_r($data);
  
  $data->add(new DateInterval('P2M5D'));
  print_r($data);
  ?>