<?php
/**
 * Klasa generująca przedmioty
 */
class ItemGenerator {
    private const X_DIMENSION = 200; // stała przechowująca początkowy wymiar zdjęcia X
    private const Y_DIMENSION = 100; // stała przechowująca początkowy wymiar zdjęcia Y

    private int $currentXDimension; // aktualny wymiar zdjęcia X
    private int $currentYDimension; // aktualny wymiar zdjęcia Y
    private int $quantity; // ilość generowanych przedmiotów
    private int $amount; // suma cen wszystkich przedmiotów

    /**
     * Konstruktor klasy
     * @param int $quantity ilość generowanych przedmiotów
     * @throws Exception gdy ilość generowanych przedmiotów jest mniejsza lub równa 0
     */
    public function __construct(int $quantity) {
        if ($quantity <= 0) {
            throw new Exception("Ilość generowanych przedmiotów musi być większa od 0");
        }
        $this->quantity = $quantity;
        $this->currentXDimension = self::X_DIMENSION;
        $this->currentYDimension = self::Y_DIMENSION;
        $this->amount = 0;
    }

     /**
     * Metoda generująca przedmioty
     * @return array zawierający kod HTML przedmiotów i nazwy produktów oddzielone przecinkami
     */
    public function generateItems(): array {
        $itemsHTML = '';
        $list = '';
        $nazwaproduktu = "Testowy produkt";
        for ($i = 0; $i < $this->quantity; $i++) {
            $this->currentXDimension++;
            $this->currentYDimension++;

            $randomNumber = random_int(100, 999);
            $this->amount += $randomNumber;


            $itemsHTML .= "<div class='item'>
                    <div class='image-box'> <img src='https://picsum.photos/{$this->currentXDimension}/{$this->currentYDimension}' alt=''> </div>
                    <div class='opis'>
                        <h4 class='product'>$nazwaproduktu</h4>
                        <div class='licznik'>Ilość: 1</div>
                    </div>
                    
                    <div class='cena'>$randomNumber zł</div>
                </div>";
            $list .= $nazwaproduktu . ",";
        }
        return array($itemsHTML, $list);
    }

    /**
     * Metoda zwracająca sumę cen wszystkich przedmiotów
     * @return int suma cen
     */
    public function getAmount(): int {
        return $this->amount;
    }
}
?> 