<?php
$myvar = getenv('SENDGRID_API_KEY');
echo $myvar; ?>

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
        
        </div>
    <div>
    <img src="/uploads/database_scheme.png" alt="" width="500" height="400">
    </div></div>
</body>
</html>