# Rezervari local pentru evenimente:

o mica prezentare:
<html>
fiecare user isi va face un cont pe pagina de signup.php (inputul va fi procesat in <p style="color: red"> signup.inc.php </p> )
Fiecare user isi poate adauga un local in cont, creand astfel un anunt cu localul pe care-l detine (din pacate partea asta va mai avea de asteptat - fiind destula bataie de cap cu
procesarea si prelucrarea imaginilor, stiind ca prin fiecare poza inofensiva se poate strecura un script ascuns);
De altfel, fiecare user poate alege un local la care sa isi faca o rezervare pentru o anumita zi (sau sa rezerve tot localul, daca localul dispune de aceasta posibilitate);

Toate aceste informatii vor fi vizibile in pagina de profil (pagina posibila doar dupa logarea userului) din fiecare cont;

Ca elemente de securitate, avem anti form spoofing, xss, sql injection printr-o validare completa a datelor de intrare, o sesiune php sigura (care va impiedica orice 
incercare de fixare a sesiunii) si folosirea "prepared statement"-urilor

</html>
