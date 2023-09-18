<?php include __DIR__ . '/utils/header.php'; ?>

<div class="container mt-5">

    <form method="post" action="/save-contact<?= isset($contact) ? '?id=' . $contact->getId() : ''; ?>">
        <input type="hidden" name="id" value="<?= isset($contact) ? $contact->getId() : ''; ?>">
        <div class="jumbotron">
            <h1 class="display-4"><?= isset($contact) ? "Update Contact " . $contact->getName() : "Create Contact" ?></h1>
        </div>
        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-6">
                <h2>Contact Information</h2>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="<?php echo isset($contact) ? $contact->getName() : ''; ?>" required placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo isset($contact) ? $contact->getEmail() : ''; ?>" required placeholder="Enter Email">
                </div>
            </div>

            <!-- Address Information -->
            <div class="col-md-6">
                <h2>Address Information</h2>
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" class="form-control" name="street" value="<?php echo isset($contact) ? $contact->getAddress()->getStreet() : ''; ?>" required placeholder="Enter Street">
                </div>
                <div class="form-group">
                    <label for="numberHome">House Number:</label>
                    <input type="text" class="form-control" name="numberHome" value="<?php echo isset($contact) ? $contact->getAddress()->getHomeNumber() : ''; ?>" required placeholder="Enter House Number">
                </div>
                <div class="form-group">
                    <label for="complement">Complement:</label>
                    <input type="text" class="form-control" name="complement" value="<?php echo isset($contact) ? $contact->getAddress()->getComplement() : ''; ?>" placeholder="Enter Complement">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="zipCode">ZIP Code:</label>
                        <input type="text" class="form-control" name="zipCode" value="<?php echo isset($contact) ? $contact->getAddress()->getZipCode() : ''; ?>" required placeholder="Enter ZIP Code">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" name="city" value="<?php echo isset($contact) ? $contact->getAddress()->getCity() : ''; ?>" required placeholder="Enter City">
                    </div>
                </div>
                <div class="form-group">
                    <label for="state">State (2-letter):</label>
                    <input type="text" class="form-control" name="state" maxlength="2" value="<?php echo isset($contact) ? $contact->getAddress()->getState() : ''; ?>" required placeholder="Enter State (2-letter)">
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Phone 1 -->
            <div class="col-md-6">
                <h2>Phone 1</h2>
                <div class="form-group">
                    <label for="areaCode1">Area Code:</label>
                    <input type="text" class="form-control" id="areaCode1" name="areaCode1" value="<?php echo isset($contact) ? $contact->getPhones()[0]->getAreaCode() : ''; ?>" placeholder="Enter Area Code">
                </div>
                <div class="form-group">
                    <label for="phoneNumber1">Phone Number:</label>
                    <input type="text" class="form-control" id="phoneNumber1" name="phoneNumber1" value="<?php echo isset($contact) ? $contact->getPhones()[0]->getNumber() : ''; ?>" placeholder="Enter Phone Number">
                </div>
            </div>

            <!-- Phone 2 -->
            <div class="col-md-6">
                <h2>Phone 2</h2>
                <div class="form-group">
                    <label for="areaCode2">Area Code:</label>
                    <input type="text" class="form-control" id="areaCode2" name="areaCode2" value="<?php echo isset($contact) ? $contact->getPhones()[1]->getAreaCode() : ''; ?>" placeholder="Enter Area Code">
                </div>
                <div class="form-group">
                    <label for="phoneNumber2">Phone Number:</label>
                    <input type="text" class="form-control" id="phoneNumber2" name="phoneNumber2" value="<?php echo isset($contact) ? $contact->getPhones()[1]->getNumber() : ''; ?>" placeholder="Enter Phone Number">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    <?php echo isset($_GET['id']) ? 'Update' : 'Register'; ?>
                </button>
            </div>
        </div>
    </form>
</div>

<?php include __DIR__ . '/utils/footer.php'; ?>
