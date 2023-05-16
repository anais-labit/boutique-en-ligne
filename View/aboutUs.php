<?php

is_file("../config.php") == true ?
    require_once '../config.php' :
    require_once '../../config.php';

require_once ROOT_DIR . '/vendor/autoload.php';

if (session_id() == "") session_start();


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="../src/Controller/singleCard.js"></script>
    <link rel="stylesheet" href="global.css">
    <title>Product page</title>
</head>

<body>

    <?php include 'header.php' ?>

    <div class="aboutUs-page">
        <h1 class="heading">Qui<span> sommes-nous ?</span></h1>
        <div class="us-description">
            <h3> Qualité, transparence et traçabilité des produits sont devenus aujourd’hui des maitres-mots dans notre société où nous sommes de plus en plus nombreux à nous interroger sur la provenance de ce que nous achetons, de ce que nous consommons. </h3>
            <p>L’idée de mettre en relation producteurs et consommateurs n’est pas nouvelle mais nous avons choisi de la décliner autour d’un concept inédit, pensé pour vous : une plateforme internet réservée aux produits, aux fabrications et à l’artisanat français.
            <p>À l’origine du projet, un constat évident :
            <ul>
                <li>Les échanges sont inéquitables entre le producteur et le consommateur du fait d’un trop grand nombre d’intermédiaires.</li>
                <li>Le territoire français est riche de savoir-faire qui ne sont pas mis en avant, car trop souvent noyés dans l’industrialisation et la standardisation.</li>
                <li>Le système de consommation que l’on nous propose, promeut sans cesse les mêmes produits, les mêmes marques, les mêmes multinationales.</li>
                <li>Les producteurs ne sont plus maîtres de leurs produits car les prix sont définis par la grande distribution.</li>
                <li>La provenance des marchandises est souvent floue. La difficulté de se procurer des articles français est une réalité alors qu’ils existent fréquemment à deux pas de chez nous.</li>
            </ul>

            <p>Il est essentiel de favoriser des circuits courts éthiques qui, par la suppression des intermédiaires font (re)marcher l’économie locale et (re)créent un lien entre consommateurs et producteurs, basés sur l’entraide.</p>

            <div class="divider"></div>

            <img src="../View/assets/images/perso-client-heureux.svg" alt="image personne client heureux">

            <h3 class="heading">Du<span> circuit court en ligne</span></h3>

            <p>Fresh Market vous propose un panel de boutiques créées par les producteurs et artisans. Ainsi quand vous acheter en ligne vous commandez directement à la ferme ou dans l'atelier. Une proximité entre le producteur et vous qui permet une meilleure transparence. On peut ainsi se faire plaisir en achetant directement aux producteurs et artisans de toutes la France d'où on veut.</p>
            <h3 class="heading">Nos<span> engagements</span></h3>
            <ul>
                <li>Un circuit de distribution éthique et écologique par la suppression des intermédiaires et des transports inutiles,</li>
                <li>Traçabilité et transparence des produits,</li>
                <li>La défense de la qualité et des produits français,</li>
                <li>Des producteurs et artisans libres qui fixent leurs justes prix et marges.</li>
            </ul>

            <p>Fresh Market promet une grande variété de produits français sans intermédiaires. Les produits sont cultivés, fabriqués, transformés sur le territoire Français et assurent l’emploi local.</p>
        </div>


    </div>

</body>