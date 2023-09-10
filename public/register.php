
<head>
    <title>Cadastro de Contato</title>
    <!-- Incluir os links para o Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-4">Cadastro de Contato</h1>
    <form method="post" action="list-contacts.php">
        <!-- Campos de dados do contato -->
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <!-- Campos de endereço -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="street">Rua:</label>
                <input type="text" class="form-control" name="street" required>
            </div>

            <div class="form-group col-md-3">
                <label for="number">Número:</label>
                <input type="text" class="form-control" name="number" required>
            </div>

            <div class="form-group col-md-3">
                <label for="complement">Complemento:</label>
                <input type="text" class="form-control" name="complement">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="zipCode">CEP:</label>
                <input type="text" class="form-control" name="zipCode" required>
            </div>

            <div class="form-group col-md-4">
                <label for="city">Cidade:</label>
                <input type="text" class="form-control" name="city" required>
            </div>

            <div class="form-group col-md-4">
                <label for="state">Estado:</label>
                <input type="text" class="form-control" name="state" required>
            </div>
        </div>

        <!-- Campos de telefone -->
        <div class="row">
            <!-- Telefone 1 -->
            <div class="col-md-6">
                <h2>Telefone 1</h2>
                <div class="mb-3">
                    <label for="areaCode1" class="form-label">Código de Área:</label>
                    <input type="text" class="form-control" id="areaCode1" name="areaCode1" required>
                </div>
                <div class="mb-3">
                    <label for="phoneNumber1" class="form-label">Número de Telefone:</label>
                    <input type="text" class="form-control" id="phoneNumber1" name="phoneNumber1" required>
                </div>
            </div>

            <!-- Telefone 2 -->
            <div class="col-md-6">
                <h2>Telefone 2</h2>
                <div class="mb-3">
                    <label for="areaCode2" class="form-label">Código de Área:</label>
                    <input type="text" class="form-control" id="areaCode2" name="areaCode2" required>
                </div>
                <div class="mb-3">
                    <label for="phoneNumber2" class="form-label">Número de Telefone:</label>
                    <input type="text" class="form-control" id="phoneNumber2" name="phoneNumber2" required>
                </div>
            </div>
        </div>



        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

</div>

</body>



