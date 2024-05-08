<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situação 1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right top, #a8edea, #fed6e3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adicionando sombra */
            padding: 20px;
            width: 300px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input[type="number"] {
            width: calc(100% - 8px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="text-align: center;">Classificação de Pacotes</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="peso">Digite o peso do pacote (em kg):</label>
            <input type="number" step="0.01" name="peso" id="peso" required>
            <button type="submit">Classificar</button>
        </form>
        <?php
        function classificarPacote($peso) {
            if ($peso <= 3) {
                return "Leve";
            } elseif ($peso <= 10) {
                return "Médio";
            } elseif ($peso <= 100) {
                return "Pesado";
            } else {
                return "Muito Pesado";
            }
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $peso = $_POST["peso"];
            $classificacao = classificarPacote($peso);
            echo "<p>Classificação do pacote: $classificacao</p>";
        }
        ?>
    </div>
</body>
</html>
