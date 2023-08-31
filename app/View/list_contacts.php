<div>
    <?php

    use App\Model\Contact;

    require_once __DIR__ . '/../../vendor/autoload.php';
    include __DIR__ . '/../Model/Contact.php';

    $obj = new Contact();





    ?>

        <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Telefones</th>
            <th>Rua</th>
            <!-- Adicione mais cabeçalhos de coluna conforme necessário -->
        </tr>
        <?php foreach ($obj->findAll() as $contact): ?>
    <tr>
        <td><?php echo $contact->getName(); ?></td>
        <td><?php echo $contact->getEmail(); ?></td>
<!--        pecorre para mapear todos os contatos que existem vinculados-->
        <td><?php
            foreach ($contact->getPhones() as $phone) {
                echo "<p>" .$phone->formattedPhone(). "</p>";
            }
            ?></td>
        <td><?php
                echo "<p>" .$contact->getAddress()->getStreet(). "</p>";

            ?></td>

        <!-- Adicione mais células de coluna conforme necessário -->
    </tr>
    <?php endforeach; ?>
    </table>

</div>
