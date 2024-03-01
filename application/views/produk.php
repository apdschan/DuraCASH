<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Data Display</title>
</head>
<body>
    <h1>API Data Display</h1>
    
    <ul>
        <?php foreach ($api_data as $item): ?>
            <li>
                <?= $item->NamaProduk?> - 
                <?= $item->KategoriID ?> - 
                <?= $item->HargaProduk?> - 
                <?= $item->Stok?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>