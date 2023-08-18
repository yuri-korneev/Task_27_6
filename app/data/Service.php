<?php

namespace App\data;

class Service {

/*
Параметры:
$src             - имя исходного файла
$dest            - имя генерируемого файла
$width, $height  - ширина и высота генерируемого изображения, в пикселях
Необязательные параметры:
$rgb             - цвет фона, по умолчанию - белый
$quality         - качество генерируемого JPEG, по умолчанию - максимальное (100)
*/

function img_resize($src, $dest, $width, $height, $rgb=0xFFFFFF, $quality=100)
{
  if (!file_exists($src)) return false;

  $size = getimagesize($src);

  if ($size === false) return false;

  // Определяем исходный формат по MIME-информации, предоставленной
  // функцией getimagesize, и выбираем соответствующую формату
  // imagecreatefrom-функцию.
  $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
  $icfunc = "imagecreatefrom" . $format;
  if (!function_exists($icfunc)) return false;

  $x_ratio = $width / $size[0];
  $y_ratio = $height / $size[1];

  $ratio = min($x_ratio, $y_ratio);
  $use_x_ratio = ($x_ratio == $ratio);

  $new_width = $use_x_ratio ? $width : floor($size[0] * $ratio);
  $new_height = !$use_x_ratio ? $height : floor($size[1] * $ratio);
  $new_left = $use_x_ratio ? 0 : floor(($width - $new_width) / 2);
  $new_top = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

  // Читаем в память файл изображения с помощью функции imagecreatefrom...
  $isrc = $icfunc($src);
  // Создаем новое изображение
  $idest = imagecreatetruecolor($width, $height);

  // Заливка цветом фона
  imagefill($idest, 0, 0, $rgb);
  // Копируем существующее изображение в новое с изменением размера:
  imagecopyresampled(
    $idest, // Идентификатор нового изображения
    $isrc, // Идентификатор исходного изображения
     $new_left, $new_top, // Координаты (x,y) верхнего левого угла в новом изображении
    0, 0, // Координаты (x,y) верхнего левого угла копируемого блока
           // существующего изображения
    $new_width, // Новая ширина копируемого блока
    $new_height, // Новая высота копируемого блока
    $size[0], // Ширина исходного копируемого блока
    $size[1] // Высота исходного копируемого блока
  );
  // Сохраняем результат в JPEG-файле: функция imagejpeg, может выводить
  // результат своей работы не только в броузер, но и в файл. Для этого
  // следует указать имя файла в необязательном втором параметре.
  // Функция imagejpeg имеет и третий необязательный параметр - качество
  // изображения.
  imagejpeg($idest, $dest, $quality);

  imagedestroy($isrc);
  imagedestroy($idest);

  return true;
}

}

?>
