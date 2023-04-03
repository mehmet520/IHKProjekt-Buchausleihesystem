<?php
class fruit
{
    //public , private and protected public
    public $name;
    public $color;
    public const message = 'Hello OOP';
    function setName($par)
    {
        $this->name = $par;
    }
    function getName()
    {
        return $this->name;
    }
    function setColor($par2)
    {
        $this->color = $par2;
    }
    function getColor()
    {
        return $this->color;
    }
    function defaultValue()
    {
        $name = 'Portakal';
        $color = 'Turuncu';
        $text = "Meyve adı ve rengi:$name - $color";
        return $text;
    }

/*     function __construct()
    {
    }
    function __destruct()
    {
    } */
}
?>
