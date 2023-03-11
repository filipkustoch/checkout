<!DOCTYPE html>
<html lang="pl">

<?php include "includes/db.php"; ?>
<?php include "includes/classes.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <!-- Dane użytkownika -->
        <div class="data">
            <div class="title">
                <h3>1. Twoje dane</h3>
            </div>
            <button>Logowanie</button>
            <p>Masz już konto? Kliknij żeby się zalogować.</p>
            <div class="checkboxContainer"><label for="innyAdres">
                    <input type="checkbox" value="innyAdres" name="innyAdres" id="show-form"> Stwórz nowe
                    konto</label>
            </div>
            <div id="form-container" style="display: none;">
                <form>
                    <input type="text" placeholder="Login*" class="input" required>
                    <input type="password" placeholder="Hasło*" class="input" required>
                    <input type="password" placeholder="Potwierdź hasło*" class="input" required>
                    <input type="text" name="" id="" placeholder="Imię*" class="input" required>
                    <input type="text" placeholder="Nazwisko*" class="input" required>
                    <select name="country" id="country">
                        <option value="polska">Polska</option>
                        <option value="reszta">Reszta świata</option>
                    </select>
                    <input type="text" placeholder="Adres*" class="input" required>
                    <input type="text" placeholder="Kod pocztowy*" class="input" required>
                    <input type="text" placeholder="Miasto*" class="input" required>
                    <input type="tel" placeholder="Telefon*" class="input" required>
                </form>
            </div>
            <div class="checkboxContainer">
                <input type="checkbox" value="innyAdres" name="innyAdres"><label for="innyAdres"> Dostawa pod inny
                    adres</label>
            </div>
        </div>
        <!-- Metody dostaw i płatności -->
        <div class="methods">
            <div class="deliveries">
                <div class="title">
                    <h3>2. Metoda dostawy</h3>
                </div>
                <div class="radio-item"><input type="radio" class="input" name="delivery_method"> <img
                        class="delivery-logo" src="https://inpost.pl/sites/default/files/InPost_logotype_2019_white.png"
                        alt=""> <label for=""> Paczkomaty 24/7</label></div>
                <div class="radio-item"><input type="radio" class="input" name="delivery_method"><img
                        class="delivery-logo"
                        src="https://www.jakimkurierem.pl/wp-content/uploads/2018/03/logo-dpd-kurier.jpg" alt=""> <label
                        for=""> Kurier
                        DPD</label></div>
                <div class="radio-item"><input type="radio" class="input" name="delivery_method"><img
                        class="delivery-logo"
                        src="https://www.jakimkurierem.pl/wp-content/uploads/2018/03/logo-dpd-kurier.jpg" alt=""> <label
                        for=""> Kurier DPD
                        pobranie</label></div>
            </div>
            <div class="payments">
                <div class="title">
                    <h3>3. Metoda płatności</h3>
                </div>
                <div class="radio-item">
                    <input type="radio" class="input" name="payment_method"> <img class="payment-logo"
                        src="https://poland.payu.com/wp-content/uploads/sites/14/2020/05/PAYU_LOGO_LIME-990x640.png"
                        alt=""> <label for=""> PayU</label>
                </div>
                <div class="radio-item"><input type="radio" class="input" name="payment_method"><img
                        class="payment-logo"
                        src="https://prestaguru.pl/blog/wp-content/uploads/2021/09/platnosc-za-pobraniem-cod-prestaguru.png"
                        alt=""> <label for=""> Płatności przy odbiorze</label></div>
                <div class="radio-item"><input type="radio" class="input" name="payment_method"><img
                        class="payment-logo" src="https://upload.wikimedia.org/wikipedia/commons/8/81/Przelew.png"
                        alt=""> <label for="">
                        Przelew bankowy - zwykły</label></div>
                <button>Dodaj kod rabatowy</button>
            </div>
        </div>
        <!-- Podsumowanie zamówienia -->
        <div class="summary">
            <div class="title">
                <h3>4. Podsumowanie</h3>
            </div>
            <!-- Generowanie przedmiotów za pomocą klasy ItemGenerator -->
            <?php
            $itemGenerator = new ItemGenerator(5);
            $itemGenerator->generateItems();
            ?>
            <!-- Kwota częściowa i łączna -->
            <hr class="hr-top">
            <div class="partial">
                <p>Suma częściowa</p>
                <p style="text-align: right;">115,00zł</p>
            </div>
            <div class="total">
                <p>Łącznie</p>
                <p style="text-align: right;">115,00zł</p>
            </div>
            <hr class="hr-bot">
            <textarea name="" id="comment" cols="30" rows="5" placeholder="Komentarz"></textarea>
            <div class="checkboxContainer">
                <input type="checkbox" value="innyAdres" name="innyAdres"><label for="innyAdres"> Zapisz się, aby
                    otrzymywać newsletter</label>
            </div>
            <div class="checkboxContainer">
                <input type="checkbox" value="innyAdres" name="innyAdres"><label for="innyAdres"> Zapoznałam/em się z
                    Regulaminem zakupów</label>
            </div>
        </div>
    </div>
    <!-- Skrypt JS -->
    <script src="script.js"></script>
</body>

</html>