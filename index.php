<?php

class Generate
{
  public static function uuid($str = "")
  {
    $type = gettype($str);
    if ($type != 'string') {
      $str = (string)$str;
    }
    try {
      $uuid = sprintf(
        '%08x-%04x-%04x-%04x-%12x',
        (hexdec(substr(md5($str), 0, 8)) & 0xffffffff),
        (hexdec(substr(md5($str), 8, 4)) & 0xffff),
        (hexdec(substr(md5($str), 12, 4)) & 0xffff),
        (hexdec(substr(md5($str), 16, 4)) & 0x0fff) | 0x4000,
        (hexdec(substr(md5($str), 20, 12)) & 0x3fffffffffff)
      );


      return $uuid;
    } catch (Exception $e) {
      throw new Exception($e);
    }
  }

  public static function Insert(array $data, string $key, string $target = "id")
  {
    $data[$target] = self::uuid($data[$key]);

    return $data;
  }
}

echo "Sample \n";

$uuid = Generate::uuid(1);

echo $uuid . "\n";

$data = [
  'id' => 1,
  "name" => 'akmal'
];
echo "\n";
print_r($data);

echo "generate \n";

$data = Generate::Insert($data, 'id');

print_r($data);
