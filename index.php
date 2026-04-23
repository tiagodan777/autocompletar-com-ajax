<?php
require_once 'assets.php';

$search = $_GET['search'] ?? null;
if ($search) {
    $sql = "SELECT texto FROM termos
            WHERE texto LIKE :contains
            ORDER BY
                CASE
                    WHEN texto = :exact THEN 1
                    WHEN texto LIKE :starts THEN 2
                    WHEN texto LIKE :contains1 THEN 3
                    ELSE 4
                END,
                CHAR_LENGTH(texto),
                texto
            LIMIT 8;";
    $autocomple = pdo($pdo, $sql,
                                ['contains' => '%' . $search . '%',
                                'contains1' => '%' . $search . '%',
                                'starts' => '%' . $search,
                                'exact' => $search,])->fetchAll();
    echo json_encode($autocomple);
    die();
} else {
    echo '';
}
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autocompletar</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <form action="index.php" method="get">
            <div id="searchBox">
                <input type="search" name="search" id="search" placeholder="Pesquisa" autocomplete="off">
                <input type="submit" value="Pesquisar">
            </div>
            <div id="recomendationsBox">
                <ul id="list">
                    
                </ul>
            </div>
        </form>
    </header>
    <script src="js/jquery-4.0.0.js"></script>
    <script src="js/index.js"></script>
</body>
</html>