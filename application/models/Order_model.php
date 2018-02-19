<?php
class Order_model extends CI_Model {

  public function get_order_def($id = 'order1')
  {
    $order_def = json_decode(file_get_contents ("application/models/order.json"), TRUE);
    return $order_def[$id];
  }
}
