<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Test - Logic</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Pacifico&display=swap" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="nav-logo">
            <h4>Logic Program</h4>
        </div>
    </nav>
    <div class="form-container">
        <form action="" method="POST">
            <div class="row">
                <div class="col-index">
                    <label for="#index-number">Insert Number for Array Index:</label>
                    <button class="btn-add" type="button">Add</button>
                    <div id="index-number">
                        <input type="number" class="input-index" placeholder="Value-1" name="index-1" />
                        <input type="number" class="input-index" placeholder="Value-2" name="index-2" />
                        <input type="number" class="input-index" placeholder="Value-3" name="index-3" />
                        <input type="number" class="input-index" placeholder="Value-4" name="index-4" />
                    </div>
                </div>
                <div class="col-target">
                    <label for="#target-number">Insert Target Value:</label>
                    <div id="target-number">
                        <input type="number" class="input-target" placeholder="Target" name="target-value" />
                    </div>
                </div>
            </div>
            <button class="btn-submit" type="submit">Generate</button>
        </form>
    </div>
</body>

</html>