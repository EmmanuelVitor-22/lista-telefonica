<div>

    <?php

    require_once __DIR__ . '/../vendor/autoload.php';


    use App\Model\Contact;


    include __DIR__ . '/../Model/Contact.php';

    $obj = new Contact();

    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


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
        <?php foreach ($obj->findAll() as $contact): ?>
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
        <a href="" class="btn btn-primary mb-2">New</a>

</div>
