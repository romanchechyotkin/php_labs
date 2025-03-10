<?php 
  define('GRAPH_WIDTH',         500);               // ширина картинки 
  define('GRAPH_HEIGHT',        300);               // высота картинки 
  define('GRAPH_OFFSET_TOP',    40);                // отступ сверху 
  define('GRAPH_OFFSET_LEFT',   40);                // отступ слева 
  define('GRAPH_OFFSET_RIGHT',  5);                 // отстут справа 
  define('GRAPH_OFFSET_BOTTOM', 30);                // отступ снизу 
  $colors = array(0xFF0000,0x00FF00,0x0000FF,     // цвета столбцов 
                  0xFFFF00,0x00FFFF,0xFF00FF); 

$Data = array( 
              'матан'    => 10,
              '3д'    => 9,
              'англ'    => 10,
              'география'    => 9,
              'физра' => 10,
              'физика' => 10,
              'тервер' => 9,
             );

  // Считаем ширину столбцов 
  $col_width = (GRAPH_WIDTH - GRAPH_OFFSET_LEFT - GRAPH_OFFSET_RIGHT) / count($Data); 
  // Считаем высоту столбца, соответствующего максимальному значению 
  $col_maxheight = (GRAPH_HEIGHT - GRAPH_OFFSET_TOP - GRAPH_OFFSET_BOTTOM); 
  // Ищем максимальное значение в массиве, соответствующее столбцу макс высоты 
  $max_value = max($Data); 
  // Считаем среднее значение
  $average_value = array_sum($Data) / count($Data);
  
  $image = imagecreatetruecolor(GRAPH_WIDTH,GRAPH_HEIGHT)
    or die('Cannot create image');
  imagefill($image, 0, 0, 0xFFFFFF);  
  
  // рисуем столбцы 
  $x = GRAPH_OFFSET_LEFT; 
  $y = GRAPH_OFFSET_TOP + $col_maxheight; 
  $i = 0; 
  foreach($Data as $value) { 
    imagefilledrectangle(
      $image, 
      $x, 
      $y - round($value*$col_maxheight/$max_value), 
      $x + $col_width - 1, 
      $y, 
      $colors[$i++%count($colors)]
    ); 
    $x += $col_width;
  } 
 
  // рисуем координатную ось 
  imageline($image, GRAPH_OFFSET_LEFT - 5, GRAPH_OFFSET_TOP, 
            GRAPH_OFFSET_LEFT - 5, $y, 0xCCCCCC); 
  for($value=0; $value<=$max_value; $value++) {
    imageline($image, GRAPH_OFFSET_LEFT - 7, $Y = $y - round($value*$col_maxheight/$max_value), 
            GRAPH_OFFSET_LEFT - 5, $Y, 0xCCCCCC); 
    imagestring($image, 1, GRAPH_OFFSET_LEFT / 2, $Y - 4, $value, 0x000000);
  }

  // Рисуем линию среднего значения
  $avg_y = $y - round($average_value * $col_maxheight / $max_value);
  imageline($image, GRAPH_OFFSET_LEFT, $avg_y, GRAPH_WIDTH - GRAPH_OFFSET_RIGHT, $avg_y, 0xFF0000);
  imagestring($image, 2, GRAPH_WIDTH - GRAPH_OFFSET_RIGHT - 30, $avg_y - 10, 'avg', 0xFF0000);
  
  // Устанавливаем тип документа - "изображение в формате PNG"...
  header('Content-type: image/png'); 
  // ...И, наконец, выведем сгенерированную картинку в формате PNG: 
  imagepng($image); 
  imagedestroy($image);                // освобождаем память, выделенную для изображения 
?>
