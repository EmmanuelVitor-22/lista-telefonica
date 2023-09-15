<?php include __DIR__ . '/views/header.php'; ?>

<div class="container">
    <div class="jumbotron">
        <h1 class="mt-4">Contact Form</h1>
    </div>

    <form method="post" action="/save-contact<?= isset($contact) ? '?id='. $contact->getId() : ''; ?>">
        <input type="hidden" name="id" value="<?= $contact->getId(); ?>">

        <!-- Campos de dados do contato -->
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" name="name" value="<?php echo isset($contact) ? $contact->getName() : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo isset($contact) ? $contact->getEmail() : ''; ?>" required>
        </div>

        <!-- Campos de endereço -->
        <div class="form-group">
            <label for="street">Rua:</label>
            <input type="text" class="form-control" name="street" value="<?php echo isset($contact) ? $contact->getAddress()->getStreet() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="numberHome">Número:</label>
            <input type="text" class="form-control" name="numberHome" value="<?php echo isset($contact) ? $contact->getAddress()->getHomeNumber() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="complement">Complemento:</label>
            <input type="text" class="form-control" name="complement" value="<?php echo isset($contact) ? $contact->getAddress()->getComplement() : ''; ?>">
        </div>
        <div class="form-group">
            <label for="zipCode">CEP:</label>
            <input type="text" class="form-control" name="zipCode" value="<?php echo isset($contact) ? $contact->getAddress()->getZipCode() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" name="city" value="<?php echo isset($contact) ? $contact->getAddress()->getCity() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="state">Estado:</label>
            <input type="text" class="form-control" name="state" maxlength="2" value="<?php echo isset($contact) ? $contact->getAddress()->getState() : ''; ?>" required>
        </div>

        <!-- Campos de telefone -->
        <div class="row">
            <!-- Telefone 1 -->
            <div class="col-md-6">
                <h2>Telefone 1</h2>
                <div class="mb-3">
                    <label for="areaCode1" class="form-label">Código de Área:</label>
                    <input type="text" class="form-control" id="areaCode1" name="areaCode1" value="<?php echo isset($contact) ? $contact->getPhones()[0]->getAreaCode() : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="phoneNumber1" class="form-label">Número de Telefone:</label>
                    <input type="text" class="form-control" id="phoneNumber1" name="phoneNumber1" value="<?php echo isset($contact) ? $contact->getPhones()[0]->getNumber() : ''; ?>">
                </div>
            </div>

            <!-- Telefone 2 -->
            <div class="col-md-6">
                <h2>Telefone 2</h2>
                <div class="mb-3">
                    <label for="areaCode2" class="form-label">Código de Área:</label>
                    <input type="text" class="form-control" id="areaCode2" name="areaCode2" value="<?php echo isset($contact) ? $contact->getPhones()[1]->getAreaCode() : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="phoneNumber2" class="form-label">Número de Telefone:</label>
                    <input type="text" class="form-control" id="phoneNumber2" name="phoneNumber2" value="<?php echo isset($contact) ? $contact->getPhones()[1]->getNumber() : ''; ?>">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <?php echo isset($_GET['id'])  ? 'Atualizar' : 'Cadastrar'; ?>
        </button>
    </form>
</div>

<?php include __DIR__ . '/views/footer.php'; ?>
