<?php include __DIR__ . '/views/header.php'; ?>

<div class="container">
    <div class="jumbotron">
        <h1 class="mt-4">Contact List</h1>
    </div>

    <div class="container">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Numbers</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact): ?>
                <tr>

                    <td><?=  $contact->getId(); ?></td>
                    <td><?=  $contact->getName(); ?></td>
                    <td><?=  $contact->getEmail(); ?></td>
                    <td>
                        <?php
                        foreach ($contact->getPhones() as $phone) {
                            echo $phone->formattedPhone() . "<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="/update" class="btn btn-primary btn-sm">Update</a>
                        <a href="/delete?id=<?= $contact->getId(); ?>" class="btn btn-danger btn-sm">Delete</a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </table>
        <div class="d-flex justify-content-between">
            <a href="/register" class="btn btn-danger  mb-2">Delete all</a>
            <a href="/register" class="btn btn-primary mb-2">New</a>
        </div>
    </div>
<div class="container">
<?php include __DIR__ . '/views/footer.php'; ?>