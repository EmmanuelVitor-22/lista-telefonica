<?php include __DIR__ . '/views/header.php'; ?>

<div class="container">
    <div class="jumbotron">
        <h1 class="mt-4">Contact List</h1>
    </div>
    <a href="/register" class="btn btn-primary mb-2">New</a>
    <div class="container">

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
    </div>
<div class="container">
<?php include __DIR__ . '/views/footer.php'; ?>