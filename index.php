

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prezentare aplicatie</title>
    <link rel="stylesheet" href="ciorna.css">
</head>
<body>
    
    <h1> In aceasta pagina vom prezenta, pe scurt, aplicatia, sistemul de functionare al acesteia si schema bazei de date</h1>
    <div style="display: flex; flex-direction: row; margin-left: 20px; margin-right: 20px; font-size: 18px;">
        <div style="display: flex; flex-direction: column;">
        <p>
        Aplicatia reprezinta un sistem pentru organizarea evenimentelor.
        Un uitlizator isi poate creea un cont, pe care il va activa ulterior printr-un link 
        trimis pe mail.Se memoreaza printr-un int (by default 0) verificarea contului,
        iar cand linkul trimis pe mail este accesat, acesta primeste valoarea 1. 
        Un utilizator al carui cont nu a fost verificat, nu se va putea loga pe site. 
        Toate informatiile de conectare ale utilizatorilor sunt mentinute in tabelul <strong style="color: red">users</strong> din baza de date </p>
        <p> In tabelul <strong style="color: red">rss_info</strong> sunt mentinute detaliile unui local, local 
    care este detinut de unul dintre utilizatori, atribut specificat prin cheia secundara proprietar_id care face referinta 
    catre    <strong style="color: red">users(userID)</strong>    </p>
    <p> Ideea din spate este una simpla, un utilizator isi creeaza un cont iar mai apoi isi poate posta localul prin aceasta aplicatie 
        pentru a fi vizibila pentru toti utilizatorii siteului, care, isi pot rezerva un eveniment la localul respectiv </p>
        <p>Tote informatiile despre o rezervare vor fi gasite in tabelul <strong style="color: red">reservation</strong>,
        unde sunt stocate atat idul localului rezervat, cat si idul utilizatorului care a facut rezervarea; </p>
        <p> Putem astfel sa deducem cine a rezervat un local anume si in ce data, lucru foarte util pentru pagina 
        <strong style="color: green">Profile</strong> a utilizatorului </p>
        <p> Momentan doar paginile de signup si login sunt complet functionale, deci pot fi testate. </p>
        <p> Intra pe pagina principala a siteului <a href="index1.php" target="blank"> aici </a>
        <p style="weight: bold;"> update: </p>
        <p> Am adaugat la pagina de login reCaptcha; Pentru prevenirea form spoofingului si cross script 
            am utilizat cat mai multe metode de validare a inputului, astfel incat chiar daca in formular 
            sunt introduse alte date, neasteptate, acestea nu vor ajunge niciodata pe server;  </p>
            <p> de altfel, am distrus si creat o noua 
            sesiune de fiecare data cand un utilizator se logheaza pe site (metoda foarte eficienta impotriva 
            fixarii sesiunii, metoda in care unui utilizator ii este trimis 
            siteul cu o sesiune deja fixata, iar atacatorul se va folosi de aceasta pentru 
            a accesa informatiile din contul utilizatorului; se poate testa, pentru login am creat contul de test) </p>
        <p style="color: green"> id: test1;  pass: testpass </p> <br>
        <p> in ceea ce priveste sql injection am folosit mereu mysqli cu prepared_statement pentru a evita orice 
            incercare de introducere in baza de date a unui user-input "malformat" </p>
        <p> validarea de user-input se poate gasi in folderul <strong style="color: green"> Includes/functions.inc.php </strong> </p>
        
        </div>
    <div>
    <img src="database_scheme.PNG" alt="????" style="width:500px; height: 400px;"/>
    </div></div>
</body>
</html>