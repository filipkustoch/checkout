<!DOCTYPE html>
<html lang="pl">

<?php include "includes/db.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.scss">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>

<body>
    <div class="container">
        <form id="form" method="POST" onsubmit="sendData(event)">
            <!-- Dane użytkownika -->
            <div class="data">
                <!-- Kontener dla sekcji danych -->
                <div class="title">
                    <!-- Tytuł sekcji -->
                    <h3>1. Twoje dane</h3>
                </div>
                <!-- Przycisk logowania -->
                <button type="button" onclick="">Logowanie</button>
                <!-- Informacja o możliwości logowania -->
                <p>Masz już konto? Kliknij żeby się zalogować.</p>
                <!-- Kontener dla checkboxa wyboru stworzenia nowego konta -->
                <div class="checkboxContainer"><label for="innyAdres">
                        <input type="checkbox" value="innyAdres" name="innyAdres" id="show-form"> Stwórz nowe
                        konto</label>
                </div>
                <!-- Kontener dla formularza do stworzenia nowego konta, ukryty początkowo -->
                <div id="form-container" style="display: none;">
                    <!-- Pola do wprowadzenia danych nowego konta -->
                    <input type="text" name="login" placeholder="Login*" class="input" minlength="3" required>
                    <input type="password" name="password" placeholder="Hasło*" class="input" minlength="8" required>
                    <input type="password" placeholder="Potwierdź hasło*" class="input" minlength="8" required>
                    <input type="text" name="firstname" id="" placeholder="Imię*" class="input" minlength="2" required>
                    <input type="text" name="lastname" placeholder="Nazwisko*" class="input" minlength="2" required>
                    <!-- Lista rozwijana do wyboru kraju -->
                    <select name="country" id="country">
                        <option value="polska">Polska</option>
                        <option value="reszta">Reszta świata</option>
                    </select>
                    <input type="text" name="address" placeholder="Adres*" class="input" minlength="3" required>
                    <input type="text" name="postcode" placeholder="Kod pocztowy*" class="input" minlength="5" required>
                    <input type="text" name="city" placeholder="Miasto*" class="input" minlength="2" required>
                    <input type="tel" name="phonenumber" placeholder="Telefon*" class="input" minlength="9" required>
                </div>
                <!-- Kontener dla checkboxa wyboru dostawy pod inny adres -->
                <div class="checkboxContainer"> <input type="checkbox" value="innyAdres" name="innyAdres"><label
                        for="innyAdres"> Dostawa pod inny adres</label> </div>
            </div>
            <!-- Metody dostaw i płatności -->
            <div class="methods">
                <!-- Sekcja z metodami dostawy -->
                <div class="deliveries">
                    <div class="title">
                        <h3>2. Metoda dostawy</h3>
                    </div>
                    <!-- Wybór paczkomatu -->
                    <div class="radio-item"> <input type="radio" class="input" name="delivery_method"
                            id="delivery_paczkomaty"> <img class="delivery-logo"
                            src="https://inpost.pl/sites/default/files/InPost_logotype_2019_white.png" alt=""> <label
                            for="delivery_paczkomaty"> Paczkomaty 24/7 </label> </div>
                    <!-- Wybór kuriera DPD -->
                    <div class="radio-item"> <input type="radio" class="input" name="delivery_method"
                            id="delivery_dpd_kurier"> <img class="delivery-logo"
                            src="https://www.jakimkurierem.pl/wp-content/uploads/2018/03/logo-dpd-kurier.jpg" alt="">
                        <label for="delivery_dpd_kurier"> Kurier DPD </label>
                    </div>
                    <!-- Wybór kuriera DPD z opcją pobrania -->
                    <div class="radio-item"> <input type="radio" class="input" name="delivery_method"
                            id="delivery_dpd_pobranie"> <img class="delivery-logo"
                            src="https://www.jakimkurierem.pl/wp-content/uploads/2018/03/logo-dpd-kurier.jpg" alt="">
                        <label for="delivery_dpd_pobranie"> Kurier DPD pobranie </label>
                    </div>
                </div>
                <!-- Sekcja z metodami płatności -->
                <div class="payments">
                    <div class="title">
                        <h3>3. Metoda płatności</h3>
                    </div>
                    <!-- Wybór płatności przez PayU -->
                    <div class="radio-item"> <input type="radio" class="input" name="payment_method" id="payment_payu">
                        <img class="payment-logo"
                            src="https://poland.payu.com/wp-content/uploads/sites/14/2020/05/PAYU_LOGO_LIME-990x640.png"
                            alt=""> <label for="payment_payu"> PayU </label>
                    </div>
                    <!-- Wybór płatności przy odbiorze -->
                    <div class="radio-item"> <input type="radio" class="input" name="payment_method"
                            id="payment_odbior">
                        <img class="payment-logo"
                            src="https://prestaguru.pl/blog/wp-content/uploads/2021/09/platnosc-za-pobraniem-cod-prestaguru.png"
                            alt=""> <label for="payment_odbior"> Płatności przy odbiorze </label>
                    </div>
                    <!-- Wybór przelewu bankowego - zwykłego -->
                    <div class="radio-item"> <input type="radio" class="input" name="payment_method"
                            id="payment_przelew">
                        <img class="payment-logo" src="https://upload.wikimedia.org/wikipedia/commons/8/81/Przelew.png"
                            alt=""> <label for="payment_przelew"> Przelew bankowy - zwykły </label>
                    </div>
                    <!-- Przycisk pozwalający na dodanie kodu rabatowego -->
                    <button type="button" onclick="showDiscountCode()">Dodaj kod rabatowy</button>

                    <div id="discount-code-container" style="display:none">
                        <label for="discount-code">Wprowadź kod rabatowy:</label>
                        <input type="text" id="discount-code">
                        <button type="button" id="apply-discount">Zastosuj</button>

                        <div id="result"></div>
                        <!-- Zapytanie AJAX do discount.php sprawdzające kod rabatowy -->
                        <script>
                            $(document).ready(function () {
                                $('#apply-discount').click(function () {
                                    var discountCode = $('#discount-code').val();
                                    console.log(discountCode);
                                    $.ajax({
                                        type: 'POST',
                                        url: 'discount.php',
                                        data: { discountCode: discountCode },
                                        success: function (response) {
                                            // Kod poprawny
                                            if (response == 'valid') {
                                                $('#result').html('Kod rabatowy jest poprawny.');
                                                applyDiscount();
                                                // Kod niepoprawny
                                            } else if (response == 'invalid') {
                                                $('#result').html('Kod rabatowy jest niepoprawny.');
                                            } else {
                                                $('#result').html("Wystąpił błąd podczas sprawdzania kodu rabatowego.");
                                            }
                                        },
                                        error: function () {
                                            $('#result').html('Wystąpił błąd podczas wysyłania zapytania.');
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>

            <!-- Podsumowanie zamówienia -->
            <div class="summary">
                <div class="title">
                    <h3>4. Podsumowanie</h3>
                </div>
                <!-- Generowanie przedmiotów za pomocą klasy ItemGenerator -->
                <?php
                require_once 'includes/ItemGenerator.php';
                $itemGenerator = new ItemGenerator(5);
                $items = $itemGenerator->generateItems();
                echo $items;
                $amount = $itemGenerator->getAmount(); // pobranie sumy za pomocą metody getSum()
                ?>
                <!-- Kwota częściowa i łączna -->
                <hr class="hr-top">
                <div class="partial">
                    <p>Suma częściowa</p>
                    <p style="text-align: right;">
                        <?php echo $amount; ?> zł
                    </p>
                </div>
                <div class="total">
                    <p>Łącznie</p>
                    <p style="text-align: right;" id="discount-input">
                        <?php echo $amount; ?> zł
                    </p>
                </div>
                <hr class="hr-bot">
                <!-- Komentarz -->
                <textarea name="" id="comment" cols="30" rows="5" placeholder="Komentarz"></textarea>
                <!-- Newsletter -->
                <div class="checkboxContainer">
                    <input type="checkbox" value="innyAdres" name="innyAdres"><label for="innyAdres"> Zapisz się, aby
                        otrzymywać newsletter</label>
                </div>
                <!-- Regulamin -->
                <div class="checkboxContainer">
                    <input type="checkbox" value="innyAdres" name="innyAdres"><label for="innyAdres"> Zapoznałam/em się
                        z
                        Regulaminem zakupów</label>
                </div>
                <button type="submit"  id="confirm">Potwierdź zakup</button>
        </form>
    </div>
    </div>
    <!-- Skrypt JS -->
    <script src="script.js"></script>
</body>

</html>