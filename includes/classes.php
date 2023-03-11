<?php
class ItemGenerator {
    // ustalenie stałych wymiarów zdjęć
    private const X_DIMENSION = 200;
    private const Y_DIMENSION = 100;

    // zmienne przechowujące aktualne wymiary zdjęcia
    private $currentXDimension;
    private $currentYDimension;

    // ilość generowanych przedmiotów
    private $quantity;

    public function __construct($quantity) {
        $this->quantity = $quantity;
        $this->currentXDimension = self::X_DIMENSION;
        $this->currentYDimension = self::Y_DIMENSION;
    }

    public function generateItems() {
        // generowanie przedmiotów w pętli
        for ($i = 0; $i < $this->quantity; $i++) {
            // zwiększenie wymiarów zdjęcia o 1
            $this->currentXDimension++;
            $this->currentYDimension++;

            // wygenerowanie kodu HTML dla przedmiotu
            echo "<div class='item'>
                    <div class='image-box'> <img src='https://picsum.photos/{$this->currentXDimension}/{$this->currentYDimension}' alt=''> </div>
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