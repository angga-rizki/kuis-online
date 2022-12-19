<style>
    body {
        background: url("<?= base_url(); ?>/../assets/bg.jpg") top;
        font-family: sans-serif;
        width: 100%;
    }

    form {
        margin: auto;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 2px solid;
        border-radius: 4px;
        width: 500px;
        text-align: center;
        font-weight: bold;
        background: rgba(255, 255, 255, 0.5);
    }
    form input {
        margin: 5px;
        height: 30px;
        width: 150px;
        border-radius: 4px;
        border: 2px solid;
    }
    form input[type=submit] {
        width: 100px;
        height: 40px;
        margin: 20px 0 30px 0;
        cursor: pointer; 
        font-weight: bold;
        font-size: 16px;
        background-image: linear-gradient(to bottom, rgba(102, 255, 102, 0.3) 0%, rgba(102, 255, 102, 1) 50%, rgba(102, 255, 102, 0.4) 100%);
    }
</style>


<head>
    <title>Login</title>
</head>
<?= \Config\Services::validation()->listErrors(); ?>

<form action="<?= site_url('auth/login') ?>" method="post">
    <h2>Login</h2>
    <?= csrf_field() ?>
    <div style="color: red;margin-bottom: 15px;">    
        <?php
        if (session()->has('message')) {
            echo session()->getFlashdata('message');
        }
        ?>  
    </div>

    <label for="username">Username</label>
    <input type="text" name="username"><br>

    <label for="password">Password</label>
    <input type="password" name="password"><br>

    <input type="submit" name="submit" value="Login">
</form>