<?php 
  namespace App\Helpers;
  class RSS {
    public static function readVnexpress($link) {
      $json_xml = simplexml_load_file($link, "SimpleXMLElement", LIBXML_NOCDATA);
      $array_json = json_decode(json_encode((array)$json_xml), TRUE);
      $items = $array_json['channel']['item'];
      $data = [];
      foreach ($items as $key => $value) {
        $tmp = [];
        $tmp['name'] = $value['title'];
        $tmp['pubDate'] = $value['pubDate'];
        $tmp['link'] = $value['link'];
    
        $result = [];
        preg_match('@src="([^"]+)"@',$value['description'], $result);
        $tmp['thumb'] = !empty($result[1]) ? $result[1] : 'NULL';
      
        $result = [];
        preg_match('@br>([^"]+)@',$value['description'], $result);
        $tmp['description'] = !empty($result[1]) ? $result[1] : 'NULL';
        $data[] = $tmp;
      }
      return $data;
    }
    public static function readCafebiz($link) {
      $json_xml = simplexml_load_file($link, "SimpleXMLElement", LIBXML_NOCDATA);
      $array_json = json_decode(json_encode((array)$json_xml), TRUE);
      $items = $array_json['channel']['item'];
      $data = [];
      foreach ($items as $key => $value) {
        $tmp = [];
        $tmp['name'] = $value['title'];
        $tmp['pubDate'] = $value['pubDate'];
        $tmp['link'] = $value['link'];
    
        $result = [];
        preg_match('@src="([^"]+)"@',$value['description'], $result);
        $tmp['thumb'] = !empty($result[1]) ? $result[1] : 'NULL';

        $result = [];
        preg_match('@<span>([^"]+)<\/span>@',$value['description'], $result);
        $tmp['description'] = !empty($result[1]) ? $result[1] : 'NULL';

        $data[] = $tmp;
      }
      return $data;
    }
    public static function readGold($link) {
      $json_xml = simplexml_load_file($link, "SimpleXMLElement", LIBXML_NOCDATA);
      $array_json = json_decode(json_encode((array)$json_xml), TRUE);
      $items = $array_json['ratelist']['city'][0]['item'];
      $data = [];
      foreach ($items as $key => $value) {
        foreach ($value as $key02 => $value02) {
          $tmp = [];
          $tmp['type'] = $value02['type'];
          $tmp['sell'] = $value02['sell'];
          $tmp['buy'] = $value02['buy'];
          $data[] = $tmp;
        }
      }
      return $data;
    }
    public static function readCoin($link) {
      $json = file_get_contents($link);
      $array_json = json_decode($json,true);
      $data = [];
      foreach ($array_json as $key => $value) {
        $tmp = [];
        $tmp['name'] = $value['name'];
        $tmp['current_price'] = $value['current_price'];
        $tmp['price_change'] = $value['price_change_percentage_24h'];
        $data[] = $tmp;
      }
      return $data;
    }
  }
?>