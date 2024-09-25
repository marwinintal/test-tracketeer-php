<?php include 'includes/header.php'; ?>
<div class="container">
    <div class="my-5">
        <?php if ($registrationHandler->getSuccessMessage()): ?>
            <div class="alert alert-success mb-2" role="alert">
                <?= htmlspecialchars($registrationHandler->getSuccessMessage() ?? "") ?>
            </div>
        <?php endif; ?>

        <?php if ($registrationHandler->getErrorMessage()): ?>
            <div class="alert alert-danger mb-2" role="alert">
                <?= htmlspecialchars($registrationHandler->getErrorMessage() ?? "") ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="register-form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($registrationHandler->getUsername() ?? "") ?>" required>
                        <span class="error help-block text-danger"><?= $registrationHandler->getUsernameError() ?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <span class="error help-block text-danger"><?= $registrationHandler->getConfirmpasswordError() ?></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($registrationHandler->getName() ?? "") ?>" required>
                        <span class="error help-block text-danger"><?= $registrationHandler->getNameError() ?></span>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($registrationHandler->getEmail() ?? "") ?>" required>
                                    <span class="error help-block text-danger"><?= $registrationHandler->getEmailError() ?></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="tel" name="telephone" id="telephone" class="form-control" value="<?= htmlspecialchars($registrationHandler->getTelephone() ?? "") ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <Label>Address</Label>
                    <div class="form-group">
                        <input type="text" name="address_1" id="address_1" class="form-control" placeholder="Address 1" value="<?= htmlspecialchars($registrationHandler->getAddress1() ?? "") ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="address_2" id="address_2" class="form-control" placeholder="Address 2" value="<?= htmlspecialchars($registrationHandler->getAddress2() ?? "") ?>">
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <input type="text" name="state" id="state" class="form-control" placeholder="State" value="<?= htmlspecialchars($registrationHandler->getState() ?? "") ?>">
                            </div>
                            <div class="col-4">
                                <input type="text" name="city" id="city" class="form-control" placeholder="City" value="<?= htmlspecialchars($registrationHandler->getCity() ?? "") ?>">
                            </div>
                            <div class="col-4">
                                <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Postal Code" value="<?= htmlspecialchars($registrationHandler->getPostalCode() ?? "") ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>