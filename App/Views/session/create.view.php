<?php component('header', compact('page_title')); ?>
<?php component('navbar'); ?>
<?php $errors = errors(); ?>
    <h1 class="special-h1 normal-h1"><span>Login</span></h1>
    <form action="/login" method="post">
        <div class="form-field">
            <label for="username">Username</label>
            <input placeholder="Joe" type="text" name="username" id="username" required>
        </div>
        <?php if (isset($errors['username'])): ?>
            <p class="form-error"><?= $errors['username'][0] ?></p>
        <?php endif; ?>
        <div class="form-field">
            <label for="password">Password</label>
            <input placeholder="********" type="password" name="password" id="password" required>
        </div>
        <?php if (isset($errors['password'])): ?>
            <p class="form-error"><?= $errors['password'][0] ?></p>
        <?php endif; ?>
        <div class="form-button-container">
            <div class="form-button">
                <button>Login</button>
            </div>
        </div>
    </form>
<?php component('footer'); ?>
