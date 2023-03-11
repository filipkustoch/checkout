<?php
class ItemGenerator {
    private const X = 200;
    private const Y = 100;
    private $x;
    private $y;
    private $ilosc;

    public function __construct($ilosc) {
        $this->ilosc = $ilosc;
        $this->x = self::X;
        $this->y = self::Y;
    }

    public function generateItems() {
        for ($i = 0; $i < $this->ilosc; $i++) {
            $this->x++;
            $this->y++;

            echo "<div class='item'>
                    <div class='image-box'> <img src='https://picsum.photos/{$this->x}/{$this->y}' alt=''> </div>
                    <div class='opis'>
                        <h4>Testowy produkt</h4>
                    </div>
                    <div class='licznik'>1</div>
                    <div class='cena'>115zł</div>
                </div>";
        }
    }
}
?>