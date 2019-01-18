<?php

/*
 * Form builder class
 */

namespace Components;

class Form
{

    /**
     * HTML-text of form to return
     * @var string
     */
    private $html;

    public function __construct($action="/")
    {

        $this->html = '<form method="POST" action="'.$action.'"  accept-charset="UTF-8">'.PHP_EOL;
        $this->html .= '    '.\Components\Token::getToken().PHP_EOL;

    }

    public function addField($name, $label, $type, $value="", $placeholder="", $attributes='')
    {

        $type = empty($type) ? 'text' : $type;

        $this->html .= empty($label) ? '' : '    <label for="'.$name.'">'.$label.'</label><br/>'.PHP_EOL;
        if ($type == 'textarea') {
            $this->html .= '    <textarea id="'.$name.'"" name="'.$name.'" placeholder="'.$placeholder.'" '.$attributes.'>'.$value.'</textarea></br>'.PHP_EOL;
        } else {
            $this->html .= '    <input id="'.$name.'"" type="'.$type.'" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" '.$attributes.'/></br>'.PHP_EOL;
        }

    }

    public function addButton($name, $label="Submit", $type="submit")
    {

        $this->html .= '    <button type="'.$type.'" name="'.$name.'">'.$label.'</button>'.PHP_EOL;

    }

    public function getForm()
    {

        $this->html .= '</form>'.PHP_EOL;
        return $this->html;

    }

}