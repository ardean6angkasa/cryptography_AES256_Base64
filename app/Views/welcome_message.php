<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cryptography</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="/css/animate.min.css">
    <style type="text/css">
        .preloader-single {
            background: #fff;
            width: 100%;
            height: 350px;
            padding: 20px;
        }

        .preloader {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
        }

        .preloader .loading {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font: 14px arial;
        }

        .preloader .loading p {
            font-size: 16px;
            font-weight: bold;
        }

        .copyButton {
            background-color: #007bff;
            padding: 5px 15px;
            border: none;
            color: white;
            font-size: 18px;
            border-radius: 2px;
            cursor: pointer;
        }

        .alert2 {
            position: absolute;
            margin: auto;
            background-color: #212529;
            color: white;
            padding: 10px 0;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            left: 0;
            right: 0;
            bottom: 0;
            display: none;
        }
    </style>
    <script>
        $(document).ready(function () {
            $(".preloader").fadeOut();

        })
    </script>
</head>

<body style="background-color:#163257;">
    <div class="preloader bg-light" id="preloader" style="text-align: center;">
        <div class="loading">
            <img src="/img/profile.gif" style="width:40%">
            <h6>Processing....</h6>
        </div>
    </div>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="flashdata" data-flashdata="<?= session()->getFlashdata('msg') ?>"></div>
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="col-lg-11">
                            <div class="p-5">

                                <div class="text-center">
                                    <?php if (empty(session()->get('type'))): ?>
                                        <h1 class="h4 mb-2">Encrypt a Text</h1>
                                    <?php else: ?>
                                        <h1 class="h4 mb-2">Decrypt a Text</h1>
                                    <?php endif; ?>
                                </div>
                                <form action="<?= base_url('/encrypt'); ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="form-floating mb-3">
                                        <textarea type="text" class="form-control <?php if (isset($validation)): ?>
                                                <?= ($validation->hasError('text')) ? 'is-invalid' : ''; ?>
                                                <?php endif; ?>" name="text" placeholder=""
                                            style="height: 6rem; color:black"><?= old('text'); ?></textarea>
                                        <label>Text</label>
                                        <div class="invalid-feedback">
                                            <?php if (isset($validation)): ?>
                                                <?= $validation->getError('text'); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if (empty(session()->get('type'))): ?>
                                        <?php foreach ($cryptool as $row): ?>
                                            <div style="text-align: center;">
                                                <p style="color:black; display: inline;">Your decrypted message: </p>
                                                <span style="color:black;">
                                                    <?= $row->text; ?>
                                                </span>
                                            </div>
                                            <input type="hidden" name="id" value='<?= $row->id; ?>'>
                                        <?php endforeach; ?>
                                        <div style="text-align: right;">
                                            <button type="submit"
                                                class="btn btn-outline-primary rounded-pill">Encrypt</button>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($cryptool as $row): ?>
                                            <input type="hidden" name="id" value='<?= $row->id; ?>'>
                                            <div style="text-align: center;">
                                                <p style="color:black; display: inline;">Your encrypted message: </p>
                                                <span style="color:black;" id="text1">
                                                    <?= $row->text; ?>
                                                </span>
                                            </div>
                                        <?php endforeach; ?>
                                        <br>
                                        <div style="text-align: center;">
                                            <button class="copyButton" id="copyButton1" type='button'>
                                                Copy text
                                            </button>
                                        </div>
                                        <div style="text-align: right;">
                                            <button type="submit"
                                                class="btn btn-outline-primary rounded-pill">Decrypt</button>
                                        </div>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                        <span class="alert2">Copied!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function copy(copyId) {
            var $inp = $("<input>");
            $("body").append($inp);
            var textToCopy = $(copyId).text().trim();
            $inp.val(textToCopy).select();
            document.execCommand("copy");
            $inp.remove();
            $(".alert2").fadeIn(1000, function () {
                $(".alert2").fadeOut();
            });
        }
        $(document).ready(function () {
            $("#copyButton1").click(
                function () {
                    copy('#text1');
                });
        });
    </script>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/sweetalert2.all.min.js"></script>
    <script src="/js/myscript.js"></script>
</body>

</html>