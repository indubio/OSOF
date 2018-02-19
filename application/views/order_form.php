<div class="page-header">
<h1>OSOF - Bestellung</h1>
</div>
<?php echo validation_errors(); ?>
<?php echo form_open('order'); ?>
<input type="text" name="username" value="<?php echo set_value('username'); ?>"/>
<input type="text" name="password" value="<?php echo set_value('password'); ?>"/>
<table class="order-table table table-striped">
<?php
  $count = 1;
  foreach ($items as $item){
    echo '<tr class="">';
    echo '<td class="name">'. $item['name'] .'</td>';
    echo '<td class="unit">'. $item['unit'] .'</td>';
    echo '<td class="price">'. $item['price'] .'</td>';
    echo '<td class="editable quantity">'
      .'<input type="text" size="3" '
      .'name="quantity'. $count. '" '
      .'value="'. set_value('quantity'. $count) .'" />'
      . '</td>';
    echo '<td class="row_sum">0,00</td>';
    echo '</tr>';
    $count++;
  }
?>
</table>
<button class="btn" type="submit">Bestellung absenden</button>
</form>
