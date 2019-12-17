<?
['item' => function($index, $label, $name, $checked, $value) {
    $check = $checked ? ' checked="checked"' : '';
    $return = '<div class="col-md-1" id="autotype" style="width: 11.11111%;margin-top: 12px;"><label class="'. $value .'">';
    $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3" '.$check.'>';
    $return .= '<span></span><p>' . ucwords($label) . '</p>';
    $return .= '</label></div>';
    return $return;
}
]
?>




