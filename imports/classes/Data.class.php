<?

class Data {

    public static function validateData(object $object) {

        $res = true;

        foreach (get_object_vars($object) as $prop => $value) {
            if (str_starts_with($prop, '_')) {
                if (empty(Request::clear_parameter($value))) {
                    $field = substr($prop, 1);
                    $validate_field = $field . '_validate';
                    $object->$validate_field = "$field is empty";
                    $res = false;
                }
            }
        }

        return $res;
    }

    public static function loadData(object $object, array $data) {
        foreach ($data as $key => $val) {
            if (property_exists($object, $key)) {
                $object->$key = $val;
            }
        }
    }

    public static function rn_to_br(string $str) {
        return str_replace('\r\n', '<br/>', $str);
    }

    public static function br_to_rn(string $str) {
        return str_replace('<br/>', '\r\n', $str);
    }

    public static function datetime_format(string $date) {
        $datetime = new DateTime($date);
        return $datetime->format('d.m.Y H:i:s');
    }
}

?>