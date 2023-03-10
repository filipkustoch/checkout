<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="dane">
            <div class="title">
                <h3>1. Twoje dane</h3>
            </div>
            <button>Logowanie</button>
            <p>Masz już konto? Kliknij żeby się zalogować.</p>
            <input type="text" placeholder="Login*" class="input" required>
            <input type="password" placeholder="Hasło*" class="input" required>
            <input type="password" placeholder="Potwierdź hasło*" class="input" required>
            <input type="text" name="" id="" placeholder="Imię*" class="input" required>
            <input type="text" placeholder="Nazwisko*" class="input" required>
            <select name="kraj" id="kraj">
                <option value="polska">Polska</option>
                <option value="reszta">Reszta świata</option>
            </select>
            <input type="text" placeholder="Adres*" class="input" required>
            <input type="text" placeholder="Kod pocztowy*" class="input" required>
            <input type="text" placeholder="Miasto*" class="input" required>
            <input type="tel" placeholder="Telefon*" class="input" required>
            <div class="checkboxContainer">
                <input type="checkbox" value="innyAdres" name="innyAdres"><label for="innyAdres"> Dostawa pod inny
                    adres</label>
            </div>
        </div>
        <div class="metody">
            <div class="dostawy">
                <div class="title">
                    <h3>2. Metoda dostawy</h3>
                </div>
                <input type="radio" class="input" name="dostawa"> <label for=""> Paczkomaty 24/7</label><br>
                <input type="radio" class="input" name="dostawa"> <label for=""> Kurier DPD</label><br>
                <input type="radio" class="input" name="dostawa"> <label for=""> Kurier DPD pobranie</label>
            </div>
            <div class="platnosci">
                <div class="title">
                    <h3>3. Metoda płatności</h3>
                </div>
                <input type="radio" class="input" name="platnosc"> <label for=""> PayU</label><br>
                <input type="radio" class="input" name="platnosc"> <label for=""> Płatności przy odbiorze</label><br>
                <input type="radio" class="input" name="platnosc"> <label for=""> Przelew bankowy - zwykły</label><br>
                <button>Dodaj kod rabatowy</button>
            </div>
        </div>
        <div class="podsumowanie">
            <div class="title">
                <h3>4. Podsumowanie</h3>
            </div>
            <div class="item">
                <div class="image-box">
                    <img src="https://picsum.photos/200/100" alt="">
                </div>
                <div class="opis">
                    <h4>Testowy produkt</h4>
                </div>
                <div class="licznik">1</div>
                <div class="cena">115zł</div>

            </div>
            <div class="item">
                <div class="image-box">
                    <img src="https://picsum.photos/300/150" alt="">
                </div>
                <div class="opis">
                    <h4>Testowy produkt</h4>
                </div>
                <div class="licznik">1</div>
                <div class="cena">115zł</div>

            </div>
            <hr class="hr-top">
            <div class="czesciowa">
                <p>Suma częściowa</p>
                <p style="text-align: right;">115,00zł</p>
            </div>
            <div class="lacznie">
                <p>Łącznie</p>
                <p style="text-align: right;">115,00zł</p>
            </div>
            <hr class="hr-bot">
            <textarea name="" id="komentarz" cols="30" rows="5" placeholder="Komentarz"></textarea>
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
</body>

</html>