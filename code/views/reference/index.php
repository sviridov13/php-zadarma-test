<table class='table table-bordered table-condensed table-striped table-hover' id="phones-table">
    <thead>
    <tr class="table-header">
        <th>#</th>
        <th>Номер телефона</th>
        <th id="first-name-th">Имя</th>
        <th id="second-name-th">Фамилия</th>
        <th id="email-th">Почта</th>
        <th>Фото</th>
        <th>Функции</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($phones as $val): ?>
        <tr class="table-row" id="<?php echo $val['phone_id']; ?>" data-href='url://link-for-first-row/'>
            <td class="table-d-id"><?php echo $val['phone_id']; ?></td>
            <td><?php echo $val['phone_number']; ?></td>
            <td><?php echo $val['first_name']; ?></td>
            <td><?php echo $val['second_name']; ?></td>
            <td><?php echo $val['email']; ?></td>
            <td><img src="<?php echo $val['photo']; ?>" style="width: 50px"/></td>
            <td>
                <button class="btn btn-block delete-button" id="<?php echo $val['phone_id']; ?>">Удалить</button>
                <button class="btn btn-block edit-button" id="<?php echo $val['phone_id']; ?>">Редактировать</button>
                <button class="btn btn-block show-button" id="<?php echo $val['phone_id']; ?>">Посмотреть</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<button class="btn btn-success btn-block" id="create-button" style="width: 10%"><span
            class="fa fa-plus-circle"">Создать</span>
</button>
<div class="profile" style="display: none">
    <div class="row">
        <div class="col-md-offset-2 col-md-12 col-lg-offset-3">
            <div class="well">
                <div class="col-sm-12">
                    <div class="col-xs-12 col-sm-8" id="profile">
                        <h2 id="username"></h2>
                        <p><strong id="phone"></strong></p>
                        <p><strong id="email"></strong></p>
                        <button class="btn btn-success btn-block " style="width: 10%" onclick="back()"><span
                                    class="fa fa-plus-circle"></span>Назад
                        </button>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <figure style="float: right">
                            <img id="avatar" src="" alt="user" class="img-circle img-responsive" style="width: 100px">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="edit-record" style="display:none">
    <form enctype="multipart/form-data" action="/update" method="post" id="edit-record-form">
        <div class="form-group">
            <label>Номер телефона</label>
            <p><input type="text" name="phone" id="phone-input" class="form-control"></p>
        </div>
        <div class="form-group">
            <label>Имя</label>
            <p><input type="text" name="first_name" id="first-name-input" class="form-control"></p>
        </div>
        <div class="form-group">
            <label>Фамилия</label>
            <p><input type="text" name="second_name" id="second-name-input" class="form-control"></p>
        </div>
        <div class="form-group">
            <label>Почта</label>
            <p><input type="email" name="email" id="email-input" class="form-control"></p>
        </div>
        <p>Аватар</p>
        <input type="file" name="pic" id="edit-image">
        <b>
            <button type="submit" name="enter" id="update-form">Обновить</button>
        </b>
    </form>
    <button class="btn btn-success btn-block " style="width: 10%" onclick="back2()"><span
                class="fa fa-plus-circle"></span>Назад
    </button>
</div>
<div class="create-record" style="display:none">
    <form role="form" enctype="multipart/form-data" action="/create" method="post" id="create-record-form">
        <div class="form-group">
            <label>Номер телефона</label>
            <p><input type="text" name="phone" class="form-control"></p>
        </div>
        <div class="form-group">
            <label>Фамилия</label>
            <p><input type="text" name="second_name" class="form-control"></p>
        </div>
        <div class="form-group">
            <label>Имя</label>
            <p><input type="text" name="first_name" class="form-control"></p>
        </div>
        <div class="form-group">
            <label>Почта</label>
            <p><input type="email" name="email" class="form-control"></p>
        </div>
        <div class="form-group">
            <label>Аватар</label>
            <p><input type="file" name="pic" class="form-control"></p>
        </div>
        <div class="form-group">
            <input type="submit" id="create-form-button" name="create-record-button" class="btn btn-info" value="Создать">
        </div>
    </form>
    <button class="btn btn-success btn-block " style="width: 10%" onclick="back3()"><span
                class="fa fa-plus-circle"></span>Назад
    </button>
</div>
<script>
    $(document).ready(function ($) {
        $("th").click(function () {
            var id = $(this).attr('id');
            if (id == 'first-name-th') {
                sortTable(3);
            } else if (id == 'second-name-th') {
                sortTable(4);
            }
        });
        $(".show-button").click(function () {
            $("#create-button").css("display", "none");
            var id = $(this).attr('id');
            $.ajax({
                url: "/show",
                type: "get",
                data: {
                    id: id
                },
                success: function (data) {
                    $(".table").css("display", "none");
                    $(".profile").css("display", "");
                    $("#username").text(data['first_name'] + ' ' + data['second_name']);
                    $("#phone").text('Телефон: ' + data['phone_number_prop']);
                    $("#email").text('Email: ' + data['email']);
                    $("#avatar").attr('src', data['photo'])
                }
            });
        });
        $(".delete-button").click(function () {
            var id = $(this).attr('id');
            $.ajax({
                url: "/delete",
                type: "post",
                data: {
                    phone_id: id
                },
                success: function () {
                    document.location.reload(true);
                },
                error: function (err) {
                    console.log(err)
                }
            });
        });
        $("#create-button").click(function () {
            $(".table").css("display", "none");
            $(".create-record").css("display", "");
            $("#create-button").css("display", "none");
        });
        var id;
        $(".edit-button").click(function () {
            id = $(this).attr('id');
            $(".edit-record").css("display", "");
            $(".table").css("display", "none");
            $("#create-button").css("display", "none");
            $.ajax({
                url: "/show",
                type: "get",
                data: {
                    id: id
                },
                success: function (data) {
                    $("#phone-input").val(data['phone_number']);
                    $("#first-name-input").val(data['first_name']);
                    $("#second-name-input").val(data['second_name']);
                    $("#email-input").val(data["email"]);
                }
            });
        });
        $("#edit-record-form").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var data = new FormData(this);
            if ($("#edit-image").val() == '') {
                data.delete("pic");
            }
            data.append("phone_id", id);
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function (data) {
                    document.location.reload(true);
                },
                error: function (err) {
                    console.log(err)
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $("#create-record-form").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var data = new FormData(this);
            $.ajax({
                type: "POST",
                url: url,
                data: data, // serializes the form's elements.
                success: function (data) {
                    document.location.reload(true);
                },
                error: function (err) {

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    });

    function back() {
        $(".table").css("display", "");
        $(".profile").css("display", "none");
        $("#create-button").css("display", "");
    }

    function back2() {
        $(".table").css("display", "");
        $(".edit-record").css("display", "none");
        $("#create-button").css("display", "");
    }

    function back3() {
        $(".table").css("display", "");
        $(".create-record").css("display", "none");
        $("#create-button").css("display", "");
    }


    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("phones-table");
        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>
<style>
    .table-row {
        cursor: pointer;
    }

    .table-header {
        cursor: pointer;
    }

</style>

