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
            <!-- Adicione mais cabeçalhos de coluna conforme necessário -->
        </tr>
        <?php foreach ($obj->findAll() as $contact): ?>
    <tr>
        <td><?php echo $contact->getName(); ?></td>
        <td><?php echo $contact->getEmail(); ?></td>
        <!-- Adicione mais células de coluna conforme necessário -->
    </tr>
    <?php endforeach; ?>
    </table>

</div>
