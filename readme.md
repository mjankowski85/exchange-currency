Kod realizuje zadanie przeliczania walut EUR <=> GBP oraz naliczanie prowizji. Napisany jest zgodnie z DDD taktycznym i praktykami SOLID. Ma formę prostego pojedynczego hexagonu z portem dla repozytorium

# Instalacja
Aby zbudować środowisko za pierwszym razem wykonać `make build`, po zbudowaniu obrazu uruchamiamy kontener za pomocą `make start`. W celu instalacji dependencji należy wykonać `make bash` a następnie wewnątrz kontenera `composer install`.

# Testy
Uruchamianie testów `make test`. Uruchamiane jest kilka skryptów sprawdzających jakość kodu (szczegóły w Makefile)

# Info
Klasę **CurrencyExchangeRateRepository** umieściłem w warstwie infrastruktury, choć pewnie w tej formie lepiej by ją umieścić w katalogu z testami, a w warstwie infrastruktury zaimplementować docelowe repository
Dodałem też testy dla mocka tego repository.