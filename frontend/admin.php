<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/styles/bootstrap.min.css" />
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <title>admin</title>
</head>
<body>
<!-- top navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#sidebar"
                aria-controls="offcanvasExample"
        >
            <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
                class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
                href="#"
        >admin</a
        >
        <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#topNavBar"
                aria-controls="topNavBar"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
            <form class="d-flex ms-auto my-3 my-lg-0">
                <div class="input-group">
                    <input
                            class="form-control"
                            type="search"
                            placeholder="Search"
                            aria-label="Search"
                    />
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>
</nav>
<!-- top navigation bar -->
<!-- offcanvas -->
<div
        class="offcanvas offcanvas-start sidebar-nav bg-dark"
        tabindex="-1"
        id="sidebar"
>
    <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
            <ul class="navbar-nav">
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3">
                        CORE
                    </div>
                </li>
                <li>
                    <a href="#" class="nav-link px-3 active">
                        <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                        Interface
                    </div>
                </li>
                <li>
                    <a
                            class="nav-link px-3 sidebar-link"
                            data-bs-toggle="collapse"
                            href="#layouts"
                    >
                        <span class="me-2"><i class="bi bi-layout-split"></i></span>
                        <span>Layouts</span>
                        <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
                    </a>
                    <div class="collapse" id="layouts">
                        <ul class="navbar-nav ps-3">
                            <li>
                                <a href="#" class="nav-link px-3">
                      <span class="me-2"
                      ><i class="bi bi-speedometer2"></i
                      ></span>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-book-fill"></i></span>
                        <span>Pages</span>
                    </a>
                </li>
                <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                        Addons
                    </div>
                </li>
                <li>
                    <a href="#" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-graph-up"></i></span>
                        <span>Charts</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-table"></i></span>
                        <span>Tables</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- offcanvas -->
<main class="mt-5 pt-3">



                <div class="card">
                    <div class="card-header">
                        <span><i ></i></span> Книги
                    </div>
                    <div class="card-body">

                            <table
                                    id="books"
                                    class="table"
                                    style="width: 100%">

                              >

                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>release</th>
                                    <th>description</th>
                                    <th>img</th>
                                    <th>delete</th>
                                    <th>eddit</th>
                                </tr>
                            </table>
                        </div>


    </div>
    <div class="card">
        <div class="card-header">
            <span><i ></i></span> Пользователи
        </div>
        <div class="card-body">

            <table
                    id="users"
                    class="table"
                    style="width: 100%"
            >


                <tr>
                    <th>id</th>
                    <th>email</th>
                    <th>login</th>
                    <th>image</th>
                    <th>role</th>
                    <th>status</th>
                    <th>action</th>
                </tr>

            </table>
        </div>
    </div>
    <form class="card" id="create_book" enctype="multipart/data">
        <h1>Создание новой книги</h1>
        <p><input type="text" id="name_book" placeholder="name" name="name"></p>
        <p><input type="date" id="release" placeholder="	release" name="	release"></p>
        <p><input type="text" id="description" placeholder="description" name="description"></p>
        <label for="image_file">обложка </label>
        <p> <input id="image_file" name="image_file" type="file" accept="image/jpeg,image/png,image/jpg"/></p>
        <select size="3" multiple id="genres" name="genres">
            <option disabled>Выберите жанр(ы)</option>

        </select>
        <p>
            <select size="3" multiple id="authors" name="authors">
                <option disabled>Выберите автора(ы)</option>
            </select>
        </p>
        <p><input type="submit" value="Отправить"></p>
    </form>

</main>
<script src="assets/js/admin.js"> </script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</body>
</html>