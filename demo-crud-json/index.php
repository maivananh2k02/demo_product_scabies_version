<?php
include_once 'Data.php';
include_once 'Product.php';
$result = Data::loadData();
if (isset($_REQUEST['page'])) {
    if ($_REQUEST['page'] == 'delete') {
            $id = $_REQUEST['id'];
            array_splice($result, $id, 1);
            Data::saveData($result);
            header("location:index.php");
    }
}
if (isset($_REQUEST['sort'])) {
    if ($_REQUEST['sort'] == 'up') {
        $result = Data::sortProductByPrice('up');
    } else {
        $result = Data::sortProductByPrice('down');
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .todolist {
            text-align: center;
            width: 50px;
        }

        .img {
            text-align: center;
        }

        th, td {
            width: 50px;
        }

        .btn-outline-success {
            width: 125px;
        }

        #navbarDropdown {
            position: relative;
            left: 1090px;
        }
    </style>
</head>
<body>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="#">Product Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <form method="post">
                    <button name="logOut">LogOut</button>
                </form>
                <?php
                if (isset($_REQUEST['logOut'])) {
                    session_destroy();
                    header('location: home.php');
                }
                ?>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
</body>
</html>
<a href="add_product.php" class="btn btn-outline-success">add</a>

<span><a href="#" class="btn btn-light" id="navbarDropdown" role="button" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        Sắp xếp ↕
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="index.php?sort=up">Tăng theo giá ↑</a>
        <a class="dropdown-item" href="index.php?sort=down">Giảm theo giá ↓</a>
    </div>
        </span>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Stt</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th class="img" scope="col">Image</th>
        <th class="todolist" colspan="2">Todolist</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $key => $product): ?>
        <tr>
            <td><?php echo $key + 1 ?></td>
            <td><?php echo $product->getName() ?></td>
            <td><?php echo $product->getPrice() ?></td>
            <td class="img"><img style="width: 300px " src="<?php echo $product->getImg() ?> " alt=""></td>
            <td class="todolist"><a onclick="confirm('are you sure?')" href="index.php?page=delete&id=<?php echo $key ?>">Delete</a></td>
            <td><a href="edit_product.php?id=<?php echo $product->getId() ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

