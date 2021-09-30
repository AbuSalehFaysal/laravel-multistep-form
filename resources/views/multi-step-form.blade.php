<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/custom.css">

    <title>Multi Step Form</title>

    
</head>

<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header text-white bg-info">
                            <h5>Multi Step Form</h5>
                        </div>
                        <div class="card-body">
                            <form class="contact-form" action="{{route('form.formsubmit')}}" method="POST">
                                @csrf
                                <div class="form-section">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name="firstname" id="" class="form-control" required>

                                    <label for="lastname">Last Name</label>
                                    <input type="text" name="lastname" id="" class="form-control" required>
                                </div>

                                <div class="form-section">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="" class="form-control" required>

                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="" class="form-control" required>
                                </div>

                                <div class="form-section">
                                    <label for="msg">Message</label>
                                    <input type="text" name="msg" id="" class="form-control" required>
                                </div>

                                <div class="form-navigation d-flex justify-content-between mt-2">
                                    <button type="button" class="previous btn btn-info">Previous</button>
                                    <button type="button" class="next btn btn-info">Next</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Parsley JS -->
    <script src="assets/js/parsley.min.js"></script>

    <script>
        $(function() {
            var $sections = $('.form-section');

            function navigateTo(index) {
                $sections.removeClass('current').eq(index).addClass('current');
                $('.form-navigation .previous').toggle(index > 0);
                var atTheEnd = index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [type=submit]').toggle(atTheEnd);
            }

            function curIndex() {
                return $sections.index($sections.filter('.current'));
            }

            $('.form-navigation .previous').click(function() {
                navigateTo(curIndex()-1);
            });

            $('.form-navigation .next').click(function() {
                $('.contact-form').parsley().whenValidate({
                    group: 'block-' + curIndex()
                }).done(function() {
                    navigateTo(curIndex()+1);
                });
            });

            $sections.each(function(index,section) {
                $(section).find(':input').attr('data-parsley-group','block-'+index);
            });

            navigateTo(0);
        });
    </script>
</body>

</html>