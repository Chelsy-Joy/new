<?php
    session_start();
    if(!isset($_SESSION['role'])){
        header("Location: ../../");
        die();
    }
    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tag -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Requester</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="/img/logo.png" type="stylesheet" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <!-- Boostrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

    <!-- icons:font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../css/requester.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3.0.0"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Requester</a>
                </div>
                <!-- Sidebar Navigation -->
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a class="nav-link" href="./requester.php">
                            <span class="fas fa-home"></span>
                            Home
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="nav-link" href="./uploadDocu.php">
                            <span class="fas fa-file-alt"></span>
                            Upload Document
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <!-- Button to trigger the modal -->
                        <a href="put-link-here" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                            <span class="fas fa-sign-out-alt"></span>
                            Log out
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Component -->
        <div class="main">
            <div class="container-fluid navbar-container">
            </div>
            <div class="row">
                <div class="col users-label">
                    <h1>
                        List of Uploaded Documents
                    </h1>
                </div>
            </div>

            <div class="row justify-content-center px-5 mt-3">
                <div class="col-md-12">
                    <div class="card shadow-2-strong">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="menu-items-data" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Office</th>
                                            <th scope="col">Document Title</th>
                                            <th scope="col">Document filename</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user-products-data" class="products-list">
                                    <?php
                                                    
                                        include '../../php/db.php';

                                        $sql = "SELECT document.*, officeName FROM document 
                                        INNER JOIN offices on document.officeid = offices.officeID
                                        WHERE document.userid = ".$_SESSION['uid'];

                                        $st = $conn->prepare($sql);
            
                                        $st->execute();

                                        $res = $st->get_result();

                                        $ar = [];
                                        if ($res->num_rows > 0) {
                                            while ($row = $res->fetch_assoc()) {
                                                $ar[] = "<tr>
                                                <td>" .$row['officeName'] . "</td>
                                                <td>" .$row['documentName'] . "</td>
                                                <td>" .$row['documentFile'] ."</td>
                                                <td>" .$row['documentStatus'] ."</td> </tr> ";
                                            }
                                        }
                                        foreach ($ar as $item) {
                                            echo $item;
                                        } ;
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header custom-modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to log out?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="../../php/logout.php" class="btn btn-danger">Log out</a>
                </div>
            </div>
        </div>
    </div>
    <!--End of Modal-->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const activePageLocation = window.location.pathname;
        const navLinks = document.querySelectorAll(".nav-link");
        navLinks.forEach(links => {
            if (links.href.includes(activePageLocation)) {
                links.classList.add('active');
            }
        });
    </script>



</body>

</html>