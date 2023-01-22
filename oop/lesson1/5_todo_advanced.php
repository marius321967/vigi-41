<?php

declare(strict_types=1);

/*
Pridėkite papildomo funkcionalumo todo aplikacijai iš praeitos užduoties:
- filter_by_text - filtravimas pagal todo tekstą
------------------------------------------------------------------------
php -f todo.php search "auto"
****
id: 1
nuplauti automobili
2022-03-29 15:00
------------------------------------------------------------------------
- filter_by_date - filtravimas pagal datą. "gt" - greater than, "lt" - less than, "eq" - lygu.
Data gali būti paduodama tik vienu formatu - "YYYY-MM-DD". Jeigu data buvo paduota kitu formatu
arba jeigu ji apskritai nėra validi, grąžinti klaidos pranešimą.
------------------------------------------------------------------------
php -f todo.php filter_by_date "gt" "2022-01-01"
****
id: 1
nuplauti automobili
2022-03-29 15:00
------------------------------------------------------------------------
*/