Kod realizuje zadanie przeliczania walut

# Instalacja
Aby zbudować środowisko za pierwszym razem wykonać **make build**, po zbudowaniu obrazu i wywołaniu **make start** w celu instalacji composera należy wykonać **make bash** a następnie **composer install**.

# Testy
Uruchamianie testów **make test**.

# Todo
Aktualnie mam problem z uruchomieniem phpstana, popracuję nad tm później

# Info
Klasę `CurrencyExchangeRateRepository` umieściłem w warstwie infrastruktury, pewnie w tej formie lepiej by ją umieścić w katalogu z testami, a w warstwie infrastruktury zaimplementować docelowe repository, ale, na co pozwala wprowadzony interfejs.
Dodałem też testy dla mocka tego repository.