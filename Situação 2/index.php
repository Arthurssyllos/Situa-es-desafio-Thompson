<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situação 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right top, #ff6e7f, #bfe9ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #F0F8FF;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: calc(100% - 8px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #B0E0E6;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s, color 0.3s;
        }

        button:hover {
            background-color: #D8BFD8;
            color: black;
        }

        .hashtag {
            font-weight: normal;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Geração de Hashtags</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="frase">Digite uma frase:</label>
            <input type="text" name="frase" id="frase" required>
            <button type="submit">Gerar Hashtags</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $frase = $_POST["frase"];
            $hashtags = gerarHashtags($frase);
            echo "<p>Hashtags geradas:</p>";
            foreach ($hashtags as $hashtag) {
                echo "<p class='hashtag'>#$hashtag</p>";
            }
        }

        function gerarHashtags($frase) {

            $frase = preg_replace('/[áàâãä]/u', 'a', $frase);
            $frase = preg_replace('/[éèêë]/u', 'e', $frase);
            $frase = preg_replace('/[íìîï]/u', 'i', $frase);
            $frase = preg_replace('/[óòôõö]/u', 'o', $frase);
            $frase = preg_replace('/[úùûü]/u', 'u', $frase);
            $frase = preg_replace('/[ç]/u', 'c', $frase);

            $frase = ucwords(strtolower($frase));

            $frase = str_ireplace(array("não", "Nao", "Não"), "", $frase);

            $hashtags = str_replace(' ', '', $frase);
            return [$hashtags];
        }
        ?>
    </div>
</body>
</html>
