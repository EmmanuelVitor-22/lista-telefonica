<div>


    <head>
        <title>Cadastro de Contato</title>
        <!-- Incluir os links para o Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <dive class="container">
        <div class="jumbotron">
            <h1 class="mt-4">Lista de Contatos</h1>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Numbers</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact): ?>
                <tr>

                    <td><?php echo $contact->getId(); ?></td>
                    <td><?php echo $contact->getName(); ?></td>
                    <td><?php echo $contact->getEmail(); ?></td>
                    <td>
                        <?php
                        foreach ($contact->getPhones() as $phone) {
                            echo $phone->formattedPhone() . "<br>";
                        }
                        ?>
                    </td>

                </tr>
            <?php endforeach; ?>

        </table>
    </dive>
    <a href="/register" class="btn btn-primary mb-2">New</a>


</div>
